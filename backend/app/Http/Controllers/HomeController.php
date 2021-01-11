<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // return view('home');
        $users = User::latest()->paginate(3);
        $posts = Post::latest()->paginate(2);
        $tags = Tag::latest()->paginate(8);
        // $users->load('users');

        return view('home',[
            'users' => $users,
            'posts' => $posts,
            'tag_name' => $tags,
        ]);
    }
}
