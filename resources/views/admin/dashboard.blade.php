@extends('layouts.app')

@section('content')
<h1 class="text-xl font-bold mb-4">Admin Dashboard</h1>

<table class="min-w-full border">
    <thead>
        <tr>
            <th class="border px-2 py-1">User</th>
            <th class="border px-2 py-1">Post</th>
            <th class="border px-2 py-1">Status</th>
            <th class="border px-2 py-1">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($posts as $post)
        <tr>
            <td class="border px-2 py-1">{{ $post->user->name }}</td>
            <td class="border px-2 py-1">{{ $post->postdetails }}</td>
            <td class="border px-2 py-1">{{ $post->status }}</td>
            <td class="border px-2 py-1 flex gap-2">
                @if($post->status !== 'verified')
                <form method="POST" action="{{ url("/admin/posts/{$post->id}/approve") }}">
                    @csrf @method('PUT')
                    <button type="submit" class="bg-green-500 text-white px-2 py-1 rounded">Approve</button>
                </form>
                @endif
                @if($post->status !== 'rejected')
                <form method="POST" action="{{ url("/admin/posts/{$post->id}/reject") }}">
                    @csrf @method('PUT')
                    <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded">Reject</button>
                </form>
                @endif
                <form method="POST" action="{{ url("/admin/posts/{$post->id}") }}">
                    @csrf @method('DELETE')
                    <button type="submit" class="bg-gray-500 text-white px-2 py-1 rounded">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
