<?php

namespace App\Http\Controllers\Institution;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Institution\InstitutionDepartment;

class InstitutionDepartmentController extends Controller
{

    /*
    |-------------------------------------------
    | LIST DEPARTMENTS
    |-------------------------------------------
    */
    public function index()
    {
        $institutionId = Session::get('institution_id');

        $departments = InstitutionDepartment::where('institution_id', $institutionId)
            ->orderBy('department_name')
            ->get();

        return view(
            'frontend.institutionPortal.dashboard.core-management.academic_structure',
            compact('departments')
        );
    }


    /*
    |-------------------------------------------
    | STORE
    |-------------------------------------------
    */
    public function store(Request $request)
    {
        $institutionId = Session::get('institution_id');

        $request->validate([
            'department_name' => 'required|max:255',
        ]);

        InstitutionDepartment::create([
            'institution_id' => $institutionId,
            'department_name' => $request->department_name,
        ]);

        return back()->with('success', 'Department added successfully');
    }


    /*
    |-------------------------------------------
    | EDIT (AJAX)
    |-------------------------------------------
    */
    public function edit($id)
    {
        $institutionId = Session::get('institution_id');

        $department = InstitutionDepartment::where('institution_id', $institutionId)
            ->where('department_id', $id)
            ->firstOrFail();

        return response()->json($department);
    }


    /*
    |-------------------------------------------
    | UPDATE
    |-------------------------------------------
    */
    public function update(Request $request, $id)
    {
        $institutionId = Session::get('institution_id');

        $request->validate([
            'department_name' => 'required|max:255',
        ]);

        InstitutionDepartment::where('institution_id', $institutionId)
            ->where('department_id', $id)
            ->update([
                'department_name' => $request->department_name,
            ]);

        return back()->with('success', 'Department updated successfully');
    }


    /*
    |-------------------------------------------
    | DELETE
    |-------------------------------------------
    */
    public function destroy($id)
    {
        $institutionId = Session::get('institution_id');

        InstitutionDepartment::where('institution_id', $institutionId)
            ->where('department_id', $id)
            ->delete();

        return back()->with('success', 'Department deleted successfully');
    }
}