<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/sass/app.scss','resources/css/app.css','resources/css/signin.css', 'resources/js/app.js',])
    <title>ログインフォーム</title>
</head>
<body>
<main class="form-signin w-100 m-auto">
  <form class="form-signin" method="POST" action="{{route('login')}}">
    @csrf
    <h1 class="h3 mb-3 fw-normal">ログインフォーム</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="form-floating">
      <input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com" autofocus>
      <label for="floatingInput">Email address</label>
    </div>
    <div class="form-floating">
      <input type="password" class="form-control" id="floatingPassword" >
      <label for="floatingPassword">Password</label>
    </div>


    </div>
    <button class="btn btn-primary w-100 py-2" type="submit">ログイン</button>
  </form>
</main>

</body>
</html>