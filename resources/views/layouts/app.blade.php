<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <!-- Styles -->
    <!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css">

    <script>
        window.baseURL = "{{ config('app.url') }}";
    </script>
</head>

<body>
    <div id="app">
        <v-app>
            @auth
            <navigation title="{{ config('app.name', 'Laravel') }}"></navigation>
            @endif

            <v-main class="mt-5">
                @yield('content')
            </v-main>
        </v-app>
    </div>
</body>
</html>
