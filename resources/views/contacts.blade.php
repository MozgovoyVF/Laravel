@extends('layout.master')

@section('title')
    {{__('Контакты')}}
@endsection

@section('content')
    <div class="col-md-8">
        <h3 class="pb-4 mb-4 fst-italic border-bottom">
            Обратная связь
        </h3>

        @include('layout.errors')

        <form method="POST" action="/">
            @csrf

            <div class="mb-3">
                <label for="inputEmail" class="form-label">Символьный Ваш email</label>
                <input type="text" class="form-control" name="email" id="inputEmail"
                    placeholder="Введите email" value="{{ old('email') }}">
            </div>
            <div class="mb-3">
                <label for="inputMessage" class="form-label">Введите сообщение</label>
                <input type="text" class="form-control" name="message" id="inputMessage"
                    placeholder="Введите сообщение" value="{{ old('message') }}">
            </div>
            <button type="submit" class="btn btn-primary">Отправить</button>
        </form>
    </div>
@endsection