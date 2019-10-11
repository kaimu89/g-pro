@extends("layouts.auth")

@section("stylesheet")
@endsection

@section("title","ログイン")

@section('log','ログイン')

@section("content")

<div class="SNS">
    <span class="sns-l">SNSアカウントでログインする</span>
</div>

<div class="add">
    <form method="POST" action="{{ route('login') }}">
        @csrf

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
            <div class="log-how">
                <label class="radio1">ログイン状態維持
                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                </label>
            </div>
        </div>

        <div class="item-5">
            @if (Route::has('password.request'))
            <a class="forget" href="{{ route('password.request') }}">パスワード忘れた？</a>
            @endif
            <input type="submit" value="ログイン" class="btn">
        </div>

    </form>
</div>
@endsection

@section("script")
@endsection