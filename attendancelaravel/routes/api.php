<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PassportController;
use App\Http\Controllers\Api\StudattendController as ApiStudattendController;
use App\Http\Controllers\Api\TeacherdController;
use App\Http\Controllers\Api\UserController;
use App\Models\Teacher;
use App\Http\Controllers\Api\AttendenceController;
// use App\Http\Controllers\Api\LectureController;
use App\Http\Controllers\Api\LectureController;
// use App\Http\Controllers\LectureController ;

// use App\Http\Controllers\LectureController;
// use App\Http\Controllers\StudattendController;
// use App\Http\Controllers\Api\ProfileController;

// Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
// Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('login', [PassportController::class, 'login'])->name('login');


Route::get('/teachers', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

// Route::post('register', [UserController::class, 'userregister'])->name('register');
Route::post('teachers', [UserController::class, 'userlogin'])->name('teachers');
Route::get('session',[UserController::class, 'loginn'])->name('session');

// Route::get('/all_teacher/{id}',function($id){
//     $teacher = Teacher::find($id);
//     return $teacher;
// });

use App\Http\Controllers\Api\ProfileController;

Route::get('/profile', [ProfileController::class, 'show'])->name('profile')->middleware('auth');
Route::get('/teachers/{t_email}', [ProfileController::class, 'teachers']);
// Route::post('/profile/{id}', [ProfileController::class, 'update'])->name('profile.update')->middleware('auth');
Route::put('/teachers/update/{t_email}', [ProfileController::class, 'update']);

// use App\Http\Controllers\Api\ProfileController;

// Fetch the profile data for the authenticated user
// Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show')->middleware('auth:api');
// Route::get('/teachers/{t_email}', [ProfileController::class, 'teachers']);

// // Update the profile for the authenticated user
// Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update')->middleware('auth:api');

Route::get('/allocate-subject/{teacherId}',[TeacherdController::class,'index']);
//Route::get('course', [TeacherdController::class, 'courses'])->name('course');

Route::get('/course', [TeacherdController::class, 'course']);
Route::get('/semester', [TeacherdController::class, 'semester']);
Route::get('/semester_find/{id}', [TeacherdController::class, 'semester_find']);
Route::get('/subject', [TeacherdController::class, 'subject']);
Route::get('/teacher', [TeacherdController::class, 'teacher']);

Route::get('/student_count/{id}', [TeacherdController::class, 'getStudentCountBySemester']);
// Route::get('/studentssemcourse/{sem_id}', [TeacherdController::class, 'courseStudentCountBySemester']);


Route::get('/users',[UserController::class, 'login']);




// Route::prefix('lectures')->group(function () {

Route::get('/lectures', [LectureController::class, 'index']);
Route::get('/lectures/{id}', [LectureController::class, 'show']);
Route::post('/lectures', [LectureController::class, 'store']);
Route::put('/lectures/{id}', [LectureController::class, 'update']);
Route::delete('/lectures/{id}', [LectureController::class, 'destroy']);
Route::post('/fetch-students-attendance', [LectureController::class, 'fetchStudentsAttendance']);
// });

// routes/api.php

Route::get('/attendance', [AttendenceController::class, 'index']);             // Get all attendance records
Route::put('/attendance/{s_id}', [AttendenceController::class, 'updateAttendance']);
Route::get('/attendance/{lec_id}', [AttendenceController::class, 'show']);     // Get attendance for a specific lecture
Route::post('/attendance', [AttendenceController::class, 'store']);            // Create attendance record
Route::put('/attendance/{id}', [AttendenceController::class, 'update']);       // Update attendance record
Route::delete('/attendance/{id}', [AttendenceController::class, 'destroy']);   // Delete attendance record
Route::put('/update_attendance/{s_id}/{lec_id}', [AttendenceController::class, 'updateAttendence']);
// Route::get('/attendance', [AttendenceController::class, 'index']);             // Get all attendance records
// Route::get('/attendance/{lec_id}', [AttendenceController::class, 'show']);     // Get attendance for a specific lecture
// Route::post('/attendance', [AttendenceController::class, 'store']);            // Create attendance record
// Route::put('/attendance/{id}', [AttendenceController::class, 'update']);       // Update attendance record
// Route::delete('/attendance/{id}', [AttendenceController::class, 'destroy']);   // Delete attendance record
use App\Http\Controllers\StudAttendController;

Route::get('/stud_attend', [StudAttendController::class, 'index']); // Get all attendance records
Route::post('/stud_attend', [StudAttendController::class, 'store']); // Store a new attendance record
Route::get('/stud_attend/{lec_id}', [StudAttendController::class, 'show']); // Get attendance records by lecture ID
Route::put('/stud_attend/{id}', [StudAttendController::class, 'update']); // Update an attendance record
Route::delete('/stud_attend/{id}', [StudAttendController::class, 'destroy']); // Delete an attendance record
// use App\Http\Controllers\StudattendController;

// Route::get('/attendances', [StudattendController::class, 'index']); // Get all attendance records
// Route::get('/attendances/{lec_id}', [StudattendController::class, 'show']); // Get attendance records by lecture ID
// Route::post('/attendances', [StudattendController::class, 'store']); // Store new attendance record
// Route::put('/attendances/{id}', [StudattendController::class, 'update']); // Update attendance record
// Route::delete('/attendances/{id}', [StudattendController::class, 'destroy']); // Delete attendance record

// Route::get('/session', function () {
//     return response()->json([
//         'userName' => session('name'),
//         'userDesig' => session('designation'),
//     ]);
// });
use App\Http\Controllers\Api\StudentController;

Route::get('/students',[StudentController::class,'index']);

Route::get('/students_attendence/{id}',[StudentController::class,'attendence']);
Route::get('/attendance_count/{semester}/{course}/{date}', [StudentController::class, 'getAttendanceCount']);

// use App\Http\Controllers\Api\SessionController;

// Route::get('/session', [SessionController::class, 'getSessionData']);
