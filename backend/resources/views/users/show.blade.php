@extends('layouts.carousel')

@section('content')
<div class="container marketing mt-5">

  @if (session('err_msg'))
  <p class="text-danger">{{ session('err_msg') }}</p>
  @endif

  <div class="row">
    <div class="col-lg-4">
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


      <!-- <p>Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. Nullam id dolor id nibh ultricies vehicula ut id elit. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Praesent commodo cursus magna.</p>
      <p>Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. Nullam id dolor id nibh ultricies vehicula ut id elit. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Praesent commodo cursus magna.</p> -->

    </div><!-- /.col-lg-4 -->
  </div><!-- /.row -->

  <div class="my-3 p-3 bg-white rounded shadow-sm">
    <h6 class="border-bottom border-gray pb-2 mb-0">{{ $user->name }} さんの投稿</h6>



    @foreach($user->posts as $post)
    @if(!isset($post->id))
    <div class="d-flex justify-content-between align-items-center w-100">
      <h6 class="d-block text-gray-dark pt-3">まだ投稿がありません。</h6>
    </div>
    @endif
    <div class="media text-muted pt-3">
      @if(isset($post->image))
      <img src="{{ asset('storage/image/'.$post->image) }}" class="bd-placeholder-img mr-2 rounded" width="32" height="32" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 32x32">
      @elseif(!isset($post->image))
      <svg class="bd-placeholder-img mr-2 rounded" width="32" height="32" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 32x32">
        <title>Placeholder</title>
        <rect width="100%" height="100%" fill="#007bff" /><text x="50%" y="50%" fill="#007bff" dy=".3em">32x32</text>
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