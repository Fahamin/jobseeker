<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\JobPost;

class CategoryApiController extends Controller
{
    public function index()
    {
         $categories = Category::withCount('jobPosts')
        ->get();

        return response()->json([
            'success' => true,
            'message' => 'All categories fetched successfully',
            'data' => $categories,
        ], 200);
    }


    public function jobsByCategory($categoryId)
{
    $jobs = JobPost::where('category_id', $categoryId)->get();

    if ($jobs->isEmpty()) {
        return response()->json([
            'status' => false,
            'message' => 'No jobs found for this category.'
        ]);
    }

    return response()->json([
        'status' => true,
        'message' => 'Jobs fetched successfully.',
        'count' => $jobs->count(),
        'jobcatlist' => $jobs
    ]);
}

}
