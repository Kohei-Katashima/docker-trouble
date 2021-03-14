@extends('layouts.app')

@section('content')
<img src="{{ asset('image/banner_image_1.png') }}" class="bd-placeholder-img pb-5" width="100%" height="100%" alt="Responsive image">
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-10">
      <div class="card">
        <div class="card-header">
          <nav class="navbar navbar-light bg-light">
            <a class="navbar-brand" href="">お問合わせフォーム</a>
          </nav>
        </div>

        <h4 class="card-body">
          @if (session('status'))
          <div class="alert alert-success" role="alert">
            {{ session('status') }}
          </div>
          @endif

          @if ($errors->any())
          <div class="alert alert-danger">
            <ul>
              @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
          @endif

          <form action="{{ route('contact.post') }}" method="POST">
            @csrf
            <div class="form-group">
              <label for="exampleInputname">お名前</label>
              <input type="name" class="form-control" id="exampleInputname" name="name" value="{{ old('name') }}">
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">メールアドレス</label>
              <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" value="{{ old('email') }}">
              <small id="emailHelp" class="form-text text-muted">よくない使い方はしません</small>
            </div>
            <div class="form-group">
              <label for="exampleFormControlTextarea1">お問い合わせ内容</label>
              <textarea class="form-control" id="exampleFormControlTextarea1" rows="8" name="contact" value="{{ old('contact') }}"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">確認
            </button>
          </form>




      </div>
    </div>
  </div>
</div>
@endsection