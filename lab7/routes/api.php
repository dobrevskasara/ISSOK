<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\EnrollmentController;
use Illuminate\Support\Facades\Route;

Route::apiResource('/courses', CourseController::class);

Route::get('/courses', [CourseController::class, 'index']);
Route::post('/courses', [CourseController::class, 'store']);
Route::get('/courses/{course}', [CourseController::class, 'show']);
Route::put('/courses/{course}', [CourseController::class, 'update']);
Route::delete('/courses/{course}', [CourseController::class, 'destroy']);

Route::post('enrollments',[EnrollmentController::class,'store']);
Route::get('enrollments',[EnrollmentController::class,'index']);
Route::put('enrollments/{enrollment}/approve',[EnrollmentController::class,'approve']);
Route::put('enrollments/{enrollment}/drop',[EnrollmentController::class,'drop']);

