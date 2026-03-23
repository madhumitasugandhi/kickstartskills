<?php

namespace App\Http\Controllers\Institution;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Institution\CourseRequirement;

class CourseRequirementController extends Controller
{
    // GET ALL
    public function index()
    {
        $requirements = CourseRequirement::latest()->get();

        return response()->json($requirements);
    }

    // STORE
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255|unique:course_requirements,requirement_name'
        ]);

        $req = CourseRequirement::create([
            'requirement_name' => $request->name
        ]);

        return response()->json([
            'status' => 'success',
            'data' => $req
        ]);
    }

    // DELETE
    public function destroy($id)
    {
        CourseRequirement::where('requirement_id', $id)->delete();

        return response()->json([
            'status' => 'deleted'
        ]);
    }
}