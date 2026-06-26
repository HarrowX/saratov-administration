<nav class="bg-white shadow-lg fixed w-full z-50 top-0">
    <div class="max-w-6xl 3xl:max-w-427 mx-auto px-4 sm:px-10">
        <div class="flex justify-between items-center h-20 3xl:h-24">
            <div class="flex items-center">
                <a href="{{ route('index') }}" class="flex items-center space-x-3">
                    <img src="/images/Photoroom 1.png" alt="Логотип" class="icon h-7 xs:h-10">
                    <span class="md:text-base lg:text-xl 3xl:text-2xl text-black font-['FindSansPro']">Саратов</span>
                </a>
            </div>

            <ul class="hidden lg:flex items-center md:space-x-4 lg:space-x-3 3xl:space-x-6 transition text-xs 3xl:text-sm pt-1">
                <li>
                    <a href="{{ route('index') }}" class="{{ request()->is('/') ? "nav-link-active nav-link" : "nav-link" }}">Главная</a>
                </li>
                <li>
                    <a href="{{ route('all-excurtions') }}" class="{{ request()->is('excurtions*') ? "nav-link-active nav-link" : "nav-link" }}">Туры и экскурсии</a>
                </li>
                <li>
                    <a href="{{ route('all-guided-tours') }}" class="{{ request()->is('guided-tours*') ? "nav-link-active nav-link" : "nav-link" }}">Экскурсоводы</a>
                </li>
                <li class="nav-link group">Места
                    <ul class="absolute top-4.5 3xl:top-5.5 -translate-x-5 invisible hidden opacity-0 group-hover:flex group-hover:flex-col group-hover:opacity-100 group-hover:visible gap-5 p-5 bg-white z-1 rounded-xl transition-all duration-700 shadow-2xl">
                        <li class="block">
                            <a href="{{ route('all-restaurants') }}" class="{{ request()->is('restaurants*') ? "nav-link-active nav-link" : "nav-link" }}">Заведения</a>
                        </li>
                        <li class="block">
                            <a href="{{ route('all-attractions') }}" class="{{ request()->is('attractions*') ? "nav-link-active nav-link" : "nav-link" }}">Достопримечательности</a>
                        </li>
                        <li class="block">
                            <a href="{{ route('all-hotels') }}" class="{{ request()->is('hotels*') ? "nav-link-active nav-link" : "nav-link" }}">Где остановиться</a>
                        </li>
                    </ul>
                </li>
            </ul>

            <div class="flex items-center space-x-3 2xl:space-x-8">
                <button onclick="showAppDownload()" class="hidden md:flex items-center bg-linear-to-r from-green-500 to-teal-600 text-white px-5 py-2 rounded-lg hover:shadow-lg transition cursor-pointer font-['FindSansPro'] text-sm 3xl:text-base z-2">
                    <i class="fas fa-download mr-3"></i>Приложение
                </button>
                <button id="" class="">
                    <img src="/images/image 21.svg" alt="поиск" class="icon size-7 3xl:size-11">
                </button>

                <button id="profileBtn" class="relative cursor-pointer">
                    <img src="/images/image 18.svg" alt="мой профиль" class="icon size-6 3xl:size-10">
                    <span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full size-4 sm:size-5 flex items-center justify-center achievement-count">0</span>
                </button>

                <div class="relative">
                    <button id="mobileMenuBtn" class="flex lg:hidden cursor-pointer">
                        <i class="fas fa-bars text-2xl sm:text-4xl text-gray-600"></i>
                    </button>

                    <!-- Mobile menu -->
                    <div id="mobileMenu" class="hidden fixed md:absolute inset-x-0 top-20 md:top-14 md:right-full w-full md:w-140 bg-white z-50 transition-all duration-300 ease-in-out md:-translate-x-127 rounded-b-3xl">
                        <div class="px-2 xs:px-6 pb-5 lg:pb-2 space-y-2 sm:space-y-5 2xl:space-y-2 text-sm sm:text-base xl:text-xl 3xl:text-2xl max-h-[calc(100vh-5rem)] overflow-y-auto">
                            <a href="{{ route('index') }}" class="{{ request()->is('/') ? "nav-link-active nav-link" : "nav-link" }} flex items-center gap-1.5 xs:gap-5 px-2 xs:px-4 py-3 text-gray-900  transition-all duration-200 font-medium group">
                                <i class="fa-solid fa-house w-5 text-gray-500 group-hover:text-gray-700 transition-colors"></i>
                                <span>Главная</span>
                            </a>

                            <a href="{{ route('all-excurtions') }}" class="{{ request()->is('excurtions*') ? "nav-link-active nav-link" : "nav-link" }} flex items-center gap-1.5 xs:gap-5 px-2 xs:px-4 py-3 text-gray-900  transition-all duration-200 font-medium group">
                                <i class="fa-solid fa-map w-5 text-gray-500 group-hover:text-gray-700 transition-colors"></i>
                                <span>Туры и экскурсии</span>
                                <span class="ml-auto opacity-0 group-hover:opacity-100 transition-opacity">→</span>
                            </a>

                            <a href="{{ route('all-guided-tours') }}" class="{{ request()->is('guided-tours*') ? "nav-link-active nav-link" : "nav-link" }} flex items-center gap-1.5 xs:gap-5 px-2 xs:px-4 py-3 text-gray-900  transition-all duration-200 font-medium group">
                                <i class="fa-solid fa-users w-5 text-gray-500 group-hover:text-gray-700 transition-colors"></i>
                                <span>Экскурсоводы</span>
                                <span class="ml-auto opacity-0 group-hover:opacity-100 transition-opacity">→</span>
                            </a>

                            <a href="{{ route('all-restaurants') }}" class="{{ request()->is('restaurants*') ? "nav-link-active nav-link" : "nav-link" }} flex items-center gap-1.5 xs:gap-5 px-2 xs:px-4 py-3 text-gray-900  transition-all duration-200 font-medium group">
                                <i class="fa-solid fa-utensils w-5 text-gray-500 group-hover:text-gray-700 transition-colors"></i>
                                <span>Заведения</span>
                                <span class="ml-auto opacity-0 group-hover:opacity-100 transition-opacity">→</span>
                            </a>

                            <a href="{{ route('all-attractions') }}" class="{{ request()->is('attractions*') ? "nav-link-active nav-link" : "nav-link" }} flex items-center gap-1.5 xs:gap-5 px-2 xs:px-4 py-3 text-gray-900  transition-all duration-200 font-medium group">
                                <i class="fa-solid fa-landmark w-5 text-gray-500 group-hover:text-gray-700 transition-colors"></i>
                                <span>Достопримечательности</span>
                                <span class="ml-auto opacity-0 group-hover:opacity-100 transition-opacity">→</span>
                            </a>

                            <a href="{{ route('all-hotels') }}" class="{{ request()->is('hotels*') ? "nav-link-active nav-link" : "nav-link" }} flex items-center gap-1.5 xs:gap-5 px-2 xs:px-4 py-3 text-gray-900  transition-all duration-200 font-medium group">
                                <i class="fa-solid fa-hotel w-5 text-gray-500 group-hover:text-gray-700 transition-colors"></i>
                                <span>Где остановиться</span>
                                <span class="ml-auto opacity-0 group-hover:opacity-100 transition-opacity">→</span>
                            </a>

                            <div class="relative my-4 md:hidden">
                                <div class="absolute inset-0 flex items-center">
                                    <div class="w-full border-t border-gray-200"></div>
                                </div>
                            </div>

                            <button onclick="showAppDownload()" class="w-full bg-linear-to-r from-green-500 to-teal-600 text-white px-4 py-3.5 rounded-xl hover:shadow-lg transition-all duration-200 hover:scale-[1.02] active:scale-[0.98] cursor-pointer font-medium md:hidden flex items-center justify-center gap-2 group">
                                <i class="fas fa-download group-hover:animate-bounce"></i>
                                <span>Скачать приложение</span>
                            </button>

                            <p class="text-xs text-center text-gray-400 pt-2 md:hidden">
                                Откройте Саратов по-новому
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>
