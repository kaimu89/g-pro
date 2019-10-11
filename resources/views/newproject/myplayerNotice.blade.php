@extends("layouts.standard")

@section("stylesheet")
<link rel="stylesheet" href="{{ asset('css/notice.css') }}">
@endsection

@section("title",'スカウトリスト')

@section("h2","スカウトリスト")

@section("content")



<div class="add">

    <div class="oubo">

        <div class="banner-box reject none">
            <div class="banner">
                <span class="name">お断り連絡を送ります</span>
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

        <div class="flex2">
            <div class="item-1">
                <span class="name">チーム名：{{ $notice->team->name }}</span>
                <span class="name">チーム：{{ $notice->team->proama }}</span>
            </div>
            <div class="item-2">
            </div>
            <div class="item-3">
            </div>
            <div class="item-4">
                <span class="name">紹介文：{{ $notice->team->description }}</span>
            </div>
            <div class="item-5">
                <span class="btn no-btn">お断り</span>
                <span class="btn ok-btn" data-id="{{ $notice->id }}">連絡する</span>
            </div>
        </div>

        <div class=" banner-box scout scout-{{ $notice->id }} none">
            <div class="banner">
                <a href="https://twitter.com/{{ $notice->team->twitter }}" class="twitter">Twitterで連絡する</a>
                <span class="mail">メール：{{ $notice->team->mail }}</span>
            </div>
            <div class="input-5">
                <span class="btn scout-close-btn">閉じる</span>
            </div>
        </div>

        @endforeach
    </div>

</div>

@endsection

@section("script")
<script src="{{ asset('js/myPlayerNotice.js') }}"></script>
@endsection