@extends('components.layout')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-lg shadow-lg">
        <!-- Header -->
        <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-4 rounded-t-lg">
            <div class="flex items-center space-x-3">
                <i class="fas fa-plus-circle text-white text-2xl"></i>
                <h2 class="text-2xl font-bold text-white">Post New Job</h2>
            </div>
            <p class="text-blue-100 mt-1">Fill in the details to create a new job posting</p>
        </div>

        <!-- Form -->
        <div class="p-6">
            @if($errors->any())
                <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg mb-6">
                    <div class="flex items-center space-x-2 mb-2">
                        <i class="fas fa-exclamation-triangle"></i>
                        <strong class="font-medium">Please fix the following errors:</strong>
                    </div>
                    <ul class="list-disc list-inside text-sm">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('job_posts.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Basic Information -->
                    <div class="md:col-span-2">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center space-x-2">
                            <i class="fas fa-info-circle text-blue-600"></i>
                            <span>Basic Information</span>
                        </h3>
                    </div>

                    <div class="md:col-span-2">
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Job Title *</label>
                        <input type="text" 
                               name="title" 
                               id="title"
                               value="{{ old('title') }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-300"
                               placeholder="e.g. Senior Web Developer"
                               required>
                    </div>

                    <div>
                        <label for="company" class="block text-sm font-medium text-gray-700 mb-2">Company *</label>
                        <input type="text" 
                               name="company" 
                               id="company"
                               value="{{ old('company') }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-300"
                               placeholder="Company name"
                               required>
                    </div>

                    <div>
                        <label for="location" class="block text-sm font-medium text-gray-700 mb-2">Location *</label>
                        <input type="text" 
                               name="location" 
                               id="location"
                               value="{{ old('location') }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-300"
                               placeholder="e.g. Remote, New York, etc."
                               required>
                    </div>

                    <!-- Job Details -->
                    <div class="md:col-span-2">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center space-x-2">
                            <i class="fas fa-briefcase text-blue-600"></i>
                            <span>Job Details</span>
                        </h3>
                    </div>

                    <div>
                        <label for="type" class="block text-sm font-medium text-gray-700 mb-2">Job Type *</label>
                        <select name="type" 
                                id="type"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-300"
                                required>
                            <option value="">Select Job Type</option>
                            <option value="Full-time" {{ old('type') == 'Full-time' ? 'selected' : '' }}>Full-time</option>
                            <option value="Part-time" {{ old('type') == 'Part-time' ? 'selected' : '' }}>Part-time</option>
                            <option value="Remote" {{ old('type') == 'Remote' ? 'selected' : '' }}>Remote</option>
                            <option value="Contract" {{ old('type') == 'Contract' ? 'selected' : '' }}>Contract</option>
                        </select>
                    </div>

                    <div>
                        <label for="category_id" class="block text-sm font-medium text-gray-700 mb-2">Category *</label>
                        <select name="category_id" 
                                id="category_id"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-300"
                                required>
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="salary" class="block text-sm font-medium text-gray-700 mb-2">Salary</label>
                        <input type="text" 
                               name="salary" 
                               id="salary"
                               value="{{ old('salary') }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-300"
                               placeholder="e.g. $50,000 - $70,000">
                    </div>

                    <div>
                        <label for="category" class="block text-sm font-medium text-gray-700 mb-2">Job Category *</label>
                        <input type="text" 
                               name="category" 
                               id="category"
                               value="{{ old('category') }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-300"
                               placeholder="e.g. Technology, Marketing, etc."
                               required>
                    </div>

                    <!-- Dates -->
                    <div>
                        <label for="publishdate" class="block text-sm font-medium text-gray-700 mb-2">Publish Date</label>
                        <input type="date" 
                               name="publishdate" 
                               id="publishdate"
                               value="{{ old('publishdate') }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-300">
                    </div>

                    <div>
                        <label for="dateline" class="block text-sm font-medium text-gray-700 mb-2">Application Deadline</label>
                        <input type="date" 
                               name="dateline" 
                               id="dateline"
                               value="{{ old('dateline') }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-300">
                    </div>

                    <!-- Description -->
                    <div class="md:col-span-2">
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Job Description *</label>
                        <textarea name="description" 
                                  id="description"
                                  rows="6"
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-300"
                                  placeholder="Describe the job responsibilities, expectations, and what you're looking for in a candidate..."
                                  required>{{ old('description') }}</textarea>
                    </div>

                    <!-- Requirements -->
                    <div class="md:col-span-2">
                        <label for="requirements" class="block text-sm font-medium text-gray-700 mb-2">Requirements (one per line)</label>
                        <textarea name="requirements" 
                                  id="requirements"
                                  rows="4"
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-300"
                                  placeholder="Enter each requirement on a new line...">{{ old('requirements') }}</textarea>
                        <p class="text-sm text-gray-500 mt-1">Enter each requirement on a separate line</p>
                    </div>

                    <!-- Files -->
                    <div class="md:col-span-2">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center space-x-2">
                            <i class="fas fa-paperclip text-blue-600"></i>
                            <span>Attachments</span>
                        </h3>
                    </div>

                    <div>
                        <label for="image" class="block text-sm font-medium text-gray-700 mb-2">Company Image</label>
                        <input type="file" 
                               name="image" 
                               id="image"
                               accept="image/*"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-300">
                        <p class="text-sm text-gray-500 mt-1">Recommended: 400x400px</p>
                    </div>

                    <div>
                        <label for="pdf" class="block text-sm font-medium text-gray-700 mb-2">Job PDF</label>
                        <input type="file" 
                               name="pdf" 
                               id="pdf"
                               accept=".pdf"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-300">
                        <p class="text-sm text-gray-500 mt-1">Additional job details in PDF format</p>
                    </div>

                    <!-- Status -->
                    <div class="md:col-span-2">
                        <div class="flex items-center space-x-3">
                            <input type="checkbox" 
                                   name="is_active" 
                                   id="is_active"
                                   value="1"
                                   {{ old('is_active', true) ? 'checked' : '' }}
                                   class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                            <label for="is_active" class="text-sm font-medium text-gray-700">Active Job Post</label>
                        </div>
                        <p class="text-sm text-gray-500 mt-1">If unchecked, this job post will be hidden from public view</p>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="flex items-center justify-between pt-6 mt-6 border-t border-gray-200">
                    <a href="{{ route('job_posts.index') }}" 
                       class="bg-gray-500 hover:bg-gray-600 text-white px-8 py-3 rounded-lg transition duration-300 flex items-center space-x-2">
                        <i class="fas fa-arrow-left"></i>
                        <span>Back to Jobs</span>
                    </a>
                    <button type="submit" 
                            class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-lg transition duration-300 flex items-center space-x-2 shadow-lg">
                        <i class="fas fa-save"></i>
                        <span>Create Job Post</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Set minimum date for deadline to today
    document.addEventListener('DOMContentLoaded', function() {
        const today = new Date().toISOString().split('T')[0];
        const datelineInput = document.getElementById('dateline');
        const publishdateInput = document.getElementById('publishdate');
        
        if (datelineInput) {
            datelineInput.min = today;
        }
        if (publishdateInput) {
            publishdateInput.value = today;
        }
    });
</script>
@endsection