<nav class="bg-white shadow-lg fixed w-full z-50 top-0">
    <div class="max-w-6xl 3xl:max-w-427 mx-auto px-4 sm:px-10">
        <div class="flex justify-between items-center h-20 3xl:h-24">
            <div class="flex items-center">
                <a href="#" class="flex items-center space-x-3">
                    <img src="images/Photoroom 1.png" alt="Логотип" class="icon">
                    <span class="md:text-base lg:text-xl 3xl:text-2xl text-black font-['FindSansPro']">Саратов</span>
                </a>
            </div>
            
            <div class="hidden 3xl:flex items-center md:space-x-4 lg:space-x-5 3xl:space-x-6 transition text-xs 3xl:text-sm">
                <a href="index.html" class="nav-link ">Главная</a>
                <a href="excurtions.html" class="nav-link ">Туры и экскурсии</a>
                <a href="guided-tours.html" class="nav-link">Экскурсоводы</a>
                <a href="location.html" class="nav-link">Заведения</a>
                <a href="attractions.html" class="nav-link">Достопримечательности</a>
                <a href="housing.html" class="nav-link">Где остановиться</a> 
            </div>

            <div class="flex items-center space-x-8">
                <button onclick="showAppDownload()" class="hidden md:flex bg-linear-to-r from-green-500 to-teal-600 text-white px-5 py-2 rounded-lg hover:shadow-lg transition cursor-pointer font-['FindSansPro'] text-sm 3xl:text-base">
                    <i class="fas fa-download mr-3"></i>Приложение
                </button>
                <button id="" class="">
                    <img src="images/image 21.svg" alt="поиск" class="icon size-7 3xl:size-11">
                </button>
                <button id="profileBtn" class="relative cursor-pointer">
                    <img src="images/image 18.svg" alt="мой профиль" class="icon size-6 3xl:size-10">
                    <span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center achievement-count">0</span>
                </button>
                <div class="relative">
                    <button id="mobileMenuBtn" class="flex 3xl:hidden cursor-pointer">
                        <i class="fas fa-bars text-4xl text-gray-600"></i>
                    </button>

                    <!-- Mobile menu -->
                    <div id="mobileMenu" class="hidden fixed md:absolute inset-x-0 top-20 md:top-13 md:right-full w-full md:w-140 bg-white z-50 transition-all duration-300 ease-in-out md:-translate-x-127 rounded-b-3xl">
                        <div class="px-6 py-5 space-y-5 text-xl 3xl:text-2xl">
                            <a href="#home" class="nav-link-active flex items-center gap-5 px-4 py-3 text-gray-900  transition-all duration-200 font-medium group">
                                <i class="fa-solid fa-house w-5 text-gray-700 transition-colors"></i>
                                <span>Главная</span>
                            </a>
                            
                            <a href="excurtions.html" class="nav-link flex items-center gap-5 px-4 py-3 text-gray-700 hover:text-gray-900 hover:bg-linear-to-r hover:from-green-50 hover:to-teal-50/50 rounded-xl transition-all duration-200 font-medium group">
                                <i class="fa-solid fa-map w-5 text-gray-500 group-hover:text-gray-700 transition-colors"></i>
                                <span>Туры и экскурсии</span>
                                <span class="ml-auto opacity-0 group-hover:opacity-100 transition-opacity">→</span>
                            </a>
                            
                            <a href="guided-tours.html" class="nav-link flex items-center gap-5 px-4 py-3 text-gray-700 hover:text-gray-900 hover:bg-linear-to-r hover:from-green-50 hover:to-teal-50/50 rounded-xl transition-all duration-200 font-medium group">
                                <i class="fa-solid fa-users w-5 text-gray-500 group-hover:text-gray-700 transition-colors"></i>
                                <span>Экскурсоводы</span>
                                <span class="ml-auto opacity-0 group-hover:opacity-100 transition-opacity">→</span>
                            </a>
                            
                            <a href="location.html" class="nav-link flex items-center gap-5 px-4 py-3 text-gray-700 hover:text-gray-900 hover:bg-linear-to-r hover:from-green-50 hover:to-teal-50/50 rounded-xl transition-all duration-200 font-medium group">
                                <i class="fa-solid fa-utensils w-5 text-gray-500 group-hover:text-gray-700 transition-colors"></i>
                                <span>Заведения</span>
                                <span class="ml-auto opacity-0 group-hover:opacity-100 transition-opacity">→</span>
                            </a>
                            
                            <a href="attractions.html" class="nav-link flex items-center gap-5 px-4 py-3 text-gray-700 hover:text-gray-900 hover:bg-linear-to-r hover:from-green-50 hover:to-teal-50/50 rounded-xl transition-all duration-200 font-medium group">
                                <i class="fa-solid fa-landmark w-5 text-gray-500 group-hover:text-gray-700 transition-colors"></i>
                                <span>Достопримечательности</span>
                                <span class="ml-auto opacity-0 group-hover:opacity-100 transition-opacity">→</span>
                            </a>
                            
                            <a href="housing.html" class="nav-link flex items-center gap-5 px-4 py-3 text-gray-700 hover:text-gray-900 hover:bg-linear-to-r hover:from-green-50 hover:to-teal-50/50 rounded-xl transition-all duration-200 font-medium group">
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