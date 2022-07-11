@extends('layout.master')

@section('title')
    {{__('Редактирование статьи')}}
@endsection

@section('content')
    <div class="col-md-8">
        <h3 class="pb-4 mb-4 fst-italic border-bottom">
            Редактировние статьи
        </h3>

        @include('layout.errors')

        <x-form action="{{route('article.update', ['article' => $article->code])}}" :article="$article" method="PATCH" type="Изменить статью"></x-form>

        {{-- <form method="POST" action="{{route('article.update', ['article' => $article->code])}}">
            @csrf
            @method('PATCH')

            <div class="mb-3">
                <label for="inputCode" class="form-label">Символьный код статьи</label>
                <input type="text" class="form-control" name="code" id="inputCode"
                    placeholder="Введите символьный код статьи"
                    value="@if (old('code')) {{ old('code') }} @else{{ $article->code }} @endif">
            </div>
            <div class="mb-3">
                <label for="inputTitle" class="form-label">Название статьи</label>
                <input type="text" class="form-control" name="title" id="inputTitle"
                    placeholder="Введите название статьи"
                    value="@if (old('title')) {{ old('title') }} @else {{ $article->title }} @endif">
            </div>
            <div class="mb-3">
                <label for="inputDescription" class="form-label">Краткое описание статьи</label>
                <input type="text" class="form-control" name="description" id="inputDescription"
                    placeholder="Введите описание"
                    value="@if (old('description')) {{ old('description') }} @else {{ $article->description }} @endif">
            </div>
            <div class="mb-3">
                <label for="inputContent" class="form-label">Содержание статьи</label>
                <input type="text" class="form-control" name="content" id="inputContent"
                    placeholder="Введите текст статьи"
                    value="@if (old('content')) {{ old('content') }} @else {{ $article->content }} @endif">
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" name="published" class="form-check-input" id="inputPublished"
                @if (old('published'))
                    {{old('published') ? 'checked' : ''}}
                @else
                    {{$article->published ? 'checked' : ''}}
                @endif>
                <label class="form-check-label" for="inputPublished">Опубликовать</label>
            </div>
            <button type="submit" class="btn btn-primary mb-3">Изменить статью</button>
        </form> --}}
        <form action="{{route('article.destroy', ['article' => $article->code])}}" method="post">
            @csrf
            @method('DELETE')
            <button type="submit" onclick="confirm('Вы уверены, что хотите удалить статью?')" class="btn btn-danger mb-3">Удалить статью</button>
        </form>
    </div>
@endsection
