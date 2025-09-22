@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6 max-w-2xl">
    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
        <div class="bg-blue-600 text-white px-6 py-4">
            <h1 class="text-2xl font-bold">Create Your Post</h1>
            <p class="text-blue-100 mt-1">Share your thoughts with the community</p>
        </div>

        <div class="p-6">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    <i class="fas fa-check-circle mr-2"></i>
                    {{ session('success') }}
                </div>
            @endif

            @if(session('info'))
                <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded mb-4">
                    <i class="fas fa-info-circle mr-2"></i>
                    {{ session('info') }}
                </div>
            @endif

            @if($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form id="createPostForm" action="{{ route('member.store_post') }}" method="POST" class="space-y-6">
                @csrf

                <div>
                    <label for="post" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-heading mr-1"></i>
                        Post Title (Optional)
                    </label>
                    <input type="text"
                           id="post"
                           name="post"
                           value="{{ old('post') }}"
                           placeholder="Give your post a catchy title..."
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                </div>

                <div>
                    <label for="postdetails" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-edit mr-1"></i>
                        Post Content <span class="text-red-500">*</span>
                    </label>
                    <textarea name="postdetails"
                              id="postdetails"
                              rows="8"
                              placeholder="What's on your mind? Share your thoughts, experiences, or ideas..."
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition resize-vertical"
                              required>{{ old('postdetails') }}</textarea>
                    <p class="text-sm text-gray-500 mt-1">
                        <i class="fas fa-info-circle mr-1"></i>
                        Your post will be reviewed by administrators before being published.
                    </p>
                </div>

                <div class="flex items-center justify-between pt-4">
                    <a href="{{ route('dashboard') }}"
                       class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg text-gray-700 bg-white hover:bg-gray-50 transition">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Back to Dashboard
                    </a>

                    <button type="submit"
                            class="inline-flex items-center px-6 py-3 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition">
                        <i class="fas fa-paper-plane mr-2"></i>
                        Publish Post
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Post Guidelines -->
    <div class="bg-gray-50 rounded-lg p-6 mt-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-3">
            <i class="fas fa-lightbulb text-yellow-500 mr-2"></i>
            Post Guidelines
        </h3>
        <ul class="space-y-2 text-sm text-gray-600">
            <li class="flex items-start">
                <i class="fas fa-check text-green-500 mr-2 mt-0.5"></i>
                Be respectful and considerate to other community members
            </li>
            <li class="flex items-start">
                <i class="fas fa-check text-green-500 mr-2 mt-0.5"></i>
                Share original content and give credit when necessary
            </li>
            <li class="flex items-start">
                <i class="fas fa-check text-green-500 mr-2 mt-0.5"></i>
                Keep content relevant and engaging for the community
            </li>
            <li class="flex items-start">
                <i class="fas fa-times text-red-500 mr-2 mt-0.5"></i>
                No spam, harassment, or inappropriate content
            </li>
        </ul>
    </div>
</div>
@endsection
