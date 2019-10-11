@extends("layouts.standard")

@section("stylesheet")
<link rel="stylesheet" href="{{ asset('css/profileEdit.css') }}">
@endsection

@section("title","プロフィール")

@section("h2","プロフィール変更")

@section("content")
<div class="add">

    <form action="{{ route('routeProfileEdit') }}" method="post">
        @csrf
        @if($errors->has("first_name"))
        <div class="error-pc">
            <small class="small">※{{$errors->first("first_name")}}</small>
        </div>
        @endif
        @if($errors->has("last_name"))
        <div class="error-pc">
            <small class="small">※{{$errors->first("last_name")}}</small>
        </div>
        @endif
        <div class="flex">
            <div class="item-1">
                <div class="item-4">
                    <span class="name">姓</span>
                    <span class="name">名</span>
                    @if($errors->has("first_name"))
                    <div class="error-mob">
                        <small class="small">※{{$errors->first("first_name")}}</small>
                    </div>
                    @endif
                    @if($errors->has("first_name"))
                    <div class="error-mob">
                        <small class="small">※{{$errors->first("first_name")}}</small>
                    </div>
                    @endif
                </div>
            </div>
            <div class="item-2">
                <div class="item-3">
                    <input type="text" name="first_name" class="select-3" value="{{ old('first_name',$user->first_name) }}">
                    <input type="text" name="last_name" class="select-3" value="{{ old('last_name',$user->last_name) }}">
                </div>
            </div>
        </div>

        @if($errors->has("user_name"))
        <div class="error-pc">
            <small class="small">※{{$errors->first("user_name")}}</small>
        </div>
        @endif
        <div class="flex">
            <div class="item-1">
                <span class="name">ユーザー名</span>
                @if($errors->has("user_name"))
                <div class="error-mob">
                    <small class="small">※{{$errors->first("user_name")}}</small>
                </div>
                @endif
            </div>
            <div class="item-2">
                <input type="text" name="user_name" class="select" value="{{ old('user_name',$user->user_name) }}">
            </div>
        </div>


        @if($errors->has("gender"))
        <div class="error-pc">
            <small class="small">※{{$errors->first("gender")}}</small>
        </div>
        @endif
        <div class="flex">
            <div class="item-1">
                <span class="name">性別</span>
                @if($errors->has("gender"))
                <div class="error-mob">
                    <small class="small">※{{$errors->first("gender")}}</small>
                </div>
                @endif
            </div>
            <div class="item-2">
                <label class="radio1">男
                    <input type="radio" name="gender" value="0" {{ old('gender') == '0' ? 'checked' : '' }}{{ $user->gender == 0 ? 'checked' : '' }}>
                </label>
                <span>|</span>
                <label class="radio2">女
                    <input type="radio" name="gender" value="1" {{ old('gender') == '1' ? 'checked' : '' }}{{ $user->gender == 1 ? 'checked' : '' }}>
                </label>
            </div>
        </div>


        @if($errors->has("twitter"))
        <div class="error-pc">
            <small class="small">※{{$errors->first("twitter")}}</small>
        </div>
        @endif
        <div class="flex">
            <div class="item-1">
                <span class="name">Twitter</span>
                @if($errors->has("twitter"))
                <div class="error-mob">
                    <small class="small">※{{$errors->first("twitter")}}</small>
                </div>
                @endif
            </div>
            <div class="item-2">
                <input type="text" name="twitter" class="select" value="{{ old('twitter',$user->twitter) }}">
            </div>
        </div>

        @if($errors->has("date"))
        <div class="error-pc">
            <small class="small">※{{$errors->first("date")}}</small>
        </div>
        @endif
        <div class="flex">
            <div class="item-1">
                <span class="name">誕生日</span>
                @if($errors->has("date"))
                <div class="error-mob">
                    <small class="small">※{{$errors->first("date")}}</small>
                </div>
                @endif
            </div>
            <div class="item-2">
                <div class="birthday">
                    <select name="year" class="year birth">
                        <option value="year" selected>year</option>
                        @foreach($years as $year)
                        <option value="{{ $year }}">{{ $year }}</option>
                        @endforeach
                    </select>
                    <select name="month" class="month birth">
                        <option value="month" selected>month</option>
                        @foreach($months as $month)
                        <option value="{{ $month }}">{{ $month }}</option>
                        @endforeach
                    </select>
                    <select name="day" class="day birth">
                        <option value="day" selected>day</option>
                        @foreach($days as $day)
                        <option value="{{ $day }}">{{ $day }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <input type="hidden" name="date">

        <div class="item-5">
            <a href="{{ route('routeProfile') }}" class="btn cancel">戻る</a>
            <input type="submit" value="変更" class="btn">
        </div>

    </form>

</div>

@endsection

@section("script")
<script src="{{ asset('js/form.js') }}"></script>
@endsection