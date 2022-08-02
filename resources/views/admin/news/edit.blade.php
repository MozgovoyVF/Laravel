@extends('layout.admin')

@section('title')
    {{ __('Редактирование новости') }}
@endsection

@section('content')
    <div class="col-md-8">
        <h3 class="pb-4 mb-4 fst-italic border-bottom">
            Редактировние статьи
        </h3>

        @include('layout.errors')

        <x-form-news action="{{ route('admin.news.update', ['news' => $news->id]) }}" :news="$news" method="PATCH"
            type="Изменить новость">
        </x-form-news>

        <form action="{{ route('admin.news.destroy', ['news' => $news->id]) }}" method="post">
            @csrf
            @method('DELETE')
            <button type="submit" onclick="confirm('Вы уверены, что хотите удалить новость?')"
                class="btn btn-danger mb-3">Удалить новость</button>
        </form>
    </div>
@endsection
