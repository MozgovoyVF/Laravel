@extends('layout.master')

@section('title')
    Создание статьи
@endsection

@section('content')
    <div class="col-md-8">
        <h3 class="pb-4 mb-4 fst-italic border-bottom">
            Создание статьи
        </h3>

        @include('layout.errors')

        <x-form action="{{route('article')}}" article="null" method="POST" type="Создать статью"></x-form>

    </div>
@endsection
