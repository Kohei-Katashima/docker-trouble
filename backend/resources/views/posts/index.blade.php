@extends('layouts.carousel')

@section('content')
<main role="main" class="container">
  <!-- top -->
  @include('posts.top')
  <!-- top -->

  <!-- tag -->
  <div class="my-3 p-3 bg-white rounded shadow-sm">
    @foreach($tags as $tag)
    @if($loop->first)
    <div class="card-body pt-0 pb-2 pl-1">
      <div class="card-text line-height">
        @endif
        <a href="{{ route('tags.show', ['tag_name' => $tag->tag_name]) }}" class="badge badge-light ml-2">
          {{ $tag->hashtag }}
        </a>
        @if($loop->last)
      </div>
    </div>
    @endif
    @endforeach
  </div>
  <!-- tag -->

  @if (session('err_msg'))
  <p class="text-danger">{{ session('err_msg') }}</p>
  @endif

  @isset ($search_result)
  <p class="text-info">{{ $search_result }}</p>
  @endisset

  <!-- post -->
  <div class="my-3 p-3 bg-white rounded shadow-sm">
    <h6 class="border-bottom border-gray pb-2 mb-0">最近の投稿</h6>
    @foreach($posts as $post)
    @include('posts.post')
    @endforeach
    @if(isset($search_query))
    <small class="d-block text-right mt-3">
      {{ $posts->appends(['search' => $search_query])->links() }}
    </small>
    @else
    <small class="d-block text-right mt-3">
      {{ $posts->links() }}
    </small>
    @endif
  </div>
  <!-- post -->

  <!-- user -->
  @include('posts.users')
  <!-- user -->

</main>
@endsection