@section('title')
    Саратов 435 - Модерн в Саратове
@endsection
<div class="excursion-page">
    <script>
        window.mapData = {
            attractions: @js($attractions),
            hotels: @js($hotels),
            restaurants: @js($restaurants),
            customPoints: @js($customPoints),
        };

        window.mapCenter = @js($startPosition);
    </script>

    <section id="home" class="relative mt-35 xl:mt-40 3xl:mt-50 ">
        <div class="max-w-6xl 3xl:max-w-7xl mx-auto px-4 sm:px-10  relative">
            <div class="relative overflow-hidden rounded-lg sm:rounded-2xl md:rounded-[30px] h-70 md:h-100 xl:h-125 3xl:h-200">
                <div class="absolute inset-0 bg-cover bg-center bg-no-repeat"
                     style="background-image: url('{{ $excursion->attachments->get(0)?->url() ?? "" }}')">
                </div>
                <div class="absolute inset-x-0 bottom-0 h-40 sm:h-60 md:h-100 bg-linear-to-t from-black via-black/30 3xl:via-black/50 to-transparent"></div>
                <div class="absolute w-full h-full flex justify-center items-end">
                    <h1 class="text-xl sm:text-2xl md:text-4xl 3xl:text-6xl text-white font-extrabold pb-4 md:pb-8 lg:pb-15">{{$excursion->name}}</h1>
                </div>
            </div>

            <a href="{{ route('all-excursions') }}"
               class="absolute left-3 sm:left-14 -top-10 3xl:-top-15 items-center xl:gap-2 text-[#5F5F5F] hover:text-blue-800 transition-colors font-['FindSansPro']">
                <i class="fa-solid fa-chevron-left text-base xs:text-xl xl:text-xl 3xl:text-3xl"></i>
                <span class="text-base xs:text-xl 3xl:text-3xl md:pl-4">Экскурсии</span>
            </a>

            <button wire:click="toggleFavorite" class="flex absolute top-2 right-7.5 sm:top-4 sm:right-25 z-20 items-center gap-1 sm:gap-3 px-3 sm:px-5 py-1.5 sm:py-3 rounded-full bg-black/20 backdrop-blur-sm border border-white/20 text-white hover:border-red-400/50 hover:text-red-400 transition-all duration-300 font-['FindSansPro'] group">
                <i class="fa-regular fa-heart text-lg sm:text-2xl xl:text-3xl group-hover:scale-110 group-hover:animate-pulse transition-transform {{ $isFavorite ? 'fa-solid text-red-400' : 'fa-regular' }}"></i>
                <span class="text-xs xs:text-sm sm:text-lg 2xl:text-3xl font-medium">
                    {{ $isFavorite ? 'В избранном' : 'В избранное' }}
                </span>
                <span class="favorite-count ml-2 text-xs sm:text-base 2xl:text-xl font-bold flex justify-center items-center min-w-5 h-5 sm:min-w-8 sm:h-8 px-1 sm:px-2 rounded-full {{ $isFavorite ? 'bg-red-400 text-white' : 'bg-red-400/80 text-white' }} transition-colors shadow-lg">
                {{ $favoritesCount }}
                </span>
            </button>
        </div>
    </section>

    <section class="pt-10 xl:pt-16 pb-10 bg-white">
        <div class="max-w-6xl 3xl:max-w-7xl mx-auto px-4 sm:px-10 flex flex-col gap-10 box-border relative">
            <div class="bg-[#E5E6F6] rounded-xl sm:rounded-3xl p-3 sm:p-6 md:p-8">
                <div class="flex flex-col justify-between gap-3">
                    <div class="flex flex-col lg:flex-row gap-5 xl:gap-10">
                        <div class="flex flex-col">
                            <h2>О экскурсии</h2>
                            <p class="text-base md:text-lg text-[#5F5F5F] leading-relaxed">{{ $excursion->description }}</p>
                        </div>
                        @if($excursion->attachments->count() >= 3)
                            <div class="job-swiper__swiper swiper mx-auto max-w-full lg:min-w-140 h-110 lg:h-80 3xl:h-100 relative rounded-xl">
                                <div class="swiper-wrapper">
                                    @foreach($excursion->attachments->skip(1) as $attachment)
                                        <div class="swiper-slide flex! justify-center items-center cursor-pointer" data-fancybox="gallery" data-src="{{ $attachment->url() }}" data-caption="{{$attachment->alt_name}}">
                                            <img src="{{ $attachment->url() }}" alt="{{$attachment->alt_name}}"  class="w-full h-full photo object-cover ">
                                        </div>
                                    @endforeach
                                </div>

                                <div class="swiper-pagination pb-4"></div>

                                <!-- Кнопки навигации -->
                                <div class="button-navigation--job-left absolute top-1/2 -translate-y-1/2 w-8 h-13.5 bg-[#FFFFFF33] rounded-full text-white text-xl flex items-center justify-center cursor-pointer z-10 hover:bg-[#ffffffa8] left-2">
                                    <i class="fa-solid fa-chevron-left"></i>
                                </div>
                                <div class="button-navigation--job-right absolute top-1/2 -translate-y-1/2 w-8 h-13.5 bg-[#FFFFFF33] rounded-full text-white text-xl flex items-center justify-center cursor-pointer z-10 hover:bg-[#ffffffa8] right-2">
                                    <i class="fa-solid fa-chevron-right"></i>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="flex flex-wrap lg:flex-nowrap gap-5 pt-2 min-w-fit border-t-2 border-gray-300 w-full">
                        <div class="flex items-center gap-3">
                                <span class="size-10 sm:size-12 flex justify-center items-center bg-white/60 rounded-xl shrink-0">
                                    <i class="fas fa-shoe-prints text-[#5F5F5F] text-lg sm:text-2xl -rotate-90"></i>
                                </span>
                            <div>
                                <span class="text-xs text-gray-400 block">Тип</span>
                                <span class="font-medium">{{ $excursion->type}}</span>
                            </div>
                        </div>
                        <a href="{{route('single-guided-tour', $excursion->guide)}}" class="group flex items-center gap-3 hover:bg-white/40 lg:p-2 rounded-xl transition-colors duration-300 cursor-pointer w-full">
                                <span class="size-10 sm:size-12 min-w-10 sm:min-w-12 flex justify-center items-center bg-white/60 rounded-xl ">
                                    <i class="fa fa-user text-[#5F5F5F] text-lg sm:text-2xl group-hover:text-blue-800 transition-colors duration-300"></i>
                                </span>
                            <div>
                                <span class="text-xs text-gray-400 text-nowrap block">Экскурсовод</span>
                                <span class="font-medium text-blue-800 ">
                                    {{$excursion->guide->name }}
                                </span>
                            </div>
                        </a>

                        @if($excursion->price_adult || $excursion->price_child || $excursion->price_group)
                            <div class="flex items-center gap-3">
                                <span class="size-10 sm:size-12 flex justify-center items-center bg-white/60 rounded-xl shrink-0">
                                    <i class="fas fa-ticket text-[#5F5F5F] text-lg sm:text-2xl"></i>
                                </span>
                                <div>
                                    @if($excursion->is_free)
                                        <span class="text-[#5F5F5F] font-medium">Бесплатно</span>
                                    @else
                                        <div class="font-medium text-sm space-y-0.5 mt-0.5 w-full">
                                            @if($excursion->price_adult)
                                                <div class="flex justify-between gap-4">
                                                    <span class="text-gray-500">Взрослый</span>
                                                    <span class="text-nowrap">{{ number_format($excursion->price_adult, 0, '', ' ') }} ₽</span>
                                                </div>
                                            @endif
                                            @if($excursion->price_child)
                                                <div class="flex justify-between gap-4">
                                                    <span class="text-gray-500">Детский</span>
                                                    <span class="text-nowrap">{{ number_format($excursion->price_child, 0, '', ' ') }} ₽</span>
                                                </div>
                                            @endif
                                            @if($excursion->price_group)
                                                <div class="flex justify-between gap-4">
                                                    <span class="text-gray-500">Группа</span>
                                                    <span class="text-nowrap">{{ number_format($excursion->price_group, 0, '', ' ') }} ₽</span>
                                                </div>
                                            @endif
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endif
                        @if($excursion->group_size_min || $excursion->group_size_max)
                            <div class="flex items-center gap-3 w-full">
                                    <span class="size-10 sm:size-12 flex justify-center items-center bg-white/60 rounded-xl shrink-0">
                                        <i class="fas fa-users text-[#5F5F5F] text-lg sm:text-2xl"></i>
                                    </span>
                                <div>
                                    <span class="text-xs text-gray-400 block">Размер группы</span>
                                    <span class="font-medium">
                                            от {{$excursion->group_size_min}} до {{$excursion->group_size_max}}
                                    </span>
                                </div>
                            </div>
                        @endif
                        @if($excursion->age_restriction)
                            <div class="flex items-center gap-3 w-full">
                                    <span class="size-10 sm:size-12 min-w-10 sm:min-w-12 flex justify-center items-center bg-white/60 rounded-xl shrink-0">
                                        <i class="fa-solid fa-hand text-[#5F5F5F] text-lg sm:text-2xl"></i>
                                    </span>
                                <div>
                                    <span class="text-xs text-gray-400 block">Возрастное ограничение</span>
                                    <span class="font-medium">{{$excursion->age_restriction}}
                                        </span>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="py-5 md:py-10 3xl:py-20 mb-2 md:mb-10 3xl:mb-20 md:bg-[#E5E6F6]">
        <div class="max-w-6xl 3xl:max-w-7xl mx-auto px-4 sm:px-10 flex flex-col">
            <h2 class="text-2xl font-bold mb-4">Места, которые вы посетите</h2>
            <div class="flex flex-col gap-6">
                <div class="flex flex-col lg:flex-row justify-between gap-3">
                    <div class="restaurant lg:min-w-150 max-w-200 h-full">
                        <div id="map" class="w-full min-h-80 3xl:min-h-100 h-full rounded-xl lg:rounded-3xl overflow-hidden border-0 box-shadow-0"></div>
                    </div>
                    <div class="flex flex-col items-start justify-between font-['FindSansPro'] w-full">
                        <ul class="list-decimal! flex flex-col gap-2 text-base md:text-lg text-[#5F5F5F] w-full list-group">
                            @foreach($excursion->points as $index => $point)
                                <li class="point-item cursor-pointer transition-colors duration-200 group flex items-center justify-between w-full [&.active]:text-blue-500"
                                    data-index="{{ $index }}">
                                    <span class="flex items-center gap-2">
                                        <span class="point-number inline-flex items-center justify-center  size-7.5 rounded-full text-base font-bold transition-colors duration-200 bg-[#E5E6F6] text-[#5F5F5F] group-hover:bg-blue-500 group-hover:text-white in-[.active]:bg-blue-500 in-[.active]:text-white shrink-0">
                                        {{ $index + 1 }}
                                        </span>
                                        <p>{{ $point->excursionPointable?->name ?? 'Без названия' }}</p>
                                    </span>
                                    <span class="point-show ml-2 text-xs text-blue-500 opacity-0 group-hover:opacity-100 transition-all duration-200 bg-[#E5E6F6] px-2 py-1 rounded-full group-hover:bg-blue-500 group-hover:text-white in-[.active]:opacity-0 in-[.active]:pointer-events-none text-nowrap select-none hidden lg:inline">
                                        <i class="fa-solid fa-location-dot mr-1"></i>Показать
                                    </span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="flex flex-wrap gap-3 w-full">
                    <div class="flex flex-col gap-1 xl:gap-1">
                        <div class="flex items-center gap-2 xl:gap-5">
                                <span class="size-10 sm:size-12 min-w-10 sm:min-w-12 flex justify-center items-center bg-[#E5E6F6] md:bg-white/60 rounded-xl">
                                    <i class="fa-solid fa-location-dot text-[#5F5F5F] text-lg sm:text-2xl"></i>
                                </span>
                            <div class="flex flex-col gap-1">
                                <p>
                                    <span class="text-xs text-gray-400 block">Место встречи</span>
                                    {{ $excursion->meeting_point }}
                                </p>
                                <p class="text-sm text-[#4e4e52]">{{ $excursion->meeting_address }}</p>
                            </div>
                        </div>
                    </div>
                    @if($excursion->distance)
                        <div class="flex items-center gap-3">
                                <span class="size-10 sm:size-12 flex justify-center items-center bg-[#E5E6F6] md:bg-white/60 rounded-xl">
                                    <i class="fas fa-ruler text-[#5F5F5F] text-lg sm:text-2xl"></i>
                                </span>
                            <div>
                                <span class="text-xs text-gray-400 block">Дистанция (км)</span>
                                <span class="font-medium">
                                        {{$excursion->distance}}
                                        </span>
                            </div>
                        </div>
                    @endif
                    @if($excursion->duration)
                        <div class="flex items-center gap-3">
                                    <span class="size-10 sm:size-12 flex justify-center items-center bg-[#E5E6F6] md:bg-white/60 rounded-xl">
                                        <i class="fas fa-clock text-[#5F5F5F] text-lg sm:text-2xl"></i>
                                    </span>
                            <div>
                                <span class="text-xs text-gray-400 block">Длительность</span>
                                <span class="font-medium">{{num_word($excursion->getDuration(), ['минута', 'минуты', 'минут'])}}</span>
                            </div>
                        </div>
                    @endif
                    @if($excursion->difficulty)
                        <div class="flex items-center gap-3">
                                <span class="size-10 sm:size-12 flex justify-center items-center bg-[#E5E6F6] md:bg-white/60 rounded-xl">
                                    <i class="fas fa-chart-simple text-[#5F5F5F] text-lg sm:text-2xl"></i>
                                </span>
                            <div>
                                <span class="text-xs text-gray-400 block">Сложность</span>
                                <span class="font-medium">
                                    {{$excursion->difficulty}}
                                    </span>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    @if(isset($nearbyLatitude) && isset($nearbyLongitude))
        @livewire('attraction-component', [
            'latitude' => $nearbyLatitude,
            'longitude' => $nearbyLongitude,
        ])
    @endif
</div>
