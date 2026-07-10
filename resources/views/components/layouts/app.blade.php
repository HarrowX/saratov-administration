<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="icon" type="image/jpeg" href="/images/gerb-goroda-saratov.jpg">
        <link rel="shortcut icon" type="image/jpeg" href="/images/gerb-goroda-saratov.jpg">
        <link rel="apple-touch-icon" href="images/gerb-goroda-saratov.jpg">

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
                        <div class="bg-white rounded-2xl max-w-md w-full p-6 text-center">
                            <button onclick="this.closest('.fixed').remove()" class="float-right text-gray-400 hover:text-gray-600">
                                <i class="fas fa-times text-xl"></i>
                            </button>

                            <div class="w-20 h-20 rounded-2xl mx-auto mb-4 overflow-hidden">
                                <img src="images/gerb-goroda-saratov.jpg" alt="Герб Саратова">
                            </div>

                            <h3 class="text-2xl font-bold mb-2">Скачайте приложение</h3>
                            <p class="text-gray-600 mb-6">Получите полный доступ ко всем функциям</p>

                            <div class="w-48 h-48 mx-auto rounded-lg overflow-hidden mb-4">
                                <img src="images/qrprila.jpg" alt="QR-код для скачивания">
                            </div>

                            <div class="flex flex-col space-y-3">
                                <a href="#" class="bg-black text-white px-6 py-3 rounded-lg hover:bg-gray-800 transition flex items-center justify-center space-x-3">
                                    <i class="fab fa-apple text-2xl"></i>
                                    <div class="text-left">
                                        <div class="text-xs">Загрузите в</div>
                                        <div class="font-semibold">App Store</div>
                                    </div>
                                </a>
                                <a href="#" class="bg-black text-white px-6 py-3 rounded-lg hover:bg-gray-800 transition flex items-center justify-center space-x-3">
                                    <i class="fab fa-google-play text-2xl"></i>
                                    <div class="text-left">
                                        <div class="text-xs">Доступно в</div>
                                        <div class="font-semibold">Google Play</div>
                                    </div>
                                </a>
                            </div>

                            <p class="text-sm text-gray-500 mt-4">Или перейдите по ссылке: saratov-435.ru/app</p>
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
