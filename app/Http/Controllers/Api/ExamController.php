<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\ExamResult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExamController extends Controller
{
    public function getExamQuestions()
    {
        $questions = Question::select('id', 'question_text', 'option_a', 'option_b', 'option_c', 'option_d', 'marks')
                            ->inRandomOrder()
                            ->limit(20) // 20 questions for exam
                            ->get();

        return response()->json([
            'success' => true,
            'data' => $questions,
            'message' => 'Exam questions retrieved successfully'
        ]);
    }

    public function submitExam(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'answers' => 'required|array',
            'answers.*.question_id' => 'required|exists:questions,id',
            'answers.*.selected_answer' => 'required|in:a,b,c,d'
        ]);

        $correctAnswers = 0;
        $totalMarks = 0;
        $obtainedMarks = 0;

        foreach ($validated['answers'] as $answer) {
            $question = Question::find($answer['question_id']);
            $totalMarks += $question->marks;

            if ($question->correct_answer === $answer['selected_answer']) {
                $correctAnswers++;
                $obtainedMarks += $question->marks;
            }
        }

        $wrongAnswers = count($validated['answers']) - $correctAnswers;
        $score = ($obtainedMarks / $totalMarks) * 100;

        // Save exam result
        $examResult = ExamResult::create([
            'user_id' => $validated['user_id'],
            'total_questions' => count($validated['answers']),
            'correct_answers' => $correctAnswers,
            'wrong_answers' => $wrongAnswers,
            'score' => $score,
            'exam_date' => now()
        ]);

        return response()->json([
            'success' => true,
            'data' => [
                'result_id' => $examResult->id,
                'total_questions' => $examResult->total_questions,
                'correct_answers' => $examResult->correct_answers,
                'wrong_answers' => $examResult->wrong_answers,
                'score' => $examResult->score,
                'obtained_marks' => $obtainedMarks,
                'total_marks' => $totalMarks,
                'exam_date' => $examResult->exam_date
            ],
            'message' => 'Exam submitted successfully'
        ]);
    }

    public function getResults($user_id)
    {
        $results = ExamResult::where('user_id', $user_id)
                            ->orderBy('created_at', 'desc')
                            ->get();

        return response()->json([
            'success' => true,
            'data' => $results,
            'message' => 'Exam results retrieved successfully'
        ]);
    }
}