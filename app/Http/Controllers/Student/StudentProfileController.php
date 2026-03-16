<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class StudentProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        // Splitting full_name back into first and last for the form inputs
        $nameParts = explode(' ', $user->full_name, 2);
        $firstName = $nameParts[0] ?? '';
        $lastName = $nameParts[1] ?? '';

        // Change line 20 to this:
        return view('frontend.studentPortal.dashboard.profile.personalInfoIndex', compact('user', 'firstName', 'lastName'));
    }
    public function update(Request $request)
    {
        $user = User::find(Auth::id());

        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:15',
            'gender' => 'nullable|string',
            'dob' => 'nullable|string',
            'blood_group' => 'nullable|string',
        ]);

        // Update fields
        $user->full_name = $request->first_name . ' ' . $request->last_name;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->gender = $request->gender;
        $user->dob = $request->dob;
        $user->blood_group = $request->blood_group;

        $user->save();

        return back()->with('success', 'Your profile has been updated successfully!');
    }

    public function academicIndex()
    {
        $user = Auth::user();

        // Database se academic data uthao
        $academic = DB::table('student_academics')->where('user_id', $user->id)->first();

        // View path check karna, aapka file name 'academicIndex' hai
        return view('frontend.studentPortal.dashboard.profile.academicIndex', compact('user', 'academic'));
    }

    public function academicUpdate(Request $request)
    {

        $user = \Auth::user();

        // Validation
        $request->validate([
            'ssc_percentage' => 'nullable|numeric|min:0|max:100', // Percentage 100 se zyada nahi ho sakti
            'hsc_percentage' => 'nullable|numeric|min:0|max:100',
            'degree_cgpa' => 'nullable|numeric|min:0|max:10',  // CGPA 10 se zyada nahi ho sakti
        ]);

        // Data to be saved
        $data = [
            'user_id' => $user->id,
            'ssc_school' => $request->ssc_school,
            'ssc_board' => $request->ssc_board,
            'ssc_year' => $request->ssc_year ? (int) $request->ssc_year : null,
            'ssc_percentage' => $request->ssc_percentage,

            'hsc_college' => $request->hsc_college,
            'hsc_board' => $request->hsc_board,
            'hsc_year' => $request->hsc_year ? (int) $request->hsc_year : null,
            'hsc_percentage' => $request->hsc_percentage,

            'degree_college' => $request->degree_college,
            'degree_name' => $request->degree_name,
            'degree_year' => $request->degree_year ? (int) $request->degree_year : null,
            'degree_cgpa' => $request->degree_cgpa,
            'skills' => $request->skills,
        ];

        // Magic Function: Update if exists, else Insert
        \DB::table('student_academics')->updateOrInsert(
            ['user_id' => $user->id],
            $data
        );

        return back()->with('success', 'Academic records updated successfully!');
    }

    // 1. Portfolio Page Load karne ke liye
    public function portfolioIndex()
    {
        $user = \Auth::user();
        $projects = \DB::table('student_projects')->where('user_id', $user->id)->get();

        // Skills fetch karo
        $skills = \DB::table('student_skills')->where('user_id', $user->id)->get();

        return view('frontend.studentPortal.dashboard.profile.portfolioIndex', compact('user', 'projects', 'skills'));
    }

    public function skillStore(Request $request)
    {
        $user = \Auth::user();

        $request->validate([
            'skill_name' => 'required',
            'level' => 'required',
            'type' => 'required'
        ]);

        \DB::table('student_skills')->insert([
            'user_id' => $user->id,
            'skill_name' => $request->skill_name,
            'type' => $request->type,
            'level' => $request->level,
            'created_at' => now(),
        ]);

        return back()->with('success', 'Skill added successfully!');
    }

    // 2. Naya Project Save karne ke liye
    public function projectStore(Request $request)
    {
        $user = \Auth::user();

        $request->validate([
            'project_title' => 'required|string|max:255',
            'tech_stack' => 'nullable|string|max:255',
            'project_link' => 'nullable|url',
        ]);

        \DB::table('student_projects')->insert([
            'user_id' => $user->id,
            'project_title' => $request->project_title,
            'project_description' => $request->project_description,
            'tech_stack' => $request->tech_stack,
            'project_link' => $request->project_link,
            'github_link'  => $request->github_link,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return back()->with('success', 'Bhai, project portfolio mein add ho gaya!');
    }
}
