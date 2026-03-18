<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StudentExaminationController extends Controller
{
    public function takeTestIndex()
    {
        $user = \Auth::user();

        // 1. Get the names of the skills this user has added
        $userSkills = \DB::table('student_skills')
            ->where('user_id', $user->id)
            ->pluck('skill_name'); // e.g., ['Flutter', 'Laravel']

        // 2. Fetch Published Exams that match those skills
        $availableExams = \DB::table('exams')
            ->whereIn('skill_category', $userSkills)
            ->where('status', 'Published')
            ->get();

        // 3. Pass the exams to your view
        return view('frontend.studentPortal.dashboard.examinations.takeTestIndex', compact('availableExams'));
    }
}
