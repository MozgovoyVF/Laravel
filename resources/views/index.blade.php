@extends('layout.master')

@section('title')
    {{ __('Laravel') }}
@endsection

@section('content')
    <div class="col-md-8">
        <h3 class="pb-4 mb-4 fst-italic border-bottom">
            Список статей
        </h3>

        @foreach ($articles as $article)
            @include('articles.item')
        @endforeach

        {{-- @if (session('status'))
            <div class="alert alert-success">
                {{ 'Статья "' . session('status') . '"' . ' успешно обновлена!' }}
            </div>
        @endif --}}

    </div>

    <script src="https://js.pusher.com/7.1/pusher.min.js"></script>
    <script>
        Pusher.logToConsole = true;

        var pusher = new Pusher('061d51597c5f01e35ee2', {
            cluster: 'eu',
        });

        var channel = pusher.subscribe('my-channel')

        channel.bind("my-event", function(data) {
            alert(data);
        })

        channel.bind("pusher:subscription_succeeded", () => {
            
        });
    </script>
@endsection
