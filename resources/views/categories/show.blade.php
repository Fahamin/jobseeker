@extends('layouts.app')
@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex justify-between items-start mb-6">
            <h1 class="text-3xl font-bold text-gray-800">{{ $category->name }}</h1>
            <div class="flex space-x-2">
                <a href="{{ route('categories.edit', $category) }}" 
                   class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg flex items-center space-x-2 transition duration-300">
                    <i class="fas fa-edit"></i>
                    <span>Edit</span>
                </a>
                <a href="{{ route('categories.index') }}" 
                   class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg transition duration-300">
                    Back
                </a>
            </div>
        </div>

        <div class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">Description</label>
                <p class="mt-1 text-gray-900 bg-gray-50 p-4 rounded-lg">
                    {{ $category->description ?? 'No description provided' }}
                </p>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Created At</label>
                    <p class="mt-1 text-gray-900">{{ $category->created_at->format('F d, Y \a\t h:i A') }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Updated At</label>
                    <p class="mt-1 text-gray-900">{{ $category->updated_at->format('F d, Y \a\t h:i A') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection