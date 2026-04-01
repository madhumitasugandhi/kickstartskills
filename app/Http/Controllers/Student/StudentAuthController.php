<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\SkillsCategory;

class StudentAuthController extends Controller
{
    // Show the login page
    public function showLogin()
    {
        return view('frontend.studentPortal.auth.student_login');
    }

    // Handle Login logic
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            // Role 5 is Student
            if (Auth::user()->admin_role_id == 5) {
                $request->session()->regenerate();
                return redirect()->route('student.dashboard');
            }

            // Not a student? Kill session and kick back
            Auth::logout();
            return back()->withErrors(['email' => 'Access denied. Use the correct portal.']);
        }

        return back()->withErrors(['email' => 'The provided credentials do not match.']);
    }
    public function register(Request $request)
    {
        try {
            // 1. Validation
            $request->validate([
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:8|confirmed',
                'phone' => 'nullable|string',
                'country' => 'nullable|string',
                'institution_code' => 'nullable|string',
                'institution_name' => 'nullable|string|max:255',
                'skills_data' => 'nullable|string',
            ]);

            DB::beginTransaction();


            // 2. Create User
            $user = User::create([
                'full_name' => $request->first_name . ' ' . $request->last_name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'phone' => $request->phone,
                'country' => $request->country,
                'institution_code' => $request->institution_code,
                'institution_name' => $request->institution_name,
                'admin_role_id' => 5,
                'account_status' => 'active',
            ]);

            // 3. Save Skills from the JSON package sent by your JS
            if ($request->filled('skills_data')) {
                $skills = json_decode($request->skills_data, true);

                if (is_array($skills)) {
                    foreach ($skills as $skill) {
                        DB::table('student_skills')->insert([
                            'user_id' => $user->id,
                            'skill_name' => $skill['name'] ?? 'Unknown',
                            'type' => $skill['type'] ?? 'current',
                            'level' => $skill['level'] ?? 'Beginner',
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
                    }
                }
            }

            //     DB::commit();

            //     // Log them in immediately
            //     Auth::login($user);

            //     $skillsCategories = SkillsCategory::with('subcategories')->get();

            //     return redirect()->route('student.dashboard')->with('success', 'Welcome to KickStartSkills!');

            // } catch (\Exception $e) {
            //     DB::rollBack();
            //     // Log the error for your own debugging
            //     \Log::error('Registration Error: ' . $e->getMessage());
            //     return back()->withInput()->with('error', 'Registration failed. Please try again.');
            // }
            DB::commit();

            // 4. Log in and Redirect
            Auth::login($user);

            return redirect()->route('student.dashboard')->with('success', 'Welcome to KickStartSkills!');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Registration Error: ' . $e->getMessage());
            return back()->withInput()->with('error', 'Registration failed: ' . $e->getMessage());
        }
    }

    public function showRegister()
    {
        $skillsCategories = SkillsCategory::with('subcategories')->get();
        return view('frontend.studentPortal.auth.register', compact('skillsCategories'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('student.login');
    }
}
