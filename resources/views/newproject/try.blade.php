<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/try.css') }}">
    <title>Document</title>
</head>

<!-- <script>
    if (location.hash) {
        const token = location.hash.match(/access_token=(.*)&scope/)[1]; // 雑にトークンを切り出す

        const method = 'GET';
        const headers = {
            Authorization: `Bearer ${token}`
        };
        fetch('https://api.twitch.tv/helix/users', {
                method,
                headers
            })
            .then(res => res.json())
            .then(res => {

                var info = JSON.stringify(res, null, '    ');

                alert(info);

            })
            .catch(console.error);
    }
</script> -->

<body>

    <h1 class="hello">hello</h1>

    <h2 class="goodnight">good night</h2>

    <a href="https://id.twitch.tv/oauth2/authorize?client_id=lr5yb95m94ov9nx6x7senr5xgy8a9m&redirect_uri=http://homestead.test/try&response_type=token&scope=user:read:email">Twitch認証</a>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="{{ asset('js/trytry.js') }}" defer></script>
</body>

</html>