<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- <title>{{ config('app.name', 'E-Yearbook') }}</title> --}}
    <title>@yield('title', 'Beranda')</title>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('img/smkn1logo.png') }}">
    {{-- <style>
        body {
    overflow-x: hidden;}
    </style> --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#f8f7f4] m-0">
    @include('layouts.navbar')
    @yield('content')
</body>

<script src="{{ asset('_func/navbar.js') }}"></script>

</html>
