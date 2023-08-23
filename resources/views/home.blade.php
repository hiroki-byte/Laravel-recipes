<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/sass/app.scss','resources/css/app.css','resources/css/signin.css', 'resources/js/app.js',])
    <title>ホーム画面</title>
</head>
<body>
    <div class="container">
        <div class="mt-5">
            <x-alert type="success" :session="session('login_success')"/>

            <h3>プロフィール</h3>
            <ul>
                <li>名前：{{ Auth::user()->name }}</li>
                <li>メールアドレス：{{ Auth::user()->email }}</li>
            </ul>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="btn btn-danger">ログアウト</button>
            </form>
        </div>
    </div>
</body>
</html>