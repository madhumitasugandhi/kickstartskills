<?php

namespace App\Http\Controllers\Institution;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Institution\Elective;
use App\Models\Institution\InstitutionDepartment;

class ElectiveProgramController extends Controller
{
    /**
     * List Programs
     */
    public function index()
    {
        $institutionId = session('institution_id');

        $programs = Elective::with('department')
            ->orderBy('id', 'desc')
            ->get();

        return response()->json($programs);
    }

    /**
     * Store Program
     */
    public function store(Request $request)
    {
        try {
    
            Elective::create([
                'name' => $request->name,
                'department_id' => $request->department_id,
                'duration' => $request->duration,
                'fees' => $request->fees,
                'description' => $request->description,
                'status' => 1
            ]);
    
            return response()->json([
                'status' => true
            ]);
    
        } catch (\Exception $e) {
    
            return response()->json([
                'status' => false,
                'error' => $e->getMessage()
            ]);
        }
    }
    /**
     * Edit Program
     */
    public function edit($id)
    {
        $program = Elective::findOrFail($id);
        return response()->json($program);
    }

    /**
     * Update Program
     */
    public function update(Request $request, $id)
    {
        $program = Elective::findOrFail($id);

        $program->update([
            'name' => $request->name,
            'department_id' => $request->department_id,
            'duration' => $request->duration,
            'fees' => $request->fees,
            'description' => $request->description
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Program updated successfully'
        ]);
    }

    /**
     * Delete Program
     */
    public function destroy($id)
    {
        $program = Elective::findOrFail($id);
        $program->delete();

        return response()->json([
            'status' => true,
            'message' => 'Program deleted successfully'
        ]);
    }

    public function departments()
{
    $institutionId = session('institution_id');

    $departments = InstitutionDepartment::where('institution_id', $institutionId)
        ->get();

    return response()->json($departments);
}

public function stats()
{
    return response()->json([
        'total' => Elective::count(),
        'active' => Elective::where('status',1)->count(),
        'inactive' => Elective::where('status',0)->count()
    ]);
}

public function changeStatus(Request $request)
{
    $program = Elective::findOrFail($request->id);

    $program->status = !$program->status;
    $program->save();

    return response()->json([
        'status' => true
    ]);
}

}