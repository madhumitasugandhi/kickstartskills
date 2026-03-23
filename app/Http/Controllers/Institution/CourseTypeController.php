<?php

namespace App\Http\Controllers\Institution;

use App\Http\Controllers\Controller;
use App\Models\Institution\CourseRequirement;
use Illuminate\Http\Request;
use App\Models\Institution\CourseType;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class CourseTypeController extends Controller
{
    /**
     * Get all course types (AJAX / page load)
     */
    public function index()
    {
        $institutionId =session('institution_id');
        $requirements = CourseRequirement::all();

        $courseTypes = CourseType::where('institution_id', $institutionId)
            ->latest()
            ->get();

        return view('frontend.institutionPortal.dashboard.core-management.course-management.index',  compact('courseTypes', 'requirements'));
    }

    /**
     * Store new course type
     */
    public function store(Request $request)
    {
        $institutionId = session('institution_id');

        $validator = Validator::make($request->all(), [
            'course_name' => 'required|string|max:100',
            'duration_years' => 'required|integer|min:0|max:10',
            'duration_months' => 'required|integer|min:0|max:11',
            'code_extension' => 'required|string|max:10|alpha_num',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            DB::beginTransaction();

            $course = CourseType::create([
                'institution_id' => $institutionId,
                'course_name' => $request->course_name,
                'duration_years' => $request->duration_years,
                'duration_months' => $request->duration_months,
                'code_extension' => strtoupper($request->code_extension),
            ]);

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Course type added successfully',
                'data' => $course
            ]);

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'status' => false,
                'message' => 'Something went wrong'
            ], 500);
        }
    }

    /**
     * Update course type
     */
    public function update(Request $request, $id)
    {
        $institutionId = session('institution_id');

        $course = CourseType::where('course_type_id', $id)
            ->where('institution_id', $institutionId)
            ->first();

        if (!$course) {
            return response()->json([
                'status' => false,
                'message' => 'Course not found'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'course_name' => 'required|string|max:100',
            'duration_years' => 'required|integer|min:0|max:10',
            'duration_months' => 'required|integer|min:0|max:11',
            'code_extension' => 'required|string|max:10|alpha_num',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            DB::beginTransaction();

            $course->update([
                'course_name' => $request->course_name,
                'duration_years' => $request->duration_years,
                'duration_months' => $request->duration_months,
                'code_extension' => strtoupper($request->code_extension),
            ]);

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Course updated successfully'
            ]);

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'status' => false,
                'message' => 'Update failed'
            ], 500);
        }
    }

    /**
     * Delete course type
     */
    public function destroy($id)
    {
        $institutionId = session('institution_id');

        $course = CourseType::where('course_type_id', $id)
            ->where('institution_id', $institutionId)
            ->first();

        if (!$course) {
            return response()->json([
                'status' => false,
                'message' => 'Course not found'
            ], 404);
        }

        $course->delete();

        return response()->json([
            'status' => true,
            'message' => 'Course deleted successfully'
        ]);
    }
}