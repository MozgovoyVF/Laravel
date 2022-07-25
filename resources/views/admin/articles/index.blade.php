@extends('layout.admin')

@section('title')
    {{ __('Все статьи') }}
@endsection

@section('content')
    <div class="col-md-8">
        <h3 class="pb-4 mb-4 fst-italic border-bottom">
            Список статей
        </h3>

        @foreach ($articles as $article)
            @include('articles.item')
        @endforeach

        @include ('flash::message')

    </div>
@endsection
