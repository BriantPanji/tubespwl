<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommentReport extends Model
{
    /** @use HasFactory<\Database\Factories\CommentReportFactory> */
    use HasFactory;

    protected $table = 'comment_reports';
    public $timestamps = false;
    protected $guarded = [];

    public function comment() {
        return $this->belongsTo(Comment::class, 'comment_id');
    }
}
