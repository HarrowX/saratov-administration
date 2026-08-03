<footer class="bg-linear-to-br from-gray-900 to-gray-800 text-white py-4">
    <div class="max-w-6xl 3xl:max-w-7xl mx-auto px-4">
        <div class="flex flex-col lg:flex-row justify-between items-center gap-4">
            <div class="flex items-center space-x-2">
                <img src="/images/Photoroom 1.png" alt="Логотип" class="icon h-7">
                <span class="text-sm lg:text-base font-['FindSansPro']">Саратов</span>
            </div>

            <div class="flex flex-col gap-4 md:flex-row items-center space-x-2 3xl:space-x-6 text-xs xl:text-sm text-gray-400">
                <a href="{{ route('index') }}" class="{{ request()->is('/') ? 'hidden' : 'flex' }} hover:text-white transition text-nowrap">Главная</a>
                <a href="{{ route('all-excursions') }}" class="{{ request()->is('excursions*') ? 'hidden' : 'flex'}} hover:text-white transition text-nowrap">Туры и экскурсии</a>
                <a href="{{ route('all-guided-tours') }}" class="{{ request()->is('guided-tours*') ? 'hidden' : 'flex'}} hover:text-white transition text-nowrap">Экскурсоводы</a>
                <a href="{{ route('all-events') }}" class="{{ request()->is('events*') ? 'hidden' : 'flex'}} hover:text-white transition text-nowrap">События</a>
                <a href="{{ route('all-restaurants') }}" class="{{ request()->is('restaurants*') ? 'hidden' : 'flex'}} hover:text-white transition text-nowrap">Заведения</a>
                <a href="{{ route('all-attractions') }}" class="{{ request()->is('attractions*') ? 'hidden' : 'flex'}} hover:text-white transition text-nowrap">Достопримечательности</a>
                <a href="{{ route('all-hotels') }}" class="{{ request()->is('hotels*') ? 'hidden' : 'flex'}} hover:text-white transition text-nowrap">Где остановиться</a>
            </div>

            <div class="flex items-center lg:items-end! space-x-3 lg:space-x-0 lg:gap-2 lg:flex-col">
                <a href="#" onclick="showAppDownload()" class="flex items-center space-x-2 bg-gray-800 hover:bg-gray-700 px-3 py-2 rounded-lg transition">
                    <i class="fab fa-google-play text-green-400"></i>
                    <span class="text-sm">Android</span>
                </a>
                <a href="#" onclick="showAppDownload()" class="flex items-center space-x-2 bg-gray-800 hover:bg-gray-700 px-3 py-2 rounded-lg transition">
                    <i class="fab fa-apple text-gray-300"></i>
                    <span class="text-sm">iOS</span>
                </a>
            </div>
        </div>

        <div class="border-t border-gray-800 mt-4 pt-4 text-center text-gray-400 text-sm">
            <p>&copy; 2026 Саратов. Все права защищены.</p>
        </div>
    </div>
</footer>
