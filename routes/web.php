<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\GeoController;
use App\Http\Controllers\ExamController;

use App\Http\Controllers\Auth\ForgotPasswordController;

use App\Http\Controllers\Institution\InstitutionAuthController;
use App\Http\Controllers\Institution\InstitutionController;
use App\Http\Controllers\Institution\InstitutionProgramController;
use App\Http\Controllers\Institution\InstitutionCourseController;
use App\Http\Controllers\Institution\InstitutionDepartmentController;
use App\Http\Controllers\Institution\CourseTypeController;
use App\Http\Controllers\Institution\CourseRequirementController;
use App\Http\Controllers\Institution\InternshipController;
use App\Http\Controllers\Institution\FacultyController;
use App\Http\Controllers\Institution\ElectiveProgramController;
use App\Http\Controllers\Institution\ElectivecourseController;
use App\Http\Controllers\Institution\DriveManagementController;


use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AdminQuestionController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\DriveApprovalController;

use App\Http\Controllers\Mentor\MentorAuthController;
use App\Http\Controllers\Mentor\MentorDashboardController;
use App\Http\Controllers\Mentor\MentorSessionController;
use App\Http\Controllers\Mentor\MentorStudentController;
use App\Http\Controllers\Mentor\DriveController;
use App\Http\Controllers\Mentor\MentorProfileController;


use App\Http\Controllers\Student\StudentAuthController;
use App\Http\Controllers\Student\StudentProfileController;
use App\Http\Controllers\Student\StudentExaminationController;
use App\Http\Controllers\Student\StudentPaymentController;
use App\Http\Controllers\Student\StudentDriveController;

use App\Http\Controllers\HR\HRAuthController;

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

Route::get('/api/states/{country}', [GeoController::class, 'states']);
Route::get('/api/cities/{state}', [GeoController::class, 'cities']);

Route::get('/get-skills/{id}', [DriveController::class, 'getSkills']);

Route::get('/', function () {
    return view('frontend.index');
});
Route::get('/{portal}/forgot-password', function ($portal) {

    $allowed = ['student','admin','mentor','hr','institution'];

    if (!in_array($portal, $allowed)) {
        abort(404);
    }

    return view('frontend.auth.forgot-password', compact('portal'));
})->name('forgot.password');

// Common Password Reset Routes for Admin, Student, Mentor, Institution
Route::post('/auth/password/send-otp', [ForgotPasswordController::class, 'sendOtp'])->name('auth.password.sendOtp');
Route::post('/auth/password/verify-otp', [ForgotPasswordController::class, 'verifyOtp'])->name('auth.password.verifyOtp');
Route::post('/auth/password/update', [ForgotPasswordController::class, 'resetPassword'])->name('auth.password.update');

/*|------------------------------------------------Student Portal Auth--------------------------------------------------|*/
// Student Login
Route::get('/student-login', [StudentAuthController::class, 'showLogin'])->name('student.login');
Route::post('/student-login', [StudentAuthController::class, 'login'])->name('student.login.submit');

// Student Logout (Inside your protected group or standalone)
Route::post('/student-logout', [StudentAuthController::class, 'logout'])->name('student.logout');

// Register
Route::get('/student/register', [StudentAuthController::class, 'showRegister'])->name('student.register');
Route::post('/student/register', [StudentAuthController::class, 'register'])->name('student.register.submit');

/* Student Portal (Protected) */
Route::prefix('student')->middleware(['auth', 'student'])->group(function () {

    /* 1. Dashboard */
    Route::get('/dashboard', function () {
        return view('frontend.studentPortal.dashboard.dashboardIndex');
    })->name('student.dashboard');

    /* 2. Unified Profile Group */
    Route::prefix('dashboard/profile')->name('student.profile.')->group(function () {

        // Personal Info
        Route::get('/personal-info', [StudentProfileController::class, 'index'])->name('personal');
        Route::put('/update', [StudentProfileController::class, 'update'])->name('update');

        // Academic Details
        Route::get('/academic', [StudentProfileController::class, 'academicIndex'])->name('academic');
        Route::post('/academic/save', [StudentProfileController::class, 'academicUpdate'])->name('academic.save');

        // Portfolio View
        Route::get('/portfolio', [StudentProfileController::class, 'portfolioIndex'])->name('portfolio');
        Route::post('/portfolio/profile/update', [StudentProfileController::class, 'profileUpdate'])->name('profile.update_links');

        // Projects
        Route::post('/portfolio/save', [StudentProfileController::class, 'projectStore'])->name('portfolio.save');
        Route::delete('/portfolio/delete/{id}', [StudentProfileController::class, 'projectDelete'])->name('portfolio.delete');

        // Skills
        Route::post('/portfolio/skills/save', [StudentProfileController::class, 'skillStore'])->name('skills.save');
        Route::delete('/portfolio/skills/delete/{id}', [StudentProfileController::class, 'skillDelete'])->name('skills.delete');

        // Achievements
        Route::post('/portfolio/achievements/save', [StudentProfileController::class, 'achievementStore'])->name('achievements.save');
        Route::delete('/portfolio/achievements/delete/{id}', [StudentProfileController::class, 'achievementDelete'])->name('achievements.delete');
    });

    /* 3. Examinations Section */
    Route::prefix('dashboard/examinations')->name('student.exam.')->group(function () {

        // 0th Option: Approved Drives
        Route::get('/approved-drives', [StudentExaminationController::class, 'approvedDrives'])
        ->name('approved-drives');

        // payment gateway
        Route::post('/payment/create/{driveId}', [StudentPaymentController::class, 'createOrder'])
        ->name('payment.create');

        Route::post('/payment/success', [StudentPaymentController::class, 'paymentSuccess'])
         ->name('payment.success');

        // 1st Option: Take Test (The Instruction Hub)
        Route::get('/take-test', [StudentExaminationController::class, 'takeTestIndex'])->name('take');

        // Start Test: This is the dynamic route for the live quiz
        Route::get('/start-test/{id}', [StudentExaminationController::class, 'startTest'])->name('start');

        // start tast for drive
        Route::get('/drive/start/{id}', [StudentDriveController::class,'start'])->name('startDrive');

        Route::post('/drive/submit', [StudentDriveController::class,'submit'])->name('drive.submit');

        Route::get('/drive/results', [StudentDriveController::class, 'results'])->name('drive.results');

        Route::get('/results/all', [StudentExaminationController::class, 'combinedResults'])
    ->name('results.all');

        // 2nd Option: Test History
        Route::get('/history', [StudentExaminationController::class, 'testHistory'])->name('history');

        // 3rd Option: Results
        Route::get('/results', [StudentExaminationController::class, 'results'])->name('results');

        // 4th Option: Practice Tests
        Route::get('/practice', [StudentExaminationController::class, 'practiceIndex'])->name('practice');

        // Test Submission: Logic to calculate and save marks
        Route::post('/submit-quiz', [StudentExaminationController::class, 'submitQuiz'])->name('submit');
    });
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
Route::get('/institution-login', [InstitutionAuthController::class, 'showLogin']);

Route::post('/institution-login', [InstitutionAuthController::class, 'login'])
    ->name('institution.login');

Route::post('/institution/logout', [InstitutionAuthController::class, 'logout'])
    ->name('institution.logout');

Route::match(['get', 'post'], '/institution/register', [InstitutionController::class, 'register'])
    ->name('institution.register');

Route::middleware('institution.auth')->prefix('institution')->name('institution.')->group(function () {
    Route::get('/dashboard', function () {
        return view('frontend.institutionPortal.dashboard.index');
    })->name('dashboard');
    /* =============================
           CORE MANAGEMENT GROUP
        ============================== */
    Route::prefix('core-management')->name('core.')->group(function () {
        Route::match(['get', 'post'], '/setup', [InstitutionController::class, 'showSetup'])
            ->name('setup');
        Route::post('/setup/save-step', [InstitutionController::class, 'saveStep']);
        Route::post('/final-submit', [InstitutionController::class, 'finalSubmit']);
        Route::post('/setup/complete', [InstitutionController::class, 'completeSetup']);

        Route::get('/course-management', [CourseTypeController::class, 'index'])
            ->name('course-management');

        Route::prefix('course-types')->name('course-types.')->group(function () {
            Route::post('/store', [CourseTypeController::class, 'store'])->name('store');
            Route::post('/update/{id}', [CourseTypeController::class, 'update'])->name('update');
            Route::delete('/delete/{id}', [CourseTypeController::class, 'destroy'])->name('delete');
        });

        Route::prefix('requirements')->name('requirements.')->group(function () {

            Route::get('/', [CourseRequirementController::class, 'index'])->name('index');

            Route::post('/store', [CourseRequirementController::class, 'store'])->name('store');

            Route::delete('/delete/{id}', [CourseRequirementController::class, 'destroy'])->name('delete');
        });

        // Drive Management
        Route::prefix('drive-management')->name('drive-management.')->group(function () {

            Route::get('/', [DriveManagementController::class, 'index'])->name('index');

            Route::post('/approve/{id}', [DriveManagementController::class, 'approve'])->name('approve');

            Route::post('/reject/{id}', [DriveManagementController::class, 'reject'])->name('reject');

        });

        // Academic Structure

        Route::get('/academic-structure', function () {

            $tab = request('tab', 'overview');
            $institutionId = session('institution_id');

            $departments = \App\Models\Institution\InstitutionDepartment::where('institution_id', $institutionId)->get();

            $programs = \App\Models\Institution\InstitutionProgram::with(['department', 'educationType'])
                ->where('institution_id', $institutionId)
                ->get();

            $educationTypes = \App\Models\Institution\EducationType::where('status', 1)->get();

            $faculties = \App\Models\Institution\Faculty::with(['department', 'courses'])
                ->where('institution_id', $institutionId)
                ->get();

            $courseTypes = \App\Models\Institution\CourseType::where('institution_id', $institutionId)->get();

            return view(
                'frontend.institutionPortal.dashboard.core-management.academic_structure.index',
                compact('tab', 'departments', 'programs', 'educationTypes', 'faculties', 'courseTypes')
            );
        })->name('academic-structure');

        Route::prefix('academic-structure/departments')->name('academic-structure.departments.')->group(function () {

            Route::post('/store', [InstitutionDepartmentController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [InstitutionDepartmentController::class, 'edit'])->name('edit');
            Route::post('/update/{id}', [InstitutionDepartmentController::class, 'update'])->name('update');
            Route::delete('/delete/{id}', [InstitutionDepartmentController::class, 'destroy'])->name('delete');
        });

        Route::prefix('academic-structure/programs')->name('academic-structure.programs.')->group(function () {
            Route::post('/store', [InstitutionProgramController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [InstitutionProgramController::class, 'edit'])->name('edit');
            Route::post('/update/{id}', [InstitutionProgramController::class, 'update'])->name('update');
            Route::delete('/delete/{id}', [InstitutionProgramController::class, 'destroy'])->name('delete');
        });

        Route::prefix('academic-structure/faculty')->name('academic-structure.faculty.')->group(function () {
            Route::get('/', [FacultyController::class, 'index'])->name('index');
            Route::get('/list', [FacultyController::class, 'list'])->name('list');
            Route::post('/store', [FacultyController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [FacultyController::class, 'edit'])->name('edit');
            Route::post('/update/{id}', [FacultyController::class, 'update'])->name('update');
            Route::delete('/delete/{id}', [FacultyController::class, 'destroy'])->name('delete');
        });



        Route::prefix('internships')->name('internships.')->group(function () {

            /* =============================
                       INTERNSHIP DRIVES CRUD
                    ============================== */
            Route::prefix('drives')->name('drives.')->group(function () {

                Route::get('/list', [InternshipController::class, 'index'])->name('list');
                Route::post('/store', [InternshipController::class, 'store'])->name('store');
                Route::get('/edit/{id}', [InternshipController::class, 'edit'])->name('edit');
                Route::post('/update/{id}', [InternshipController::class, 'update'])->name('update');
                Route::delete('/delete/{id}', [InternshipController::class, 'destroy'])->name('delete');
                Route::post('/status', [InternshipController::class, 'changeStatus'])->name('status');
            });

            // Tabs Page
            Route::get('/{tab?}', function ($tab = 'overview') {

                $allowedTabs = [
                    'overview',
                    'drives',
                    'students',
                    'partners',
                    'analytics'
                ];

                if (!in_array($tab, $allowedTabs)) {
                    abort(404);
                }

                return view(
                    'frontend.institutionPortal.dashboard.core-management.internships.index',
                    compact('tab')
                );
            })->name('index');
        });

        Route::get('/financial-management/{tab?}', function ($tab = 'overview') {

            $allowedTabs = [
                'overview',
                'fee-structure',
                'payments',
                'expenses',
                'reports'
            ];

            if (!in_array($tab, $allowedTabs)) {
                abort(404);
            }

            return view(
                'frontend.institutionPortal.dashboard.core-management.financial_management.index',
                compact('tab')
            );
        })->name('financial-management');

        Route::get('/system-integrations', function () {
            return view('frontend.institutionPortal.dashboard.core-management.system.index');
        })->name('system-integrations');
    });

    // Electives

    Route::prefix('electives')->name('electives.')->group(function () {
        Route::get('/program-management', function () {
            return view('frontend.institutionPortal.dashboard.electives.management.index');
        })->name('program-management');

        Route::prefix('program-management')->name('program-management.')->group(function () {
            Route::get('/list', [ElectiveProgramController::class, 'index'])->name('list');
            Route::post('/store', [ElectiveProgramController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [ElectiveProgramController::class, 'edit'])->name('edit');
            Route::post('/update/{id}', [ElectiveProgramController::class, 'update'])->name('update');
            Route::delete('/delete/{id}', [ElectiveProgramController::class, 'destroy'])->name('delete');
            Route::get('/departments', [ElectiveProgramController::class, 'departments'])->name('departments');
            Route::get('/stats', [ElectiveProgramController::class, 'stats']);
            Route::post('/status', [ElectiveProgramController::class, 'changeStatus']);
        });

        Route::prefix('elective-courses')->name('elective-courses.')->group(function () {
            Route::get('/', [ElectivecourseController::class, 'index'])->name('index');
            Route::post('/store', [ElectivecourseController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [ElectivecourseController::class, 'edit'])->name('edit');
            Route::post('/update/{id}', [ElectivecourseController::class, 'update'])->name('update');
            Route::delete('/delete/{id}', [ElectivecourseController::class, 'destroy'])->name('delete');
            Route::post('/status/{id}', [ElectivecourseController::class, 'changeStatus'])->name('status');
            Route::get('/view/{id}', [ElectivecourseController::class, 'show'])->name('view');
            Route::get('/skills/{categoryId}', [ElectivecourseController::class, 'getSkills'])->name('skills');
        });


        Route::get('/programs-assessment', function () {
            return view('frontend.institutionPortal.dashboard.electives.assessment.index');
        })->name('programs-assessment');
    });


    // Students
    Route::get('/students-overview', function () {
        return view('frontend.institutionPortal.dashboard.students.overview.index');
    })->name('students-overview');
    Route::get('/data-dashboard', function () {
        return view('frontend.institutionPortal.dashboard.students.data-dashboard.index');
    })->name('data-dashboard');
    Route::get('/enrollment', function () {
        return view('frontend.institutionPortal.dashboard.students.enrollment.index');
    })->name('enrollment');
    Route::get('/academic-records', function () {
        return view('frontend.institutionPortal.dashboard.students.academic-records.index');
    })->name('academic-records');

    // Faculty
    Route::prefix('faculties')->name('faculties.')->group(function () {
        // Management
        Route::prefix('faculty-management')->name('faculty-management.')->group(function () {
            Route::get('/', [FacultyController::class, 'management'])->name('management');
            Route::get('/list', [FacultyController::class, 'list'])->name('list');
            Route::post('/store', [FacultyController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [FacultyController::class, 'edit'])->name('edit');
            Route::post('/update/{id}', [FacultyController::class, 'update'])->name('update');
            Route::delete('/delete/{id}', [FacultyController::class, 'destroy'])->name('delete');
            Route::get('/stats', [FacultyController::class, 'stats'])->name('stats');
        });
        // Assignments
        Route::get('/faculty-assignments', [FacultyController::class, 'assignments'])
            ->name('faculty-assignments');
    });


    // Analytics
    Route::get('/analytics-performance', function () {
        return view('frontend.institutionPortal.dashboard.analytics.performance.index');
    })->name('analytics-performance');
    Route::get('/analytics-reports', function () {
        return view('frontend.institutionPortal.dashboard.analytics.reports.index');
    })->name('analytics-reports');




    Route::get('/advanced-dashboard', function () {
        return view('frontend.institutionPortal.dashboard.analytics.advanced-dashboard.index');
    })->name('advanced-dashboard');
    Route::get('/communication-announcements', function () {
        return view('frontend.institutionPortal.dashboard.communication.announcements.index');
    })->name('communication-announcements');
    Route::get('/communication-messaging', function () {
        return view('frontend.institutionPortal.dashboard.communication.messaging.index');
    })->name('communication-messaging');
    Route::get('/compliance-reports', function () {
        return view('frontend.institutionPortal.dashboard.compliance-reports.index');
    })->name('compliance-reports');
    Route::get('/settings', function () {
        return view('frontend.institutionPortal.dashboard.settings.index');
    })->name('settings');
    Route::get('/notifications', function () {
        return view('frontend.institutionPortal.dashboard.notifications.index');
    })->name('notifications');
});


/*|------------------------------------------------End Institution Portal Routes--------------------------------------------------|*/

/*|------------------------------------------------Mentor Portal Routes--------------------------------------------------|*/
// Login Routes
Route::get('/mentor-login', [MentorAuthController::class, 'showLogin'])->name('mentor.login');
Route::post('/mentor-login', [MentorAuthController::class, 'login'])->name('mentor.login.submit');

//register
Route::get('/mentor/register', function () {
    return view('frontend.mentorPortal.auth.register');
});

Route::prefix('mentor')->name('mentor.')->middleware(['auth', 'mentor'])->group(function () {
    // Logout Route
    Route::post('/logout', [MentorAuthController::class, 'logout'])->name('logout');

    // 1. Dashboard Index
    Route::get('/dashboard', [MentorDashboardController::class, 'index'])->name('dashboard');

    Route::post('/sessions/store', [MentorSessionController::class, 'store'])->name('sessions.store');

    // 2. Students Group
    Route::prefix('students')->name('students.')->group(function () {

        Route::get('/assigned', [MentorStudentController::class, 'assigned'])->name('assigned');

        Route::post('/store', [MentorStudentController::class, 'store'])->name('store');

        Route::get('/view/{id}', [MentorStudentController::class, 'show'])->name('show');

        Route::get('/analytics', function () {
            return view('frontend.mentorPortal.dashboard.students.analytics');
        })->name('analytics');
    });

    // 3. Sessions Group
    Route::prefix('sessions')->name('sessions.')->group(function () {
        Route::get('/calendar', [MentorSessionController::class, 'calendar'])->name('calendar');
        Route::get('/schedule', [MentorSessionController::class, 'create'])->name('schedule');
        Route::post('/store', [MentorSessionController::class, 'store'])->name('store');

        // Yahan update kiya humne
        Route::get('/history', [MentorSessionController::class, 'history'])->name('history');

        Route::get('/edit/{id}', [MentorSessionController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [MentorSessionController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [MentorSessionController::class, 'destroy'])->name('destroy');
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

        Route::get('/manage', [DriveController::class, 'index'])->name('manage');
        Route::get('/create', [DriveController::class, 'create'])->name('create');
        Route::post('/store', [DriveController::class, 'store'])->name('store');

        Route::get('/edit/{id}', [DriveController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [DriveController::class, 'update'])->name('update');
        Route::post('/delete/{id}', [DriveController::class, 'destroy'])->name('delete');
        Route::get('/show/{id}', [DriveController::class, 'show'])->name('show');

        Route::get('/get/{id}', [DriveController::class, 'getDrive'])->name('get');

        Route::post('/save-basic', [DriveController::class, 'saveBasicInfo']);
        Route::post('/save-eligibility', [DriveController::class, 'saveEligibility']);
        Route::post('/save-timeline', [DriveController::class, 'saveTimeline']);

        Route::post('/publish/{id}', [DriveController::class, 'publish'])->name('publish');
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

    Route::get('/profile', [MentorProfileController::class, 'index'])->name('profile');
    Route::post('/profile/update', [MentorProfileController::class, 'update'])->name('profile.update');

    Route::get('/settings', function () {
        return view('frontend.mentorPortal.dashboard.general.settings');
    })->name('settings');

});

/*|------------------------------------------------End Mentor Portal Routes--------------------------------------------------|*/

/*|------------------------------------------------Start HR Portal Routes--------------------------------------------------|*/

//login
Route::get('/hr-login', [HRAuthController::class, 'showLoginForm'])->name('hr.login');
Route::post('/hr-login', [HRAuthController::class, 'login'])->name('hr.login.submit');

// Protected HR Portal Routes (Sirf Login ke baad access honge)
 Route::middleware(['is_hr'])->prefix('hr')->name('hr.')->group(function () {

    // 1. Dashboard
    Route::get('/dashboard', function () {
        return view('frontend.hrPortal.dashboard.dashboardIndex');
    })->name('dashboard');

    // 2. Employee Management
    Route::get('/employees', function () {
        return view('frontend.hrPortal.dashboard.employees');
    })->name('employees');

    // 3. Recruitment Pipeline
    Route::get('/recruitment', function () {
        return view('frontend.hrPortal.dashboard.recruitment');
    })->name('recruitment');

    // 4. Corporate Drives
    Route::get('/drives', function () {
        return view('frontend.hrPortal.dashboard.corporateDrives');
    })->name('drives');

    // 5. Drive Analytics
    Route::get('/drive-analytics', function () {
        return view('frontend.hrPortal.dashboard.driveAnalytics');
    })->name('analytics');

    // 6. Performance Reviews
    Route::get('/performance', function () {
        return view('frontend.hrPortal.dashboard.performance');
    })->name('performance');

    // 7. Attendance Management
    Route::get('/attendance', function () {
        return view('frontend.hrPortal.dashboard.attendance');
    })->name('attendance');

    // 8. HR Analytics (Reports)
    Route::get('/reports', function () {
        return view('frontend.hrPortal.dashboard.reports');
    })->name('reports');

    // 9. Notifications
    Route::get('/notifications', function () {
        return view('frontend.hrPortal.dashboard.notifications');
    })->name('notifications');

    // 10. Settings
    Route::get('/settings', function () {
        return view('frontend.hrPortal.dashboard.settings');
    })->name('settings');

    // Logout Route (Recommended to be inside protected group)
    Route::post('/logout', [HRAuthController::class, 'logout'])->name('logout');
});

/*|------------------------------------------------End HR Portal Routes--------------------------------------------------|*/

/*|------------------------------------------------Start Admin Portal Routes--------------------------------------------------|*/
/* ----------------------- Public Admin Routes (No Auth) ----------------------- */
Route::get('/admin-login', [AuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin-login', [AuthController::class, 'login'])->name('admin.login.submit');


/* ----------------------- Protected Admin Routes (With Auth & Admin Middleware) ----------------------- */
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // 1. Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // 2. User Management
    Route::controller(UserController::class)->group(function () {
        Route::get('/users', 'index')->name('users');
        Route::post('/users/store', 'store')->name('users.store');
        Route::put('/users/update/{id}', 'update')->name('users.update');
        Route::delete('/users/delete/{id}', 'destroy')->name('users.delete');
    });

    // 3. Question Bank (Fixed Prefix)
    Route::prefix('questions')->name('questions.')->group(function () {
        Route::get('/', [AdminQuestionController::class, 'index'])->name('index');
        Route::get('/create', [AdminQuestionController::class, 'create'])->name('create');
        Route::post('/store', [AdminQuestionController::class, 'store'])->name('store');
        // --- YE WALE ROUTES ADD KARO ---
        Route::delete('/delete/{id}', [AdminQuestionController::class, 'destroy'])->name('destroy');
        Route::get('/edit/{id}', [AdminQuestionController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [AdminQuestionController::class, 'update'])->name('update');
        Route::get('/get-subcategories/{categoryId}', [AdminQuestionController::class, 'getSubcategories'])->name('get_subcategories');
    });


    // 4. Exam Management (Corrected Prefix inside Admin group)
    Route::prefix('exams')->name('exams.')->group(function () {
        Route::get('/', [ExamController::class, 'index'])->name('index'); // admin.exams.index
        Route::get('/create', [ExamController::class, 'create'])->name('create'); // admin.exams.create
        Route::post('/store', [ExamController::class, 'store'])->name('store'); // admin.exams.store
        Route::get('/get-questions/{catId}', [ExamController::class, 'getQuestionsByCategory'])->name('get_questions');
        Route::get('/view/{id}', [ExamController::class, 'viewExam'])->name('view');
        Route::get('/edit/{id}', [ExamController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [ExamController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [ExamController::class, 'destroy'])->name('delete');
    });

    Route::prefix('drives')->name('drives.')->group(function () {
        Route::get('/', [DriveApprovalController::class, 'index'])->name('index');
        Route::post('/approve/{id}', [DriveApprovalController::class, 'approve'])->name('approve');
        Route::post('/reject/{id}', [DriveApprovalController::class, 'reject'])->name('reject');
        Route::get('/get/{id}', [DriveApprovalController::class, 'show'])->name('get');
    });


    // 4. Other Modules (Static Views)
    Route::get('/institutions', fn() => view('frontend.adminPortal.dashboard.institutions'))->name('institutions');
    Route::get('/system', fn() => view('frontend.adminPortal.dashboard.systemConfig'))->name('system');
    Route::get('/analytics', fn() => view('frontend.adminPortal.dashboard.analytics'))->name('analytics');
    Route::get('/security', fn() => view('frontend.adminPortal.dashboard.security'))->name('security');
    Route::get('/content', fn() => view('frontend.adminPortal.dashboard.content'))->name('content');
    Route::get('/support', fn() => view('frontend.adminPortal.dashboard.support'))->name('support');
    Route::get('/billing', fn() => view('frontend.adminPortal.dashboard.billing'))->name('billing');
    Route::get('/ai-analytics', fn() => view('frontend.adminPortal.dashboard.aiAnalytics'))->name('ai_analytics');
    Route::get('/workflows', fn() => view('frontend.adminPortal.dashboard.workflows'))->name('workflows');
    Route::get('/monitoring', fn() => view('frontend.adminPortal.dashboard.monitoring'))->name('monitoring');
    Route::get('/intelligence', fn() => view('frontend.adminPortal.dashboard.intelligence'))->name('intelligence');
});
/*|------------------------------------------------End Admin Portal Routes--------------------------------------------------|*/

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
