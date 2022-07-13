@extends('layout.master')

@section('title')
  {{__($article->title)}}
@endsection

@section('content')
<div class="col-md-8">
  <h3 class="pb-4 mb-4 fst-italic border-bottom">
    {{$article->title}}
    <a href="{{route('article.show', ['article' => $article->code])}}/edit">Редактировать статью</a>
  </h3>

  <p class="blog-post-meta">{{$article->created_at->toFormattedDateString()}}</p>

  {{$article->content}}

  <hr>

  <a href="/">Вернуться к списку статей</a>
</div>
@endsection