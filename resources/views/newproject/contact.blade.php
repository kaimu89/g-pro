@extends("layouts.standard")

@section("stylesheet")
<link rel="stylesheet" href="{{ asset('css/contact.css') }}">
@endsection

@section("title","お問い合わせフォーム")

@section("h2","お問い合わせ")

@section("content")

<div class="add">
    <form action="{{ route('routeConfirm') }}" method="post">
        @csrf

        @if($errors->has("name"))
        <div class="error-pc">
            <small class="small">※{{$errors->first("name")}}</small>
        </div>
        @endif
        <div class="flex">
            <div class="item-1">
                <span class="name">名前：</span>
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




        @if($errors->has("mail"))
        <div class="error-pc">
            <small class="small">※{{$errors->first("mail")}}</small>
        </div>
        @endif
        <div class="flex">
            <div class="item-1">
                <span class="name">メールアドレス：</span>
                @if($errors->has("mail"))
                <div class="error-mob">
                    <small class="small">※{{$errors->first("mail")}}</small>
                </div>
                @endif
            </div>
            <div class="item-2">
                <input type="text" name="mail" class="select" value="{{old('mail')}}">
            </div>
        </div>

        @if($errors->has("title"))
        <div class="error-pc">
            <small class="small">※{{$errors->first("title")}}</small>
        </div>
        @endif
        <div class="flex">
            <div class="item-1">
                <span class="name">お問い合わせ名：</span>
                @if($errors->has("title"))
                <div class="error-mob">
                    <small class="small">※{{$errors->first("title")}}</small>
                </div>
                @endif
            </div>
            <div class="item-2">
                <input type="text" name="title" class="select" value="{{old('title')}}">
            </div>
        </div>


        @if($errors->has("body"))
        <div class="error-pc">
            <small class="small">※{{$errors->first("body")}}</small>
        </div>
        @endif
        <div class="flex">
            <div class="item-1">
                <span class="name">お問い合わせ内容：</span>
                @if($errors->has("body"))
                <div class="error-mob">
                    <small class="small">※{{$errors->first("body")}}</small>
                </div>
                @endif
            </div>
            <div class="item-2">
                <textarea name="body" cols="35" rows="10" class="body">{{old('body')}}</textarea>
            </div>
        </div>

        <div class="item-5">
            <input type="submit" value="送信" class="btn">
        </div>



    </form>
</div>
@endsection