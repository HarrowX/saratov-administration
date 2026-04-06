@section('title')
    Саратов 435 - {{ $restaurant->name }}
@endsection

<div>
    <!--Hero Section-->
    <section class="features-section pt-28 md:pt-30 lg:pt-41.5 bg-white">
        <div class="max-w-3xl lg:max-w-5xl xl:max-w-7xl 3xl:max-w-398.25 mx-auto px-5 sm:px-10">
            <div class="flex flex-col-reverse lg:flex-row items-center gap-5 sm:gap-10 3xl:gap-22.5">
                <div data-aos="fade-right" class="flex flex-col gap-5 w-full lg:w-auto">

                    <div class="min-w-full sm:min-w-140 xl:min-w-180 3xl:min-w-197">
                        <img src="{{ $restaurant->attachments?->get(0)?->url() ?? "" }}" class="photo w-full h-auto rounded-md sm:rounded-lg lg:rounded-2xl object-cover">
                    </div>

                    <div class="grid grid-cols-3 gap-5 w-full">
                        @foreach ($restaurant->attachments as $attachment)
                            @if ($loop->first)
                                @continue
                            @endif
                            <img src="{{ $attachment?->url() ?? "" }}" class="photo w-full h-auto rounded-md sm:rounded-lg lg:rounded-2xl object-cover">
                        @endforeach
                    </div>
                </div>

                <div data-aos="fade-left" class="w-full lg:w-auto">
                    <h2 class="text-center lg:pb-10">{{ $restaurant->name }}</h2>
                    <p class="text-base xl:text-xl 3xl:text-3xl">{{ $restaurant->description }}</p>
                </div>
            </div>
        </div>
    </section>

    <section class="pt-13 bg-white">
        <div class="max-w-3xl lg:max-w-5xl xl:max-w-7xl 3xl:max-w-398.25 mx-auto px-5 xl:px-20 flex flex-col gap-5 md:gap-12">
            <div class="flex flex-col md:flex-row gap-2.5 md:gap-10 3xl:gap-33.5">
                <div class="flex flex-col w-full justify-around bg-[#E5E6F6] gap-3 md:gap-6.75 px-6 md:px-11 py-6 3xl:py-8 rounded-[20px] font-['FindSansPro'] text-sm sm:text-lg 3xl:text-2xl">
                    <div class="flex items-center gap-5">
                        <img class="size-4 sm:size-6 md:size-7.5 icon" src="/images/значок локации.svg">
                        <p>{{ $restaurant->address }}</p>
                    </div>
                    <div class="flex items-start gap-5">
                        <img class="size-4 sm:size-6 md:size-7.5 icon" src="/images/image 8.svg">
                        <div class="flex flex-col gap-2">
                            @forelse($restaurant->worktime ?? [] as $day => $time)
                                <p>{{ $day }}: {{ $time }}</p>
                            @empty
                                <p>Не указано</p>
                            @endforelse
                        </div>
                    </div>
                    <div class="flex items-center gap-5">
                        <img class="size-4 sm:size-6 md:size-7.5 icon" src="/images/image 15.svg">
                        <p>{{ $restaurant->phone }}</p>
                    </div>
                </div>
                <div class="w-full flex flex-col gap-2.5">
                    <div class="bg-[#E5E6F6] px-6 md:px-11 py-3 rounded-[20px] font-['FindSansPro'] text-xs md:text-lg 3xl:text-2xl">
                        <h3>Кухня</h3>
                        <p class="text-[#5F5F5F]">{{ $restaurant->kitchen }}</p>
                    </div>
                    <button class="w-full bg-linear-to-r from-green-500 to-teal-600 text-white py-5 md:py-6 rounded-[20px] lg:rounded-[30px] hover:shadow-lg transition cursor-pointer font-['FindSansPro'] text-lg sm:text-xl 3xl:text-3xl">Показать на карте</button>
                </div>
            </div>
            <div class="font-['FindSansPro'] flex flex-col items-center lg:items-start">
                <h3>Достижения</h3>
                <p class="text-lg md:text-2xl text-center lg:text-left">За посещение ресторана “{{ $restaurant->name }}” вы получите:</p>
                <div class="flex flex-row flex-wrap gap-4 lg:gap-10 justify-center lg:justify-start items-center text-sm pt-4 lg:pt-5 3xl:pt-7 md:text-xl">
                    <div class="text-white rounded-4xl bg-linear-to-r from-green-500 to-teal-600 py-3 sm:py-4.5 px-8 sm:px-15">+1 к “Знатоку города” </div>
                    <div class="gradient-button text-white rounded-4xl py-3 sm:py-4.5 px-8 sm:px-15">+1 к “Первооткрывателю” </div>
                    <a href="#" class="text-[#636363]">перейти к другим квестам и достижениям ></a>
                </div>
            </div>
        </div>
    </section>

    <section class="py-10 xl:py-26 bg-white">
        <div class="max-w-3xl lg:max-w-5xl xl:max-w-7xl 3xl:max-w-398.25 mx-auto  px-5 xl:px-20">

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
                        <div class="p-2 sm:p-4 3xl:p-5 h-full flex flex-col">
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
                                            <button class="shrink-0 size-5 sm:size-10 xl:size-11 3xl:size-15 bg-linear-to-r from-[#A556F7] to-[#2663EB] rounded-full flex items-center justify-center hover:opacity-90 transition-opacity">
                                                <img src="/images/Arrow 2.png" alt="" class="icon w-1 sm:w-2 xl:w-3 3xl:w-4 h-2.5 sm:h-4.5 xl:h-6 3xl:h-7.5">
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Карточка 1 -->
                    <div class="snap-start shrink-0 w-[calc(50%-8px)] sm:w-80 lg:w-[calc(33.333%-16px)] bg-white rounded-[19px] overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300">
                        <div class="p-2 sm:p-4 3xl:p-5 h-full flex flex-col">
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
                                            <button class="shrink-0 size-5 sm:size-10 xl:size-11 3xl:size-15 bg-linear-to-r from-[#A556F7] to-[#2663EB] rounded-full flex items-center justify-center hover:opacity-90 transition-opacity">
                                                <img src="/images/Arrow 2.png" alt="" class="icon w-1 sm:w-2 xl:w-3 3xl:w-4 h-2.5 sm:h-4.5 xl:h-6 3xl:h-7.5">
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Карточка 1 -->
                    <div class="snap-start shrink-0 w-[calc(50%-8px)] sm:w-80 lg:w-[calc(33.333%-16px)] bg-white rounded-[19px] overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300">
                        <div class="p-2 sm:p-4 3xl:p-5 h-full flex flex-col">
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
                                            <button class="shrink-0 size-5 sm:size-10 xl:size-11 3xl:size-15 bg-linear-to-r from-[#A556F7] to-[#2663EB] rounded-full flex items-center justify-center hover:opacity-90 transition-opacity">
                                                <img src="/images/Arrow 2.png" alt="" class="icon w-1 sm:w-2 xl:w-3 3xl:w-4 h-2.5 sm:h-4.5 xl:h-6 3xl:h-7.5">
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Карточка 1 -->
                    <div class="snap-start shrink-0 w-[calc(50%-8px)] sm:w-80 lg:w-[calc(33.333%-16px)] bg-white rounded-[19px] overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300">
                        <div class="p-2 sm:p-4 3xl:p-5 h-full flex flex-col">
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
                                            <button class="shrink-0 size-5 sm:size-10 xl:size-11 3xl:size-15 bg-linear-to-r from-[#A556F7] to-[#2663EB] rounded-full flex items-center justify-center hover:opacity-90 transition-opacity">
                                                <img src="/images/Arrow 2.png" alt="" class="icon w-1 sm:w-2 xl:w-3 3xl:w-4 h-2.5 sm:h-4.5 xl:h-6 3xl:h-7.5">
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Карточка 1 -->
                    <div class="snap-start shrink-0 w-[calc(50%-8px)] sm:w-80 lg:w-[calc(33.333%-16px)] bg-white rounded-[19px] overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300">
                        <div class="p-2 sm:p-4 3xl:p-5 h-full flex flex-col">
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
                                            <button class="shrink-0 size-5 sm:size-10 xl:size-11 3xl:size-15 bg-linear-to-r from-[#A556F7] to-[#2663EB] rounded-full flex items-center justify-center hover:opacity-90 transition-opacity">
                                                <img src="/images/Arrow 2.png" alt="" class="icon w-1 sm:w-2 xl:w-3 3xl:w-4 h-2.5 sm:h-4.5 xl:h-6 3xl:h-7.5">
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Карточка 1 -->
                    <div class="snap-start shrink-0 w-[calc(50%-8px)] sm:w-80 lg:w-[calc(33.333%-16px)] bg-white rounded-[19px] overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300">
                        <div class="p-2 sm:p-4 3xl:p-5 h-full flex flex-col">
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
                                            <button class="shrink-0 size-5 sm:size-10 xl:size-11 3xl:size-15 bg-linear-to-r from-[#A556F7] to-[#2663EB] rounded-full flex items-center justify-center hover:opacity-90 transition-opacity">
                                                <img src="/images/Arrow 2.png" alt="" class="icon w-1 sm:w-2 xl:w-3 3xl:w-4 h-2.5 sm:h-4.5 xl:h-6 3xl:h-7.5">
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

                    <!-- Пагинация для мобильных -->
                    <div class="flex justify-center gap-2 mt-4 lg:hidden">
                        <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                        <div class="w-2 h-2 bg-gray-300 rounded-full"></div>
                        <div class="w-2 h-2 bg-gray-300 rounded-full"></div>
                        <div class="w-2 h-2 bg-gray-300 rounded-full"></div>
                        <div class="w-2 h-2 bg-gray-300 rounded-full"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
