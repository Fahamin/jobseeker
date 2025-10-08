@extends('components.layout')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-lg shadow-lg">
        <!-- Header -->
        <div class="bg-gradient-to-r from-green-600 to-green-700 px-6 py-4 rounded-t-lg">
            <div class="flex items-center space-x-3">
                <i class="fas fa-edit text-white text-2xl"></i>
                <h2 class="text-2xl font-bold text-white">Edit Job Post</h2>
            </div>
            <p class="text-green-100 mt-1">Update the job posting details</p>
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

            <form method="POST" action="{{ route('job_posts.update', $jobPost) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Basic Information -->
                    <div class="md:col-span-2">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center space-x-2">
                            <i class="fas fa-info-circle text-green-600"></i>
                            <span>Basic Information</span>
                        </h3>
                    </div>

                    <div class="md:col-span-2">
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Job Title *</label>
                        <input type="text" 
                               name="title" 
                               id="title"
                               value="{{ old('title', $jobPost->title) }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition duration-300"
                               placeholder="e.g. Senior Web Developer"
                               required>
                    </div>

                    <div>
                        <label for="company" class="block text-sm font-medium text-gray-700 mb-2">Company *</label>
                        <input type="text" 
                               name="company" 
                               id="company"
                               value="{{ old('company', $jobPost->company) }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition duration-300"
                               placeholder="Company name"
                               required>
                    </div>

                    <div>
                        <label for="location" class="block text-sm font-medium text-gray-700 mb-2">Location *</label>
                        <input type="text" 
                               name="location" 
                               id="location"
                               value="{{ old('location', $jobPost->location) }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition duration-300"
                               placeholder="e.g. Remote, New York, etc."
                               required>
                    </div>

                    <!-- Job Details -->
                    <div class="md:col-span-2">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center space-x-2">
                            <i class="fas fa-briefcase text-green-600"></i>
                            <span>Job Details</span>
                        </h3>
                    </div>

                    <div>
                        <label for="type" class="block text-sm font-medium text-gray-700 mb-2">Job Type *</label>
                        <select name="type" 
                                id="type"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition duration-300"
                                required>
                            <option value="">Select Job Type</option>
                            <option value="Full-time" {{ old('type', $jobPost->type) == 'Full-time' ? 'selected' : '' }}>Full-time</option>
                            <option value="Part-time" {{ old('type', $jobPost->type) == 'Part-time' ? 'selected' : '' }}>Part-time</option>
                            <option value="Remote" {{ old('type', $jobPost->type) == 'Remote' ? 'selected' : '' }}>Remote</option>
                            <option value="Contract" {{ old('type', $jobPost->type) == 'Contract' ? 'selected' : '' }}>Contract</option>
                        </select>
                    </div>

                    <div>
                        <label for="category_id" class="block text-sm font-medium text-gray-700 mb-2">Category *</label>
                        <select name="category_id" 
                                id="category_id"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition duration-300"
                                required>
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $jobPost->category_id) == $category->id ? 'selected' : '' }}>
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
                               value="{{ old('salary', $jobPost->salary) }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition duration-300"
                               placeholder="e.g. $50,000 - $70,000">
                    </div>

                    <div>
                        <label for="category" class="block text-sm font-medium text-gray-700 mb-2">Job Category *</label>
                        <input type="text" 
                               name="category" 
                               id="category"
                               value="{{ old('category', $jobPost->category) }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition duration-300"
                               placeholder="e.g. Technology, Marketing, etc."
                               required>
                    </div>

                    <!-- Dates -->
                    <div>
                        <label for="publishdate" class="block text-sm font-medium text-gray-700 mb-2">Publish Date</label>
                        <input type="date" 
                               name="publishdate" 
                               id="publishdate"
                               value="{{ old('publishdate', $jobPost->publishdate?->format('Y-m-d')) }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition duration-300">
                    </div>

                    <div>
                        <label for="dateline" class="block text-sm font-medium text-gray-700 mb-2">Application Deadline</label>
                        <input type="date" 
                               name="dateline" 
                               id="dateline"
                               value="{{ old('dateline', $jobPost->dateline?->format('Y-m-d')) }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition duration-300">
                    </div>

                    <!-- Description -->
                    <div class="md:col-span-2">
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Job Description *</label>
                        <textarea name="description" 
                                  id="description"
                                  rows="6"
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition duration-300"
                                  placeholder="Describe the job responsibilities, expectations, and what you're looking for in a candidate..."
                                  required>{{ old('description', $jobPost->description) }}</textarea>
                    </div>

                    <!-- Requirements -->
                    <div class="md:col-span-2">
                        <label for="requirements" class="block text-sm font-medium text-gray-700 mb-2">Requirements (one per line)</label>
                        <textarea name="requirements" 
                                  id="requirements"
                                  rows="4"
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition duration-300"
                                  placeholder="Enter each requirement on a new line...">{{ old('requirements', is_array($jobPost->requirements) ? implode("\n", $jobPost->requirements) : $jobPost->requirements) }}</textarea>
                        <p class="text-sm text-gray-500 mt-1">Enter each requirement on a separate line</p>
                    </div>

                    <!-- Files -->
                    <div class="md:col-span-2">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center space-x-2">
                            <i class="fas fa-paperclip text-green-600"></i>
                            <span>Attachments</span>
                        </h3>
                    </div>

                    <div>
                        <label for="image" class="block text-sm font-medium text-gray-700 mb-2">Company Image</label>
                        @if($jobPost->image)
                            <div class="mb-3">
                                <img src="{{ asset('storage/' . $jobPost->image) }}" alt="Current image" class="w-20 h-20 rounded-lg object-cover mb-2">
                                <p class="text-sm text-gray-600">Current image</p>
                            </div>
                        @endif
                        <input type="file" 
                               name="image" 
                               id="image"
                               accept="image/*"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition duration-300">
                    </div>

                    <div>
                        <label for="pdf" class="block text-sm font-medium text-gray-700 mb-2">Job PDF</label>
                        @if($jobPost->pdf)
                            <div class="mb-3">
                                <a href="{{ asset('storage/' . $jobPost->pdf) }}" 
                                   target="_blank"
                                   class="text-blue-600 hover:text-blue-800 flex items-center space-x-2">
                                    <i class="fas fa-file-pdf"></i>
                                    <span>View Current PDF</span>
                                </a>
                            </div>
                        @endif
                        <input type="file" 
                               name="pdf" 
                               id="pdf"
                               accept=".pdf"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition duration-300">
                    </div>

                    <!-- Status -->
                    <div class="md:col-span-2">
                        <div class="flex items-center space-x-3">
                            <input type="checkbox" 
                                   name="is_active" 
                                   id="is_active"
                                   value="1"
                                   {{ old('is_active', $jobPost->is_active) ? 'checked' : '' }}
                                   class="w-4 h-4 text-green-600 border-gray-300 rounded focus:ring-green-500">
                            <label for="is_active" class="text-sm font-medium text-gray-700">Active Job Post</label>
                        </div>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="flex items-center justify-between pt-6 mt-6 border-t border-gray-200">
                    <a href="{{ route('job_posts.index') }}" 
                       class="bg-gray-500 hover:bg-gray-600 text-white px-8 py-3 rounded-lg transition duration-300 flex items-center space-x-2">
                        <i class="fas fa-arrow-left"></i>
                        <span>Back to Jobs</span>
                    </a>
                    <div class="flex space-x-3">
                        <a href="{{ route('job_posts.show', $jobPost) }}" 
                           class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-lg transition duration-300 flex items-center space-x-2">
                            <i class="fas fa-eye"></i>
                            <span>View</span>
                        </a>
                        <button type="submit" 
                                class="bg-green-600 hover:bg-green-700 text-white px-8 py-3 rounded-lg transition duration-300 flex items-center space-x-2 shadow-lg">
                            <i class="fas fa-save"></i>
                            <span>Update Job Post</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection