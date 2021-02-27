@extends('layouts.carousel')

@section('content')
<main role="main" class="container">
  <!-- top -->
  @include('posts.top')
  <!-- top -->

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
      <h6 class="border-bottom border-gray pb-2 mb-0">{{ $tag->hashtag }}の投稿</h6>

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