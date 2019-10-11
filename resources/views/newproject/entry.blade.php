@extends("layouts,standard")

@section("stylesheet")
<link rel="stylesheet" href="{{ asset('css/entry.css') }}">
@endsection

@section("title","選手登録")

@section("h2","選手登録")

@section("content")
<form method="post" action="">
    <label>氏名:<input type="text" name="name"></label>
    <label>誕生日</label>
    <label>IGN:<input type="text" name="nickname" placeholder="ゲーム内での名前"></label>
    <span>プレイゲーム</span>
    <select name="gamename">
        <option value="未選択">未選択</option>
    </select>
    <span>ポジション(複数選択可)</span>
    <select name="position">
        <option value="未選択">未選択</option>
    </select>
    <span>ランク</span>
    <select name="rank">
        <option value="未選択">未選択</option>
    </select>
</form>
@endsection 