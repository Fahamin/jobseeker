<!-- resources/views/admin/results/index.blade.php -->
@extends('layouts.app')

@section('title', 'Exam Results')

@section('content')
<div class="card">
    <div class="card-header">
        <h5>All Exam Results</h5>
    </div>
    <div class="card-body">
        @if($results->count() > 0)
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>User ID</th>
                            <th>Total Questions</th>
                            <th>Correct</th>
                            <th>Wrong</th>
                            <th>Score</th>
                            <th>Exam Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($results as $result)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>User #{{ $result->user_id }}</td>
                            <td>{{ $result->total_questions }}</td>
                            <td>
                                <span class="badge bg-success">{{ $result->correct_answers }}</span>
                            </td>
                            <td>
                                <span class="badge bg-danger">{{ $result->wrong_answers }}</span>
                            </td>
                            <td>
                                <span class="badge bg-{{ $result->score >= 50 ? 'success' : ($result->score >= 30 ? 'warning' : 'danger') }}">
                                    {{ number_format($result->score, 2) }}%
                                </span>
                            </td>
                            <td>{{ $result->exam_date->format('M d, Y h:i A') }}</td>
                            <td>
                                <button class="btn btn-info btn-sm" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#resultModal{{ $result->id }}">
                                    <i class="fas fa-eye"></i> View
                                </button>

                                <!-- Result Details Modal -->
                                <div class="modal fade" id="resultModal{{ $result->id }}" tabindex="-1">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Exam Result Details</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <p><strong>User ID:</strong> {{ $result->user_id }}</p>
                                                        <p><strong>Total Questions:</strong> {{ $result->total_questions }}</p>
                                                        <p><strong>Correct Answers:</strong> {{ $result->correct_answers }}</p>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <p><strong>Wrong Answers:</strong> {{ $result->wrong_answers }}</p>
                                                        <p><strong>Score:</strong> {{ number_format($result->score, 2) }}%</p>
                                                        <p><strong>Exam Date:</strong> {{ $result->exam_date->format('M d, Y h:i A') }}</p>
                                                    </div>
                                                </div>
                                                
                                                <div class="progress mb-3">
                                                    <div class="progress-bar bg-success" 
                                                         style="width: {{ $result->score }}%">
                                                        {{ number_format($result->score, 2) }}%
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
                {{ $results->links() }}
            </div>
        @else
            <div class="text-center py-4">
                <i class="fas fa-chart-bar fa-3x text-muted mb-3"></i>
                <h5>No Exam Results Found</h5>
                <p class="text-muted">No one has taken the exam yet.</p>
            </div>
        @endif
    </div>
</div>
@endsection