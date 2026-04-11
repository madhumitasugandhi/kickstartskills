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
        $payment = DB::table('student_drive_payments')
            ->where('student_id', $user->id)
            ->where('drive_id', $driveId)
            ->where('status', 'paid')
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


    public function submit(Request $request)
{
    try {

        $user = Auth::user();
        $answers = $request->answer ?? [];
        $driveId = $request->drive_id;
        $timeTaken = $request->time_taken;

        $questions = DB::table('student_drive_question_attempts')
            ->where('user_id', $user->id)
            ->where('drive_id', $driveId)
            ->get();

        if ($questions->isEmpty()) {
            return response()->json(['error' => 'No attempt found']);
        }

        $correct = 0;
        $wrong = 0;
        $skipped = 0;

        foreach ($questions as $q) {

            $selected = $answers[$q->question_id] ?? null;

            $correctOption = DB::table('question_options')
                ->where('question_id', $q->question_id)
                ->where('is_correct', 1)
                ->first();

            if ($selected) {
                if ($correctOption && $selected == $correctOption->id) {
                    $correct++;
                } else {
                    $wrong++;
                }
            } else {
                $skipped++;
            }
        }

        $total = $questions->count();
        $score = $total ? ($correct / $total) * 100 : 0;

        // 🔥 IMPORTANT FIX (check before insert)
        $exists = DB::table('student_results')
            ->where('user_id', $user->id)
            ->where('drive_id', $driveId)
            ->where('type', 'drive')
            ->exists();

        if (!$exists) {
            DB::table('student_results')->insert([
                'user_id' => $user->id,
                'drive_id' => $driveId,
                'type' => 'drive',
                'total_questions' => $total,
                'correct_answers' => $correct,
                'score' => $score,
                'status' => $score >= 50 ? 'Passed' : 'Failed',
                'time_taken' => $timeTaken,
                'created_at' => now()
            ]);
        }

        return response()->json([
            'score' => round($score, 2),
            'correct' => $correct,
            'wrong' => $wrong,
            'skipped' => $skipped,
            'total' => $total,
            'status' => $score >= 50 ? 'Passed' : 'Failed',
            'time_taken' => $timeTaken,
            'attempt' => 1
        ]);

    } catch (\Exception $e) {

        return response()->json([
            'error' => true,
            'message' => $e->getMessage(),
            'line' => $e->getLine()
        ], 500);
    }
}


   
}