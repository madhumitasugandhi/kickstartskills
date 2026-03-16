<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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

    $users = $query->get();
    $allUsersCount = User::count();

    // 4. Calculate Stats (Only once)
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
    // MOVE THIS INSIDE THE CLASS
    public function store(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'admin_role_id' => 'required|integer',
            'account_status' => 'required|in:active,deactivated,suspended,pending',
            'mentor_id' => 'nullable|exists:users,id',
        ]);

        \App\Models\User::create([
            'full_name' => $request->full_name,
            'email' => $request->email,
            'password' => \Illuminate\Support\Facades\Hash::make($request->password),
            'admin_role_id' => $request->admin_role_id,
            'account_status' => $request->account_status,
            'mentor_id' => $request->mentor_id,
        ]);

        return redirect()->route('admin.users')->with('success', 'User added successfully!');
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // 1. Validation
        $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'admin_role_id' => 'required|integer',
            // ADD 'pending' HERE
            'account_status' => 'required|in:active,deactivated,suspended,pending',
        ]);

        // 2. Update the data
        $user->full_name = $request->full_name;
        $user->email = $request->email;
        $user->admin_role_id = $request->admin_role_id;
        $user->account_status = $request->account_status;
        $user->mentor_id = $request->mentor_id;

        // 3. Optional: Update password only if provided
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('admin.users')->with('success', 'User updated successfully!');
    }
    public function destroy($id)
    {
        // 1. Find the specific user or crash with a 404
        $user = User::findOrFail($id);

        // 2. Safety Check: Don't let the logged-in admin delete themselves
        if ($user->id === auth()->id()) {
            return redirect()->back()->with('error', 'You cannot delete your own account!');
        }

        // 3. Delete the record from your 'users' table
        $user->delete();

        // 4. Redirect back with a success alert
        return redirect()->route('admin.users')->with('success', 'User removed successfully.');
    }
}
