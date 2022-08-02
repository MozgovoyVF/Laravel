@extends('layout.admin')

@section('title')
    {{ __($news->title) }}
@endsection

@section('content')
    <div class="col-md-8">
        <h3 class="pb-4 mb-4 fst-italic border-bottom text-lg">
            {{ $news->title }}
            <a href="{{ route('admin.news.edit', ['news' => $news->id]) }}"
                class="text-sm text-red-500">Редактировать новость</a>
        </h3>

        <p class="blog-post-meta">{{ $news->created_at->toFormattedDateString() }}</p>

        {{ $news->content }}

        <hr>

        <a href="{{route('admin.news.index')}}"
            class="text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">Вернуться
            к списку новостей</a>
    </div>
@endsection
