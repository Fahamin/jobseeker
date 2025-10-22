<!-- resources/views/admin/questions/create.blade.php -->
@extends('layouts.app')

@section('title', 'Add New Question')

@section('content')
<div class="card">
    <div class="card-header">
        <h5>Add New Question</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.questions.store') }}" method="POST">
            @csrf
            
            <div class="mb-3">
                <label for="question_text" class="form-label">Question Text *</label>
                <textarea class="form-control @error('question_text') is-invalid @enderror" 
                          id="question_text" name="question_text" rows="3" 
                          placeholder="Enter your question here..." required>{{ old('question_text') }}</textarea>
                @error('question_text')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="option_a" class="form-label">Option A *</label>
                        <input type="text" class="form-control @error('option_a') is-invalid @enderror" 
                               id="option_a" name="option_a" value="{{ old('option_a') }}" required>
                        @error('option_a')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="option_b" class="form-label">Option B *</label>
                        <input type="text" class="form-control @error('option_b') is-invalid @enderror" 
                               id="option_b" name="option_b" value="{{ old('option_b') }}" required>
                        @error('option_b')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="option_c" class="form-label">Option C *</label>
                        <input type="text" class="form-control @error('option_c') is-invalid @enderror" 
                               id="option_c" name="option_c" value="{{ old('option_c') }}" required>
                        @error('option_c')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="option_d" class="form-label">Option D *</label>
                        <input type="text" class="form-control @error('option_d') is-invalid @enderror" 
                               id="option_d" name="option_d" value="{{ old('option_d') }}" required>
                        @error('option_d')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="correct_answer" class="form-label">Correct Answer *</label>
                        <select class="form-select @error('correct_answer') is-invalid @enderror" 
                                id="correct_answer" name="correct_answer" required>
                            <option value="">Select Correct Answer</option>
                            <option value="a" {{ old('correct_answer') == 'a' ? 'selected' : '' }}>Option A</option>
                            <option value="b" {{ old('correct_answer') == 'b' ? 'selected' : '' }}>Option B</option>
                            <option value="c" {{ old('correct_answer') == 'c' ? 'selected' : '' }}>Option C</option>
                            <option value="d" {{ old('correct_answer') == 'd' ? 'selected' : '' }}>Option D</option>
                        </select>
                        @error('correct_answer')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="marks" class="form-label">Marks *</label>
                        <input type="number" class="form-control @error('marks') is-invalid @enderror" 
                               id="marks" name="marks" value="{{ old('marks', 1) }}" min="1" required>
                        @error('marks')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('admin.questions.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-2"></i>Back to List
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-2"></i>Save Question
                </button>
            </div>
        </form>
    </div>
</div>
@endsection