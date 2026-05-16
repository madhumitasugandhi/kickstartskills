<?php


namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request, $role)
{     dd('Controller hit', $role);
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    // 🔹 Step 1: Attempt login
    if (!Auth::attempt($credentials, $request->filled('remember'))) {
        dd('Auth failed'); 
        return back()->withErrors([
            'email' => 'Invalid email or password'
        ]);
    }

    $user = Auth::user();

    // 🔹 Normalize role (VERY IMPORTANT)
    $role = strtolower(trim($role));

    // 🔹 Role Map
    $roleMap = [
        'admin' => 1,
        'hr' => 2,
        'mentor' => 3,
        'institution' => 4,
        'student' => 5,
    ];

    // 🔥 DEBUG BLOCK (THIS WILL SHOW REAL ISSUE)
    dd([
        'url' => request()->fullUrl(),
        'raw_role_from_url' => request()->route('role'),
        'normalized_role' => $role,
        'role_exists_in_map' => isset($roleMap[$role]),
        'expected_role_id' => $roleMap[$role] ?? null,
        'db_role_raw' => $user->admin_role_id,
        'db_role_int' => (int) $user->admin_role_id,
        'match_result' => (int)$user->admin_role_id == ($roleMap[$role] ?? null),
        'strict_match' => (int)$user->admin_role_id === ($roleMap[$role] ?? null),
        'user_full' => $user,
    ]);

    // ✅ Account status check
    if ($user->account_status !== 'active') {
        Auth::logout();
        return back()->withErrors([
            'email' => "Your account is {$user->account_status}."
        ]);
    }

    // ✅ Role validation
    if (!isset($roleMap[$role]) || (int)$user->admin_role_id !== $roleMap[$role]) {
        Auth::logout();

        return back()->withErrors([
            'email' => 'You are not authorized for this portal.'
        ]);
    }

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
        default => redirect('/login'),
    };
}

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}