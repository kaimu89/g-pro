@extends("layouts.standard")

@section("stylesheet")
<link rel="stylesheet" href="{{ asset('css/recruit.css') }}">
@endsection

@section("title","募集登録")

@section("h2","メンバー募集登録")

@section("content")

<div class="add">
    <h3 class="title">一般チーム</h3>
    <form action="{{ route('routeRecruitTeamAma')}}" method="post">
        @csrf

        <div class="flex">
            <div class="item-1">
                <span class="name">チーム名：</span>
            </div>
            <div class="item-2">
                @isset($user->team->name)
                <span class="text">{{ $user->team->name }}</span>
                @endisset
            </div>
        </div>


        <div class="flex">
            <div class="item-1">
                <span class="name">ゲームタイトル：</span>
            </div>
            <div class="item-2">
                @isset($teamgame)
                <span class="text">{{ $teamgame->name }}</span>
                @endisset
            </div>
        </div>


        @if($errors->has("position"))
        <div class="error-pc">
            <small class="small">※{{$errors->first("position")}}</small>
        </div>
        @endif
        <div class="flex">
            <div class="item-1">
                <span class="name">ポジション：</span>
                @if($errors->has("position"))
                <div class="error-mob">
                    <small class="small">※{{$errors->first("position")}}</small>
                </div>
                @endif
            </div>
            <div class="item-2">
                <select name="position" class="select">
                    <option class="position-0" value="">未選択</option>
                    @foreach($teampositions as $teamposition)
                    <option value="{{ $teamposition->id }}" {{ old('position') == $teamposition->id ? 'selected' : '' }}>{{ $teamposition->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>



        @if($errors->has("rank"))
        <div class="error-pc">
            <small class="small">※{{$errors->first("rank")}}</small>
        </div>
        @endif
        <div class="flex">
            <div class="item-1">
                <span class="name">ランク：</span>
                @if($errors->has("rank"))
                <div class="error-mob">
                    <small class="small">※{{$errors->first("rank")}}</small>
                </div>
                @endif
            </div>
            <div class="item-2">
                <select name="rank" class="select">
                    <option class="rank-0" value="">未選択</option>
                    @foreach($teamranks as $teamrank)
                    <option value="{{ $teamrank->id }}" {{ old('rank') == $teamrank->id ? 'selected' : '' }}>{{ $teamrank->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>



        @if($errors->has("description"))
        <div class="error-pc">
            <small class="small">※{{$errors->first("description")}}</small>
        </div>
        @endif
        <div class="flex">
            <div class="item-1">
                <span class="name">備考・募集文：</span>
                @if($errors->has("description"))
                <div class="error-mob">
                    <small class="small">※{{$errors->first("description")}}</small>
                </div>
                @endif
            </div>
            <div class="item-2">
                <textarea name="description" cols="35" rows="10" class="body">{{old('body')}}</textarea>
            </div>
        </div>


        <div class="item-5">
            <input type="submit" value="登録" class="btn">
        </div>


    </form>
</div>

@endsection

@section("script")
<script src="{{ asset('js/ALLgame.js') }}" defer></script>
@endsection