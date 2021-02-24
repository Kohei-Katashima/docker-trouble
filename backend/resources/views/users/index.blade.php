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
    <form class="form-inline mt-2 mt-md-0 ml-5" action="{{ route('users.search') }}" method="GET">
      @csrf
      <input class="form-control mr-sm-2" type="search" placeholder="田中太郎" aria-label="Search" name="search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">検索</button>
    </form>
  </div>

  @if (session('err_msg'))
  <p class="text-danger">{{ session('err_msg') }}</p>
  @endif

  @isset ($search_result)
  <p class="text-info">{{ $search_result }}</p>
  @endisset

  <div class="my-3 p-3 bg-white rounded shadow-sm">
    <h6 class="border-bottom border-gray pb-2 mb-0">ユーザー一覧</h6>

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
          <a href="{{ route('users.show',$user->id) }}" class="text-muted">
            <strong class="text-gray-dark">{{ $user->name }}</strong>
          </a>
          @if( Auth::id() !== $user->id )
          <follow-button class="ml-auto float-right" :initial-is-followed-by='@json($user->isFollowedBy(Auth::user()))' :authorized='@json(Auth::check())' endpoint="{{ route('users.follow', ['name' => $user->name]) }}">
          </follow-button>
          @endif
        </div>
        <span class="d-block">@username</span>
      </div>
    </div>
    @endforeach
  </div>

  @if(isset($search_query))
  <small class="d-block text-right mt-3">
    {{ $users->appends(['search' => $search_query])->links() }}
  </small>
  @else
  <small class="d-block text-right mt-3">
    {{ $users->links() }}
  </small>
  @endif
  </div>

</main>

@endsection