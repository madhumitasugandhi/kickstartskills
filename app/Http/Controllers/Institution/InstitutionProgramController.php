<?php

namespace App\Http\Controllers\Institution;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Institution\InstitutionProgram;


class InstitutionProgramController extends Controller
{
    /**
     * Get Programs List
     */
    public function index()
    {
        $institutionId = session('institution_id');

        $programs = InstitutionProgram::with(['department', 'educationType'])
            ->where('institution_id', $institutionId)
            ->orderBy('program_name')
            ->get();

        return $programs;
    }

    /**
     * Store Program
     */
    public function store(Request $request)
    {
        $institutionId = session('institution_id');

        InstitutionProgram::create([
            'institution_id'    => $institutionId,
            'department_id'     => $request->department_id,
            'education_type_id' => $request->education_type_id,
            'program_name'      => $request->program_name,
            'coordinator'       => $request->coordinator,
            'semesters'         => $request->semesters,
            'max_intake'        => $request->max_intake,
            'duration'          => $request->duration,
            'description'       => $request->description,
            'status'            => 1,
        ]);

        return redirect()->back()->with('success', 'Program Created');
    }

    /**
     * Edit Program
     */
    public function edit($id)
{
    return InstitutionProgram::with(['department','educationType'])
        ->findOrFail($id);
}

    /**
     * Update Program
     */
    public function update(Request $request, $id)
    {
        $program = InstitutionProgram::findOrFail($id);

        $program->update([
            'department_id'     => $request->department_id,
            'education_type_id' => $request->education_type_id,
            'program_name'      => $request->program_name,
            'coordinator'       => $request->coordinator,
            'semesters'         => $request->semesters,
            'max_intake'        => $request->max_intake,
            'duration'          => $request->duration,
            'description'       => $request->description,
            'status'            => $request->status,
        ]);

        return redirect()->back()->with('success', 'Program Updated');
    }

    /**
     * Delete Program
     */
    public function destroy($id)
    {
        InstitutionProgram::destroy($id);
        return redirect()->back()->with('success', 'Program Deleted');
    }
}