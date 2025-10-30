<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\JobPost;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class JobPostApiController extends Controller
{
    // GET /api/job-posts
    public function index()
    {
        $jobPosts = JobPost::select('id', 'title','image','salary',"location","company", 'dateline','category_id')
            ->with('category:id,name') // only get id and name from category
            ->latest()->get();
            

        return response()->json([
            'status' => true,
            'message' => 'Job posts fetched successfully.',
            'joblist' => $jobPosts
        ]);
    }

    // GET /api/job-posts/{id}
    public function show($id)
    {
        $jobPost = JobPost::with('category')->find($id);

        if (!$jobPost) {
            return response()->json([
                'status' => false,
                'message' => 'Job post not found.'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'Job post details fetched successfully.',
            'data' => $jobPost
        ]);
    }

    // POST /api/job-posts
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'type' => 'required|in:Full-time,Part-time,Remote,Contract',
            'category_id' => 'required|exists:categories,id',
            'salary' => 'nullable|string|max:255',
            'description' => 'required|string',
            'requirements' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'pdf' => 'nullable|mimes:pdf|max:5120',
            'publishdate' => 'nullable|date|after_or_equal:today',
            'dateline' => 'nullable|date|after:today',
            'is_active' => 'sometimes|boolean'
        ]);

        try {
            if ($request->hasFile('image')) {
                $validated['image'] = $request->file('image')->store('job-images', 'public');
            }

            if ($request->hasFile('pdf')) {
                $validated['pdf'] = $request->file('pdf')->store('job-pdfs', 'public');
            }

            // Handle requirements
            if (!empty($validated['requirements'])) {
                $validated['requirements'] = array_filter(
                    array_map('trim', explode("\n", $validated['requirements']))
                );
            }

            $validated['is_active'] = $request->boolean('is_active', true);
            $validated['publishdate'] = $validated['publishdate'] ?? now();

            $jobPost = JobPost::create($validated);

            return response()->json([
                'status' => true,
                'message' => 'Job post created successfully.',
                'data' => $jobPost
            ], 201);

        } catch (\Exception $e) {
            Log::error('Job post creation failed: ' . $e->getMessage());

            return response()->json([
                'status' => false,
                'message' => 'Failed to create job post.'
            ], 500);
        }
    }

    // PUT /api/job-posts/{id}
    public function update(Request $request, $id)
    {
        $jobPost = JobPost::find($id);

        if (!$jobPost) {
            return response()->json([
                'status' => false,
                'message' => 'Job post not found.'
            ], 404);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'type' => 'required|in:Full-time,Part-time,Remote,Contract',
            'category_id' => 'required|exists:categories,id',
            'salary' => 'nullable|string|max:255',
            'description' => 'required|string',
            'requirements' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'pdf' => 'nullable|mimes:pdf|max:5120',
            'publishdate' => 'nullable|date',
            'dateline' => 'nullable|date|after:publishdate',
            'is_active' => 'sometimes|boolean'
        ]);

        try {
            if ($request->hasFile('image')) {
                if ($jobPost->image) {
                    Storage::disk('public')->delete($jobPost->image);
                }
                $validated['image'] = $request->file('image')->store('job-images', 'public');
            }

            if ($request->hasFile('pdf')) {
                if ($jobPost->pdf) {
                    Storage::disk('public')->delete($jobPost->pdf);
                }
                $validated['pdf'] = $request->file('pdf')->store('job-pdfs', 'public');
            }

            if (!empty($validated['requirements'])) {
                $validated['requirements'] = array_filter(
                    array_map('trim', explode("\n", $validated['requirements']))
                );
            }

            $validated['is_active'] = $request->boolean('is_active', $jobPost->is_active);

            $jobPost->update($validated);

            return response()->json([
                'status' => true,
                'message' => 'Job post updated successfully.',
                'data' => $jobPost
            ]);

        } catch (\Exception $e) {
            Log::error('Job post update failed: ' . $e->getMessage());

            return response()->json([
                'status' => false,
                'message' => 'Failed to update job post.'
            ], 500);
        }
    }

    // DELETE /api/job-posts/{id}
    public function destroy($id)
    {
        $jobPost = JobPost::find($id);

        if (!$jobPost) {
            return response()->json([
                'status' => false,
                'message' => 'Job post not found.'
            ], 404);
        }

        try {
            if ($jobPost->image) {
                Storage::disk('public')->delete($jobPost->image);
            }
            if ($jobPost->pdf) {
                Storage::disk('public')->delete($jobPost->pdf);
            }

            $jobPost->delete();

            return response()->json([
                'status' => true,
                'message' => 'Job post deleted successfully.'
            ]);

        } catch (\Exception $e) {
            Log::error('Job post deletion failed: ' . $e->getMessage());

            return response()->json([
                'status' => false,
                'message' => 'Failed to delete job post.'
            ], 500);
        }
    }
}
