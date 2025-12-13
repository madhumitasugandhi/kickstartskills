<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/


Route::get('cache:clear', function () {
    Artisan::call('cache:clear');
    return 'd';
});

Route::get('route:clear', function () {
    Artisan::call('route:clear');
    return 'done';
});

Route::get('config:clear', function () {
    Artisan::call('config:clear');
    return 'r';
});
Route::get('optimize', function () {
    Artisan::call('optimize');
    return 'done';
});




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
        return view('frontend.studentPortal.dashboard.profile.personalInfoIndex');
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

/* 3. Examinations Section (Grouped Routes) */
Route::prefix('student/dashboard/examinations')->name('student.exam.')->group(function () {

    // 1st Option: Take Test
    Route::get('/take-test', function () {
        return view('frontend.studentPortal.dashboard.examinations.takeTestIndex');
    })->name('take');

    // 2nd Option: Test History (Placeholder)
    Route::get('/history', function () {
        return view('frontend.studentPortal.dashboard.examinations.testHistoryIndex');
    })->name('history');

    // 3rd Option: Results (Placeholder)
    Route::get('/results', function () {
        return view('frontend.studentPortal.dashboard.examinations.resultsIndex');
    })->name('results');

    // 4th Option: Practice Tests (Placeholder)
    Route::get('/practice', function () {
        return view('frontend.studentPortal.dashboard.examinations.practiceTestsIndex');
    })->name('practice');
});

/*Learning section Group Routes*/
Route::prefix('student/dashboard/learning')->name('student.learning.')->group(function () {

    // 1st Option: My Courses
    Route::get('/my-courses', function () {
        return view('frontend.studentPortal.dashboard.learning.myCoursesIndex');
    })->name('my_courses');

    // 2nd Option: Course Catalog (Placeholder)
    Route::get('/catalog', function () {
        return view('frontend.studentPortal.dashboard.learning.coursesCatalogIndex');
    })->name('catalog');

    // 3rd Option: Resources (Placeholder)
    Route::get('/resources', function () {
        return view('frontend.studentPortal.dashboard.learning.resourcesIndex');
    })->name('resources');

    // 4th Option: Recommendations (Placeholder)
    Route::get('/recommendations', function () {
       return view('frontend.studentPortal.dashboard.learning.recommendationsIndex');
    })->name('recommendations');
});

/*Internship section Group Routes*/
Route::prefix('student/dashboard/internship')->name('student.internship.')->group(function () {

    // 1. Overview (The page we just created)
    Route::get('/overview', function () {
        return view('frontend.studentPortal.dashboard.internship.overview');
    })->name('overview');

    // 2. Tasks & Assignments (Placeholder)
    Route::get('/tasks', function () {
        return view('frontend.studentPortal.dashboard.internship.taskAndAssignments');
    })->name('tasks');

    // 3. Progress Tracking (Placeholder)
    Route::get('/progress', function () {
        return view('frontend.studentPortal.dashboard.internship.progressTracking');
    })->name('progress');

    // 4. Phase Details (Placeholder)
    Route::get('/phases', function () {
        return view('frontend.studentPortal.dashboard.internship.phaseDetails');
    })->name('phases');
});

/*|------------------------------------------------End Student Portal Routes--------------------------------------------------|*/


// Institution Portal
Route::get('/institution-login', function () {
    return view('frontend.institutionPortal.auth.institutelogin');
});
Route::get('/institution/forgot-password', function () {
    return view('frontend.institutionPortal.auth.institutefrgt-password');
});
Route::get('/institution/register', function () {
    return view('frontend.institutionPortal.auth.instituteregister');
});

Route::prefix('institute')->group(function () {
        Route::get('/dashboard', function () {
            return view('frontend.institutionPortal.dashboard.index');
        })->name('institute.dashboard');
    });





Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
