<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        @vite(['resources/sass/app.scss', 'resources/js/app.js','resources/js/addform.js','resources/js/fetch.js','resources/js/movepulldown.js','resources/js/addsteps.js',])
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
            <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">レシピカロリー計算サイト</a>
                </div>
            </nav>
        </header>
        <main>
            <div id="app"></div>
            @yield('content')
        </main>   
    </body>
</html>