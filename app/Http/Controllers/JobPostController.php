<?php

namespace App\Http\Controllers;

use App\Models\JobPost;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class JobPostController extends Controller
{
    public function index()
    {
        $jobPosts = JobPost::with('category')
            ->latest()
            ->paginate(10);
            
        // Add statistics for the dashboard
        $activeJobs = JobPost::where('is_active', true)->count();
        $expiredJobs = JobPost::where('dateline', '<', now())->count();
        $thisMonthJobs = JobPost::whereMonth('created_at', now()->month)->count();

        return view('job_posts.index', compact('jobPosts', 'activeJobs', 'expiredJobs', 'thisMonthJobs'));
    }

    public function create()
    {
        $categories = Category::all();
        $jobTypes = ['Full-time', 'Part-time', 'Remote', 'Contract'];
        return view('job_posts.create', compact('categories', 'jobTypes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'type' => 'required|in:Full-time,Part-time,Remote,Contract',
            'category' => 'required|string|max:255',
            'salary' => 'nullable|string|max:255',
            'description' => 'required|string',
            'requirements' => 'nullable|string', // Changed from array to string
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'pdf' => 'nullable|mimes:pdf|max:5120', // Increased to 5MB
            'publishdate' => 'nullable|date|after_or_equal:today',
            'dateline' => 'nullable|date|after:today',
            'is_active' => 'sometimes|boolean',
            'category_id' => 'required|exists:categories,id'
        ]);

        try {
            // Handle file uploads
            if ($request->hasFile('image')) {
                $validated['image'] = $request->file('image')->store('job-images', 'public');
            }

            if ($request->hasFile('pdf')) {
                $validated['pdf'] = $request->file('pdf')->store('job-pdfs', 'public');
            }

            // Convert requirements from string to array
            if ($request->has('requirements') && !empty($request->requirements)) {
                $requirementsArray = array_filter(
                    array_map('trim', explode("\n", $request->requirements))
                );
                $validated['requirements'] = $requirementsArray;
            } else {
                $validated['requirements'] = null;
            }

            // Set default values
            $validated['is_active'] = $request->has('is_active');
            $validated['publishdate'] = $validated['publishdate'] ?? now();

            JobPost::create($validated);

            return redirect()->route('job_posts.index')
                ->with('success', 'Job post created successfully.');

        } catch (\Exception $e) {
            Log::error('Job post creation failed: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Failed to create job post. Please try again.')
                ->withInput();
        }
    }

    public function show(JobPost $jobPost) // Changed to camelCase
    {
        return view('job_posts.show', compact('jobPost'));
    }

    public function edit(JobPost $jobPost) // Changed to camelCase
    {
        $categories = Category::all();
        $jobTypes = ['Full-time', 'Part-time', 'Remote', 'Contract'];
        return view('job_posts.edit', compact('jobPost', 'categories', 'jobTypes'));
    }

    public function update(Request $request, JobPost $jobPost) // Changed to camelCase
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'type' => 'required|in:Full-time,Part-time,Remote,Contract',
            'category' => 'required|string|max:255',
            'salary' => 'nullable|string|max:255',
            'description' => 'required|string',
            'requirements' => 'nullable|string', // Changed from array to string
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'pdf' => 'nullable|mimes:pdf|max:5120',
            'publishdate' => 'nullable|date',
            'dateline' => 'nullable|date|after:publishdate',
            'is_active' => 'sometimes|boolean',
            'category_id' => 'required|exists:categories,id'
        ]);

        try {
            // Handle file uploads
            if ($request->hasFile('image')) {
                // Delete old image if exists
                if ($jobPost->image) {
                    Storage::disk('public')->delete($jobPost->image);
                }
                $validated['image'] = $request->file('image')->store('job-images', 'public');
            }

            if ($request->hasFile('pdf')) {
                // Delete old PDF if exists
                if ($jobPost->pdf) {
                    Storage::disk('public')->delete($jobPost->pdf);
                }
                $validated['pdf'] = $request->file('pdf')->store('job-pdfs', 'public');
            }

            // Convert requirements from string to array
            if ($request->has('requirements') && !empty($request->requirements)) {
                $requirementsArray = array_filter(
                    array_map('trim', explode("\n", $request->requirements))
                );
                $validated['requirements'] = $requirementsArray;
            } else {
                $validated['requirements'] = null;
            }

            // Handle checkbox
            $validated['is_active'] = $request->has('is_active');

            $jobPost->update($validated);

            return redirect()->route('job_posts.index')
                ->with('success', 'Job post updated successfully.');

        } catch (\Exception $e) {
            Log::error('Job post update failed: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Failed to update job post. Please try again.')
                ->withInput();
        }
    }

    public function destroy(JobPost $jobPost) // Changed to camelCase
    {
        try {
            // Delete associated files
            if ($jobPost->image) {
                Storage::disk('public')->delete($jobPost->image);
            }
            if ($jobPost->pdf) {
                Storage::disk('public')->delete($jobPost->pdf);
            }

            $jobPost->delete();

            return redirect()->route('job_posts.index')
                ->with('success', 'Job post deleted successfully.');

        } catch (\Exception $e) {
            Log::error('Job post deletion failed: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Failed to delete job post. Please try again.');
        }
    }
}