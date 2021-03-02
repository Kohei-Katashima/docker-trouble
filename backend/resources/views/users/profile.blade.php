<div class="row justify-content-center">
  <div class="col-auto">
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

    @if( Auth::id() === $user->id )
    <p><a class="btn btn-secondary float-right" href="{{ route('users.edit', Auth::user()->id)}}" role="button">編集する &raquo;</a></p>
    @endif

  </div><!-- /.col-lg-4 -->
</div><!-- /.row -->

<div class="card-body">
  <div class="card-text">
    <a href="{{ route('users.followings', ['name' => $user->name]) }}" class="text-muted">
      {{ $user->count_followings }} フォロー
    </a>
    <a href="{{ route('users.followers', ['name' => $user->name]) }}" class="text-muted">
      {{ $user->count_followers }} フォロワー
    </a>
    @if( Auth::id() !== $user->id )
    <follow-button class="ml-auto float-right" :initial-is-followed-by='@json($user->isFollowedBy(Auth::user()))' :authorized='@json(Auth::check())' endpoint="{{ route('users.follow', ['name' => $user->name]) }}">
    </follow-button>
    @endif
  </div>
</div>