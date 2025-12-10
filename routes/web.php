<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('frontend.index');
});

/*|------------------------------------------------Student Portal Routes--------------------------------------------------|*/

Route::get('/student-login', function () {
    return view('frontend.studentPortal.auth.student_login');
});
Route::get('/student/forgot-password', function () {
    return view('frontend.studentPortal.auth.forgot_password');
});
Route::get('/student/register', function () {
    return view('frontend.studentPortal.auth.register');
});

/* 1. Student Dashboard (Home) */
Route::get('/student/dashboard', function () {
    // Points to: resources/views/frontend/studentPortal/dashboard/dashboardIndex.blade.php
    return view('frontend.studentPortal.dashboard.dashboardIndex');
})->name('student.dashboard');

/* 2. Profile Section (Grouped Routes) */
// This creates URLs like: /student/dashboard/profile/personal-info
Route::prefix('student/dashboard/profile')->name('student.profile.')->group(function () {

    // Route Name: student.profile.personal
    Route::get('/personal-info', function () {
        return view('frontend.studentPortal.dashboard.profile.profileIndex');
    })->name('personal');

    // Route Name: student.profile.academic (Placeholder)
    Route::get('/academic', function () {
       return view('frontend.studentPortal.dashboard.profile.academicIndex');
    })->name('academic');

    // Route Name: student.profile.portfolio (Placeholder)
    Route::get('/portfolio', function () {
       return view('frontend.studentPortal.dashboard.profile.portfolioIndex');
    })->name('portfolio');
});

/*|------------------------------------------------End Student Portal Routes--------------------------------------------------|*/


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
