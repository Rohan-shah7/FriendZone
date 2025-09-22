@extends('layouts.app')

@section('content')
<h1 class="text-xl font-bold mb-4">Create Your First Post</h1>

@if(session('info'))
    <div class="bg-yellow-200 p-2 mb-2 rounded">{{ session('info') }}</div>
@endif

<form id="createPostForm" action="{{ route('members.store_post') }}" method="POST">
    @csrf
    <textarea name="postdetails" placeholder="Write something..." class="border p-2 w-full mb-2"></textarea>
    <input type="text" name="post" placeholder="Optional title" class="border p-2 w-full mb-2">
    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Post</button>
</form>
@endsection
