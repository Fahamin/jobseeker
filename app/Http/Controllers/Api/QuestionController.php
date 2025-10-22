<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function index()
    {
        $questions = Question::select('id', 'question_text', 'option_a', 'option_b', 'option_c', 'option_d', 'marks')
                            ->get();
        
        return response()->json([
            'success' => true,
            'data' => $questions,
            'message' => 'Questions retrieved successfully'
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'question_text' => 'required|string',
            'option_a' => 'required|string',
            'option_b' => 'required|string',
            'option_c' => 'required|string',
            'option_d' => 'required|string',
            'correct_answer' => 'required|in:a,b,c,d',
            'marks' => 'required|integer|min:1'
        ]);

        $question = Question::create($validated);

        return response()->json([
            'success' => true,
            'data' => $question,
            'message' => 'Question created successfully'
        ], 201);
    }

    public function show(Question $question)
    {
        return response()->json([
            'success' => true,
            'data' => $question,
            'message' => 'Question retrieved successfully'
        ]);
    }

    public function update(Request $request, Question $question)
    {
        $validated = $request->validate([
            'question_text' => 'sometimes|required|string',
            'option_a' => 'sometimes|required|string',
            'option_b' => 'sometimes|required|string',
            'option_c' => 'sometimes|required|string',
            'option_d' => 'sometimes|required|string',
            'correct_answer' => 'sometimes|required|in:a,b,c,d',
            'marks' => 'sometimes|required|integer|min:1'
        ]);

        $question->update($validated);

        return response()->json([
            'success' => true,
            'data' => $question,
            'message' => 'Question updated successfully'
        ]);
    }

    public function destroy(Question $question)
    {
        $question->delete();

        return response()->json([
            'success' => true,
            'message' => 'Question deleted successfully'
        ]);
    }
}