<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;
use App\Models\Post;
use App\User;

class TagController extends Controller
{
    //

    public function show(string $tag_name)
    {
        $tag = Tag::where('tag_name', $tag_name)->first();
        $posts = Post::latest()->paginate(6);
        $users = User::inRandomOrder()->paginate(3);

        return view('tags.show', [
            'tag' => $tag,
            'posts' => $posts,
            'users' => $users,
        ]);
    }
}
