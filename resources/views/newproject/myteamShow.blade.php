@extends("layouts.standard")

@section("stylesheet")
<link rel="stylesheet" href="{{ asset('css/myteamShow.css') }}">
@endsection

@section("title",'マイチーム')

@section("h2","マイチーム")

@section("content")

<div class="oubo-box">
    <a href="{{ route('routeMyTeamNotice') }}" class="oubo">応募者リスト</a>
</div>

<div class="add">

    <div class="title">
        <div class="item-2">
            <span class="name">{{ $team->name }}</span>
        </div>
        <div class="item-5">
            <span class="btn" onclick="event.preventDefault();
            document.getElementById('leave').submit();">脱退する</span>
        </div>
        <form id="leave" action="{{ route('routeMyTeam') }}" method="POST" style="display: none;">
            @csrf
            <input type="hidden" name="leave" value="leaveout">
        </form>
    </div>

    <div class="photo">
        @if(isset($team->picture))
        <div class="picture-myteam">
            <img src="{{ $team->picture }}" alt="" class="user-p p">
        </div>
        @else
        <div class="picture">
            <img src="0Qp7HbEmWbCY2yZ7xVSgsqpCZp20s5Spi03YNDtt.jpeg" alt="" class="nanashi-p p">
        </div>
        @endif
        @if(isset($user->team_id) && $user->leader == "0")
        <div class="input">
            <form action="{{ route('routeMyTeam') }}" method="post">
                @csrf
                <input type="file" name="logo" class="file" accept='image/*'>
                <div class="item-5">
                    <input type="submit" value="変更する" class="btn">
                </div>
            </form>
        </div>
        @endif
    </div>


    <div class="in-btn">
        <div class="flex2">
            <div class="item-1">
                <span class="name">メンバー名</span>
            </div>
            <div class="item-2">
                @foreach($mainMembers as $mainMember)
                @if($mainMember->leader == '0')
                <div class="item-3">
                    <span class="select">{{ $mainMember->user_name }}<i class="fas fa-crown"></i></span>
                </div>
                @endif
                @if(!isset($mainMember->leader))
                <div class="item-3">
                    <span class="select">{{ $mainMember->user_name }}</span>
                </div>
                @endif
                @endforeach
            </div>
        </div>
        @if(isset($user->team_id) && $user->leader == "0")
        <div class="item-5">
            <a href="{{ route('routeMyTeamMember') }}" class="btn">変更する</a>
        </div>
        @endif
    </div>


    @if($team->proama == '1')
    <div class="flex">
        <div class="item-1">
            <span class="name">ゲームタイトル</span>
        </div>
        <div class="item-2">
            <span class="select">{{ $team->teamgame->game->name }}</span>
        </div>
    </div>
    @endif

    @if($team->proama == '0')
    <div class="flex">
        <div class="item-1">
            <span class="name">チームHP</span>
        </div>
        @if(isset($team->url))
        <div class="item-2">
            <span class="select">{{ $team->url }}</span>
        </div>
        @else
        <div class="item-2">
            <span class="select">設定されてません</span>
        </div>
        @endif
    </div>
    @endif

    @if($team->proama == '0')
    <div class="flex">
        <div class="item-1">
            <span class="name">チーム代表者</span>
        </div>
        <div class="item-2">
            <span class="select">{{ $team->top }}</span>
        </div>
    </div>
    @endif

    <div class="flex">
        <div class="item-1">
            <span class="name">チームメールアドレス</span>
        </div>
        @if(isset($team->mail))
        <div class="item-2">
            <span class="select">{{ $team->mail }}</span>
        </div>
        @else
        <div class="item-2">
            <span class="select">設定されてません</span>
        </div>
        @endif
    </div>

    <div class="flex">
        <div class="item-1">
            <span class="name">紹介文</span>
        </div>
        <div class="item-2">
            <span class="select">{{ $team->description }}</span>
        </div>
    </div>

    @if(isset($user->team_id) && $user->leader == "0")
    <div class="item-5 out">
        <a href="{{ route('routeMyTeamEdit') }}" class="btn">変更する</a>
    </div>
    @endif


    @if(isset($childs[0]))
    <div class="child">
        @foreach($childs as $child)
        <div class="flex">
            <div class="flex2">
                <div class="item-1">
                    <span class="name">{{ $child->name }}</span>
                </div>
                <div class="item-2">
                    <span class="select">~{{ $child->teamgame->game->name }}部門~</span>
                </div>
            </div>
            @if(isset($child->users[0]))
            <div class="flex3">
                <div class="item-1">
                    <span class="name">メンバー</span>
                </div>
                <div class="item-2">
                    @foreach($child->users as $member)
                    @if($member->leader == '0')
                    <div class="item-3">
                        <span class="name">{{ $member->user_name }}<i class="fas fa-crown"></i></span>
                    </div>
                    @endif
                    @if(!isset($member->leader))
                    <div class="item-3">
                        <span class="name">{{ $member->user_name }}</span>
                    </div>
                    @endif
                    @endforeach
                </div>
            </div>
            @endif
            @if((isset($user->team_id) && $user->leader == '0') || ($child->id == $user->child_id && $user->leader == '0'))
            <div class="item-5">
                <a href="{{ route('routeMyTeamChild',['child'=>$child->id] )}}" class="btn">変更する</a>
            </div>
            @endif
        </div>
        @endforeach
    </div>
    @endif

    <div id="recruit">
        <div class="team-rec">
            <span class="bosyu">マイチーム募集</span>
        </div>

        @if(!isset($recruits[0]))
        <div class="recbox">
            <span class="no-rec">募集をしてません。</span>
        </div>
        @endif


        @foreach($recruits as $recruit)
        @if(is_null($recruit->staff_id))
        <div class="flex2">
            <div class="item-1">
                <span class="name">募集：選手</span>
                @if($recruit->team->proama == '0')
                <span class="name">タイトル名：{{ $recruit->game->name }}</span>
                @endif
            </div>
            <div class="item-2">
                <span class="name">ポジション：{{ $recruit->position->name }}</span>
                @if(isset($recruit->rank_status))
                <span class="name">ランク：{{ $recruit->rank->name }}以上</span>
                @else
                <span class="name">ランク：{{ $recruit->rank->name }}</span>
                @endif
            </div>
            <div class="item-3">
                <span class="name">年齢：{{ $recruit->age }}</span>
                <span class="name">ｹﾞｰﾐﾝｸﾞﾊｳｽ：{{ $recruit->house }}</span>
                <span class="name">リーダー名：{{ $recruit->team->top }}</span>
            </div>
            <div class="item-4">
                <span class="name">説明文：{{ $recruit->description }}</span>
            </div>
            @if(isset($user->team_id) && $user->leader == "0")
            <div class="item-5">

                <span class="btn" onclick="event.preventDefault();
                    document.getElementById('delete{{ $recruit->id }}').submit();">消去する</span>
                <form id="delete{{ $recruit->id }}" action="{{ route('routeMyTeam') }}" method="POST" style="display: none;">
                    @csrf
                    <input type="hidden" name="delete" value="{{ $recruit->id }}">
                </form>

                <a href="{{ route('routeMyTeamRecruit',['recruit'=>$recruit->id] )}}" class="btn">変更する</a>
            </div>
            @endif
        </div>
        @endif
        @endforeach

        @foreach($recruits as $recruit)
        @isset($recruit->staff_id)
        <div class="flex2">
            <div class="item-1">
                <span class="name">募集：{{ $recruit->staff->name }}</span>
            </div>
            <div class="item-2">
                <span class="name">仕事内容：{{ $recruit->content }}</span>
            </div>
            <div class="item-3">
                <span class="name">必須スキル：{{ $recruit->ab_skill }}</span>
                <span class="name">歓迎スキル：{{ $recruit->wel_skill }}</span>
            </div>
            <div class="item-4">
                <span class="name">説明文：{{ $recruit->description }}</span>
            </div>
            @if(isset($user->team_id) && $user->leader == "0")
            <div class="item-5">
                <span class="btn" onclick="event.preventDefault();
                    document.getElementById('delete{{ $recruit->id }}').submit();">消去する</span>
                <form id="delete{{ $recruit->id }}" action="{{ route('routeMyTeam') }}" method="POST" style="display: none;">
                    @csrf
                    <input type="hidden" name="delete" value="{{ $recruit->id }}">
                </form>

                <a href="{{ route('routeMyTeamRecruit',['recruit'=>$recruit->id] )}}" class="btn">変更する</a>
            </div>
            @endif
        </div>
        @endisset
        @endforeach

        <div class="links">
            {{ $recruits->links() }}
        </div>
    </div>
</div>

@endsection