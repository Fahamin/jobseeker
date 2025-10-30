<?php

use App\Http\Controllers\Api\QuestionApiController;
use App\Http\Controllers\Api\ExamApiController;
use App\Http\Controllers\Api\JobPostApiController;

use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Api\CategoryApiController;

// Public
Route::post('/register', [AuthApiController::class, 'register']);
Route::post('/login',    [AuthApiController::class, 'login']);
Route::post('/forgot-password', [AuthApiController::class, 'forgotPassword']);
Route::post('/reset-password',  [AuthApiController::class, 'resetPassword']);

// If you want email verification via API (optional)
Route::get('/email/verify/{id}/{hash}', [AuthApiController::class, 'verifyEmail'])
    ->name('verification.verify');

// Protected
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthApiController::class, 'logout']);
    Route::get('/user',    [AuthApiController::class, 'user']);
});

Route::get('/categories', [CategoryApiController::class, 'index']);
Route::get('/categories/{id}/jobs', [CategoryApiController::class, 'jobsByCategory']);

Route::get('/job-posts', [JobPostApiController::class, 'index']);        // List job posts
Route::get('/job-posts/{id}', [JobPostApiController::class, 'show']);   // Get job post details
Route::post('/job-posts', [JobPostApiController::class, 'store']);      // Create job post
Route::put('/job-posts/{id}', [JobPostApiController::class, 'update']); // Update job post
Route::delete('/job-posts/{id}', [JobPostApiController::class, 'destroy']); //

// Public routes for questions
Route::apiResource('questions', QuestionApiController::class);

// Exam routes
Route::prefix('exam')->group(function () {
    Route::get('/questions', [ExamApiController::class, 'getExamQuestions']);
    Route::post('/submit', [ExamApiController::class, 'submitExam']);
    Route::get('/results/{user_id}', [ExamApiController::class, 'getResults']);
});