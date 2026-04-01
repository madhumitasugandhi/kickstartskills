<?php

namespace App\Http\Controllers\Mentor;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MentorDashboardController extends Controller
{
    public function index()
    {
        $mentorId = auth()->id();
        $todayDate = now()->format('Y-m-d');
        $nowTime = now()->format('H:i:s');

        // Stats Logic (Jo aapke paas pehle se hai...)
        $stats = [
            'assigned_students' => User::where('mentor_id', $mentorId)->where('admin_role_id', 5)->count(),
            'active_sessions' => DB::table('mentor_sessions')->where('mentor_id', $mentorId)->where('status', 'scheduled')->count(),
            'completed_tasks' => DB::table('job_applications')->where('mentor_id', $mentorId)->where('application_status', 'Hired')->count(),
            'avg_progress' => 87,
            'new_students_count' => User::where('mentor_id', $mentorId)->where('created_at', '>=', now()->subDays(7))->count(),
            'sessions_today' => DB::table('mentor_sessions')->where('mentor_id', $mentorId)->where('session_date', $todayDate)->count(),
        ];

        // --- AGENDA POINT 1: Current Session for Join Popup ---
        // Aisi session jo aaj hai aur jiska time ho chuka hai ya 30 min baad hone wali hai
        $currentSession = DB::table('mentor_sessions')
            ->where('mentor_id', $mentorId)
            ->where('session_date', $todayDate)
            ->where('status', 'scheduled')
            ->where('session_time', '>=', now()->subMinutes(15)->format('H:i:s')) // Start se 15 min pehle dikhna shuru ho
            ->orderBy('session_time', 'asc')
            ->first();

        $students = User::where('mentor_id', $mentorId)->where('admin_role_id', 5)->get();

        $upcomingSessions = DB::table('mentor_sessions')
            ->where('mentor_id', $mentorId)
            ->where('session_date', '>=', $todayDate)
            ->orderBy('session_date', 'asc')
            ->orderBy('session_time', 'asc')
            ->limit(5)
            ->get();

        return view('frontend.mentorPortal.dashboard.dashboardIndex', compact('stats', 'students', 'upcomingSessions', 'currentSession'));
    }

    public function showStudent($id)
    {
        // Find the student, but only if they belong to the logged-in mentor
        $student = User::where('id', $id)
            ->where('mentor_id', auth()->id())
            ->firstOrFail();

        return view('frontend.mentorPortal.dashboard.students.studentProfile', compact('student'));
    }
}