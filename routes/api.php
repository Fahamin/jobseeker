<?php

use App\Http\Controllers\Api\QuestionController;
use App\Http\Controllers\Api\ExamController;
use App\Http\Controllers\Api\JobPostApiController;

use App\Http\Controllers\Api\AuthController;

// Public
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login',    [AuthController::class, 'login']);
Route::post('/forgot-password', [AuthController::class, 'forgotPassword']);
Route::post('/reset-password',  [AuthController::class, 'resetPassword']);

// If you want email verification via API (optional)
Route::get('/email/verify/{id}/{hash}', [AuthController::class, 'verifyEmail'])
    ->name('verification.verify');

// Protected
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user',    [AuthController::class, 'user']);
});

Route::get('/job-posts', [JobPostApiController::class, 'index']);        // List job posts
Route::get('/job-posts/{id}', [JobPostApiController::class, 'show']);   // Get job post details
Route::post('/job-posts', [JobPostApiController::class, 'store']);      // Create job post
Route::put('/job-posts/{id}', [JobPostApiController::class, 'update']); // Update job post
Route::delete('/job-posts/{id}', [JobPostApiController::class, 'destroy']); //

// Public routes for questions
Route::apiResource('questions', QuestionController::class);

// Exam routes
Route::prefix('exam')->group(function () {
    Route::get('/questions', [ExamController::class, 'getExamQuestions']);
    Route::post('/submit', [ExamController::class, 'submitExam']);
    Route::get('/results/{user_id}', [ExamController::class, 'getResults']);
});