@extends('layouts.carousel')

@section('content')
<main role="main" class="container">
  <div class="d-flex align-items-center p-3 my-3 text-white-50 bg-purple rounded shadow-sm">
    <img class="mr-3" src="{{ asset('image/nayamu_boy2.png') }}" alt="" width="48" height="48">
    <div class="lh-100">
      <h6 class="mb-0 text-white lh-100">ナヤミ掲示板</h6>
      <small>Since 2020
      </small>

    </div>
    <form class="form-inline mt-2 mt-md-0 ml-5" action="{{ route('posts.search') }}" method="GET">
      @csrf
      <input class="form-control mr-sm-2" type="search" placeholder="朝起きられない" aria-label="Search" name="search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">検索</button>
    </form>
    <a href="{{ route('posts.create') }}" class="d-block btn btn-primary my-2 my-sm-0 ml-3">投稿する</a>
  </div>

  @if (session('err_msg'))
  <p class="text-danger">{{ session('err_msg') }}</p>
  @endif

  <div class="my-3 p-3 bg-white rounded shadow-sm">
    <div class="d-flex justify-content-between  align-items-center w-100 border-bottom border-gray">
      <h3 class="pb-2 mb-0">{{ $post->title }}</h3>
      @auth
      @if (Auth::user()->id === $post->user_id)
      <span class="d-block text-right"><a href="{{ route('posts.edit',$post->id) }}">編集する</a></span>
      <form method="POST" action="{{ route('posts.destroy', $post->id) }}" id="delete_{{ $post->id }}">
        @csrf
        <input type="hidden" name="_method" value="DELETE">
        <input type="button" class="d-block text-righ" value="削除する" data-id="{{ $post->id }}" onclick="deletePost(this);return false;"></input>
      </form>
      @endif
      @endauth
    </div>
    <div class="media text-muted pt-3">
      @if(isset($post->user->profile_image))
      <img src="{{ asset('storage/profile_image/'.$post->user->profile_image) }}" class="bd-placeholder-img mr-2 rounded-circle" width="32" height="32" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 32x32">
      @elseif(!isset($post->user->profile_image))
      <svg class="bd-placeholder-img mr-2 rounded-circle" width="32" height="32" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 32x32">
        <title>Placeholder</title>
        <rect width="100%" height="100%" fill="#777" /><text x="50%" y="50%" fill="#777" dy=".3em">32x32</text>
      </svg>
      @endif
      <div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
        <div class="d-flex justify-content-between align-items-center w-100">
          <a href="{{route('users.show',$post->user_id)}}" class="text-muted">
            <strong class="text-gray-dark">{{ $post->user->name}}</strong>
          </a>
          @auth
          @if (Auth::user()->id <> $post->user_id)
            <a href="#">Follow</a>
            @endif
            @endauth
        </div>
      </div>
    </div>
    <div class="pt-3">
      @if (isset($post->image))
      <img src="{{ asset('storage/image/'.$post->image) }}" class="img-fluid" alt="Responsive image">
      @endif
    </div>
    <p class="media-body pt-3 pb-3 mb-0 lh-125 border-bottom border-gray">
      {!! nl2br(e($post['content']))!!}
    </p>
    <small class="d-block text-right mt-3">
      <strong class="d-block text-gray-dark">{{ $post->updated_at}}</strong>
    </small>
    <div class="card-body text-right pt-0 pb-2 pl-3">
      <div class="card-text">
        <post-like :initial-is-liked-by='@json($post->isLikedBy(Auth::user()))' :initial-count-likes='@json($post->count_likes)' :authorized='@json(Auth::check())' endpoint="{{ route('posts.like', ['post' => $post]) }}">
        </post-like>
      </div>
    </div>

    @foreach($post->tags as $tag)
    @if($loop->first)
    <div class="card-body pt-0 pb-4 pl-1 ">
      <div class="card-text line-height ">
        @endif
        <a href="{{ route('posts.index', ['tag_name' => $tag->tag_name]) }}" class="badge badge-light ml-2">{{ $tag->hashtag }}</a>
        @if($loop->last)
      </div>
    </div>
    @endif
    @endforeach
  </div>

  @if (session('commentstatus'))
  <p class="text-danger">{{ session('commentstatus') }}</p>
  @endif

  <div class="my-3 p-3 bg-white rounded shadow-sm">
    <h6 class="border-bottom border-gray pb-2 mb-0">解決コメント</h6>
    <div class="media text-muted pt-3">
      @auth
      @if(isset(Auth::user()->profile_image))
      <img src="{{ asset('storage/profile_image/'.Auth::user()->profile_image) }}" class="bd-placeholder-img mr-2 rounded-circle" width="32" height="32" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 32x32">
      @elseif(!isset(Auth::user()->profile_image))
      <svg class="bd-placeholder-img mr-2 rounded-circle" width="32" height="32" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 32x32">
        <title>Placeholder</title>
        <rect width="100%" height="100%" fill="#777" /><text x="50%" y="50%" fill="#777" dy=".3em">32x32</text>
      </svg>
      @endif
      <div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
        <div class="d-flex justify-content-between align-items-center w-100">
          <strong class="text-gray-dark">{{ Auth::user()->name }}</strong>
        </div>
      </div>
      @endauth

    </div>
    @if($errors->any())
    <div class="alert alert-danger mt-3">
      <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
    @endif
    @auth
    <form action="{{ route('comments.store') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="form-group pt-3">
        <label for="comment">コメント</label>
        <textarea class="form-control" id="comment" rows="3" name="comment">{{ old('content') }}</textarea>
      </div>
      <input type="hidden" name="post_id" value="{{ $post->id }}">
      <input type="hidden" name="user_id" value="{{ Auth::id() }}">
      <small class="d-block text-right mt-3">
        <button type="submit" class="btn btn-primary">投稿する</button>
      </small>

    </form>
    @endauth
    <h6 class="border-bottom border-gray pb-2 mb-0">コメント一覧<span class="badge badge-light ml-2">{{count($post->comments)}}</span></h6>
    @foreach($post->comments as $comment)
    <div class="media text-muted pt-3">
      @if(isset($comment->user->profile_image))
      <img src="{{ asset('storage/profile_image/'.$comment->user->profile_image) }}" class="bd-placeholder-img mr-2 rounded-circle" width="32" height="32" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 32x32">
      @elseif(!isset($comment->user->profile_image))
      <svg class="bd-placeholder-img mr-2 rounded-circle" width="32" height="32" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 32x32">
        <title>Placeholder</title>
        <rect width="100%" height="100%" fill="#777" /><text x="50%" y="50%" fill="#777" dy=".3em">32x32</text>
      </svg>
      @endif
      <div class="media-body pb-3 mb-0 small lh-125 ">
        <div class="d-flex justify-content-between align-items-center w-100">
          <a href="{{route('users.show',$comment->user_id)}}" class="text-muted">
            <strong class="text-gray-dark">{{ $comment->user->name }}</strong>
          </a>
          @auth
          @if (Auth::user()->id === $comment->user_id)
          <form method="POST" action="{{ route('comments.destroy', $comment->id) }}" id="delete_{{ $comment->id }}">
            @csrf
            <input type="hidden" name="_method" value="DELETE">
            <input type="button" class="d-block text-righ" value="削除する" data-id="{{ $comment->id }}" onclick="deletePost(this);return false;"></input>
          </form>
          @elseif (Auth::user()->id !== $comment->user_id)
          <a href="#">Follow</a>
          @endif
          @endauth
        </div>
        <div class="d-flex justify-content-between align-items-center w-100">
          <strong class="d-block text-gray-dark">{{ $comment->updated_at}}</strong>
        </div>
        <p class="media-body pt-3 pb-3 mb-0 lh-125 border-bottom border-gray">
          {!! nl2br(e($comment['comment']))!!}
        </p>
      </div>
    </div>
    @endforeach
  </div>

  <small class="d-block text-right mt-3">
    <a href="{{ route('posts.index') }}">戻る</a>
  </small>

  <div class="my-3 p-3 bg-white rounded shadow-sm">
    <h6 class="border-bottom border-gray pb-2 mb-0">おすすめユーザー</h6>
    @foreach($users as $user)
    <div class="media text-muted pt-3">
      @if(isset($user->profile_image))
      <img src="{{ asset('storage/profile_image/'.$user->profile_image) }}" class="bd-placeholder-img mr-2 rounded-circle" width="32" height="32" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 32x32">
      @elseif(!isset($user->profile_image))
      <svg class="bd-placeholder-img mr-2 rounded-circle" width="32" height="32" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 32x32">
        <title>Placeholder</title>
        <rect width="100%" height="100%" fill="#777" /><text x="50%" y="50%" fill="#777" dy=".3em">32x32</text>
      </svg>
      @endif
      <div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
        <div class="d-flex justify-content-between align-items-center w-100">
          <a href="{{route('users.show',$user->id)}}" class="text-muted">
            <strong class="text-gray-dark">
              {{ $user->name }}
            </strong>
          </a>
          <a href="#">Follow</a>
        </div>
        <span class="d-block">@username</span>
      </div>
    </div>
    @endforeach

    <small class="d-block text-right mt-3">
      <a href="{{route('users.index')}}">ユーザー一覧へ</a>
    </small>
  </div>
  <script src="{{ mix('js/app.js') }}"></script>
  <script>
    function deletePost(e) {
      'use strict';
      if (confirm('本当に削除してもよろしいですか？')) {
        document.getElementById('delete_' + e.dataset.id).submit();
      } else {
        window.alert('キャンセルされました');
        return false;
      }

    }
  </script>
</main>

@endsection