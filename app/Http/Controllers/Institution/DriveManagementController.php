<?php

namespace App\Http\Controllers\Institution;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class DriveManagementController extends Controller
{
    public function index()
    {
        $institutionId = session('institution_id');

        // Pending Approvals
        $pendingDrives = DB::table('drive_institute_approvals as dia')
            ->join('drives as d', 'd.drive_id', '=', 'dia.drive_id')
            ->where('dia.institution_id', $institutionId)
            ->where('dia.status', 0)
            ->select('d.*', 'dia.id as approval_id')
            ->get();

        // Approved Drives
        $approvedDrives = DB::table('drive_institute_approvals as dia')
            ->join('drives as d', 'd.drive_id', '=', 'dia.drive_id')
            ->where('dia.institution_id', $institutionId)
            ->where('dia.status', 1)
            ->select('d.*')
            ->get();

             // Students list (IMPORTANT)
             $students = DB::table('users')
             ->where('institution_code', session('institution_code'))
             ->where('admin_role_id', 5) // only students
             ->select('id','full_name','email')
             ->orderBy('full_name')
             ->get();

        // Counts
        $total = DB::table('drive_institute_approvals')
            ->where('institution_id', $institutionId)
            ->count();

        $approved = DB::table('drive_institute_approvals')
            ->where('institution_id', $institutionId)
            ->where('status', 1)
            ->count();

        $pending = DB::table('drive_institute_approvals')
            ->where('institution_id', $institutionId)
            ->where('status', 0)
            ->count();

        $blocked = DB::table('drive_institute_approvals')
            ->where('institution_id', $institutionId)
            ->where('status', 2)
            ->count();

        return view(
            'frontend.institutionPortal.dashboard.core-management.drivemanagement.index',
            compact('pendingDrives','approvedDrives','students','total','approved','pending','blocked')
        );
    }

    public function approve(Request $request, $id)
{
    if(!$request->students){
        return back()->with('error','Select students first');
    }

    // Update approval
    DB::table('drive_institute_approvals')
        ->where('id', $id)
        ->update([
            'status' => 1,
            'approved_at' => now()
        ]);

    $approval = DB::table('drive_institute_approvals')->where('id', $id)->first();
    $driveId = $approval->drive_id;
    $institutionId = $approval->institution_id;

    // Insert exam schedule
    DB::table('drive_assessments')->insert([
        'drive_id' => $driveId,
        'institution_id' => $institutionId,
        'exam_date' => $request->exam_date,
        'start_time' => $request->start_time,
        'end_time' => $request->end_time,
        'duration_minutes' => $request->duration
    ]);

    $visibleAt = \Carbon\Carbon::parse($request->exam_date . ' ' . $request->start_time)
                ->subMinutes(30);
    DB::table('drive_visible_students')->insert([
        'drive_id' => $driveId,
        'student_id' => json_encode($request->students),
        'is_visible' => 0,
        'visible_at' => $visibleAt
    ]);

    return back()->with('success','Drive Approved and Exam Scheduled');
}

    public function reject($id)
    {
        DB::table('drive_institute_approvals')
            ->where('id', $id)
            ->update([
                'status' => 2
            ]);

        return back()->with('error','Drive Blocked');
    }
}