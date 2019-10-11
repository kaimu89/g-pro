@extends("layouts.standard")

@section("stylesheet")
<link rel="stylesheet" href="{{ asset('css/add.css') }}">
@endsection

@section("title","チーム登録")

@section("h2",$user->team->name)

@section("content")

<div class="add">
    <h3 class="title">部門チーム登録</h3>
    <form action="{{ route('routeAddPro')}}" method="post" enctype="multipart/form-data">
        @csrf

        @if($errors->has("name"))
        <div class="error-pc">
            <small class="small">※{{$errors->first("name")}}</small>
        </div>
        @endif
        <div class="flex">
            <div class="item-1">
                <span class="name">チーム名：</span>
                @if($errors->has("name"))
                <div class="error-mob">
                    <small class="small">※{{$errors->first("name")}}</small>
                </div>
                @endif
            </div>
            <div class="item-2">
                <input type="text" name="name" class="select" value="{{old('name')}}">
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
                @if(isset($games[1]))
                <select name="game" class="game select">
                    <option value="">未選択</option>
                    @foreach($games as $game)
                    <option value="{{ $game->id }}" {{ old('game') == $game->id ? 'selected' : '' }}>{{ $game->name }}</option>
                    @endforeach
                </select>
                @else
                <select name="game" class="game select">
                    @foreach($games as $game)
                    <option value="{{ $game->id }}" {{ old('game') == $game->id ? 'selected' : '' }}>{{ $game->name }}</option>
                    @endforeach
                </select>
                @endif
            </div>
        </div>


        @if($errors->has("top"))
        <div class="error-pc pro-top">
            <small class="small">※{{$errors->first("top")}}</small>
        </div>
        @endif
        <div class="flex pro-top">
            <div class="item-1">
                <span class="name">代表名：</span>
                @if($errors->has("top"))
                <div class="error-mob">
                    <small class="small">※{{$errors->first("top")}}</small>
                </div>
                @endif
            </div>
            <div class="item-2">
                <input type="text" name="top" class="select" value="{{old('top')}}">
            </div>
        </div>


        @if($errors->has("mail"))
        <div class="error-pc">
            <small class="small">※{{$errors->first("mail")}}</small>
        </div>
        @endif
        <div class="flex">
            <div class="item-1">
                <span class="name">連絡先：</span>
                @if($errors->has("mail"))
                <div class="error-mob">
                    <small class="small">※{{$errors->first("mail")}}</small>
                </div>
                @endif
            </div>
            <div class="item-2">
                <input type="text" name="mail" class="select" placeholder="example@〇〇〇.〇〇" value="{{ old('mail')}}">
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
@endsection