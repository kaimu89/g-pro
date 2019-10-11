@extends("layouts.nomal")

@section("stylesheet")
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
@endsection

@section("content")
<div class="contain">
    <div class="screen">
        <img src="/logo/test.jpeg">
        <img src="/logo/test.jpeg">
        <img src="/logo/test.jpeg">
        <img src="/logo/test.jpeg">
    </div>

    <div class="ads">
        <img src="/logo/test.jpeg">
        <img src="/logo/test.jpeg">
        <img src="/logo/test.jpeg">
        <img src="/logo/test.jpeg">
    </div>
</div>

@endsection

@section("script")
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script src="{{ asset('js/index.js') }}"></script>
@endsection