<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        @vite(['resources/sass/app.scss','resources/css/app.css','resources/css/signin.css','resources/js/app.js',])
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
                    <a class="navbar-brand" href="/">レシピカロリー計算サイト</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                       
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