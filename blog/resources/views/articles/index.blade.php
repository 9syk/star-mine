@extends('layouts.app')
@section('content')
<p><a href="{{ route('articles.create') }}">記事を書く</a></p>
@foreach ($articles as $article)
<article class="article-item">
    <div class="article-title">{{ $article->title }}</div>
    <div class="article-body">{{ $article->body }}</div>
</article>
@endforeach
@endsection()