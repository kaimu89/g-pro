@extends("layouts.standard")

@section("stylesheet")
<link rel="stylesheet" href="{{ asset('css/notice.css') }}">
@endsection

@section("title",'チーム応募者リスト')

@section("h2","チーム応募者リスト")

@section("content")

<div class="add">

    <div class="oubo">

        <div class="banner-box reject none">
            <div class="banner">
                <span class="name">お祈り連絡を送ります</span>
            </div>
            <div class="input-5">
                <span class="btn reject-close-btn">閉じる</span>
                <span class="btn reject-btn" onclick="event.preventDefault(); document.getElementById('reject-form').submit();">送る</span>

                <form id="reject-form" action="{{ route('routeMyTeamNotice') }}" method="POST" style="display: none;">
                    @csrf
                    <input type="hidden" name="reject" class="reject-input">
                </form>
            </div>
        </div>

        @foreach($notices as $notice)

        @if($notice->recruit->staff_id)
        <div class="flex2">
            <div class="item-1">
                <span class="name">タイトル名：{{ $notice->recruit->game->name }}</span>
                <span class="name">募集：{{ $notice->recruit->staff->name }}</span>
            </div>
            <div class="item-2">
                <span class="name">ユーザー名：{{ $notice->user->user_name }}</span>
                @if(isset($notice->user->age))
                <span class="name">年齢：</span>
                @endif
                @if(isset($notice->user->gender))
                <span class="name">性別：{{ $notice->user->gender }}</span>
                @endif

            </div>
            <div class="item-3">
                <span class="name">紹介文：</span>
            </div>
            <div class="item-5">
                <span class="btn no-btn">お断り</span>
                <span class="btn ok-btn" data-id="{{ $notice->id }}">連絡する</span>
            </div>

        </div>
        @else
        <div class="flex2">
            <div class="item-1">
                <span class="name">タイトル名：{{ $notice->recruit->game->name }}</span>
                <span class="name">募集：選手</span>
            </div>
            <div class="item-2">
                <span class="name">IGN：{{ $notice->player->ign }}</span>
                @if(isset($notice->user->age))
                <span class="name">年齢：</span>
                @endif
                @if(isset($notice->user->gender))
                <span class="name">性別：{{ $notice->user->gender }}</span>
                @endif
            </div>
            <div class="item-3">
                <span class="name">ポジション：{{ $notice->player->position->name }}</span>
                <span class="name">ランク：{{ $notice->player->rank->name }}</span>
            </div>
            <div class="item-4">
                <span class="name">紹介文：{{ $notice->player->description }}</span>
            </div>
            <div class="item-5">

                <span class="btn no-btn">お断り</span>
                <span class="btn ok-btn" data-id="{{ $notice->id }}">連絡する</span>
            </div>

        </div>
        @endif

        <div class="banner-box judge judge-{{ $notice->id }} none">
            <div class="banner">
                @if(isset($notice->user->twitter))
                <a class="twitter" href="https://twitter.com/{{ $notice->user->twitter }}">Twitterで連絡する</a>
                @elseif(isset($notice->player->user->twitter))
                <a class="twitter" href="https://twitter.com/{{ $notice->player->user->twitter }}">Twitterで連絡する</a>
                @endif
                @if(isset($notice->user->email))
                <span class="mail">メール：{{ $notice->user->email }}</span>
                @elseif(isset($notice->player->user->email))
                <span class="mail">メール：{{ $notice->player->user->email }}</span>
                @endif
            </div>
            <div class="input-5">
                <span class="btn oubo-close-btn">閉じる</span>
            </div>
        </div>
        @endforeach
    </div>
</div>

@endsection

@section("script")
<script src="{{ asset('js/myTeamNotice.js') }}"></script>
@endsection