@extends("layouts.standard")

@section("stylesheet")
<link rel="stylesheet" href="{{ asset('css/confirm.css') }}">
@endsection

@section("title","確認フォーム")

@section("h2","確認フォーム")

@section("content")
<table class="form">
    <tr>
        <th>名前：</th>
        <td>{{ $name }}</td>
    </tr>
    <tr>
        <th>メールアドレス：</th>
        <td>{{ $mail }}</td>
    </tr>
    <tr>
        <th>お問い合わせの種類：</th>
        <td>{{ $category }}</td>
    </tr>
    <tr>
        <th>お問い合わせ名：</th>
        <td>{{ $title }}</td>
    </tr>
    <tr>
        <th class="textarea">お問い合わせ内容：</th>
        <td>{{ $body }}</td>
    </tr>
</table>
@endsection 