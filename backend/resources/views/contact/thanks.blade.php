@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-10">
      <div class="card">
        <div class="card-header">
          <nav class="navbar navbar-light bg-light">
            <a class="navbar-brand" href="">入力完了</a>
          </nav>
        </div>

        <h4 class="card-body">
          @if (session('status'))
          <div class="alert alert-success" role="alert">
            {{ session('status') }}
          </div>
          @endif

          <img src="{{ asset('image/robot_heart_kokoro.png') }}" class="img-fluid" alt="Responsive image">

          <div class="alert alert-success" role="alert">
            <h4 class="alert-heading">お問い合わせありがとうございます！</h4>
            <p>ようやくここまで作れるようになったよ
            </p>
            <hr>
            <p class="mb-0">まだまだこれからだけどね</p>
          </div>
          <a href="{{ route('contact.index') }}" class="btn btn-primary">お問い合わせフォームへ</a>



      </div>
    </div>
  </div>
</div>
@endsection