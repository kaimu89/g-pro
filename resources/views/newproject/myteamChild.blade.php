@extends("layouts.standard")

@section("stylesheet")
<link rel="stylesheet" href="{{ asset('css/myteamEdit.css') }}">
@endsection

@section("title",'マイチーム')

@section("h2","マイチーム部門変更")

@section("content")
<div class="add">

    <div class="flex">
        <div class="item-1">
            <span class="name">ゲーム名</span>
        </div>
        <div class="item-2">
            <span class="text">{{ $child->teamgame->game->name }}</span>
        </div>
        @if(isset(Auth::user()->team_id) && Auth::user()->leader == '0')
        <div class="item-5">
            <span class="btn" onclick="event.preventDefault();
            document.getElementById('disband').submit();">解散する</span>
        </div>
        <form id="disband" action="{{ route('routeMyTeamChild',['child'=>$child->id] )}}" method="POST" style="display: none;">
            @csrf
            <input type="hidden" name="disband" value="disband">
        </form>
        @endif
    </div>

    @if($errors->has("name"))
    <div class="error-pc">
        <small class="small">※{{$errors->first("name")}}</small>
    </div>
    @endif
    <div class="flex">
        <div class="item-1">
            <span class="name">チーム名</span>
            @if($errors->has("name"))
            <div class="error-mob">
                <small class="small">※{{$errors->first("name")}}</small>
            </div>
            @endif
        </div>
        <div class="item-2">
            <input type="text" class="select tx-name" value="{{ old('name',$child->name) }}">
        </div>
    </div>

    <div class="leader">
        <div class="item-1">
            <span class="name">リーダー</span>
        </div>
        @foreach($users as $user)
        @if($user->leader == '0')
        <div class="item-2">
            <span class="select">{{ $user->user_name }}<i class="fas fa-crown"></i></span>
            <div class="pass"><span class="btn1">リーダー交代</span></div>
        </div>
        @endif
        @endforeach
    </div>


    @if($errors->has("leader"))
    <div class="error-pc">
        <small class="small">※{{$errors->first("leader")}}</small>
    </div>
    @endif
    <div class="check">
        @if($errors->has("leader"))
        <div class="error-mob">
            <small class="small">※{{$errors->first("leader")}}</small>
        </div>
        @endif
        <form action="{{ route('routeMyTeamChild',['child'=>$child->id] )}}" method="post">
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
            @if(Auth::user()->leader == '0')
            <div class="item-5">
                <input type="submit" name="btn_leader" value="交代" class="btn">
            </div>
            @endif
        </form>
    </div>

    <div class="member">
        <div class="item-1">
            <span class="name">メンバー</span>
        </div>
        @if(isset(Auth::user()->team_id))
        @foreach($users as $user)
        <div class="item-2">
            <span class="select">{{ $user->user_name }}@if(isset($user->leader))<i class="fas fa-crown"></i>@endif</span>
            <div class="delete">
                <span class="btn btn2" onclick="event.preventDefault();
                document.getElementById('leave{{ $user->id }}').submit();">脱退させる</span>
            </div>
            <form id="leave{{ $user->id }}" action="{{ route('routeMyTeamChild',['child'=>$child->id] )}}" method="POST" style="display: none;">
                @csrf
                <input type="hidden" name="leave" value="{{ $user->id }}">
            </form>
        </div>
        @endforeach

        @elseif(isset(Auth::user()->child_id))

        @foreach($users as $user)
        @if(!isset($user->leader))
        <div class="item-2">
            <span class="select">{{ $user->user_name }}</span>
            <div class="delete">
                <span class="btn btn2" onclick="event.preventDefault();
                document.getElementById('leave{{ $user->id }}').submit();">脱退させる</span>
            </div>
            <form id="leave{{ $user->id }}" action="{{ route('routeMyTeamChild',['child'=>$child->id] )}}" method="POST" style="display: none;">
                @csrf
                <input type="hidden" name="leave" value="{{ $user->id }}">
            </form>
        </div>
        @endif
        @endforeach
        @endif
        <div class="member-btn-box">
            <span class="member-btn">メンバー追加</span>
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
        <form action="{{ route('routeMyTeamChild',['child'=>$child->id] )}}" method="post">
            @csrf
            <div class="item-2">
                <input type="text" class="select" name="add_member">
            </div>
            <div class="item-5">
                <input type="submit" name="btn_member" value="追加" class="btn">
            </div>
        </form>
    </div>

    @if($errors->has("mail"))
    <div class="error-pc">
        <small class="small">※{{$errors->first("mail")}}</small>
    </div>
    @endif
    <div class="flex">
        <div class="item-1">
            <span class="name">メールアドレス</span>
            @if($errors->has("mail"))
            <div class="error-mob">
                <small class="small">※{{$errors->first("mail")}}</small>
            </div>
            @endif
        </div>
        <div class="item-2">
            <input type="text" class="select tx-mail" value="{{ old('mail',$child->mail) }}">
        </div>
    </div>

    @if($errors->has("top"))
    <div class="error-pc">
        <small class="small">※{{$errors->first("top")}}</small>
    </div>
    @endif
    <div class="flex">
        <div class="item-1">
            <span class="name">チーム代表者名</span>
            @if($errors->has("top"))
            <div class="error-mob">
                <small class="small">※{{$errors->first("top")}}</small>
            </div>
            @endif
        </div>
        <div class="item-2">
            <input type="text" class="select tx-top" value="{{ old('top',$child->top) }}">
        </div>
    </div>

    @if($errors->has("description"))
    <div class="error-pc">
        <small class="small">※{{$errors->first("description")}}</small>
    </div>
    @endif
    <div class="flex">
        <div class="item-1">
            <span class="name">紹介文</span>
            @if($errors->has("description"))
            <div class="error-mob">
                <small class="small">※{{$errors->first("description")}}</small>
            </div>
            @endif
        </div>
        <div class="item-2">
            <textarea cols="35" rows="10" class="body tx-des">{{ old('description',$child->description) }}</textarea>
        </div>
    </div>


    <div class="item-5">
        <a href="{{ route('routeMyTeam') }}" class="btn cancel">戻る</a>
        <span onclick="event.preventDefault();
                    document.getElementById('child-form').submit();" class="btn child-btn">変更</span>
        <form action="{{ route('routeMyTeamChild',['child'=>$child->id] )}}" method="post" id="child-form">
            @csrf
            <input type="hidden" name="change" value="change">
            <input type="hidden" name="name" class="select fo-name">
            <input type="hidden" name="mail" class="select fo-mail">
            <input type="hidden" name="top" class="select fo-top">
            <input type="hidden" name="description" class="select fo-des">
        </form>
    </div>

</div>

@endsection

@section("script")
<script src="{{ asset('js/form.js') }}"></script>
<script src="{{ asset('js/addmember.js') }}"></script>
@endsection