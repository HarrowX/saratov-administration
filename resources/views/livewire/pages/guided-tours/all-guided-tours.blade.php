@section('title')
    Саратов 435 - Экскурсоводы
@endsection


<div>
    <!--Hero Section-->
    <section class="features-section pt-28 md:pt-35 xl:pt-31 3xl:pt-41.5 lg:pb-10 3xl:pb-26 bg-white">
        <div class="max-w-6xl 3xl:max-w-421 mx-auto px-4 sm:px-10">
            <div class="text-center mb-4 md:mb-10 3xl:mb-25">
                <h2>Экскурсоводы</h2>
                <p class="text text-gray-600">Экскурсии от людей, влюблённых в город</p>
            </div>
            <div class="flex flex-col-reverse md:flex-row items-center gap-5 lg:gap-9.5">
                <div data-aos="fade-right">
                    <p class="text-base xl:text-lg 3xl:text-xl text-black">Саратов - город с характером, и лучше всего его раскрывают местные экскурсоводы. Они покажут не только известные места и панорамы Волги, но и тихие дворики, купеческие истории, архитектурные детали и маршруты, которые не найти в путеводителях. Выбирайте формат под настроение: обзорная прогулка, тематическая экскурсия, семейный маршрут или индивидуальная программа. Саратов становится ближе, когда его рассказывает человек, который здесь живет и знает город изнутри.
                    </p>
                </div>
                <div data-aos="fade-left" class="min-w-full md:min-w-88 lg:min-w-146 h-88 xl:h-90 3xl:h-auto 3xl:min-w-237.5">
                    <img src="/images/8db8ab433352393d924ca0346e6cbc898e876593.jpg" class="rounded-md md:rounded-2xl">
                </div>
            </div>
        </div>
    </section>

    <!-- Section with guided cards -->
    <section class="bg-white pb-10  py-5 sm:py-10 md:py-15 xl:py-20 3xl:py-26">
        <div class="max-w-5xl xl:max-w-7xl 3xl:max-w-398.25 mx-auto flex flex-col gap-7 md:gap-12 items-center px-4 sm:px-10">
            <form wire:submit="loadGuidedTours" class="relative w-114">
                <input type="search"
                    wire:model="searchString"
                    id="search" placeholder="Найти экскурсовода"
                    class="w-full border-2 border-black rounded-3xl py-3 pl-5 pr-12
                            text-base outline-none appearance-none
                            [&::-webkit-search-cancel-button]:hidden
                            [&::-webkit-search-decoration]:hidden
                            transition-all duration-200
                            focus:border-blue-500 focus:ring-2 focus:ring-blue-200">

                <button type="submit" class="absolute inset-y-0 right-0 flex items-center pr-5">
                    <i class="fas fa-search text-black transition-colors duration-200 hover:text-gray-900"></i>
                </button>
            </form>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 3xl:gap-14 auto-rows-fr items-stretch">
                @foreach ($guidedTours as $guidedTour)
                    <div class="group relative rounded-2xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden flex flex-col h-full">
                        <div class="flex flex-col h-full">
                            <div class="relative aspect-4/3 rounded-2xl overflow-hidden shrink-0">
                                <img src="{{ $guidedTour->attachments?->get(0)?->url() ?? "" }}"
                                    alt="Изображение {{ $guidedTour->name }}"
                                    class="img-guid w-full h-full group-hover:scale-105 transition-transform duration-500">

                                <div class="absolute top-3 right-3 bg-white/90 backdrop-blur-sm p-2 rounded-full shadow-lg flex items-center gap-1.5">
                                    <i class="fas fa-star text-yellow-500"></i>
                                    <span class="text-sm font-semibold text-black">4.9</span>
                                </div>
                            </div>

                            <div class="p-5 flex flex-col grow">
                                <h1 class="text-xl font-bold text-black text-center">{{ $guidedTour->name }}</h1>
                                <p class="text-gray-600 text-sm leading-relaxed grow mt-4">
                                    {{ $guidedTour->short_description }}
                                </p>
                                <div class="flex justify-center mt-auto pt-5">
                                    <a href="{{ route('single-guided-tour', ['guidedTour' => $guidedTour->id]) }}" class="px-19 bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 rounded-lg transition cursor-pointer text-[10px] md:text-xs 3xl:text-sm">
                                        Подробнее <i class="fas fa-arrow-right ml-1"></i>
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
