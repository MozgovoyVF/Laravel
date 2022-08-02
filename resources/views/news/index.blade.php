@extends('layout.master')

@section('title')
    {{ __('Новости') }}
@endsection

@section('content')
    <div class="col-md-8">
        <h3 class="pb-4 mb-4 fst-italic border-bottom">
            Список новостей
        </h3>

        @foreach ($news as $item)
            @include('news.item')
        @endforeach

        {{$news->links()}}

    </div>
@endsection
