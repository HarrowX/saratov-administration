@section('title')
    Саратов 435 - Заведения
@endsection

<div>
    <!--Hero Section-->
    <section id="home" class="hero-section pt-21 min-h-100 md:min-h-screen flex flex-col gap-17 items-center justify-center relative">
        <div class="absolute inset-0 bg-[url('/images/bg-restaurants.webp')] bg-no-repeat bg-cover">
            <div class="absolute inset-0 bg-[rgba(239,230,215,0.73)]"></div>
        </div>
        <div class="relative z-10 text-center text-black">
            <h1 class="text-4xl font-extrabold mb-4">Заведения города</h1>
            <p class="text-xl px-5">Подберите лучшие заведения рядом: кафе, рестораны, бары и кофейни на любой вкус.</p>
        </div>
    </section>

    @livewire('saratov-ai')

    <!-- Section with filter and card-vebue -->
    <section id="cards" class="bg-white pb-5 md:pb-10 xl:pb-20 3xl:pb-26">
        <div class="max-w-6xl 3xl:max-w-427 mx-auto px-4 sm:px-10">
            <div class="text-center mb-2 3xl:mb-12">
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
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5 3xl:gap-7.5 gap-y-7 xl:gap-y-12">
                @foreach ($this->restaurants as $restaurant)
                    <x-card :cardable="$restaurant"
                            :route="route('single-restaurant', ['restaurant' => $restaurant->slug])"
                            :title="$restaurant->name"
                            subtitle="{{ $restaurant->kitchen }} кухня"
                            :address="$restaurant->address"
                    >
                    </x-card>
                @endforeach
            </div>
            {{ $this->restaurants->links('livewire::tailwind') }}
            @if($this->restaurants->isEmpty())
                <div class="text-center">
                    <div class="w-24 h-24 bg-blue-50 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fa-solid fa-magnifying-glass text-4xl text-[#352AA2]"></i>
                    </div>
                    <h3 class="text-2xl font-semibold text-gray-700 mb-2">Заведений нет</h3>
                    <p class="text-gray-500">Загляните позже!</p>
                </div>
            @endif
        </div>
    </section>
</div>
