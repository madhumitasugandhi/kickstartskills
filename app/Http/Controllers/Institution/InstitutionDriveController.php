<?php

namespace App\Http\Controllers\Institution;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Institution\InstitutionDrive;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class InstitutionDriveController extends Controller
{
    /**
     * List all drives
     */
    public function index()
{
    $institutionId = session('institution_id');

    $drives = InstitutionDrive::where('institution_id', $institutionId)
                ->orderBy('id', 'desc')
                ->get();

    return response()->json($drives);
}

    /**
     * Store new drive
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'drive_name' => 'required|max:255',
            'company_name' => 'required|max:255',
            'drive_date' => 'nullable|date',
            'interview_start_date' => 'nullable|date',
            'interview_end_date' => 'nullable|date',
            'application_deadline' => 'nullable|date',
            'stipend' => 'nullable|numeric',
            'location' => 'nullable|max:255',
            'description' => 'nullable'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }

        DB::beginTransaction();
        try {

            InstitutionDrive::create([
                'drive_name' => $request->drive_name,
                'description' => $request->description,
                'company_name' => $request->company_name,
                'drive_date' => $request->drive_date,
                'interview_start_date' => $request->interview_start_date,
                'interview_end_date' => $request->interview_end_date,
                'application_deadline' => $request->application_deadline,
                'stipend' => $request->stipend,
                'location' => $request->location,
                'status' => 'draft',
                'institution_id' => session('institution_id')
            ]);

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Internship Drive Created Successfully'
            ]);

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'status' => false,
                'message' => 'Something went wrong'
            ]);
        }
    }

    /**
     * Edit drive
     */
    public function edit($id)
    {
        $drive = InstitutionDrive::find($id);
        return response()->json($drive);
    }

    /**
     * Update drive
     */
    public function update(Request $request, $id)
    {
        $drive = InstitutionDrive::find($id);

        if (!$drive) {
            return response()->json([
                'status' => false,
                'message' => 'Drive not found'
            ]);
        }

        $drive->update([
            'drive_name' => $request->drive_name,
            'description' => $request->description,
            'company_name' => $request->company_name,
            'drive_date' => $request->drive_date,
            'interview_start_date' => $request->interview_start_date,
            'interview_end_date' => $request->interview_end_date,
            'application_deadline' => $request->application_deadline,
            'stipend' => $request->stipend,
            'location' => $request->location,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Drive Updated Successfully'
        ]);
    }

    /**
     * Delete drive
     */
    public function destroy($id)
    {
        $drive = InstitutionDrive::find($id);

        if (!$drive) {
            return response()->json([
                'status' => false,
                'message' => 'Drive not found'
            ]);
        }

        $drive->delete();

        return response()->json([
            'status' => true,
            'message' => 'Drive Deleted Successfully'
        ]);
    }

    /**
     * Change drive status
     */
    public function changeStatus(Request $request)
    {
        $drive = InstitutionDrive::find($request->id);

        if (!$drive) {
            return response()->json([
                'status' => false
            ]);
        }

        $drive->status = $request->status;
        $drive->save();

        return response()->json([
            'status' => true,
            'message' => 'Status Updated'
        ]);
    }
}