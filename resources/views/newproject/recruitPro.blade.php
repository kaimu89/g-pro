@extends("layouts.standard")

@section("stylesheet")
<link rel="stylesheet" href="{{ asset('css/recruit.css') }}">
@endsection

@section("title","募集登録")

@section("h2","メンバー募集登録")

@section("content")

<div class="add">
    <h3 class="title">プロチーム</h3>
    <form action="{{ route('routeRecruitTeamPro')}}" method="post">
        @csrf

        <div class="flex">
            <div class="item-1">
                <span class="name">チーム名：</span>
            </div>
            <div class="item-2">
                @isset($user->team->name)
                <span class="text">{{ $user->team->name }}</span>
                @endisset
            </div>
        </div>



        @if($errors->has("game"))
        <div class="error-pc">
            <small class="small">※{{$errors->first("game")}}</small>
        </div>
        @endif
        <div class="flex">
            <div class="item-1">
                <span class="name">ゲームタイトル：</span>
                @if($errors->has("game"))
                <div class="error-mob">
                    <small class="small">※{{$errors->first("game")}}</small>
                </div>
                @endif
            </div>
            <div class="item-2">
                <select name="game" class="game select">
                    <option value="">未選択</option>
                    @foreach($teamgames as $teamgame)
                    @php $game = $teamgame->game; @endphp
                    <option value="{{ $game->id }}" {{ old('game') == $game->id ? 'selected' : '' }}>{{ $game->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>



        @if($errors->has("position"))
        <div class="error-pc">
            <small class="small">※{{$errors->first("position")}}</small>
        </div>
        @endif
        <div class="flex">
            <div class="item-1">
                <span class="name">ポジション：</span>
                @if($errors->has("position"))
                <div class="error-mob">
                    <small class="small">※{{$errors->first("position")}}</small>
                </div>
                @endif
            </div>
            <div class="item-2">
                <select name="position" class="position select">
                    <option class="position-0" value="">未選択</option>
                </select>
            </div>
        </div>







        @if($errors->has("rank"))
        <div class="error-pc">
            <small class="small">※{{$errors->first("rank")}}</small>
        </div>
        @endif
        <div class="flex">
            <div class="item-1">
                <span class="name">ランク：</span>
                @if($errors->has("rank"))
                <div class="error-mob">
                    <small class="small">※{{$errors->first("rank")}}</small>
                </div>
                @endif
            </div>
            <div class="item-2">
                <select name="rank" class="rank select">
                    <option class="rank-0" value="">未選択</option>
                </select>
            </div>
        </div>


        @if($errors->has("age"))
        <div class="error-pc">
            <small class="small">※{{$errors->first("age")}}</small>
        </div>
        @endif
        <div class="flex">
            <div class="item-1">
                <span class="name">年齢：</span>
                @if($errors->has("age"))
                <div class="error-mob">
                    <small class="small">※{{$errors->first("age")}}</small>
                </div>
                @endif
            </div>
            <div class="item-2">
                <select name="age" class="select">
                    <option value="0">未選択</option>
                    @foreach($ages as $key => $age)
                    <option value="{{ $key }}">{{ $age }}</option>
                    @endforeach
                </select>
            </div>
        </div>




        @if($errors->has("house"))
        <div class="error-pc">
            <small class="small">※{{$errors->first("house")}}</small>
        </div>
        @endif
        <div class="flex">
            <div class="item-1">
                <span class="name">ゲーミングハウス：</span>
                @if($errors->has("house"))
                <div class="error-mob">
                    <small class="small">※{{$errors->first("house")}}</small>
                </div>
                @endif
            </div>
            <div class="item-2">
                <label class="radio1">あり<input type="radio" name="house" value="0" {{ old('house') == '0' ? 'checked' : '' }}></label>
                <span>|</span>
                <label class="radio2">なし<input type="radio" name="house" value="1" {{ old('house') == '0' ? 'checked' : '' }}></label>
            </div>
        </div>



        @if($errors->has("description"))
        <div class="error-pc">
            <small class="small">※{{$errors->first("description")}}</small>
        </div>
        @endif
        <div class="flex">
            <div class="item-1">
                <span class="name">備考・募集文：</span>
                @if($errors->has("description"))
                <div class="error-mob">
                    <small class="small">※{{$errors->first("description")}}</small>
                </div>
                @endif
            </div>


            <div class="item-2">
                <textarea name="description" cols="35" rows="10" class="body">{{old('description')}}</textarea>
            </div>
        </div>

        <div class="item-5">
            <input type="submit" value="登録" class="btn">
        </div>
    </form>
</div>
@endsection

@section("script")
<script src="{{ asset('js/ALLgame.js') }}" defer></script>
@endsection