<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    @csrf
    <title>@yield('title', 'Laravel Forum') - Laravel Forum</title>
    <link rel="stylesheet" href="{{mix('css/app.css')}}">
    @yield('styles')
</head>
<body>
    <div id="app" class="{{ route_class() }}-page">
        <div style="min-height: calc(100vh - 78.4px)">
            @include('layouts._header')
            <div class="container">
                <div class="col-lg-10 offset-1">
                    @include('shared._messages')
                </div>
                @yield('content')
            </div>
        </div>

        @include('layouts._footer')
    </div>
    <script src="{{ mix('js/app.js') }}"></script>
    @yield('scripts')
</body>
</html>
