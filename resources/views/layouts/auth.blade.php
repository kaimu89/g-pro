<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    @yield("stylesheet")
    <title>@yield("title")</title>
</head>

<body>
    <header>
        <div class="header">
            <h1 class="header-h1"><a class="homelink" href="{{ route('routeIndex') }}">G-pro</a></h1>
            <nav>
                <ul class="nav">
                    <li class="login"><a class="nav-link" href="{{ route('login') }}">ログイン</a></li>
                    @if (Route::has('register'))
                    <li class="register"><a class="nav-link" href="{{ route('register') }}">新規登録</a></li>
                    @endif
                </ul>
            </nav>
        </div>
    </header>
    <main>
        <div class="all">
            <div class="title-box">
                <h2 class="title">@yield("log")</h2>
            </div>
            @yield("content")
        </div>
    </main>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    @yield("script")
</body>

</html>