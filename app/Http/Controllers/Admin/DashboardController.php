<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Total & Active Users
        $totalUsers = User::count();
        $activeUsers = User::where('account_status', 'active')->count();

        // 2. Admin Team (Role IDs 1 and 2)
        $totalAdmins = User::whereIn('admin_role_id', [1, 2])->count();

        // 3. Real-time Traffic
        $activeSessions = DB::table('sessions')
            ->where('last_activity', '>=', now()->subMinutes(5)->getTimestamp())
            ->count();

        // 4. Security/Moderation
        $suspendedUsers = User::where('account_status', 'suspended')->count();

        // 🔥 5. INSTITUTION STATS (FROM USERS ONLY)
        $totalInstitutions = User::where('admin_role_id', 4)->count();

        $activeInstitutions = User::where('admin_role_id', 4)
            ->where('account_status', 'active')
            ->count();

        $pendingInstitutions = User::where('admin_role_id', 4)
            ->where('account_status', 'pending')
            ->count();

        // 🔥 6. Recent Institution Users
        $recentInstitutions = User::where('admin_role_id', 4)
            ->latest()
            ->take(5)
            ->get();

        // 7. Recent Users
        $recentActivities = User::latest()->take(5)->get();

        // 8. Security Alerts
        $securityAlerts = User::where('account_status', 'suspended')
            ->latest()
            ->take(2)
            ->get();

        return view('frontend.adminPortal.dashboard.dashboardIndex', compact(
            'totalUsers',
            'activeUsers',
            'totalAdmins',
            'activeSessions',
            'suspendedUsers',
            'recentActivities',
            'securityAlerts',

            // 🔥 Institution Data
            'totalInstitutions',
            'activeInstitutions',
            'pendingInstitutions',
            'recentInstitutions'
        ));
    }
}