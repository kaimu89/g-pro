@extends("layouts.standard")

@section("stylesheet")
<link rel="stylesheet" href="{{ asset('css/add.css') }}">
@endsection

@section("title","登録")

@section("h2","登録")

@section("content")

<div class="add">
    <h3 class="title">チーム登録</h3>
    <form action="{{ route('routeAddTeam')}}" method="post" enctype="multipart/form-data">
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




        @if($errors->has("file"))
        <div class="error-pc">
            <small class="small">※{{$errors->first("file")}}</small>
        </div>
        @endif
        <div class="flex">
            <div class="item-1">
                <span class="name">チームロゴ：</span>
                @if($errors->has("file"))
                <div class="error-mob">
                    <small class="small">※{{$errors->first("file")}}</small>
                </div>
                @endif
            </div>
            <div class="item-2">
                <input type="file" name="file" class="file" accept='image/*'>
            </div>
        </div>

        @if($errors->has("proama"))
        <div class="error-pc">
            <small class="small">※{{$errors->first("proama")}}</small>
        </div>
        @endif
        <div class="flex">
            <div class="item-1">
                <span class="name">チーム種類：</span>
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





        @if($errors->has("pro_game"))
        <div class="error-pc pro-title">
            <small class="small">※{{$errors->first("pro_game")}}</small>
        </div>
        @endif
        <div class="flex pro-title">
            <div class="item-1">
                <span class="name">ゲームタイトル：</span>
                @if($errors->has("pro_game"))
                <div class="error-mob">
                    <small class="small">※{{$errors->first("pro_game")}}</small>
                </div>
                @endif
            </div>
            <div class="item-2">
                <div class="selectbox">
                    @foreach($games as $game)
                    <label class="">{{ $game->name }}<input type="checkbox" name="pro_game[]" value="{{ $game->id }}" {{ (is_array(old('pro_game')) and in_array($game->id, old('pro_game'))) ? 'checked' : '' }}></label>
                    @endforeach
                </div>
            </div>
        </div>





        @if($errors->has("ama_game"))
        <div class="error-pc ama-title">
            <small class="small">※{{$errors->first("ama_game")}}</small>
        </div>
        @endif
        <div class="flex ama-title">
            <div class="item-1">
                <span class="name">ゲームタイトル：</span>
                @if($errors->has("ama_game"))
                <div class="error-mob">
                    <small class="small">※{{$errors->first("ama_game")}}</small>
                </div>
                @endif
            </div>
            <div class="item-2">
                <select name="ama_game" class="game select">
                    <option value="">未選択</option>
                    @foreach($games as $game)
                    <option value="{{ $game->id }}" {{ old('ama_game') == $game->id ? 'selected' : '' }}>{{ $game->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>





        @if($errors->has("pro_top"))
        <div class="error-pc pro-top">
            <small class="small">※{{$errors->first("pro_top")}}</small>
        </div>
        @endif
        <div class="flex pro-top">
            <div class="item-1">
                <span class="name">チーム代表名：</span>
                @if($errors->has("pro_top"))
                <div class="error-mob">
                    <small class="small">※{{$errors->first("pro_top")}}</small>
                </div>
                @endif
            </div>
            <div class="item-2">
                <input type="text" name="pro_top" class="select" value="{{old('pro_top')}}">
            </div>
        </div>





        @if($errors->has("ama_top")) <div class="error-pc ama-top">
            <small class="small">※{{$errors->first("ama_top")}}</small>
        </div>
        @endif
        <div class="flex ama-top">
            <div class="item-1">
                <span class="name">リーダー名：</span>
                @if($errors->has("ama_top"))
                <div class="error-mob">
                    <small class="small">※{{$errors->first("ama_top")}}</small>
                </div>
                @endif
            </div>
            <div class="item-2">
                <input type="text" name="ama_top" class="select" value="{{old('ama_top')}}">
            </div>
        </div>



        @if($errors->has("hp"))
        <div class="error-pc pro-hp">
            <small class="small">※{{$errors->first("hp")}}</small>
        </div>
        @endif
        <div class="flex pro-hp">
            <div class="item-1">
                <span class="name">チームHP：</span>
                @if($errors->has("hp"))
                <div class="error-mob">
                    <small class="small">※{{$errors->first("hp")}}</small>
                </div>
                @endif
            </div>
            <div class="item-2">
                <input type="text" name="hp" class="select" value="{{ old('hp') }}">
            </div>
        </div>





        @if($errors->has("mail"))
        <div class="error-pc">
            <small class="small">※{{$errors->first("mail")}}</small>
        </div>
        @endif
        <div class="flex">
            <div class="item-1">
                <span class="name">チーム連絡先：</span>
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
<script src="{{ asset('js/add.js') }}" defer></script>
@endsection