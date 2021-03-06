@extends('layouts.carousel')

@section('content')
<main role="main" class="container">
  <div class="d-flex align-items-center p-3 my-3 text-white-50 bg-purple rounded shadow-sm">
    <img class="mr-3" src="../assets/brand/bootstrap-outline.svg" alt="" width="48" height="48">
    <div class="lh-100">
      <h6 class="mb-0 text-white lh-100">ナヤミ掲示板</h6>
      <small>Since 2020
      </small>

    </div>
    <form class="form-inline mt-2 mt-md-0 ml-5">
      <input class="form-control mr-sm-2" type="text" placeholder="朝起きられない" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">検索</button>
    </form>
    <a href="{{ route('posts.create') }}" class="d-block btn btn-outline-primary my-2 my-sm-0 ml-3">投稿する</a>
  </div>

  @if (session('err_msg'))
  <p class="text-danger">{{ session('err_msg') }}</p>
  @endif

  <div class="my-3 p-3 bg-white rounded shadow-sm">
    <div class="d-flex justify-content-between  align-items-center w-100 border-bottom border-gray">
      <h3 class="pb-2 mb-0">{{ $post->title }}</h3>
      @if (Auth::user()->id === $post->user_id)
      <span class="d-block text-right"><a href="{{ route('posts.edit',$post->id) }}">編集する</a></span>
      <form method="POST" action="{{ route('posts.destroy', $post->id) }}" id="delete_{{ $post->id }}">
        @csrf
        <input type="hidden" name="_method" value="DELETE">
        <input type="submit" class="d-block text-righ" value="削除する" data-id="{{ $post->id }}" onclick="deletePost(this);"></input>
      </form>
      @endif
    </div>
    <div class="media text-muted pt-3">
      @if(isset($post->image))
      <img src="{{ asset('storage/image/'.$post->image) }}" class="bd-placeholder-img mr-2 rounded" width="32" height="32" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 32x32">
      @elseif(!isset($post->image))
      <svg class="bd-placeholder-img mr-2 rounded" width="32" height="32" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 32x32">
        <title>Placeholder</title>
        <rect width="100%" height="100%" fill="#007bff" /><text x="50%" y="50%" fill="#007bff" dy=".3em">32x32</text>
      </svg>
      @endif
      <div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
        <div class="d-flex justify-content-between align-items-center w-100">
          <strong class="text-gray-dark">{{ $post->user->name}}</strong>
          @if (Auth::user()->id <> $post->user_id)
            <a href="#">Follow</a>
            @endif
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
    @foreach($post->tags as $tag)
    <a href="{{ route('posts.index', ['tag_name' => $tag->tag_name]) }}" class="badge badge-light">{{ $tag->tag_name}}</a>
    @endforeach
  </div>

  <div class="my-3 p-3 bg-white rounded shadow-sm">
    <h6 class="border-bottom border-gray pb-2 mb-0">解決コメント</h6>
    @foreach($post->comments as $comment)
    <div class="media text-muted pt-3">
      <svg class="bd-placeholder-img mr-2 rounded" width="32" height="32" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 32x32">
        <title>Placeholder</title>
        <rect width="100%" height="100%" fill="#007bff" /><text x="50%" y="50%" fill="#007bff" dy=".3em">32x32</text>
      </svg>
      <div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
        <div class="d-flex justify-content-between align-items-center w-100">
          <strong class="text-gray-dark">{{Auth::user()->id}}</strong>
          @if (Auth::user()->id <> $post->user_id)
            <a href="#">Follow</a>
            @endif
        </div>
        <span class="d-block">@username</span>
      </div>
      <p class="media-body pt-3 pb-3 mb-0 lh-125 border-bottom border-gray">
      {!! nl2br(e($comment['content']))!!}
    </p>
    <small class="d-block text-right mt-3">
      <strong class="d-block text-gray-dark">{{ $comment->updated_at}}</strong>
    </small>
    </div>
    @endforeach

    <small class="d-block text-right mt-3">
      <a href="#">All suggestions</a>
    </small>
  </div>
  <small class="d-block text-right mt-3">
    <a href="{{ route('posts.index') }}">戻る</a>
  </small>

  
  <script>
    function deletePost(e) {
      'use strict';
      if (confirm('本当に削除してもよろしいですか？')) {
        document.getElementById('delete_' + e.dataset.id).submit();
      }
    }
  </script>
</main>

@endsection