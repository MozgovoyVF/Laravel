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
            <div class="tags__container">
                @if ($news->tags ?? old('tags'))
                    @php
                        $tags = $news->tags ?? old('tags');
                    @endphp
                    @foreach ($tags as $tag)
                        @if ($loop->index === 0)
                            <label for="inputTag{{ $loop->index }}" id="labelTag" class="form-label">Список тегов</label>
                        @endif
                        <input type="text" class="form-control mb-3" name="tags[]" id="inputTag{{ $loop->index }}"
                            placeholder="Введите название тега" value="@php $tag = $tag->name ?? $tag; echo $tag @endphp">
                    @endforeach
                @endif
            </div>
            <button type="button" id="tagBtn" class="btn btn-primary mb-3">Добавить тег</button>
            <button @disabled($news->tags->count() === 0) type="button" id="tagBtnDelete" class="btn btn-danger mb-3">Удалить
                тег</button>
            <br>
        </x-form-news>

        <form action="{{ route('admin.news.destroy', ['news' => $news->id]) }}" method="post">
            @csrf
            @method('DELETE')
            <button type="submit" onclick="confirm('Вы уверены, что хотите удалить новость?')"
                class="btn btn-danger mb-3">Удалить новость</button>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        let btn = document.querySelector('#tagBtn');
        let btnDelete = document.querySelector('#tagBtnDelete');
        let form = document.querySelector('#form');
        let container = document.querySelector('.tags__container');

        btn.addEventListener('click', () => {
            let input = document.createElement('input')
            input.setAttribute('type', 'text');
            input.setAttribute('name', 'tags[]');
            input.setAttribute('id', `inputTag`);
            input.setAttribute('placeholder', 'Введите название тега');
            input.classList.add('form-control', 'mb-3');

            if (!document.querySelector('#labelTag')) {
                let label = document.createElement('label');
                label.setAttribute('for', 'inputTag')
                label.setAttribute('id', 'labelTag')
                label.classList.add('form-label', 'mb-3');
                label.textContent = 'Список тегов';

                container.append(input);
                container.prepend(label);
            } else {
                container.append(input);
            }

            if (container.children.length) {
                btnDelete.disabled = false;
            }
        })

        btnDelete.addEventListener('click', (e) => {
            if (container.children.length === 2) {
                container.children[0].remove();
                container.children[0].remove();
                btnDelete.disabled = true;
            } else {
                container.lastChild.remove();
            }
        })
    </script>
@endpush
