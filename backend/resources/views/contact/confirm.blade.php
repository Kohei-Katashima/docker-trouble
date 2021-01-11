@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-10">
      <div class="card">
        <div class="card-header">
          <nav class="navbar navbar-light bg-light">
            <a class="navbar-brand" href="">確認画面</a>
          </nav>
        </div>

        @isset($search_result)
        <div class="m-3">
          <h4 class="card-title">{{ $search_result }}</h4>
        </div>
        @endisset

        <h4 class="card-body">
          @if (session('status'))
          <div class="alert alert-success" role="alert">
            {{ session('status') }}
          </div>
          @endif

          <form action="{{ route('contact.send') }}" method="POST">
            @csrf
            <div class="form-group">
              <div class="form-group">
                <label for="exampleInputname">お名前</label>
                <p> {{ $input['name']}} </p>
                <!-- <input type="name" class="form-control" id="exampleInputname"> -->
              </div>
              <label for="exampleInputEmail1">メールアドレス</label>
              <p>{{ $input['email']}}</p>
              <!-- <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"> -->
            </div>
            <div class="form-group">
              <label for="exampleFormControlTextarea1">お問い合わせ内容</label>
              <p>{!! nl2br(e($input['contact']))!!}</p>
              <!-- <textarea class="form-control" id="exampleFormControlTextarea1" rows="8"></textarea> -->
            </div>
            <button type="submit" class="btn btn-primary">送信する
            </button>
            <button type="submit" class="btn btn-danger" name="back">もどる
            </button>
          </form>




      </div>
    </div>
  </div>
</div>
@endsection