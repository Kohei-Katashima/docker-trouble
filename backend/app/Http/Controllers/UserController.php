<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\Post;
use App\Http\Controllers\Controller, Session;



class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users = User::latest()->paginate(10);
        return view('users.index', [
            'users' => $users,
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
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $user = User::findOrFail($id);
        $user->load('posts');
        $posts = Post::latest()->paginate(3);



        if ($id == \Auth::user()->id) {
            return view('users.me', [
                'user' => $user, 
                'posts' => $posts,
            ]);
        }

        if ($id != \Auth::user()->id) {
            $user = User::where('id', $id)->first();
            return view('users.show', [
                'user' => $user, 
                'posts' => $posts,
            ]);
        }
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
        $user = User::findOrFail($id);

        if (is_null($user)) {
            Session::flash('err_msg', 'データがありません。');
            return redirect(route('users/'));
        }

        return view('users.edit', [
            'user' => $user,
        ]);
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
        if (is_null($user)) {
            Session::flash('err_msg', 'データがありません。');
            return redirect(route('users/'));
        }

        $user->id = $request->input('id');
        $user->name = $request->input('name');
        $user->gender = $request->input('gender');
        $user->age = $request->input('age');
        $user->introduction = $request->input('introduction');

        if ($request->hasFile('profile_image')) {
            $filename = $request->file('profile_image')->store('public/pofile_image');
            $user->profile_image = basename($filename);
        }
        $user->save();


        Session::flash('err_msg', '更新されました');

        return redirect('users/' . $user->id);
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
    }

    public function search(Request $request)
    {
        //
        $users = User::latest()->where('name', 'like', "%{$request->search}%")->paginate(10);

        $search_result = $request->search. 'を含む検索結果'. $users->total(). '件';

        // $users->load('user', 'tags');

        return view('users.index', [
            'users' => $users,
            'search_result' => $search_result,
            'search_query' => $request->search,
        ]);
    }
}
