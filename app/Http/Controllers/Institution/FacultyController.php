<?php

namespace App\Http\Controllers\Institution;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Institution\Faculty;
use Illuminate\Support\Facades\Auth;

class FacultyController extends Controller
{
    /* ================= LIST PAGE ================= */
    public function index()
    {
        return redirect()->route('institution.core.academic-structure', ['tab' => 'faculty']);
    }

    /* ================= GET FACULTY LIST (AJAX) ================= */
    public function list(Request $request)
    {
        $institutionId = session('institution_id');

        $query = Faculty::with(['department','courses'])
                    ->where('institution_id', $institutionId);

        // Search
        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%')
                  ->orWhere('phone', 'like', '%' . $request->search . '%');
            });
        }

        // Department Filter
        if ($request->department_id) {
            $query->where('department_id', $request->department_id);
        }

        // Course Type Filter
        if ($request->course_type_id) {
            $query->where('course_type_id', $request->course_type_id);
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
        'department_id'  => $request->department_id,
        'name'           => $request->name,
        'email'          => $request->email,
        'phone'          => $request->phone,
        'designation'    => $request->designation,
        'specialization' => $request->specialization,
        'experience'     => $request->experience,
    ]);

    if($request->courses){
        $faculty->courses()->sync($request->courses);
    }

    return back()->with('success','Faculty Updated');
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
}