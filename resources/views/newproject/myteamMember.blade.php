@extends("layouts.standard")

@section("stylesheet")
<link rel="stylesheet" href="{{ asset('css/myteamEdit.css') }}">
@endsection

@section("title",'マイチーム')

@section("h2","メンバー変更")

@section("content")
<div class="add">

    <div class="leader">
        <div class="item-1">
            <span class="name">リーダー</span>
        </div>
        @foreach($users as $user)
        @if($user->leader == '0')
        <div class="item-2">
            <span class="select">{{ $user->user_name }}<i class="fas fa-crown"></i></span>
            <div class="pass"><span class="btn btn1">リーダー交代</span></div>
        </div>
        @endif
        @endforeach
    </div>


    @if($errors->has("leader"))
    <div class="error-pc">
        <small class="small">※{{$errors->first("leader")}}</small>
    </div>
    @endif
    @if($errors->has("leader"))
    <div class="error-mob">
        <small class="small">※{{$errors->first("leader")}}</small>
    </div>
    @endif
    <div class="check">
        <form action="{{ route('routeMyTeamMember') }}" method="post">
            @csrf
            <div class="item-2">
                <select name="leader" class="select">
                    <option class="option" value="">選択しない</option>
                    @foreach($users as $user)
                    @if(!isset($user->leader))
                    <option value="{{ $user->id }}">{{ $user->user_name }}</option>
                    @endif
                    @endforeach
                </select>
            </div>
            <div class="item-5">
                <input type="submit" name="btn_leader" value="交代" class="btn">
            </div>
        </form>
    </div>

    <div class="member">
        <div class="item-1">
            <span class="name">メンバー</span>
        </div>
        @foreach($users as $user)
        @if(!isset($user->leader))
        <div class="item-2">
            <span class="select">{{ $user->user_name }}</span>
            <div class="delete">
                <span class="btn btn2" onclick="event.preventDefault();
                document.getElementById('leave{{ $user->id }}').submit();">脱退させる</span>
            </div>
            <form id="leave{{ $user->id }}" action="{{ route('routeMyTeamMember') }}" method="POST" style="display: none;">
                @csrf
                <input type="hidden" name="leave" value="{{ $user->id }}">
            </form>
        </div>
        @endif
        @endforeach
        <div class="member-btn-box">
            <span class="member-btn">メンバー招待</span>
        </div>
    </div>

    @if($errors->has("add_member"))
    <div class="error-pc">
        <small class="small">※{{$errors->first("add_member")}}</small>
    </div>
    @endif
    <div class="plus">
        <div class="item-1">
            @if($errors->has("add_member"))
            <div class="error-mob">
                <small class="small">※{{$errors->first("add_member")}}</small>
            </div>
            @endif
        </div>
        <form action="{{ route('routeMyTeamMember') }}" method="post">
            @csrf
            <div class="item-2">
                <input type="text" class="select" name="add_member">
            </div>
            <div class="item-5">
                <input type="submit" name="btn_member" value="招待" class="btn">
            </div>
        </form>
    </div>

    <div class="item-5">
        <a href="{{ route('routeMyTeam') }}" class="btn">戻る</a>
    </div>

    @endsection

    @section("script")
    <script src="{{ asset('js/addmember.js') }}"></script>
    @endsection