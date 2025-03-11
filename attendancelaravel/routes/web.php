<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login');
});

use App\Http\Controllers\DashboardController;

Route::get('/dashboard',[DashboardController::class, 'index'])->name('dashboard');

use App\Http\Controllers\loginController;

Route::get('/', [loginController::class, 'login'])->name('login');
Route::post('/postlogin', [loginController::class, 'postlogin'])->name('postlogin');
// use App\Http\Controllers\LoginController;

// // Login Routes
// Route::get('/login', [LoginController::class, 'login'])->name('login');
// Route::post('/login', [LoginController::class, 'postlogin'])->name('postlogin');
// Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
// Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// routes/web.php

use App\Http\Controllers\StudentApproveController;

Route::get('/studentapprove', [StudentApproveController::class, 'index'])->name('studentapprove.index');
Route::get('/studentapprove/approve/{id}', [StudentApproveController::class, 'approve'])->name('studentapprove.approve');
Route::get('/studentapprove/reject/{id}', [StudentApproveController::class, 'reject'])->name('studentapprove.reject');
// Route::get('/studentapprove/reject/{id}', [StudentApproveController::class, 'rejectStudent'])->name('studentapprove.reject');



use App\Http\Controllers\CourseController;

Route::get('course', [CourseController::class, 'index'])->name('course.index');
Route::get('course/edit/{id?}', [CourseController::class, 'edit'])->name('course.edit');
Route::post('/course', [CourseController::class, 'store'])->name('course.store');
// Route::get('course/delete/{id}', [CourseController::class, 'destroy'])->name('course.destroy');
Route::delete('/courses/{id}', [CourseController::class, 'destroy'])->name('course.destroy');
Route::put('/course/update/{id}', [CourseController::class, 'update'])->name('course.update');
Route::resource('course', CourseController::class);



use App\Http\Controllers\SemesterController;

Route::get('/semester', [SemesterController::class, 'index'])->name('semester.index');
Route::get('/semester/edit/{id}', [SemesterController::class, 'edit'])->name('semester.edit');
Route::post('/semester', [SemesterController::class, 'store'])->name('semester.store');
Route::delete('/semester/{id}', [SemesterController::class, 'destroy'])->name('semester.destroy');
Route::put('/semester/update/{id}', [SemesterController::class, 'update'])->name('semester.update');

Route::resource('semester', SemesterController::class);


// routes/web.php

use App\Http\Controllers\SubjectController;

Route::get('/subject', [SubjectController::class, 'index'])->name('subject.index');
Route::get('/subject/edit/{id}', [SubjectController::class, 'edit'])->name('subject.edit');
Route::post('/subject', [SubjectController::class, 'store'])->name('subject.store');
Route::delete('/subject/{id}', [SubjectController::class, 'destroy'])->name('subject.destroy');
Route::put('/subject/update/{id}', [SubjectController::class, 'update'])->name('subject.update');
Route::resource('subject', SubjectController::class);


use App\Http\Controllers\TeacherController;

Route::get('/teachers', [TeacherController::class, 'index'])->name('teachers.index');
Route::get('/teachers/edit/{id}', [TeacherController::class, 'edit'])->name('teachers.edit');
Route::post('/teachers', [TeacherController::class, 'store'])->name('teachers.store');
Route::delete('/teachers/{id}', [TeacherController::class, 'destroy'])->name('teachers.destroy');
Route::put('/teachers/update/{id}', [TeacherController::class, 'update'])->name('teachers.update');
Route::resource('teachers', TeacherController::class);

use App\Http\Controllers\AllocateSubjectController;

Route::get('/allocate-subject', [AllocateSubjectController::class, 'index'])->name('allocate-subject.index');
Route::get('/allocate-subject/edit/{id}', [AllocateSubjectController::class, 'edit'])->name('allocate-subject.edit');
Route::post('/allocate-subject', [AllocateSubjectController::class, 'store'])->name('allocate-subject.store');
Route::delete('/allocate-subject/{id}', [AllocateSubjectController::class, 'destroy'])->name('allocate-subject.destroy');
Route::put('/allocate-subject/update/{id}', [AllocateSubjectController::class, 'update'])->name('allocate-subject.update');
Route::resource('allocate-subject', AllocateSubjectController::class);


use App\Http\Controllers\RollNumberController;

Route::get('/genrate_rollno', [RollNumberController::class, 'genrate_rollno'])->name('genrate_rollno');
Route::post('/student-table', [RollNumberController::class, 'partials'])->name('partials.student-table');
Route::post('/fetch-students', [RollNumberController::class, 'fetchStudents']);
Route::post('/genrate_rollno', [RollNumberController::class, 'saveRollNumbers'])->name('saveRollNumbers');


use App\Http\Controllers\StudentController;

Route::get('/s_register', [StudentController::class, 'showRegistrationForm'])->name('register.form');
Route::post('/s_register', [StudentController::class, 'register'])->name('register.submit');

use App\Http\Controllers\CourseSubController;

Route::get('/reports/coursewise-subreport', [CourseSubController::class, 'showForm'])->name('reports.coursewise-subreport');
Route::post('/reports/coursewise-subreport', [CourseSubController::class, 'generateReport'])->name('reports.coursewise-subreport');


use App\Http\Controllers\SemlistSuballotController;
Route::get('/reports/semlist-suballot', [SemlistSuballotController::class, 'reports'])->name('reports.semlist-suballot');
Route::post('/reports/semlist-suballot', [SemlistSuballotController::class, 'generate'])->name('reports.semlist-suballot');

use App\Http\Controllers\SemwiseStudController;
Route::get('/reports/semwise-studentdetail', [SemwiseStudController::class, 'reports'])->name('reports.semwise-studentdetail');
Route::post('/reports/semwise-studentdetail', [SemwiseStudController::class, 'generate'])->name('reports.semwise-studentdetail');

// use App\Http\Controllers\ProfileController;
// Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
// Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
use App\Http\Controllers\ProfileController;

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});


// Route::group(['middleware' => ['role:super-admin|admin']], function() {

    // Route::resource('permissions', App\Http\Controllers\PermissionController::class);
    // Route::get('permissions/{permissionId}/delete', [App\Http\Controllers\PermissionController::class, 'destroy']);

    // Route::resource('roles', App\Http\Controllers\RoleController::class);
    // Route::get('roles/{roleId}/delete', [App\Http\Controllers\RoleController::class, 'destroy']);
    // Route::get('roles/{roleId}/give-permissions', [App\Http\Controllers\RoleController::class, 'addPermissionToRole']);
    // Route::put('roles/{roleId}/give-permissions', [App\Http\Controllers\RoleController::class, 'givePermissionToRole']);

    // Route::resource('users', App\Http\Controllers\UserController::class);
    // Route::get('users/{userId}/delete', [App\Http\Controllers\UserController::class, 'destroy']);

// });
// use App\Http\Controllers\LogoutController;

// Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');


// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('permissions', PermissionController::class);
    Route::resource('teachers', TeacherController::class);
});

Route::get('/demo',function() {
    return view('demo');
});
