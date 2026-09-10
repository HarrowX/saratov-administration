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

    <section class="pt-25 3xl:pt-30 flex flex-col gap-5 bg-white">
        <div class="max-w-6xl 3xl:max-w-7xl mx-auto px-4 sm:px-10 flex flex-row justify-between items-start w-full">
            <a href="{{ route('all-excursions') }}"
               class="flex items-center xl:gap-2 text-[#5F5F5F] hover:text-blue-800 transition-colors font-['FindSansPro']">
                <i class="fa-solid fa-chevron-left text-base xs:text-xl xl:text-xl 3xl:text-3xl"></i>
                <span class="text-base xs:text-xl 3xl:text-3xl md:pl-4">Экскурсии</span>
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
        <x-gallery :attachable="$excursion" >
            <div class="absolute z-10 bottom-0 left-0 right-0 p-4 sm:p-6 lg:p-8 rounded-b-3xl cursor-pointer select-none" onclick="openGallery()">
                <h1 class="text-3xl lg:text-4xl 3xl:text-5xl font-bold text-white drop-shadow-lg">
                    {{ $excursion->name }}
                </h1>
            </div>
        </x-gallery>
    </section>

    <section class="pt-10 xl:pt-16 pb-10">
        <div class="max-w-6xl 3xl:max-w-7xl mx-auto px-4 sm:px-10 box-border flex flex-col gap-10">
            <div class="flex flex-col bg-[#E5E6F6] rounded-xl sm:rounded-3xl gap-3 p-3 sm:p-6 md:p-8">
                <div class="flex flex-col lg:flex-row gap-2">
                    <div>
                        <h2>Об экскурсии</h2>
                        <p class="text-base md:text-lg text-[#5F5F5F] leading-relaxed">{{ $excursion->description }}</p>
                    </div>
                    @if(!empty($excursion->price_adult) || !empty($excursion->price_child) || !empty($excursion->price_group))
                        <div class="flex flex-col gap-4 p-3 sm:p-5 min-h-full w-full min-w-fit bg-white/60 rounded-xl">
                            <p class="text-base font-semibold text-gray-800 text-center font-['Merriweather']">Цена билетов</p>
                            <div class="flex flex-col gap-3 text-xs sm:text-sm">
                                @if($excursion->price_adult)
                                    <div class="flex items-center leading-3 gap-1 sm:gap-2">
                                        <span class="text-gray-600 shrink-0">Взрослый</span>
                                        <span class="flex-1 border-b-2 border-dotted border-gray-300 min-w-4 self-end"></span>
                                        <span class="font-medium text-gray-800 shrink-0">{{ number_format($excursion->price_adult, 0, '', ' ') }} ₽</span>
                                    </div>
                                @endif
                                @if($excursion->price_child)
                                    <div class="flex items-center leading-3 gap-1 sm:gap-2">
                                        <span class="text-gray-600 shrink-0">Детский</span>
                                        <span class="flex-1 border-b-2 border-dotted border-gray-300 min-w-4 self-end"></span>
                                        <span class="font-medium text-gray-800 shrink-0">{{ number_format($excursion->price_child, 0, '', ' ') }} ₽</span>
                                    </div>
                                @endif
                                @if($excursion->price_group)
                                    <div class="flex items-center leading-3 gap-1 sm:gap-2">
                                        <span class="text-gray-600 shrink-0">Группа</span>
                                        <span class="flex-1 border-b-2 border-dotted border-gray-300 min-w-4 self-end"></span>
                                        <span class="font-medium text-gray-800 shrink-0">{{ number_format($excursion->price_group, 0, '', ' ') }} ₽</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>
                <div class="flex flex-row flex-wrap lg:flex-nowrap lg:justify-between gap-4 lg:gap-2 pt-2 min-w-fit border-t-2 border-gray-300">
                    <div class="flex items-center gap-3">
                        <span class="size-10 sm:size-12 flex justify-center items-center bg-white/60 rounded-xl">
                            <i class="fa-solid fa-shoe-prints text-[#5F5F5F] text-lg sm:text-2xl -rotate-90"></i>
                        </span>
                        <div>
                            <span class="text-xs text-gray-400 block">Тип</span>
                            <span class="font-medium">{{ $excursion->type }}</span>
                        </div>
                    </div>
                    <a href="{{route('single-guided-tour', $excursion->guide)}}" class="group flex items-center gap-3 hover:bg-white/40 lg:p-2 rounded-xl transition-colors duration-300 cursor-pointer">
                                <span class="size-10 sm:size-12 min-w-10 sm:min-w-12 flex justify-center items-center bg-white/60 rounded-xl shrink-0">
                                    <i class="fa fa-user text-[#5F5F5F] text-lg sm:text-2xl group-hover:text-blue-800 transition-colors duration-300"></i>
                                </span>
                        <div>
                            <span class="text-xs text-gray-400 text-nowrap block">Экскурсовод</span>
                            <span class="font-medium text-blue-800 underline text-nowrap">
                                    {{$excursion->guide->name }}
                                </span>
                        </div>
                    </a>
                    @if($excursion->group_size_min || $excursion->group_size_max)
                        <div class="flex items-center gap-3 lg:p-2">
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
                        <div class="flex items-center gap-3 lg:p-2">
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
