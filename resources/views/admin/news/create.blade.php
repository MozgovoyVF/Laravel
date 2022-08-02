@extends('layout.admin')

@section('title')
    {{__('Создание новости')}}
@endsection

@section('content')
    <div class="col-md-8">
        <h3 class="pb-4 mb-4 fst-italic border-bottom">
            Создание статьи
        </h3>

        @include('layout.errors')

        <x-form-news action="{{ route('admin.news.store') }}" :news='null' method="POST" type="Создать новость">
        </x-form-news>

    </div>
@endsection
