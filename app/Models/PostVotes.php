<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostVotes extends Model
{
    /** @use HasFactory<\Database\Factories\PostVotesFactory> */
    use HasFactory;
    protected $table = 'post_votes';
    public $timestamps = false;
    public $incrementing = false;
    protected $guarded = [];

    public function post() {
        return $this->belongsTo(Post::class);
    }
    public function user() {
        return $this->belongsTo(User::class);
    }
}
