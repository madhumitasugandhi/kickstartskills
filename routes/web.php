<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Mentor\MentorDashboardController;

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
//login
Route::get('/student-login', function () {
    return view('frontend.studentPortal.auth.student_login');
});
//forgot password
Route::get('/student/forgot-password', function () {
    return view('frontend.studentPortal.auth.forgot_password');
});
//register
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

// Attendance section Group routes
Route::prefix('student/dashboard/attendance')->name('student.attendance.')->group(function () {

    // 1. Mark Attendance (The page we just created)
    Route::get('/mark', function () {
        return view('frontend.studentPortal.dashboard.attendance.markAttendance');
    })->name('mark');

    // 2. History (Placeholder)
    Route::get('/history', function () {
        return view('frontend.studentPortal.dashboard.attendance.history');
    })->name('history');

    // 3. Leave Requests (Placeholder)
    Route::get('/leave', function () {
        return view('frontend.studentPortal.dashboard.attendance.leaveRequest');
    })->name('leave');
});

// Communicationsection Group routes
Route::prefix('student/dashboard/communication')->name('student.communication.')->group(function () {

    // 1. Messages
    Route::get('/messages', function () {
        return view('frontend.studentPortal.dashboard.communication.message');
    })->name('messages');

    // 2. Announcements (Placeholder)
    Route::get('/announcements', function () {
        return view('frontend.studentPortal.dashboard.communication.announcements');
    })->name('announcements');

    // 3. Schedule Meeting (Placeholder)
    Route::get('/schedule', function () {
        return view('frontend.studentPortal.dashboard.communication.scheduleMeeting');
    })->name('schedule');
});

// Performance section Group routes
Route::prefix('student/dashboard/performance')->name('student.performance.')->group(function () {

    // 1. Analytics
    Route::get('/analytics', function () {
        return view('frontend.studentPortal.dashboard.performance.analytics');
    })->name('analytics');

    // 2. Reports (Placeholder)
    Route::get('/reports', function () {
        return view('frontend.studentPortal.dashboard.performance.reports');
    })->name('reports');

    // 3. Feedback (Placeholder)
    Route::get('/feedback', function () {
        return view('frontend.studentPortal.dashboard.performance.feedback');
    })->name('feedback');
});

// Achievements  section Group routes
Route::prefix('student/dashboard/achievements')->name('student.achievements.')->group(function () {

    // 1. Certificates
    Route::get('/certificates', function () {
        return view('frontend.studentPortal.dashboard.achievements.certificates');
    })->name('certificates');

    // 2. Badges (Placeholder)
    Route::get('/badges', function () {
        return view('frontend.studentPortal.dashboard.achievements.badges');
    })->name('badges');

    // 3. Portfolio (Placeholder)
    Route::get('/portfolio', function () {
        return view('frontend.studentPortal.dashboard.achievements.portfolio');
    })->name('portfolio');
});

// Notifications
Route::get('/student/notifications', function () {
    return view('frontend.studentPortal.dashboard.notifications.notificationIndex');
})->name('student.notifications');

// Settings
Route::get('/student/settings', function () {
    return view('frontend.studentPortal.dashboard.settings.settingIndex');
})->name('student.settings');

/*|------------------------------------------------End Student Portal Routes--------------------------------------------------|*/


/*|------------------------------------------------Start Institution Portal Routes--------------------------------------------------|*/
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

/*|------------------------------------------------End Institution Portal Routes--------------------------------------------------|*/

/*|------------------------------------------------Mentor Portal Routes--------------------------------------------------|*/
//login
Route::get('/mentor-login', function () {
    return view('frontend.mentorPortal.auth.mentor_login');
});
//forgot password
Route::get('/mentor/forgot-password', function () {
    return view('frontend.mentorPortal.auth.forgot_password');
});
//register
Route::get('/mentor/register', function () {
    return view('frontend.mentorPortal.auth.register');
});

Route::prefix('mentor')->name('mentor.')->group(function () {

    // 1. Dashboard Index
    Route::get('/dashboard', function () {
        return view('frontend.mentorPortal.dashboard.dashboardIndex');
    })->name('dashboard');

    // 2. Students Group
    Route::prefix('students')->name('students.')->group(function () {
        Route::get('/assigned', function () {
            return view('frontend.mentorPortal.dashboard.students.assignedStudents');
        })->name('assigned');

        Route::get('/analytics', function () {
            return view('frontend.mentorPortal.dashboard.students.analytics');
        })->name('analytics');
    });

    // 3. Sessions Group
    Route::prefix('sessions')->name('sessions.')->group(function () {
        Route::get('/calendar', function () {
            return view('frontend.mentorPortal.dashboard.sessions.calendar');
        })->name('calendar');

        Route::get('/schedule', function () {
            return view('frontend.mentorPortal.dashboard.sessions.schedule');
        })->name('schedule');

        Route::get('/history', function () {
            return view('frontend.mentorPortal.dashboard.sessions.history');
        })->name('history');
    });

    // 4. Internship Group
    Route::prefix('internship')->name('internship.')->group(function () {
        Route::get('/overview', function () {
            return view('frontend.mentorPortal.dashboard.internship.overview');
        })->name('overview');

        Route::get('/tasks', function () {
            return view('frontend.mentorPortal.dashboard.internship.tasks');
        })->name('tasks');

        Route::get('/phases', function () {
            return view('frontend.mentorPortal.dashboard.internship.phases');
        })->name('phases');
    });

    // 5. Drive Management
    Route::prefix('drive')->name('drive.')->group(function () {
        Route::get('/manage', function () {
            return view('frontend.mentorPortal.dashboard.driveManagement.manage');
        })->name('manage');

        Route::get('/create', function () {
            return view('frontend.mentorPortal.dashboard.driveManagement.create');
        })->name('create');
    });

    // 6. Communication
    Route::prefix('communication')->name('communication.')->group(function () {
        Route::get('/messages', function () {
            return view('frontend.mentorPortal.dashboard.communication.messages');
        })->name('messages');

        Route::get('/groups', function () {
            return view('frontend.mentorPortal.dashboard.communication.groups');
        })->name('groups');
    });

    // 7. Resources
    Route::prefix('resources')->name('resources.')->group(function () {
        Route::get('/library', function () {
            return view('frontend.mentorPortal.dashboard.resources.library');
        })->name('library');

        Route::get('/assignments', function () {
            return view('frontend.mentorPortal.dashboard.resources.assignments');
        })->name('assignments');
    });

    // 8. Performance
    Route::prefix('performance')->name('performance.')->group(function () {
        Route::get('/tracking', function () {
            return view('frontend.mentorPortal.dashboard.performance.tracking');
        })->name('tracking');

        Route::get('/goals', function () {
            return view('frontend.mentorPortal.dashboard.performance.goals');
        })->name('goals');
    });

    // 9. Reports
    Route::prefix('reports')->name('reports.')->group(function () {
        Route::get('/mentoring', function () {
            return view('frontend.mentorPortal.dashboard.reports.mentoring');
        })->name('mentoring');

        Route::get('/assessments', function () {
            return view('frontend.mentorPortal.dashboard.reports.assessments');
        })->name('assessments');
    });

    // 10. General Pages
    Route::get('/notifications', function () {
        return view('frontend.mentorPortal.dashboard.general.notifications');
    })->name('notifications');

    Route::get('/profile', function () {
        return view('frontend.mentorPortal.dashboard.general.profile');
    })->name('profile');

    Route::get('/settings', function () {
        return view('frontend.mentorPortal.dashboard.general.settings');
    })->name('settings');

});

/*|------------------------------------------------End Mentor Portal Routes--------------------------------------------------|*/
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
