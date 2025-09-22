@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Admin Dashboard</h1>
        <div class="flex items-center space-x-4">
            <span class="text-sm text-gray-600">Total Posts: {{ $posts->count() }}</span>
            <a href="{{ route('admin.users') }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition">
                Manage Users
            </a>
            <a href="{{ route('dashboard') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition">
                Back to Dashboard
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if($posts->count() > 0)
        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Post Content</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($posts as $post)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        <div class="h-10 w-10 rounded-full bg-blue-500 flex items-center justify-center text-white font-medium">
                                            {{ substr($post->user->name, 0, 1) }}
                                        </div>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">{{ $post->user->name }}</div>
                                        <div class="text-sm text-gray-500">{{ $post->user->email }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-900 max-w-xs truncate">{{ $post->postdetails }}</div>
                                @if($post->post)
                                    <div class="text-xs text-gray-500 mt-1">Title: {{ $post->post }}</div>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full
                                    @if($post->status === 'verified') bg-green-100 text-green-800
                                    @elseif($post->status === 'pending') bg-yellow-100 text-yellow-800
                                    @elseif($post->status === 'rejected') bg-red-100 text-red-800
                                    @else bg-gray-100 text-gray-800 @endif">
                                    {{ ucfirst($post->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $post->created_at->format('M d, Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex space-x-2">
                                    @if($post->status !== 'verified')
                                    <form method="POST" action="{{ url("/admin/posts/{$post->id}/approve") }}" class="inline">
                                        @csrf @method('PUT')
                                        <button type="submit"
                                                class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded text-xs transition"
                                                onclick="return confirm('Approve this post?')">
                                            Approve
                                        </button>
                                    </form>
                                    @endif

                                    @if($post->status !== 'rejected')
                                    <form method="POST" action="{{ url("/admin/posts/{$post->id}/reject") }}" class="inline">
                                        @csrf @method('PUT')
                                        <button type="submit"
                                                class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-xs transition"
                                                onclick="return confirm('Reject this post?')">
                                            Reject
                                        </button>
                                    </form>
                                    @endif

                                    <form method="POST" action="{{ url("/admin/posts/{$post->id}") }}" class="inline">
                                        @csrf @method('DELETE')
                                        <button type="submit"
                                                class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-xs transition"
                                                onclick="return confirm('Delete this post permanently?')">
                                            Delete
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
    @else
        <div class="bg-white shadow-lg rounded-lg p-8 text-center">
            <div class="text-gray-500 text-lg mb-4">
                <i class="fas fa-inbox text-4xl mb-4"></i>
            </div>
            <h3 class="text-xl font-semibold text-gray-700 mb-2">No Posts Yet</h3>
            <p class="text-gray-500">There are no posts to review at the moment.</p>
        </div>
    @endif
</div>
@endsection
