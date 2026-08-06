<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>

        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css'])
        @endif

        <style>
            .error-gradient-text {
                background-color: #7e85dd;
                background-size: cover;
                background-position: center;
                background-repeat: no-repeat;
                -webkit-background-clip: text;
                background-clip: text;
                color: transparent;
            }
        </style>
        @yield('extra_styles')
    </head>
    <body class="antialiased">
        <div class="relative flex items-top justify-center min-h-screen bg-white items-center sm:pt-0" role="main">
            <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
                <div class="flex flex-col gap-3 2xl:gap-5 items-center pt-8 sm:pt-0">
                    <h1 class="text-[140px] xs:text-[180px] lg:text-[200px] 2xl:text-[240px] leading-none error-gradient-text font-['Inter']! font-black! m-0 pb-5 2xl:pb-10">
                        @yield('code')
                    </h1>

                    <p class="text-lg lg:text-xl 3xl:text-2xl font-semibold">
                        @yield('message')
                    </p>

                    <p class="text-sm lg:text-base 3xl:text-xl font-normal text-center pb-5 2xl:pb-10 px-4 lg:px-0">
                        @yield('description')
                    </p>

                    <a href="{{ route('index') }}" class="inline-block p-0.5 rounded-lg bg-linear-to-r from-[#A556F7] to-[#2663EB]">
                        <span class="block py-2 xl:py-4 px-7 xl:px-11 text-sm xl:text-base rounded-lg bg-white hover:bg-transparent hover:text-white transition font-normal">
                            Вернуться на главную
                        </span>
                    </a>
                </div>
            </div>
        </div>
    </body>
</html>
