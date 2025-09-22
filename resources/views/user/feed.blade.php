@extends('layouts.app')

@section('content')
<h1 class="text-xl font-bold mb-4">Feed</h1>

<div id="postsContainer"></div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
    });

    function fetchPosts() {
        $.get('{{ route("user.feed") }}', function(posts) {
            let html = '';
            posts.forEach(post => {
                html += `<div class="border p-3 mb-4" id="post-${post.id}">
                    <strong>${post.user.name}</strong>
                    <p>${post.postdetails}</p>
                    <small>Status: ${post.status}</small>
                    <div class="mt-2">
                        <button class="likePostBtn bg-green-500 text-white px-2 py-1 rounded" data-id="${post.id}">Like (${post.likes.length})</button>
                        <button class="favouritePostBtn bg-yellow-500 text-white px-2 py-1 rounded" data-id="${post.id}">Favourite</button>
                    </div>
                    <div class="comments mt-2 ml-4">`;
                post.comments.forEach(comment => {
                    html += `<div class="mb-1"><strong>${comment.user.name}</strong>: ${comment.comment}
                        <button class="likeCommentBtn bg-green-400 text-white px-1 py-0.5 rounded" data-id="${comment.id}">Like (${comment.likes.length})</button>
                    </div>`;
                });
                html += `</div>
                    <input type="text" class="comment-input border p-1 w-full mt-2" placeholder="Write a comment..." data-postid="${post.id}">
                </div>`;
            });
            $('#postsContainer').html(html);
        });
    }

    fetchPosts();

    // Like post
    $(document).on('click', '.likePostBtn', function() {
        let postId = $(this).data('id');
        $.post(`/posts/${postId}/like`, function() { fetchPosts(); });
    });

    // Like comment
    $(document).on('click', '.likeCommentBtn', function() {
        let commentId = $(this).data('id');
        $.post(`/comments/${commentId}/like`, function() { fetchPosts(); });
    });

    // Favourite post
    $(document).on('click', '.favouritePostBtn', function() {
        let postId = $(this).data('id');
        $.post(`/posts/${postId}/favourite`, function() { fetchPosts(); });
    });

    // Add comment
    $(document).on('keypress', '.comment-input', function(e) {
        if(e.which === 13){
            let postId = $(this).data('postid');
            let comment = $(this).val();
            let inputField = $(this);
            $.post('/comments', { post_id: postId, comment: comment }, function() {
                inputField.val('');
                fetchPosts();
            });
        }
    });
});
</script>
@endsection
