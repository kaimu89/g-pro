<div class="header">
    <h1 class="header-h1"><a class="homelink" href="{{ route('routeIndex') }}">G-pro</a></h1>

    <div class="app-bell">
        <i class="far fa-bell"></i><i class="fas fa-exclamation-circle"></i>
    </div>
    <div class="font">
        <i class="fa fa-bars fa-2x"></i>
    </div>

    <div class="modalbox">
        <div class="modal none"></div>

        <div class="app-noti none">
            <div class="noti m"><span class="noti-l">まだ通知はありません</span></div>
        </div>

        <nav class="app none">
            <ul class="i-menu-second">

                @if(Auth::check())
                <li class="i-menu-list use"><a href="#" class="i-link">{{ Auth::user()->user_name }}</a></li>
                <li class="i-menu-list r3 none"><a href="{{ route('routeProfile') }}" class="i-link">プロフィール</a></li>
                @isset(Auth::user()->player)
                <li class="i-menu-list r3 none"><a href="{{ route('routeMyPlayer') }}" class="i-link">選手登録情報</a></li>
                @endisset
                @if(isset(Auth::user()->team_id) || isset(Auth::user()->child_id))
                <li class="i-menu-list r3 none"><a href="{{ route('routeMyTeam') }}" class="i-link">マイチーム</a></li>
                @endif
                <li class="i-menu-list r3 none"><a href="" class="i-link">設定</a></li>
                <li class="i-menu-list r3 none">
                    <a href="#" class="i-link" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        ログアウト</a></li>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                @else
                <li class="i-menu-list"><a href="{{ route('login') }}" class="i-link">ログイン</a></li>
                @endif

                <li class="i-menu-list"><a href="{{ route('routeTeam') }}" class="i-link">チーム一覧</a></li>
                <li class="i-menu-list"><a href="{{ route('routeGame') }}" class="i-link">ゲーム一覧</a></li>
                <li class="i-menu-list"><a href="{{ route('routePlayer') }}" class="i-link">プレイヤーを探す</a></li>
                <li class="i-menu-list"><a href="{{ route('routeFindTeam' )}}" class="i-link">チームを探す</a></li>

                @if (Auth::check())
                <li class="i-menu-list regi"><a href="#" class="i-link">登録</a></li>
                @else
                <li class="i-menu-list regi"><a href="{{ route('login') }}" class="i-link">登録</a></li>
                @endif

                @if (Auth::check())

                @isset(Auth::user()->player)
                <li class="i-menu-list r1 none"><small class="re-list"><a href="{{ route('routeMyPlayer') }}" class="i-link">選手登録</a></small></li>
                @endif
                @isset(Auth::user()->team)
                <li class="i-menu-list r1 none"><small class="re-list"><a href="{{ route('routeAddPro') }}" class="i-link">チーム登録</a></small></li>
                @endif

                @endif

                @if(Auth::check())

                @if(isset(Auth::user()->team))
                <li class="i-menu-list recr"><a href="#" class="i-link">募集</a></li>
                @else
                <li class="i-menu-list recr"><a href="{{ route('routeAddTeam') }}" class="i-link">募集</a></li>
                @endif

                @else
                <li class="i-menu-list recr"><a href="{{ route('login') }}" class="i-link">募集</a></li>
                @endif



                @if(Auth::check())

                @if((isset(Auth::user()->team->proama)) && (Auth::user()->team->proama == 'プロ') && Auth::user()->leader == '0')
                <li class="i-menu-list r2 none"><small class="re-list"><a href="{{ route('routeRecruitTeamPro') }}" class="i-link">プロ選手募集</a></small></li>
                @endif

                @if((isset(Auth::user()->team->proama)) && (Auth::user()->team->proama == '一般') && Auth::user()->leader == '0')
                <li class="i-menu-list r2 none"><small class="re-list"><a href="{{ route('routeRecruitTeamAma') }}" class="i-link">一般選手募集</a></small></li>
                @endif

                @if(isset(Auth::user()->team->proama) && Auth::user()->leader == '0')
                <li class="i-menu-list r2 none"><small class="re-list"><a href="{{ route('routeRecruitStaff') }}" class="i-link">スタッフ募集</a></small></li>
                @endif

                @endif
                <li class="i-menu-list"><a href="{{ route('routeContact') }}" class="i-link">お問い合わせ</a></li>
            </ul>
        </nav>
    </div>


    <nav class="pc">
        <ul class="homenav">
            <li class="navmenu">
                <a href="{{ route('routeTeam') }}" class="homelink">チーム一覧</a>
            </li>
            <li class="navmenu">
                <a href="{{ route('routeGame') }}" class="homelink">ゲーム一覧</a>
            </li>
            <li class="navmenu">
                <a href="{{ route('routePlayer') }}" class="homelink">ﾌﾟﾚｲﾔｰを探す</a>
            </li>
            <li class="navmenu">
                <a href="{{ route('routeFindTeam' )}}" class="homelink">チームを探す</a>
            </li>
            <li class="navmenu">
                @if (Auth::check())
                <a href="#" class="homelink">登録</a>
                @else
                <a href="{{ route('login') }}" class="homelink">登録</a>
                @endif
                @if (Auth::check())
                <ul class="menu_second">
                    <li class="menu_second_list">
                        <a href="{{ route('routeAddPlayer') }}" class="menu_second_a">選手登録</a>
                    </li>
                    <li class="menu_second_list">
                        <a href="{{ route('routeAddTeam') }}" class="menu_second_a">チーム登録</a>
                    </li>
                </ul>
                @endif
            </li>
            <li class="navmenu">
                @if(Auth::check())

                @if(isset(Auth::user()->team))
                <a href="#" class="homelink">募集</a>
                @elseif(isset(Auth::user()->child))
                <a href="{{ route('routeMyTeam') }}#recruit" class="homelink">募集</a>
                @else
                <a href="{{ route('routeAddTeam') }}" class="homelink">募集</a>
                @endif

                @else
                <a href="{{ route('login') }}" class="homelink">募集</a>
                @endif
                <ul class="menu_second">
                    @if (Auth::check())

                    @if(isset(Auth::user()->team->proama) && Auth::user()->team->proama == '0' && Auth::user()->leader == '0')
                    <li class="menu_second_list"><a href="{{ route('routeRecruitTeamPro') }}" class="menu_second_a">プロ選手募集</a></li>
                    @endif

                    @if((isset(Auth::user()->team->proama)) && (Auth::user()->team->proama == 1) && Auth::user()->leader == '0')
                    <li class="menu_second_list"><a href="{{ route('routeRecruitTeamAma') }}" class="menu_second_a">一般選手募集</a></li>
                    @endif

                    @if(isset(Auth::user()->team->proama) && Auth::user()->leader == '0')
                    <li class="menu_second_list"><a href="{{ route('routeRecruitStaff') }}" class="menu_second_a">スタッフ募集</a></li>
                    @endif

                    @endif
                </ul>
            </li>
            <li class="navmenu">
                <a href="{{ route('routeContact') }}" class="homelink">お問い合わせ</a>
            </li>
        </ul>
    </nav>



    <div class="pc-bell">
        <i class="far fa-bell"></i><i class="fas fa-exclamation-circle"></i>
    </div>

    <div class="pc-notice none">
        <div class="pc-noti">
            <div class="noti m"><span class="noti-l">まだ通知はありません</span></div>
        </div>
    </div>


    @if(Auth::check())
    <div class="user">
        <span class="u">{{ Auth::user()->user_name }}</span><i class="fa fa-caret-down"></i>
    </div>
    @else
    <div class="login">
        <a href="{{ route('login') }}" class="log-link">Login</a>
    </div>
    @endif

    <div class="u-box ">
        <ul class="u-menu">
            <li class="u-list"><a href="{{ route('routeProfile') }}" class="u-link">プロフィール</a></li>
            @isset(Auth::user()->player)
            <li class="u-list"><a href="{{ route('routeMyPlayer') }}" class="u-link">選手登録情報</a></li>
            @endisset
            @if(isset(Auth::user()->team_id) || isset(Auth::user()->child_id))
            <li class="u-list"><a href="{{ route('routeMyTeam') }}" class="u-link">マイチーム</a></li>
            @endif
            <li class="u-list"><a href="" class="u-link">設定</a></li>
            <li class="u-list">
                <a href="#" class="u-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">ログアウト</a></li>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </ul>
    </div>


</div>