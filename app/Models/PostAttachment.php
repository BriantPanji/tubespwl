<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostAttachment extends Model
{
    /** @use HasFactory<\Database\Factories\PostAttachmentFactory> */
    use HasFactory;
    protected $table = 'post_attachments';
    public $timestamps = false;
    public $incrementing = false;
    protected $guarded = [];

    public function post() {
        return $this->belongsTo(Post::class, 'post_id');
    }
    
}
