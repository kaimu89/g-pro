@extends("layouts.standard")

@section("stylesheet")
<link rel="stylesheet" href="{{ asset('css/team.css') }}">
@endsection

@section("title","team")

@section("h2","チーム一覧")

@section("content")

<div class="flex">
    @foreach ($teams as $team)
    <div class="team">
        <img src="{{ $team->picture }}" alt="チーム画像" class="team-img">
        <span class="team-name"><a href="{{ route('routeExplain',['name'=>$team->name] )}}" class="team-link">
                {{ $team->name }}
                @if($team->proama == '0')
                ［プロ］
                @elseif($team->proama == '1')
                [一般]
                @endif
            </a></span>
        @php
        $teamgames = $team->teamgames;
        @endphp
        <div class="image-all">
            @foreach ($teamgames as $teamgame)
            <img src="{{ $teamgame->game->picture }}" alt="ゲーム画像" class="icon-picture">
            @endforeach
        </div>
    </div>
    @endforeach
</div>
<div class="links">
    {{ $teams->links() }}
</div>
@endsection