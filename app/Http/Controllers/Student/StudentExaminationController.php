<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StudentExaminationController extends Controller
{
    public function takeTestIndex()
    {
        $user = Auth::user();

        $availableExams = DB::table('student_skills')
            ->join('skills_subcategories', 'student_skills.skill_name', '=', 'skills_subcategories.name')
            ->join('skills_categories', 'skills_subcategories.skills_category_id', '=', 'skills_categories.id')
            ->join('exams', 'exams.skill_category_id', '=', 'skills_categories.id')
            ->where('student_skills.user_id', $user->id)
            ->where('exams.status', 'Published')
            ->select(
                'exams.*',
                'skills_categories.name as skill_name'
            )
            ->distinct()
            ->get();

        return view('frontend.studentPortal.dashboard.examinations.takeTestIndex', compact('availableExams', 'user'));
    }

    public function startTest($id)
    {
        $user = Auth::user();
        $exam = DB::table('exams')->where('id', $id)->first();
    
        if (!$exam || !$exam->questions_id) {
            return back()->with('error', 'No questions assigned to this exam.');
        }
    
        $questionIds = json_decode($exam->questions_id, true);
    
        // Fetch Questions with subcategory
        $questions = DB::table('questions')
            ->leftJoin('skills_subcategories', 'questions.skills_subcategory_id', '=', 'skills_subcategories.id')
            ->whereIn('questions.id', $questionIds)
            ->select(
                'questions.*',
                'skills_subcategories.name as subcategory_name'
            )
            ->orderBy('skills_subcategories.name')
            ->get();
    
        // Attach Options
        foreach ($questions as $q) {
            $q->options = DB::table('question_options')
                ->where('question_id', $q->id)
                ->get();
        }
    
        // Group by subcategory
        $groupedQuestions = $questions->groupBy('subcategory_name');
    
        return view(
            'frontend.studentPortal.dashboard.examinations.liveQuizIndex',
            compact('exam', 'groupedQuestions', 'user')
        );
    }

public function submitQuiz(Request $request)
{
    $user = Auth::user();
    $answers = $request->input('answer') ?? [];
    $exam_id = $request->input('exam_id');
    $time_taken = $request->input('time_taken');

    $exam = DB::table('exams')->where('id', $exam_id)->first();
    $questionIds = json_decode($exam->questions_id, true);
    $totalQuestions = count($questionIds);

    // Attempt number
    $attemptNumber = DB::table('student_exam_attempts')
        ->where('user_id', $user->id)
        ->where('exam_id', $exam_id)
        ->count() + 1;

    $correctAnswers = 0;
    $wrongAnswers = 0;
    $skipped = 0;

    DB::beginTransaction();

    try {

        // First calculate results
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

        $scorePercentage = $totalQuestions > 0 ? ($correctAnswers / $totalQuestions) * 100 : 0;
        $passingScore = $exam->passing_score ?? 50;
        $status = $scorePercentage >= $passingScore ? 'Passed' : 'Failed';

        // Insert Exam Attempt
        $attemptId = DB::table('student_exam_attempts')->insertGetId([
            'user_id' => $user->id,
            'exam_id' => $exam_id,
            'attempt_no' => $attemptNumber,
            'total_questions' => $totalQuestions,
            'correct_answers' => $correctAnswers,
            'wrong_answers' => $wrongAnswers,
            'skipped_answers' => $skipped,
            'score' => $scorePercentage,
            'status' => $status,
            'time_taken' => $time_taken,
            'is_first_attempt' => $attemptNumber == 1 ? 1 : 0,
            'created_at' => now()
        ]);

        // Insert Question Attempts
        foreach ($questionIds as $questionId) {

            $selectedOptionId = $answers[$questionId] ?? null;

            $question = DB::table('questions')->where('id', $questionId)->first();

            $correctOption = DB::table('question_options')
                ->where('question_id', $questionId)
                ->where('is_correct', 1)
                ->first();

            $isCorrect = 0;

            if ($selectedOptionId && $correctOption && $selectedOptionId == $correctOption->id) {
                $isCorrect = 1;
            }

            DB::table('student_question_attempts')->insert([
                'attempt_id' => $attemptId,
                'user_id' => $user->id,
                'exam_id' => $exam_id,
                'question_id' => $questionId,
                'selected_option_id' => $selectedOptionId,
                'is_correct' => $isCorrect,
                'skills_category_id' => $question->skills_category_id,
                'skills_subcategory_id' => $question->skills_subcategory_id,
                'difficulty_level' => $question->difficulty_level,
                'marks' => $question->marks,
                'created_at' => now()
            ]);
        }

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

    public function testHistory()
    {
        $user = Auth::user();

        // Fetching from consistent table 'student_results'
        $examHistory = DB::table('student_results')
            ->join('exams', 'student_results.exam_id', '=', 'exams.id')
            ->where('student_results.user_id', $user->id)
            ->select('student_results.*', 'exams.exam_title', 'exams.duration_minutes')
            ->orderBy('student_results.created_at', 'desc')
            ->get();

        return view('frontend.studentPortal.dashboard.examinations.testHistoryIndex', compact('examHistory', 'user'));
    }

    public function results(Request $request)
    {
        $user = Auth::user();
    
        // ================= RESULTS LIST =================
        $query = DB::table('student_exam_attempts')
            ->join('exams', 'student_exam_attempts.exam_id', '=', 'exams.id')
            ->leftJoin('skills_categories', 'exams.skill_category_id', '=', 'skills_categories.id')
            ->where('student_exam_attempts.user_id', $user->id)
            ->select(
                'student_exam_attempts.*',
                'exams.exam_title',
                'exams.duration_minutes as total_time',
                'exams.passing_score',
                'skills_categories.name as skill_name',
            );
    
        // Subject Filter
        if ($request->subject && $request->subject != 'All') {
            $query->where('skills_categories.name', $request->subject);
        }
    
        // Time Filter
        if ($request->time == 'month') {
            $query->where('student_exam_attempts.created_at', '>=', now()->subMonth());
        }
        if ($request->time == 'week') {
            $query->where('student_exam_attempts.created_at', '>=', now()->subWeek());
        }
    
        // Sorting
        if ($request->sort == 'oldest') {
            $query->orderBy('student_exam_attempts.created_at', 'asc');
        } else {
            $query->orderBy('student_exam_attempts.created_at', 'desc');
        }
    
        $results = $query->get();
    
        // ================= OVERALL STATS =================
        $avgScore = $results->avg('score') ?? 0;
        $highScore = $results->max('score') ?? 0;
        $passRate = $results->count() > 0
            ? ($results->where('status', 'Passed')->count() / $results->count()) * 100
            : 0;
    
        // ================= SUBJECT PERFORMANCE =================
        $subjectPerformance = DB::table('student_question_attempts')
            ->join('skills_categories', 'student_question_attempts.skills_category_id', '=', 'skills_categories.id')
            ->where('student_question_attempts.user_id', $user->id)
            ->select(
                'skills_categories.name as subject',
                DB::raw('COUNT(*) as total_questions'),
                DB::raw('SUM(is_correct) as correct_answers'),
                DB::raw('(SUM(is_correct)/COUNT(*))*100 as accuracy')
            )
            ->groupBy('skills_categories.name')
            ->get();
    
        // ================= RECOMMENDATIONS =================
        $recommendations = [];
    
        foreach ($subjectPerformance as $sub) {
            if ($sub->accuracy < 40) {
                $recommendations[] = "Focus on {$sub->subject}";
            } elseif ($sub->accuracy < 70) {
                $recommendations[] = "Practice more {$sub->subject}";
            } else {
                $recommendations[] = "Good performance in {$sub->subject}";
            }
        }
    
        // Subjects for dropdown
        $subjects = DB::table('skills_categories')->pluck('name');
    
        return view('frontend.studentPortal.dashboard.examinations.resultsIndex',
            compact(
                'results',
                'user',
                'avgScore',
                'highScore',
                'passRate',
                'subjects',
                'subjectPerformance',
                'recommendations'
            )
        );
    }
    public function practiceIndex()
    {
        $user = Auth::user();

        // Practice tests fetch karo (Same as exams but maybe with different status or filter)
        $practiceExams = DB::table('exams')
            ->join('skills_categories', 'exams.skill_category_id', '=', 'skills_categories.id')
            ->select('exams.*', 'skills_categories.name as skill_name')
            ->where('exams.status', 'Published') // Ya agar aapne practice ka alag flag rakha hai
            ->get();

        return view('frontend.studentPortal.dashboard.examinations.practiceTestsIndex', compact('practiceExams', 'user'));
    }
}
