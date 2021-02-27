<div class="my-3 p-3 bg-white rounded shadow-sm">
    <h6 class="border-bottom border-gray pb-2 mb-0">おすすめユーザー</h6>
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
          <a href="{{ route('users.show', ['name' => $user->name]) }}" class="text-muted">
            <strong class="text-gray-dark">
              {{ $user->name }}
            </strong>
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

    <small class="d-block text-right mt-3">
      <a href="{{route('users.index')}}">ユーザー一覧へ</a>
    </small>
  </div>