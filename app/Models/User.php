<?php
namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Role helper functions
    public function isAdmin(): bool {
        return $this->role === 'admin';
    }

    public function isMember(): bool {
        return $this->role === 'member';
    }

    public function isUser(): bool {
        return $this->role === 'user';
    }

    // Relationships
    public function posts() {
        return $this->hasMany(Post::class, 'created_by');
    }

    public function postLikes() {
        return $this->hasMany(PostHasLike::class);
    }

    public function comments() {
        return $this->hasMany(PostHasComment::class);
    }

    public function commentLikes() {
        return $this->hasMany(CommentHasLike::class);
    }

    public function favourites() {
        return $this->hasMany(UserHaveFavourite::class);
    }
}
