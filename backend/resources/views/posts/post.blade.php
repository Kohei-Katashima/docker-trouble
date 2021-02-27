<div class="media text-muted pt-3">
  @if(isset($post->image))
  <img src="{{ asset('storage/image/'.$post->image) }}" class="bd-placeholder-img mr-2 rounded" width="32" height="32" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 32x32">
  @elseif(!isset($post->image))
  <svg class="bd-placeholder-img mr-2 rounded" width="32" height="32" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 32x32">
    <title>Placeholder</title>
    <rect width="100%" height="100%" fill="#eee" /><text x="50%" y="50%" fill="#aaa" dy=".3em">noimage</text>
  </svg>
  @endif
  <div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
    <div class="d-flex justify-content-between align-items-center w-100">
      <a href="{{ route('posts.show',$post->id) }}" class="text-muted">
        <strong class="d-block text-gray-dark">{{ $post->updated_at}}</strong>
        <strong class="d-block text-gray-dark">{{ $post->title}}</strong>
        {!!(e(Str::limit($post['content'], 50)))!!}
      </a>
      <a href="{{route('users.show',$post->user_id)}}" class="text-muted">{{ $post->user->name }}</a>
    </div>
  </div>
</div>