@extends("layouts.standard")

@section("stylesheet")
<link rel="stylesheet" href="{{ asset('css/findteam.css') }}">
@endsection

@section("title","チームを探す")

@section("h2","チームを探す")

@section("content")

<div class="app-form">
    <span class="app-span">条件を絞る</span>

    <div class="conditionsbox">

        <form method="get" action="{{ route('routeFindTeam') }}">
            @csrf

            <div class="app-flex">
                <div class="item-1">
                    <span class="app-name">チーム</span>
                </div>
                <div class="item-2">
                    <label class="adj">プロ<input type="checkbox" name="proamaA[]" value="プロ" class="check1 app-pro"></label>
                    <label>一般<input type="checkbox" name="proamaA[]" value="一般" class="check2 app-ama"></label>
                </div>
            </div>

            <div class="app-flex">
                <div class="item-1">
                    <span class="app-name">チーム名</span>
                </div>
                <div class="item-2">
                    <select name="team" class="app-team select">
                        <option value="" class="team-0">指定しない</option>
                    </select>
                </div>
            </div>

            <div class="app-flex">
                <div class="item-1">
                    <span class="app-name">募集</span>
                </div>
                <div class="item-2">
                    <label class="adj">選手<input type="checkbox" name="job[]" value="選手" class="check1"></label>
                    <label>スタッフ<input type="checkbox" name="job[]" value="スタッフ" class="check2"></label>
                </div>
            </div>

            <div class="app-flex">
                <div class="item-1">
                    <span class="app-name">プレイゲーム</span>
                </div>
                <div class="item-2">
                    <select name="game" class="app-game select">
                        <option value="">指定しない</option>
                        @foreach($games as $game)
                        <option value="{{ $game->id}}">{{ $game->name }}</option>
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
                    <span class="app-name">年齢</span>
                </div>
                <div class="item-2">
                    <select name="age" class="app-age select">
                        @foreach($ages as $key => $age)
                        <option value="{{ $key }}">{{ $age }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="app-flex">
                <div class="item-1">
                    <span class="app-name">ゲーミングハウス</span>
                </div>
                <div class="item-2">
                    <select name="house" class="app-house select">
                        <option value="">指定しない</option>
                        <option value="0" class="app-house-op">あり</option>
                        <option value="1" class="app-house-op">なし</option>
                    </select>
                </div>
            </div>

            <div class="item-5">
                <input type="submit" class="btn" name="app" value="検索">
            </div>

        </form>

    </div>
</div>



<div class="search">
    <form method="get" action="{{ route('routeFindTeam') }}">

        <div class="flex">
            <div class="selectTeam">
                <span class="sub">チーム</span>
                <label class="adj">プロ<input type="checkbox" name="proamaP[]" value="プロ" class="check1 pc-pro"></label>
                <label>一般<input type="checkbox" name="proamaP[]" value="一般" class="check2 pc-ama"></label>

                <span class="sub">チームを選択</span>
                <select name="team" class="team select">
                    <option value="" class="team-0">指定しない</option>
                </select>

                <span class="sub">募集職種</span>
                <label class="adj">選手<input type="checkbox" name="job[]" value="選手" class="check1"></label>
                <label>スタッフ<input type="checkbox" name="job[]" value="スタッフ" class="check2"></label>
            </div>

            <div class="gamebox">
                <span class="sub">プレイゲーム</span>
                <select name="game" class="game select">
                    <option value="">指定しない</option>
                    @foreach($games as $game)
                    <option value="{{ $game->id}}">{{ $game->name }}</option>
                    @endforeach
                </select>

                <span class="sub">ポジション</span>
                <select name="position" class="position select">
                    <option value="" class="position-0">指定しない</option>
                </select>

                <span class="sub">ランク</span>
                <select name="rank" class="rank select">
                    <option value="" class="rank-0">指定しない</option>
                </select>
            </div>

            <div class="other">
                <span class="sub">年齢</span>
                <select name="age" class=" age select">
                    @foreach($ages as $key => $age)
                    <option value="{{ $key }}">{{ $age }}</option>
                    @endforeach
                </select>

                <span class="sub">ゲーミングハウス</span>
                <select name="house" class="house select">
                    <option value="">指定しない</option>
                    <option value="0" class="house-op">あり</option>
                    <option value="1" class="house-op">なし</option>
                </select>
            </div>
        </div>
        <div class="submit">
            <input type="submit" class="btn" name="pc" value="検索">
        </div>
    </form>
</div>



<div class="banner-box confirm none">
    <div class="banner">
        <span class="name">応募を送信しますか？</span>
    </div>
    <div class="input-5">
        <span class="btn cancel">キャンセル</span>
        <span class="btn ok" onclick="event.preventDefault(); document.getElementById('oubo-submit').submit();">応募する</span>

        <form id="oubo-submit" action="{{ route('routeFindTeam') }}" method="POST" style="display: none;">
            @csrf
            <input type="hidden" name="oubo" class="oubo-input">
        </form>
    </div>
</div>


<div class="display">
    @foreach($recruits as $recruit)
    <div class="recruit">
        <div class="main-name">
            <span class="rec-name">チーム名：{{ $recruit->team->name }}</span>
            @if($recruit->team->proama == 0)
            <span class="rec-proama">チーム：プロチーム</span>
            @elseif($recruit->team->proama == 1)
            <span class="rec-proama">チーム：一般チーム</span>
            @endif
        </div>
        <div class="GJ">
            <span class="rec-game">ゲームタイトル：{{ $recruit->game->name }}</span>
            @isset($recruit->staff_id)
            <span class="rec-job">募集職種：スタッフ({{ $recruit->staff->name }})</span>
            @else
            <span class="rec-job">募集職種：選手</span>
            @endisset
        </div>
        <div class="PR">
            @isset($recruit->staff_id)
            <span class="rec-cont">仕事内容：{{ $recruit->content }}</span>
            @else
            <span class="rec-posi">ポジション：{{ $recruit->position->name }}</span>
            <span class="rec-rank">ランク：{{ $recruit->rank->name }}</span>
            @endisset
        </div>
        <div class="letter">
            @isset($recruit->staff_id)
            <span class="rec-ab">必須スキル：{{ $recruit->ab_skill }}</span>
            <span class="rec-wel">歓迎スキル：{{ $recruit->wel_skill }}</span>
            @else
            <span class="rec-age">年齢：{{ $recruit->age }}</span>
            <span class="rec-house">ｹﾞｰﾐﾝｸﾞﾊｳｽ：{{ $recruit->house }}</span>
            <span class="rec-leader">リーダー名：{{ $recruit->team->top }}</span>
            @endisset
        </div>
        <span class="rec-des">説明文：{{ $recruit->description }}</span>

        <div class="item-5">
            <span class="btn oubo" data-id="{{ $recruit->id }}">応募する</span>
        </div>
    </div>
    @endforeach
</div>

<div class="links">
    {{ $recruits->links() }}
</div>
@endsection

@section("script")
<script src="{{ asset('js/Allgame.js') }}"></script>
<script src="{{ asset('js/findteam.js') }}"></script>
<script src="{{ asset('js/form.js') }}"></script>
@endsection