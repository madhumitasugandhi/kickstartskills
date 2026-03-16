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

        // 5. Fetch the 5 most recent user registrations
        $recentActivities = User::orderBy('created_at', 'desc')->take(5)->get();

        // 6. Fetch suspended users for the "Security Alerts" section
        $securityAlerts = User::where('account_status', 'suspended')
            ->orderBy('created_at', 'desc') // Changed 'updated_at' to 'created_at'
            ->take(2)
            ->get();

        // ONLY ONE RETURN AT THE END
        return view('frontend.adminPortal.dashboard.dashboardIndex', compact(
            'totalUsers',
            'activeUsers',
            'totalAdmins',
            'activeSessions',
            'suspendedUsers',
            'recentActivities',
            'securityAlerts'
        ));
    }
}
