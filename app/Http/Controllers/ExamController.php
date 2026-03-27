<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExamController extends Controller
{
    // 1. Saare Exams ki list dikhane ke liye
    public function index()
    {
        $exams = DB::table('exams')
            ->join('skills_categories', 'exams.skill_category_id', '=', 'skills_categories.id')
            ->select('exams.*', 'skills_categories.name as skill_name')
            ->orderBy('exams.id', 'desc')
            ->paginate(10);

        return view('frontend.adminPortal.dashboard.examManagement.showAllExams', compact('exams'));
    }

    // 2. Naya Exam form dikhane ke liye
    public function create()
    {
        $categories = DB::table('skills_categories')->get();
        return view('frontend.adminPortal.dashboard.examManagement.createExam', compact('categories'));
    }

    // 3. AJAX: Category wise questions fetch karne ke liye
    public function getQuestionsByCategory($catId)
    {
        try {
            $questions = DB::table('questions')
                // Table ka naam check karo: skills_subcategories hai ya skills_subcategory?
                ->leftJoin('skills_subcategories', 'questions.skills_subcategory_id', '=', 'skills_subcategories.id')
                ->where('questions.skills_category_id', $catId)
                ->select(
                    'questions.id',
                    'questions.question_text',
                    'questions.difficulty_level',
                    'skills_subcategories.name as sub_name'
                )
                ->get();

            return response()->json($questions);
        } catch (\Exception $e) {
            // Agar error aaye toh JSON mein error return karo taaki console mein dikhe
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    // 4. Exam save karne ke liye
    public function store(Request $request)
    {
        // 1. Validation
        $request->validate([
            'exam_title' => 'required|string|max:255',
            'skill_category_id' => 'required|integer',
            'questions_id' => 'required|array|min:1',
            'duration_minutes' => 'required|integer',
            'passing_score' => 'required|integer',
        ]);

        try {
            // 2. Insert using DB Query Builder
            DB::table('exams')->insert([
                'skill_category_id' => $request->skill_category_id,
                'exam_title' => $request->exam_title,
                'questions_id' => json_encode($request->questions_id), // Essential for JSON column
                'duration_minutes' => $request->duration_minutes,
                'total_marks' => count($request->questions_id), // Marks based on count
                'passing_score' => $request->passing_score,
                'status' => 'Published', // Make sure this matches your ENUM in DB
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            return redirect()->route('admin.exams.index')->with('success', 'Exam created successfully!');

        } catch (\Exception $e) {
            // Bhai, agar error aaye toh yahan log check karo
            return back()->with('error', 'Database Error: ' . $e->getMessage())->withInput();
        }
    }

    public function viewExam($id)
    {
        $exam = DB::table('exams')
            ->join('skills_categories', 'exams.skill_category_id', '=', 'skills_categories.id')
            ->select('exams.*', 'skills_categories.name as skill_name')
            ->where('exams.id', $id)
            ->first();

        $questionIds = json_decode($exam->questions_id, true) ?? [];

        // Questions fetch karo
        $questions = DB::table('questions')
            ->whereIn('id', $questionIds)
            ->select('id', 'question_text', 'difficulty_level', 'ans_format', 'question_type', 'marks')
            ->get();

        // Har question ke options fetch karo (Assuming table name is question_options)
        foreach ($questions as $q) {
            $q->options = DB::table('question_options')
                ->where('question_id', $q->id)
                ->get();
        }

        return view('frontend.adminPortal.dashboard.examManagement.viewExam', compact('exam', 'questions'));
    }

    public function edit($id)
    {
        $exam = DB::table('exams')->where('id', $id)->first();

        if (!$exam) {
            return redirect()->route('admin.exams.index')->with('error', 'Exam nahi mila!');
        }

        $categories = DB::table('skills_categories')->get();

        // Questions ko array mein convert karo taaki blade mein check kar sakein
        $selectedQuestions = json_decode($exam->questions_id, true) ?? [];

        return view('frontend.adminPortal.dashboard.examManagement.editExam', compact('exam', 'categories', 'selectedQuestions'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'questions_id' => 'required|array|min:1',
        ], [
            'questions_id.required' => 'Bhai, kam sa kam ek sawal toh select karo!'
        ]);

        DB::table('exams')->where('id', $id)->update([
            'exam_title' => $request->exam_title,
            'skill_category_id' => $request->skill_category_id,
            'questions_id' => json_encode($request->questions_id),
            'duration_minutes' => $request->duration_minutes,
            'total_marks' => $request->questions_id ? count($request->questions_id) : 0,
            'passing_score' => $request->passing_score,
            'updated_at' => now(),
        ]);

        return redirect()->route('admin.exams.index')->with('success', 'Exam updated successfully!');
    }
    public function destroy($id)
    {
        try {
            DB::table('exams')->where('id', $id)->delete();
            return redirect()->route('admin.exams.index')->with('success', 'Exam deleted successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'Delete nahi hua: ' . $e->getMessage());
        }
    }
}
