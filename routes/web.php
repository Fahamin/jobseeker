<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\JobPostController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\JobApplicationController;



Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::post('/apply-job', [JobApplicationController::class, 'store'])->name('apply.job');
    Route::get('/my-applications', [JobApplicationController::class, 'index'])->name('applications.index');
});


Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])->name('dashboard');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('questions', QuestionController::class);

});

Route::resource('categories', CategoryController::class);

Route::resource('job_posts', JobPostController::class);

    Route::get('/results', [ResultController::class, 'index'])->name('results.index');
    Route::get('/results/{id}', [ResultController::class, 'show'])->name('results.show');

require __DIR__.'/auth.php';
