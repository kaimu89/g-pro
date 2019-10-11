@extends("layouts.standard")

@section("stylesheet")
<link rel="stylesheet" href="{{ asset('css/profileEdit.css') }}">
@endsection

@section("title","パスワード再設定")

@section("h2","パスワード再設定")

@section("content")
<div class="add">

    <form action="{{ route('routeProfilePassword') }}" method="post">
        @csrf


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
                <input type="password" name="password" class="select" value="{{ old('password') }}">
            </div>
        </div>

        <div class="flex">
            <div class="item-1">
                <span class="name">パスワード確認用：</span>
            </div>
            <div class="item-2">
                <input type="password" name="password_confirmation" class="select" value="{{ old('password_confirmation') }}">
            </div>
        </div>


        <div class="item-5">
            <a href="{{ route('routeProfile') }}" class="btn cancel">戻る</a>
            <input type="submit" value="送信" class="btn">
        </div>

    </form>

</div>

@endsection