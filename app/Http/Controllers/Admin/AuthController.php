<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request, $role)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // 🔹 Normalize role
        $role = strtolower(trim($role));

        // 🔹 Role Map
        $roleMap = [
            'admin' => 1,
            'hr' => 2,
            'mentor' => 3,
            'institution' => 4,
            'student' => 5,
        ];

        // 🔹 Attempt login
        if (!Auth::attempt($credentials, $request->filled('remember'))) {
            return back()->withErrors([
                'email' => 'Invalid email or password'
            ]);
        }

        $user = Auth::user();

        //  Account status check
        if ($user->account_status !== 'active') {
            Auth::logout();
            return back()->withErrors([
                'email' => "Your account is {$user->account_status}."
            ]);
        }

        //  Role validation
        if (!isset($roleMap[$role]) || (int)$user->admin_role_id !== $roleMap[$role]) {
            Auth::logout();

            return back()->withErrors([
                'email' => 'You are not authorized for this portal.'
            ]);
        }

        //  Store role in session (IMPORTANT )
        $request->session()->put('role', $role);

        $request->session()->regenerate();

        return $this->redirectUser($user);
    }

    private function redirectUser($user)
    {
        return match ($user->admin_role_id) {
            1 => redirect()->route('admin.dashboard'),
            2 => redirect()->route('hr.dashboard'),
            3 => redirect()->route('mentor.dashboard'),
            4 => redirect()->route('institution.dashboard'),
            5 => redirect()->route('student.dashboard'),
            default => redirect()->route('login.dynamic', ['role' => 'student']),
        };
    }

    public function logout(Request $request)
    {
        //  Get role BEFORE logout
        $role = $request->session()->get('role', 'student');

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        //  Redirect to SAME role login
        return redirect()->route('login.dynamic', ['role' => $role]);
    }
}