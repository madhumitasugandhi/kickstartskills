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

        $stats = [
            // Count users where mentor_id matches and they are students (role 5)
            'assigned_students' => \App\Models\User::where('mentor_id', $mentorId)
                ->where('admin_role_id', 5)
                ->count(),

            // Count active sessions for this mentor
            // Line 24-28 update:
            'active_sessions' => \DB::table('mentor_sessions')
                ->where('mentor_id', $mentorId)
                ->where('status', 'scheduled')
                ->count(),

            // Count job applications marked as 'Hired' for this mentor's students
            'completed_tasks' => \DB::table('job_applications')
                ->where('mentor_id', $mentorId)
                ->where('application_status', 'Hired')
                ->count(),

            // We can keep this static for now or calculate a real average later
            'avg_progress' => 87,

            // Count new students added in the last 7 days for this mentor
            'new_students_count' => \App\Models\User::where('mentor_id', $mentorId)
                ->where('admin_role_id', 5)
                ->where('created_at', '>=', now()->subDays(7))
                ->count(),

            // Count sessions happening within the next 24 hours
            'sessions_today' => \DB::table('mentor_sessions')
                ->where('mentor_id', $mentorId)
                ->where('session_date', now()->format('Y-m-d'))
                ->count(),
        ];

        $mentorId = auth()->id();

        $students = \App\Models\User::where('mentor_id', $mentorId)
            ->where('admin_role_id', 5) // Role 5 = Student
            ->get();

        // Line 57 onwards...
        $upcomingSessions = \DB::table('mentor_sessions')
            ->where('mentor_id', $mentorId)
            ->where('session_date', '>=', now()->format('Y-m-d'))
            ->orderBy('session_date', 'asc')
            ->orderBy('session_time', 'asc')
            ->limit(5)
            ->get();

        return view('frontend.mentorPortal.dashboard.dashboardIndex', compact('stats', 'students', 'upcomingSessions'));
    }

    public function showStudent($id)
    {
        // Find the student, but only if they belong to the logged-in mentor
        $student = \App\Models\User::where('id', $id)
            ->where('mentor_id', auth()->id())
            ->firstOrFail();

        return view('frontend.mentorPortal.dashboard.students.studentProfile', compact('student'));
    }
}
