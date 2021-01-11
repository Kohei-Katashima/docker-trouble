<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    protected $fillable = [
        'user_id', 'content', 'title', 'image'
    ];

    public function user() {
        return $this->belongsTo(\App\User::class,'user_id');
    }
    public function comments() {
        return $this->hasMany(\App\Models\Comment::class,'post_id','id');
    }
    public function tags() {
        return $this->belongsToMany(\App\Models\Tag::class);
    }
}
