@extends("layouts.standard")

@section("stylesheet")
<link rel="stylesheet" href="{{ asset('css/profileEdit.css') }}">
@endsection

@section("title","メールアドレス")

@section("h2","メールアドレス設定")

@section("content")
<div class="add">

    <form action="{{ route('routeProfileEdit') }}" method="post">
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
                <input type="text" name="email" class="select" value="{{ old('email',$user->email) }}">
            </div>
        </div>


        <div class="item-5">
            <a href="{{ route('routeMyTeam') }}" class="btn cancel">戻る</a>
            <input type="submit" value="送信" class="btn">
        </div>

    </form>

</div>

@endsection