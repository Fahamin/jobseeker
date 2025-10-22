<!-- resources/views/admin/questions/index.blade.php -->
@extends('layouts.app')

@section('title', 'Manage Questions')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4>All Questions</h4>
    <a href="{{ route('admin.questions.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-2"></i>Add New Question
    </a>
</div>

<div class="card">
    <div class="card-body">
        @if($questions->count() > 0)
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Question</th>
                            <th>Options</th>
                            <th>Correct Answer</th>
                            <th>Marks</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($questions as $question)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <div class="question-text" style="max-width: 300px;">
                                    {{ Str::limit($question->question_text, 100) }}
                                </div>
                            </td>
                            <td>
                                <small>
                                    <strong>A:</strong> {{ Str::limit($question->option_a, 20) }}<br>
                                    <strong>B:</strong> {{ Str::limit($question->option_b, 20) }}<br>
                                    <strong>C:</strong> {{ Str::limit($question->option_c, 20) }}<br>
                                    <strong>D:</strong> {{ Str::limit($question->option_d, 20) }}
                                </small>
                            </td>
                            <td>
                                <span class="badge bg-success">{{ strtoupper($question->correct_answer) }}</span>
                            </td>
                            <td>{{ $question->marks }}</td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('admin.questions.show', $question->id) }}" 
                                       class="btn btn-info" title="View">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.questions.edit', $question->id) }}" 
                                       class="btn btn-warning" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button type="button" class="btn btn-danger" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#deleteModal{{ $question->id }}"
                                            title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>

                                <!-- Delete Modal -->
                                <div class="modal fade" id="deleteModal{{ $question->id }}" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Confirm Delete</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                Are you sure you want to delete this question?
                                                <br><br>
                                                <strong>{{ Str::limit($question->question_text, 150) }}</strong>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                <form action="{{ route('admin.questions.destroy', $question->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            <div class="d-flex justify-content-center">
                {{ $questions->links() }}
            </div>
        @else
            <div class="text-center py-4">
                <i class="fas fa-question-circle fa-3x text-muted mb-3"></i>
                <h5>No Questions Found</h5>
                <p class="text-muted">Get started by adding your first question.</p>
                <a href="{{ route('admin.questions.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i>Add First Question
                </a>
            </div>
        @endif
    </div>
</div>
@endsection