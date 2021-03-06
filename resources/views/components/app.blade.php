<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full theme-light">
<head>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/jpg" href="/images/fav-icon.png"/>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Bawsala') }}</title>

    <!-- Scripts -->

    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="h-full">
<div id="app" class="h-full">
    {{$slot}}
</div>
</body>
</html>
