<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Badge extends Model
{
    /** @use HasFactory<\Database\Factories\BadgeFactory> */
    use HasFactory;

    public $timestamps = false;
    protected $guarded = [];

    public function badgedUser() {
        return $this->belongsToMany(User::class, 'badge_pivots', 'badge_id', 'user_id');
    }

}
