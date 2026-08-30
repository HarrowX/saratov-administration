@section('title')
    Саратов 435 - Экскурсоводы
@endsection


<div>
    <!--Hero Section-->
    <section class="features-section pt-28 md:pt-35 xl:pt-31 3xl:pt-41.5 bg-white">
        <div class="max-w-6xl 3xl:max-w-421 mx-auto px-4 sm:px-10">
            <div class="text-center mb-4 md:mb-10 3xl:mb-25">
                <h2>Экскурсоводы</h2>
                <p class="text text-gray-600">Экскурсии от людей, влюблённых в город</p>
            </div>
            <div class="flex flex-col-reverse md:flex-row items-center gap-5 lg:gap-9.5">
                <div>
                    <p class="text-base xl:text-lg 3xl:text-xl text-black">Саратов - город с характером, и лучше всего его раскрывают местные экскурсоводы. Они покажут не только известные места и панорамы Волги, но и тихие дворики, купеческие истории, архитектурные детали и маршруты, которые не найти в путеводителях. Выбирайте формат под настроение: обзорная прогулка, тематическая экскурсия, семейный маршрут или индивидуальная программа. Саратов становится ближе, когда его рассказывает человек, который здесь живет и знает город изнутри.
                    </p>
                </div>
                <div class="min-w-full md:min-w-88 lg:min-w-146 h-88 xl:h-90 3xl:h-auto 3xl:min-w-237.5">
                    <img src="{{asset('/images/8db8ab433352393d924ca0346e6cbc898e876593.webp')}}" class="rounded-md md:rounded-2xl">
                </div>
            </div>
        </div>
    </section>

    <!-- Section with guided cards -->
    <section id="cards" class="bg-white pb-10 py-5 sm:py-10 md:py-15 xl:py-20 3xl:py-26">
        <div class="max-w-6xl 3xl:max-w-427 mx-auto px-4 sm:px-10 flex flex-col gap-7 md:gap-12 items-center">
            <form wire:submit="loadGuidedTours" class="relative w-67 sm:w-114 group">
                <input type="search"
                       wire:model="searchString"
                       id="search"
                       placeholder="Найти экскурсовода"
                       class="font-['FindSansPro']; w-full border-2 border-black rounded-3xl py-3 pl-5 pr-12
                        text-base outline-none appearance-none
                        [&::-webkit-search-cancel-button]:hidden
                        [&::-webkit-search-decoration]:hidden
                        transition-all duration-200
                        focus:border-blue-300 group-focus:ring-2 group-focus:ring-blue-300/30">

                <button type="submit" class="absolute inset-y-0 right-0 flex items-center pr-5">
                    <i class="fas fa-search text-black transition-colors duration-200 group-focus-within:text-blue-500 hover:text-gray-600"></i>
                </button>
            </form>
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5 3xl:gap-7.5 gap-y-7 xl:gap-y-12">
                @foreach ($this->guidedTours as $guidedTour)
                    <div class="card bg-white rounded-[7px] sm:rounded-[20px] overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300 group">
                        <div class="card-content group p-5 relative grid grid-rows-subgrid content-between row-span-2 gap-3 h-full font-['FindSansPro']">
                            <div>
                                <div class="overflow-hidden rounded-[7px] sm:rounded-[19px]">
                                    <a href="{{ route('single-guided-tour', ['guidedTour' => $guidedTour->id]) }}">
                                        <img src="{{ $guidedTour->getPrimaryThumbImageUrl() }}" alt="{{ $guidedTour->getAltPrimaryImage() }}" class="photo rounded-[7px] sm:rounded-[19px] w-full h-60 3xl:h-90 object-cover group-hover:scale-110 transition-transform duration-500">
                                    </a>
                                    <livewire:favorite-mini-button :object="$guidedTour"/>
                                </div>
                            </div>
                            <a href="{{ route('single-guided-tour', ['guidedTour' => $guidedTour->id]) }}">
                                <h2 class="card-title text-center text-lg lg:text-xl 3xl:text-3xl font-bold group-hover:text-[#352AA2] transition-colors duration-300">{{ $guidedTour->name }}</h2>
                                <div class="flex flex-col justify-between h-full font-['FindSansPro']">
                                    <div class="flex flex-row justify-between items-end gap-3.5 text-xs sm:text-sm lg:text-base 3xl:text-[22px] font-light">
                                        <span class="items-center justify-end gap-3.5 text-[#5F5F5F]  leading-5 3xl:leading-7 line-clamp-3">
                                            {{ $guidedTour->short_description }}
                                        </span>
                                        <a href="{{ route('single-guided-tour', ['guidedTour' => $guidedTour->id]) }}" class="arrow-link shrink-0 size-10 xl:size-11 3xl:size-15 bg-linear-to-r from-[#A556F7] to-[#2663EB] rounded-full flex items-center justify-center hover:opacity-90 hover:scale-110 group/button relative overflow-hidden transition-all duration-300 ease-in-out hover:shadow-lg hover:shadow-purple-500/30">
                                            <img src="{{asset('/images/arrow-right.png')}}" alt="Стрелка" class="icon w-2 xl:w-3 3xl:w-4 h-4.5 xl:h-6 3xl:h-7.5 transition-transform duration-300 group-hover/button:translate-x-1">
                                        </a>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
            {{ $this->guidedTours->links('livewire::tailwind') }}
            @if($this->guidedTours->isEmpty())
                <div class="text-center">
                    <div class="w-24 h-24 bg-blue-50 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fa fa-compass text-4xl text-[#352AA2]"></i>
                    </div>
                    <h3 class="text-2xl font-semibold text-gray-700 mb-2">Экскурсоводов нет</h3>
                    <p class="text-gray-500">Попробуйте изменить фильтр или загляните позднее!</p>
                </div>
            @else
            @endif
        </div>
    </section>
</div>
