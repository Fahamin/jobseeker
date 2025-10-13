<?php

namespace App\Http\Controllers;
use App\Models\JobPost;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        if (auth()->check() && auth()->user()->is_admin) {
            
            $jobPosts = JobPost::with('category')
                ->latest()
                ->paginate(10);

            // Add statistics for the dashboard
            $activeJobs = JobPost::where('is_active', true)->count();
            $expiredJobs = JobPost::where('dateline', '<', now())->count();
            $thisMonthJobs = JobPost::whereMonth('created_at', now()->month)->count();

            return view('admin.dashboard',compact('jobPosts', 'activeJobs', 'expiredJobs', 'thisMonthJobs'));
        } else {
            return view('dashboard');
        }
    }
}
