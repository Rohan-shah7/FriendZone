@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6 max-w-4xl">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">
            <i class="fas fa-home mr-2 text-blue-600"></i>
            Your Feed
        </h1>
        <div class="flex items-center space-x-4">
            <a href="{{ route('dashboard') }}"
               class="inline-flex items-center px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition">
                <i class="fas fa-arrow-left mr-2"></i>
                Dashboard
            </a>
        </div>
    </div>

    <!-- Loading indicator -->
    <div id="loadingIndicator" class="text-center py-8">
        <div class="inline-flex items-center">
            <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            Loading posts...
        </div>
    </div>

    <!-- Posts container -->
    <div id="postsContainer" class="space-y-6">
        @if($posts->count() > 0)
            @foreach($posts as $post)
            <div class="bg-white rounded-lg shadow-md border border-gray-200 overflow-hidden" id="post-{{ $post->id }}">
                <!-- Post Header -->
                <div class="p-4 border-b border-gray-100">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="h-10 w-10 rounded-full bg-blue-500 flex items-center justify-center text-white font-medium">
                                {{ substr($post->user->name, 0, 1) }}
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900">{{ $post->user->name }}</h3>
                                <p class="text-sm text-gray-500">{{ $post->created_at->format('M d, Y') }}</p>
                            </div>
                        </div>
                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                            Verified
                        </span>
                    </div>
                </div>

                <!-- Post Content -->
                <div class="p-4">
                    @if($post->post)
                        <h4 class="font-semibold text-lg text-gray-900 mb-2">{{ $post->post }}</h4>
                    @endif
                    <p class="text-gray-700 leading-relaxed">{{ $post->postdetails }}</p>
                </div>

                <!-- Post Actions -->
                <div class="px-4 py-3 border-t border-gray-100">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-4">
                            <button class="likePostBtn flex items-center space-x-1 text-gray-600 hover:text-blue-600 transition" data-id="{{ $post->id }}">
                                <i class="fas fa-heart"></i>
                                <span>Like ({{ $post->likes->count() }})</span>
                            </button>
                            <button class="favouritePostBtn flex items-center space-x-1 text-gray-600 hover:text-yellow-600 transition" data-id="{{ $post->id }}">
                                <i class="fas fa-star"></i>
                                <span>Favourite</span>
                            </button>
                            <span class="flex items-center space-x-1 text-gray-500">
                                <i class="fas fa-comment"></i>
                                <span>{{ $post->comments->count() }} comments</span>
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Comments Section -->
                <div class="border-t border-gray-100">
                    <div class="comments p-4 space-y-3">
                        @foreach($post->comments as $comment)
                        <div class="flex items-start space-x-3 bg-gray-50 rounded-lg p-3">
                            <div class="h-8 w-8 rounded-full bg-gray-400 flex items-center justify-center text-white text-sm font-medium">
                                {{ substr($comment->user->name, 0, 1) }}
                            </div>
                            <div class="flex-1">
                                <div class="flex items-center space-x-2">
                                    <span class="font-medium text-sm text-gray-900">{{ $comment->user->name }}</span>
                                    <span class="text-xs text-gray-500">{{ $comment->created_at->format('M d, Y') }}</span>
                                </div>
                                <p class="text-gray-700 text-sm mt-1">{{ $comment->comment }}</p>
                                <button class="likeCommentBtn text-xs text-gray-500 hover:text-blue-600 transition mt-1" data-id="{{ $comment->id }}">
                                    <i class="fas fa-heart mr-1"></i>Like ({{ $comment->likes->count() }})
                                </button>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <!-- Add Comment -->
                    <div class="p-4 border-t border-gray-100 bg-gray-50">
                        <div class="flex items-center space-x-3">
                            <div class="h-8 w-8 rounded-full bg-blue-500 flex items-center justify-center text-white text-sm font-medium">
                                {{ substr(auth()->user()->name, 0, 1) }}
                            </div>
                            <input type="text"
                                   class="comment-input flex-1 px-3 py-2 border border-gray-300 rounded-full focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                                   placeholder="Write a comment..."
                                   data-postid="{{ $post->id }}">
                        </div>
                        <p class="text-xs text-gray-500 mt-2 ml-11">Press Enter to post your comment</p>
                    </div>
                </div>
            </div>
            @endforeach
        @endif
    </div>

    <!-- Empty state -->
    @if($posts->count() === 0)
    <div id="emptyState" class="text-center py-12">
        <div class="text-gray-400 mb-4">
            <i class="fas fa-comments text-6xl"></i>
        </div>
        <h3 class="text-xl font-semibold text-gray-700 mb-2">No Posts Yet</h3>
        <p class="text-gray-500 mb-4">Be the first to share something with the community!</p>
        <a href="{{ route('role.select', 'member') }}"
           class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
            <i class="fas fa-plus mr-2"></i>
            Create Your First Post
        </a>
    </div>
    @endif
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
    });

    // Refresh posts function
    function refreshPosts() {
        location.reload();
    }

    // Like post
    $(document).on('click', '.likePostBtn', function() {
        let postId = $(this).data('id');
        let button = $(this);

        $.post(`/posts/${postId}/like`, function() {
            button.addClass('text-blue-600');
            // Update the like count
            setTimeout(refreshPosts, 500);
        }).fail(function() {
            alert('Failed to like post. Please try again.');
        });
    });

    // Like comment
    $(document).on('click', '.likeCommentBtn', function() {
        let commentId = $(this).data('id');
        let button = $(this);

        $.post(`/comments/${commentId}/like`, function() {
            button.addClass('text-blue-600');
            setTimeout(refreshPosts, 500);
        }).fail(function() {
            alert('Failed to like comment. Please try again.');
        });
    });

    // Favourite post
    $(document).on('click', '.favouritePostBtn', function() {
        let postId = $(this).data('id');
        let button = $(this);

        $.post(`/posts/${postId}/favourite`, function() {
            button.addClass('text-yellow-600');
            setTimeout(refreshPosts, 500);
        }).fail(function() {
            alert('Failed to favourite post. Please try again.');
        });
    });

    // Add comment
    $(document).on('keypress', '.comment-input', function(e) {
        if(e.which === 13){
            let postId = $(this).data('postid');
            let comment = $(this).val().trim();
            let inputField = $(this);

            if (comment === '') {
                alert('Please enter a comment.');
                return;
            }

            inputField.prop('disabled', true);

            $.post('/comments', { post_id: postId, comment: comment }, function() {
                inputField.val('').prop('disabled', false);
                setTimeout(refreshPosts, 500);
            }).fail(function() {
                inputField.prop('disabled', false);
                alert('Failed to post comment. Please try again.');
            });
        }
    });
});
</script>
@endsection
