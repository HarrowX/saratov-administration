@section('title')
    Саратов 435 - {{ $attraction->name }}
@endsection

<div>
    <script>
        window.mapData = {
            attractions: @js([$attraction]),
            hotels: [],
            restaurants: [],
        };
        window.mapCenter = @js([$attraction->latitude , $attraction->longitude]);
    </script>


    <section class="pt-25 3xl:pt-30 flex flex-col gap-5 bg-white">
        <div class="max-w-6xl 3xl:max-w-7xl mx-auto px-4 sm:px-10 flex flex-row justify-between items-start w-full">
            <a href="{{ route('all-attractions') }}"
               class="flex items-center xl:gap-2 text-[#5F5F5F] hover:text-blue-800 transition-colors font-['FindSansPro']">
                <i class="fa-solid fa-chevron-left text-base xs:text-xl xl:text-xl 3xl:text-3xl"></i>
                <span class="text-base xs:text-xl 3xl:text-3xl md:pl-4">Достопримечательности</span>
            </a>
            <button wire:click="toggleFavorite" class="flex z-20 items-center gap-1 sm:gap-3 px-3 3xl:px-5 py-1.5 3xl:py-3 rounded-full bg-black/20 backdrop-blur-sm border border-white/20 text-white hover:border-red-400/10 hover:text-red-400 transition-all duration-300 font-['FindSansPro'] group">
                <i class="fa-regular fa-heart text-lg sm:text-2xl 3xl:text-3xl group-hover:scale-110 group-hover:animate-pulse transition-transform {{ $isFavorite ? 'fa-solid text-red-400' : 'fa-regular' }}"></i>
                <span class="text-xs xs:text-sm sm:text-lg 3xl:text-3xl font-medium">
                    {{ $isFavorite ? 'В избранном' : 'В избранное' }}
                </span>
                <span class="favorite-count ml-2 text-xs sm:text-base 3xl:text-xl font-bold flex justify-center items-center min-w-5 h-5 sm:min-w-8 sm:h-8 px-1 sm:px-2 rounded-full {{ $isFavorite ? 'bg-red-400 text-white' : 'bg-red-400/80 text-white' }} transition-colors shadow-lg">
                {{ $favoritesCount }}
                </span>
            </button>
        </div>
        <x-gallery :attachable="$attraction">
            <div class="absolute z-10 bottom-0 left-0 right-0 p-4 sm:p-6 lg:p-8 rounded-b-3xl cursor-pointer select-none" onclick="openGallery()">
                <h1 class="text-3xl lg:text-4xl 3xl:text-5xl font-bold text-white drop-shadow-lg">
                    {{ $attraction->name }}
                </h1>
                <p class="text-white/70 line-clamp-4">{{ $attraction->short_description }}</p>
            </div>
        </x-gallery>
    </section>

    <section class="pt-10 xl:pt-16 pb-10 bg-white">
        <div class="max-w-6xl 3xl:max-w-7xl mx-auto px-4 sm:px-10 flex flex-col gap-10 box-border relative">
            <div class="bg-[#E5E6F6] rounded-xl sm:rounded-3xl p-3 sm:p-6 md:p-8">
                <h2>О месте</h2>
                <div class="flex flex-col lg:flex-row gap-5 xl:gap-10">
                    <div class="flex flex-col justify-between gap-3">
                        <p class="text-base md:text-lg text-[#5F5F5F] leading-relaxed">{{ $attraction->description }}</p>
                        <div class="flex flex-col gap-3 pt-3 min-w-fit border-t-2 border-gray-300">
                            <div class="flex flex-col lg:flex-row gap-5">
                                @if($attraction->visit_duration)
                                    <div class="flex items-center gap-3">
                                        <span class="size-10 sm:size-12 flex justify-center items-center bg-white/60 rounded-xl">
                                            <i class="fa fa-clock text-[#5F5F5F] text-lg sm:text-2xl"></i>
                                        </span>
                                        <div>
                                            <span class="text-xs text-gray-400 block">Время посещения</span>
                                            <span class="font-medium">
                                                {{ $attraction->visit_duration }}
                                            </span>
                                        </div>
                                    </div>
                                @endif
                                @if($attraction->ticket_price)
                                    <div class="flex items-center gap-3">
                                        <span class="size-10 sm:size-12 flex justify-center items-center bg-white/60 rounded-xl">
                                            <i class="fa fa-rouble text-[#5F5F5F] text-lg sm:text-2xl"></i>
                                        </span>
                                        <div>
                                            <span class="text-xs text-gray-400 block">Цена билета</span>
                                            <span class="font-medium">
                                                {{ number_format($attraction->ticket_price, 0, '', ' ') }} рублей
                                            </span>
                                        </div>
                                    </div>
                                 @endif
                                @if(!is_null($attraction->has_parking))
                                    <div class="flex items-center gap-3">
                                        <span class="size-10 sm:size-12 flex justify-center items-center bg-white/60 rounded-xl">
                                            <i class="fas fa-parking text-[#5F5F5F] text-lg sm:text-2xl"></i>
                                        </span>
                                        <div>
                                            <span class="text-xs text-gray-400 block">Парковка</span>
                                            <span class="font-medium">
                                                {{ $attraction->has_parking ? 'Имеется' : 'Не имеется' }}
                                            </span>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            @if(!is_null($attraction->is_accessible))
                                <span class="text-xs text-gray-400 block">
                                    {{ $attraction->is_accessible ? 'Обустроено для людей с ограниченными возможностями' : 'Не обустроено для людей с ограниченными возможностями' }}
                                </span>
                            @endif
                        </div>
                    </div>
                    @if(!empty($attraction->worktime))
                        <div class="flex flex-col gap-4 p-3 sm:p-5 min-h-full w-full min-w-fit bg-white/60 rounded-xl">
                            <p class="text-base font-semibold text-gray-800 text-center font-['Merriweather']">Часы работы</p>
                            <div class="flex flex-col gap-5 text-xs sm:text-sm">
                                @foreach($attraction->worktime as $day => $time)
                                    <div class="flex items-center leading-3 gap-1 sm:gap-2">
                                        <span class="text-gray-600 shrink-0">{{ $day }}</span>
                                        <span class="flex-1 border-b-2 border-dotted border-gray-300 min-w-4 self-end"></span>
                                        <span class="font-medium text-gray-800 shrink-0">{{ $time }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <x-yandex-map-details-section :mappable="$attraction" />

    @if(!is_null($attraction->yandex_review_widget) && ($attraction->yandex_review_widget != ""))
        <section class="pt-10 pb-10 bg-[#FBFBFB]">
            <div class="max-w-6xl 3xl:max-w-7xl mx-auto px-4 sm:px-10">
                <div data-aos="fade-right" class="w-full flex flex-col items-center">
                    <h2 class="text-center">Отзывы на Яндекс Картах</h2>
                    <p class="text-center text-gray-600">Отзывы реальных посетителей — рейтинг, впечатления, рекомендации</p>
                    <div class=" w-full h-full max-w-190 mx-auto rounded-2xl overflow-hidden bg-white p-1 mt-5 [&_iframe]:w-full! [&_iframe]:border-none! [&_iframe]:rounded-xl! shadow-lg! [&_iframe]:block">{!! $attraction->yandex_review_widget !!}</div>
                </div>

            </div>
        </section>
    @endif

    @livewire('attraction-component', ['latitude' => $attraction->latitude, 'longitude' => $attraction->longitude])

</div>
