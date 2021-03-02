@extends('layouts.carousel')

@section('content')

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
    <h3 class="">{{ Auth::user()->name }}</h3>
  </div>
  <div class="media text-muted pt-3">
    <div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
      <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="form-group">
          <label for="exampleFormControlFile1">プロフィール画像</label>
          <input type="file" class="form-control-file" id="exampleFormControlFile1" name="profile_image" value="{{ asset('storage/profile_image/'.Auth::user()->profile_image) }}">
        </div>
        <div class="form-group">
          <label for="name">ニックネーム</label>
          <textarea class="form-control" id="name" rows="1" name="name">{{ $user->name }}</textarea>
        </div>
        <div class="form-group">
          <label for="gender">性別</label><br>
          <input type="radio" id="gender" name="gender" value="男性">男性
          <input type="radio" id="gender" name="gender" value="女性">女性
        </div>
        <div class="form-group">
          <label for="age">年齢</label>
          <select id="age" name="age">
            <option value="">選択してください</option>
            <option value="10代">10代</option>
            <option value="20代">20代</option>
            <option value="30代">30代</option>
            <option value="40代">40代</option>
            <option value="50代">50代</option>
            <option value="60代">60代</option>
          </select>
        </div>
        <div class="form-group">
          <label for="introduction">自己紹介</label>
          <textarea class="form-control" id="introduction" rows="10" name="introduction">{{ $user->introduction }}</textarea>
        </div>
        <input type="hidden" name="id" value="{{ Auth::id() }}">
        <button type="submit" class="btn btn-primary">更新する</button>
      </form>
      <span class="d-block">@username</span>
    </div>
  </div>

  <small class="d-block text-right mt-3">
    <a href="{{ route('users.show',$user->id) }}">戻る</a>
  </small>
</div>
</main>

@endsection