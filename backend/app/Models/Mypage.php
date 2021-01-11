<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mypage extends Model
{
    //
    protected $fillable = [
        'user_id', 'profile_image', 'gender', 'age', 'introduction'
    ];

    public function user() {
        return $this->belongsTo(\App\User::class,'user_id');
    }
}