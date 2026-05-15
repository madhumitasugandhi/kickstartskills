<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class StudentDriveController extends Controller
{
    public function start($driveId)
    {
        $user = Auth::user();

        // 1️⃣ Payment check
        $payment = DB::table('student_drive_payments as sdp')
        ->join('platform_payments as pp', 'pp.id', '=', 'sdp.platform_payment_id')
        ->where('sdp.student_id', $user->id)
        ->where('sdp.drive_id', $driveId)
        ->where('pp.status', 'success') 
        ->first();

        if (!$payment) {
            return back()->with('error','Please complete payment first');
        }

        // 2️⃣ Assignment check
        $assigned = DB::table('drive_visible_students')
            ->where('drive_id', $driveId)
            ->where('is_visible', 1)
            ->whereJsonContains('student_id', (string)$user->id)
            ->exists();

        if (!$assigned) {
            return back()->with('error','Not eligible');
        }

        // 3️⃣ Schedule check
        $assessment = DB::table('drive_assessments')
            ->where('drive_id', $driveId)
            ->first();

        if (!$assessment) {
            return back()->with('error','Exam not scheduled');
        }

        $start = Carbon::parse($assessment->exam_date.' '.$assessment->start_time);
        $end   = Carbon::parse($assessment->exam_date.' '.$assessment->end_time);

        if (now() < $start) return back()->with('error','Exam not started');
        if (now() > $end) return back()->with('error','Exam ended');

        // 4️⃣ Skills
        $skills = DB::table('drive_skills')
            ->where('drive_id', $driveId)
            ->pluck('skill_subcategory_id');

        // 5️⃣ Check if attempt already created
        $alreadyExists = DB::table('student_drive_question_attempts')
            ->where('user_id', $user->id)
            ->where('drive_id', $driveId)
            ->exists();

        // 6️⃣ Generate questions (ONLY FIRST TIME)
        if (!$alreadyExists) {

            $questions = DB::table('questions')
                ->whereIn('skills_subcategory_id', $skills)
                ->inRandomOrder()
                ->limit(20)
                ->get();

            foreach ($questions as $q) {
                DB::table('student_drive_question_attempts')->insert([
                    'user_id' => $user->id,
                    'drive_id' => $driveId,
                    'question_id' => $q->id,
                    'skills_category_id' => $q->skills_category_id,
                    'skills_subcategory_id' => $q->skills_subcategory_id,
                    'marks' => $q->marks,
                    'attempt_no' => 1,
                    'created_at' => now()
                ]);
            }
        }

        // 7️⃣ Fetch questions from DB (FIXED SET)
        $questions = DB::table('student_drive_question_attempts as sqa')
        ->join('questions as q', 'q.id', '=', 'sqa.question_id')
        ->leftJoin('skills_subcategories as sc', 'q.skills_subcategory_id', '=', 'sc.id')
        ->select('q.*', 'sc.name as subcategory_name')
        ->where('sqa.user_id', $user->id)
        ->where('sqa.drive_id', $driveId)
        ->get();

        // 8️⃣ Attach options
        foreach ($questions as $q) {
            $q->options = DB::table('question_options')
                ->where('question_id', $q->id)
                ->inRandomOrder()
                ->get();
        }

        return view('frontend.studentPortal.dashboard.examinations.liveQuizIndex', [
'groupedQuestions' => $questions->groupBy('subcategory_name'),
            'drive' => (object)[
                'id' => $driveId,
                'duration_minutes' => $assessment->duration_minutes
            ],
            'user' => $user
        ]);
    }

public function submitDriveQuiz(Request $request)
{
    $user = Auth::user();
    $answers = $request->input('answer') ?? [];
    $drive_id = $request->input('drive_id');
    $time_taken = $request->input('time_taken');

    $questionIds = DB::table('student_drive_question_attempts')
    ->where('user_id', $user->id)
    ->where('drive_id', $drive_id)
    ->pluck('question_id')
    ->toArray();

    $totalQuestions = count($questionIds);

    $attemptNumber = DB::table('student_exam_attempts')
        ->where('user_id', $user->id)
        ->where('drive_id', $drive_id)
        ->count() + 1;

    $correctAnswers = 0;
    $wrongAnswers = 0;
    $skipped = 0;

    DB::beginTransaction();

    try {

        foreach ($questionIds as $questionId) {

            $selectedOptionId = $answers[$questionId] ?? null;

            $question = DB::table('questions')->where('id', $questionId)->first();

            $correctOption = DB::table('question_options')
                ->where('question_id', $questionId)
                ->where('is_correct', 1)
                ->first();

            if ($selectedOptionId) {
                if ($correctOption && $selectedOptionId == $correctOption->id) {
                    $correctAnswers++;
                } else {
                    $wrongAnswers++;
                }
            } else {
                $skipped++;
            }
        }

        $scorePercentage = $totalQuestions > 0
            ? ($correctAnswers / $totalQuestions) * 100
            : 0;

        $status = $scorePercentage >= 50 ? 'Passed' : 'Failed';

        DB::table('student_exam_attempts')->insert([
            'user_id' => $user->id,
            'drive_id' => $drive_id,
            'type' => 'drive', 
            'attempt_no' => $attemptNumber,
            'total_questions' => $totalQuestions,
            'correct_answers' => $correctAnswers,
            'wrong_answers' => $wrongAnswers,
            'skipped_answers' => $skipped,
            'score' => $scorePercentage,
            'status' => $status,
            'time_taken' => $time_taken,
            'created_at' => now()
        ]);

        DB::commit();

        return response()->json([
            'score' => round($scorePercentage, 2),
            'correct' => $correctAnswers,
            'wrong' => $wrongAnswers,
            'skipped' => $skipped,
            'total' => $totalQuestions,
            'status' => $status,
            'time_taken' => $time_taken,
            'attempt' => $attemptNumber
        ]);

    } catch (\Exception $e) {
        DB::rollback();
        return response()->json([
            'error' => 'Something went wrong',
            'message' => $e->getMessage()
        ], 500);
    }
}
   
}