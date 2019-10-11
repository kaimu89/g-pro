@extends("layouts.standard")

@section("stylesheet")
<link rel="stylesheet" href="{{ asset('css/myplayerEdit.css') }}">
@endsection

@section("title",'選手登録変更')

@section("h2","選手登録変更")

@section("content")
<div class="add">

    <form action="{{ route('routeMyPlayerEdit') }}" method="post">
        @csrf

        @if($errors->has("ign"))
        <div class="error-pc">
            <small class="small">※{{$errors->first("ign")}}</small>
        </div>
        @endif
        <div class="flex">
            <div class="item-1">
                <span class="name">IGN</span>
                @if($errors->has("ign"))
                <div class="error-mob">
                    <small class="small">※{{$errors->first("ign")}}</small>
                </div>
                @endif
            </div>
            <div class="item-2">
                <input type="text" name="ign" class="select" value="{{ old('ign',$player->ign) }}">
            </div>
        </div>

        @if($errors->has("proama"))
        <div class="error-pc">
            <small class="small">※{{$errors->first("proama")}}</small>
        </div>
        @endif
        <div class="flex">
            <div class="item-1">
                <span class="name">志望チーム</span>
                @if($errors->has("proama"))
                <div class="error-mob">
                    <small class="small">※{{$errors->first("proama")}}</small>
                </div>
                @endif
            </div>
            <div class="item-2">
                <label class="radio1">プロ
                    <input type="radio" name="proama" value="0" {{ old('proama') == '0' ? 'checked' : '' }}{{ $player->proama == 0 ? 'checked' : '' }}>
                </label>
                <span>|</span>
                <label class="radio2">一般
                    <input type="radio" name="proama" value="1" {{ old('proama') == '1' ? 'checked' : '' }}{{ $player->proama == 1 ? 'checked' : '' }}>
                </label>
            </div>
        </div>

        @if($errors->has("game_name"))
        <div class="error-pc">
            <small class="small">※{{$errors->first("game_name")}}</small>
        </div>
        @endif
        <div class="flex">
            <div class="item-1">
                <span class="name">ゲームタイトル</span>
                @if($errors->has("game_name"))
                <div class="error-mob">
                    <small class="small">※{{$errors->first("game_name")}}</small>
                </div>
                @endif
            </div>
            <div class="item-2">
                <select name="game_name" class="select">
                    <option value="{{ $game->id }}" selected>{{ $game->name }}</option>
                    @foreach($allgames as $allgame)
                    @if($game->id != $allgame->id)
                    <option value="{{ $allgame->id }}" {{ old('game_name') == $game->id ? 'selected' : '' }}>{{ $allgame->name }}</option>
                    @endif
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
                <span class="name">ポジション</span>
                @if($errors->has("position"))
                <div class="error-mob">
                    <small class="small">※{{$errors->first("position")}}</small>
                </div>
                @endif
            </div>
            <div class="item-2">
                <select name="position" class="select">
                    <option value="{{ $player->position->id }}" selected>{{ $player->position->name }}</option>
                    @foreach($positions as $position)
                    @if($player->position != $position)
                    <option value="{{ $position->id }}" {{ old('position') == $position->id ? 'selected' : '' }}>{{ $position->name }}</option>
                    @endif
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
                <span class="name">ランク</span>
                @if($errors->has("rank"))
                <div class="error-mob">
                    <small class="small">※{{$errors->first("rank")}}</small>
                </div>
                @endif
            </div>
            <div class="item-2">
                <select name="rank" class="select">
                    <option value="{{ $player->rank->id }}" selected>{{ $player->rank->name }}</option>
                    @foreach($ranks as $rank)
                    @if($player->rank != $rank)
                    <option value="{{ $rank->id }}" {{ old('rank') == $rank->id ? 'selected' : '' }}>{{ $rank->name }}</option>
                    @endif
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
                <span class="name">紹介文</span>
                @if($errors->has("description"))
                <div class="error-mob">
                    <small class="small">※{{$errors->first("description")}}</small>
                </div>
                @endif
            </div>
            <div class="item-2">
                <textarea name="description" cols="35" rows="10" class="body">{{ old('description',$user->description) }}</textarea>
            </div>
        </div>

        <div class="item-5">
            <input type="submit" value="変更" class="btn">
        </div>

    </form>

</div>

@endsection