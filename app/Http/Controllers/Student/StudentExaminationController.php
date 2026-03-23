<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Models\SkillsCategory;

class StudentExaminationController extends Controller
{
    public function takeTestIndex()
{
    $user = Auth::user();

    $userSkills = DB::table('student_skills')
        ->where('user_id', $user->id)
        ->pluck('skill_name')
        ->toArray();

    $availableExams = DB::table('exams')
        ->whereIn('skill_category', $userSkills)
        ->where('status', 'Published')
        ->get();

    // --- ADD THIS TEMPORARILY ---
    // dd(['UserSkills' => $userSkills, 'FoundExams' => $availableExams]);

    return view('frontend.studentPortal.dashboard.examinations.takeTestIndex', compact('availableExams', 'user'));
}
}
