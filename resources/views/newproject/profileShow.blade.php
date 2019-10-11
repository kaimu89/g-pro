@extends("layouts.standard")

@section("stylesheet")
<link rel="stylesheet" href="{{ asset('css/profileShow.css') }}">
@endsection

@section("title","プロフィール")

@section("h2","プロフィール")

@section("content")
<div class="add">
    <div class="photo">
        @isset($user->picture)
        <div class="picture">
            <img src="/logo/{{ $user->picture }}" alt="" class="user-p p">
        </div>
        @else
        <div class="picture-profile">
            <img src="/logo/0Qp7HbEmWbCY2yZ7xVSgsqpCZp20s5Spi03YNDtt.jpeg" alt="" class="nanashi-p p">
        </div>
        @endisset
        <div class="input">
            <form action="{{ route('routeProfile') }}" method="post">
                <input type="file" name="logo" class="file" accept='image/*'>
                <div class="item-5">
                    <input type="submit" value="変更する" class="btn">
                </div>
            </form>
        </div>
    </div>


    <div class="in-btn">
        <div class="flex2">
            <div class="item-1">
                <span class="name">メールアドレス</span>
            </div>
            <div class="item-2">
                <span class="select">{{ $user->email }}</span>
            </div>
        </div>
        <div class="item-5">
            <a href="{{ route('routeProfileEmail') }}" class="btn">変更する</a>
        </div>
    </div>

    <div class="password">
        <div class="item-1">
            <span class="select">パスワード</span>
        </div>
        <div class="item-5">
            <a href="{{ route('routeProfilePassword') }}" class="btn">変更する</a>
        </div>
    </div>


    <div class="flex">
        <div class="item-1">
            <span class="name">ユーザー名</span>
        </div>
        <div class="item-2">
            <span class="select">{{ $user->user_name }}</span>
        </div>
    </div>

    @if((empty($user->first_name)) || (empty($user->last_name)))
    <div class="full-name">
        <div class="item-1">
            <span class="name">姓</span>
            <span class="select">なし</span>
        </div>
        <div class="item-2">
            <span class="name">名</span>
            <span class="select">なし</span>
        </div>
    </div>
    @else
    <div class="full-name">
        <div class="item-1">
            <span class="name">姓</span>
            <span class="select">{{ $user->first_name }}</span>
        </div>
        <div class="item-2">
            <span class="name">名</span>
            <span class="select">{{ $user->last_name }}</span>
        </div>
    </div>
    @endif

    <div class="flex s">
        <div class="item-1">
            <span class="name">氏名</span>
        </div>
        <div class="item-2">
            @if(isset($user->first_name) && isset($user->last_name))
            <span class="select">{{ $user->first_name }}{{ $user->last_name }}</span>
            @else
            <span class="select">設定されていません</span>
            @endisset
        </div>
    </div>

    <div class="flex">
        <div class="item-1">
            <span class="name">性別</span>

        </div>
        <div class="item-2">
            @isset($user->gender)
            <span class="select">{{ $user->gender }}</span>
            @else
            <span class="select">設定されていません</span>
            @endisset
        </div>
    </div>


    <div class="flex">
        <div class="item-1">
            <span class="name">Twitter</span>

        </div>
        <div class="twitter">
            @isset($user->twitter)
            <span class="at">＠</span><span class="twi">{{ $user->twitter }}</span>
            @else
            <span class="select">設定されてません</span>
            @endisset
        </div>
    </div>


    <div class="flex">
        <div class="item-1">
            <span class="name">誕生日</span>

        </div>
        <div class="item-2">
            @isset($user->birthday)
            <span class="select">{{ $user->birthday }}</span>
            @else
            <span class="select">設定されてません</span>
            @endisset
        </div>
    </div>

    <div class="item-5 out">
        <a href="{{ route('routeProfileEdit') }}" class="btn">変更する</a>
    </div>

</div>

@endsection