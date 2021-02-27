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
        @include('posts.post')
      @endforeach
      @if(isset($search_query))
      <small class="d-block text-right mt-3">
        {{ $posts->appends(['search' => $search_query])->links() }}
      </small>
      @else
      @endif
    </div>

    @include('posts.users')

</main>

@endsection