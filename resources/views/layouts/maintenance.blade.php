<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title', 'Panel KriyaLokal')</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-[#fff8ec] font-sans text-[#2f221b] antialiased">
        <div class="min-h-screen lg:flex">
            @include('partials.maintenance-sidebar')

            <div class="min-w-0 flex-1">
                <header class="border-b border-[#eadcc8] bg-white/85 px-4 py-5 shadow-sm sm:px-6 lg:px-8">
                    <p class="text-sm font-semibold uppercase tracking-normal text-[#b85f2f]">Panel Operasional</p>
                    <h1 class="mt-1 text-2xl font-bold text-[#2f221b]">@yield('page-title', 'Dashboard')</h1>
                </header>

                @include('partials.flash-message')

                <main class="px-4 py-8 sm:px-6 lg:px-8">
                    @yield('content')
                </main>
            </div>
        </div>
    </body>
</html>
