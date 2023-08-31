@extends('layouts.signin')
@section('content')
<div class="container mr-auto mt-3 d-flex justify-content-end">
<form>
      <button class="btn btn-outline-primary w-100 py-2">
        <a href="/signupform">新規アカウント作成</a>
      </button>
</form>
</div>
<section class="form-signin w-100 m-auto">
  <form action="/login" class="form-signin" method="POST">
    @csrf
    <h1 class="h3 mb-3 fw-normal">ログイン</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <x-alert type="success" :session="session('login_success')"/>
    <x-alert type="success" :session="session('signup')"/>
    <x-alert type="danger" :session="session('login_error')"/>
    <x-alert type="danger" :session="session('logout')"/>

    <div class="form-floating">
      <input type="email" name="email" class="form-control" id="floatingInput">
      <label for="floatingInput">Eメールアドレス</label>
    </div>
    <div class="form-floating mb-5">
      <input type="password" name="password" class="form-control" id="floatingPassword" >
      <label for="floatingPassword">パスワード</label>
    </div>


    </div>
    <div class="col">
      <button class="btn btn-primary w-100 py-2" type="submit">ログイン</button>
    </div>
  </form>
  <div class="">
      <form method ="POST" action="{{ route('guestLogin') }}" class="form-signin">
        @csrf
        <button class="btn btn-primary w-100 py-2">ゲストとしてログイン</button>
      </form>
    </div>
</section>
@endsection