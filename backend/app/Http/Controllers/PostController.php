<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Tag;
use App\User;
use App\Http\Requests\PostRequest;
use App\Http\Controllers\Controller, Session;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $q = \Request::query();
        $posts = Post::latest()->paginate(6);
        $users = User::inRandomOrder()->paginate(3);
        $tags = Tag::inRandomOrder()->paginate(6);

        
        if (isset($q['tag_name'])) {
            $posts = Post::latest()->where('content', 'like', "%{$q['tag_name']}%")->orwhere('title', 'like', "%{$q['tag_name']}%")->paginate(6);
            $posts->load('user', 'tags');

            $tags = Tag::latest()->where('tag_name', 'like', "%{$q['tag_name']}%")->paginate(6);
            $tags->load('posts');

            return view('posts.index', [
                'posts' => $posts,
                'tag_name' => $q['tag_name'],
                'users' => $users,
                'tags' => $tags,

            ]);
        } else {

            return view('posts.index', [
                'posts' => $posts,
                'users' => $users,
                'tags' => $tags,

            ]);
        }


        if (is_null($posts)) {
            Session::flash('err_msg', 'データがありません。');
            return redirect(route('posts/'));
            return view('posts.index', [
                'posts' => $posts,
                'users' => $users,
                'tags' => $tags,

            ]);
        }

        return view('posts.show', [
            'posts' => $posts,
            'users' => $users,
            'tags' => $tags,

        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        if (Auth::check()) {
            return view('posts.create');
        } else {
            return redirect('login/');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        //
        $post = new Post;
        $post->user_id = $request->input('user_id');
        $post->title = $request->input('title');
        $post->content = $request->input('content');

        if ($request->hasFile('image')) {
            $filename = $request->file('image')->store('public/image');
            $post->image = basename($filename);
        }

        preg_match_all('/#([a-zA-z0-9０-９ぁ-んァ-ヶ亜-熙]+)/u', $request->tag_name, $match);

        $tags = [];
        foreach ($match[1] as $tag) {
            $record = Tag::firstOrCreate(['tag_name' => $tag]);
            // firstOrCreateメソッドで、tags_tableのnameカラムに該当のない$tagは新規登録される。
            array_push($tags, $record);
            // $recordを配列に追加します(=$tags)
        };


        $tags_id = [];
        foreach ($tags as $tag) {
            array_push($tags_id, $tag['id']);
        };

        $post->save();
        $post->tags()->attach($tags_id);

        Session::flash('err_msg', '投稿されました');

        return redirect('posts/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //

        $q = \Request::query();
        $post = Post::findOrFail($id);
        $users = User::inRandomOrder()->paginate(3);
        $comments = Comment::all();


        if (isset($q['tag_name'])) {
            $posts = Post::latest()->where('content', 'like', "%{$q['tag_name']}%")->paginate(6);
            $posts->load('user', 'tags');

            return view('posts.index', [
                'posts' => $posts,
                'tag_name' => $q['tag_name'],
                'users' => $users,
            ]);
        }


        if (is_null($post)) {
            Session::flash('err_msg', 'データがありません。');
            return redirect(route('posts/'));
            return view('posts.index', [
                'posts' => $post,
                'users' => $users,
            ]);
        }

        return view('posts.show', [
            'post' => $post,
            'users' => $users,
            'comments' => $comments,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $post = Post::findOrFail($id);
        $users = User::inRandomOrder()->paginate(3);

        if (is_null($post)) {
            Session::flash('err_msg', 'データがありません。');
            return redirect(route('posts/'));
        }

        return view('posts.edit', [
            'post' => $post,
            'users' => $users,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, Post $post)
    {
        //

        if (is_null($post)) {
            Session::flash('err_msg', 'データがありません。');
            return redirect(route('posts/'));
        }

        $post->user_id = $request->input('user_id');
        $post->title = $request->input('title');
        $post->content = $request->input('content');

        if ($request->hasFile('image')) {
            $filename = $request->file('image')->store('public/image');
            $post->image = basename($filename);
        }

        preg_match_all('/#([a-zA-z0-9０-９ぁ-んァ-ヶ亜-熙]+)/u', $request->tag_name, $match);


        $tags = [];
        foreach ($match[1] as $tag) {
            $record = Tag::firstOrCreate(['tag_name' => $tag]);
            // firstOrCreateメソッドで、tags_tableのnameカラムに該当のない$tagは新規登録される。
            array_push($tags, $record);
            // $recordを配列に追加します(=$tags)
        };

        $tags_id = [];
        foreach ($tags as $tag) {
            array_push($tags_id, $tag['id']);
        };

        $post->fill($request->all())->save();
        $post->tags()->sync($tags_id);


        Session::flash('err_msg', '更新されました');

        return redirect('posts/' . $post->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $post = Post::findOrFail($id);
        $post->delete();

        Session::flash('err_msg', '投稿が削除されました。');
        return redirect('posts/');
    }

    public function search1(Request $request)
    {
        //
        $users = User::inRandomOrder()->paginate(3);
        $tags = Tag::inRandomOrder()->paginate(6);
        $posts = Post::latest()->where('title', 'like', "%{$request->search}%")->orwhere('content', 'like', "%{$request->search}%")->paginate(6);

        $search_result = $request->search. 'を含む検索結果'. $posts->total(). '件';

        // $posts->load('user', 'tags');

        return view('posts.index', [
            'posts' => $posts,
            'search_result' => $search_result,
            'search_query' => $request->search,
            'users' => $users,
            'tags' => $tags,
        ]);
    }
}
