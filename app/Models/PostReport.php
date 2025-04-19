<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostReport extends Model
{
    /** @use HasFactory<\Database\Factories\PostReportFactory> */
    use HasFactory;

    protected $table = 'post_reports';
    public $timestamps = false;
    protected $guarded = [];

    public function post() {
        return $this->belongsTo(Post::class, 'post_id');
    }
    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
