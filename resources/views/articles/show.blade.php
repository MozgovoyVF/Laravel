@extends('layout.master')

@section('title')
    {{ __($article->title) }}
@endsection

@section('content')
    <div class="col-md-8">
        <h3 class="pb-4 mb-4 fst-italic border-bottom text-lg">
            {{ $article->title }}
            {{-- @admin
      <a href="{{route('admin.article.show', ['article' => $article->code])}}/edit" class="text-sm text-red-500">Редактировать статью</a>
    @endadmin
    @canany(['update', 'delete'], $article)
      <a href="{{route('article.show', ['article' => $article->code])}}/edit" class="text-sm text-red-500">Редактировать статью</a>
    @endcanany --}}
            @canany(['admin'])
                <a href="{{ route('admin.article.show', ['article' => $article->code]) }}/edit"
                    class="text-sm text-red-500">Редактировать статью</a>
            @elsecanany(['update', 'delete'], $article)
                <a href="{{ route('article.show', ['article' => $article->code]) }}/edit"
                    class="text-sm text-red-500">Редактировать статью</a>
            @endcanany
        </h3>

        <p class="blog-post-meta">{{ $article->created_at->toFormattedDateString() }}</p>

        @include('articles.tags', ['tags' => $article->tags])

        {{ $article->content }}

        <hr>

        @each('articles.history', $article->history, 'history', 'articles.history_empty')

        @each('articles.comments', $article->comments, 'comment', 'articles.comment_empty')

        <hr>

        @auth
            @include('layout.errors')

            <form method="POST" action="{{ route('article.comments.store', $article->code) }}">
                @csrf

                <div class="mb-3">
                    <label for="inputComment" class="form-label text-lg mt-2"></label>
                    <input type="text" class="form-control" name="message" id="inputComment"
                        placeholder="Введите Ваш комментарий">
                </div>
                <button type="submit" class="btn btn-primary mb-3">Отправить</button>
            </form>
            <hr>
        @endauth

        <a href="/"
            class="text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">Вернуться
            к списку статей</a>
    </div>
@endsection
