@extends("layouts.standard")

@section("stylesheet")
<link rel="stylesheet" href="{{ asset('css/explain.css') }}">
@endsection

@section("title","team")

@section("h2")
{{$team->name}}
@endsection

@section("content")
<div class="flex">
    <div class="imgbox">
        <img src="{{$team->picture}}" class="img">
    </div>
    <div class="textbox">
        @if($team->proama == '0')
        <span class="level tx">チーム：プロチーム</span>
        @elseif($team->proama == '1')
        <span class="level tx">チーム：一般チーム</span>
        @endif
        <span class="url tx">チームHP：{{ $team->url }}</span>
        @if(isset($team->top))
        <span class="top tx">代表名：{{ $team->top }}</span>
        @endif
        <span class="description tx">紹介文：{{ $team->description }}</span>
    </div>
    <div class="item-5">
        <a href="{{ url()->previous() }}" class="btn">戻る</a>
    </div>
</div>
@endsection