<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Models\SkillsCategory;

class StudentExaminationController extends Controller
{
    public function takeTestIndex()
    {
        $user = Auth::user();

        // Just fetch everything that is Published
        $availableExams = DB::table('exams')
            ->where('status', 'Published')
            ->get();

        return view('frontend.studentPortal.dashboard.examinations.takeTestIndex', compact('availableExams', 'user'));
    }

    // Iske andar ye method add karein
    public function startTest($id)
    {
        // Yeh line missing thi, isliye error aa raha tha
        $user = Auth::user();

        $exam = DB::table('exams')->where('id', $id)->first();
        $questions = DB::table('questions')->where('exam_id', $id)->get();

        // Ab 'user' compact mein kaam karega
        return view('frontend.studentPortal.dashboard.examinations.liveQuizIndex', compact('exam', 'questions', 'user'));
    }

    public function submitQuiz(Request $request)
    {
        $user = Auth::user();
        $answers = $request->input('answer'); // Yeh wo array hai jo radio buttons se aayega
        $exam_id = $request->input('exam_id');

        $totalQuestions = count($answers);
        $correctAnswers = 0;

        foreach ($answers as $questionId => $selectedOptionId) {
            // Database se correct option ki ID check karein
            $correctOption = DB::table('question_options')
                ->where('question_id', $questionId)
                ->where('is_correct', 1)
                ->first();


            if ($correctOption && $selectedOptionId == $correctOption->id) {
                $correctAnswers++;
            }
        }

        // Score calculate karein
        $scorePercentage = ($correctAnswers / $totalQuestions) * 100;

        // Result save karein (Make sure 'student_results' table exists)
        DB::table('student_results')->insert([
            'user_id' => $user->id,
            'exam_id' => $exam_id,
            'total_questions' => $totalQuestions,
            'correct_answers' => $correctAnswers,
            'score' => $scorePercentage,
            'created_at' => now()
        ]);

        return redirect()->route('student.exam.results')->with('success', 'Quiz submitted successfully!');
    }

    public function results()
    {
        $user = Auth::user();

        // 1. Fetch real results with Exam details
        $results = DB::table('student_results')
            ->join('exams', 'student_results.exam_id', '=', 'exams.id')
            ->where('student_results.user_id', $user->id)
            ->select('student_results.*', 'exams.exam_title', 'exams.skill_category', 'exams.duration_minutes as total_time')
            ->orderBy('student_results.created_at', 'desc')
            ->get();

        // 2. Calculate Stats (For the top cards)
        $avgScore = $results->avg('score') ?? 0;
        $highScore = $results->max('score') ?? 0;
        $passRate = $results->count() > 0
            ? ($results->where('score', '>=', 50)->count() / $results->count()) * 100
            : 0;

        return view('frontend.studentPortal.dashboard.examinations.resultsIndex', compact('results', 'user', 'avgScore', 'highScore', 'passRate'));
    }
}
