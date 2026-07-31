<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="icon" type="image/jpeg" href="/images/gerb-goroda-saratov.jpg">

        <title>{{ config('app.name', 'Саратов') }}</title>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-['FindSansPro'] text-gray-900 antialiased">
        <div class="min-h-screen lg:grid lg:grid-cols-2">
            {{-- Brand panel --}}
            <div class="relative hidden lg:flex flex-col justify-between p-12 overflow-hidden">
                <div class="absolute inset-0 bg-cover bg-center" style="background-image:url('/images/saratovskiy-teatr-operyi-i-baleta.jpg')"></div>
                <div class="absolute inset-0 bg-linear-to-br from-[#A556F7]/90 via-[#7c4fef]/85 to-[#2663EB]/90"></div>

                <div class="relative">
                    <a href="/" class="flex items-center gap-3">
                        <img src="/images/Photoroom 1.png" alt="Саратов" class="icon h-10 w-auto brightness-0 invert">
                        <span class="text-2xl font-bold text-white">Саратов</span>
                    </a>
                </div>

                <div class="relative text-white">
                    <h1 class="text-4xl xl:text-5xl font-bold leading-tight">
                        Саратов<br>на волне времени
                    </h1>
                    <p class="mt-4 text-white/80 text-lg max-w-md">
                        Откройте для себя культурное наследие города: маршруты, экскурсии и знаковые места в вашем личном кабинете.
                    </p>

                    <div class="mt-8 flex gap-8">
                        <div>
                            <div class="text-3xl font-bold">100+</div>
                            <div class="text-white/70 text-sm">Маршрутов</div>
                        </div>
                        <div>
                            <div class="text-3xl font-bold">100+</div>
                            <div class="text-white/70 text-sm">Экскурсоводов</div>
                        </div>
                        <div>
                            <div class="text-3xl font-bold">50+</div>
                            <div class="text-white/70 text-sm">Знаковых мест</div>
                        </div>
                    </div>
                </div>

                <div class="relative text-white/60 text-sm">
                    © {{ date('Y') }} Саратов. Все права защищены.
                </div>
            </div>

            {{-- Form panel --}}
            <div class="flex flex-col justify-center items-center px-6 py-12 bg-gray-50 lg:bg-white">
                {{-- Mobile logo --}}
                <a href="/" class="flex lg:hidden items-center gap-2 mb-8">
                    <img src="/images/Photoroom 1.png" alt="Саратов" class="icon h-9 w-auto">
                    <span class="text-xl font-bold text-gray-900">Саратов</span>
                </a>

                <div class="w-full max-w-md">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </body>
</html>
