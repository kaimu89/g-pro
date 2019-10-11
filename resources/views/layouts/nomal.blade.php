<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="{{ asset('css/nomal.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    @yield("stylesheet")
    <title>@yield("title")</title>
</head>

<body>
    <header>
        @include("layouts.components.header")
    </header>
    <main>
        @yield("content")
    </main>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    @yield("script")
    <!-- <script src="{{ asset('js/appmenu.js') }}" defer></script> -->
</body>

</html>