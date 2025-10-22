<!-- resources/views/admin/questions/show.blade.php -->
@extends('layouts.app')

@section('title', 'Question Details')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5>Question Details</h5>
        <div class="btn-group">
            <a href="{{ route('admin.questions.edit', $question->id) }}" class="btn btn-warning btn-sm">
                <i class="fas fa-edit me-1"></i>Edit
            </a>
            <a href="{{ route('admin.questions.index') }}" class="btn btn-secondary btn-sm">
                <i class="fas fa-arrow-left me-1"></i>Back
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-8">
                <table class="table table-bordered">
                    <tr>
                        <th width="30%">Question ID</th>
                        <td>{{ $question->id }}</td>
                    </tr>
                    <tr>
                        <th>Question Text</th>
                        <td>{{ $question->question_text }}</td>
                    </tr>
                    <tr>
                        <th>Options</th>
                        <td>
                            <div class="mb-2">
                                <strong>A:</strong> {{ $question->option_a }}
                            </div>
                            <div class="mb-2">
                                <strong>B:</strong> {{ $question->option_b }}
                            </div>
                            <div class="mb-2">
                                <strong>C:</strong> {{ $question->option_c }}
                            </div>
                            <div class="mb-2">
                                <strong>D:</strong> {{ $question->option_d }}
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>Correct Answer</th>
                        <td>
                            <span class="badge bg-success fs-6">
                                Option {{ strtoupper($question->correct_answer) }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <th>Marks</th>
                        <td>{{ $question->marks }}</td>
                    </tr>
                    <tr>
                        <th>Created At</th>
                        <td>{{ $question->created_at->format('M d, Y h:i A') }}</td>
                    </tr>
                    <tr>
                        <th>Updated At</th>
                        <td>{{ $question->updated_at->format('M d, Y h:i A') }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection