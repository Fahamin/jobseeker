<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\ExamResult;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    public function index()
    {
        $results = ExamResult::with('user')
                            ->latest()
                            ->paginate(10);
        return view('admin.results.index', compact('results'));
    }

    public function show($id)
    {
        $result = ExamResult::with('user')->findOrFail($id);
        return view('admin.results.show', compact('result'));
    }
}