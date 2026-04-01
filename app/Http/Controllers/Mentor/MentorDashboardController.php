<?php

namespace App\Http\Controllers\Mentor;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MentorDashboardController extends Controller
{
    public function index()
    {
        $mentorId = auth()->id();
        $todayDate = Carbon::now()->format('Y-m-d');
        $nowTime = Carbon::now()->format('H:i:s');
        $now = Carbon::now();

        // Saare sessions le aao check karne ke liye
        $allSessions = DB::table('mentor_sessions')
            ->where('mentor_id', $mentorId)
            ->get();

        $dynamicScheduled = 0;
        $dynamicCompleted = 0;
        $dynamicCancelled = 0;

        foreach ($allSessions as $session) {
            // Priority 1: Agar manually status 'cancelled' hai
            if ($session->status == 'cancelled' || $session->status == 'canceled') {
                $dynamicCancelled++;
                continue;
            }

            // Priority 2: Date aur Time combine karke check karo
            $sessionDateTime = Carbon::parse($session->session_date . ' ' . $session->session_time);

            if ($sessionDateTime->isPast()) {
                $dynamicCompleted++;
            } else {
                $dynamicScheduled++;
            }
        }

        $stats = [
            'assigned_students' => User::where('mentor_id', $mentorId)->where('admin_role_id', 5)->count(),

            // --- DYNAMIC COUNTS (Notebook Agenda Based) ---
            'scheduled_sessions' => $dynamicScheduled,
            'completed_sessions' => $dynamicCompleted,
            'cancelled_sessions' => $dynamicCancelled,

            'completed_tasks' => DB::table('job_applications')->where('mentor_id', $mentorId)->where('application_status', 'Hired')->count(),
            'avg_progress' => 87, // Aap chaho toh ise real tasks se calculate kar sakte ho
            'new_students_count' => User::where('mentor_id', $mentorId)->where('created_at', '>=', now()->subDays(7))->count(),
            'sessions_today' => DB::table('mentor_sessions')
                ->where('mentor_id', $mentorId)
                ->where('session_date', $todayDate)
                ->count(),
        ];

        // Join Meeting Popup Logic: Jo aaj hai aur jiska time abhi ya aane wala ho
        $currentSession = DB::table('mentor_sessions')
            ->where('mentor_id', $mentorId)
            ->where('session_date', $todayDate)
            ->where('status', 'scheduled')
            ->where('session_time', '>=', $nowTime)
            ->orderBy('session_time', 'asc')
            ->first();

        // Students list with random progress (as requested)
        $students = User::where('mentor_id', $mentorId)
            ->where('admin_role_id', 5)
            ->get()
            ->map(function ($student) {
                $student->progress = rand(60, 95);
                return $student;
            });

        // Upcoming Sessions: Sirf aane waali meetings
        $upcomingSessions = DB::table('mentor_sessions')
            ->where('mentor_id', $mentorId)
            ->where(function ($query) use ($todayDate, $nowTime) {
                $query->where('session_date', '>', $todayDate)
                    ->orWhere(function ($q) use ($todayDate, $nowTime) {
                        $q->where('session_date', $todayDate)
                            ->where('session_time', '>=', $nowTime);
                    });
            })
            ->where('status', '!=', 'cancelled')
            ->orderBy('session_date', 'asc')
            ->orderBy('session_time', 'asc')
            ->limit(5)
            ->get();

        return view('frontend.mentorPortal.dashboard.dashboardIndex', compact('stats', 'students', 'upcomingSessions', 'currentSession'));
    }

    public function showStudent($id)
    {
        $student = User::where('id', $id)
            ->where('mentor_id', auth()->id())
            ->firstOrFail();

        return view('frontend.mentorPortal.dashboard.students.studentProfile', compact('student'));
    }
}
