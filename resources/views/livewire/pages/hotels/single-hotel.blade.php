@section('title')
    Саратов 435 - {{ $hotel->name }}
@endsection

<div>
    <!--Hero Section-->
    <section>
        <div class="max-w-6xl 3xl:max-w-421 mx-auto px-4 sm:px-10 pt-24 sm:pt-29 xl:pt-33">
            <h2 class="sm:pb-6 lg:hidden text-center">{{ $hotel->name }}</h2>
            <div class="flex flex-col lg:flex-row items-center justify-center gap-3 sm:gap-5 lg:gap-11 pb-3 sm:pb-10 lg:pb-6 3xl:pb-15">
                <div class="flex flex-row gap-2 sm:gap-3 3xl:gap-5 w-full">
                    @php
                        $attachments = $hotel->attachments;
                        $count = $attachments->count();
                    @endphp
                    <img src="{{ $hotel->attachments?->get(0)?->url() ?? "" }}" alt="Изображение {{ $hotel->name }}" class="photo object-cover w-full rounded-md sm:rounded-lg lg:rounded-2xl  max-h-25 xs:max-h-35 md:max-h-62 lg:max-h-55 3xl:max-h-90">
                    @if($count >= 2)
                        <img src="{{ $hotel->attachments?->get(1)?->url() ?? "" }}" alt="Изображение {{ $hotel->name }}"
                             class="photo object-cover w-full rounded-md sm:rounded-lg lg:rounded-2xl max-h-25 xs:max-h-35 md:max-h-62 lg:max-h-55 3xl:max-h-90">
                    @endif

                    @if($count >= 3)
                        <img src="{{ $hotel->attachments?->get(2)?->url() ?? "" }}" alt="Изображение {{ $hotel->name }}"
                             class="photo object-cover w-full rounded-md sm:rounded-lg lg:rounded-2xl max-h-25 xs:max-h-35 md:max-h-62 lg:max-h-55 3xl:max-h-90">
                    @endif
                </div>
                <p class="text-base xl:text-lg 2xl:text-xl w-full lg:max-w-80 xl:max-w-114 3xl:max-w-151.5">
                    {{ $hotel->description }}
                </p>
            </div>
            <h2 class="pb-3 3xl:pb-6 hidden lg:block text-center">{{ $hotel->name }}</h2>
            <div class="flex flex-col lg:flex-row-reverse items-center justify-center gap-3 sm:gap-5 lg:gap-11">
                <div class="flex flex-row gap-2 sm:gap-3 3xl:gap-5 w-full">
                    @php
                        $attachments = $hotel->attachments;
                        $count = $attachments->count();
                    @endphp
                    @if($count >= 4)
                        <img src="{{ $hotel->attachments?->get(3)?->url() ?? "" }}" alt="Изображение {{ $hotel->name }}"
                             class="photo object-cover w-full rounded-md sm:rounded-lg lg:rounded-2xl max-h-25 xs:max-h-35 md:max-h-62 lg:max-h-67 xl:max-h-90">
                    @endif
                    @if($count >= 5)
                        <img src="{{ $hotel->attachments?->get(4)?->url() ?? "" }}" alt="Изображение {{ $hotel->name }}"
                             class="photo w-full lg:w-55 xl:w-67 3xl:w-full object-cover rounded-md sm:rounded-lg lg:rounded-2xl max-h-25 xs:max-h-35 md:max-h-62 lg:max-h-67 xl:max-h-90">
                    @endif
                </div>
                <p class="text-base xl:text-lg 2xl:text-xl w-full lg:max-w-114 3xl:max-w-151.5 text-left lg:text-right xl:text-left">
                    {{ $hotel->secondDescription }}
                </p>
            </div>
        </div>
    </section>

    <section class="features-section pt-8 md:pt-10 xl:pt-20 3xl:pt-26 pb-10 lg:pb-20 xl:pb-20 3xl:pb-36 bg-white">
        <div class="max-w-6xl 3xl:max-w-421 mx-auto px-4 sm:px-10">
            <div class="flex flex-col md:flex-row items-center justify-between gap-5 lg:gap-10 xl:gap-13.5">
                <div data-aos="fade-left" class="flex flex-col gap-7 w-full">
                    <div class="flex flex-col w-full justify-around bg-[#E5E6F6] gap-3 md:gap-6.75 px-6 xl:px-7 3xl:px-11 py-6 lg:py-8 rounded-[20px] font-['FindSansPro'] text-sm sm:text-sm lg:text-lg 2xl:text-lg 3xl:text-2xl">
                        <div class="flex items-center gap-3 xl:gap-5">
                            <img class="size-4 sm:size-6 xl:size-7.5 icon" src="/images/значок локации.svg">
                            <p>{{ $hotel->address }}</p>
                        </div>
                        <div class="flex items-center gap-3 xl:gap-5">
                            <img class="size-4 sm:size-6 xl:size-7.5 icon" src="/images/image 15.svg">
                            <p>{{ $hotel->phone }}</p>
                        </div>
                        <div class="flex items-center gap-3 xl:gap-5">
                            <img class="size-4 sm:size-6 xl:size-7.5 icon" src="/images/image 8.svg">
                            <p>{{ $hotel->worktime }}</p>
                        </div>
                        <div class="flex items-center gap-2 xl:gap-5">
                            <i class="fa fa-home text-3xl"></i>
                            <p>{{ $hotel->category}}</p>
                        </div>
                    </div>
                </div>
                <div data-aos="fade-right" class="font-['FindSansPro'] flex flex-col-reverse md:flex-col gap-5 md:gap-0 w-full md:w-auto">
                    <div>
                        <h3 class="text-center md:text-left pb-2 md:pb-0">Достижения</h3>
                        <p class="text-base xl:text-lg 3xl:text-2xl lg:text-nowrap">За прохождение “{{$hotel->name}}” вы получите:</p>
                        <div class="flex flex-row md:flex-col flex-wrap gap-2 lg:gap-4 justify-between md:justify-start items-center md:items-start pt-4 lg:pt-5 3xl:pt-7 text-[9px] sm:text-[13px] lg:text-base xl:text-lg 3xl:text-xl">
                            <div class="text-white rounded-4xl gradient-button py-3 lg:py-4.5 px-8 lg:px-15">+1 к “Исследователю”</div>
                            <a href="#" class="text-[#636363] text-nowrap"> перейти к другим квестам и достижениям ></a>
                        </div>
                    </div>
                    <button class="w-full bg-linear-to-r from-green-500 to-teal-600 text-white py-3 xl:py-6 rounded-[30px] hover:shadow-lg transition cursor-pointer font-['FindSansPro'] text-lg sm:text-lg xl:text-xl 3xl:text-3xl md:mt-4">Показать на карте</button>
                </div>
            </div>
        </div>
    </section>

    <!-- Places Nearby -->
    <section class="pb-10 xl:pb-20 3xl:pb-26 bg-white px-4 sm:px-10">
        <div class="max-w-6xl xl:max-w-7xl 3xl:max-w-398.25 mx-auto">

            <div class="text-center mb-4 lg:mb-7 3xl:mb-12">
                <h2 class="text-2xl md:text-3xl font-bold mb-4">Места рядом</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Интересные локации, которые удобно посетить по пути: знаковые точки, уютные уголки и лучшие места для фото.</p>
            </div>

            <!-- Карусель -->
            <div class="relative group">
                <div class="flex overflow-x-auto gap-1 xs:gap-4 md:gap-6 pb-6 scrollbar-hide scroll-smooth snap-x snap-mandatory"
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
                    <div class="absolute top-1/2 -translate-y-1/2 left-0 -translate-x-4 opacity-0 group-hover:opacity-100 transition-opacity hidden md:block">
                        <button onclick="this.closest('.group').querySelector('.overflow-x-auto').scrollBy({left: -400, behavior: 'smooth'})"
                                class="scroll-button hover:text-blue-500 transition-colors">
                            <i class="fas fa-chevron-left"></i>
                        </button>
                    </div>

                    <div class="absolute top-1/2 -translate-y-1/2 right-12 translate-x-4 opacity-0 group-hover:opacity-100 transition-opacity hidden md:block">
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
