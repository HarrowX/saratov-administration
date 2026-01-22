<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="icon" type="images/jpeg" href="images/gerb-goroda-saratov.jpg">
        <link rel="shortcut icon" type="images/jpeg" href="images/gerb-goroda-saratov.jpg">
        <link rel="apple-touch-icon" href="images/gerb-goroda-saratov.jpg">

        @livewireStyles()
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css'])
        @endif

        <title> @yield('title', config('app.name')) </title>
    </head>

    <body>
        {{ $slot }}
    </body>

    @livewireScripts()
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/js/app.js'])
    @endif
</html>
