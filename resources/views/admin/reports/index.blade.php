@extends('layout.admin')

@section('title')
    {{ __('Отчеты') }}
@endsection

@section('content')
    <div class="col-md-8">
        <h3 class="pb-4 mb-4 fst-italic border-bottom">
            Отчеты
        </h3>
        <a class="p-2 link-secondary" href="/admin/reports/total">Итого</a>

        @include ('flash::message')

    </div>
@endsection
