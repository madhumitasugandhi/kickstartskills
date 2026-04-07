<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Models\SkillsCategory;

class StudentProfileController extends Controller
{
    public function index()
    {
        // Eager load relationships for cleaner code
        $user = Auth::user();

        // Student Profile ka data fetch karo
        $profile = DB::table('student_profiles')->where('user_id', $user->id)->first();

        // Splitting full_name
        $nameParts = explode(' ', $user->full_name, 2);
        $firstName = $nameParts[0] ?? '';
        $lastName = $nameParts[1] ?? '';

        return view('frontend.studentPortal.dashboard.profile.personalInfoIndex', compact('user', 'firstName', 'lastName', 'profile'));
    }

    public function update(Request $request)
    {
        $user = User::find(Auth::id());

        // Validation wahi rahegi
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:15',
            'gender' => 'nullable|string',
            'dob' => 'nullable|date',
            'blood_group' => 'nullable|string',
        ]);

        // PART 1: Core details ko 'users' table mein update karo
        $user->update([
            'full_name' => $request->first_name . ' ' . $request->last_name,
            'email' => $request->email,
        ]);

        DB::table('student_profiles')->updateOrInsert(
            ['user_id' => $user->id], // Is ID ke bande ka data update karo
            [
                'phone' => $request->phone,
                'gender' => $request->gender,
                'dob' => $request->dob,
                'blood_group' => $request->blood_group,
                'updated_at' => now(),
            ]
        );

        return back()->with('success', 'Profile updated successfully!');
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

        $user = Auth::user();

        // Validation
        $request->validate([
            'ssc_percentage' => 'nullable|numeric|min:0|max:100', // Percentage 100 se zyada nahi ho sakti
            'hsc_percentage' => 'nullable|numeric|min:0|max:100',
            'degree_cgpa' => 'nullable|numeric|min:0|max:10',
            'masters_cgpa' => 'nullable|numeric|min:0|max:10',  // CGPA 10 se zyada nahi ho sakti
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

            'masters_college' => $request->masters_college,
            'masters_name' => $request->masters_name,
            'masters_year' => $request->masters_year ? (int) $request->masters_year : null,
            'masters_cgpa' => $request->masters_cgpa,

            'skills' => $request->skills,
            'updated_at' => now(), // Good practice to track updates
        ];

        // Magic Function: Update if exists, else Insert
        DB::table('student_academics')->updateOrInsert(
            ['user_id' => $user->id],
            $data
        );

        return back()->with('success', 'Academic records updated successfully!');
    }

    // 1. Portfolio Page
    public function portfolioIndex()
    {
        $user = Auth::user();

        // 1. Fetch Projects
        $projects = DB::table('student_projects')
            ->where('user_id', $user->id)
            ->get();

        // 2. Fetch Skills
        $skills = DB::table('student_skills')
            ->where('user_id', $user->id)
            ->get();

        // 3. Fetch Categories for the Modal
        $categories = \App\Models\SkillsCategory::with('subcategories')->get();

        // 4. Fetch Profile (The fix for your error)
        $profile = DB::table('student_profiles')
            ->where('user_id', $user->id)
            ->first(); // Returns null if no record found

        $achievements = DB::table('student_achievements')->where('user_id', $user->id)->get();
        // Pass 'profile' into the compact array
        return view(
            'frontend.studentPortal.dashboard.profile.portfolioIndex',
            compact('user', 'projects', 'skills', 'categories', 'profile', 'achievements')
        );
    }

    public function profileUpdate(Request $request)
    {
        // --- DEBUG START ---
        // If you click save and see a black screen with "File Found",
        // it means the HTML is working. If you see "No File", the HTML is still broken.
        if ($request->hasFile('resume_file')) {
            // dd('File Found!', $request->file('resume_file'));
        } else {
            // dd('No File Detected in Request', $request->all());
        }
        // --- DEBUG END ---

        $user = Auth::user();
        $data = [
            'bio' => $request->bio,
            'linkedin_url' => $request->linkedin_url,
            'github_url' => $request->github_url,
            'updated_at' => now(),
        ];

        if ($request->hasFile('resume_file')) {
            $file = $request->file('resume_file');
            $fileName = 'resume_' . $user->id . '_' . time() . '.' . $file->getClientOriginalExtension();

            $destinationPath = public_path('uploads/resumes');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }

            $file->move($destinationPath, $fileName);

            // This line actually puts the filename into the database update
            $data['resume_url'] = $fileName;
        }

        DB::table('student_profiles')->updateOrInsert(
            ['user_id' => $user->id],
            $data
        );

        return back()->with('success', 'Profile updated!');
    }
    public function skillStore(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'skill_name' => 'required',
            'level' => 'required',
            'type' => 'required'
        ]);

        DB::table('student_skills')->insert([
            'user_id' => $user->id,
            'skill_name' => $request->skill_name,
            'type' => $request->type,
            'level' => $request->level,
            'created_at' => now(),
        ]);

        return back()->with('success', 'Skill added successfully!');
    }

    public function skillDelete($id)
    {
        DB::table('student_skills')
            ->where('id', $id)
            ->where('user_id', Auth::id())
            ->delete();

        return back()->with('success', 'Skill removed.');
    }

    // 2. For save new project
    public function projectStore(Request $request)
    {
        $user = Auth::user();

        DB::table('student_projects')->insert([
            'user_id' => $user->id,
            'project_title' => $request->project_title,
            'project_description' => $request->project_description,
            'tech_stack' => $request->tech_stack,
            'project_link' => $request->project_link,
            'github_link' => $request->github_link,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return back()->with('success', 'Project added correctly!');
    }

    public function projectDelete($id)
    {
        $user = Auth::user();

        // Ensure the project belongs to the logged-in user before deleting
        DB::table('student_projects')
            ->where('id', $id)
            ->where('user_id', $user->id)
            ->delete();

        return back()->with('success', 'Project removed from your portfolio.');
    }

    public function achievementStore(Request $request)
    {
        DB::table('student_achievements')->insert([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'organization' => $request->organization,
            'description' => $request->description,
            'earned_at' => now(),
        ]);

        return back()->with('success', 'Achievement added successfully!');
    }

    public function achievementDelete($id)
    {
        DB::table('student_achievements')
            ->where('id', $id)
            ->where('user_id', Auth::id())
            ->delete();

        return back()->with('success', 'Achievement removed!');
    }
}
