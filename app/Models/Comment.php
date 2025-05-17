<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    /** @use HasFactory<\Database\Factories\CommentFactory> */
    use HasFactory;

    protected $guarded = [];

    public function post() {
        return $this->belongsTo(Post::class);
    }
    public function votes() {
        return $this->belongsToMany(User::class, 'comment_votes', 'comment_id', 'user_id');
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function reports() {
        return $this->belongsToMany(User::class, 'comment_reports', 'comment_id', 'user_id')->withPivot('content');
    }

    public function upvotedBy() {
        return $this->belongsToMany(User::class, 'comment_votes', 'comment_id', 'user_id')->where('is_upvoted', true);
    }
    public function downvotedBy() {
        return $this->belongsToMany(User::class, 'comment_votes', 'comment_id', 'user_id')->where('is_upvoted', false);
    }


}
