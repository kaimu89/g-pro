@extends("layouts.standard")

@section("stylesheet")
<link rel="stylesheet" href="{{ asset('css/myplayerShow.css') }}">
@endsection

@section("title","選手登録情報")

@section("h2","選手登録情報")

@section("content")

<div class="oubo-box">
    <a href="{{ route('routeMyPlayerNotice') }}" class="oubo">チームからの連絡</a>
</div>

<div class="add">

    <div class="flex">
        <div class="item-1">
            <span class="name">IGN</span>
        </div>
        <div class="item-2">
            <span class="select">{{ $player->ign }}</span>
        </div>
    </div>


    <div class="flex">
        <div class="item-1">
            <span class="name">志望チーム</span>
        </div>
        <div class="item-2">
            <span class="select">{{ $player->proama }}</span>
        </div>
    </div>


    <div class="flex">
        <div class="item-1">
            <span class="name">ゲームタイトル</span>
        </div>
        <div class="item-2">
            <span class="select">{{ $player->game->name }}</span>
        </div>
    </div>


    <div class="flex">
        <div class="item-1">
            <span class="name">ポジション</span>
        </div>
        <div class="item-2">
            <span class="select">{{ $player->position->name }}</span>
        </div>
    </div>


    <div class="flex">
        <div class="item-1">
            <span class="name">ランク</span>
        </div>
        <div class="item-2">
            <span class="select">{{ $player->rank->name }}</span>
        </div>
    </div>


    <div class="flex">
        <div class="item-1">
            <span class="name">紹介文</span>
        </div>
        <div class="item-2">
            <span class="select">{{ $player->description }}</span>
        </div>
    </div>

    <div class="item-5 out">
        <a href="{{ route('routeMyPlayerEdit') }}" class="btn">変更する</a>
    </div>

</div>

@endsection