@extends('components.layout')

@section('content')
    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <!-- Header Section -->
            <div class="bg-gradient-to-r from-purple-600 to-purple-700 px-6 py-8">
                <div class="flex flex-col md:flex-row md:items-start md:justify-between">
                    <div class="flex items-start space-x-4 mb-4 md:mb-0">
                        @if($jobPost->image)
                            <img src="{{ asset('storage/' . $jobPost->image) }}" alt="{{ $jobPost->company }}"
                                class="w-16 h-16 rounded-lg object-cover border-2 border-white">
                        @else
                            <div
                                class="w-16 h-16 bg-white bg-opacity-20 rounded-lg flex items-center justify-center border-2 border-white">
                                <i class="fas fa-building text-white text-2xl"></i>
                            </div>
                        @endif
                        <div>
                            <h1 class="text-2xl font-bold text-white">{{ $jobPost->title }}</h1>
                            <p class="text-purple-100 text-lg">{{ $jobPost->company }}</p>
                            <div class="flex items-center space-x-2 mt-2">
                                <i class="fas fa-map-marker-alt text-purple-200"></i>
                                <span class="text-purple-100">{{ $jobPost->location }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="flex space-x-3">
                        <a href="{{ route('job_posts.edit', $jobPost) }}"
                            class="bg-white bg-opacity-20 hover:bg-opacity-30 text-white px-4 py-2 rounded-lg transition duration-300 flex items-center space-x-2 backdrop-blur-sm">
                            <i class="fas fa-edit"></i>
                            <span>Edit</span>
                        </a>
                        <a href="{{ route('job_posts.index') }}"
                            class="bg-white bg-opacity-10 hover:bg-opacity-20 text-white px-4 py-2 rounded-lg transition duration-300 flex items-center space-x-2 backdrop-blur-sm">
                            <i class="fas fa-arrow-left"></i>
                            <span>Back</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Content Section -->
            <div class="p-6">
                <!-- Quick Info Cards -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
                    <div class="bg-blue-50 p-4 rounded-lg border border-blue-200">
                        <div class="flex items-center space-x-3">
                            <i class="fas fa-clock text-blue-600"></i>
                            <div>
                                <p class="text-sm text-blue-600">Job Type</p>
                                <p class="font-semibold text-blue-800">{{ $jobPost->type }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-green-50 p-4 rounded-lg border border-green-200">
                        <div class="flex items-center space-x-3">
                            <i class="fas fa-tag text-green-600"></i>
                            <div>
                                <p class="text-sm text-green-600">Category</p>
                                <p class="font-semibold text-green-800">{{ $jobPost->category }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-yellow-50 p-4 rounded-lg border border-yellow-200">
                        <div class="flex items-center space-x-3">
                            <i class="fas fa-money-bill-wave text-yellow-600"></i>
                            <div>
                                <p class="text-sm text-yellow-600">Salary</p>
                                <p class="font-semibold text-yellow-800">{{ $jobPost->salary ?? 'Negotiable' }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-purple-50 p-4 rounded-lg border border-purple-200">
                        <div class="flex items-center space-x-3">
                            <i class="fas fa-calendar-day text-purple-600"></i>
                            <div>
                                <p class="text-sm text-purple-600">Deadline</p>
                                <p class="font-semibold text-purple-800">
                                    {{ $jobPost->dateline?->format('M d, Y') ?? 'No deadline' }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Status Badges -->
                <div class="flex flex-wrap gap-2 mb-6">
                    <span
                        class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $jobPost->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                        <i class="fas fa-circle mr-1 text-xs"></i>
                        {{ $jobPost->is_active ? 'Active' : 'Inactive' }}
                    </span>
                    @if($jobPost->dateline && $jobPost->dateline->isPast())
                        <span
                            class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                            <i class="fas fa-exclamation-triangle mr-1"></i>
                            Expired
                        </span>
                    @elseif($jobPost->dateline && $jobPost->dateline->isFuture())
                        <span
                            class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                            <i class="fas fa-clock mr-1"></i>
                            Active until {{ $jobPost->dateline->format('M d, Y') }}
                        </span>
                    @endif
                </div>

                <!-- Description -->
                <div class="mb-8">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4 flex items-center space-x-2">
                        <i class="fas fa-align-left text-purple-600"></i>
                        <span>Job Description</span>
                    </h3>
                    <div class="prose max-w-none bg-gray-50 p-6 rounded-lg border border-gray-200">
                        {!! nl2br(e($jobPost->description)) !!}
                    </div>
                </div>

                <!-- Requirements -->
                @if($jobPost->requirements && count($jobPost->requirements) > 0)
                    <div class="mb-8">
                        <h3 class="text-xl font-semibold text-gray-800 mb-4 flex items-center space-x-2">
                            <i class="fas fa-list-check text-purple-600"></i>
                            <span>Requirements</span>
                        </h3>
                        <div class="bg-gray-50 p-6 rounded-lg border border-gray-200">
                            <ul class="space-y-2">
                                @foreach($jobPost->requirements as $requirement)
                                    <li class="flex items-start space-x-3">
                                        <i class="fas fa-check text-green-500 mt-1"></i>
                                        <span class="text-gray-700">{{ $requirement }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif

                <!-- Additional Information -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <div class="bg-gray-50 p-6 rounded-lg border border-gray-200">
                        <h4 class="text-lg font-semibold text-gray-800 mb-4 flex items-center space-x-2">
                            <i class="fas fa-calendar-alt text-purple-600"></i>
                            <span>Timeline</span>
                        </h4>
                        <div class="space-y-3">
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">Published:</span>
                                <span
                                    class="font-medium text-gray-800">{{ $jobPost->publishdate?->format('M d, Y') ?? 'Not specified' }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">Application Deadline:</span>
                                <span
                                    class="font-medium {{ $jobPost->dateline && $jobPost->dateline->isPast() ? 'text-red-600' : 'text-gray-800' }}">
                                    {{ $jobPost->dateline?->format('M d, Y') ?? 'No deadline' }}
                                </span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">Last Updated:</span>
                                <span class="font-medium text-gray-800">{{ $jobPost->updated_at->format('M d, Y') }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gray-50 p-6 rounded-lg border border-gray-200">
                        <h4 class="text-lg font-semibold text-gray-800 mb-4 flex items-center space-x-2">
                            <i class="fas fa-file-alt text-purple-600"></i>
                            <span>Attachments</span>
                        </h4>
                        <div class="space-y-3">
                            @if($jobPost->pdf)
                                <a href="{{ asset('storage/' . $jobPost->pdf) }}" target="_blank"
                                    class="flex items-center space-x-3 p-3 bg-white rounded-lg border border-gray-200 hover:border-purple-300 hover:bg-purple-50 transition duration-300 group">
                                    <i class="fas fa-file-pdf text-red-500 text-xl"></i>
                                    <div>
                                        <p class="font-medium text-gray-800 group-hover:text-purple-700">Job Details PDF</p>
                                        <p class="text-sm text-gray-500">Click to view/download</p>
                                    </div>
                                </a>
                            @else
                                <div class="flex items-center space-x-3 p-3 bg-white rounded-lg border border-gray-200">
                                    <i class="fas fa-file text-gray-400 text-xl"></i>
                                    <div>
                                        <p class="font-medium text-gray-800">No attachments</p>
                                        <p class="text-sm text-gray-500">No PDF file attached</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-wrap gap-4 pt-6 border-t border-gray-200">
                    <a href="{{ route('job_posts.edit', $jobPost) }}"
                        class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg transition duration-300 flex items-center space-x-2">
                        <i class="fas fa-edit"></i>
                        <span>Edit Job Post</span>
                    </a>
                    <form action="{{ route('job_posts.destroy', $jobPost) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-lg transition duration-300 flex items-center space-x-2"
                            onclick="return confirm('Are you sure you want to delete this job post? This action cannot be undone.')">
                            <i class="fas fa-trash"></i>
                            <span>Delete Job Post</span>
                        </button>
                    </form>
                    <a href="{{ route('job_posts.index') }}"
                        class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-lg transition duration-300 flex items-center space-x-2">
                        <i class="fas fa-list"></i>
                        <span>Back to All Jobs</span>
                    </a>
                </div>
                @if(Auth::check())
                    <div class="mt-8 border-t border-gray-200 pt-6">
                        <h3 class="text-xl font-semibold text-gray-800 mb-4 flex items-center space-x-2">
                            <i class="fas fa-paper-plane text-purple-600"></i>
                            <span>Apply for this job</span>
                        </h3>

                        <form action="{{ route('apply.job') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                            @csrf
                            <input type="hidden" name="job_post_id" value="{{ $jobPost->id }}">

                            <div>
                                <label class="block text-gray-700 font-medium mb-2">Upload Resume (PDF/DOC)</label>
                                <input type="file" name="resume"
                                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring focus:ring-purple-200">
                                @error('resume')
                                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-gray-700 font-medium mb-2">Cover Letter (optional)</label>
                                <textarea name="cover_letter" rows="4"
                                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring focus:ring-purple-200"></textarea>
                                @error('cover_letter')
                                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <button type="submit"
                                class="bg-purple-600 hover:bg-purple-700 text-white font-medium px-6 py-3 rounded-lg transition duration-300 flex items-center space-x-2">
                                <i class="fas fa-paper-plane"></i>
                                <span>Submit Application</span>
                            </button>
                        </form>
                    </div>
                @else
                    <div class="mt-8 border-t border-gray-200 pt-6 text-center">
                        <p class="text-gray-600 mb-4">Please log in to apply for this job.</p>
                        <a href="{{ route('login') }}"
                            class="bg-purple-600 hover:bg-purple-700 text-white px-6 py-3 rounded-lg font-medium">
                            Login to Apply
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection