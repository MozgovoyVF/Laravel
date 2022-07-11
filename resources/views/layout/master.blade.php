<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="	https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/blog.css">
    <title>@yield('title')</title>
</head>

<body>
    <div class="wrapper">
        @include('layout.header')

        <div class="container main__container">
            <div class="row g-5">
                @yield('content')
                @include('layout.sidebar')
            </div>
        </div>


        @include('layout.footer')
    </div>
</body>

</html>
