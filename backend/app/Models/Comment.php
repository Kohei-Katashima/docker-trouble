<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    protected $fillable = [
        'user_id', 'post_id', 'comment'
    ];

    public function user() {
        return $this->belongsTo(\App\User::class,'user_id');
    }
}

