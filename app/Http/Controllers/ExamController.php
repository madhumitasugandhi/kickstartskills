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
        $questions = DB::table('questions')
            ->where('skills_category_id', $catId)
            ->select('id', 'question_text', 'difficulty_level')
            ->get();

        return response()->json($questions);
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
    
    public function edit($id)
    {
        $exam = DB::table('exams')->where('id', $id)->first();
        $categories = DB::table('skills_categories')->get();

        // Abhi humne file nahi banayi hai, toh error na aaye isliye ye path check kar lo
        return view('frontend.adminPortal.dashboard.examManagement.editExam', compact('exam', 'categories'));
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
