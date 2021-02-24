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
        {{ $user->name }}
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
      <p> {!! nl2br(e($user['introduction']))!!}</p>
      @elseif(!isset($user->introduction))
      <p>自己紹介：未登録</p>
      @endif

    </div><!-- /.col-lg-4 -->
  </div><!-- /.row -->

  <div class="card-body">
    <div class="card-text">
      <a href="" class="text-muted">
      {{ $user->count_followings }} フォロー 
      </a>
      <a href="" class="text-muted">
      {{ $user->count_followers }} フォロワー
      </a>
      @if( Auth::id() !== $user->id )
      <follow-button class="ml-auto float-right" :initial-is-followed-by='@json($user->isFollowedBy(Auth::user()))' :authorized='@json(Auth::check())' endpoint="{{ route('users.follow', ['name' => $user->name]) }}">
      </follow-button>
      @endif
    </div>
  </div>

  <div class="my-3 p-3 bg-white rounded shadow-sm">
    <h6 class="border-bottom border-gray pb-2 mb-0">{{ $user->name }} さんの投稿</h6>

    <ul class="nav nav-tabs nav-justified mt-3">
      <li class="nav-item">
        <a class="nav-link text-muted"
           href="{{ route('users.show', ['name' => $user->name]) }}">
          記事
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-muted"
           href="{{ route('users.likes', ['name' => $user->name]) }}">
          いいね
        </a>
      </li>
    </ul>

    @foreach($followers as $person)
      @include('users.person')
    @endforeach

   
  </div>

</div>
@endsection