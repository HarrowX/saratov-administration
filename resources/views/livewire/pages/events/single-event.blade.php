@section('title')
    Саратов 435 - {{ $event->name }}
@endsection



<div>
    <script>
        window.mapData = {
            attractions: @js($event->eventable_type == \App\Models\Attraction::class ? [$event->eventable] : null),
            hotels: @js($event->eventable_type == \App\Models\Hotel::class ? [$event->eventable] : null),
            restaurants: @js($event->eventable_type == \App\Models\Restaurant::class ? [$event->eventable] : null),
        };
        window.mapCenter = @js([$event?->eventable?->latitude , $event?->eventable?->longitude]);
    </script>

    <section class="pt-25 3xl:pt-30 flex flex-col gap-5 bg-white">
        <div class="max-w-6xl 3xl:max-w-7xl mx-auto px-4 sm:px-10 flex flex-row justify-between items-start w-full">
            <a href="{{ route('all-events') }}"
               class="flex items-center xl:gap-2 text-[#5F5F5F] hover:text-blue-800 transition-colors font-['FindSansPro']">
                <i class="fa-solid fa-chevron-left text-base xs:text-xl xl:text-xl 3xl:text-3xl"></i>
                <span class="text-base xs:text-xl 3xl:text-3xl md:pl-4">События</span>
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
                <x-gallery :attachable="$event">
                    <div class="absolute z-10 bottom-0 left-0 right-0 p-4 sm:p-6 lg:p-8 rounded-b-3xl cursor-pointer select-none" onclick="openGallery()">
                        <h1 class="text-3xl lg:text-4xl 3xl:text-5xl font-bold text-white drop-shadow-lg">
                            {{ $event->name }}
                        </h1>
                        <div class="flex flex-col justify-end h-full md:h-screen w-full z-10 text-white">
                            <h1 class="text-3xl xl:text-4xl 2xl:text-5xl font-extrabold leading-16 2xl:leading-24">{{$event->name}}</h1>
                            <div class="flex flex-row gap-2 items-center rounded-xl xl:pb-10 text-black">
                                @if($event->categories && $event->categories->count() > 0)
                                    <div class="flex flex-wrap items-center gap-2">
                                        @foreach($event->categories as $category)
                                            <span class="inline-flex items-center py-1 sm:py-2 px-3 sm:px-3 2xl:px-6 border border-[rgba(197,139,255,0.72)] rounded-full bg-[rgba(22,18,30,0.38)] text-white text-xs sm:text-sm 2xl:text-2xl font-medium leading-none shadow-none backdrop-blur-[6px]">
                                        {{ $category->name }}
                                </span>
                                        @endforeach
                                    </div>
                                @endif
                                @if($event->age_restriction)
                                    <span class="inline-flex items-center py-1 sm:py-2 px-3 sm:px-3 2xl:px-6 border border-[rgba(197,139,255,0.72)] rounded-full bg-[rgba(109,67,193,0.38)] text-white text-xs sm:text-sm 2xl:text-2xl font-medium leading-none shadow-none backdrop-blur-[6px]">
                            {{ $event->age_restriction }}+
                        </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </x-gallery>
            </div>
        </div>
    </section>

    <section class="pt-10 xl:pt-16 pb-10 bg-white">
        <div class="max-w-6xl 3xl:max-w-7xl mx-auto px-4 sm:px-10 flex flex-col gap-10 box-border relative">
            <div class="bg-[#E5E6F6] rounded-xl sm:rounded-3xl p-3 sm:p-6 md:p-8">
                <h2>О месте</h2>
                <p class="text-base md:text-lg text-[#5F5F5F] leading-relaxed">{{ $event->description }}</p>
                <div class="flex flex-col lg:flex-row gap-5 pt-3 min-w-fit border-t-2 border-gray-300">
                    <div class="flex items-center gap-3">
                            <span class="size-10 sm:size-12 flex justify-center items-center bg-white/60 rounded-xl">
                                <i class="fas fa-calendar text-[#5F5F5F] text-lg sm:text-2xl"></i>
                            </span>
                        <div>
                            <span class="text-xs text-gray-400 block">Дата</span>
                            <span class="font-medium">                                {{ $event->start_date->translatedFormat('j F, H:i')}}
                                @if($event->end_date)
                                    - {{ $event->end_date->translatedFormat('j F, H:i')}}
                                @endif
                                </span>
                        </div>
                    </div>
                </div>
            </div>
            @if($event->organizer_name || $event->organizer_phone || $event->organizer_email || $event->organizer_website)
                <div class="flex flex-col gap-4 min-h-full w-full min-w-fit bg-white/60 rounded-xl p-3 sm:p-5">
                    <p class="text-base font-semibold text-gray-800 text-center font-['Merriweather']">Организатор</p>
                    @if($event->organizer_name)
                        <div class="flex items-center gap-3 p-2">
                                <span class="size-10 flex justify-center items-center bg-[#E5E6F6] rounded-lg">
                                    <i class="fas fa-museum text-[#5F5F5F] text-base sm:text-xl"></i>
                                </span>
                            <div>
                                    <span class="font-medium">
                                        {{$event->organizer_name}}
                                    </span>
                            </div>
                        </div>
                    @endif
                    @if($event->organizer_website)
                        <div class="group/site flex items-center gap-3 p-2 rounded-xl hover:bg-white/40 transition-all duration-300">
                                <span class="size-10 flex justify-center items-center bg-[#E5E6F6] rounded-lg group-hover:scale-110 transition-transform duration-300 relative overflow-hidden">
                                    <i class="fa-solid fa-hand-pointer transition-transform duration-300 rotate-30 group-hover/site:rotate-90 text-[#5F5F5F] group-hover/site:text-[#2663EB] text-base sm:text-xl"></i>
                                </span>
                            <div class="flex flex-col items-start justify-center flex-1 min-w-0">
                                <span class="text-xs text-gray-400 font-medium">Сайт</span>
                                <a href="{{ $event->organizer_website }}" target="_blank"
                                   class="flex items-center gap-1.5 hover:text-[#2663EB] transition-all duration-300 group/link">
                                    <p>Перейти на сайт</p>
                                    <i class="fa-solid fa-arrow-up-right-from-square text-[10px] text-gray-400 opacity-0 group-hover/link:opacity-100 transition-all duration-300 group-hover/link:translate-x-0.3 group-hover/link:-translate-y-0.3"></i>
                                </a>
                            </div>
                        </div>
                    @endif
                    <div class="group flex items-center gap-3 p-2 rounded-xl hover:bg-white/40 transition-all duration-300">
                            <span class="size-10 flex justify-center items-center bg-[#E5E6F6] rounded-lg group-hover:scale-110 transition-transform duration-300 relative overflow-hidden">
                                <i class="fas fa-phone absolute transition-all duration-300 group-hover:opacity-0 group-hover:scale-75 text-[#5F5F5F] text-base sm:text-xl group-hover:text-[#2663EB]"></i>
                                <i class="fas fa-phone-volume absolute transition-all duration-500 opacity-0 scale-75 group-hover:opacity-100 group-hover:scale-100 text-[#2663EB] text-base sm:text-xl group-hover:animate-[shake_0.5s_ease-in-out]"></i>
                            </span>
                        <div class="flex flex-col items-start justify-center flex-1 min-w-0">
                            <span class="text-xs text-gray-400 font-medium">Телефон</span>
                            @php
                                $phones = array_map(fn (string $item) => trim($item), explode(',', $event->organizer_phone));
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
                    @if($event->organizer_email)
                        <div class="group/mail flex items-center gap-3 p-2 rounded-xl hover:bg-white/40 transition-all duration-300">
                                <span class="size-10 flex justify-center items-center bg-[#E5E6F6] rounded-lg group-hover:scale-110 transition-transform duration-300 relative overflow-hidden">
                                    <i class="fa-solid fa-envelope absolute transition-all duration-300 group-hover/mail:opacity-0 group-hover/mail:scale-75 text-[#5F5F5F] text-base sm:text-xl group-hover/mail:text-[#2663EB]"></i>
                                    <i class="fa-solid fa-envelope-open absolute transition-all duration-500 opacity-0 scale-75 group-hover/mail:opacity-100 group-hover/mail:scale-100 text-[#2663EB] text-base sm:text-xl group-hover/mail:animate-[shake_0.5s_ease-in-out]"></i>
                                </span>
                            <div class="flex flex-col items-start justify-center flex-1 min-w-0">
                                <span class="text-xs text-gray-400 font-medium">Почта</span>
                                <a href="mailto:{{ $event->organizer_email }}"
                                   class="flex items-center gap-1.5 hover:text-[#2663EB] transition-colors duration-300 group/link">
                                    <p>{{ $event->organizer_email }}</p>
                                </a>
                            </div>
                        </div>
                    @endif

                </div>
            @endif

        </div>
    </section>


    <section class="pt-10 xl:pt-16 mb-10">
        <div class="max-w-6xl 3xl:max-w-7xl mx-auto px-4 sm:px-10">
            <h2>Как добраться</h2>
            <div class="bg-[#E5E6F6] rounded-xl sm:rounded-3xl flex flex-col lg:flex-row">
                <div class="flex flex-col w-full gap-5 p-3 sm:p-6 md:p-8">
                    <div class="flex items-center gap-3">
                        <span class="size-10 sm:size-12 flex justify-center items-center bg-white/60 rounded-xl">
                            <i class="fa-solid fa-location-dot text-[#5F5F5F] text-lg sm:text-2xl"></i>
                        </span>
                        <div>
                            <span class="text-xs text-gray-400 block">Локация</span>
                            <p>{{ $event->eventable->name ?? 'Локация не указана' }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="size-10 sm:size-12 min-w-10 lg:min-w-12 flex justify-center items-center bg-white/60 rounded-xl">
                            <i class="fa-solid fa-location-arrow text-[#5F5F5F] text-lg sm:text-2xl"></i>
                        </span>
                        <div>
                            <span class="text-xs text-gray-400 block">Адрес</span>
                            <p>{{ $event->eventable->address ?? 'Адрес не указан' }}</p>
                        </div>
                    </div>
                </div>
                <div class="restaurant lg:min-w-140 2xl:min-w-180">
                    <div id="map" class="w-full min-h-100 h-full rounded-b-xl lg:rounded-bl-none lg:rounded-r-3xl overflow-hidden border-0 box-shadow-0"></div>
                </div>
            </div>
        </div>
    </section>
</div>
