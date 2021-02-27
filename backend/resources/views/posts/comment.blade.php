<div class="my-3 p-3 bg-white rounded shadow-sm">
  <h6 class="border-bottom border-gray pb-2 mb-0">解決コメント</h6>
  <div class="media text-muted pt-3">
    @auth
    @if(isset(Auth::user()->profile_image))
    <img src="{{ asset('storage/profile_image/'.Auth::user()->profile_image) }}" class="bd-placeholder-img mr-2 rounded-circle" width="32" height="32" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 32x32">
    @elseif(!isset(Auth::user()->profile_image))
    <svg class="bd-placeholder-img mr-2 rounded-circle" width="32" height="32" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 32x32">
      <title>Placeholder</title>
      <rect width="100%" height="100%" fill="#777" /><text x="50%" y="50%" fill="#777" dy=".3em">32x32</text>
    </svg>
    @endif
    <div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
      <div class="d-flex justify-content-between align-items-center w-100">
        <strong class="text-gray-dark">{{ Auth::user()->name }}</strong>
      </div>
    </div>
    @endauth

  </div>
  @if($errors->any())
  <div class="alert alert-danger mt-3">
    <ul>
      @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
  @endif
  @auth
  <form action="{{ route('comments.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group pt-3">
      <label for="comment">コメント</label>
      <textarea class="form-control" id="comment" rows="3" name="comment">{{ old('content') }}</textarea>
    </div>
    <input type="hidden" name="post_id" value="{{ $post->id }}">
    <input type="hidden" name="user_id" value="{{ Auth::id() }}">
    <small class="d-block text-right mt-3">
      <button type="submit" class="btn btn-primary">投稿する</button>
    </small>

  </form>
  @endauth
  <h6 class="border-bottom border-gray pb-2 mb-0">コメント一覧<span class="badge badge-light ml-2">{{count($post->comments)}}</span></h6>
  @foreach($post->comments as $comment)
  <div class="media text-muted pt-3">
    @if(isset($comment->user->profile_image))
    <img src="{{ asset('storage/profile_image/'.$comment->user->profile_image) }}" class="bd-placeholder-img mr-2 rounded-circle" width="32" height="32" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 32x32">
    @elseif(!isset($comment->user->profile_image))
    <svg class="bd-placeholder-img mr-2 rounded-circle" width="32" height="32" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 32x32">
      <title>Placeholder</title>
      <rect width="100%" height="100%" fill="#777" /><text x="50%" y="50%" fill="#777" dy=".3em">32x32</text>
    </svg>
    @endif
    <div class="media-body pb-3 mb-0 small lh-125 ">
      <div class="d-flex justify-content-between align-items-center w-100">
        <a href="{{ route('users.show',['name' => $comment->user->name]) }}" class="text-muted">
          <strong class="text-gray-dark">{{ $comment->user->name }}</strong>
        </a>
        @auth
        @if (Auth::user()->id === $comment->user_id)
        <!-- dropdown -->
        <div class="ml-auto card-text">
          <div class="dropdown">
            <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <button type="button" class="btn btn-link text-muted m-0 p-2">
                <i class="fas fa-ellipsis-v"></i>
              </button>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
              <div class="dropdown-divider"></div>
              <a class="dropdown-item text-danger" data-toggle="modal" data-target="#modal-delete-{{ $comment->id }}">
                <i class="fas fa-trash-alt mr-1"></i>コメントを削除する
              </a>
            </div>
          </div>
        </div>
        <!-- dropdown -->
        <div id="modal-delete-{{ $comment->id }}" class="modal fade" tabindex="-1" role="dialog">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="閉じる">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form method="POST" action="{{ route('comments.destroy', $comment->id) }}">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                  {{ $comment->comment }}を削除します。よろしいですか？
                </div>
                <div class="modal-footer justify-content-between">
                  <a class="btn btn-outline-grey" data-dismiss="modal">キャンセル</a>
                  <button type="submit" class="btn btn-danger">削除する</button>
                </div>
              </form>
            </div>
          </div>
        </div>

        @elseif (Auth::user()->id !== $comment->user_id)
        <!-- <a href="#">Follow</a> -->
        @endif
        @endauth
      </div>
      <div class="d-flex justify-content-between align-items-center w-100">
        <strong class="d-block text-gray-dark">{{ $comment->updated_at}}</strong>
      </div>
      <p class="media-body pt-3 pb-3 mb-0 lh-125 border-bottom border-gray">
        {!! nl2br(e($comment['comment']))!!}
      </p>
    </div>
  </div>
  @endforeach
</div>