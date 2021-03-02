@extends('layouts.carousel')

@section('content')


<div id="myCarousel" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
    <li data-target="#myCarousel" data-slide-to="1"></li>
    <li data-target="#myCarousel" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="{{ asset('image/coffee-1276784_1920.jpg') }}" class="bd-placeholder-img" width="100%" height="100%" alt="Responsive image">

      <div class="container">
        <div class="carousel-caption text-left">
          <h1>悩みをなかなか話せない。。。</h1>
          <p>わからないけど聞けない。誰かに聞いて欲しい。そんな気持ちを開放する場所</p>
          <p><a class="btn btn-lg btn-primary" href="{{ route('posts.index') }}" role="button">今すぐ投稿しよう</a></p>
        </div>
      </div>
    </div>
    <div class="carousel-item">
      <img src="{{ asset('image/tie-690084_1920.jpg') }}" class="bd-placeholder-img" width="100%" height="100%" alt="Responsive image">
      <div class="container">
        <div class="carousel-caption">
          <h1>思考の近い友達を探そう！</h1>
          <p>同じような悩み、みんな抱えてるのかも？
          </p>
          <p><a class="btn btn-lg btn-primary" href="{{ route('users.index') }}" role="button">ユーザー一覧</a></p>
        </div>
      </div>
    </div>
    <div class="carousel-item">
      <img src="{{ asset('image/choctaw-bluff-305932_1920.jpg') }}" class="bd-placeholder-img" width="100%" height="100%" alt="Responsive image">
      <div class="container">
        <div class="carousel-caption text-right">
          <h1>ナミヤ相談室？</h1>
          <p>かつて雑貨屋の浪矢さんが手紙でやりとりしていたあの相談所がSNSに！？</p>
          <p><a class="btn btn-lg btn-primary" href="https://promo.kadokawa.co.jp/namiya/" role="button">ナミヤ雑貨店の奇蹟</a></p>
        </div>
      </div>
    </div>
  </div>
  <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>

<div class="container marketing">
  <div class="row">
    @foreach($users as $user)
    <div class="col-lg-4">
      @if(isset($user->profile_image))
      <img src="{{ asset('storage/profile_image/'.$user->profile_image) }}" class="bd-placeholder-img rounded-circle" width="140" height="140" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 140x140">
      @elseif(!isset($user->profile_image))
      <svg class="bd-placeholder-img rounded-circle" width="140" height="140" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 140x140">
        <title>Placeholder</title>
        <rect width="100%" height="100%" fill="#777" /><text x="50%" y="50%" fill="#777" dy=".3em">140x140</text>
      </svg>
      @endif
      <h2>{{ $user->name }}</h2>

      <p><a class="btn btn-secondary" href="{{route('users.show', ['name' => $user->name])}}" role="button">プロフィールへ &raquo;</a></p>
    </div>
    @endforeach
    <div class="container">
      <p class="float-right d-block text-right mt-3">
        <a href="{{route('users.index')}}">ユーザー一覧へ</a>
      </p>
    </div>

  </div>
  @foreach($posts as $post)
  <hr class="featurette-divider">

  <a href="{{ route('posts.show',$post->id) }}" class="text-muted">
    <div class="row featurette">
      <div class="col-md-7">
        <h2 class="featurette-heading"><span class="text-muted">{{ $post->title }}</span></h2>
        <p class="lead">{!!(e(Str::limit($post['content'], 200)))!!}</p>
        <small class="text-muted">{{ $post['updated_at']->format('Y/m/d')}}</small>
      </div>
      <div class="col-md-5">
        @if(isset($post->image))
        <img src="{{ asset('storage/image/'.$post->image) }}" class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500" height="500" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 500x500">
        <title>Placeholder</title>
        <rect width="100%" height="100%" fill="#eee" /><text x="50%" y="50%" fill="#aaa" dy=".3em"></text></svg>
        @elseif(!isset($post->image))
        <svg class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500" height="500" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 500x500">
          <title>Placeholder</title>
          <rect width="100%" height="100%" fill="#eee" /><text x="50%" y="50%" fill="#aaa" dy=".3em">noimage</text>
        </svg>
        @endif
      </div>
    </div>
  </a>
  @endforeach
  <div class="container">
    <p class="float-right d-block text-right mt-3">
      <a href="{{route('posts.index')}}">投稿一覧へ</a>
    </p>
  </div>
  <hr class="featurette-divider">

</div>


@endsection