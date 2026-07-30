@section('title')
    Саратов 435 - Достопримечательности
@endsection


<div>
    <!-- Hero Section -->
    <section class="h-100 sm:h-120 md:h-135 lg:h-screen flex flex-col relative">
        <div class="features-section pt-25 sm:pt-28 lg:pt-35 3xl:pt-40 pb-1 sm:pb-4 lg:pb-7 3xl:pb-10 bg-white relative z-10">
            <div class="max-w-3xl lg:max-w-5xl xl:max-w-7xl 3xl:max-w-398.25 mx-auto px-5 xl:px-20">
                <h1 class="text-xl sm:text-2xl xl:text-3xl 3xl:text-4xl font-bold tracking-[1px] text-center lg:text-left">Достопримечательности</h1>
            </div>
        </div>

        <div class="flex-1 relative z-20">
            <div class="absolute inset-0 bg-[url('/images/bg-attractions.png')] bg-no-repeat bg-cover bg-center"></div>

            <div class="relative max-w-3xl lg:max-w-5xl xl:max-w-7xl 3xl:max-w-398.25 mx-auto px-5 xl:px-20 h-full">
                <div class="flex flex-col items-end h-full relative">
                    <p class="hidden lg:block font-['FindSansPro'] md:text-xs 2xl:text-lg text-[#374559] absolute -top-19 2xl:-top-20 right-5 xl:right-6">
                        Пользователи рекомендуют:
                    </p>

                    <div class="hidden lg:block sm:w-92 md:w-60 2xl:w-92 bg-white rounded-[20px] overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300 absolute -top-15 2xl:-top-12">
                        <div class="p-2 sm:p-4 3xl:p-5 flex flex-col">
                            <div class="w-full mb-4 overflow-hidden rounded-[20px] shrink-0 h-37.5 sm:h-53.75 3xl:h-78.75">
                                <img src="/images/3a2ab4b764e3db0e3d0f1c051cffa200df2712a0.png" alt="Дом книги" class="photo">
                            </div>

                            <div class="font-['FindSansPro'] flex flex-col">
                                <div>
                                    <h1 class="text-xs sm:text-xl 2xl:text-2xl 3xl:text-[21px] font-extrabold mb-2 tracking-[1px]">Дом книги</h1>
                                    <p class="text-[7px] sm:text-xs text-[#888888] line-clamp-4">Архитектура и памятники, театры и культурные центры</p>
                                </div>

                                <div class="mt-2 mb-3">
                                    <div class="flex items-end justify-between gap-2">
                                        <div class="flex gap-1 flex-1 max-w-37 sm:max-w-67 ">
                                            <img src="/images/image 7.svg" alt="" class="icon size-2.5 sm:size-4 2xl:size-7 mt-5 2xl:mt-4 shrink-0">
                                            <span class="text-[8px] sm:text-[10px] 2xl:text-xs text-[#505050] pt-1 sm:pt-4">Саратов, Фрунзенский район, ул. Вольская, 81</span>
                                        </div>
                                        <a href="{{ route('all-attractions') }}" class="arrow-link shrink-0 size-10 xl:size-11 3xl:size-15 bg-linear-to-r from-[#A556F7] to-[#2663EB] rounded-full flex items-center justify-center hover:opacity-90 hover:scale-110 group relative overflow-hidden transition-all duration-300 ease-in-out hover:shadow-lg hover:shadow-purple-500/30">
                                            <img src="/images/Arrow 2.png" alt="Стрелка" class="icon w-2 xl:w-3 3xl:w-4 h-4.5 xl:h-6 3xl:h-7.5 transition-transform duration-300 group-hover:translate-x-1">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @livewire('saratov-ai')

    <section class="bg-white pb-10 sm:pb-15 xl:pb-20 3xl:pb-26">
        <div class="max-w-3xl lg:max-w-5xl xl:max-w-7xl 3xl:max-w-398.25 mx-auto px-5 xl:px-20">
            <div class="text-center mb-12" data-aos="fade-up">
                <p class="text text-gray-600 content-center">Заведения рядом на любой вкус - от кофеен и пекарен до ресторанов и баров</p>
            </div>
            <div class="w-full pb-5">
                <div class="filter overflow-x-auto md:overflow-x-auto lg:overflow-visible scrollbar-hide px-4 py-3 lg:p-6">
                    <div class="text-xs md:text-base flex lg:flex-wrap justify-center gap-2 lg:gap-3 min-w-min lg:min-w-0 w-max lg:w-full">

                        <!-- Район / зона -->
                        <div class="relative group">
                            <select id="date-filter" name="date-filter"
                                    class="appearance-none bg-[#7676801F] hover:bg-black  hover:text-white focus:bg-black focus-within:text-white  transition-colors duration-200 rounded-[40px] py-2.5 pl-4 pr-9  cursor-pointer outline-none w-auto min-w-30">
                                <option value="date" selected disabled hidden>Район / зона</option>
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
                                    class="appearance-none bg-[#7676801F] hover:bg-black  hover:text-white focus:bg-black focus-within:text-white  transition-colors duration-200 rounded-[40px] py-2.5 pl-4 pr-9  cursor-pointer outline-none w-auto min-w-30">
                                <option value="date" selected disabled hidden>Тип</option>
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

                        <!-- Часы посещения -->
                        <div class="relative group">
                            <select id="price-filter" name="price-filter"
                                    class="appearance-none bg-[#7676801F] hover:bg-black  hover:text-white focus:bg-black focus-within:text-white  transition-colors duration-200 rounded-[40px] py-2.5 pl-4 pr-9   cursor-pointer outline-none w-auto min-w-30">
                                <option value="date" selected disabled hidden>Часы посещения</option>
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
                            <select id="number-filter" name="number-filter"
                                    class="appearance-none bg-[#7676801F] hover:bg-black  hover:text-white focus:bg-black focus-within:text-white  transition-colors duration-200 rounded-[40px] py-2.5 pl-4 pr-9  cursor-pointer outline-none w-auto min-w-30">
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

                        <!-- Выбрать точки посещения -->
                        <div class="relative group">
                            <select id="movement-filter" name="movement-filter"
                                    class="appearance-none bg-[#7676801F] hover:bg-black  hover:text-white focus:bg-black focus-within:text-white  transition-colors duration-200 rounded-[40px] py-2.5 pl-4 pr-9  cursor-pointer outline-none w-auto min-w-30">
                                <option value="date" selected disabled hidden>Выбрать точки посещения</option>
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
            <!-- Сетка карточек -->
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5 3xl:gap-7.5 gap-y-7 lg:p-6 xl:gap-y-12">
                @foreach ($attractions as $attraction)
                    <div class="card bg-white rounded-[7px] sm:rounded-[20px] overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300">
                        <div class="card-content group p-5 relative h-full font-['FindSansPro'] grid grid-rows-subgrid content-between row-span-2 gap-3">
                            <div class="flex flex-col gap-5">
                                <div class="overflow-hidden rounded-[7px] sm:rounded-[19px]">
                                    <img src="{{ $attraction->attachments?->get(0)?->url() ?? "" }}" alt="Изображение {{ $attraction->name }}" class="photo rounded-[7px] sm:rounded-[19px] w-full h-50 3xl:h-81.75 object-cover group-hover:scale-110 transition-transform duration-500">
                                    <livewire:favorite-mini-button :object="$attraction"/>
                                </div>
                                <h2 class="card-title text-center text-lg lg:text-xl 3xl:text-3xl font-bold">{{ $attraction->name }}</h2>
                                <p class="text-sm lg:text-base 3xl:text-2xl text-[#5F5F5F] line-clamp-4">{{ $attraction->short_description }}</p>
                            </div>
                            <div class="flex flex-col justify-between h-full font-['FindSansPro']">
                                <div class="flex flex-row justify-between items-end gap-3.5 text-sm lg:text-base 3xl:text-2xl font-light">
                                    <span class="flex items-center gap-3.5 text-[#5F5F5F]">
                                        <i class="fas fa-map-marker-alt text-xl xl:text-2xl"></i>
                                        {{ $attraction->address }}
                                    </span>
                                    <a href="{{ route('single-attraction', ['attraction' => $attraction->slug]) }}" class="arrow-link shrink-0 size-10 xl:size-11 3xl:size-15 bg-linear-to-r from-[#A556F7] to-[#2663EB] rounded-full flex items-center justify-center hover:opacity-90 hover:scale-110 group/button relative overflow-hidden transition-all duration-300 ease-in-out hover:shadow-lg hover:shadow-purple-500/30">
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
