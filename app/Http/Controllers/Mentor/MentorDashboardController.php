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
            'assigned_students' => User::where('mentor_id', $mentorId)
                ->where('admin_role_id', 5)
                ->count(),

            // Count active sessions for this mentor
            'active_sessions' => DB::table('sessions')
                ->where('mentor_id', $mentorId)
                ->where('status', 'active')
                ->count(),

            // Count job applications marked as 'Hired' for this mentor's students
            'completed_tasks' => DB::table('job_applications')
                ->where('mentor_id', $mentorId)
                ->where('application_status', 'Hired')
                ->count(),

            // We can keep this static for now or calculate a real average later
            'avg_progress' => 87,

            // Count new students added in the last 7 days for this mentor
            'new_students_count' => User::where('mentor_id', $mentorId)
                ->where('admin_role_id', 5)
                ->where('created_at', '>=', now()->subDays(7))
                ->count(),

            // Count sessions happening within the next 24 hours
            'sessions_today' => DB::table('sessions')
                ->where('mentor_id', $mentorId)
                ->where('status', 'active')
                ->whereBetween('last_activity', [time(), time() + 86400]) // next 24 hours
                ->count(),
        ];

        $mentorId = auth()->id();

        $students = User::where('mentor_id', $mentorId)
            ->where('admin_role_id', 5) // Role 5 = Student
            ->get();

        $upcomingSessions = DB::table('sessions')
            ->join('users', 'sessions.user_id', '=', 'users.id')
            ->where('sessions.mentor_id', $mentorId)
            ->select('sessions.*', 'users.full_name as student_name')
            ->get();

        return view('frontend.mentorPortal.dashboard.dashboardIndex', compact('stats', 'students', 'upcomingSessions'));
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
