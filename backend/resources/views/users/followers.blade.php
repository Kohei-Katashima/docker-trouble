@extends('layouts.carousel')

@section('content')
<div class="container marketing mt-5">

  @if (session('err_msg'))
  <p class="text-danger">{{ session('err_msg') }}</p>
  @endif

  @include('users.profile')

  <div class="my-3 p-3 bg-white rounded shadow-sm">
    <h6 class="border-bottom border-gray pb-2 mb-0">{{ $user->name }} さんの投稿</h6>

    <ul class="nav nav-tabs nav-justified mt-3">
      <li class="nav-item">
        <a class="nav-link text-muted" href="{{ route('users.show', ['name' => $user->name]) }}">
          記事
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-muted" href="{{ route('users.likes', ['name' => $user->name]) }}">
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