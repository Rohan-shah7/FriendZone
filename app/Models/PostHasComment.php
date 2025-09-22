<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostHasComment extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'post_id', 'comment', 'parent_id'];

    public function post() {
        return $this->belongsTo(Post::class, 'post_id');
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function parent() {
        return $this->belongsTo(PostHasComment::class, 'parent_id');
    }

    public function replies() {
        return $this->hasMany(PostHasComment::class, 'parent_id');
    }

    public function likes() {
        return $this->hasMany(CommentHasLike::class, 'post_has_comment_id');
    }
}
