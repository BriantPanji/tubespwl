<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /** @use HasFactory<\Database\Factories\PostFactory> */
    use HasFactory, HasUlids;
    protected $keyType = 'string'; // ULID adalah string
    public $incrementing = false;  // Karena bukan auto-increment
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function votedBy()
    {
        return $this->belongsToMany(User::class, 'post_votes', 'post_id', 'user_id');
    }
    public function upvotedBy()
    {
        return $this->belongsToMany(User::class, 'post_votes', 'post_id', 'user_id')->where('is_upvoted', 1);
    }
    public function downvotedBy()
    {
        return $this->belongsToMany(User::class, 'post_votes', 'post_id', 'user_id')->where('is_upvoted', -1);
    }

    public function attachments()
    {
        return $this->hasMany(PostAttachment::class, 'post_id');
    }

    public function tag()
    {
        return $this->belongsToMany(Tag::class, 'tag_pivots', 'post_id', 'hashtag_id');
    }

    public function reports()
    {
        return $this->belongsToMany(User::class, 'post_reports', 'post_id', 'user_id')->withPivot('content');
    }
    public function bookmarkedBy()
    {
        return $this->belongsToMany(User::class, 'bookmarks', 'post_id', 'user_id');
    }
}
