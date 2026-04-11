<?php

namespace App\Http\Controllers\Mentor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Institution\Institution;
use App\Models\Institution\CourseType;
use App\Models\Institution\InstitutionDepartment;
use App\Models\SkillsCategory;
use App\Models\SkillSubcategory;
use App\Models\Mentor\Drive;
use App\Models\Mentor\DriveYear;

class DriveController extends Controller
{
    public function index(Request $request)
    {
        $query = Drive::query();
    
        // Search
        if($request->search){
            $query->where('drive_title','like','%'.$request->search.'%');
        }
    
        // Status Filter
        if($request->status == 'draft'){
            $query->where('status',0);
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
    
        // Sorting
        if($request->sort == 'oldest'){
            $query->orderBy('created_at','asc');
        } else {
            $query->orderBy('created_at','desc');
        }
    
        $drives = $query->get();
    
        // Counts
        $total = Drive::count();
    $draft = Drive::where('status',0)->count();
    $pending = Drive::where('status',1)->count();
    $approved = Drive::where('status',2)->count();
    $rejected = Drive::where('status',3)->count();

    return view('frontend.mentorPortal.dashboard.driveManagement.manage',
        compact('drives','total','draft','pending','approved','rejected')
    );
    }
    public function create()
{
    $institutions = Institution::all();
    $courses = CourseType::all();
    $departments = InstitutionDepartment::all();
    $categories = SkillsCategory::all();

    return view(
        'frontend.mentorPortal.dashboard.driveManagement.create',
        compact('institutions','courses','departments','categories')
    );
}

public function store(Request $request)
{
    $basic = session('drive_basic');
    $eligibility = session('drive_eligibility');
    $timeline = session('drive_timeline');
    $package = $request->all();

    $status = ($request->action == 'publish') ? 1 : 0;

    $drive = Drive::create([
        'mentor_id' => auth()->id(),

        'drive_title' => $basic['drive_title'] ?? null,
        'drive_description' => $basic['drive_description'] ?? null,
        'job_description' => $basic['job_description'] ?? null,
        'drive_type' => $basic['drive_type'] ?? null,
        'mentorship_level' => $basic['mentorship_level'] ?? null,
        'location' => $basic['location'] ?? null,
        'work_mode' => $basic['work_mode'] ?? null,
        'remote_allowed' => $basic['remote_allowed'] ?? 0,
        'positions' => $basic['positions'] ?? null,
        'hours_per_week' => $basic['hours_per_week'] ?? null,

        'min_cgpa' => $eligibility['min_cgpa'] ?? null,
        'min_attendance' => $eligibility['min_attendance'] ?? null,

        'application_start' => $timeline['application_start'] ?? null,
        'application_end' => $timeline['application_end'] ?? null,
        'internship_start' => $timeline['internship_start'] ?? null,
        'internship_end' => $timeline['internship_end'] ?? null,
        'duration_weeks' => $timeline['duration_weeks'] ?? null,
        'flexible_duration' => $timeline['flexible_duration'] ?? 0,

        'is_paid' => $package['is_paid'] ?? 0,
        'amount' => $package['amount'] ?? null,
        'currency' => $package['currency'] ?? null,
        'payment_frequency' => $package['payment_frequency'] ?? null,
        'payment_terms' => $package['payment_terms'] ?? null,

        'status' => $status
    ]);

    // Attach pivot
    $drive->institutions()->sync(explode(',', $eligibility['institutions'] ?? ''));
$drive->courses()->sync(explode(',', $eligibility['courses'] ?? ''));
$drive->departments()->sync(explode(',', $eligibility['departments'] ?? ''));
    if(isset($basic['skills'])){
        $skills = explode(',', $basic['skills']);
        $drive->skills()->sync($skills);
    }
    // Years
    if(isset($eligibility['years'])){
        $years = explode(',', $eligibility['years']);
        foreach ($years as $year) {
            DriveYear::create([
                'drive_id' => $drive->drive_id,
                'year' => $year
            ]);
        }
    }

    // Clear session
    session()->forget([
        'drive_basic',
        'drive_eligibility',
        'drive_timeline'
    ]);

    return redirect()->route('mentor.drive.manage')
        ->with('success', 'Drive saved successfully');
}

    public function show($id)
    {
        $drive = Drive::findOrFail($id);
        return view('frontend.mentorPortal.dashboard.driveManagement.show', compact('drive'));
    }

    public function edit($id)
    {
        $drive = Drive::findOrFail($id);
        return view('frontend.mentorPortal.dashboard.driveManagement.edit', compact('drive'));
    }

    
    public function destroy($id)
    {
        Drive::destroy($id);
        return back();
    }

    public function getDrive($id)
{
    $drive = Drive::find($id);
    return response()->json($drive);
}

    public function saveBasicInfo(Request $request)
{
    session(['drive_basic' => $request->all()]);
    return response()->json(['status' => 'saved']);
}

public function saveEligibility(Request $request)
{
    session(['drive_eligibility' => $request->all()]);
    return response()->json(['status' => 'saved']);
}

public function saveTimeline(Request $request)
{
    session(['drive_timeline' => $request->all()]);
    return response()->json(['status' => 'saved']);
}
public function getSkills($id)
{
    $skills = SkillSubcategory::where('skills_category_id', $id)->get();
    return response()->json($skills);
}

public function publish($id)
{
    $drive = Drive::find($id);
    $drive->status = 1; // Pending
    $drive->published_at = now();
    $drive->save();

    return back()->with('success','Drive sent for admin approval');
}

}