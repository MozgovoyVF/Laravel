@extends('layout.master')

@section('content')
    <div class="col-md-8">
        <h3 class="pb-4 mb-4 fst-italic border-bottom">
            Создание статьи
        </h3>

        @include('layout.errors')

        <form method="POST" action="/articles">
            @csrf

            <div class="mb-3">
                <label for="inputCode" class="form-label">Символьный код статьи</label>
                <input type="text" class="form-control" name="code" id="inputCode"
                    placeholder="Введите символьный код статьи" value="{{ old('code') }}">
            </div>
            <div class="mb-3">
                <label for="inputTitle" class="form-label">Название статьи</label>
                <input type="text" class="form-control" name="title" id="inputTitle"
                    placeholder="Введите название статьи" value="{{ old('title') }}">
            </div>
            <div class="mb-3">
                <label for="inputDescription" class="form-label">Краткое описание статьи</label>
                <input type="text" class="form-control" name="description" id="inputDescription"
                    placeholder="Введите описание" value="{{ old('description') }}">
            </div>
            <div class="mb-3">
                <label for="inputContent" class="form-label">Содержание статьи</label>
                <input type="text" class="form-control" name="content" id="inputContent"
                    placeholder="Введите текст статьи" value="{{ old('content') }}">
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="inputPublished" checked="{{ old('published') }}">
                <label class="form-check-label" name="published" for="inputPublished">Опубликовать</label>
            </div>
            <button type="submit" class="btn btn-primary">Создать статью</button>
        </form>
    </div>
@endsection
