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
    <form class="form-inline mt-2 mt-md-0 ml-5">
      @csrf
      <input class="form-control mr-sm-2" type="text" placeholder="朝起きられない" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">検索</button>
    </form>
  </div>

  @if($errors->any())
  <div class="alert alert-danger">
    <ul>
      @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
  @endif

  <div class="my-3 p-3 bg-white rounded shadow-sm">
  <div class="d-flex media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
  @if(isset(Auth::user()->profile_image))
    <img src="{{ asset('storage/profile_image/'.Auth::user()->profile_image) }}" class="bd-placeholder-img mr-2 rounded-circle" width="32" height="32" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 32x32">
      @elseif(!isset(Auth::user()->profile_image))
      <svg class="bd-placeholder-img mr-2 rounded-circle" width="32" height="32" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 32x32">
        <title>Placeholder</title>
        <rect width="100%" height="100%" fill="#777" /><text x="50%" y="50%" fill="#777" dy=".3em">32x32</text>
      </svg>
      @endif
      <h6 class="">{{ Auth::user()->name }}</h6>
    </div>
    <div class="media text-muted pt-3">
      <div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
        <!-- <div class="d-flex justify-content-between align-items-center w-100">
          <strong class="text-gray-dark"></strong>
          <a href="#">Follow</a>
        </div> -->
        <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
          @method('PUT')
          @csrf
          <div class="form-group">
            <label for="title">タイトル</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ $post->title }}">
          </div>
          <div class="form-group">
            <label for="content">内容</label>
            <textarea class="form-control" id="content" rows="20" name="content">{{ $post->content }}</textarea>
          </div>
          <div class="form-group">
            <label for="exampleFormControlFile1">画像あればどぞ</label>
            <input type="file" class="form-control-file" id="exampleFormControlFile1" name="image" value="{{ asset('storage/image/'.$post->image) }}">
          </div>
          <div class="form-group">
            <post-tags-input  :initial-tags='@json($tagNames ?? [])' :autocomplete-items='@json($allTagNames ?? [])'>
            </post-tags-input>
          </div>
            </div>
          </div>
          <input type="hidden" name="user_id" value="{{ Auth::id() }}">
          <button type="submit" class="btn btn-primary">更新する</button>
        </form>
        <span class="d-block">@username</span>
    <small class="d-block text-right mt-3">
      <a href="{{ route('posts.show', $post->id) }}">戻る</a>
    </small>
      </div>
    </div>

  </div>
</main>

@endsection