@extends("layouts.standard")

@section("stylesheet")
<link rel="stylesheet" href="{{ asset('css/recruit.css') }}">
@endsection

@section("title",'マイチーム')

@section("h2","マイチーム募集変更")

@section("content")

<div class="add">
    @isset($recruit->staff_id)
    <h3 class="title">スタッフ</h3>
    @elseif(isset($recruit->position_id) && isset($recruit->rank_id) && $recruit->team->proama == 'プロ')
    <h3 class="title">プロチーム</h3>
    @elseif(isset($recruit->position_id) && isset($recruit->rank_id))
    <h3 class="title">プロチーム</h3>
    @endif

    <form action="{{ route('routeMyTeamRecruit',['recruit'=>$recruit->id] )}}" method="post">
        @csrf


        <div class="flex">
            <div class="item-1">
                <span class="name">チーム名：</span>
            </div>
            <div class="item-2">
                <span class="text">{{ $recruit->team->name }}</span>
            </div>
        </div>

        <div class="flex">
            <div class="item-1">
                <span class="name">チームタイトル名：</span>
            </div>
            <div class="item-2">
                @isset($recruit->game->name)
                <span class="text">{{ $recruit->game->name }}</span>
                @endisset
            </div>
        </div>


        @if(isset($recruit->position_id) && isset($recruit->rank_id))

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
                <select name="position" class="select">
                    <option value="{{ $recruit->position_id }}">{{ $recruit->position->name }}</option>
                    @foreach($positions as $position)
                    @if($position->id != $recruit->position_id)
                    <option value=" {{ $position->id }}" {{ old('position') == $position->id ? 'selected' : '' }}>{{ $position->name }}</option>
                    @endif
                    @endforeach
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
                <select name="rank" class="select">
                    @foreach($ranks as $rank)
                    @if($rank->id == $recruit->rank_id && isset($recruit->rank_status))
                    <option value="{{ $rank->id }}up" {{ old('rank') == $rank->id ? 'selected' : '' }} selected>{{ $rank->name }}以上</option>
                    <option value="{{ $rank->id }}" {{ old('rank') == $rank->id ? 'selected' : '' }}>{{ $rank->name }}</option>
                    @elseif($rank->id == $recruit->rank_id)
                    <option value="{{ $rank->id }}up" {{ old('rank') == $rank->id ? 'selected' : '' }}>{{ $rank->name }}以上</option>
                    <option value="{{ $rank->id }}" {{ old('rank') == $rank->id ? 'selected' : '' }} selected>{{ $rank->name }}</option>
                    @elseif($rank->id != $recruit->rank_id)
                    <option value="{{ $rank->id }}up" {{ old('rank') == $rank->id ? 'selected' : '' }}>{{ $rank->name }}以上</option>
                    <option value="{{ $rank->id }}" {{ old('rank') == $rank->id ? 'selected' : '' }}>{{ $rank->name }}</option>
                    @endif
                    @endforeach
                </select>
            </div>
        </div>


        @if($recruit->team->proama == 'プロ')

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
                    @foreach($ages as $key => $age)
                    @if($age == $ages[$recruit->age])
                    <option value="{{ $key }}" selected>{{ $age }}</option>
                    @elseif($age != $ages[$recruit->age])
                    <option value="{{ $key }}">{{ $age }}</option>
                    @endif
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
                <label class="radio1">あり<input type="radio" name="house" value="0" {{ old('house') == '0' ? 'checked' : '' }}{{ $recruit->house == 0 ? 'checked' : '' }}></label>
                <span>|</span>
                <label class="radio2">なし<input type="radio" name="house" value="1" {{ old('house') == '0' ? 'checked' : '' }}{{ $recruit->house == 1 ? 'checked' : '' }}></label>
            </div>
        </div>

        @endif

        @endif

        @isset($recruit->staff_id)

        @if($errors->has("staff"))
        <div class="error-pc">
            <small class="small">※{{$errors->first("staff")}}</small>
        </div>
        @endif
        <div class="flex">
            <div class="item-1">
                <span class="name">職種：</span>
                @if($errors->has("staff"))
                <div class="error-mob">
                    <small class="small">※{{$errors->first("staff")}}</small>
                </div>
                @endif
            </div>
            <div class="item-2">
                <select name="staff" class="select">
                    <option value="{{ $recruit->staff->id }}">{{ $recruit->staff->name }}</option>
                    @foreach($staffs as $staff)
                    @if($staff->id != $recruit->staff->id)
                    <option value="{{ $staff->id }}" {{ old('staff') == $staff->id ? 'selected' : '' }}>{{ $staff->name }}</option>
                    @endif
                    @endforeach
                </select>
            </div>
        </div>

        @if($errors->has("content"))
        <div class="error-pc">
            <small class="small">※{{$errors->first("content")}}</small>
        </div>
        @endif
        <div class="flex">
            <div class="item-1">
                <span class="name">仕事内容：</span>
                @if($errors->has("content"))
                <div class="error-mob">
                    <small class="small">※{{$errors->first("content")}}</small>
                </div>
                @endif
            </div>
            <div class="item-2">
                <input type="text" name="content" class="select" value="{{ old('content',$recruit->content) }}">
            </div>
        </div>

        @if($errors->has("ab_skill"))
        <div class="error-pc">
            <small class="small">※{{$errors->first("ab_skill")}}</small>
        </div>
        @endif
        <div class="flex">
            <div class="item-1">
                <span class="name">必須スキル：</span>
                @if($errors->has("ab_skill"))
                <div class="error-mob">
                    <small class="small">※{{$errors->first("ab_skill")}}</small>
                </div>
                @endif
            </div>
            <div class="item-2">
                <input type="text" name="ab_skill" class="select" value="{{old('ab_skill',$recruit->ab_skill)}}">
            </div>
        </div>




        @if($errors->has("wel_skill"))
        <div class="error-pc">
            <small class="small">※{{$errors->first("wel_skill")}}</small>
        </div>
        @endif
        <div class="flex">
            <div class="item-1">
                <span class="name">歓迎スキル：</span>
                @if($errors->has("wel_skill"))
                <div class="error-mob">
                    <small class="small">※{{$errors->first("wel_skill")}}</small>
                </div>
                @endif
            </div>
            <div class="item-2">
                <input type="text" name="wel_skill" class="select" value="{{ old('wel_skill',$recruit->wel_skill) }}">
            </div>
        </div>


        @endisset

        @if($errors->has("description"))
        <div class="error-pc">
            <small class="small">※{{$errors->first("description")}}</small>
        </div>
        @endif
        <div class="flex">
            <div class="item-1">
                <span class="name">募集文：</span>
                @if($errors->has("description"))
                <div class="error-mob">
                    <small class="small">※{{$errors->first("description")}}</small>
                </div>
                @endif
            </div>
            <div class="item-2">
                <textarea name="description" cols="35" rows="10" class="body">{{ old('description',$recruit->description) }}</textarea>
            </div>
        </div>


        <div class="item-5">
            <a href="{{ route('routeMyTeam') }}" class="btn cancel">戻る</a>
            <input type="submit" value="変更" class="btn">
        </div>

    </form>
</div>

@endsection