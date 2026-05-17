<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="description" content="KriyaLokal — platform budaya lokal yang mengemas identitas dan nilai budaya Indonesia melalui storytelling visual dan digital engagement.">

        <title>@yield('title', 'KriyaLokal — Pasar Budaya Indonesia')</title>

        <!-- Google Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,500;0,600;0,700;0,800;1,600&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

        @vite(['resources/css/app.css', 'resources/js/app.js'])

    </head>
    <body class="antialiased" style="background-color: var(--warm-50); color: var(--kriya-800);">

        <!-- Batik ornamental top strip -->
        <div class="batik-border-top"></div>

        <div class="min-h-screen flex flex-col">
            @include('partials.market-navbar')
            @include('partials.flash-message')

            <main class="flex-1">
                @yield('content')
            </main>

            @include('partials.market-footer')
        </div>

        @stack('scripts')
    </body>
</html>
