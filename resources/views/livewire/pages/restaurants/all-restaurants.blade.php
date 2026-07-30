@section('title')
    Саратов 435 - Заведения
@endsection

<div>
    <!--Hero Section-->
    <section id="home" class="hero-section pt-21 min-h-100 md:min-h-screen flex flex-col gap-17 items-center justify-center relative">
        <div class="absolute inset-0 bg-[url('/images/bg-restaurants.jpg')] bg-no-repeat bg-cover">
            <div class="absolute inset-0 bg-[rgba(239,230,215,0.73)]"></div>
        </div>
        <div class="relative z-10 text-center text-black">
            <h1 class="text-4xl font-extrabold mb-4">Заведения города</h1>
            <p class="text-xl px-5">Подберите лучшие заведения рядом: кафе, рестораны, бары и кофейни на любой вкус.</p>
        </div>
    </section>

    @livewire('saratov-ai')

    <!-- Section with filter and card-vebue -->
    <section class="bg-white pb-5 md:pb-10 xl:pb-20 3xl:pb-26">
        <div class="max-w-3xl lg:max-w-5xl xl:max-w-7xl 3xl:max-w-398.25 mx-auto px-4 sm:px-10">
            <div class="text-center mb-2 3xl:mb-12" data-aos="fade-up">
                <p class="text text-gray-600 content-center">Заведения рядом на любой вкус - от кофеен и пекарен до ресторанов и баров</p>
            </div>
{{--            <div class="w-full">--}}
{{--                <div class="filter overflow-x-auto md:overflow-x-auto lg:overflow-visible scrollbar-hide px-4 py-3 lg:p-6">--}}
{{--                    <div class="text-xs md:text-base flex lg:flex-wrap justify-center gap-2 lg:gap-3 min-w-min lg:min-w-0 w-max lg:w-full">--}}

{{--                        <!-- Район / зона -->--}}
{{--                        <div class="relative group">--}}
{{--                            <select id="date-filter" name="date-filter"--}}
{{--                                    class="appearance-none bg-[#7676801F] hover:bg-black  hover:text-white focus:bg-black focus-within:text-white  transition-colors duration-200 rounded-[40px] py-2.5 pl-4 pr-9  cursor-pointer outline-none w-auto min-w-[120px]">--}}
{{--                                <option value="date" selected disabled hidden>Район / зона</option>--}}
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
{{--                                <option value="date" selected disabled hidden>Тип</option>--}}
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
{{--                                    class="appearance-none bg-[#7676801F] hover:bg-black  hover:text-white focus:bg-black focus-within:text-white  transition-colors duration-200 rounded-[40px] py-2.5 pl-4 pr-9   cursor-pointer outline-none w-auto min-w-[120px]">--}}
{{--                                <option value="date" selected disabled hidden>Кухня</option>--}}
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

{{--                        <!-- Время работы -->--}}
{{--                        <div class="relative group">--}}
{{--                            <select id="number-filter" name="number-filter"--}}
{{--                                    class="appearance-none bg-[#7676801F] hover:bg-black  hover:text-white focus:bg-black focus-within:text-white  transition-colors duration-200 rounded-[40px] py-2.5 pl-4 pr-9  cursor-pointer outline-none w-auto min-w-[120px]">--}}
{{--                                <option value="date" selected disabled hidden>Время работы</option>--}}
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

{{--                        <!-- Диапазон чека -->--}}
{{--                        <div class="relative group">--}}
{{--                            <select id="movement-filter" name="movement-filter"--}}
{{--                                    class="appearance-none bg-[#7676801F] hover:bg-black  hover:text-white focus:bg-black focus-within:text-white  transition-colors duration-200 rounded-[40px] py-2.5 pl-4 pr-9  cursor-pointer outline-none w-auto min-w-[120px]">--}}
{{--                                <option value="date" selected disabled hidden>Диапазон чека</option>--}}
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
                @foreach ($restaurants as $restaurant)
                <div class="card bg-white rounded-[7px] sm:rounded-[20px] overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300">
                    <div class="card-content group p-5 relative grid grid-rows-subgrid content-between row-span-2 gap-3 h-full font-['FindSansPro']">
                        <div class="flex flex-col gap-5">
                            <div class="overflow-hidden rounded-[7px] sm:rounded-[19px]">
                                <img src="{{ $restaurant->attachments?->get(0)?->url() ?? "" }}" alt="Изображение {{ $restaurant->name }}" class="photo rounded-[7px] sm:rounded-[19px] w-full h-50 3xl:h-81.75 object-cover group-hover:scale-110 transition-transform duration-500">
                                <div class="absolute top-7 right-6.5 sm:top-10 sm:right-9.5 size-10 xl:size-12 3xl:size-15 bg-[#A855F7] rounded-md xl:rounded-xl flex items-center justify-center text-white text-xl xl:text-2xl shadow-lg">
                                    <i class="fa-sharp fa-solid fa-heart"></i>
                                </div>
                            </div>
                            <h2 class="card-title text-center text-lg lg:text-xl 3xl:text-3xl font-bold">{{ $restaurant->name}}</h2>
                            <div class="flex flex-col justify-end text-sm lg:text-base 3xl:text-2xl font-light gap-3 text-[#5F5F5F]">
                                <p class="text-center mb-2 ">{{ $restaurant->kitchen }} кухня</p>
                                <span class="flex items-center gap-3.5">
                                    <i class="fas fa-phone text-lg xl:text-xl"></i>
                                    {{ $restaurant->phone }}
                                </span>
                            </div>
                        </div>
                        <div class="flex flex-col justify-between h-full font-['FindSansPro']">
                            <div class="flex flex-row justify-between items-end gap-3.5 text-sm lg:text-base 3xl:text-2xl font-light">
                                <span class="flex items-center gap-3.5 text-[#5F5F5F]">
                                    <i class="fas fa-map-marker-alt text-xl xl:text-2xl"></i>
                                    {{ $restaurant->address }}
                                </span>
                                <a href="{{ route('single-restaurant', ['restaurant' => $restaurant->slug]) }}" class="arrow-link shrink-0 size-10 xl:size-11 3xl:size-15 bg-linear-to-r from-[#A556F7] to-[#2663EB] rounded-full flex items-center justify-center hover:opacity-90 hover:scale-110 group/button relative overflow-hidden transition-all duration-300 ease-in-out hover:shadow-lg hover:shadow-purple-500/30">
                                    <img src="/images/Arrow 2.png" alt="Стрелка" class="icon w-2 xl:w-3 3xl:w-4 h-4.5 xl:h-6 3xl:h-7.5 transition-transform duration-300 group-hover/button:translate-x-1">
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
