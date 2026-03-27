<?php

namespace App\Http\Controllers\Institution;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Institution\ElectiveCourses;
use App\Models\SkillsCategory;
use App\Models\SkillSubcategory;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class ElectivecourseController extends Controller
{
    // ================= LIST PAGE =================
    public function index()
    {
        $institutionId = session('institution_id');

        $electives = ElectiveCourses::with(['category','skills'])
                        ->where('institution_id', $institutionId)
                        ->latest()
                        ->get();

        $categories = SkillsCategory::all();

        return view('frontend.institutionPortal.dashboard.electives.course-catalog.index', compact('electives','categories'));
    }

    // ================= LOAD SKILLS BY CATEGORY (AJAX) =================
    public function getSkills($categoryId)
    {
        $skills = SkillSubcategory::where('category_id', $categoryId)->get();
        return response()->json($skills);
    }

    // ================= STORE =================
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'elective_title' => 'required',
            'instructor_name' => 'required',
            'category_id' => 'required',
            'duration' => 'required',
            'price' => 'required',
            'start_date' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }

        DB::beginTransaction();
        try {

            $elective = ElectiveCourses::create([
                'institution_id' => session('institution_id'),
                'elective_title' => $request->elective_title,
                'instructor_name' => $request->instructor_name,
                'category_id' => $request->category_id,
                'duration' => $request->duration,
                'price' => $request->price,
                'start_date' => $request->start_date,
                'description' => $request->description,
                'status' => 1
            ]);

            // Save skills pivot
            if ($request->skills) {
                $elective->skills()->sync($request->skills);
            }

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Elective Created Successfully'
            ]);

        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    // ================= EDIT DATA =================
    public function edit($id)
    {
        $elective = ElectiveCourses::with('skills')->find($id);
        return response()->json($elective);
    }

    // ================= UPDATE =================
    public function update(Request $request, $id)
    {
        $elective = ElectiveCourses::find($id);

        DB::beginTransaction();
        try {

            $elective->update([
                'elective_title' => $request->elective_title,
                'instructor_name' => $request->instructor_name,
                'category_id' => $request->category_id,
                'duration' => $request->duration,
                'price' => $request->price,
                'start_date' => $request->start_date,
                'description' => $request->description,
            ]);

            // Update skills
            if ($request->skills) {
                $elective->skills()->sync($request->skills);
            }

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Elective Updated Successfully'
            ]);

        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    // ================= DELETE =================
    public function destroy($id)
    {
        ElectiveCourses::find($id)->delete();

        return response()->json([
            'status' => true,
            'message' => 'Elective Deleted'
        ]);
    }

    // ================= STATUS TOGGLE =================
    public function changeStatus($id)
    {
        $elective = ElectiveCourses::find($id);
        $elective->status = $elective->status == 1 ? 0 : 1;
        $elective->save();

        return response()->json([
            'status' => true,
            'message' => 'Status Updated'
        ]);
    }

    // ================= VIEW =================
    public function show($id)
    {
        $elective = ElectiveCourses::with(['category','skills'])->find($id);
        return view('frontend.institutionPortal.electives.view', compact('elective'));
    }
}