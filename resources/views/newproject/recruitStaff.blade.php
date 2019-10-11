@extends("layouts.standard")

@section("stylesheet")
<link rel="stylesheet" href="{{ asset('css/recruit.css') }}">
@endsection

@section("title","募集登録")

@section("h2","メンバー募集登録")

@section("content")

<div class="add">
    <h3 class="title">スタッフ</h3>
    <form action="{{ route('routeRecruitStaff')}}" method="post">
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


        @if($errors->has("game"))
        <div class="error-pc">
            <small class="small">※{{$errors->first("game")}}</small>
        </div>
        @endif
        <div class="flex">
            <div class="item-1">
                <span class="name">チームタイトル：</span>
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
                @foreach($games as $game)
                <span class="text">{{ $game->name }}</span>
                @endforeach
                @endif
            </div>
        </div>


        @if($errors->has("staff"))
        <div class="error-pc">
            <small class="small">※{{$errors->first("staff")}}</small>
        </div>
        @endif
        <div class="flex">
            <div class="item-1">
                <span class="name">職種：</span>
                @if($errors->has("staff"))
                <div class="error-mob">
                    <small class="small">※{{$errors->first("staff")}}</small>
                </div>
                @endif
            </div>
            <div class="item-2">
                <select name="staff" class="select">
                    <option value="">未選択</option>
                    @foreach($staffs as $staff)
                    <option value="{{ $staff->id }}" {{ old('staff') == $staff->id ? 'selected' : '' }}>{{ $staff->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>



        @if($errors->has("content"))
        <div class="error-pc">
            <small class="small">※{{$errors->first("content")}}</small>
        </div>
        @endif
        <div class="flex">
            <div class="item-1">
                <span class="name">仕事内容：</span>
                @if($errors->has("content"))
                <div class="error-mob">
                    <small class="small">※{{$errors->first("content")}}</small>
                </div>
                @endif
            </div>
            <div class="item-2">
                <input type="text" name="content" class="select" value="{{old('content')}}">
            </div>
        </div>



        @if($errors->has("ab_skill"))
        <div class="error-pc">
            <small class="small">※{{$errors->first("ab_skill")}}</small>
        </div>
        @endif
        <div class="flex">
            <div class="item-1">
                <span class="name">必須スキル：</span>
                @if($errors->has("ab_skill"))
                <div class="error-mob">
                    <small class="small">※{{$errors->first("ab_skill")}}</small>
                </div>
                @endif
            </div>
            <div class="item-2">
                <input type="text" name="ab_skill" class="select" value="{{old('ab_skill')}}">
            </div>
        </div>




        @if($errors->has("wel_skill"))
        <div class="error-pc">
            <small class="small">※{{$errors->first("wel_skill")}}</small>
        </div>
        @endif
        <div class="flex">
            <div class="item-1">
                <span class="name">歓迎スキル：</span>
                @if($errors->has("wel_skill"))
                <div class="error-mob">
                    <small class="small">※{{$errors->first("wel_skill")}}</small>
                </div>
                @endif
            </div>
            <div class="item-2">
                <input type="text" name="wel_skill" class="select" value="{{old('wel_skill')}}">
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