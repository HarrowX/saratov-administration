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
                        <img src="/images/Rectangle 12224702 (1).png" class="photo w-full h-auto object-cover">
                    </div>

                    <div class="grid grid-cols-3 gap-5 w-full">
                        <img src="/images/Rectangle 12224705 (1).png" class="photo w-full h-auto object-cover">
                        <img src="/images/Rectangle 12224704 (1).png" class="photo w-full h-auto object-cover">
                        <img src="/images/Rectangle 12224707.png" class="photo w-full h-auto object-cover">
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
                <p class="text text-gray-600 content-center">Заведения рядом на любой вкус - от кофеен и пекарен до ресторанов и баров</p>
            </div>
            <div class="w-full">
                <div class="filter overflow-x-auto md:overflow-x-auto lg:overflow-visible scrollbar-hide">
                    <div class="text-xs md:text-base flex lg:flex-wrap justify-center gap-2 lg:gap-3 min-w-min lg:min-w-0 w-max lg:w-full">
                        <!-- Район -->
                        <div class="relative group">
                            <select id="date-filter" name="date-filter"
                                    class="appearance-none bg-[#7676801F] hover:bg-black  hover:text-white focus:bg-black focus-within:text-white  transition-colors duration-200 rounded-[40px] py-2.5 pl-4 pr-9  cursor-pointer outline-none w-auto min-w-[120px]">
                                <option value="date" selected disabled hidden>Район</option>
                                <option value="all">Любое</option>
                                <option value="first">Первое</option>
                                <option value="second">Второе</option>
                                <option value="third">Третье</option>
                                <option value="fourth">Четвертое</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-3 flex items-center">
                                <i class="fas fa-chevron-down text-xs text-gray-600 transition-all duration-200 group-hover:text-white group-focus-within:text-white group-focus-within:rotate-180"></i>
                            </div>
                        </div>

                        <!-- Тип -->
                        <div class="relative group">
                            <select id="time-filter" name="time-filter"
                                    class="appearance-none bg-[#7676801F] hover:bg-black  hover:text-white focus:bg-black focus-within:text-white  transition-colors duration-200 rounded-[40px] py-2.5 pl-4 pr-9  cursor-pointer outline-none w-auto min-w-[120px]">
                                <option value="date" selected disabled hidden>Тип жилья</option>
                                <option value="all">Любое</option>
                                <option value="first">Первое</option>
                                <option value="second">Второе</option>
                                <option value="third">Третье</option>
                                <option value="fourth">Четвертое</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-3 flex items-center">
                                <i class="fas fa-chevron-down text-xs text-gray-600 transition-all duration-200 group-hover:text-white group-focus-within:text-white group-focus-within:rotate-180"></i>
                            </div>
                        </div>

                        <!-- Кухня -->
                        <div class="relative group">
                            <select id="price-filter" name="price-filter"
                                    class="appearance-none bg-[#7676801F] hover:bg-black  hover:text-white focus:bg-black focus-within:text-white  transition-colors duration-200 rounded-[40px] py-2.5 pl-4 pr-9  cursor-pointer outline-none w-auto min-w-[120px]">
                                <option value="date" selected disabled hidden>Дата</option>
                                <option value="all">Любое</option>
                                <option value="first">Первое</option>
                                <option value="second">Второе</option>
                                <option value="third">Третье</option>
                                <option value="fourth">Четвертое</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-3 flex items-center">
                                <i class="fas fa-chevron-down text-xs text-gray-600 transition-all duration-200 group-hover:text-white group-focus-within:text-white group-focus-within:rotate-180"></i>
                            </div>
                        </div>

                        <!-- Стоимость -->
                        <div class="relative group">
                            <select id="movement-filter" name="movement-filter"
                                    class="appearance-none bg-[#7676801F] hover:bg-black  hover:text-white focus:bg-black focus-within:text-white  transition-colors duration-200 rounded-[40px] py-2.5 pl-4 pr-9  cursor-pointer outline-none w-auto min-w-[120px]">
                                <option value="date" selected disabled hidden>Стоимость</option>
                                <option value="all">Любое</option>
                                <option value="first">Первое</option>
                                <option value="second">Второе</option>
                                <option value="third">Третье</option>
                                <option value="fourth">Четвертое</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-3 flex items-center">
                                <i class="fas fa-chevron-down text-xs text-gray-600 transition-all duration-200 group-hover:text-white group-focus-within:text-white group-focus-within:rotate-180"></i>
                            </div>
                        </div>
                        <!-- Количество человек-->
                        <div class="relative group">
                            <select id="movement-filter" name="movement-filter"
                                    class="appearance-none bg-[#7676801F] hover:bg-black  hover:text-white focus:bg-black focus-within:text-white  transition-colors duration-200 rounded-[40px] py-2.5 pl-4 pr-9  cursor-pointer outline-none w-auto min-w-[120px]">
                                <option value="date" selected disabled hidden>Количество человек</option>
                                <option value="all">Любое</option>
                                <option value="first">Первое</option>
                                <option value="second">Второе</option>
                                <option value="third">Третье</option>
                                <option value="fourth">Четвертое</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-3 flex items-center">
                                <i class="fas fa-chevron-down text-xs text-gray-600 transition-all duration-200 group-hover:text-white group-focus-within:text-white group-focus-within:rotate-180"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-2 xl:grid-cols-3 gap-2 lg:gap-3 3xl:gap-5">
                @foreach ($hotels as $hotel)
                    <div class="card bg-white rounded-[7px] sm:rounded-[19px] overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300 mb-2 xl:mb-12">
                        <div class="card-content p-2 sm:p-5 relative">
                            <div class="">
                                <img src="{{ $hotel->attachments?->get(0)?->url() ?? "" }}" alt="Изображение {{ $hotel->name }}" class="phone rounded-[7px] sm:rounded-[19px]">
                                <div class="absolute top-4 right-3.5 sm:top-10 sm:right-9.5 size-5 sm:size-10 xl:size-12 3xl:size-15 bg-[#A855F7] rounded-[3px] sm:rounded-md xl:rounded-xl flex items-center justify-center text-white text-xs sm:text-xl xl:text-2xl shadow-lg">
                                    <i class="fa-sharp fa-solid fa-heart"></i>
                                </div>
                            </div>
                            <div class="flex flex-col font-['FindSansPro'] mt-3 sm:mt-4">
                                <h1 class="text-center text-xs sm:text-lg lg:text-xl xl:text-3xl font-bold">{{ $hotel->name }}</h1>
                                <div class="flex flex-col">
                                    <div class="flex flex-col text-[8px] sm:text-sm lg:text-base xl:text-lg 3xl:text-xl font-light gap-3 text-[#5F5F5F] mt-2 lg:mt-5 mb-0 sm:mb-2 lg:mb-6">
                                        <p class="text-center">{{ $hotel->type}}</p>
{{--                                        <span class="flex items-center gap-3.5">--}}
{{--                                            <i class="fa-solid fa-clock"></i>--}}
{{--                                        </span>--}}
                                        <span class="flex items-center gap-3.5">
                                            <i class="fas fa-phone"></i>
                                            {{ $hotel->phone }}
                                        </span>
                                    </div>
                                    <div class="flex flex-row justify-between items-center gap-3.5">
                                        <span class="flex items-center gap-3.5">
                                            <i class="fas fa-map-marker-alt"></i>
                                            {{ $hotel->address }}
                                        </span>
                                        <a href="{{ route('single-hotel', ['hotel' => $hotel->slug]) }}" class="shrink-0 size-5 sm:size-10 xl:size-11 3xl:size-15 bg-linear-to-r from-[#A556F7] to-[#2663EB] rounded-full flex items-center justify-center hover:opacity-90 transition-opacity">
                                            <img src="/images/Arrow 2.png" alt="" class="icon w-1 sm:w-2 xl:w-3 3xl:w-4 h-2.5 sm:h-4.5 xl:h-6 3xl:h-7.5">
                                        </a>
                                    </div>
{{--                                    <form action="{{ route('single-hotel', ['hotel' => $hotel->slug]) }}">--}}
{{--                                        <button class="w-full gradient-button text-white text-[8px] sm:text-base xl:text-xl py-1 lg:py-2 rounded-[3px] sm:rounded-lg hover:opacity-90 transition-opacity">--}}
{{--                                            Подробнее--}}
{{--                                        </button>--}}
{{--                                    </form>--}}
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
</div>
