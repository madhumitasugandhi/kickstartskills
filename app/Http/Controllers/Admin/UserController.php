<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Services\EmailService;
use Illuminate\Support\Facades\Log;
use App\Models\Institution\Institution;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        // 1. Search Logic
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('full_name', 'like', "%$search%")
                    ->orWhere('email', 'like', "%$search%");
            });
        }

        // 2. Role Filtration
        if ($request->filled('filter') && $request->filter !== 'All') {
            $query->where('admin_role_id', $request->filter);
        }

        // 3. Status Filtration
        if ($request->filled('status') && $request->status !== 'All') {
            $query->where('account_status', $request->status);
        }

        $users = $query->with('institution')->get();
        $allUsersCount = User::count();

        // 4. Calculate Stats
        $stats = [
            'total' => $allUsersCount,
            'active' => User::where('account_status', 'active')->count(),
            'suspended' => User::where('account_status', 'suspended')->count(),
            'deactivated' => User::where('account_status', 'deactivated')->count(),
            'pending' => User::where('account_status', 'pending')->count(),
            'new_this_month' => User::whereMonth('created_at', date('m'))->count(),
            'online_now' => rand(2, 8),

            'admin_count' => User::where('admin_role_id', 1)->count(),
            'hr_count' => User::where('admin_role_id', 2)->count(),
            'mentor_count' => User::where('admin_role_id', 3)->count(),
            'inst_count' => User::where('admin_role_id', 4)->count(),
            'student_count' => User::where('admin_role_id', 5)->count(),

            'admin_pct' => $allUsersCount > 0 ? (User::where('admin_role_id', 1)->count() / $allUsersCount) * 100 : 0,
            'hr_pct' => $allUsersCount > 0 ? (User::where('admin_role_id', 2)->count() / $allUsersCount) * 100 : 0,
            'mentor_pct' => $allUsersCount > 0 ? (User::where('admin_role_id', 3)->count() / $allUsersCount) * 100 : 0,
            'inst_pct' => $allUsersCount > 0 ? (User::where('admin_role_id', 4)->count() / $allUsersCount) * 100 : 0,
            'student_pct' => $allUsersCount > 0 ? (User::where('admin_role_id', 5)->count() / $allUsersCount) * 100 : 0,

        ];

        $recentActivities = User::latest()->take(5)->get();

        return view('frontend.adminPortal.dashboard.userManagement', compact('users', 'stats', 'recentActivities'));
    }

    public function store(Request $request, EmailService $emailService)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'admin_role_id' => 'required|integer',
            'account_status' => 'required|in:active,deactivated,suspended,pending',
            'mentor_id' => 'nullable|exists:users,id',
            'institution_id' => 'nullable|integer',
        ]);

        // FIX: Variable assign kiya $user mein
        $user = User::create([
            'full_name' => $request->full_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'admin_role_id' => $request->admin_role_id,
            'account_status' => $request->account_status,
            'mentor_id' => $request->mentor_id,
            'institution_id' => $request->institution_id,
        ]);

        $roles = [
            1 => 'Admin',
            2 => 'HR/Staff',
            3 => 'Mentor',
            4 => 'Institution',
            5 => 'Student'
        ];

        $roleName = $roles[$user->admin_role_id] ?? 'User';

        try {
            $emailService->sendHtmlEmail(
                $user->email,
                "Welcome to KickStartSkills - Your $roleName Account is Ready",
                'emails.student_welcome',
                [
                    'name' => $user->full_name,
                    'email' => $user->email,
                    'password' => $request->password, // Plain password email ke liye
                    'role' => $roleName
                ]
            );
        } catch (\Exception $e) {
            Log::error("Mail Error: " . $e->getMessage());
            // Mail fail bhi ho jaye toh registration na ruke
        }

        return redirect()->route('admin.users')->with('success', 'User added successfully and credentials sent!');
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'admin_role_id' => 'required|integer',
            'account_status' => 'required|in:active,deactivated,suspended,pending',
            'mentor_id' => 'nullable|exists:users,id',
            
        ]);

        $user->update([
            'full_name' => $request->full_name,
            'email' => $request->email,
            'admin_role_id' => $request->admin_role_id,
            'account_status' => $request->account_status,
            'mentor_id' => $request->mentor_id,

        ]);

        if ($request->filled('password')) {
            $user->update([
                'password' => Hash::make($request->password)
            ]);
        }

        // 🔥 FULL SYNC FOR INSTITUTION
        if ($user->admin_role_id == 4 && $user->institution) {
            $user->institution->update([
                'status' => $request->account_status,
                'email' => $request->email,
                'institution_name' => $request->full_name
            ]);
        }

        return redirect()->route('admin.users')->with('success', 'User updated successfully!');
    }
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if ($user->id === auth()->id()) {
            return redirect()->back()->with('error', 'You cannot delete your own account!');
        }

        $user->delete();

        return redirect()->route('admin.users')->with('success', 'User removed successfully.');
    }
}
