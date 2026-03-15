@section('title')
    Саратов 435 - Экскурсии {{ $guidedTour->name }}
@endsection

<div>
    <!--Hero Section-->
    <section class="features-section flex justify-center pt-25.5 xl:pt-41.5 pb-26 bg-white">
        <div class="flex flex-col lg:flex-row gap-2.5 sm:gap-10 2xl:gap-17.5 max-w-3xl lg:max-w-5xl xl:max-w-7xl 3xl:max-w-398.25 mx-auto px-5 sm:px-10">
            <div class="relative aspect-4/3 rounded-2xl overflow-hidden min-w-full lg:min-w-100 xl:min-w-150 3xl:min-w-202">
                <img src="{{ $guidedTour->attachments?->get(0)?->url() ?? "" }}" alt="Изображение {{ $guidedTour->name }}">
                <div class="absolute top-3 right-3 bg-white/90 backdrop-blur-sm p-2 rounded-full shadow-lg flex items-center gap-1.5">
                    <i class="fas fa-star text-yellow-500"></i>
                    <span class="text-sm font-semibold text-black">4.9</span>
                </div>
            </div>
            <div>
                <h1 class="font-black text-3xl xl:text-5xl text-center pb-12">{{ $guidedTour->name }}</h1>
                <div class="text-base xl:text-xl flex flex-col gap-2.5 xl:gap-8">
                    <p>{{ $guidedTour->short_description }}</p>
                    <p>Стаж работы: {{ $guidedTour->experience }}</p>
                    <p>{{ $guidedTour->description }}</p>
                    <div class="flex flex-row gap-10">
                       <img src="/images/phone.png" class="icon size-8">
                       <p>{{ $guidedTour->phone }}</p>
                    </div>
                    <div class="flex flex-row gap-10 ml-3">
                       <img src="/images/gues.png" class="icon w-4.5 h-8">
                       <p>Задать вопрос: {{ $guidedTour->email }}</p>
                    </div>
                    <div class="flex flex-row gap-11 xl:gap-17.5 justify-center xl:justify-start">
                        <img src="/images/telegram.png" class="icon">
                        <img src="/images/vk.png" class="icon">
                        <img src="/images/whatsapp.png" class="icon">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="py-20 bg-gray-50">
        <div class="max-w-3xl lg:max-w-5xl xl:max-w-7xl 3xl:max-w-398.25 mx-auto px-5 sm:px-10">
            <div class="text-center mb-12">
                <h2>Экскурсии {{ $guidedTour->name }}</h2>
            </div>

            <!-- Карусель -->
            <div class="relative group">
                <div class="flex overflow-x-auto gap-6 pb-6 scrollbar-hide scroll-smooth" 
                    style="scrollbar-width: none; -ms-overflow-style: none;">
                    
                    <div class="shrink-0 w-[85%] sm:w-100 lg:w-[calc(33.333%-16px)] card bg-white rounded-[19px] overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300">
                        <div class="card-content p-2 sm:p-6 relative">
                            <div class="">
                                <img src="/images/трамвай.png" alt="Мистический Саратов" class="">
                                <div class="absolute top-4 right-3.5 sm:top-10 sm:right-9.5 size-5 sm:size-10 xl:size-15 bg-[#A855F7] rounded-[3px] sm:rounded-md xl:rounded-xl flex items-center justify-center text-white text-xs sm:text-xl xl:text-3xl shadow-lg">
                                    <i class="fa-sharp fa-solid fa-heart"></i>
                                </div>
                            </div>
                            <div class="flex flex-col font-['FindSansPro'] mt-3 sm:mt-4">
                                <h1 class="text-xs sm:text-lg lg:text-xl xl:text-2xl 3xl:text-3xl font-bold md:pt-3 line-clamp-2 sm:line-clamp-3 h-8 sm:h-22 md:h-25 xl:h-28 3xl:h-32">Мистический Саратов</h1>
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
                                    <form action="{{ route('single-excurtion', ['excurtion' => 1]) }}">
                                        <button class="w-full gradient-button text-white text-[8px] sm:text-base xl:text-xl py-1 lg:py-2 rounded-[3px] sm:rounded-lg hover:opacity-90 transition-opacity">
                                            Подробнее
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Карточка 2 -->
                    <div class="shrink-0 w-[85%] sm:w-100 lg:w-[calc(33.333%-16px)] card bg-white rounded-[19px] overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300">
                        <div class="card-content p-2 sm:p-6 relative">
                            <div class="">
                                <img src="/images/трамвай.png" alt="Мистический Саратов" class="">
                                <div class="absolute top-4 right-3.5 sm:top-10 sm:right-9.5 size-5 sm:size-10 xl:size-15 bg-[#A855F7] rounded-[3px] sm:rounded-md xl:rounded-xl flex items-center justify-center text-white text-xs sm:text-xl xl:text-3xl shadow-lg">
                                    <i class="fa-sharp fa-solid fa-heart"></i>
                                </div>
                            </div>
                            <div class="flex flex-col font-['FindSansPro'] mt-3 sm:mt-4">
                                <h1 class="text-xs sm:text-lg lg:text-xl xl:text-2xl 3xl:text-3xl font-bold md:pt-3 line-clamp-2 sm:line-clamp-3 h-8 sm:h-22 md:h-25 xl:h-28 3xl:h-32">Мистический Саратов</h1>
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
                                    <form action="{{ route('single-excurtion', ['excurtion' => 1]) }}">
                                        <button class="w-full gradient-button text-white text-[8px] sm:text-base xl:text-xl py-1 lg:py-2 rounded-[3px] sm:rounded-lg hover:opacity-90 transition-opacity">
                                            Подробнее
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Карточка 3 -->
                    <div class="shrink-0 w-[85%] sm:w-100 lg:w-[calc(33.333%-16px)] card bg-white rounded-[19px] overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300">
                        <div class="card-content p-2 sm:p-6 relative">
                            <div class="">
                                <img src="/images/трамвай.png" alt="Мистический Саратов" class="">
                                <div class="absolute top-4 right-3.5 sm:top-10 sm:right-9.5 size-5 sm:size-10 xl:size-15 bg-[#A855F7] rounded-[3px] sm:rounded-md xl:rounded-xl flex items-center justify-center text-white text-xs sm:text-xl xl:text-3xl shadow-lg">
                                    <i class="fa-sharp fa-solid fa-heart"></i>
                                </div>
                            </div>
                            <div class="flex flex-col font-['FindSansPro'] mt-3 sm:mt-4">
                                <h1 class="text-xs sm:text-lg lg:text-xl xl:text-2xl 3xl:text-3xl font-bold md:pt-3 line-clamp-2 sm:line-clamp-3 h-8 sm:h-22 md:h-25 xl:h-28 3xl:h-32">Мистический Саратов</h1>
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
                                    <form action="{{ route('single-excurtion', ['excurtion' => 1]) }}">
                                        <button class="w-full gradient-button text-white text-[8px] sm:text-base xl:text-xl py-1 lg:py-2 rounded-[3px] sm:rounded-lg hover:opacity-90 transition-opacity">
                                            Подробнее
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Карточка 4 -->
                    <div class="shrink-0 w-[85%] sm:w-100 lg:w-[calc(33.333%-16px)] card bg-white rounded-[19px] overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300">
                        <div class="card-content p-2 sm:p-6 relative">
                            <div class="">
                                <img src="/images/трамвай.png" alt="Мистический Саратов" class="">
                                <div class="absolute top-4 right-3.5 sm:top-10 sm:right-9.5 size-5 sm:size-10 xl:size-15 bg-[#A855F7] rounded-[3px] sm:rounded-md xl:rounded-xl flex items-center justify-center text-white text-xs sm:text-xl xl:text-3xl shadow-lg">
                                    <i class="fa-sharp fa-solid fa-heart"></i>
                                </div>
                            </div>
                            <div class="flex flex-col font-['FindSansPro'] mt-3 sm:mt-4">
                                <h1 class="text-xs sm:text-lg lg:text-xl xl:text-2xl 3xl:text-3xl font-bold md:pt-3 line-clamp-2 sm:line-clamp-3 h-8 sm:h-22 md:h-25 xl:h-28 3xl:h-32">Мистический Саратов</h1>
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
                                    <form action="{{ route('single-excurtion', ['excurtion' => 1]) }}">
                                        <button class="w-full gradient-button text-white text-[8px] sm:text-base xl:text-xl py-1 lg:py-2 rounded-[3px] sm:rounded-lg hover:opacity-90 transition-opacity">
                                            Подробнее
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Карточка 5 -->
                    <div class="shrink-0 w-[85%] sm:w-100 lg:w-[calc(33.333%-16px)] card bg-white rounded-[19px] overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300">
                        <div class="card-content p-2 sm:p-6 relative">
                            <div class="">
                                <img src="/images/трамвай.png" alt="Мистический Саратов" class="">
                                <div class="absolute top-4 right-3.5 sm:top-10 sm:right-9.5 size-5 sm:size-10 xl:size-15 bg-[#A855F7] rounded-[3px] sm:rounded-md xl:rounded-xl flex items-center justify-center text-white text-xs sm:text-xl xl:text-3xl shadow-lg">
                                    <i class="fa-sharp fa-solid fa-heart"></i>
                                </div>
                            </div>
                            <div class="flex flex-col font-['FindSansPro'] mt-3 sm:mt-4">
                                <h1 class="text-xs sm:text-lg lg:text-xl xl:text-2xl 3xl:text-3xl font-bold md:pt-3 line-clamp-2 sm:line-clamp-3 h-8 sm:h-22 md:h-25 xl:h-28 3xl:h-32">Саратов легендарный и мистический</h1>
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
                                    <form action="{{ route('single-excurtion', ['excurtion' => 1]) }}">
                                        <button class="w-full gradient-button text-white text-[8px] sm:text-base xl:text-xl py-1 lg:py-2 rounded-[3px] sm:rounded-lg hover:opacity-90 transition-opacity">
                                            Подробнее
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="absolute top-1/2 -translate-y-1/2 left-0 -translate-x-4 opacity-0 group-hover:opacity-100 transition-opacity hidden lg:block">
                        <button onclick="document.querySelector('.overflow-x-auto').scrollBy({left: -400, behavior: 'smooth'})" 
                                class="w-10 h-10 bg-white rounded-full shadow-lg flex items-center justify-center text-gray-600 hover:text-blue-500 transition-colors">
                            <i class="fas fa-chevron-left"></i>
                        </button>
                    </div>
                    <div class="absolute top-1/2 -translate-y-1/2 right-0 translate-x-4 opacity-0 group-hover:opacity-100 transition-opacity hidden lg:block">
                        <button onclick="document.querySelector('.overflow-x-auto').scrollBy({left: 400, behavior: 'smooth'})" 
                                class="w-10 h-10 bg-white rounded-full shadow-lg flex items-center justify-center text-gray-600 hover:text-blue-500 transition-colors">
                            <i class="fas fa-chevron-right"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
