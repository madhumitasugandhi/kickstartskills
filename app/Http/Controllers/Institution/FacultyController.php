<?php

namespace App\Http\Controllers\Institution;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Institution\Faculty;
use App\Models\Institution\InstitutionDepartment;
use App\Models\Institution\CourseType;
use Illuminate\Support\Facades\Auth;


class FacultyController extends Controller
{
    /* ================= MANAGEMENT PAGE ================= */
    public function management()
    {
        $institutionId = session('institution_id');

    $departments = InstitutionDepartment
                    ::where('institution_id', $institutionId)
                    ->get();

                    $departments = InstitutionDepartment::where('institution_id', $institutionId)->get();
                    $courses = CourseType::where('institution_id', $institutionId)->get();
                
                    return view(
                        'frontend.institutionPortal.dashboard.faculty.management.index',
                        compact('departments','courses')
                    );
    }

    /* ================= ASSIGNMENTS PAGE ================= */
    public function assignments()
    {
        return view('frontend.institutionPortal.dashboard.faculty.assignment.index');
    }

    /* ================= ACADEMIC STRUCTURE TAB REDIRECT ================= */
    public function index()
    {
        return redirect()->route('institution.core.academic-structure', ['tab' => 'faculty']);
    }

    /* ================= GET FACULTY LIST (AJAX) ================= */
    public function list(Request $request)
{
    $institutionId = session('institution_id');

    $query = Faculty::with(['department','courses'])
        ->withCount('courses')
        ->where('institution_id', $institutionId);

    if ($request->search) {
        $query->where(function ($q) use ($request) {
            $q->where('name', 'like', '%' . $request->search . '%')
              ->orWhere('email', 'like', '%' . $request->search . '%')
              ->orWhere('phone', 'like', '%' . $request->search . '%');
        });
    }

    if ($request->department_id) {
        $query->where('department_id', $request->department_id);
    }

    if ($request->employment_type) {
        $query->where('employment_type', $request->employment_type);
    }

    if ($request->status != '') {
        $query->where('status', $request->status);
    }

    $faculties = $query->latest()->get();

    return response()->json($faculties);
}


    /* ================= STORE ================= */
    
    public function store(Request $request)
    {
    
        $faculty = Faculty::create([
            'institution_id' => session('institution_id'),
            'department_id'  => $request->department_id,
            'name'           => $request->name,
            'email'          => $request->email,
            'phone'          => $request->phone,
            'designation'    => $request->designation,
            'specialization' => $request->specialization,
            'employment_type' => $request->employment_type,
            'experience'     => $request->experience,
            'created_by'     => Auth::id(),
        ]);
    
        if($request->courses){
            $faculty->courses()->sync($request->courses);
        }
    
        return back()->with('success','Faculty Added');
    }
    

    /* ================= EDIT ================= */
    public function edit($id)
    {
        $faculty = Faculty::with(['department','courses'])->findOrFail($id);
        return response()->json($faculty);
    }

    /* ================= UPDATE ================= */
    public function update(Request $request, $id)
{
    $faculty = Faculty::findOrFail($id);

    $faculty->update([
        'name'           => $request->name,
        'email'          => $request->email,
        'phone'          => $request->phone,
        'designation'    => $request->designation,
        'experience'     => $request->experience,
        'employment_type' => $request->employment_type,
    ]);

    if($request->courses){
        $faculty->courses()->sync($request->courses);
    }

    return response()->json(['success' => true]);

}
    /* ================= DELETE ================= */
    public function destroy($id)
    {
        Faculty::findOrFail($id)->delete();

        return response()->json([
            'success' => true,
            'message' => 'Faculty Deleted Successfully'
        ]);
    }

    public function changeStatus($id)
{
    $faculty = Faculty::findOrFail($id);
    $faculty->status = $faculty->status == 1 ? 0 : 1;
    $faculty->save();

    return response()->json(['success' => true]);
}

public function stats()
{
    $institutionId = session('institution_id');

    $total = Faculty::where('institution_id', $institutionId)->count();
    $active = Faculty::where('institution_id', $institutionId)->where('status',1)->count();
    $fullTime = Faculty::where('institution_id', $institutionId)->where('employment_type','full_time')->count();
    $partTime = Faculty::where('institution_id', $institutionId)->where('employment_type','part_time')->count();

    return response()->json([
        'total' => $total,
        'active' => $active,
        'full_time' => $fullTime,
        'part_time' => $partTime
    ]);
}
}