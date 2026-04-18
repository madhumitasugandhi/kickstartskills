<?php

namespace App\Http\Controllers\HR;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class HrProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $profile = DB::table('hr_profiles')->where('user_id', $user->id)->first();

        // Name split for form fields
        $nameParts = explode(' ', $user->full_name, 2);
        $firstName = $nameParts[0] ?? '';
        $lastName = $nameParts[1] ?? '';

        return view('frontend.hrPortal.dashboard.profile.index', compact('user', 'profile', 'firstName', 'lastName'));
    }

    public function update(Request $request)
    {
        $user = User::find(Auth::id());
        $profile = DB::table('hr_profiles')->where('user_id', $user->id)->first();
        $imageName = $profile->profile_image ?? null;

        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'company_name' => 'nullable|string|max:255',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // 1. Update Users Table
        $user->update([
            'full_name' => $request->first_name . ' ' . $request->last_name,
            'email' => $request->email,
        ]);

        // 2. Handle Image Upload
        if ($request->hasFile('profile_image')) {
            $file = $request->file('profile_image');
            $imageName = 'hr_' . $user->id . '_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/hr_profiles'), $imageName);
        }

        // 3. Update hr_profiles Table
        DB::table('hr_profiles')->updateOrInsert(
            ['user_id' => $user->id],
            [
                'phone' => $request->phone,
                'designation' => $request->designation,
                'linkedin_url' => $request->linkedin_url,
                'office_location' => $request->office_location,
                'company_name' => $request->company_name,
                'company_website' => $request->company_website,
                'industry_type' => $request->industry_type,
                'recruitment_focus' => $request->recruitment_focus,
                'profile_image' => $imageName,
            ]
        );

        return back()->with('success', 'Profile updated successfully!');
    }
    
}
