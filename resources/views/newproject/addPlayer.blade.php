@extends("layouts.standard")

@section("stylesheet")
<link rel="stylesheet" href="{{ asset('css/add.css') }}">
@endsection

@section("title","登録")

@section("h2","登録")

@section("content")

<div class="add">
    <h3 class="title">選手登録</h3>
    <form action="{{ route('routeAddPlayer')}}" method="post">
        @csrf

        @if($errors->has("ign"))
        <div class="error-pc">
            <small class="small">※{{$errors->first("ign")}}</small>
        </div>
        @endif
        <div class="flex">
            <div class="item-1">
                <span class="name">IGN：</span>
                @if($errors->has("ign"))
                <div class="error-mob">
                    <small class="small">※{{$errors->first("ign")}}</small>
                </div>
                @endif
            </div>
            <div class="item-2">
                <input type="text" name="ign" class="select" value="{{old('ign')}}">
            </div>
        </div>

        @if($errors->has("proama"))
        <div class="error-pc">
            <small class="small">※{{$errors->first("proama")}}</small>
        </div>
        @endif
        <div class="flex">
            <div class="item-1">
                <span class="name">志望チーム：</span>
                @if($errors->has("proama"))
                <div class="error-mob">
                    <small class="small">※{{$errors->first("proama")}}</small>
                </div>
                @endif
            </div>
            <div class="item-2">
                <label class="radio1">プロ<input type="radio" name="proama" value="0" {{ old('proama') == '0' ? 'checked' : '' }}></label>
                <span>|</span>
                <label class="radio2">一般<input type="radio" name="proama" value="1" {{ old('proama') == '1' ? 'checked' : '' }}></label>
            </div>
        </div>


        @if($errors->has("game"))
        <div class="error-pc">
            <small class="small">※{{$errors->first("game")}}</small>
        </div>
        @endif
        <div class="flex">
            <div class="item-1">
                <span class="name">ゲームタイトル：</span>
                @if($errors->has("game"))
                <div class="error-mob">
                    <small class="small">※{{$errors->first("game")}}</small>
                </div>
                @endif
            </div>
            <div class="item-2">
                <select name="game" class="game select">
                    <option value="0">未選択</option>
                    @foreach($games as $game)
                    <option value="{{ $game->id }}" {{ old('game') == $game->id ? 'selected' : '' }}>{{ $game->name }}</option>
                    @endforeach
                </select>
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
                <select name="position" class="position select">
                    <option class="position-0" value="0">未選択</option>
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
                <select name="rank" class="rank select">
                    <option class="rank-0" value="0">未選択</option>
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
                <span class="name">紹介文：</span>
                @if($errors->has("description"))
                <div class="error-mob">
                    <small class="small">※{{$errors->first("description")}}</small>
                </div>
                @endif
            </div>
            <div class="item-2">
                <textarea name="description" cols="35" rows="10" class="body">{{old('description')}}</textarea>
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