<div class="card mt-3">
  <div class="card-body">
    <div class="d-flex flex-row">
      @if(isset($person->profile_image))
      <a href="{{ route('users.show', ['name' => $person->name]) }}" class="text-dark">
        <img src="{{ asset('storage/profile_image/'.$person->profile_image) }}" class="bd-placeholder-img mr-2 rounded-circle" width="32" height="32" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 32x32">
        @elseif(!isset($person->profile_image))
        <svg class="bd-placeholder-img mr-2 rounded-circle" width="32" height="32" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 32x32">
          <title>Placeholder</title>
          <rect width="100%" height="100%" fill="#777" /><text x="50%" y="50%" fill="#777" dy=".3em">32x32</text>
        </svg>
        @endif
      </a>
      @if( Auth::id() !== $person->id )
      <follow-button class="ml-auto" :initial-is-followed-by='@json($person->isFollowedBy(Auth::user()))' :authorized='@json(Auth::check())' endpoint="{{ route('users.follow', ['name' => $person->name]) }}">
      </follow-button>
      @endif
    </div>
    <h2 class="h5 card-title m-0">
      <a href="{{ route('users.show', ['name' => $person->name]) }}" class="text-dark">{{ $person->name }}</a>
    </h2>
  </div>
</div>