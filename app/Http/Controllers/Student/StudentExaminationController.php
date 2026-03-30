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

        // Fetch Published Exams with Category Name
        $availableExams = DB::table('exams')
            ->join('skills_categories', 'exams.skill_category_id', '=', 'skills_categories.id')
            ->select('exams.*', 'skills_categories.name as skill_name')
            ->where('exams.status', 'Published')
            ->get();

        return view('frontend.studentPortal.dashboard.examinations.takeTestIndex', compact('availableExams', 'user'));
    }

    public function startTest($id)
    {
        $user = Auth::user();
        $exam = DB::table('exams')->where('id', $id)->first();

        // Fetch Questions and their Options
        $questions = DB::table('questions')->where('exam_id', $id)->get();
        foreach ($questions as $q) {
            $q->options = DB::table('question_options')->where('question_id', $q->id)->get();
        }

        return view('frontend.studentPortal.dashboard.examinations.liveQuizIndex', compact('exam', 'questions', 'user'));
    }

    public function submitQuiz(Request $request)
    {
        $user = Auth::user();
        $answers = $request->input('answer') ?? [];
        $exam_id = $request->input('exam_id');

        $totalQuestions = DB::table('questions')->where('exam_id', $exam_id)->count();
        $correctAnswers = 0;

        foreach ($answers as $questionId => $selectedOptionId) {
            $correctOption = DB::table('question_options')
                ->where('question_id', $questionId)
                ->where('is_correct', 1)
                ->first();

            if ($correctOption && $selectedOptionId == $correctOption->id) {
                $correctAnswers++;
            }
        }

        $scorePercentage = $totalQuestions > 0 ? ($correctAnswers / $totalQuestions) * 100 : 0;

        // Consistent Table Name: student_results
        DB::table('student_results')->insert([
            'user_id' => $user->id,
            'exam_id' => $exam_id,
            'total_questions' => $totalQuestions,
            'correct_answers' => $correctAnswers,
            'score' => $scorePercentage,
            'status' => $scorePercentage >= 50 ? 'Passed' : 'Failed', // Passing logic
            'created_at' => now()
        ]);

        return redirect()->route('student.exam.history')->with('success', 'Quiz submitted successfully!');
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

    public function results()
    {
        $user = Auth::user();

        // Student ke results fetch karein
        $results = DB::table('student_results')
            ->join('exams', 'student_results.exam_id', '=', 'exams.id')
            ->where('student_results.user_id', $user->id)
            ->select('student_results.*', 'exams.exam_title', 'exams.duration_minutes as total_time')
            ->orderBy('student_results.created_at', 'desc')
            ->get();

        // Stats calculation
        $avgScore = $results->avg('score') ?? 0;
        $highScore = $results->max('score') ?? 0;
        $passRate = $results->count() > 0
            ? ($results->where('score', '>=', 50)->count() / $results->count()) * 100
            : 0;

        return view('frontend.studentPortal.dashboard.examinations.resultsIndex', compact('results', 'user', 'avgScore', 'highScore', 'passRate'));
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
