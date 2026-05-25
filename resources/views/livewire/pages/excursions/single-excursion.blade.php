@section('title')
    Саратов 435 - Модерн в Саратове
@endsection
<div>

    <section id="home" class="relative mt-25 md:mt-42 3xl:mt-70.5 ">
        <div class="max-w-6xl xl:max-w-7xl 3xl:max-w-398.25 px-4 sm:px-20 mx-auto relative">
            <div class="relative overflow-hidden rounded-lg sm:rounded-2xl md:rounded-[30px] md:h-[500px] h-54 sm:h-116 xl:h-180 3xl:h-226">
                <div class="absolute inset-0 bg-cover bg-center bg-no-repeat"
                     style="background-image: url('{{ $excursion->attachments->get(0)?->url() ?? "" }}')">
                </div>
                <div class="absolute inset-x-0 bottom-0 h-40 sm:h-60 md:h-100 bg-linear-to-t from-black via-black/30 sm:via-black/50 to-transparent"></div>
                <div class="absolute w-full h-full flex justify-center items-end">
                    <h1 class="text-base sm:text-3xl xl:text-6xl text-white font-extrabold pb-4 sm:pb-15">{{$excursion->name}}</h1>
                </div>
            </div>

            <a href="{{ route('all-excursions') }}"
               class="absolute left-14 -top-14 xl:-top-15 3xl:-top-25 hidden md:flex items-center xl:gap-2 text-[#5F5F5F] hover:text-blue-900 transition-colors font-['FindSansPro']">
                <i class="fa-solid fa-chevron-left text-xl xl:text-xl 2xl:text-3xl"></i>
                <span class="text-xl xl:text-3xl pl-4">Экскурсии</span>
            </a>

{{--            <button class="absolute top-5 md:top-10 right-26 md:right-28 xl:top-15 flex items-center text-white transition-colors font-['FindSansPro'] bg-[#A855F7] rounded-lg px-4 py-4 cursor-pointer">--}}
{{--                <i class="fa-sharp fa-solid fa-heart text-base sm:text-xl lg:text-2xl xl:text-4xl"></i>--}}
{{--                <span class="text-xs sm:text-sm lg:text-base xl:text-xl pl-4 text-nowrap">Добавить в избранное</span>--}}
{{--            </button>--}}
        </div>
    </section>

    <section class="features-section pt-8 md:pt-10 xl:pt-15 2xl:pt-26 pb-4 sm:pb-10 lg:pb-20 2xl:pb-26 3xl:pb-36 bg-white">
        <div class="max-w-6xl xl:max-w-7xl 3xl:max-w-398.25 px-4 sm:px-20 mx-auto">
            <div class="flex flex-col lg:flex-row items-center justify-between gap-5 xl:gap-11">
                <div data-aos="fade-right" class="max-w-full lg:max-w-120 xl:max-w-150 3xl:max-w-206 lg:w-auto">
                    <p class="text-base lg:text-lg/relaxed xl:text-2xl 3xl:text-3xl/relaxed">
                        {{$excursion->description}}
                    </p>
                </div>
                <div data-aos="fade-left" class="flex flex-col gap-7 w-full lg:w-auto">
                    <div class="flex flex-col w-full justify-around bg-[#E5E6F6] gap-3 md:gap-6.75 px-6 xl:px-11 py-8 rounded-[20px] font-['FindSansPro'] text-sm sm:text-base xl:text-2xl">
                        <div class="flex items-center gap-2 xl:gap-5">
                            <i class="fa-solid fa-location-dot"></i>
                            <p>{{ $excursion->meeting_point }}</p>
                        </div>
                        <div class="flex items-center gap-2 xl:gap-5">
                            <img class="size-4 sm:size-6 xl:size-7.5 icon" src="/images/значок локации.svg">
                            <p>{{ $excursion->meeting_address }}</p>
                        </div>
                        <div class="flex items-center gap-2 xl:gap-5">
                            <img class="size-4 sm:size-6 xl:size-7.5 icon" src="/images/image 15.svg">
                            <p>{{ $excursion->operator_phone }}</p>
                        </div>
                        <div class="flex items-center gap-2 xl:gap-5">
                            <img class="size-4 sm:size-6 xl:size-7.5 icon" src="/images/image 8.svg">
                            <p>{{ $excursion->duration }} минут</p>
                        </div>
                        <div class="flex items-center gap-2 xl:gap-5">
                            <img class="size-4 sm:size-6 xl:size-7.5 icon" src="/images/image 17.svg">
                            <p>{{ $excursion->type }}</p>
                        </div>
                    </div>
                    <button class="w-full bg-linear-to-r from-green-500 to-teal-600 text-white py-6 rounded-[30px] hover:shadow-lg transition cursor-pointer font-['FindSansPro'] text-lg sm:text-xl xl:text-3xl">Показать на карте</button>
                </div>
            </div>
        </div>
    </section>

    <!--Places Section-->
    <section class="sm:py-2 md:py-15 3xl:py-25 md:bg-[#E5E6F6]">
        <div class="flex flex-col gap-5 md:gap-4 lg:flex-row max-w-6xl xl:max-w-7xl 3xl:max-w-398.25 px-4 sm:px-20 mx-auto">
            <div class="flex flex-col items-center md:items-start justify-between font-['FindSansPro']">
                <h2>Места, которые  вы посетите</h2>
                <div class="flex flex-col items-center md:items-start justify-center gap-3 3xl:gap-6 text-base xl:text-xl 3xl:text-2xl">
                    <div class="flex items-center">
                        <img class="icon max-w-3 max-h-3 lg:max-w-5 lg:max-h-7 2xl:max-w-[26px] 2xl:max-h-[31px] mr-2.5 lg:mr-6" src="/images/значок локации.svg">
                        <p>Сад Липки</p>
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
                <a href="" class="w-full bg-linear-to-r from-purple-500 to-blue-600 text-white px-4 rounded-[30px] hover:shadow-lg transition text-center cursor-pointer mt-7 py-4 max-w-full md:max-w-[585px]">
                    <div class="text-[16px] lg:text-[18px] xl:text-xl 3xl:text-2xl">Задать вопрос AI Ассистенту Саре</div>
                </a>
            </div>
            <div class="job-swiper__swiper swiper mx-auto max-w-full lg:max-w-100 xl:max-w-150 3xl:max-w-200 max-h-129.5 relative">
                <div class="swiper-wrapper">
                    @foreach($excursion->attachments as $attachment)
                        <div class="swiper-slide flex! justify-center items-center">
                            <img src="{{ $attachment->url() }}" class="w-200 h-100 photo object-cover rounded-xl">
                        </div>
                    @endforeach
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
    <section class="features-section pt-6 md:pt-10 xl:pt-15 2xl:pt-25 bg-white">
        <div class="max-w-6xl xl:max-w-7xl 3xl:max-w-398.25 px-4 sm:px-20 mx-auto flex flex-col gap-12">
            <div data-aos="fade-right" class="font-['FindSansPro'] flex flex-col items-center lg:items-start">
                <h3>Достижения</h3>
                <p class="text-lg md:text-2xl text-center lg:text-left">За прохождение “{{$excursion->name}}” вы получите:</p>
                <div class="flex flex-row flex-wrap gap-4 lg:gap-10 justify-center lg:justify-start items-center text-sm pt-4 lg:pt-5 3xl:pt-7 md:text-xl">
                    <div class="text-white rounded-4xl bg-linear-to-r from-green-500 to-teal-600 py-3 sm:py-4.5 px-8 sm:px-15">+1 к “Исследователю”</div>
                    <div class="gradient-button text-white rounded-4xl py-3 sm:py-4.5 px-8 sm:px-15">+1 к “Первооткрывателю” </div>
                    <a href="#" class="text-[#636363]"> перейти к другим квестам и достижениям ></a>
                </div>
            </div>
        </div>
    </section>


    <!-- Places Nearby -->
    <section class="py-10 xl:py-26 bg-white px-5 sm:px-10">
        <div class="max-w-3xl lg:max-w-5xl xl:max-w-7xl 2xl:max-w-398.25 mx-auto px-5 xl:px-20">

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

                    <!-- Карточка 2 -->
                    <div class="snap-start shrink-0 w-[calc(50%-8px)] sm:w-80 lg:w-[calc(33.333%-16px)] bg-white rounded-[19px] overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300">
                        <div class="p-2 sm:p-4 2xl:p-5 h-full flex flex-col">
                            <div class="w-full mb-4 overflow-hidden rounded-lg shrink-0">
                                <img src="/images/image 23 (1).png" alt="Театр">
                            </div>

                            <div class="font-['FindSansPro'] flex flex-col h-26 sm:h-50 md:h-60">
                                <div class="grow">
                                    <h4 class="">Саратовский цирк им. братьев Никитиных</h4>
                                    <p class="text-[7px] sm:text-base text-[#888888] line-clamp-4">Театры и культурные центры</p>
                                </div>

                                <div class="shrink-0 mt-2 mb-3">
                                    <div class="flex items-end justify-between gap-2">
                                        <div class="flex gap-1 sm:gap-4 flex-1 max-w-37 sm:max-w-75">
                                            <img src="/images/image 7.svg" alt="" class="icon size-2.5 sm:size-4 md:size-7 mt-2 sm:mt-5 shrink-0">
                                            <span class="text-[8px] sm:text-xs xl:text-sm text-[#505050] pt-1 sm:pt-4">Саратов, Фрунзенский район, ул. Чапаева, 61</span>
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

                    <!-- Карточка 3 -->
                    <div class="snap-start shrink-0 w-[calc(50%-8px)] sm:w-80 lg:w-[calc(33.333%-16px)] bg-white rounded-[19px] overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300">
                        <div class="p-2 sm:p-4 2xl:p-5 h-full flex flex-col">
                            <div class="w-full mb-4 overflow-hidden rounded-lg shrink-0">
                                <img src="/images/image 22.png" alt="Набережная">
                            </div>

                            <div class="font-['FindSansPro'] flex flex-col h-26 sm:h-50 md:h-60">
                                <div class="grow">
                                    <h4 class="">Набережная космонавтов</h4>
                                    <p class="text-[7px] sm:text-base text-[#888888] line-clamp-4">Архитектура и памятники, парки и природа</p>
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
