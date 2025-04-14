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

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function comments() {
        return $this->hasMany(Comment::class);
    }

    public function votedBy() {
        return $this->belongsToMany(User::class, 'post_votes', 'post_id', 'user_id');
    }

    public function attachments() {
        return $this->hasMany(PostAttachment::class, 'post_id');
    }
    
    public function tag() {
        return $this->belongsToMany(Tag::class, 'tag_pivots', 'post_id', 'hashtag_id');
    }

    public function reportedBy() {
        return $this->hasMany(PostReport::class, 'post_id');
    }
}