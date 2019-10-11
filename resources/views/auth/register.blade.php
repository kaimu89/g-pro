@extends("layouts.auth")

@section("stylesheet")
@endsection

@section("title","新規登録")

@section('log','新規登録')

@section("content")

<div class="SNS">
    <span class="sns-l">SNSアカウントで登録する</span>
</div>

<div class="add">
    <form method="POST" action="{{ route('register') }}">
        @csrf

        @if($errors->has("user_name"))
        <div class="error-pc">
            <small class="small">※{{$errors->first("user_name")}}</small>
        </div>
        @endif
        <div class="flex">
            <div class="item-1">
                <span class="name">ユーザー名：</span>
                @if($errors->has("user_name"))
                <div class="error-mob">
                    <small class="small">※{{$errors->first("user_name")}}</small>
                </div>
                @endif
            </div>
            <div class="item-2">
                <input type="text" name="user_name" class="select" value="{{old('user_name')}}">
            </div>
        </div>

        @if($errors->has("email"))
        <div class="error-pc">
            <small class="small">※{{$errors->first("email")}}</small>
        </div>
        @endif
        <div class="flex">
            <div class="item-1">
                <span class="name">メールアドレス：</span>
                @if($errors->has("email"))
                <div class="error-mob">
                    <small class="small">※{{$errors->first("email")}}</small>
                </div>
                @endif
            </div>
            <div class="item-2">
                <input type="text" name="email" class="select" value="{{old('email')}}">
            </div>
        </div>

        @if($errors->has("password"))
        <div class="error-pc">
            <small class="small">※{{$errors->first("password")}}</small>
        </div>
        @endif
        <div class="flex">
            <div class="item-1">
                <span class="name">パスワード：</span>
                @if($errors->has("password"))
                <div class="error-mob">
                    <small class="small">※{{$errors->first("password")}}</small>
                </div>
                @endif
            </div>
            <div class="item-2">
                <input type="password" name="password" class="select" value="{{old('password')}}">
            </div>
        </div>

        <div class="flex">
            <div class="item-1">
                <span class="name">確認用パスワード：</span>
            </div>
            <div class="item-2">
                <input type="password" name="password_confirmation" class="select">
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