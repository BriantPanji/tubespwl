<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'display_name',
        'username',
        'email',
        'password',
        'is_admin',
        'avatar',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function posts() {
        return $this->hasMany(Post::class);
    }

    public function votedPost() {
        return $this->belongsToMany(Post::class, 'post_votes', 'user_id', 'post_id');
    }

    public function comments() {
        return $this->hasMany(Comment::class);
    }
    public function votedComments() {
        return $this->belongsToMany(Comment::class, 'comment_votes', 'user_id', 'comment_id');
    }

    public function badges() {
        return $this->belongsToMany(Badge::class, 'badge_pivots', 'user_id', 'badge_id');
    }

    public function reportedPosts() {
        return $this->belongsToMany(Post::class, 'post_reports', 'user_id', 'post_id');
    }
    public function reportedComments() {
        return $this->belongsToMany(Comment::class, 'comment_reports', 'user_id', 'comment_id');
    }

    public function bookmarks() {
        return $this->belongsToMany(Post::class, 'bookmarks', 'user_id', 'post_id');
    }

    public function hasBookmarkedPost(Post $post)
    {
        return $this->bookmarks()->where('post_id', $post->id)->exists();
    }

    public function hasVotedPost(Post $post)
    {
        return $this->votedPost()->where('post_id', $post->id)->exists();
    }

    public function hasUpvotedPost(Post $post)
    {
        return $this->votedPost()->where('post_id', $post->id)->where('is_upvoted', true)->exists();
    }
    public function hasDownvotedPost(Post $post)
    {
        return $this->votedPost()->where('post_id', $post->id)->where('is_upvoted', false)->exists();
    }

    public function hasVotedComment(Comment $comment) {
        return $this->votedComments()->where('comment_id', $comment->id)->exists();
    }
    public function hasUpvotedComment(Comment $comment)
    {
        return $this->votedComments()->where('comment_id', $comment->id)->where('is_upvoted', true)->exists();
    }
    public function hasDownvotedComment(Comment $comment)
    {
        return $this->votedComments()->where('comment_id', $comment->id)->where('is_upvoted', false)->exists();
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
