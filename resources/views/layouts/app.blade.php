<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    @vite('resources/sass/app.scss')
    @stack("styles")
</head>
<body class="bg-light">
    <div id="app">
        <header>
            @include('layouts.partials.navbar')
        </header>
        <main class="py-4">
            @yield("content")
        </main>
    </div>
    @vite('resources/js/app.js')
    @stack("scripts")
</body>
</html>
