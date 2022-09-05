<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="	https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    <link rel="stylesheet" href="{{ mix('/css/main.css') }}">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="//{{ Request::getHost() }}:{{ env('LARAVEL_ECHO_PORT') }}/socket.io/socket.io.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <title>@yield('title')</title>
</head>

<body>
    <div id="app" class="wrapper">
        @include('layout.header')

        <div class="container main__container">
            <div class="row g-5">
                @yield('content')
                @section('sidebar')
                    @include('layout.sidebar')
                @show
            </div>
        </div>

        <article-update></article-update>

        @include('layout.footer')

    </div>
</body>
@stack('scripts')

<script src="{{ mix('js/echo.js') }}"></script>
<script src="{{ mix('js/app.js') }}"></script> 

</html>
