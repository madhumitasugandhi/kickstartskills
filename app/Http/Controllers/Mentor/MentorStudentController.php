<?php

namespace App\Http\Controllers\Mentor;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class MentorStudentController extends Controller
{
    public function assigned(Request $request)
    {
        $mentorId = auth()->id();
        $search = $request->input('search');
        $statusFilter = $request->input('status'); // Get status from URL

        $query = User::where('mentor_id', $mentorId)->where('admin_role_id', 5);

        // Filter by Search
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('full_name', 'LIKE', "%{$search}%")
                    ->orWhere('email', 'LIKE', "%{$search}%");
            });
        }

        // NEW: Filter by Status from Card Click
        if ($statusFilter && $statusFilter !== 'all') {
            if ($statusFilter === 'attention') {
        // Fetch both Suspended AND Inactive students
        $query->whereIn('account_status', ['suspended', 'deactivated']);
    } else {
        // Standard single status filter (active, pending, etc)
        $query->where('account_status', $statusFilter);
    }
        }

        $students = $query->get();

        $stats = [
            'total' => User::where('mentor_id', $mentorId)->where('admin_role_id', 5)->count(),
            'online' => rand(1, 3),
            'avg_progress' => 88,
            'needs_attention' => User::where('mentor_id', $mentorId)
                                ->whereIn('account_status', ['suspended', 'deactivated'])
                                ->count(),
        ];

        return view('frontend.mentorPortal.dashboard.students.assignedStudents', compact('stats', 'students'));
    }

    public function show($id)
    {
        // Security: Ensure this student actually belongs to this mentor
        $student = User::where('id', $id)
            ->where('mentor_id', auth()->id())
            ->firstOrFail();

        return view('frontend.mentorPortal.dashboard.students.studentProfile', compact('student'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'account_status' => 'required|in:active,pending,deactivated,suspended ',
        ]);

        // Create the student
        $student = User::create([
            'full_name' => $request->full_name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'admin_role_id' => 5, // Student Role
            'mentor_id' => auth()->id(), // Auto-assign to the logged-in mentor
            'account_status' => $request->account_status,
        ]);

        return back()->with('success', "Student {$student->full_name} created and assigned to your dashboard!");
    }
}
