@section('title')
    Саратов 435 - Экскурсии
@endsection

<div>
    <!--Hero Section-->
    <section class="features-section pt-28 md:pt-35 xl:pt-31 3xl:pt-41.5 md:pb-15 xl:pb-20 3xl:pb-26 bg-white">
        <div class="max-w-6xl 3xl:max-w-421 mx-auto px-4 sm:px-10">
            <div class="text-center mb-4 md:mb-10 3xl:mb-25">
                <h2 class="title-big ">Туры и экскурсии</h2>
                <p class="text text-gray-600">Лучшие маршруты и впечатления рядом</p>
            </div>
            <div class="flex flex-col-reverse md:flex-row items-center gap-5 lg:gap-9.5">
                <div data-aos="fade-right">
                    <p class="text-base xl:text-lg 3xl:text-xl text-black">Саратов открывается по-настоящему интересно на экскурсиях: от набережной Волги и старинных купеческих кварталов до уютных двориков и смотровых площадок с панорамами города. Вы можете выбрать обзорный маршрут по центру, тематические прогулки по истории и архитектуре, гастрономические туры или поездки по окрестностям. Профессиональные гиды расскажут о людях, событиях и легендах, которые сформировали характер Саратова, а формат подберём под ваш темп: пешком, на транспорте или индивидуально. Откройте город через живые истории, красивые виды и атмосферу Волги.
                    </p>
                </div>
                <div data-aos="fade-left" class="min-w-full md:min-w-88 lg:min-w-146 h-88 xl:h-90 3xl:h-auto 3xl:min-w-237.5">
                    <img src="/images/4fe8539f70401070351fe8228c84deaf619dded8.jpg" class="rounded-md md:rounded-2xl">
                </div>
            </div>
        </div>
    </section>

    @livewire('saratov-ai')

    <!-- Section with tour cards -->
    <section class="bg-white pb-10 sm:pb-15 xl:pb-20 3xl:pb-26">
        <div class="max-w-3xl lg:max-w-5xl xl:max-w-7xl 2xl:max-w-380 3xl:max-w-398.25 mx-auto px-4 sm:px-10">
            <div class="text-center mb-5 3xl:mb-12" data-aos="fade-up">
                <h2 class="title-big">Популярные экскурсии в Саратове</h2>
                <p class="text text-gray-600 content-center">Лучшие экскурсии от профессиональных гидов и местных жителей.</p>
            </div>
            <div class="w-full">
                <div class="filter overflow-x-auto md:overflow-x-auto lg:overflow-visible scrollbar-hide px-4 py-3 lg:p-6">
                    <div class="text-xs md:text-base flex md:flex-wrap justify-center gap-2 lg:gap-3 min-w-min lg:min-w-0 w-max lg:w-full">

                        <!-- Дата -->
                        <div class="relative group">
                            <select id="date-filter" name="date-filter"
                                    class="appearance-none bg-[#7676801F] hover:bg-black  hover:text-white focus:bg-black focus-within:text-white  transition-colors duration-200 rounded-[40px] py-2.5 pl-4 pr-9  cursor-pointer outline-none w-auto min-w-[120px]">
                                <option value="date" selected disabled hidden>Дата</option>
                                <option value="all">Любое время</option>
                                <option value="today">Сегодня</option>
                                <option value="tomorrow">Завтра</option>
                                <option value="week">Эта неделя</option>
                                <option value="month">Этот месяц</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-3 flex items-center">
                                <i class="fas fa-chevron-down text-xs text-gray-600 transition-all duration-200 group-hover:text-white group-focus-within:text-white group-focus-within:rotate-180"></i>
                            </div>
                        </div>

                        <!-- Время -->
                        <div class="relative group">
                            <select id="time-filter" name="time-filter"
                                    class="appearance-none bg-[#7676801F] hover:bg-black  hover:text-white focus:bg-black focus-within:text-white  transition-colors duration-200 rounded-[40px] py-2.5 pl-4 pr-9  cursor-pointer outline-none w-auto min-w-[120px]">
                                <option value="time" selected disabled hidden>Время</option>
                                <option value="all">Любое время</option>
                                <option value="morning">Утро (6:00-12:00)</option>
                                <option value="afternoon">День (12:00-18:00)</option>
                                <option value="evening">Вечер (18:00-24:00)</option>
                                <option value="night">Ночь (0:00-6:00)</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-3 flex items-center">
                                <i class="fas fa-chevron-down text-xs text-gray-600 transition-all duration-200 group-hover:text-white group-focus-within:text-white group-focus-within:rotate-180"></i>
                            </div>
                        </div>

                        <!-- Цена -->
                        <div class="relative group">
                            <select id="price-filter" name="price-filter"
                                    class="appearance-none bg-[#7676801F] hover:bg-black  hover:text-white focus:bg-black focus-within:text-white  transition-colors duration-200 rounded-[40px] py-2.5 pl-4 pr-9  cursor-pointer outline-none w-auto min-w-[120px]">
                                <option value="price" selected disabled hidden>Цена</option>
                                <option value="all">Любая цена</option>
                                <option value="budget">До 1000 ₽</option>
                                <option value="medium">1000-3000 ₽</option>
                                <option value="high">3000-5000 ₽</option>
                                <option value="luxury">5000+ ₽</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-3 flex items-center">
                                <i class="fas fa-chevron-down text-xs text-gray-600 transition-all duration-200 group-hover:text-white group-focus-within:text-white group-focus-within:rotate-180"></i>
                            </div>
                        </div>

                        <!-- Количество человек -->
                        <div class="relative group">
                            <select id="number-filter" name="number-filter"
                                    class="appearance-none bg-[#7676801F] hover:bg-black  hover:text-white focus:bg-black focus-within:text-white  transition-colors duration-200 rounded-[40px] py-2.5 pl-4 pr-9  cursor-pointer outline-none w-auto min-w-[120px]">
                                <option value="number" selected disabled hidden>Количество человек</option>
                                <option value="all">Любое количество</option>
                                <option value="1">1 человек</option>
                                <option value="2">2 человека</option>
                                <option value="3">3 человека</option>
                                <option value="4">4 человека</option>
                                <option value="5">5+ человек</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-3 flex items-center">
                                <i class="fas fa-chevron-down text-xs text-gray-600 transition-all duration-200 group-hover:text-white group-focus-within:text-white group-focus-within:rotate-180"></i>
                            </div>
                        </div>

                        <!-- Передвижение -->
                        <div class="relative group">
                            <select id="movement-filter" name="movement-filter"
                                    class="appearance-none bg-[#7676801F] hover:bg-black  hover:text-white focus:bg-black focus-within:text-white  transition-colors duration-200 rounded-[40px] py-2.5 pl-4 pr-9  cursor-pointer outline-none w-auto min-w-[120px]">
                                <option value="movement" selected disabled hidden>Передвижение</option>
                                <option value="all">Любое передвижение</option>
                                <option value="walking">Пешком</option>
                                <option value="car">Автомобиль</option>
                                <option value="public">Общественный транспорт</option>
                                <option value="bike">Велосипед</option>
                                <option value="taxi">Такси</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-3 flex items-center">
                                <i class="fas fa-chevron-down text-xs text-gray-600 transition-all duration-200 group-hover:text-white group-focus-within:text-white group-focus-within:rotate-180"></i>
                            </div>
                        </div>

                        <!-- Точки посещения -->
                        <div class="relative group">
                            <select id="visit-filter" name="visit-filter"
                                    class="appearance-none bg-[#7676801F] hover:bg-black  hover:text-white focus:bg-black focus-within:text-white  transition-colors duration-200 rounded-[40px] py-2.5 pl-4 pr-9  cursor-pointer outline-none w-auto min-w-[120px]">
                                <option value="visit" selected disabled hidden>Точки посещения</option>
                                <option value="all">Любые точки</option>
                                <option value="restaurant">Рестораны</option>
                                <option value="museum">Музеи</option>
                                <option value="park">Парки</option>
                                <option value="mall">Торговые центры</option>
                                <option value="theater">Театры</option>
                                <option value="cinema">Кинотеатры</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-3 flex items-center">
                                <i class="fas fa-chevron-down text-xs text-gray-600 transition-all duration-200 group-hover:text-white group-focus-within:text-white group-focus-within:rotate-180"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-2 xl:grid-cols-3 gap-1 sm:gap-3 lg:gap-7.5 p-6">
                @foreach ($excursions as $excursion)
                    <div class="card bg-white rounded-[7px] sm:rounded-[19px] overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300 mb-2">
                        <div class="card-content p-2 sm:p-6 relative">
                            <div class="">
                                <img src="{{ $excursion->attachments?->get(0)?->url() ?? "" }}"  alt="Изображение {{ $excursion->name }}" class="rounded-[7px] sm:rounded-[19px]">
{{--                                <div class="absolute top-4 right-3.5 sm:top-10 sm:right-9.5 size-5 sm:size-10 xl:size-15 bg-[#A855F7] rounded-[3px] sm:rounded-md xl:rounded-xl flex items-center justify-center text-white text-xs sm:text-xl xl:text-3xl shadow-lg">--}}
{{--                                    <i class="fa-sharp fa-solid fa-heart"></i>--}}
{{--                                </div>--}}
                            </div>
                            <div class="flex flex-col font-['FindSansPro'] mt-3 sm:mt-4">
                                <h1 class="text-xs sm:text-lg lg:text-xl xl:text-2xl 3xl:text-3xl font-bold md:pt-3 line-clamp-2 sm:line-clamp-3 h-8 sm:h-22 md:h-25 xl:h-28 3xl:h-32">{{$excursion->name}}</h1>
                                <div class="flex flex-col">
                                    <div class="flex flex-row text-[8px] sm:text-sm lg:text-base xl:text-[22px] font-light gap-6 text-[#5F5F5F] mt-5 mb-0 sm:mb-2 lg:mb-6">
                                    <span class="flex items-center gap-2">
                                        <i class="fa-solid fa-clock"></i>
                                        2 часа
                                    </span>
                                        <span class="flex items-center gap-2">
                                        <i class="fas fa-map-marker-alt"></i>
                                        6 точек
                                    </span>
                                    </div>
                                    <a href="{{ route('single-excursion', ['excursion' => $excursion->slug]) }}" class="w-full gradient-button text-white text-[8px] sm:text-base xl:text-xl py-1 lg:py-2 rounded-[3px] sm:rounded-lg hover:opacity-90 transition-opacity text-center">
                                        Подробнее
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
</div>
