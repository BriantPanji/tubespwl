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
    public function commentedBy() {
        return $this->hasMany(CommentVotes::class, 'comment_id');
    }
    public function reports() {
        return $this->hasMany(CommentReport::class, 'comment_id');
    }
    

}
