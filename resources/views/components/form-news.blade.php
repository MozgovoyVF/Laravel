<div>
    @props(['method', 'action', 'type', 'news'])
    <form method="POST" id="form" action="{{ $action }}">
        @csrf
        @method($method)

        <div class="mb-3">
            <label for="inputTitle" class="form-label">Название новости</label>
            <input type="text" class="form-control" name="title" id="inputTitle"
                placeholder="Введите название новости"
                value="@if(old('title')) {{ trim(old('title')) }} @else{{ trim(@$news->title) }}@endif">
        </div>
        <div class="mb-3">
            <label for="inputDescription" class="form-label">Краткое описание новости</label>
            <input type="text" class="form-control" name="description" id="inputDescription"
                placeholder="Введите описание"
                value="@if(old('description')) {{ trim(old('description')) }} @else{{ trim(@$news->description) }}@endif">
        </div>
        <div class="mb-3">
            <label for="inputContent" class="form-label">Содержание новости</label>
            <input type="text" class="form-control" name="content" id="inputContent"
                placeholder="Введите текст новости"
                value="@if(old('content')) {{ trim(old('content')) }} @else{{ trim(@$news->content) }}@endif">
        </div>
        {{$slot}}
        <button type="submit" class="btn btn-primary mb-3">{{ $type }}</button>
    </form>
</div>
