@extends("layouts.standard")

@section("stylesheet")
<link rel="stylesheet" href="{{ asset('css/myteamEdit.css') }}">
@endsection

@section("title",'マイチーム')

@section("h2","マイチーム変更")

@section("content")
<div class="add">

    <form action="{{ route('routeMyTeamEdit') }}" method="post">
        @csrf

        @if($errors->has("name"))
        <div class="error-pc">
            <small class="small">※{{$errors->first("name")}}</small>
        </div>
        @endif
        <div class="flex">
            <div class="item-1">
                <span class="name">チーム名</span>
                @if($errors->has("name"))
                <div class="error-mob">
                    <small class="small">※{{$errors->first("name")}}</small>
                </div>
                @endif
            </div>
            <div class="item-2">
                <input type="text" name="name" class="select" value="{{ old('name',$team->name) }}">
            </div>

        </div>



        @if($team->proama == '0')

        @if($errors->has("pro_game"))
        <div class="error-pc">
            <small class="small">※{{$errors->first("pro_game")}}</small>
        </div>
        @endif
        <div class="flex">
            <div class="item-1">
                <span class="name">ゲームタイトル</span>
                @if($errors->has("pro_game"))
                <div class="error-mob">
                    <small class="small">※{{$errors->first("pro_game")}}</small>
                </div>
                @endif
            </div>
            <div class="item-2">
                @if(isset($no_childs))
                <div class="selectbox">
                    @foreach($games as $game)
                    @if(in_array($game->id,$user_games))
                    @if(in_array($game->id,$no_childs))
                    <label class="">{{ $game->name }}<input type="checkbox" name="pro_game[]" value="{{ $game->id }}" {{ (is_array(old('pro_game')) and in_array($game->id, old('pro_game'))) ? 'checked' : '' }} checked></label>
                    @endif
                    @else
                    <label class="">{{ $game->name }}<input type="checkbox" name="pro_game[]" value="{{ $game->id }}" {{ (is_array(old('pro_game')) and in_array($game->id, old('pro_game'))) ? 'checked' : '' }}></label>
                    @endif
                    @endforeach
                </div>
                @else
                <div class="selectbox">
                    @foreach($games as $game)
                    @if(in_array($game->id,$user_games))
                    <label class="">{{ $game->name }}<input type="checkbox" name="pro_game[]" value="{{ $game->id }}" {{ (is_array(old('pro_game')) and in_array($game->id, old('pro_game'))) ? 'checked' : '' }} checked></label>
                    @else
                    <label class="">{{ $game->name }}<input type="checkbox" name="pro_game[]" value="{{ $game->id }}" {{ (is_array(old('pro_game')) and in_array($game->id, old('pro_game'))) ? 'checked' : '' }}></label>
                    @endif
                    @endforeach
                </div>
                @endif
            </div>
        </div>

        @endif

        @if($team->proama == '1')

        @if($errors->has("ama_game"))
        <div class="error-pc">
            <small class="small">※{{$errors->first("ama_game")}}</small>
        </div>
        @endif
        <div class="flex">
            <div class="item-1">
                <span class="name">ゲームタイトル</span>
                @if($errors->has("ama_game"))
                <div class="error-mob">
                    <small class="small">※{{$errors->first("ama_game")}}</small>
                </div>
                @endif
            </div>
            <div class="item-2">
                <select name="ama_game" class="select">
                    <option value="{{ $user_game->id }}" selected>{{ $user_game->name }}</option>
                    @foreach($games as $game)
                    @if($user_game->id != $game->id)
                    <option value="{{ $game->id }}" {{ old('ama_game') == $game->id ? 'selected' : '' }}>{{ $game->name }}</option>
                    @endif
                    @endforeach
                </select>
            </div>
        </div>

        @endif


        @if($errors->has("mail"))
        <div class="error-pc">
            <small class="small">※{{$errors->first("mail")}}</small>
        </div>
        @endif
        <div class="flex">
            <div class="item-1">
                <span class="name">チームメールアドレス</span>
                @if($errors->has("mail"))
                <div class="error-mob">
                    <small class="small">※{{$errors->first("mail")}}</small>
                </div>
                @endif
            </div>
            <div class="item-2">
                <input type="text" name="mail" class="select" value="{{ old('mail',$team->mail) }}">
            </div>
        </div>

        @if($team->proama == '0')
        @if($errors->has("hp"))
        <div class="error-pc">
            <small class="small">※{{$errors->first("hp")}}</small>
        </div>
        @endif
        <div class="flex">
            <div class="item-1">
                <span class="name">チームHP</span>
                @if($errors->has("hp"))
                <div class="error-mob">
                    <small class="small">※{{$errors->first("hp")}}</small>
                </div>
                @endif
            </div>
            <div class="item-2">
                <input type="text" name="hp" class="select" value="{{ old('hp',$team->url) }}">
            </div>
        </div>
        @endif

        @if($team->proama == '0')
        @if($errors->has("top"))
        <div class="error-pc">
            <small class="small">※{{$errors->first("top")}}</small>
        </div>
        @endif
        <div class="flex">
            <div class="item-1">
                <span class="name">代表者</span>
                @if($errors->has("top"))
                <div class="error-mob">
                    <small class="small">※{{$errors->first("top")}}</small>
                </div>
                @endif
            </div>
            <div class="item-2">
                <input type="text" name="top" class="select" value="{{ old('top',$team->top) }}">
            </div>
        </div>
        @endif

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
                <textarea name="description" cols="35" rows="10" class="body">{{ old('description',$team->description) }}</textarea>
            </div>
        </div>

        <div class="item-5">
            <a href="{{ route('routeMyTeam') }}" class="btn cancel">戻る</a>
            <input type="submit" value="変更" class="btn">
        </div>

    </form>

</div>

@endsection