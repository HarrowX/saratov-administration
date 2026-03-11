@section('title')
    Саратов 435 - Заведения
@endsection


<div>
    <!--Hero Section-->
    <section id="home" class="hero-section pt-21 min-h-screen flex flex-col gap-17 items-center justify-center relative">
        <div class="absolute inset-0 bg-[url('/images/5f27bd4403328a4ff674a7c90c938d56b200c299.jpg')] bg-no-repeat bg-cover">
            <div class="absolute inset-0 bg-[rgba(239,230,215,0.73)]"></div>
        </div>
        <div class="relative z-10 text-center text-black">
            <h1 class="text-4xl font-extrabold mb-4">Заведения города</h1>
            <p class="text-xl">Подберите лучшие заведения рядом: кафе, рестораны, бары и кофейни на любой вкус.</p>
        </div>
    </section>

    @livewire('sara-ai')

    <!-- Section with filter and card-vebue -->
    <section class="bg-white pb-25.5">
        <div class="max-w-3xl lg:max-w-5xl xl:max-w-7xl 3xl:max-w-398.25 mx-auto px-4 sm:px-10">
            <div class="text-center mb-12" data-aos="fade-up">
                <p class="text text-gray-600 content-center">Заведения рядом на любой вкус - от кофеен и пекарен до ресторанов и баров</p>
            </div>
            <div class="w-full">
                <div class="filter overflow-x-auto lg:overflow-visible scrollbar-hide px-4">
                    <div class="flex justify-center gap-2 lg:gap-3 min-w-min lg:min-w-0 w-max lg:w-full">
                        <!-- Район / зона -->
                        <div class="">
                            <div class="relative group">
                                <select id="date-filter" name="date-filter" 
                                        class="w-full appearance-none bg-[#7676801F] hover:bg-black hover:text-white 
                                            focus:bg-black focus:text-white
                                            transition-colors duration-200 rounded-[40px] pl-10 md:pl-12 pr-5 py-2.5 
                                            text-sm md:text-xl text-black cursor-pointer outline-none">
                                    <option value="date" selected disabled hidden>Район / зона</option>
                                    <option value="all">Любое</option>
                                    <option value="first">Первое</option>
                                    <option value="second">Второе</option>
                                    <option value="third">Третье</option>
                                    <option value="fourth">Четвертое</option>
                                </select>
                                
                                <div class="pointer-events-none absolute inset-y-0 left-4 flex items-center pr-4">
                                    <i class="fas fa-chevron-down text-xs md:text-xl  text-black transition-all duration-200 
                                            group-hover:text-white group-focus-within:text-white 
                                            group-focus-within:rotate-180"></i>
                                </div>
                            </div>
                        </div>

                        <!-- Тип -->
                        <div class="min-w-35 lg:min-w-0">
                            <div class="relative group">
                                <select id="date-filter" name="date-filter" 
                                        class="w-full appearance-none bg-[#7676801F] hover:bg-black hover:text-white 
                                            focus:bg-black focus:text-white
                                            transition-colors duration-200 rounded-[40px] pl-10 md:pl-12 pr-5 py-2.5 
                                            text-sm md:text-xl text-black cursor-pointer outline-none">
                                    <option value="date" selected disabled hidden>Тип</option>
                                    <option value="all">Любое</option>
                                    <option value="first">Первое</option>
                                    <option value="second">Второе</option>
                                    <option value="third">Третье</option>
                                    <option value="fourth">Четвертое</option>
                                </select>
                                
                                <div class="pointer-events-none absolute inset-y-0 left-4 flex items-center pr-4">
                                    <i class="fas fa-chevron-down text-xs md:text-xl  text-black transition-all duration-200 
                                            group-hover:text-white group-focus-within:text-white 
                                            group-focus-within:rotate-180"></i>
                                </div>
                            </div>
                        </div>
                        <!-- Кухня -->
                        <div class="min-w-35 lg:min-w-0">
                            <div class="relative group">
                                <select id="date-filter" name="date-filter" 
                                        class="w-full appearance-none bg-[#7676801F] hover:bg-black hover:text-white 
                                            focus:bg-black focus:text-white
                                            transition-colors duration-200 rounded-[40px] pl-10 md:pl-12 pr-5 py-2.5 
                                            text-sm md:text-xl text-black cursor-pointer outline-none">
                                    <option value="date" selected disabled hidden>Кухня</option>
                                    <option value="all">Любое</option>
                                    <option value="first">Первое</option>
                                    <option value="second">Второе</option>
                                    <option value="third">Третье</option>
                                    <option value="fourth">Четвертое</option>
                                </select>
                                
                                <div class="pointer-events-none absolute inset-y-0 left-4 flex items-center pr-4">
                                    <i class="fas fa-chevron-down text-xs md:text-xl  text-black transition-all duration-200 
                                            group-hover:text-white group-focus-within:text-white 
                                            group-focus-within:rotate-180"></i>
                                </div>
                            </div>
                        </div>
                        <!-- Время работы -->
                        <div class="min-w-35 lg:min-w-0">
                            <div class="relative group">
                                <select id="date-filter" name="date-filter" 
                                        class="w-full appearance-none bg-[#7676801F] hover:bg-black hover:text-white 
                                            focus:bg-black focus:text-white
                                            transition-colors duration-200 rounded-[40px] pl-10 md:pl-12 pr-5 py-2.5 
                                            text-sm md:text-xl text-black cursor-pointer outline-none">
                                    <option value="date" selected disabled hidden>Время работы</option>
                                    <option value="all">Любое</option>
                                    <option value="first">Первое</option>
                                    <option value="second">Второе</option>
                                    <option value="third">Третье</option>
                                    <option value="fourth">Четвертое</option>
                                </select>
                                
                                <div class="pointer-events-none absolute inset-y-0 left-4 flex items-center pr-4">
                                    <i class="fas fa-chevron-down text-xs md:text-xl  text-black transition-all duration-200 
                                            group-hover:text-white group-focus-within:text-white 
                                            group-focus-within:rotate-180"></i>
                                </div>
                            </div>
                        </div>
                        <!-- Диапазон чека -->
                        <div class="min-w-35 lg:min-w-0">
                            <div class="relative group">
                                <select id="date-filter" name="date-filter" 
                                        class="w-full appearance-none bg-[#7676801F] hover:bg-black hover:text-white 
                                            focus:bg-black focus:text-white
                                            transition-colors duration-200 rounded-[40px] pl-10 md:pl-12 pr-5 py-2.5 
                                            text-sm md:text-xl text-black cursor-pointer outline-none">
                                    <option value="date" selected disabled hidden>Диапазон чека</option>
                                    <option value="all">Любое</option>
                                    <option value="first">Первое</option>
                                    <option value="second">Второе</option>
                                    <option value="third">Третье</option>
                                    <option value="fourth">Четвертое</option>
                                </select>
                                
                                <div class="pointer-events-none absolute inset-y-0 left-4 flex items-center pr-4">
                                    <i class="fas fa-chevron-down text-xs md:text-xl  text-black transition-all duration-200 
                                            group-hover:text-white group-focus-within:text-white 
                                            group-focus-within:rotate-180"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-2 xl:grid-cols-3 gap-1 lg:gap-5 3xl:gap-7.5 p-6">
                @foreach ($restaurants as $restaurant)
                    <div class="card bg-white rounded-[7px] sm:rounded-[19px] overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300 mb-2 xl:mb-12">
                        <div class="card-content p-2 sm:p-5 relative">
                            <div class="">
                                <img src="{{ $restaurant->attachments?->get(0)?->url() ?? "" }}" alt="Изображение {{ $restaurant->name }}" class="">
                                <div class="absolute top-4 right-3.5 sm:top-10 sm:right-9.5 size-5 sm:size-10 xl:size-12 3xl:size-15 bg-[#A855F7] rounded-[3px] sm:rounded-md xl:rounded-xl flex items-center justify-center text-white text-xs sm:text-xl xl:text-2xl shadow-lg">
                                    <i class="fa-sharp fa-solid fa-heart"></i>
                                </div>
                                <div class="absolute top-4 sm:top-10 left-3.5 sm:left-9.5 bg-white/90 backdrop-blur-sm p-2 rounded-full shadow-lg flex items-center gap-1.5">
                                    <i class="fas fa-star text-yellow-500"></i>
                                    <span class="text-sm font-semibold text-black">4.9</span>
                                </div>
                            </div> 
                            <div class="flex flex-col font-['FindSansPro'] mt-3 sm:mt-4">
                                <h1 class="text-center text-xs sm:text-lg lg:text-xl xl:text-3xl font-bold">{{ $restaurant->name }}</h1>
                                <div class="flex flex-col">
                                    <div class="flex flex-col text-[8px] sm:text-sm lg:text-base xl:text-lg 3xl:text-2xl font-light gap-3 text-[#5F5F5F] mt-2 lg:mt-5 mb-0 sm:mb-2 lg:mb-6">
                                        <p class="text-center">{{ $restaurant->kitchen }} кухня</p>
                                        <span class="flex items-center gap-3.5">
                                            <i class="fa-solid fa-clock"></i>
                                            {{ $restaurant->worktime }}
                                        </span>                                   
                                        <span class="flex items-center gap-3.5">
                                            <i class="fas fa-phone"></i>
                                            {{ $restaurant->phone }}
                                        </span>
                                        <span class="flex items-center gap-3.5">
                                            <i class="fas fa-map-marker-alt"></i>
                                            {{ $restaurant->address }}
                                        </span>
                                    </div>
                                    <form action="{{ route('single-restaurant', ['restaurant' => $restaurant->id]) }}">
                                        <button class="w-full gradient-button text-white text-[8px] sm:text-base xl:text-xl py-1 lg:py-2 rounded-[3px] sm:rounded-lg hover:opacity-90 transition-opacity">
                                            Подробнее
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
</div>
