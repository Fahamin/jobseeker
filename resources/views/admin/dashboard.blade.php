@extends('components.layout')
@extends('layouts.app')
@section('content')
<div class="max-w-7xl mx-auto">
    <!-- Header -->
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Dashboard</h1>
        </div>
      
    </div>

    <!-- Stats -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white p-6 rounded-lg shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600">Total Jobs</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $jobPosts->total() }}</p>
                </div>
                <i class="fas fa-briefcase text-blue-500 text-2xl"></i>
            </div>
        </div>
        <div class="bg-white p-6 rounded-lg shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600">Active Jobs</p>
                    <p class="text-2xl font-bold text-green-600">{{ $activeJobs }}</p>
                </div>
                <i class="fas fa-check-circle text-green-500 text-2xl"></i>
            </div>
        </div>
        <div class="bg-white p-6 rounded-lg shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600">Expired Jobs</p>
                    <p class="text-2xl font-bold text-red-600">{{ $expiredJobs }}</p>
                </div>
                <i class="fas fa-clock text-red-500 text-2xl"></i>
            </div>
        </div>
        <div class="bg-white p-6 rounded-lg shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600">This Month</p>
                    <p class="text-2xl font-bold text-purple-600">{{ $thisMonthJobs }}</p>
                </div>
                <i class="fas fa-calendar text-purple-500 text-2xl"></i>
            </div>
        </div>
    </div>

    
 <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
    <!-- Average Score Card -->
    <div class="bg-white p-6 rounded-lg shadow">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600">Average Score</p>
                <p class="text-2xl font-bold text-gray-800">{{ $averageScore }}</p>
            </div>
            <i class="fas fa-chart-line text-blue-500 text-2xl"></i>
        </div>
    </div>
    
    <!-- Total Users Card -->
    <div class="bg-white p-6 rounded-lg shadow">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600">Total Users</p>
                <p class="text-2xl font-bold text-green-600">{{ $totalUsers }}</p>
            </div>
            <i class="fas fa-users text-green-500 text-2xl"></i>
        </div>
    </div>
    
    <!-- Total Exams Card -->
    <div class="bg-white p-6 rounded-lg shadow">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600">Total Exams</p>
                <p class="text-2xl font-bold text-red-600">{{ $totalResults }}</p>
            </div>
            <i class="fas fa-file-alt text-red-500 text-2xl"></i>
        </div>
    </div>
    
    <!-- Total Questions Card -->
    <div class="bg-white p-6 rounded-lg shadow">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600">Total Questions</p>
                <p class="text-2xl font-bold text-purple-600">{{ $totalQuestions }}</p>
            </div>
            <i class="fas fa-question-circle text-purple-500 text-2xl"></i>
        </div>
    </div>
</div>



@endsection