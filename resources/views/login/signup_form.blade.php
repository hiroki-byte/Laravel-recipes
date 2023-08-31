@extends('layouts.signin')
@section('content')
<div class="container">
    <main>
        <div class="py-5 text-center">
        <h2>アカウント登録画面</h2>
        </div>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="row g-5">
            <div class="col-md">
                <form action="/signup" method="POST"  class="needs-validation" novalidate>
                    @csrf
                    <div class="row g-3">
                        <div class="col-12">
                            <label for="username" class="form-label">ユーザ名</label>
                            <div class="input-group has-validation">
                                <input type="text" class="form-control" name="name" id="name" placeholder="Username" required>
                                <div class="invalid-feedback">
                                    Your username is required.
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <label for="email" class="form-label">Eメールアドレス </label>
                            <input type="email" class="form-control" name="email" id="email" placeholder="you@example.com" required>
                            <div class="invalid-feedback">
                                Please enter a valid email address for shipping updates.
                            </div>
                        </div>

                        <div class="col-12">
                            <label for="password" class="form-label">パスワード</label>
                            <input type="text" class="form-control" name="password1" id="password" placeholder="Password" required>
                            <div class="invalid-feedback">
                                Please enter your shipping address.
                            </div>
                        </div>

                        <div class="col-12">
                            <label for="password2" class="form-label">パスワード<span class="text-body-secondary">(確認用)</span></label>
                            <input type="text" class="form-control" name="password2" id="password2" placeholder="Password" required>
                        </div>
                    </div>
                    <hr class="my-4">
                    <button class="w-100 btn btn-primary btn-lg" type="submit">アカウント登録</button>
                </form>
            </div>
        </div>
    </main>
</div>

                @endsection