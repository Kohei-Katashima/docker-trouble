@extends('layouts.carousel')

@section('content')
<main role="main" class="container">
  <!-- top -->
  @include('posts.top')
  <!-- top -->

  <!-- 詳細 -->
  <div class="my-3 p-3 bg-white rounded shadow-sm">
    <div class="d-flex justify-content-between  align-items-center w-100 border-bottom border-gray">
      <h3 class="pb-2 mb-0">{{ $post->title }}</h3>
      @auth
      @if( Auth::id() === $post->user_id )
      <!-- dropdown -->
      <div class="ml-auto card-text">
        <div class="dropdown">
          <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <button type="button" class="btn btn-link text-muted m-0 p-2">
              <i class="fas fa-ellipsis-v"></i>
            </button>
          </a>
          <div class="dropdown-menu dropdown-menu-right">
            <a class="dropdown-item" href="{{ route("posts.edit", ['post' => $post]) }}">
              <i class="fas fa-pen mr-1"></i>記事を更新する
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item text-danger" data-toggle="modal" data-target="#modal-delete-{{ $post->id }}">
              <i class="fas fa-trash-alt mr-1"></i>記事を削除する
            </a>
          </div>
        </div>
      </div>
      <!-- dropdown -->

      <!-- modal -->
      <div id="modal-delete-{{ $post->id }}" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="閉じる">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form method="POST" action="{{ route('posts.destroy', ['post' => $post]) }}">
              @csrf
              @method('DELETE')
              <div class="modal-body">
                {{ $post->title }}を削除します。よろしいですか？
              </div>
              <div class="modal-footer justify-content-between">
                <a class="btn btn-outline-grey" data-dismiss="modal">キャンセル</a>
                <button type="submit" class="btn btn-danger">削除する</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <!-- modal -->
      @endif
      @endauth
    </div>
    <div class="media text-muted pt-3">
      @if(isset($post->user->profile_image))
      <img src="{{ asset('storage/profile_image/'.$post->user->profile_image) }}" class="bd-placeholder-img mr-2 rounded-circle" width="32" height="32" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 32x32">
      @elseif(!isset($post->user->profile_image))
      <svg class="bd-placeholder-img mr-2 rounded-circle" width="32" height="32" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 32x32">
        <title>Placeholder</title>
        <rect width="100%" height="100%" fill="#777" /><text x="50%" y="50%" fill="#777" dy=".3em">32x32</text>
      </svg>
      @endif
      <div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
        <div class="d-flex justify-content-between align-items-center w-100">
          <a href="{{ route('users.show', ['name' => $post->user->name]) }}" class="text-muted">
            <strong class="text-gray-dark">{{ $post->user->name}}</strong>
          </a>
        </div>
      </div>
    </div>
    <div class="pt-3">
      @if (isset($post->image))
      <img src="{{ asset('storage/image/'.$post->image) }}" class="img-fluid" alt="Responsive image">
      @endif
    </div>
    <p class="media-body pt-3 pb-3 mb-0 lh-125 border-bottom border-gray">
      {!! nl2br(e($post['content']))!!}
    </p>
    <small class="d-block text-right mt-3">
      <strong class="d-block text-gray-dark">{{ $post->updated_at}}</strong>
    </small>
    <div class="card-body text-right pt-0 pb-2 pl-3">
      <div class="card-text">
        <post-like :initial-is-liked-by='@json($post->isLikedBy(Auth::user()))' :initial-count-likes='@json($post->count_likes)' :authorized='@json(Auth::check())' endpoint="{{ route('posts.like', ['post' => $post]) }}">
        </post-like>
      </div>
    </div>
    <!-- tag -->
    @foreach($post->tags as $tag)
    @if($loop->first)
    <div class="card-body pt-0 pb-4 pl-1 ">
      <div class="card-text line-height ">
        @endif
        <a href="{{ route('tags.show', ['tag_name' => $tag->tag_name]) }}" class="badge badge-light ml-2">
          {{ $tag->hashtag }}
        </a>
        @if($loop->last)
      </div>
    </div>
    @endif
    @endforeach
    <!-- tag -->
  </div>
  <!-- 詳細 -->

  <!-- comment -->
  @if (session('commentstatus'))
  <p class="text-danger">{{ session('commentstatus') }}</p>
  @endif
  @include('posts.comment')
  <!-- comment -->

  <small class="d-block text-right mt-3">
    <a href="{{ route('posts.index') }}">戻る</a>
  </small>

  <!-- user -->
  @include('posts.users')
  <!-- user -->

</main>

@endsection