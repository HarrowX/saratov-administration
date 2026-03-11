@section('title')
    Саратов 435 - Модерн в Саратове
@endsection
<div>

    <section id="home" class="relative md:min-h-screen mt-25 md:mt-42 xl:mt-61.5 3xl:mt-70.5 px-4 sm:px-20">
        <div class="max-w-3xl lg:max-w-5xl xl:max-w-7xl 3xl:max-w-398.25 mx-auto relative">
            <div class="relative overflow-hidden rounded-lg sm:rounded-2xl md:rounded-[30px] md:h-[500px] h-54 sm:h-116 xl:h-180 3xl:h-226">
                <div class="absolute inset-0 bg-cover bg-center bg-no-repeat bg-[url('/images/консерватория.png')]"></div>
                <div class="absolute inset-x-0 bottom-0 h-40 sm:h-60 md:h-100 bg-linear-to-t from-black via-black/30 sm:via-black/50 to-transparent"></div>
                <div class="absolute w-full h-full flex justify-center items-end">
                    <h1 class="text-base sm:text-3xl xl:text-6xl text-white font-extrabold pb-4 sm:pb-15">Модерн в Саратове</h1>
                </div>
            </div>

            <a href="{{ route('all-excurtions') }}"
               class="absolute left-0 xl:-left-14 -top-14 xl:-top-25 hidden md:flex items-center xl:gap-2 text-[#5F5F5F] hover:text-blue-900 transition-colors font-['FindSansPro']">
                <i class="fa-solid fa-chevron-left text-xl xl:text-xl 2xl:text-3xl"></i>
                <span class="text-xl xl:text-3xl pl-4">Экскурсии</span>
            </a>

            <button class="absolute top-5 md:top-10 right-4 md:right-11 xl:top-18 xl:right-14 flex items-center text-white transition-colors font-['FindSansPro'] bg-[#A855F7] rounded-lg px-4 py-4 cursor-pointer">
                <i class="fa-sharp fa-solid fa-heart text-base sm:text-xl lg:text-2xl xl:text-4xl"></i>
                <span class="text-xs sm:text-sm lg:text-base xl:text-xl pl-4 text-nowrap">Добавить в избранное</span>
            </button>
        </div>

    </section>
    <section>

    </section>

    <!--Hero Section-->
    <section class="flex justify-center px-5 sm:px-20">
        <div class="max-md:hidden md:max-w-[700px] lg:max-w-[1050px] xl:max-w-[1280px] 2xl:max-w-[1636px]">
            <div><button class="flex items-center gap-5 pt-39 pb-10 font-['FindSansPro'] text-[18px] lg:text-[20px] xl:text-[26px] 2xl:text-[32px] text-[#5F5F5F]">
                <i class="text-2xl lg:text-3xl xl:text-4xl 2xl:text-5xl fa-solid fa-chevron-left"></i>Экскурсии</button>
            </div>
            <div class="flex justify-center relative pt-100 h-[900px]">
                <div class="absolute inset-0 h-[900px] object-scale-down ">
                    <div class="absolute inset-0 bg-cover bg-center bg-no-repeat bg-[url('/images/консерватория.png')] max-w-[1636px] rounded-[30px]"></div>


                    <div class="absolute inset-x-0 bottom-0 h-40 sm:h-60 md:h-100 bg-linear-to-t from-black via-black/50 to-transparent h-[900px] rounded-[30px]"></div>
                </div>

                <div class="font-['FindSansPro'] absolute inset-0 flex items-center justify-center">
                    <span class="absolute bottom-0 left-1/2 -translate-x-1/2 w-full text-white text-center py-2 text-6xl pb-12">
                        Модерн в Саратове
                    </span>
                </div>
            </div>
            <div class="flex justify-center">
            <div class="flex text-[32px] mt-30 mb-36 max-w-[1700px] gap-10 lg:gap-20">
                <div class="flex items-center justify-center text-[16px] lg:text-[20px] xl:text-[26px] 2xl:text-[32px] md:max-w-[300px] lg:max-w-[400px] xl:max-w-[500px] 2xl:max-w-[606px] full-h">
                <p>В конце 19 века окончательно сформировался неповторимый облик Саратова, который во многом определил саратовский модерн. Здесь сохранилось множество памятников этого стиля архитектуры. Во время нашей экскурсии мы расскажем о жилых, многоквартирных и коммерческих зданиях, а также не обойдем вниманием судьбу их владельцев. </p>
                </div>
                    <div class="flex flex-col justify-around max-w-[731px]">
                    <div class="flex flex-col justify-around bg-[#E5E6F6] pr-23 pl-11 gap-6.75 py-4 rounded-[20px] text-[16px] lg:text-[18px] xl:text-[20px] 2xl:text-[24px] font-['FindSansPro']">
                        <div class="flex items-center gap-5">
                            <img class="max-w-[26px] max-h-[31px]" src="/images/значок локации.svg">
                            <div>сад Липки</div>
                        </div>
                        <div class="flex items-center gap-5">
                            <img class="max-w-[30px] max-h-[31px]" src="/images/image 15.svg">
                            <div>8 917 205-57-41</div>
                        </div>
                        <div class="flex items-center gap-5 ">
                            <img class="max-w-[31px] max-h-[31px]" src="/images/image 16.svg">
                            <div>https://t.me/puteshestvie_s_MIRonovoy</div>
                        </div>
                        <div class="flex items-center gap-5">
                            <img class="max-w-[31px] max-h-[31px]" src="/images/image 8.svg">
                            <div>2 часа</div>
                        </div>
                        <div class="flex item-center gap-5">
                            <img class="max-w-[31px] max-h-[31px]" src="/images/image 17.svg">
                            <div>Пешеходная</div>
                        </div>
                    </div>
                    <button class="w-full bg-linear-to-r from-green-500 to-teal-600 text-white px-4 py-6 rounded-[30px] text-[18px] lg:text-[20px] xl:text-[26px] 2xl:text-[32px] hover:shadow-lg transition text-center cursor-pointer mt-7 py-5 font-['FindSansPro']">
                        Показать на карте
                    </button>
                </div>
            </div>
            </div>
        </div>

        <!--Mobile hero-->
        <div class="md:hidden md:max-w-[728px] sm:max-w-[600px]">
            <div><a href="" class="flex items-center gap-5 pt-39 pb-10 font-['FindSansPro'] text-[18px] lg:text-[20px] xl:text-[26px] 2xl:text-[32px] text-[#5F5F5F]">
                <i class="text-2xl lg:text-3xl xl:text-4xl 2xl:text-5xl fa-solid fa-chevron-left"></i>Экскурсии</a>
            </div>
            <div class="flex justify-center relative">
                <img src="/images/консерватория.png" alt="экскурсия" class="max-w-[1636px] max-h-[900px] object-scale-down">
                <div class="absolute inset-0 flex items-center justify-center">
                    <span class="absolute bottom-0 left-1/2 -translate-x-1/2 w-full text-white text-center py-2 text-6xl pb-12">
                        Модерн в Саратове
                    </span>
                </div>
            </div>
            <div class="flex justify-center">
                <div class="flex flex-col text-[32px] mt-5 mb-10 max-w-[1700px] gap-10 lg:gap-20">
                    <div class="flex items-center justify-center text-[18px] lg:text-[20px] xl:text-[26px] 2xl:text-[32px] md:max-w-[300px] lg:max-w-[400px] xl:max-w-[500px] 2xl:max-w-[606px] full-h">
                        <p>В конце 19 века окончательно сформировался неповторимый облик Саратова, который во многом определил саратовский модерн. Здесь сохранилось множество памятников этого стиля архитектуры. Во время нашей экскурсии мы расскажем о жилых, многоквартирных и коммерческих зданиях, а также не обойдем вниманием судьбу их владельцев. </p>
                    </div>
                    <div class="flex flex-col justify-around max-w-[731px]">
                        <div class="flex flex-col justify-around bg-[#E5E6F6] pr-23 pl-11 gap-6.75 py-4 rounded-[20px] text-[18px] lg:text-[20px] xl:text-[26px] 2xl:text-[32px]">
                            <div class="flex items-center gap-5">
                                <img class="max-w-[26px] max-h-[31px]" src="/images/значок локации.svg">
                                <div>сад Липки</div>
                            </div>
                            <div class="flex items-center gap-5">
                                <img class="max-w-[30px] max-h-[31px]" src="/images/image 15.svg">
                                <div>8 917 205-57-41</div>
                            </div>
                            <div class="flex items-center gap-5 ">
                                <img class="max-w-[31px] max-h-[31px]" src="/images/image 16.svg">
                                <div>https://t.me/puteshestvie_s_MIRonovoy</div>
                            </div>
                            <div class="flex items-center gap-5">
                                <img class="max-w-[31px] max-h-[31px]" src="/images/image 8.svg">
                                <div>2 часа</div>
                            </div>
                            <div class="flex item-center gap-5">
                                <img class="max-w-[31px] max-h-[31px]" src="/images/image 17.svg">
                                <div>Пешеходная</div>
                            </div>
                        </div>
                        <button class="w-full bg-linear-to-r from-green-500 to-teal-600 text-white px-4 py-6 rounded-[30px] text-[18px] lg:text-[20px] xl:text-[26px] 2xl:text-[32px] hover:shadow-lg transition text-center cursor-pointer mt-7 py-5">
                            <i class="class= fas mr-2">Показать на карте</i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--Places Section-->
    <section class="py-10 xl:py-26 bg-[#E5E6F6]">
        <div class="flex flex-col gap-4 lg:flex-row max-w-3xl lg:max-w-5xl xl:max-w-7xl 2xl:max-w-398.25 mx-auto px-5 xl:px-20">
            <div class="flex flex-col items-center md:items-start justify-between font-['FindSansPro']">
                <h2 class="pb-2 text-center md:text-left">Места, которые  вы посетите</h2>
                <div class="flex flex-col items-center md:items-start justify-center gap-2 2xl:gap-6 text-[16px] lg:text-[18px] xl:text-[20px] 2xl:text-[24px]">
                    <div class="flex items-center">
                        <img class="icon max-w-3 max-h-3 lg:max-w-5 lg:max-h-7 2xl:max-w-[26px] 2xl:max-h-[31px] mr-2.5 lg:mr-6" src="/images/значок локации.svg">
                        <div class="">Сад Липки</div>
                    </div>
                    <div class="flex items-center ">
                        <img class="icon max-w-3 max-h-3 lg:max-w-5 lg:max-h-7 2xl:max-w-[26px] 2xl:max-h-[31px] mr-2.5 lg:mr-6" src="/images/значок локации.svg">
                        <p>Особняки немецких мельников</p>
                    </div>
                    <div class="flex items-center ">
                        <img class="icon max-w-3 max-h-3 lg:max-w-5 lg:max-h-7 2xl:max-w-[26px] 2xl:max-h-[31px] mr-2.5 lg:mr-6" src="/images/значок локации.svg">
                        <p>Церковь иконы Божией Матери "Утоли моя <br>печали"</p>
                    </div>
                    <div class="flex items-center ">
                        <img class="icon max-w-3 max-h-3 lg:max-w-5 lg:max-h-7 2xl:max-w-[26px] 2xl:max-h-[31px] mr-2.5 lg:mr-6" src="/images/значок локации.svg">
                        <p>Дома богатых купцов</p>
                    </div>
                    <div class="flex items-center ">
                        <img class="icon max-w-3 max-h-3 lg:max-w-5 lg:max-h-7 2xl:max-w-[26px] 2xl:max-h-[31px] mr-2.5 lg:mr-6" src="/images/значок локации.svg">
                        <p>Многоквартирный дом</p>
                    </div>
                </div>
                <button class="w-full bg-linear-to-r from-purple-500 to-blue-600 text-white px-4 py-2 rounded-[30px] hover:shadow-lg transition text-center cursor-pointer mt-7 py-4 max-w-full md:max-w-[585px]">
                    <div class="text-[16px] lg:text-[18px] xl:text-[20px] 2xl:text-[24px]">Задать вопрос AI Ассистенту Саре</div>
                </button>
            </div>
            <div class="job-swiper__swiper swiper mx-auto max-w-full lg:max-w-100 2xl:max-w-200 max-h-129.5 relative">
                <div class="swiper-wrapper">
                    <!-- Слайд 1 -->
                    <div class="swiper-slide flex! justify-center items-center">
                        <img src="/images/сад липки.png" class="w-200 photo rounded-xl">
                    </div>

                    <!-- Слайд 2 -->
                    <div class="swiper-slide flex! justify-center items-center">
                        <img src="/images/сад липки.png" class="w-200 photo rounded-xl">
                    </div>

                    <!-- Слайд 3 -->
                    <div class="swiper-slide flex! justify-center items-center">
                        <img src="/images/сад липки.png" class="w-200  photo rounded-xl">
                    </div>
                </div>

                <div class="swiper-pagination pb-4"></div>

                <!-- Кнопки навигации -->
                <div class="button-navigation--job-left absolute top-1/2 -translate-y-1/2 w-8 h-13.5 bg-[#FFFFFF33] rounded-full text-white text-xl flex items-center justify-center cursor-pointer z-10 hover:bg-[#ffffffa8] left-2">
                    <i class="fa-solid fa-chevron-left"></i>
                </div>
                <div class="button-navigation--job-right absolute top-1/2 -translate-y-1/2 w-8 h-13.5 bg-[#FFFFFF33] rounded-full text-white text-xl flex items-center justify-center cursor-pointer z-10 hover:bg-[#ffffffa8] right-2">
                    <i class="fa-solid fa-chevron-right"></i>
                </div>
            </div>
        </div>
    </section>

<!--Achievements Section-->
    <section class="flex justify-center pr-40 lg:pr-90 xl:pr-150 2xl:pr-220">
        <div class="max-w-5xl ml-40 mb-22 md:max-w-[700px] lg:max-w-[1050px] xl:max-w-[1280px] 2xl:max-w-[1600px]">
            <div class="flex flex-col justify-between gap-8 pt-12">
                <div class="text-[18px] lg:text-[24px] xl:text-[30px] 2xl:text-[36px] font-['Merriweather'] font-bold">Достижения</div>
                <div class="text-[16px] lg:text-[18px] xl:text-[20px] 2xl:text-[24px] font-['FindSansPro']">За прохождение “Модерн в Саратове” вы получите:</div>
                <div class="flex items-center justify-start text-[16px] lg:text-[18px] xl:text-[18px] 2xl:text-[20px] gap-15 text-nowrap">
                    <button class="w-full bg-linear-to-r from-green-500 to-teal-600 text-white px-4 rounded-[30px] hover:shadow-lg transition text-center cursor-pointer py-4 max-w-[377px] font-['FindSansPro']">
                        +1 к “Исследователю”
                    </button>
                    <button class="flex items-center font-['FindSansPro'] text-nowrap text-[#636363]">
                        перейти к другим квестам и достижениям >
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- Places Nearby -->
    <section class="py-10 xl:py-26 bg-white px-5 sm:px-20">
        <div class="max-w-3xl lg:max-w-5xl xl:max-w-7xl 2xl:max-w-398.25 mx-auto  px-5 xl:px-20">

            <div class="text-center mb-4 sm:mb-12">
                <h2 class="text-2xl md:text-3xl font-bold mb-4">Места рядом</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Интересные локации, которые удобно посетить по пути: знаковые точки, уютные уголки и лучшие места для фото.</p>
            </div>

            <!-- Карусель -->
            <div class="relative group">
                <div class="flex overflow-x-auto gap-4 md:gap-6 pb-6 scrollbar-hide scroll-smooth snap-x snap-mandatory"
                    style="scrollbar-width: none; -ms-overflow-style: none;">

                    <!-- Карточка 1 -->
                    <div class="snap-start shrink-0 w-[calc(50%-8px)] sm:w-80 lg:w-[calc(33.333%-16px)] bg-white rounded-[19px] overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300">
                        <div class="p-2 sm:p-4 2xl:p-5 h-full flex flex-col">
                            <div class="w-full mb-4 overflow-hidden rounded-lg shrink-0">
                                <img src="/images/image 23.png" alt="Дом книги">
                            </div>

                            <div class="font-['FindSansPro'] flex flex-col h-26 sm:h-50 md:h-60">
                                <div class="grow">
                                    <h4 class="">Дом книги</h4>
                                    <p class="text-[7px] sm:text-base text-[#888888] line-clamp-4">Архитектура и памятники, театры и культурные центры</p>
                                </div>

                                <div class="shrink-0 mt-2 mb-3">
                                    <div class="flex items-end justify-between gap-2">
                                        <div class="flex gap-1 sm:gap-4 flex-1 max-w-37 sm:max-w-75">
                                            <img src="/images/image 7.svg" alt="" class="icon size-2.5 sm:size-4 md:size-7 mt-2 sm:mt-5 shrink-0">
                                            <span class="text-[8px] sm:text-xs xl:text-sm text-[#505050] pt-1 sm:pt-4">Саратов, Фрунзенский район, ул. Вольская, 81</span>
                                        </div>
                                        <form action="{{ route('all-attractions') }}">
                                            <button class="shrink-0 size-5 sm:size-10 xl:size-11 2xl:size-15 bg-linear-to-r from-[#A556F7] to-[#2663EB] rounded-full flex items-center justify-center hover:opacity-90 transition-opacity">
                                                <img src="/images/Arrow 2.png" alt="" class="icon w-1 sm:w-2 xl:w-3 2xl:w-4 h-2.5 sm:h-4.5 xl:h-6 2xl:h-7.5">
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Карточка 1 -->
                    <div class="snap-start shrink-0 w-[calc(50%-8px)] sm:w-80 lg:w-[calc(33.333%-16px)] bg-white rounded-[19px] overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300">
                        <div class="p-2 sm:p-4 2xl:p-5 h-full flex flex-col">
                            <div class="w-full mb-4 overflow-hidden rounded-lg shrink-0">
                                <img src="/images/image 23.png" alt="Дом книги">
                            </div>

                            <div class="font-['FindSansPro'] flex flex-col h-26 sm:h-50 md:h-60">
                                <div class="grow">
                                    <h4 class="">Дом книги</h4>
                                    <p class="text-[7px] sm:text-base text-[#888888] line-clamp-4">Архитектура и памятники, театры и культурные центры</p>
                                </div>

                                <div class="shrink-0 mt-2 mb-3">
                                    <div class="flex items-end justify-between gap-2">
                                        <div class="flex gap-1 sm:gap-4 flex-1 max-w-37 sm:max-w-75">
                                            <img src="/images/image 7.svg" alt="" class="icon size-2.5 sm:size-4 md:size-7 mt-2 sm:mt-5 shrink-0">
                                            <span class="text-[8px] sm:text-xs xl:text-sm text-[#505050] pt-1 sm:pt-4">Саратов, Фрунзенский район, ул. Вольская, 81</span>
                                        </div>
                                        <form action="{{ route('all-attractions') }}">
                                            <button class="shrink-0 size-5 sm:size-10 xl:size-11 2xl:size-15 bg-linear-to-r from-[#A556F7] to-[#2663EB] rounded-full flex items-center justify-center hover:opacity-90 transition-opacity">
                                                <img src="/images/Arrow 2.png" alt="" class="icon w-1 sm:w-2 xl:w-3 2xl:w-4 h-2.5 sm:h-4.5 xl:h-6 2xl:h-7.5">
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Карточка 1 -->
                    <div class="snap-start shrink-0 w-[calc(50%-8px)] sm:w-80 lg:w-[calc(33.333%-16px)] bg-white rounded-[19px] overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300">
                        <div class="p-2 sm:p-4 2xl:p-5 h-full flex flex-col">
                            <div class="w-full mb-4 overflow-hidden rounded-lg shrink-0">
                                <img src="/images/image 23.png" alt="Дом книги">
                            </div>

                            <div class="font-['FindSansPro'] flex flex-col h-26 sm:h-50 md:h-60">
                                <div class="grow">
                                    <h4 class="">Дом книги</h4>
                                    <p class="text-[7px] sm:text-base text-[#888888] line-clamp-4">Архитектура и памятники, театры и культурные центры</p>
                                </div>

                                <div class="shrink-0 mt-2 mb-3">
                                    <div class="flex items-end justify-between gap-2">
                                        <div class="flex gap-1 sm:gap-4 flex-1 max-w-37 sm:max-w-75">
                                            <img src="/images/image 7.svg" alt="" class="icon size-2.5 sm:size-4 md:size-7 mt-2 sm:mt-5 shrink-0">
                                            <span class="text-[8px] sm:text-xs xl:text-sm text-[#505050] pt-1 sm:pt-4">Саратов, Фрунзенский район, ул. Вольская, 81</span>
                                        </div>
                                        <form action="{{ route('all-attractions') }}">
                                            <button class="shrink-0 size-5 sm:size-10 xl:size-11 2xl:size-15 bg-linear-to-r from-[#A556F7] to-[#2663EB] rounded-full flex items-center justify-center hover:opacity-90 transition-opacity">
                                                <img src="/images/Arrow 2.png" alt="" class="icon w-1 sm:w-2 xl:w-3 2xl:w-4 h-2.5 sm:h-4.5 xl:h-6 2xl:h-7.5">
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Карточка 1 -->
                    <div class="snap-start shrink-0 w-[calc(50%-8px)] sm:w-80 lg:w-[calc(33.333%-16px)] bg-white rounded-[19px] overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300">
                        <div class="p-2 sm:p-4 2xl:p-5 h-full flex flex-col">
                            <div class="w-full mb-4 overflow-hidden rounded-lg shrink-0">
                                <img src="/images/image 23.png" alt="Дом книги">
                            </div>

                            <div class="font-['FindSansPro'] flex flex-col h-26 sm:h-50 md:h-60">
                                <div class="grow">
                                    <h4 class="">Дом книги</h4>
                                    <p class="text-[7px] sm:text-base text-[#888888] line-clamp-4">Архитектура и памятники, театры и культурные центры</p>
                                </div>

                                <div class="shrink-0 mt-2 mb-3">
                                    <div class="flex items-end justify-between gap-2">
                                        <div class="flex gap-1 sm:gap-4 flex-1 max-w-37 sm:max-w-75">
                                            <img src="/images/image 7.svg" alt="" class="icon size-2.5 sm:size-4 md:size-7 mt-2 sm:mt-5 shrink-0">
                                            <span class="text-[8px] sm:text-xs xl:text-sm text-[#505050] pt-1 sm:pt-4">Саратов, Фрунзенский район, ул. Вольская, 81</span>
                                        </div>
                                        <form action="{{ route('all-attractions') }}">
                                            <button class="shrink-0 size-5 sm:size-10 xl:size-11 2xl:size-15 bg-linear-to-r from-[#A556F7] to-[#2663EB] rounded-full flex items-center justify-center hover:opacity-90 transition-opacity">
                                                <img src="/images/Arrow 2.png" alt="" class="icon w-1 sm:w-2 xl:w-3 2xl:w-4 h-2.5 sm:h-4.5 xl:h-6 2xl:h-7.5">
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Карточка 1 -->
                    <div class="snap-start shrink-0 w-[calc(50%-8px)] sm:w-80 lg:w-[calc(33.333%-16px)] bg-white rounded-[19px] overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300">
                        <div class="p-2 sm:p-4 2xl:p-5 h-full flex flex-col">
                            <div class="w-full mb-4 overflow-hidden rounded-lg shrink-0">
                                <img src="/images/image 23.png" alt="Дом книги">
                            </div>

                            <div class="font-['FindSansPro'] flex flex-col h-26 sm:h-50 md:h-60">
                                <div class="grow">
                                    <h4 class="">Дом книги</h4>
                                    <p class="text-[7px] sm:text-base text-[#888888] line-clamp-4">Архитектура и памятники, театры и культурные центры</p>
                                </div>

                                <div class="shrink-0 mt-2 mb-3">
                                    <div class="flex items-end justify-between gap-2">
                                        <div class="flex gap-1 sm:gap-4 flex-1 max-w-37 sm:max-w-75">
                                            <img src="/images/image 7.svg" alt="" class="icon size-2.5 sm:size-4 md:size-7 mt-2 sm:mt-5 shrink-0">
                                            <span class="text-[8px] sm:text-xs xl:text-sm text-[#505050] pt-1 sm:pt-4">Саратов, Фрунзенский район, ул. Вольская, 81</span>
                                        </div>
                                        <form action="{{ route('all-attractions') }}">
                                            <button class="shrink-0 size-5 sm:size-10 xl:size-11 2xl:size-15 bg-linear-to-r from-[#A556F7] to-[#2663EB] rounded-full flex items-center justify-center hover:opacity-90 transition-opacity">
                                                <img src="/images/Arrow 2.png" alt="" class="icon w-1 sm:w-2 xl:w-3 2xl:w-4 h-2.5 sm:h-4.5 xl:h-6 2xl:h-7.5">
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Карточка 1 -->
                    <div class="snap-start shrink-0 w-[calc(50%-8px)] sm:w-80 lg:w-[calc(33.333%-16px)] bg-white rounded-[19px] overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300">
                        <div class="p-2 sm:p-4 2xl:p-5 h-full flex flex-col">
                            <div class="w-full mb-4 overflow-hidden rounded-lg shrink-0">
                                <img src="/images/image 23.png" alt="Дом книги">
                            </div>

                            <div class="font-['FindSansPro'] flex flex-col h-26 sm:h-50 md:h-60">
                                <div class="grow">
                                    <h4 class="">Дом книги</h4>
                                    <p class="text-[7px] sm:text-base text-[#888888] line-clamp-4">Архитектура и памятники, театры и культурные центры</p>
                                </div>

                                <div class="shrink-0 mt-2 mb-3">
                                    <div class="flex items-end justify-between gap-2">
                                        <div class="flex gap-1 sm:gap-4 flex-1 max-w-37 sm:max-w-75">
                                            <img src="/images/image 7.svg" alt="" class="icon size-2.5 sm:size-4 md:size-7 mt-2 sm:mt-5 shrink-0">
                                            <span class="text-[8px] sm:text-xs xl:text-sm text-[#505050] pt-1 sm:pt-4">Саратов, Фрунзенский район, ул. Вольская, 81</span>
                                        </div>
                                        <form action="{{ route('all-attractions') }}">
                                            <button class="shrink-0 size-5 sm:size-10 xl:size-11 2xl:size-15 bg-linear-to-r from-[#A556F7] to-[#2663EB] rounded-full flex items-center justify-center hover:opacity-90 transition-opacity">
                                                <img src="/images/Arrow 2.png" alt="" class="icon w-1 sm:w-2 xl:w-3 2xl:w-4 h-2.5 sm:h-4.5 xl:h-6 2xl:h-7.5">
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Стрелки навигации (только на десктопе) -->
                    <div class="absolute top-1/2 -translate-y-1/2 left-0 -translate-x-4 opacity-0 group-hover:opacity-100 transition-opacity hidden lg:block">
                        <button onclick="this.closest('.group').querySelector('.overflow-x-auto').scrollBy({left: -400, behavior: 'smooth'})"
                                class="scroll-button hover:text-blue-500 transition-colors">
                            <i class="fas fa-chevron-left"></i>
                        </button>
                    </div>

                    <div class="absolute top-1/2 -translate-y-1/2 right-12 translate-x-4 opacity-0 group-hover:opacity-100 transition-opacity hidden lg:block">
                        <button onclick="this.closest('.group').querySelector('.overflow-x-auto').scrollBy({left: 400, behavior: 'smooth'})"
                                class="scroll-button hover:text-blue-500 transition-colors">
                            <i class="fas fa-chevron-right"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
