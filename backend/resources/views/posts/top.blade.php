<div class="d-flex align-items-center p-3 my-3 text-white-50 bg-purple rounded shadow-sm">
  <img class="mr-3" src="{{ asset('image/logo_transparent.png') }}" alt="" width="64" height="64">
  <div class="lh-100">
    <h6 class="mb-0 text-white lh-100">ナヤミ掲示板</h6>
    <small>Since 2020
    </small>

  </div>
  <form class="form-inline mt-2 mt-md-0 ml-2" action="{{ route('posts.search') }}" method="GET">
    @csrf
    <input class="form-control" type="search" placeholder="朝起きられない" aria-label="Search" name="search">
    <button class="btn btn-outline-success " type="submit"><i class="fas fa-search"></i></button>
  </form>
  <a href="{{ route('posts.create') }}" class="d-inline btn btn-primary my-2 my-sm-0 ml-3">投稿する</a>
</div>