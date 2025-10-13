@extends('components.layout')
@extends('layouts.app')
@section('content')
<div class="max-w-7xl mx-auto">
    <!-- Header -->
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Job Posts</h1>
            <p class="text-gray-600 mt-2">Manage all job listings</p>
        </div>
        <a href="{{ route('job_posts.create') }}" 
           class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg flex items-center space-x-2 transition duration-300 shadow-lg">
            <i class="fas fa-plus"></i>
            <span>Post New Job</span>
        </a>
    </div>

    <!-- Stats -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white p-6 rounded-lg shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600">Total Jobs</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $jobPosts->total() }}</p>
                </div>
                <i class="fas fa-briefcase text-blue-500 text-2xl"></i>
            </div>
        </div>
        <div class="bg-white p-6 rounded-lg shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600">Active Jobs</p>
                    <p class="text-2xl font-bold text-green-600">{{ $activeJobs }}</p>
                </div>
                <i class="fas fa-check-circle text-green-500 text-2xl"></i>
            </div>
        </div>
        <div class="bg-white p-6 rounded-lg shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600">Expired Jobs</p>
                    <p class="text-2xl font-bold text-red-600">{{ $expiredJobs }}</p>
                </div>
                <i class="fas fa-clock text-red-500 text-2xl"></i>
            </div>
        </div>
        <div class="bg-white p-6 rounded-lg shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600">This Month</p>
                    <p class="text-2xl font-bold text-purple-600">{{ $thisMonthJobs }}</p>
                </div>
                <i class="fas fa-calendar text-purple-500 text-2xl"></i>
            </div>
        </div>
    </div>

    @if($jobPosts->count() > 0)
        <!-- Job Posts Table -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Job Details</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Company & Location</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type & Salary</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Dates</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($jobPosts as $job)
                        <tr class="hover:bg-gray-50 transition duration-150">
                            <td class="px-6 py-4">
                                <div class="flex items-center space-x-3">
                                    @if($job->image)
                                        <img src="{{ asset('storage/' . $job->image) }}" alt="{{ $job->company }}" class="w-12 h-12 rounded-lg object-cover">
                                    @else
                                        <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                                            <i class="fas fa-building text-blue-600"></i>
                                        </div>
                                    @endif
                                    <div>
                                        <div class="text-sm font-semibold text-gray-900">{{ $job->title }}</div>
                                        <div class="text-sm text-gray-500">{{ $job->category }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm font-medium text-gray-900">{{ $job->company }}</div>
                                <div class="text-sm text-gray-500 flex items-center space-x-1">
                                    <i class="fas fa-map-marker-alt text-red-400"></i>
                                    <span>{{ $job->location }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    {{ $job->type }}
                                </span>
                                <div class="text-sm text-gray-900 mt-1">{{ $job->salary ?? 'Negotiable' }}</div>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500">
                                <div><strong>Published:</strong> {{ $job->publishdate?->format('M d, Y') ?? 'N/A' }}</div>
                                <div><strong>Deadline:</strong> {{ $job->dateline?->format('M d, Y') ?? 'N/A' }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex flex-col space-y-2">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $job->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ $job->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                    @if($job->dateline && $job->dateline->isPast())
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                            Expired
                                        </span>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center space-x-2">
                                    <a href="{{ route('job_posts.show', $job) }}" 
                                       class="text-blue-600 hover:text-blue-900 transition duration-300 p-2 rounded-full hover:bg-blue-50" 
                                       title="View">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('job_posts.edit', $job) }}" 
                                       class="text-green-600 hover:text-green-900 transition duration-300 p-2 rounded-full hover:bg-green-50" 
                                       title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('job_posts.destroy', $job) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="text-red-600 hover:text-red-900 transition duration-300 p-2 rounded-full hover:bg-red-50" 
                                                onclick="return confirm('Are you sure you want to delete this job post?')"
                                                title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $jobPosts->links() }}
        </div>
    @else
        <!-- Empty State -->
        <div class="bg-white rounded-lg shadow p-12 text-center">
            <i class="fas fa-briefcase text-gray-400 text-6xl mb-4"></i>
            <h3 class="text-2xl font-semibold text-gray-600 mb-2">No Job Posts Found</h3>
            <p class="text-gray-500 mb-6">Get started by creating your first job post.</p>
            <a href="{{ route('job_posts.create') }}" 
               class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-lg inline-flex items-center space-x-2 transition duration-300 shadow-lg">
                <i class="fas fa-plus"></i>
                <span>Create First Job Post</span>
            </a>
        </div>
    @endif
</div>
@endsection