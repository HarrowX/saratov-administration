<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="icon" type="image/jpeg" href="{{asset('/images/gerb-goroda-saratov.jpg')}}">
        <link rel="shortcut icon" type="image/jpeg" href="{{asset('/images/gerb-goroda-saratov.jpg')}}">
        <link rel="apple-touch-icon" href="{{asset('/images/gerb-goroda-saratov.jpg')}}">

        <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>

        @livewireStyles()
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css'])
        @endif

        <title> @yield('title', config('app.name')) </title>
    </head>

    <body>
        @livewire('header')

        {{ $slot }}

        @livewire('calendar')
        @livewire('profile-modal')
        @livewire('footer')

        <script>
            // Initialize all modules when page loads
            document.addEventListener('DOMContentLoaded', function() {
                // Show app download modal
                window.showAppDownload = function() {
                    const modal = document.createElement('div');
                    modal.className = 'fixed inset-0 bg-black/80 z-50 flex items-center justify-center p-4';
                    modal.innerHTML = `
                        <div class="flex flex-col bg-white rounded-2xl max-w-md w-full p-6 text-center">
                            <button onclick="this.closest('.fixed').remove()" class="flex justify-end float-right text-gray-400 hover:text-gray-600">
                                <i class="fas fa-times text-xl"></i>
                            </button>

                            <div class="flex justify-center rounded-2xl mb-4 overflow-hidden">
                                <img src="{{asset('/images/logo.svg')}}" alt="Логотип" class="icon size-20">
                            </div>

                            <h3 class="text-2xl font-bold mb-2">Скачайте приложение</h3>
                            <p class="text-gray-600 mb-6">Получите полный доступ ко всем функциям</p>

                            <div class="w-48 h-48 mx-auto rounded-lg overflow-hidden mb-4">
                                <img src="{{asset('images/qrprila.jpg')}}" alt="QR-код для скачивания">
                            </div>

                            <div class="flex flex-col space-y-3">
                                <a href="#" class="bg-black text-white px-6 py-3 rounded-lg hover:bg-gray-700 transition-colors duration-300 flex items-center justify-center space-x-3">
                                    <img src="{{asset('/images/appstore.svg')}}" alt="Иконка App Store" class="icon size-10 rounded-md">
                                    <div class="text-left">
                                        <div class="text-xs">Загрузите в</div>
                                        <div class="font-semibold">App Store</div>
                                    </div>
                                </a>
                                <a href="#" class="bg-black text-white px-6 py-3 rounded-lg hover:bg-gray-700 transition-colors duration-300 flex items-center justify-center space-x-3">
                                    <img src="{{asset('/images/rustore.svg')}}" alt="Иконка Rustore" class="icon size-10 rounded-md">
                                    <div class="text-left">
                                        <div class="text-xs">Доступно в</div>
                                        <div class="font-semibold">RuStore</div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    `;
                    document.body.appendChild(modal);
                }
            });
        </script>
    </body>

    @livewireScripts()

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/js/app.js'])
    @endif
</html>
