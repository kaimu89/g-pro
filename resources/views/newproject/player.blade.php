@extends("layouts.standard")

@section("stylesheet")
<link rel="stylesheet" href="{{ asset('css/player.css') }}">
@endsection

@section("title","選手")

@section("h2","登録選手を探す")

@section("content")
<div class="search">
    <form method="get" action="{{ route('routePlayer') }}">

        <input type="text" placeholder="キーワードで探す" name="search" class="s-input">
        <input type="submit" value="検索" class="s-sub btn">
    </form>
</div>
<div class="app-form">
    <span class="app-span">条件を絞る</span>

    <div class="conditionsbox">

        <form method="get" action="{{ route('routePlayer') }}">

            <div class="app-flex">
                <div class="item-1">
                    <span class="app-name">プレイゲーム</span>
                </div>
                <div class="item-2">
                    <select name="game" class="app-game select">
                        <option value="">指定しない</option>
                        @foreach($games as $game)
                        <option value="{{ $game->id }}">{{ $game->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="app-flex">
                <div class="item-1">
                    <span class="app-name">ポジション</span>
                </div>
                <div class="item-2">
                    <select name="position" class="app-position select">
                        <option value="" class="position-0">指定しない</option>
                    </select>
                </div>
            </div>

            <div class="app-flex">
                <div class="item-1">
                    <span class="app-name">ランク</span>
                </div>
                <div class="item-2">
                    <select name="rank" class="app-rank select">
                        <option value="" class="rank-0">指定しない</option>
                    </select>
                </div>
            </div>

            <div class="app-flex">
                <div class="item-1">
                    <span class="app-name">志望チーム</span>
                </div>
                <div class="item-2">
                    <select name="proama" class="app-proama select">
                        <option value="">指定しない</option>
                        <option value="プロ">プロチーム</option>
                        <option value="一般">一般チーム</option>
                    </select>
                </div>
            </div>

            <!-- <div class="app-flex">
                <div class="item-1">
                    <span class="app-name">年齢</span>
                </div>
                <div class="item-2">
                    <select name="age" class="app-age select">
                        <option value="">指定しない</option>
                        @foreach($ages as $key => $age)
                        <option value="{{ $key }}">{{ $age }}</option>
                        @endforeach
                    </select>
                </div>
            </div> -->

            <div class="item-5">
                <input type="submit" class="btn" name="app" value="検索">
            </div>

        </form>

    </div>
</div>
<div class="flex">
    <div class="sideform">
        <form method="get" action="{{ route('routePlayer') }}">


            <label class="keyword">キーワード<input type="text" name="receive" class="select"></label>

            <span class="side-menu">プレイゲーム</span>
            <select name="game" class="game select">
                <option value="">指定しない</option>
                @foreach($games as $game)
                <option value="{{ $game->id }}">{{ $game->name }}</option>
                @endforeach
            </select>
            <span class="side-menu">ポジション</span>
            <select name="position" class="position select">
                <option value="" class="position-0">指定しない</option>
            </select>

            <span class="side-menu">ランク</span>
            <select name="rank" class="rank select">
                <option value="" class="rank-0">指定しない</option>
            </select>

            <span class="side-menu">志望チーム</span>
            <select name="proama" class="proama select">
                <option value="">指定しない</option>
                <option value="プロ">プロチーム</option>
                <option value="一般">一般チーム</option>
            </select>


            <!-- <span class="side-menu">年齢</span>
            <select name="age" class="age select">
                <option value="">指定しない</option>
                @foreach($ages as $key => $age)
                <option value="{{ $key }}">{{ $age }}</option>
                @endforeach
            </select> -->

            <input type="submit" class="btn" name="pc" value="検索">
        </form>
    </div>

    <div class="banner-box none">
        <div class="banner">
            <span class="name">チームにスカウトしますか</span>
        </div>
        <div class="input-5">
            <span class="btn cancel">キャンセル</span>
            <span class="btn" onclick="event.preventDefault(); document.getElementById('scout').submit();">スカウト</span>

            <form id="scout" action="{{ route('routePlayer') }}" method="POST" style="display: none;">
                @csrf
                <input type="hidden" name="scout" class="scout-input">
            </form>
        </div>
    </div>

    <div class="display">
        @foreach($players as $player)
        <div class="player">
            @if($player->user->picture == null)
            <img src="https://www.kozinaion.com/main_picture/nogi.jpg" alt="選手写真" class="player-img">
            @else
            <img src="/logo/{{ $player->user->picture }}" alt="選手写真" class="player-img">
            @endif
            @if(isset(Auth::user()->team_id) && Auth::user()->leader == '0')
            <span class="player-name-leader" data-id="{{ $player->id }}">{{ $player->ign }}</span>
            @else
            <span class="player-name">{{ $player->ign }}</span>
            @endif
            <span class="player-game">[{{ $player->game_id }}]</span>
            <span class="player-position">{{ $player->position->name }}</span>
            <span class="player-rank">{{ $player->rank->name }}</span>
        </div>
        @endforeach
    </div>
</div>

<div class="links">
    {{ $players->links() }}
</div>
@endsection

@section("script")
<script src="{{ asset('js/Allgame.js') }}"></script>
<script src="{{ asset('js/form.js') }}"></script>
<script src="{{ asset('js/player.js') }}"></script>
@endsection