<?php

namespace App\Http\Controllers\Mentor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Models\SkillsCategory;
use Illuminate\Support\Facades\File;

class MentorProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $profile = DB::table('mentor_profiles')->where('user_id', $user->id)->first();
        $categories = SkillsCategory::with('subcategories')->get();

        // Name split logic for first and last name
        $nameParts = explode(' ', $user->full_name, 2);
        $firstName = $nameParts[0] ?? '';
        $lastName = $nameParts[1] ?? '';

        return view('frontend.mentorPortal.dashboard.general.profile', compact('user', 'profile', 'firstName', 'lastName', 'categories'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $imageName = $profile->profile_image ?? null;
        // 1. Validation
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'available_days' => 'nullable|array',
            'resume' => 'nullable|mimes:pdf,doc,docx|max:2048', // File size limit 2MB
        ]);

        // 2. User table update
        $user->update([
            'full_name' => $request->first_name . ' ' . $request->last_name,
            'email' => $request->email,
        ]);

        // 3. Handle Resume Path logic
        $profile = DB::table('mentor_profiles')->where('user_id', $user->id)->first();
        $resumePath = $profile->resume_url ?? null;
        if ($request->hasFile('profile_image')) {
            $file = $request->file('profile_image');
            $imageName = 'mentor_' . $user->id . '_' . time() . '.' . $file->getClientOriginalExtension();

            // Public folder path
            $destinationPath = public_path('uploads/mentor_profiles');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }

            $file->move($destinationPath, $imageName);
        }

        // 4. Update or Insert Mentor Profile
        DB::table('mentor_profiles')->updateOrInsert(
            ['user_id' => $user->id],
            [
                'profile_image' => $imageName,
                'phone' => $request->phone,
                'bio' => $request->bio,
                'resume_url' => $resumePath,
                'portfolio_url' => $request->portfolio_url,
                'years_of_experience' => $request->years_of_experience,
                'max_students' => $request->max_students,
                'linkedin_url' => $request->linkedin_url,
                'github_url' => $request->github_url,
                'specializations' => $request->specializations ? json_encode($request->specializations) : null,
                'technical_skills' => $request->technical_skills ? json_encode($request->technical_skills) : null,
                'certifications' => $request->certifications ? json_encode($request->certifications) : null,
                'timezone' => $request->timezone,
                'start_time' => $request->start_time,
                'end_time' => $request->end_time,
                'available_days' => $request->available_days ? json_encode($request->available_days) : null,
                'updated_at' => now(),
            ]
        );

        return back()->with('success', 'Profile updated successfully!');
    }
}
