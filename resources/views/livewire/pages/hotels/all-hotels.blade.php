@section('title')
    Саратов 435 - Где остановиться
@endsection

<div>
    <!--Hero Section-->
    <section class="features-section pt-28 md:pt-30 lg:pt-41.5 bg-white">
        <div class="max-w-3xl lg:max-w-5xl xl:max-w-7xl 3xl:max-w-398.25 mx-auto px-5 xl:px-20">
            <div class="flex flex-col-reverse lg:flex-row-reverse items-center sm:gap-5 lg:gap-10 3xl:gap-22.5">

                <div data-aos="fade-right" class="flex flex-col-reverse gap-5 w-full lg:w-auto">

                    <p class="text-base xl:text-lg 3xl:text-xl lg:hidden">В этом разделе собрали лучшие районы и варианты жилья для туристов - от отелей в центре до уютных апартаментов в тихих кварталах. Подскажем, где удобнее остановиться с учётом транспорта, достопримечательностей и бюджета, и на что обратить внимание при бронировании.
                    </p>

                    <div class="mmin-w-full sm:min-w-110 xl:min-w-140 3xl:min-w-197">
                        <img src="{{asset('/images/Rectangle 12224702 (1).webp')}}" class="photo w-full h-auto object-cover" alt="картинка-1">
                    </div>

                    <div class="grid grid-cols-3 gap-5 w-full">
                        <img src="{{asset('/images/Rectangle 12224705 (1).webp')}}" class="photo w-full h-auto object-cover" alt="картинка-2">
                        <img src="{{asset('/images/Rectangle 12224704 (1).webp')}}" class="photo w-full h-auto object-cover" alt="картинка-3">
                        <img src="{{asset('/images/Rectangle 12224707.webp')}}" class="photo w-full h-auto object-cover" alt="картинка-4">
                    </div>
                </div>

                <div data-aos="fade-left" class="w-full lg:w-auto">
                    <h2 class="text-center sm:pb-5 lg:pb-10">Где остановиться</h2>
                    <p class="text-base xl:text-lg 3xl:text-xl hidden lg:block">В этом разделе собрали лучшие районы и варианты жилья для туристов - от отелей в центре до уютных апартаментов в тихих кварталах. Подскажем, где удобнее остановиться с учётом транспорта, достопримечательностей и бюджета, и на что обратить внимание при бронировании.</p>
                </div>
            </div>
        </div>
    </section>

    @livewire('saratov-ai')

    <!-- Section with filter and card-vebue -->
    <section class="bg-white pb-10 md:pb-15 xl:pb-20 3xl:pb-26 px-4 sm:px-10">
        <div class="max-w-5xl xl:max-w-7xl 3xl:max-w-398.25 mx-auto flex flex-col gap-7 3xl:gap-12 items-center">
            <div class="text-center" data-aos="fade-up">
                <p class="text text-gray-600 content-center">Подскажем, в каких районах удобнее жить, и какие варианты жилья выбрать под ваш бюджет и планы.</p>
            </div>
{{--            <div class="w-full">--}}
{{--                <div class="filter overflow-x-auto md:overflow-x-auto lg:overflow-visible scrollbar-hide">--}}
{{--                    <div class="text-xs md:text-base flex lg:flex-wrap justify-center gap-2 lg:gap-3 min-w-min lg:min-w-0 w-max lg:w-full">--}}
{{--                        <!-- Район -->--}}
{{--                        <div class="relative group">--}}
{{--                            <select id="date-filter" name="date-filter"--}}
{{--                                    class="appearance-none bg-[#7676801F] hover:bg-black  hover:text-white focus:bg-black focus-within:text-white  transition-colors duration-200 rounded-[40px] py-2.5 pl-4 pr-9  cursor-pointer outline-none w-auto min-w-[120px]">--}}
{{--                                <option value="date" selected disabled hidden>Район</option>--}}
{{--                                <option value="all">Любое</option>--}}
{{--                                <option value="first">Первое</option>--}}
{{--                                <option value="second">Второе</option>--}}
{{--                                <option value="third">Третье</option>--}}
{{--                                <option value="fourth">Четвертое</option>--}}
{{--                            </select>--}}
{{--                            <div class="pointer-events-none absolute inset-y-0 right-3 flex items-center">--}}
{{--                                <i class="fas fa-chevron-down text-xs text-gray-600 transition-all duration-200 group-hover:text-white group-focus-within:text-white group-focus-within:rotate-180"></i>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <!-- Тип -->--}}
{{--                        <div class="relative group">--}}
{{--                            <select id="time-filter" name="time-filter"--}}
{{--                                    class="appearance-none bg-[#7676801F] hover:bg-black  hover:text-white focus:bg-black focus-within:text-white  transition-colors duration-200 rounded-[40px] py-2.5 pl-4 pr-9  cursor-pointer outline-none w-auto min-w-[120px]">--}}
{{--                                <option value="date" selected disabled hidden>Тип жилья</option>--}}
{{--                                <option value="all">Любое</option>--}}
{{--                                <option value="first">Первое</option>--}}
{{--                                <option value="second">Второе</option>--}}
{{--                                <option value="third">Третье</option>--}}
{{--                                <option value="fourth">Четвертое</option>--}}
{{--                            </select>--}}
{{--                            <div class="pointer-events-none absolute inset-y-0 right-3 flex items-center">--}}
{{--                                <i class="fas fa-chevron-down text-xs text-gray-600 transition-all duration-200 group-hover:text-white group-focus-within:text-white group-focus-within:rotate-180"></i>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <!-- Кухня -->--}}
{{--                        <div class="relative group">--}}
{{--                            <select id="price-filter" name="price-filter"--}}
{{--                                    class="appearance-none bg-[#7676801F] hover:bg-black  hover:text-white focus:bg-black focus-within:text-white  transition-colors duration-200 rounded-[40px] py-2.5 pl-4 pr-9  cursor-pointer outline-none w-auto min-w-[120px]">--}}
{{--                                <option value="date" selected disabled hidden>Дата</option>--}}
{{--                                <option value="all">Любое</option>--}}
{{--                                <option value="first">Первое</option>--}}
{{--                                <option value="second">Второе</option>--}}
{{--                                <option value="third">Третье</option>--}}
{{--                                <option value="fourth">Четвертое</option>--}}
{{--                            </select>--}}
{{--                            <div class="pointer-events-none absolute inset-y-0 right-3 flex items-center">--}}
{{--                                <i class="fas fa-chevron-down text-xs text-gray-600 transition-all duration-200 group-hover:text-white group-focus-within:text-white group-focus-within:rotate-180"></i>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <!-- Стоимость -->--}}
{{--                        <div class="relative group">--}}
{{--                            <select id="movement-filter" name="movement-filter"--}}
{{--                                    class="appearance-none bg-[#7676801F] hover:bg-black  hover:text-white focus:bg-black focus-within:text-white  transition-colors duration-200 rounded-[40px] py-2.5 pl-4 pr-9  cursor-pointer outline-none w-auto min-w-[120px]">--}}
{{--                                <option value="date" selected disabled hidden>Стоимость</option>--}}
{{--                                <option value="all">Любое</option>--}}
{{--                                <option value="first">Первое</option>--}}
{{--                                <option value="second">Второе</option>--}}
{{--                                <option value="third">Третье</option>--}}
{{--                                <option value="fourth">Четвертое</option>--}}
{{--                            </select>--}}
{{--                            <div class="pointer-events-none absolute inset-y-0 right-3 flex items-center">--}}
{{--                                <i class="fas fa-chevron-down text-xs text-gray-600 transition-all duration-200 group-hover:text-white group-focus-within:text-white group-focus-within:rotate-180"></i>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <!-- Количество человек-->--}}
{{--                        <div class="relative group">--}}
{{--                            <select id="movement-filter" name="movement-filter"--}}
{{--                                    class="appearance-none bg-[#7676801F] hover:bg-black  hover:text-white focus:bg-black focus-within:text-white  transition-colors duration-200 rounded-[40px] py-2.5 pl-4 pr-9  cursor-pointer outline-none w-auto min-w-[120px]">--}}
{{--                                <option value="date" selected disabled hidden>Количество человек</option>--}}
{{--                                <option value="all">Любое</option>--}}
{{--                                <option value="first">Первое</option>--}}
{{--                                <option value="second">Второе</option>--}}
{{--                                <option value="third">Третье</option>--}}
{{--                                <option value="fourth">Четвертое</option>--}}
{{--                            </select>--}}
{{--                            <div class="pointer-events-none absolute inset-y-0 right-3 flex items-center">--}}
{{--                                <i class="fas fa-chevron-down text-xs text-gray-600 transition-all duration-200 group-hover:text-white group-focus-within:text-white group-focus-within:rotate-180"></i>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5 3xl:gap-7.5 gap-y-7 lg:p-6 xl:gap-y-12">
                @foreach ($hotels as $hotel)
                    <div class="card bg-white rounded-[7px] sm:rounded-[20px] overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300">
                        <div class="card-content group p-5 relative grid grid-rows-subgrid content-between row-span-2 gap-3 h-full font-['FindSansPro']">
                            <div class="flex flex-col gap-5">
                                <div class="overflow-hidden rounded-[7px] sm:rounded-[19px]">
                                    <img src="{{ asset($hotel->attachments?->get(0)?->url()) ?? "" }}" alt="Изображение {{ $hotel->name }}" class="photo rounded-[7px] sm:rounded-[19px] w-full h-50 3xl:h-81.75 object-cover group-hover:scale-110 transition-transform duration-500">
                                    <livewire:favorite-mini-button :object="$hotel"/>
                                </div>
                            </div>
                            <a href="{{ route('single-hotel', ['hotel' => $hotel->slug]) }}">
                                <h2 class="card-title text-center text-lg lg:text-xl 3xl:text-3xl font-bold group-hover:text-[#352AA2] transition-colors duration-300">{{ $hotel->name}}</h2>
                                <div class="flex flex-col justify-end text-sm lg:text-base 3xl:text-2xl font-light gap-3 text-[#5F5F5F]">
                                    <p class="text-center mb-2 ">{{ $hotel->type}}</p>
                                    <span class="flex items-center gap-3.5">
                                        <i class="fas fa-phone text-lg xl:text-xl"></i>
                                        {{ $hotel->phone }}
                                    </span>
                                </div>
                                <div class="flex flex-col justify-between h-full font-['FindSansPro']">
                                    <div class="flex flex-row justify-between items-end gap-3.5 text-sm lg:text-base 3xl:text-2xl font-light">
                                        <span class="flex items-center gap-3.5 text-[#5F5F5F]">
                                            <i class="fas fa-map-marker-alt text-xl xl:text-2xl"></i>
                                            {{ $hotel->address }}
                                        </span>
                                        <a href="{{ route('single-hotel', ['hotel' => $hotel->slug]) }}" class="arrow-link shrink-0 size-10 xl:size-11 3xl:size-15 bg-linear-to-r from-[#A556F7] to-[#2663EB] rounded-full flex items-center justify-center hover:opacity-90 hover:scale-110 group/button relative overflow-hidden transition-all duration-300 ease-in-out hover:shadow-lg hover:shadow-purple-500/30">
                                            <img src="{{asset('/images/arrow-right.png')}}" alt="Стрелка" class="icon w-2 xl:w-3 3xl:w-4 h-4.5 xl:h-6 3xl:h-7.5 transition-transform duration-300 group-hover/button:translate-x-1">
                                        </a>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
            @if($hotels->isEmpty())
                <div class="text-center">
                    <div class="w-24 h-24 bg-blue-50 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fa-solid fa-magnifying-glass text-4xl text-[#352AA2]"></i>
                    </div>
                    <h3 class="text-2xl font-semibold text-gray-700 mb-2">Отелей нет</h3>
                    <p class="text-gray-500">Загляните позже!</p>
                </div>
            @endif
        </div>
    </section>
</div>
