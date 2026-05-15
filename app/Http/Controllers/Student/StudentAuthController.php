<?php

namespace App\Http\Controllers\Student;

use App\Services\EmailService;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Auth\AuthController;
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
     // Login Logic
     public function login(Request $request)
     {
         return app(AuthController::class)
             ->login($request, 5); // student role
     }
     

    public function register(Request $request, EmailService $emailService)
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
                'password' => $request->password,
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

            $emailService->sendHtmlEmail(
                $user->email,
                'Welcome to KickStartSkills!',
                'emails.student_welcome', // Ye view file banani padegi
                [
                    'name' => $user->full_name,
                    'email' => $user->email,
                    'password' => $request->password,
                    'role' => 'Student'
                ]
            );
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
