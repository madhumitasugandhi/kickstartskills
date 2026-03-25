<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class AdminQuestionController extends Controller
{
    public function index()
    {
        $questions = DB::table('questions')
            ->join('skills_categories', 'questions.skills_category_id', '=', 'skills_categories.id')
            ->join('skills_subcategories', 'questions.skills_subcategory_id', '=', 'skills_subcategories.id')
            ->select('questions.*', 'skills_categories.name as cat_name', 'skills_subcategories.name as subcat_name')
            ->orderBy('questions.id', 'desc')
            ->get();

        return view('frontend.adminPortal.dashboard.questionBank.index', compact('questions'));
    }

    public function create()
    {
        $categories = DB::table('skills_categories')->get();
        return view('frontend.adminPortal.dashboard.questionBank.create', compact('categories'));
    }

    public function getSubcategories($categoryId)
    {
        $subcategories = DB::table('skills_subcategories')
            ->where('skills_category_id', $categoryId)
            ->get();

        return response()->json($subcategories);
    }

    // AdminQuestionController.php

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            foreach ($request->questions as $index => $qData) {
                // 1. Insert into questions table
                $qId = DB::table('questions')->insertGetId([
                    'skills_category_id' => $request->category_id,
                    'skills_subcategory_id' => $request->subcategory_id,
                    'question_text' => $qData['text'],
                    'ans_format' => $qData['format'],
                    'difficulty_level' => $qData['difficulty'],
                    'created_at' => now()
                ]);

                // 2. MCQ logic
                if ($qData['format'] == 'MCQ') {
                    foreach ($qData['options'] as $oIdx => $oText) {
                        $path = null;
                        // File upload logic (handle multiple questions' files)
                        if ($request->hasFile("questions.$index.option_images.$oIdx")) {
                            $file = $request->file("questions.$index.option_images.$oIdx");
                            $name = time() . "_$index" . "_$oIdx." . $file->extension();
                            $file->move(public_path('uploads/questions'), $name);
                            $path = 'uploads/questions/' . $name;
                        }

                        DB::table('question_options')->insert([
                            'question_id' => $qId,
                            'option_text' => $oText,
                            'path_format' => $path,
                            'is_correct' => ($qData['correct_option'] == $oIdx) ? 1 : 0,
                        ]);
                    }
                } else {
                    // Written answer
                    DB::table('question_answers')->insert([
                        'question_id' => $qId,
                        'answer_text' => $qData['correct_answer_text'],
                    ]);
                }
            }

            DB::commit();
            return redirect()->route('admin.questions.index')->with('success', count($request->questions) . ' questions saved successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }
    // 1. Delete Function
    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            // Pehle related data delete karo
            DB::table('question_options')->where('question_id', $id)->delete();
            DB::table('question_answers')->where('question_id', $id)->delete();

            // Phir main question delete karo
            DB::table('questions')->where('id', $id)->delete();

            DB::commit();
            return redirect()->back()->with('success', 'Bhai, question safely delete ho gaya!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Locha ho gaya delete karte waqt: ' . $e->getMessage());
        }
    }
    public function update(Request $request, $id)
{
    try {
        DB::beginTransaction();

        // 1. Question details update
        DB::table('questions')->where('id', $id)->update([
            'skills_category_id' => $request->category_id,
            'skills_subcategory_id' => $request->subcategory_id,
            'question_text' => $request->question_text,
            'ans_format' => $request->ans_format,
            'difficulty_level' => $request->difficulty_level,
            'updated_at' => now(),
        ]);

        // 2. Clear old options/answers and add new ones (Simple approach)
        DB::table('question_options')->where('question_id', $id)->delete();
        DB::table('question_answers')->where('question_id', $id)->delete();

        if ($request->ans_format == 'MCQ') {
            foreach ($request->options as $index => $optionText) {
                DB::table('question_options')->insert([
                    'question_id' => $id,
                    'option_text' => $optionText,
                    'is_correct' => ($request->correct_option == $index) ? 1 : 0,
                    'created_at' => now(),
                ]);
            }
        } else {
            DB::table('question_answers')->insert([
                'question_id' => $id,
                'answer_text' => $request->correct_answer_text,
                'created_at' => now(),
            ]);
        }

        DB::commit();
        return redirect()->route('admin.questions.index')->with('success', 'Bhai, Question update ho gaya!');
    } catch (\Exception $e) {
        DB::rollBack();
        return back()->with('error', $e->getMessage());
    }
}

    // 2. Edit Page (Sirf view dikhane ke liye)
    public function edit($id)
    {
        $question = DB::table('questions')->where('id', $id)->first();
        $categories = DB::table('skills_categories')->get();

        // Agar MCQ hai toh options fetch karo
        $options = [];
        if ($question->ans_format == 'MCQ') {
            $options = DB::table('question_options')->where('question_id', $id)->get();
        } else {
            $answer = DB::table('question_answers')->where('question_id', $id)->first();
            $question->answer_text = $answer->answer_text ?? '';
        }

        return view('frontend.adminPortal.dashboard.questionBank.edit', compact('question', 'categories', 'options'));
    }
}
