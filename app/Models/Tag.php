<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    /** @use HasFactory<\Database\Factories\TagFactory> */
    use HasFactory;

    protected $table = 'hashtags';
    public $timestamps = false;
    protected $guarded = [];

    public function taggedPost() {
        return $this->belongsToMany(Post::class, 'tag_pivots', 'hashtag_id', 'post_id');
    }
}
