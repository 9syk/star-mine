@extends('layouts.app')
@section('content')
<div class="welcome">
    <h1>商品管理システム</h1>
    <a class="btn" href="{{ route('register') }}">会員登録</a>
    <a class="btn" href="{{ route('login') }}">ログイン</a>
</div>
@endsection()