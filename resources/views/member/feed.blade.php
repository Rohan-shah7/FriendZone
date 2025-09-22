@extends('layouts.app')

@section('content')
<h1 class="text-xl font-bold mb-4">Member Feed</h1>

<a href="{{ route('members.create_post') }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">Create Post</a>

<div id="postsContainer"></div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });

    function fetchPosts() {
        $.get('{{ route("members.feed") }}', function(posts) {
            let html = '';
            posts.forEach(post => {
                html += `<div class="border p-3 mb-4" id="post-${post.id}">
                    <strong>${post.user.name}</strong>
                    <p>${post.postdetails}</p>
                    <small>Status: ${post.status}</small>
                    <div class="comments mt-2 ml-4">`;
                post.comments.forEach(comment => {
                    html += `<div class="mb-1"><strong>${comment.user.name}</strong>: ${comment.comment}</div>`;
                });
                html += `</div></div>`;
            });
            $('#postsContainer').html(html);
        });
    }

    fetchPosts();
});
</script>
@endsection
