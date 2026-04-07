<?php

namespace App\Http\Controllers\Mentor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Models\SkillsCategory;

class MentorProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $profile = DB::table('mentor_profiles')->where('user_id', $user->id)->first();
        $categories = SkillsCategory::with('subcategories')->get();
        $nameParts = explode(' ', $user->full_name, 2);
        $firstName = $nameParts[0] ?? '';
        $lastName = $nameParts[1] ?? '';

        return view('frontend.mentorPortal.dashboard.general.profile', compact('user', 'profile', 'firstName', 'lastName', 'categories'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
        ]);

        $user->update([
            'full_name' => $request->first_name . ' ' . $request->last_name,
            'email' => $request->email,
        ]);

        DB::table('mentor_profiles')->updateOrInsert(
            ['user_id' => $user->id],
            [
                'phone' => $request->phone,
                'bio' => $request->bio,
                'expertise_area' => $request->expertise_area, // <-- YE LINE MISSING THI
                'years_of_experience' => $request->years_of_experience,
                'linkedin_url' => $request->linkedin_url,
                'github_url' => $request->github_url,
                'portfolio_url' => $request->portfolio_url,
                'updated_at' => now(),
            ]
        );

        return back()->with('success', 'Profile updated successfully!');
    }
}
