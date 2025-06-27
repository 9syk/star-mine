@extends('layouts.app')
@section('content')
<article class="article-detail">
    <h1 class="article-title">{{ $article->title }}</h1>
    <div class="article-info">{{ $article->created_at }}</div>
    <div class="article-body">{!! nl2br(e($article->body)) !!}</div>
     <div class="article-control">
        <a href="{{ route('articles.edit', $article) }}">編集</a>
    </div>
</article>
@endsection