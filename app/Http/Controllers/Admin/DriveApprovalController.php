<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Models\Mentor\Drive;

class DriveApprovalController extends Controller
{
    public function index(Request $request)
    {
        $query = Drive::query();
    
        if($request->search){
            $query->where('drive_title','like','%'.$request->search.'%');
        }
    
        if($request->status == 'pending'){
            $query->where('status',1);
        }
    
        if($request->status == 'approved'){
            $query->where('status',2);
        }
    
        if($request->status == 'rejected'){
            $query->where('status',3);
        }
    
        // Filtered drives list
        $drives = $query->latest()->get();
    
        // Counts for dashboard
        $pendingCount = Drive::where('status',1)->count();
        $approvedCount = Drive::where('status',2)->count();
        $rejectedCount = Drive::where('status',3)->count();
    
        $total = Drive::count();
        $mentorDrives = Drive::whereNotNull('mentor_id')->count();
        $activeDrives = Drive::where('status',2)->count();
    
        return view('frontend.adminPortal.dashboard.driveOversight',
            compact(
                'drives',
                'pendingCount',
                'approvedCount',
                'rejectedCount',
                'total',
                'mentorDrives',
                'activeDrives'
            )
        );
    }


    public function approve($id)
    {
        $drive = Drive::findOrFail($id);
        $drive->status = 2;
        $drive->approved_by = auth()->id();
        $drive->approved_at = now();
        $drive->save();
    
        // Insert institutes into approval table
        $institutes = DB::table('drive_institutions')
            ->where('drive_id', $id)
            ->pluck('institution_id');
    
        foreach ($institutes as $inst) {
            DB::table('drive_institute_approvals')->insert([
                'drive_id' => $id,
                'institution_id' => $inst,
                'status' => 0
            ]);
        }
    
        return back()->with('success','Drive Approved');
    }

    public function reject(Request $request, $id)
    {
        $drive = Drive::findOrFail($id);
        $drive->status = 3;
        $drive->rejection_reason = $request->reason;
        $drive->save();

        return back()->with('error','Drive Rejected');
    }

    public function show($id)
    {
        $drive = Drive::findOrFail($id);
        return response()->json($drive);
    }
}