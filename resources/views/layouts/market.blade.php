<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title', 'KriyaLokal')</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-[#fff8ec] font-sans text-[#2f221b] antialiased">
        <div class="min-h-screen">
            @include('partials.market-navbar')
            @include('partials.flash-message')

            <main>
                @yield('content')
            </main>

            @include('partials.market-footer')
        </div>

        @stack('scripts')
    </body>
</html>
