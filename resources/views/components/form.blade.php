<div>
    @props(['method', 'action', 'type', 'article'])
    <form method="POST" id="form" action="{{ $action }}">
        @csrf
        @method($method)

        <div class="mb-3">
            <label for="inputCode" class="form-label">Символьный код статьи</label>
            <input type="text" class="form-control" name="code" id="inputCode"
                placeholder="Введите символьный код статьи" autofocus
                value="@if(old('code')) {{ trim(old('code')) }} @else{{ trim(@$article->code) }}@endif">
        </div>
        <div class="mb-3">
            <label for="inputTitle" class="form-label">Название статьи</label>
            <input type="text" class="form-control" name="title" id="inputTitle"
                placeholder="Введите название статьи"
                value="@if(old('title')) {{ trim(old('title')) }} @else{{ trim(@$article->title) }}@endif">
        </div>
        <div class="mb-3">
            <label for="inputDescription" class="form-label">Краткое описание статьи</label>
            <input type="text" class="form-control" name="description" id="inputDescription"
                placeholder="Введите описание"
                value="@if(old('description')) {{ trim(old('description')) }} @else{{ trim(@$article->description) }}@endif">
        </div>
        <div class="mb-3">
            <label for="inputContent" class="form-label">Содержание статьи</label>
            <input type="text" class="form-control" name="content" id="inputContent"
                placeholder="Введите текст статьи"
                value="@if(old('content')) {{ trim(old('content')) }} @else{{ trim(@$article->content) }}@endif">
        </div>
        {{$slot}}
        <div class="mb-3 form-check">
            <input type="checkbox" name="published" class="form-check-input" id="inputPublished"
                @if (old('published')) {{ old('published') ? 'checked' : '' }}
            @else
                {{ @$article->published ? 'checked' : '' }} @endif>
            <label class="form-check-label" for="inputPublished">Опубликовать</label>
        </div>
        <button type="submit" class="btn btn-primary mb-3">{{ $type }}</button>
    </form>
</div>
