@extends("layouts.standard")

@section("stylesheet")
<link rel="stylesheet" href="{{ asset('css/game.css') }}">
@endsection

@section("title","ゲーム紹介")

@section("h2","ゲーム一覧")

@section("content")

@foreach($games as $game)
<div class="game">
    <div class="picture">
        <div class="picture2">
            <img src="{{$game->picture}}" alt="ゲーム画像" class="game-img">
        </div>
    </div>
    <div class="latter">
        <span class="game-name">{{$game->name}}</span>
        <div class="char">
            <span class="game-type">タイプ：{{$game->type}}</span>
            <span class="game-genre m">ジャンル：{{$game->genre}}</span>
            <span class="game-description b">説明文：{{$game->description}}</span>
            <span class="game-url">HP：<a href="{{$game->url}}" class="url" target="_blank" rel="noreferrer nooperner">ゲーム公式HP</a></span>
        </div>
    </div>
</div>
@endforeach
<div class="links">
    {{ $games->links() }}
</div>
@endsection