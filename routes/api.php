<?php


use App\Http\Controllers\Api\JobPostApiController;

Route::get('/job-posts', [JobPostApiController::class, 'index']);        // List job posts
Route::get('/job-posts/{id}', [JobPostApiController::class, 'show']);   // Get job post details
Route::post('/job-posts', [JobPostApiController::class, 'store']);      // Create job post
Route::put('/job-posts/{id}', [JobPostApiController::class, 'update']); // Update job post
Route::delete('/job-posts/{id}', [JobPostApiController::class, 'destroy']); //

