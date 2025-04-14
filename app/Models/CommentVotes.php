<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommentVotes extends Model
{
    /** @use HasFactory<\Database\Factories\CommentVotesFactory> */
    use HasFactory;
    protected $table = 'comment_votes';
    protected $guarded = [];
    public $timestamps = false;
    public $incrementing = false;

    public function comment() {
        return $this->belongsTo(Comment::class);
    }
    public function user() {
        return $this->belongsTo(User::class);
    }
}
