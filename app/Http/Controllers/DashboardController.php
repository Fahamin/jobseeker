<?php

namespace App\Http\Controllers;
use App\Models\JobPost;
use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\ExamResult;
use App\Models\User;
class DashboardController extends Controller
{
    public function index()
    {
        if (auth()->check() && auth()->user()->is_admin) {

            $totalQuestions = Question::count();
            $totalResults = ExamResult::count();
            $totalUsers = User::count();
            $averageScore = ExamResult::avg('score') ?? 0;
            $recentResults = ExamResult::with('user')
                ->orderBy('created_at', 'desc')
                ->limit(5)
                ->get();


            $jobPosts = JobPost::with('category')
                ->latest()
                ->paginate(10);

            // Add statistics for the dashboard
            $activeJobs = JobPost::where('is_active', true)->count();
            $expiredJobs = JobPost::where('dateline', '<', now())->count();
            $thisMonthJobs = JobPost::whereMonth('created_at', now()->month)->count();

            return view('admin.dashboard', compact(
                'jobPosts',
                'activeJobs',
                'expiredJobs',
                'thisMonthJobs',
                'totalQuestions',
                'totalResults',
                'totalUsers',
                'averageScore',
                'recentResults',
            ));
        } else {
            return view('dashboard');
        }
    }
}
