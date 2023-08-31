<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        @vite(['resources/sass/app.scss','resources/css/app.css','resources/css/signin.css','resources/js/app.js','resources/js/addform.js','resources/js/fetch.js','resources/js/movepulldown.js','resources/js/addsteps.js',])
        <title>レシピ</title>
        <style>
            body {
                padding-top: 70px;
            }
        </style>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body class="antialised">
        <header>
            <nav class="navbar navbar-expand-md navbar-light fixed-top bg-light">
                <div class="container-fluid">
                    <div mr-2>
                        <a class="navbar-brand text-success fs-4 fw-bolder" href="/">ツクヤセ</a>
                    </div>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <form action="/search" class="d-flex mt-2">
                            @csrf
                            <input class="form-control me-2" type="search" placeholder="レシピ名を検索" aria-label="Search" name="searchRname">
                            <button class="btn btn-outline-success" type="submit">検索</button>
                        </form>
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                        </ul>
                        <form action="/mypage">
                            @csrf
                            <a class="nav-link active" aria-current="page" href="/mypage">{{ Auth::user()->name }} さん　 </a>
                        </form>
                        <div class="mr-2">
                            <form action="/recipes/create">
                                @csrf
                                <button class="btn btn-success mr-2">レシピ投稿</button>
                            </form>
                        </div>
                        <div class="ml-2">
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button class="btn btn-danger">ログアウト</button>
                            </form>
                        </div>
                    </div>
                </div>
            </nav>
        </header>
        <main>
            <div id="app"></div>
            @yield('content')
        </main>   
    </body>
</html>