<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobApplication;
use Illuminate\Support\Facades\Auth;

class JobApplicationController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'job_post_id' => 'required|exists:job_posts,id',
            'resume' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'cover_letter' => 'nullable|string',
        ]);

        $resumePath = null;
        if ($request->hasFile('resume')) {
            $resumePath = $request->file('resume')->store('resumes', 'public');
        }

        JobApplication::create([
            'user_id' => Auth::id(),
            'job_post_id' => $request->job_post_id,
            'resume' => $resumePath,
            'cover_letter' => $request->cover_letter,
        ]);

        return back()->with('success', 'Your application has been submitted successfully!');
    }

    public function index()
    {
        $applications = JobApplication::with('job')->where('user_id', Auth::id())->get();
        return view('applications.index', compact('applications'));
    }
}
