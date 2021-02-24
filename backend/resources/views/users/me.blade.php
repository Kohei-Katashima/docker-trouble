@extends('layouts.carousel')

@section('content')
<div class="container marketing mt-5">

  @if (session('err_msg'))
  <p class="text-danger">{{ session('err_msg') }}</p>
  @endif

  <div class="row justify-content-center">
    <div class="col-auto">
      @if(isset($user->profile_image))
      <img src="{{ asset('storage/profile_image/'.$user->profile_image) }}" class="bd-placeholder-img rounded-circle" width="140" height="140" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 140x140">
      @elseif(!isset($user->profile_image))
      <svg class="bd-placeholder-img rounded-circle" width="140" height="140" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 140x140">
        <title>Placeholder</title>
        <rect width="100%" height="100%" fill="#777" /><text x="50%" y="50%" fill="#777" dy=".3em">140x140</text>
      </svg>
      @endif
      <h2>
        {{ Auth::user()->name }}
      </h2>
      @if(isset($user->gender))
      <p>性別：{{$user->gender}}</p>
      @elseif(!isset($user->gender))
      <p>性別：未登録</p>
      @endif

      @if(isset($user->age))
      <p>年齢：{{$user->age}}</p>
      @elseif(!isset($user->age))
      <p>年齢：未登録</p>
      @endif

      @if(isset($user->introduction))
      <p>{!! nl2br(e($user['introduction']))!!}</p>
      @elseif(!isset($user->introduction))
      <p>自己紹介：未登録</p>
      @endif


      <!-- <p>Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. Nullam id dolor id nibh ultricies vehicula ut id elit. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Praesent commodo cursus magna.</p>
      <p>Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. Nullam id dolor id nibh ultricies vehicula ut id elit. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Praesent commodo cursus magna.</p> -->

      <p><a class="btn btn-secondary float-right" href="{{ route('users.edit', Auth::user()->id)}}" role="button">編集する &raquo;</a></p>
    </div><!-- /.col-lg-4 -->
  </div><!-- /.row -->

  <div class="card-body">
    <div class="card-text">
      <a href="{{ route('users.followings', ['name' => $user->name]) }}" class="text-muted">
        {{ $user->count_followings }} フォロー
      </a>
      <a href="{{ route('users.followers', ['name' => $user->name]) }}" class="text-muted">
        {{ $user->count_followers }} フォロワー
      </a>
      @if( Auth::id() !== $user->id )
      <follow-button class="ml-auto float-right" :initial-is-followed-by='@json($user->isFollowedBy(Auth::user()))' :authorized='@json(Auth::check())' endpoint="{{ route('users.follow', ['name' => $user->name]) }}">
      </follow-button>
      @endif
    </div>

    <div class="my-3 p-3 bg-white rounded shadow-sm">
      <h6 class="border-bottom border-gray pb-2 mb-0">{{ $user->name }}の投稿</h6>

      <ul class="nav nav-tabs nav-justified mt-3">
        <li class="nav-item">
          <a class="nav-link text-muted active" href="{{ route('users.show', ['name' => $user->name]) }}">
            記事
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-muted" href="{{ route('users.likes', ['name' => $user->name]) }}">
            いいね
          </a>
        </li>
      </ul>

      @foreach($user->posts as $post)
      @if(!isset($post->id))
      <div class="d-flex justify-content-between align-items-center w-100">
        <h6 class="d-block text-gray-dark pt-3">まだ投稿がありません。</h6>
      </div>
      @endif

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
          </div>

        </div>

      </div>
      @endforeach

    </div>
  </div>
  @endsection