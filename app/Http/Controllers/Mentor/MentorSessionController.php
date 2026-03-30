<?php

namespace App\Http\Controllers\Mentor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class MentorSessionController extends Controller
{
    public function store(Request $request)
    {
        // Validation
        $request->validate([
            'session_title' => 'required|string|max:255',
            'session_type' => 'required',
            'student_ids' => 'required|array|min:1',
            'session_date' => 'required|date',
            'session_time' => 'required',
            'meeting_platform' => 'required',
            'duration' => 'required',
        ]);

        try {
            DB::table('mentor_sessions')->insert([
                'mentor_id' => Auth::id(),
                'session_title' => $request->session_title,
                'session_type' => $request->session_type,
                'description' => $request->description,
                'agenda' => $request->agenda,
                'is_recurring' => $request->has('is_recurring') ? 1 : 0,
                'repeat_pattern' => $request->has('is_recurring') ? $request->repeat_pattern : null,
                'meeting_platform' => $request->meeting_platform,
                'meeting_url' => $request->meeting_url,
                'student_ids' => json_encode($request->student_ids), // IDs array as JSON
                'session_date' => $request->session_date,
                'session_time' => $request->session_time,
                'duration' => $request->duration,
                'status' => 'scheduled',
                'created_at' => now(),
            ]);

            return back()->with('success', 'Session scheduled successfully!');

        } catch (\Exception $e) {
            return back()->with('error', 'Error: ' . $e->getMessage())->withInput();
        }
    }

    public function create()
    {
        // 1. Fetch ALL students (Role 3) without any extra restrictions
        $students = DB::table('users')
            ->where('admin_role_id', 5)
            ->select('id', 'full_name as name', 'institution_name')
            ->orderBy('full_name', 'asc')
            ->get(); // Make sure there is no ->limit() here

        // 2. Fetch Institutions (Role 4)
        $institutions = DB::table('users')
            ->where('admin_role_id', 4)
            ->whereNotNull('institution_name')
            ->distinct()
            ->pluck('institution_name');

        return view('frontend.mentorPortal.dashboard.sessions.schedule', compact('students', 'institutions'));
    }


    public function calendar(Request $request)
    {
        $month = $request->get('month', date('m'));
        $year = $request->get('year', date('Y'));

        $sessions = DB::table('mentor_sessions')
            ->where('mentor_id', Auth::id())
            ->whereYear('session_date', $year)
            ->whereMonth('session_date', $month)
            ->get();

        return view('frontend.mentorPortal.dashboard.sessions.calendar', compact('sessions'));
    }

    public function edit($id)
    {
        $session = DB::table('mentor_sessions')->where('id', $id)->first();

        // Students aur Institutions lakar dropdown bharna hoga (same as create)
        $students = DB::table('users')->where('admin_role_id', 5)->get();
        $institutions = DB::table('users')->where('admin_role_id', 4)->pluck('institution_name');

        // Selected students ko array mein convert karo blade ke liye
        $selectedStudents = json_decode($session->student_ids);

        return view('frontend.mentorPortal.dashboard.sessions.editSession', compact('session', 'students', 'institutions', 'selectedStudents'));
    }

    public function update(Request $request, $id)
    {
        // Same validation as store...
        DB::table('mentor_sessions')->where('id', $id)->update([
            'session_title' => $request->session_title,
            'session_date' => $request->session_date,
            'session_time' => $request->session_time,
            'student_ids' => json_encode($request->student_ids),
            'meeting_url' => $request->meeting_url,
            // ... baaki fields
        ]);

        return redirect()->route('mentor.sessions.calendar')->with('success', 'Session updated!');
    }

    public function destroy($id)
    {
        // Session delete logic
        DB::table('mentor_sessions')->where('id', $id)->where('mentor_id', Auth::id())->delete();
        return back()->with('success', 'Session cancelled successfully!');
    }

    public function history(Request $request)
    {
        $query = DB::table('mentor_sessions')
            ->where('mentor_id', Auth::id());

        // 1. Search Filter
        if ($request->has('search') && $request->search != '') {
            $query->where('session_title', 'like', '%' . $request->search . '%');
        }

        // 2. Status Filter
        if ($request->has('status') && $request->status != 'All Sessions') {
            $query->where('status', strtolower($request->status));
        }

        // 3. Time Period Filter
        if ($request->has('period')) {
            if ($request->period == 'Last 30 days') {
                $query->where('session_date', '>=', now()->subDays(30));
            } elseif ($request->period == 'Last 3 Months') {
                $query->where('session_date', '>=', now()->subMonths(3));
            }
        }

        $sessions = $query->orderBy('session_date', 'desc')->get();

        $totalMinutes = $sessions->where('status', 'completed')->sum(function ($session) {
            return (int) filter_var($session->duration, FILTER_SANITIZE_NUMBER_INT);
        });
        $totalHours = round($totalMinutes / 60, 1);
        $avgRating = $sessions->where('status', 'completed')->count() > 0 ? 4.8 : 0.0;

        $stats = [
            'total' => $sessions->count(),
            'completed' => $sessions->where('status', 'completed')->count(),
            'total_hours' => $totalHours,
            'avg_rating' => $avgRating
        ];

        return view('frontend.mentorPortal.dashboard.sessions.history', compact('sessions', 'stats'));
    }
}
