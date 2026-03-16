<?php

namespace App\Http\Controllers\Institution;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Models\Institution\InstitutionProgram;
use App\Models\Institution\InstitutionDepartment;

class InstitutionProgramController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | LIST PROGRAMS
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $institutionId = Session::get('institution_id');

        $programs = InstitutionProgram::where('institution_id', $institutionId)
            ->with('department')
            ->orderBy('program_name')
            ->get();

        $departments = InstitutionDepartment::where('institution_id', $institutionId)
            ->pluck('department_name','department_id');

        return view(
            'frontend.institutionPortal.dashboard.programs.management.index',
            compact('programs','departments')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | STORE PROGRAM
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {

        $institutionId = Session::get('institution_id');

        $request->validate([
            'program_name' => 'required|max:255',
            'department_id' => 'required',
            'fees' => 'nullable|numeric',
            'duration' => 'nullable|max:100',
            'description' => 'nullable'
        ]);

        InstitutionProgram::create([

            'institution_id' => $institutionId,
            'department_id' => $request->department_id,
            'program_name' => $request->program_name,
            'fees' => $request->fees,
            'duration' => $request->duration,
            'description' => $request->description

        ]);

        return back()->with('success','Program added successfully');

    }


    /*
    |--------------------------------------------------------------------------
    | EDIT PROGRAM
    |--------------------------------------------------------------------------
    */

    public function edit($id)
{
    $institutionId = Session::get('institution_id');

    $program = InstitutionProgram::where('institution_id',$institutionId)
        ->where('program_id',$id)
        ->with('department')
        ->firstOrFail();

    return response()->json($program);
}


    /*
    |--------------------------------------------------------------------------
    | UPDATE PROGRAM
    |--------------------------------------------------------------------------
    */

    public function update(Request $request,$id)
    {

        $institutionId = Session::get('institution_id');

        $request->validate([
            'program_name' => 'required|max:255',
            'department_id' => 'required',
            'fees' => 'nullable|numeric',
            'duration' => 'nullable|max:100',
            'description' => 'nullable'
        ]);

        InstitutionProgram::where('institution_id',$institutionId)
            ->where('program_id',$id)
            ->update([

                'department_id' => $request->department_id,
                'program_name' => $request->program_name,
                'fees' => $request->fees,
                'duration' => $request->duration,
                'description' => $request->description

            ]);

        return back()->with('success','Program updated successfully');

    }


    /*
    |--------------------------------------------------------------------------
    | DELETE PROGRAM
    |--------------------------------------------------------------------------
    */

    public function destroy($id)
    {

        $institutionId = Session::get('institution_id');

        InstitutionProgram::where('institution_id',$institutionId)
            ->where('program_id',$id)
            ->delete();

        return back()->with('success','Program deleted successfully');

    }

}