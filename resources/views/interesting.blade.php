@extends('layout.master')

@section('title')
    {{__('Интересное')}}
@endsection

@section('content')
    <div class="col-md-8">
        <h3 class="pb-4 mb-4 fst-italic border-bottom">
            Необычные факты о нашем блоге!
        </h3>
    </div>

    <div class="col-md-8">
        @foreach ($data as $key => $item)
            @include('statistic_item')
        @endforeach
    </div>
@endsection