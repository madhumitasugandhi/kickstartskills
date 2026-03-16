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
        $request->validate([
            'student_id' => 'required|exists:users,id',
            'topic' => 'required|string|max:255',
            'session_date' => 'required|date|after:now',
        ]);

        DB::table('sessions')->insert([
            'user_id' => $request->student_id, // The student
            'mentor_id' => Auth::id(),        // The logged-in mentor
            'payload' => $request->topic,      // Using payload for the topic for now
            'last_activity' => strtotime($request->session_date), // Storing time
            'status' => 'active',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return back()->with('success', 'Session scheduled successfully!');
    }
}
