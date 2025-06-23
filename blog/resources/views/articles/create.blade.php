@extends('layouts.app')
@section('content')
<form action="{{ route('articles.store') }}" method="post">
@csrf 
<dl class="form-list">
    <dt>タイトル</dt>
    <dd><input type="text" name="title"></dd>
    <dt>本文</dt>
    <dd><textarea name="body" rows="5"></textarea></dd>
</dl>
<button type="submit">投稿する</button>
<a href="{{ route('articles.index') }}">キャンセル</a>
</form>
@endsection()