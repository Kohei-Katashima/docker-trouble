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
    <a href="{{ route('posts.create') }}" class="d-block btn btn-primary my-2 my-sm-0 ml-3">投稿</a>
    <form class="form-inline mt-2 mt-md-0 ml-3 col-md-4 col-6" action="{{ route('posts.search') }}" method="GET">
      @csrf
      <input class="form-control mr-sm-2" type="search" placeholder="朝起きられない" aria-label="Search" name="search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">検索</button>
    </form>
  </div>



  @if (session('err_msg'))
  <p class="text-danger">{{ session('err_msg') }}</p>
  @endif

  @isset ($search_result)
  <p class="text-info">{{ $search_result }}</p>
  @endisset

  <div class="container">
    <div class="card mt-3">
      <div class="card-body">
        <div class="card-text line-height">
          <h3><span class="badge badge-light ml-2 ">{{ $tag->hashtag }}</span></h3>
          <div class="card-text text-right">
            {{ $tag->posts->count() }}件
          </div>
        </div>
      </div>
    </div>

    <div class="my-3 p-3 bg-white rounded shadow-sm">
      <h6 class="border-bottom border-gray pb-2 mb-0">最近の投稿</h6>

      @foreach($tag->posts as $post)
      <div class="media text-muted pt-3">
        @if(isset($post->image))
        <img src="{{ asset('storage/image/'.$post->image) }}" class="bd-placeholder-img mr-2 rounded" width="32" height="32" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 32x32">
        @elseif(!isset($post->image))
        <svg class="bd-placeholder-img mr-2 rounded" width="32" height="32" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 32x32">
          <title>Placeholder</title>
          <rect width="100%" height="100%" fill="#eee" /><text x="50%" y="50%" fill="#aaa" dy=".3em">noimage</text>
        </svg>
        @endif
        <div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
          <div class="d-flex justify-content-between align-items-center w-100">
            <a href="{{ route('posts.show',$post->id) }}" class="text-muted">
              <strong class="d-block text-gray-dark">{{ $post->updated_at}}</strong>
              <strong class="d-block text-gray-dark">{{ $post->title}}</strong>
              {!!(e(Str::limit($post['content'], 50)))!!}
            </a>
            <a href="{{route('users.show',$post->user_id)}}" class="text-muted">{{ $post->user->name }}</a>
          </div>

        </div>

      </div>
      @endforeach
      @if(isset($search_query))
      <small class="d-block text-right mt-3">
        {{ $posts->appends(['search' => $search_query])->links() }}
      </small>
      @else
      @endif
    </div>


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
</main>

@endsection