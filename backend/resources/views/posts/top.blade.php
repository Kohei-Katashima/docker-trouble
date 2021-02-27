<div class="d-flex align-items-center p-3 my-3 text-white-50 bg-purple rounded shadow-sm">
  <img class="mr-3" src="{{ asset('image/nayamu_boy2.png') }}" alt="" width="48" height="48">
  <div class="lh-100">
    <h6 class="mb-0 text-white lh-100">ナヤミ掲示板</h6>
    <small>Since 2020
    </small>

  </div>
  <form class="form-inline mt-2 mt-md-0 ml-5" action="{{ route('posts.search') }}" method="GET">
    @csrf
    <input class="form-control mr-sm-2" type="search" placeholder="朝起きられない" aria-label="Search" name="search">
    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">検索</button>
  </form>
  <a href="{{ route('posts.create') }}" class="d-block btn btn-primary my-2 my-sm-0 ml-3">投稿する</a>
</div>