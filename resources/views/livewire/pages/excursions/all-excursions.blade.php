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
                    <img src="{{asset('/images/4fe8539f70401070351fe8228c84deaf619dded8.webp')}}" class="rounded-md md:rounded-2xl">
                </div>
            </div>
        </div>
    </section>

    @livewire('saratov-ai')

    <!-- Section with tour cards -->
    <section class="bg-white pb-10 sm:pb-15 xl:pb-20 3xl:pb-26">
        <div class="max-w-3xl lg:max-w-5xl xl:max-w-7xl 3xl:max-w-398.25 mx-auto px-4 sm:px-10">
            <div class="text-center mb-5 3xl:mb-12" data-aos="fade-up">
                <h2 class="title-big">Популярные экскурсии в Саратове</h2>
                <p class="text text-gray-600 content-center">Лучшие экскурсии от профессиональных гидов и местных жителей.</p>
            </div>
{{--            <div class="w-full">--}}
{{--                <div class="filter overflow-x-auto md:overflow-x-auto lg:overflow-visible scrollbar-hide px-4 py-3 lg:p-6">--}}
{{--                    <div class="text-xs md:text-base flex md:flex-wrap justify-center gap-2 lg:gap-3 min-w-min lg:min-w-0 w-max lg:w-full">--}}

{{--                        <!-- Дата -->--}}
{{--                        <div class="relative group">--}}
{{--                            <select id="date-filter" name="date-filter"--}}
{{--                                    class="appearance-none bg-[#7676801F] hover:bg-black  hover:text-white focus:bg-black focus-within:text-white  transition-colors duration-200 rounded-[40px] py-2.5 pl-4 pr-9  cursor-pointer outline-none w-auto min-w-[120px]">--}}
{{--                                <option value="date" selected disabled hidden>Дата</option>--}}
{{--                                <option value="all">Любое время</option>--}}
{{--                                <option value="today">Сегодня</option>--}}
{{--                                <option value="tomorrow">Завтра</option>--}}
{{--                                <option value="week">Эта неделя</option>--}}
{{--                                <option value="month">Этот месяц</option>--}}
{{--                            </select>--}}
{{--                            <div class="pointer-events-none absolute inset-y-0 right-3 flex items-center">--}}
{{--                                <i class="fas fa-chevron-down text-xs text-gray-600 transition-all duration-200 group-hover:text-white group-focus-within:text-white group-focus-within:rotate-180"></i>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <!-- Время -->--}}
{{--                        <div class="relative group">--}}
{{--                            <select id="time-filter" name="time-filter"--}}
{{--                                    class="appearance-none bg-[#7676801F] hover:bg-black  hover:text-white focus:bg-black focus-within:text-white  transition-colors duration-200 rounded-[40px] py-2.5 pl-4 pr-9  cursor-pointer outline-none w-auto min-w-[120px]">--}}
{{--                                <option value="time" selected disabled hidden>Время</option>--}}
{{--                                <option value="all">Любое время</option>--}}
{{--                                <option value="morning">Утро (6:00-12:00)</option>--}}
{{--                                <option value="afternoon">День (12:00-18:00)</option>--}}
{{--                                <option value="evening">Вечер (18:00-24:00)</option>--}}
{{--                                <option value="night">Ночь (0:00-6:00)</option>--}}
{{--                            </select>--}}
{{--                            <div class="pointer-events-none absolute inset-y-0 right-3 flex items-center">--}}
{{--                                <i class="fas fa-chevron-down text-xs text-gray-600 transition-all duration-200 group-hover:text-white group-focus-within:text-white group-focus-within:rotate-180"></i>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <!-- Цена -->--}}
{{--                        <div class="relative group">--}}
{{--                            <select id="price-filter" name="price-filter"--}}
{{--                                    class="appearance-none bg-[#7676801F] hover:bg-black  hover:text-white focus:bg-black focus-within:text-white  transition-colors duration-200 rounded-[40px] py-2.5 pl-4 pr-9  cursor-pointer outline-none w-auto min-w-[120px]">--}}
{{--                                <option value="price" selected disabled hidden>Цена</option>--}}
{{--                                <option value="all">Любая цена</option>--}}
{{--                                <option value="budget">До 1000 ₽</option>--}}
{{--                                <option value="medium">1000-3000 ₽</option>--}}
{{--                                <option value="high">3000-5000 ₽</option>--}}
{{--                                <option value="luxury">5000+ ₽</option>--}}
{{--                            </select>--}}
{{--                            <div class="pointer-events-none absolute inset-y-0 right-3 flex items-center">--}}
{{--                                <i class="fas fa-chevron-down text-xs text-gray-600 transition-all duration-200 group-hover:text-white group-focus-within:text-white group-focus-within:rotate-180"></i>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <!-- Количество человек -->--}}
{{--                        <div class="relative group">--}}
{{--                            <select id="number-filter" name="number-filter"--}}
{{--                                    class="appearance-none bg-[#7676801F] hover:bg-black  hover:text-white focus:bg-black focus-within:text-white  transition-colors duration-200 rounded-[40px] py-2.5 pl-4 pr-9  cursor-pointer outline-none w-auto min-w-[120px]">--}}
{{--                                <option value="number" selected disabled hidden>Количество человек</option>--}}
{{--                                <option value="all">Любое количество</option>--}}
{{--                                <option value="1">1 человек</option>--}}
{{--                                <option value="2">2 человека</option>--}}
{{--                                <option value="3">3 человека</option>--}}
{{--                                <option value="4">4 человека</option>--}}
{{--                                <option value="5">5+ человек</option>--}}
{{--                            </select>--}}
{{--                            <div class="pointer-events-none absolute inset-y-0 right-3 flex items-center">--}}
{{--                                <i class="fas fa-chevron-down text-xs text-gray-600 transition-all duration-200 group-hover:text-white group-focus-within:text-white group-focus-within:rotate-180"></i>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <!-- Передвижение -->--}}
{{--                        <div class="relative group">--}}
{{--                            <select id="movement-filter" name="movement-filter"--}}
{{--                                    class="appearance-none bg-[#7676801F] hover:bg-black  hover:text-white focus:bg-black focus-within:text-white  transition-colors duration-200 rounded-[40px] py-2.5 pl-4 pr-9  cursor-pointer outline-none w-auto min-w-[120px]">--}}
{{--                                <option value="movement" selected disabled hidden>Передвижение</option>--}}
{{--                                <option value="all">Любое передвижение</option>--}}
{{--                                <option value="walking">Пешком</option>--}}
{{--                                <option value="car">Автомобиль</option>--}}
{{--                                <option value="public">Общественный транспорт</option>--}}
{{--                                <option value="bike">Велосипед</option>--}}
{{--                                <option value="taxi">Такси</option>--}}
{{--                            </select>--}}
{{--                            <div class="pointer-events-none absolute inset-y-0 right-3 flex items-center">--}}
{{--                                <i class="fas fa-chevron-down text-xs text-gray-600 transition-all duration-200 group-hover:text-white group-focus-within:text-white group-focus-within:rotate-180"></i>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <!-- Точки посещения -->--}}
{{--                        <div class="relative group">--}}
{{--                            <select id="visit-filter" name="visit-filter"--}}
{{--                                    class="appearance-none bg-[#7676801F] hover:bg-black  hover:text-white focus:bg-black focus-within:text-white  transition-colors duration-200 rounded-[40px] py-2.5 pl-4 pr-9  cursor-pointer outline-none w-auto min-w-[120px]">--}}
{{--                                <option value="visit" selected disabled hidden>Точки посещения</option>--}}
{{--                                <option value="all">Любые точки</option>--}}
{{--                                <option value="restaurant">Рестораны</option>--}}
{{--                                <option value="museum">Музеи</option>--}}
{{--                                <option value="park">Парки</option>--}}
{{--                                <option value="mall">Торговые центры</option>--}}
{{--                                <option value="theater">Театры</option>--}}
{{--                                <option value="cinema">Кинотеатры</option>--}}
{{--                            </select>--}}
{{--                            <div class="pointer-events-none absolute inset-y-0 right-3 flex items-center">--}}
{{--                                <i class="fas fa-chevron-down text-xs text-gray-600 transition-all duration-200 group-hover:text-white group-focus-within:text-white group-focus-within:rotate-180"></i>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}

                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5 3xl:gap-7.5 gap-y-7 lg:p-6 xl:gap-y-12">
                    @foreach ($this->excursions as $excursion)
                        <div class="card bg-white rounded-[7px] sm:rounded-[20px] overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300">
                            <div class="card-content group p-5 relative grid grid-rows-subgrid content-between row-span-2 gap-3 h-full font-['FindSansPro']">
                                <div>
                                    <div class="overflow-hidden rounded-[7px] sm:rounded-[19px]">
                                        <img src="{{ $excursion->attachments?->get(0)?->url() ?? "" }}" alt="Изображение {{ $excursion->name }}" class="photo rounded-[7px] sm:rounded-[19px] w-full h-50 3xl:h-81.75 object-cover group-hover:scale-110 transition-transform duration-500">
                                        <livewire:favorite-mini-button :object="$excursion"/>
                                    </div>
                                </div>
                                <a href="{{ route('single-excursion', ['excursion' => $excursion->slug]) }}" class="flex flex-col gap-5">
                                    <h2 class="card-title text-lg lg:text-xl 3xl:text-3xl font-bold line-clamp-1 group-hover:text-[#352AA2] transition-colors duration-300">{{ $excursion->name}}</h2>
                                    <div class="flex flex-col justify-end text-sm lg:text-base 3xl:text-2xl font-light gap-3 text-[#5F5F5F]">
                                        <div class="flex flex-row text-xs sm:text-sm lg:text-base 3xl:text-[22px] font-light gap-6 text-[#5F5F5F]">
                                            <span class="flex items-center gap-2">
                                                <i class="fa-solid fa-clock text-base xl:text-2xl"></i>
                                                    {{num_word($excursion->getDuration(), ['минута', 'минуты', 'минут'])}}
                                            </span>
                                            <span class="flex items-center gap-2">
                                                <i class="fas fa-map-marker-alt text-base xl:text-2xl"></i>
                                                    {{num_word($excursion->points->count(), ['точка', 'точки', 'точек'])}}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="flex flex-col justify-between h-full font-['FindSansPro']">
                                        <div class="flex flex-row justify-between items-end gap-3.5 text-xs sm:text-sm lg:text-base 3xl:text-[22px] font-light">
                                            <span class="flex items-center gap-3.5 text-[#5F5F5F]">
                                                <i class="fa-solid fa-location-arrow text-xl xl:text-2xl"></i>
                                                {{ $excursion->meeting_address }}
                                            </span>
                                            <a href="{{ route('single-excursion', ['excursion' => $excursion->slug]) }}" class="arrow-link shrink-0 size-10 xl:size-11 3xl:size-15 bg-linear-to-r from-[#A556F7] to-[#2663EB] rounded-full flex items-center justify-center hover:opacity-90 hover:scale-110 group/button relative overflow-hidden transition-all duration-300 ease-in-out hover:shadow-lg hover:shadow-purple-500/30">
                                                <img src="{{asset('/images/arrow-right.png')}}" alt="Стрелка" class="icon w-2 xl:w-3 3xl:w-4 h-4.5 xl:h-6 3xl:h-7.5 transition-transform duration-300 group-hover/button:translate-x-1">
                                            </a>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            {{ $this->excursions->links('livewire::tailwind') }}
        @if($this->excursions->isEmpty())
                    <div class="text-center">
                        <div class="w-24 h-24 bg-blue-50 rounded-full flex items-center justify-center mx-auto mb-6">
                            <i class="fa fa-compass text-4xl text-[#352AA2]"></i>
                        </div>
                        <h3 class="text-2xl font-semibold text-gray-700 mb-2">Экскурсий пока нет</h3>
                        <p class="text-gray-500">Загляните позже!</p>
                    </div>
                @endif
        </div>
    </section>
</div>
