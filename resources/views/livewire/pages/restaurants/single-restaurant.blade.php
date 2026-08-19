@section('title')
    Саратов 435 - {{ $restaurant->name }}
@endsection

<div>
    <script>
        window.mapData = {
            attractions: [],
            hotels: [],
            restaurants: @js([$restaurant]),
        };
        window.mapCenter = @js([$restaurant->latitude , $restaurant->longitude]);
    </script>

    <section class="pt-25 3xl:pt-30 flex flex-col gap-5 bg-white">
        <div class="max-w-6xl 3xl:max-w-7xl mx-auto px-4 sm:px-10 flex flex-row justify-between items-start w-full">
            <a href="{{ route('all-restaurants') }}"
               class="flex items-center xl:gap-2 text-[#5F5F5F] hover:text-blue-800 transition-colors font-['FindSansPro']">
                <i class="fa-solid fa-chevron-left text-base xs:text-xl xl:text-xl 3xl:text-3xl"></i>
                <span class="text-base xs:text-xl 3xl:text-3xl md:pl-4">Заведения</span>
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
        <div wire:ignore class="max-w-6xl 3xl:max-w-7xl mx-auto px-4 sm:px-10 flex flex-col gap-7 2xl:gap-11">
            <div class="flex flex-col lg:flex-row gap-6 md:gap-8 xl:gap-11">
                <div class="gallery-detail-swiper grid w-full relative opacity-0">
                    <div class="place-detail-swiper-main swiper shadow-[0_4px_4px_0_#00000040] rounded-3xl h-120 lg:h-80 xl:h-100 2xl:h-120 3xl:h-160 relative group w-full">
                        <div class="swiper-wrapper">
                            @foreach($restaurant->attachments as $attachment)
                                <div class="swiper-slide cursor-pointer" data-fancybox="gallery" data-src="{{ $attachment->url() }}" data-caption="{{$attachment->alt_name}}">
                                    <div class="w-full h-full rounded-3xl">
                                        <img src="{{ $attachment->url() }}" alt="{{$attachment->alt_name}}" class="photo w-full h-full object-cover select-none" loading="lazy" />
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="absolute right-6 bottom-6 z-20 flex items-center justify-center rounded-full transition-transform duration-300 group-hover:scale-110 cursor-pointer select-none" onclick="openGallery()">
                            <i class="fas fa-search-plus text-white/50 text-2xl lg:text-3xl transition-transform duration-300 group-hover:scale-125 group-hover:text-white/70"></i>
                        </div>

                        @if($restaurant->attachments->count() > 1)
                            <div class="button-navigation--main-left  absolute top-1/2 -translate-y-1/2 w-10 h-10 lg:w-12 lg:h-12 xl:w-14 xl:h-14 rounded-full border-2 border-white/30 flex items-center justify-center cursor-pointer z-10 left-3 lg:left-4 xl:left-5 transition-all duration-300 hover:bg-white/20 hover:border-white/60 hover:scale-110 group/nav select-none">
                                <i class="fa-solid fa-chevron-left text-xl lg:text-2xl xl:text-3xl text-white/70 group-hover/nav:text-white transition-colors duration-300"></i>
                            </div>

                            <div class="button-navigation--main-right absolute top-1/2 -translate-y-1/2 w-10 h-10 lg:w-12 lg:h-12 xl:w-14 xl:h-14 rounded-full border-2 border-white/30 flex items-center justify-center cursor-pointer z-10 right-3 lg:right-4 xl:right-5 transition-all duration-300 hover:bg-white/20 hover:border-white/60 hover:scale-110 group/nav select-none">
                                <i class="fa-solid fa-chevron-right text-xl lg:text-2xl xl:text-3xl text-white/70 group-hover/nav:text-white transition-colors duration-300"></i>
                            </div>
                        @endif
                        <div class="absolute inset-0 z-9 bg-linear-to-t from-black/80 via-black/30 to-transparent rounded-b-3xl pointer-events-none"></div>

                        <div class="absolute z-10 bottom-0 left-0 right-0 p-4 sm:p-6 lg:p-8 rounded-b-3xl cursor-pointer select-none"  onclick="openGallery()">
                            <h1 class="text-3xl lg:text-4xl 3xl:text-5xl font-bold text-white drop-shadow-lg">
                                {{ $restaurant->name }}
                            </h1>
                        </div>
                    </div>


                    @if($restaurant->attachments->count() >= 5)
                        <div class="place-detail-swiper-thumbs swiper hidden! lg:block! mt-4">
                            <div class="swiper-wrapper cursor-grab! focus:cursor-grabbing! active:cursor-grabbing!">
                                @foreach($restaurant->attachments as $attachment)
                                    <div class="swiper-slide opacity-40 border-3 border-transparent overflow-hidden shrink-0! cursor-grab focus:cursor-grabbing! active:cursor-grabbing! rounded-2xl h-14! lg:h-25! 3xl:h-30! hover:opacity-100">
                                        <img src="{{ $attachment->url() }}" alt="Thumb"
                                             class="photo w-full h-full object-cover rounded-xl thumb-image transition-transform duration-300"
                                             loading="lazy"/>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <section class="pt-10 xl:pt-16 pb-10 bg-white">
        <div class="max-w-6xl 3xl:max-w-7xl mx-auto px-4 sm:px-10 flex flex-col gap-10 box-border relative">
            <div class="bg-[#E5E6F6] rounded-xl sm:rounded-3xl p-3 sm:p-6 md:p-8">
                <h2>О месте</h2>
                <div class="flex flex-col lg:flex-row gap-5 xl:gap-10">
                    <div class="flex flex-col justify-between gap-3">
                        <p class="text-base md:text-lg text-[#5F5F5F] leading-relaxed">{{ $restaurant->description }}</p>

                        <div class="flex flex-col lg:flex-row gap-5 pt-3 min-w-fit border-t-2 border-gray-300">
                            <div class="flex items-center gap-3">
                                <span class="size-10 sm:size-12 flex justify-center items-center bg-white/60 rounded-xl">
                                    <i class="fa fa-cutlery text-[#5F5F5F] text-lg sm:text-2xl"></i>
                                </span>
                                <div>
                                    <span class="text-xs text-gray-400 block">Кухня</span>
                                    <span class="font-medium">{{ $restaurant->kitchen }}</span>
                                </div>
                            </div>
                            @if($restaurant->price_category)
                                <div class="flex items-center gap-3">
                                    <span class="size-10 sm:size-12 flex justify-center items-center bg-white/60 rounded-xl">
                                        <i class="fa fa-rouble text-[#5F5F5F] text-lg sm:text-2xl"></i>
                                    </span>
                                    <div>
                                        <span class="text-xs text-gray-400 text-nowrap block">Ценовая категория</span>
                                        <span class="font-medium">
                                            @switch($restaurant->price_category)
                                                    @case('budget')
                                                        Дешево
                                                        @break
                                                    @case('medium')
                                                        Средне
                                                        @break
                                                    @case('premium')
                                                        Премиум
                                                        @break
                                                    @case('luxury')
                                                        Люкс
                                                        @break
                                                    @default
                                                        Не указано
                                                @endswitch
                                        </span>
                                    </div>
                                </div>
                            @endif

                            @if($restaurant->capacity)
                                <div class="flex items-center gap-3">
                                <span class="size-10 sm:size-12 flex justify-center items-center bg-white/60 rounded-xl">
                                    <i class="fas fa-users text-[#5F5F5F] text-lg sm:text-2xl"></i>
                                </span>
                                    <div>
                                        <span class="text-xs text-gray-400 block">Вместимость</span>
                                        <span class="font-medium">{{ $restaurant->capacity }} мест</span>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    @if(!empty($restaurant->worktime))
                        <div class="flex flex-col gap-4 p-3 sm:p-5 min-h-full w-full min-w-fit bg-white/60 rounded-xl">
                            <p class="text-base font-semibold text-gray-800 text-center font-['Merriweather']">Часы работы</p>
                            <div class="flex flex-col gap-5 text-xs sm:text-sm">
                                @foreach($restaurant->worktime as $day => $time)
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

    <section class="pt-10 xl:pt-16 pb-16">
        <div class="max-w-6xl 3xl:max-w-7xl mx-auto px-4 sm:px-10">
            <h2>Как добраться</h2>
            <div class="bg-[#E5E6F6] rounded-xl sm:rounded-3xl flex flex-col lg:flex-row">
                <div class="flex flex-col justify-between w-full gap-5 p-3 sm:p-6 md:p-8">
                    @if($restaurant->district)
                        <div class="flex items-center gap-3">
                            <span class="size-10 sm:size-12 flex justify-center items-center bg-white/60 rounded-xl">
                                <i class="fas fa-city text-[#5F5F5F] text-lg sm:text-2xl"></i>
                            </span>
                            <div>
                                <span class="text-xs text-gray-400 block">Район</span>
                                <p>{{$restaurant->district}}</p>
                            </div>
                        </div>
                    @endif
                    <div class="flex items-center gap-3 min-w-full">
                        <span class="size-10 sm:size-12 min-w-10 lg:min-w-12 flex justify-center items-center bg-white/60 rounded-xl">
                            <i class="fas fa-location-dot text-[#5F5F5F] text-lg sm:text-2xl"></i>
                        </span>
                        <div>
                            <span class="text-xs text-gray-400 block">Адрес</span>
                            <p>{{$restaurant->address}}</p>
                        </div>
                    </div>
                    <div class="bg-white/60 rounded-lg sm:rounded-2xl p-3 sm:p-5">
                        <p class="text-base font-semibold text-gray-800 font-['Merriweather'] border-b border-gray-300 pb-2">Контакты</p>
                        <div class="flex flex-col lg:gap-1 pt-2">
                            <div class="group flex items-center gap-3 p-2 rounded-xl hover:bg-white/40 transition-all duration-300">
                                <span class="size-10 flex justify-center items-center bg-[#E5E6F6] rounded-lg group-hover:scale-110 transition-transform duration-300 relative overflow-hidden">
                                    <i class="fas fa-phone absolute transition-all duration-300 group-hover:opacity-0 group-hover:scale-75 text-[#5F5F5F] text-base sm:text-xl group-hover:text-[#2663EB]"></i>
                                    <i class="fas fa-phone-volume absolute transition-all duration-500 opacity-0 scale-75 group-hover:opacity-100 group-hover:scale-100 text-[#2663EB] text-base sm:text-xl group-hover:animate-[shake_0.5s_ease-in-out]"></i>
                                </span>
                                <div class="flex flex-col items-start justify-center flex-1 min-w-0">
                                    <span class="text-xs text-gray-400 font-medium">Телефон</span>
                                    @php
                                        $phones = array_map(fn (string $item) => trim($item), explode(',', $restaurant->phone));
                                    @endphp
                                    @if(!empty($phones))
                                        @foreach($phones as $phone)
                                        <a href="tel:{{ $phone }}" class="flex items-center gap-1.5 hover:text-[#2663EB] transition-colors duration-300">
                                            <p>{{ $phone }}</p>
                                        </a>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            @if($restaurant->email)
                                <div class="group/mail flex items-center gap-3 p-2 rounded-xl hover:bg-white/40 transition-all duration-300">
                                    <span class="size-10 flex justify-center items-center bg-[#E5E6F6] rounded-lg group-hover:scale-110 transition-transform duration-300 relative overflow-hidden">
                                        <i class="fa-solid fa-envelope absolute transition-all duration-300 group-hover/mail:opacity-0 group-hover/mail:scale-75 text-[#5F5F5F] text-base sm:text-xl group-hover/mail:text-[#2663EB]"></i>
                                        <i class="fa-solid fa-envelope-open absolute transition-all duration-500 opacity-0 scale-75 group-hover/mail:opacity-100 group-hover/mail:scale-100 text-[#2663EB] text-base sm:text-xl group-hover/mail:animate-[shake_0.5s_ease-in-out]"></i>
                                    </span>
                                    <div class="flex flex-col items-start justify-center flex-1 min-w-0">
                                        <span class="text-xs text-gray-400 font-medium">Почта</span>
                                        <a href="mailto:{{ $restaurant->email }}"
                                           class="flex items-center gap-1.5 hover:text-[#2663EB] transition-colors duration-300 group/link">
                                            <p>{{ $restaurant->email }}</p>
                                        </a>
                                    </div>
                                </div>
                            @endif
                            @if($restaurant->website)
                                <div class="group/site flex items-center gap-3 p-2 rounded-xl hover:bg-white/40 transition-all duration-300">
                                    <span class="size-10 flex justify-center items-center bg-[#E5E6F6] rounded-lg group-hover:scale-110 transition-transform duration-300 relative overflow-hidden">
                                        <i class="fa-solid fa-hand-pointer transition-transform duration-300 rotate-30 group-hover/site:rotate-90 text-[#5F5F5F] group-hover/site:text-[#2663EB] text-base sm:text-xl"></i>
                                    </span>
                                    <div class="flex flex-col items-start justify-center flex-1 min-w-0">
                                        <span class="text-xs text-gray-400 font-medium">Сайт</span>
                                        <a href="{{ $restaurant->website }}" target="_blank"
                                           class="flex items-center gap-1.5 hover:text-[#2663EB] transition-all duration-300 group/link">
                                            <p>Перейти на сайт</p>
                                            <i class="fa-solid fa-arrow-up-right-from-square text-[10px] text-gray-400 opacity-0 group-hover/link:opacity-100 transition-all duration-300 group-hover/link:translate-x-0.3 group-hover/link:-translate-y-0.3"></i>
                                        </a>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="restaurant lg:min-w-150">
                    <div id="map" class="w-full min-h-100 h-full rounded-b-xl lg:rounded-bl-none lg:rounded-r-3xl overflow-hidden border-0 box-shadow-0"></div>
                </div>
            </div>
        </div>
    </section>


    @if(!is_null($restaurant->yandex_review_widget) && ($restaurant->yandex_review_widget != ""))
    <section class="pt-10 pb-10 bg-[#FBFBFB]">
        <div class="max-w-6xl 3xl:max-w-7xl mx-auto px-4 sm:px-10">
                <div data-aos="fade-right" class="w-full flex flex-col items-center">
                    <h2 class="text-center">Отзывы на Яндекс Картах</h2>
                    <p class="text-center text-gray-600">Отзывы реальных посетителей — рейтинг, впечатления, рекомендации</p>
                    <div class=" w-full h-full max-w-190 mx-auto rounded-2xl overflow-hidden bg-white p-1 mt-5 [&_iframe]:w-full! [&_iframe]:border-none! [&_iframe]:rounded-xl! shadow-lg! [&_iframe]:block">{!! $restaurant->yandex_review_widget !!}</div>
                </div>

        </div>
    </section>
    @endif

    @livewire('attraction-component', ['latitude' => $restaurant->latitude, 'longitude' => $restaurant->longitude])
</div>
