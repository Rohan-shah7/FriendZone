<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['created_by', 'postdetails', 'post', 'status'];

    public function user() {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function likes() {
        return $this->hasMany(PostHasLike::class, 'post_id');
    }

    public function comments() {
        return $this->hasMany(PostHasComment::class, 'post_id');
    }

    public function favourites() {
        return $this->hasMany(UserHaveFavourite::class, 'post_id');
    }
}
