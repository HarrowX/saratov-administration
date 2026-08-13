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

    <x-map-modal />

    <!-- Hero Section -->
    <section id="home" class="relative h-90 md:min-h-screen overflow-hidden rounded-b-xl sm:rounded-b-3xl lg:rounded-b-[50px] mt-20">
        <div class="absolute inset-0">
            <div class="absolute inset-0">
                <img src="{{ $attraction->attachments?->get(0)?->url() ?? "" }}" alt="Изображение">
            </div>

            <div class="absolute inset-x-0 top-0 h-full bg-linear-to-b from-black/70 via-white/50 to-transparent"></div>

            <div class="absolute inset-x-0 bottom-0 h-40 sm:h-60 md:h-100 bg-linear-to-t from-black via-black/50 to-transparent"></div>
        </div>

        <a href="{{ route('all-attractions') }}" class="absolute top-10 left-3 sm:left-10 xl:top-18 xl:left-20 z-20 flex items-center xl:gap-2 text-white hover:text-blue-800 transition-colors font-['FindSansPro']">
            <i class="fa-solid fa-chevron-left text-base xs:text-xl xl:text-xl 3xl:text-3xl"></i>
            <span class="text-base xs:text-xl 2xl:text-3xl md:pl-4">Достопримечательности</span>
        </a>

        <button wire:click="toggleFavorite" class="flex absolute right-3 sm:right-10 top-20 md:top-10 lg:top-16 xl:right-20 z-20 items-center gap-1 sm:gap-3 px-3 sm:px-5 py-1.5 sm:py-3 rounded-full bg-black/20 backdrop-blur-sm border border-white/20 text-white hover:border-red-400/50 hover:text-red-400 transition-all duration-300 font-['FindSansPro'] group">
            <i class="fa-regular fa-heart text-lg sm:text-2xl xl:text-3xl group-hover:scale-110 group-hover:animate-pulse transition-transform {{ $isFavorite ? 'fa-solid text-red-400' : 'fa-regular' }}"></i>
            <span class="text-xs xs:text-sm sm:text-lg 2xl:text-3xl font-medium">
                    {{ $isFavorite ? 'В избранном' : 'В избранное' }}
                </span>
            <span class="favorite-count ml-2 text-xs sm:text-base 2xl:text-xl font-bold flex justify-center items-center min-w-5 h-5 sm:min-w-8 sm:h-8 px-1 sm:px-2 rounded-full {{ $isFavorite ? 'bg-red-400 text-white' : 'bg-red-400/80 text-white' }} transition-colors shadow-lg">
                {{ $favoritesCount }}
                </span>
        </button>

        <div class="absolute h-full pb-8 sm:pb-15 md:pb-0 md:h-screen w-full px-20 flex justify-center items-end md:-top-32 z-10 text-center text-white">
            <h1 class="text-3xl xl:text-6xl font-extrabold">{{$attraction->name}}</h1>
        </div>
    </section>

    <section class="features-section pt-8 md:pt-10 xl:pt-15 2xl:pt-25 bg-white">
        <div class="max-w-3xl lg:max-w-5xl xl:max-w-7xl 3xl:max-w-438.5 mx-auto px-5 xl:px-20 flex flex-col gap-12">
            <div class="flex flex-col-reverse lg:flex-row items-center justify-between gap-7 sm:gap-11">
                <div class="max-w-150 lg:max-w-100 3xl:max-w-206 lg:w-auto">
                    <p class="text-base lg:text-xl/relaxed 3xl:text-3xl/relaxed">{{ $attraction->description }}
                    </p>
                </div>
                <div class="flex flex-col gap-3 3xl:gap-7 w-full lg:w-auto">
                    <div class="flex flex-col w-full justify-around bg-[#E5E6F6] gap-3 md:gap-6.75 px-6 md:px-11 py-8 rounded-[20px] font-['FindSansPro'] text-sm sm:text-lg 3xl:text-2xl">
                        <div class="flex items-center gap-1 sm:gap-3">
                            <div class="flex flex-wrap content-center size-5 xl:size-7.5">
                                <i class="fa-solid fa-location-dot"></i>
                            </div>
                            <p>{{ $attraction->address }}</p>
                        </div>
                        @if(!empty($attraction->worktime))
                            <div class="flex items-start gap-1 sm:gap-3">
                                <div class="flex flex-wrap content-center size-5 xl:size-7.5">
                                    <i class=" fa-solid fa-clock"></i>
                                </div>
                                <div class="flex flex-col gap-2">
                                    @foreach($attraction->worktime as $day => $time)
                                        <p>{{ $day }}: {{ $time }}</p>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        @php
                            $phones = array_map(fn (string $item) => trim($item), explode(',', $attraction->phone));
                        @endphp
                        @if(!empty($phones))
                            @foreach($phones as $phone)
                                <a href="tel:{{ $phone }}" class="flex items-center gap-1 sm:gap-3 w-fit hover:text-green-500 transition-color duration-300">
                                    <div class="flex flex-wrap content-center size-5 xl:size-7.5">
                                        <i class="fa fa-phone"></i>
                                    </div>
                                    <p>{{ $phone }}</p>
                                </a>
                            @endforeach
                        @endif


                        @if($attraction->email)
                            <a href="mailto:{{ $attraction->email}}" class="flex items-center gap-1 sm:gap-3 w-fit hover:text-green-500 transition-color duration-300">
                                <div class="flex flex-wrap content-center size-5 xl:size-7.5">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <p class="break-all">{{ $attraction->email}}</p>
                            </a>
                        @endif
                        @if($attraction->website)
                            <a href="{{$attraction->website}}" class="flex items-center gap-1 sm:gap-3 w-fit hover:text-green-500 transition-color duration-300">
                                <div class="flex flex-wrap content-center size-5 xl:size-7.5">
                                    <i class="fas fa-globe"></i>
                                </div>
                                Перейти на сайт
                            </a>
                        @endif
                    </div>
                    <div class="bg-[#E5E6F6] px-6 md:px-11 py-3 rounded-[20px] font-['FindSansPro'] text-xs md:text-lg 3xl:text-2xl">
                        <h3>Категории</h3>
                        <p class="text-[#5F5F5F]">{{$attraction->short_description}}</p>
                    </div>

                    <button onclick="document.getElementById('map-modal').classList.remove(['hidden'])" class="w-full bg-linear-to-r from-green-500 to-teal-600 text-white py-3 2xl:py-6 rounded-[20px] hover:shadow-lg transition cursor-pointer font-['FindSansPro'] text-lg sm:text-xl 3xl:text-3xl">
                        Показать на карте
                    </button>
                </div>
            </div>
{{--            <div data-aos="fade-right" class="flex flex-col items-center lg:items-start">--}}
{{--                <h2 class="text-2xl md:text-3xl font-bold mb-4">Достижения</h2>--}}
{{--                <p class="text-lg md:text-2xl text-center lg:text-left">За посещение достопримечательности “{{$attraction->name}}” вы получите:</p>--}}
{{--                <div class="flex flex-row flex-wrap gap-4 lg:gap-10 justify-center lg:justify-start items-center text-sm pt-4 lg:pt-5 3xl:pt-7 md:text-xl font-['FindSansPro']">--}}
{{--                    <div class="text-white rounded-4xl bg-linear-to-r from-green-500 to-teal-600 py-3 sm:py-4.5 px-8 sm:px-15">+1 к “Знатоку города” </div>--}}
{{--                    <div class="gradient-button text-white rounded-4xl py-3 sm:py-4.5 px-8 sm:px-15">+1 к “Первооткрывателю” </div>--}}
{{--                </div>--}}
{{--            </div>--}}
        </div>
    </section>

    @livewire('attraction-component', ['latitude' => $attraction->latitude, 'longitude' => $attraction->longitude])

    @if(!is_null($attraction->yandex_review_widget) && ($attraction->yandex_review_widget != ""))
        <section class="py-10 xl:py-26 bg-white max-w-3xl lg:max-w-5xl xl:max-w-7xl 3xl:max-w-398.25 mx-auto  px-5 xl:px-20">
            <div data-aos="fade-right" class="text-center font-['FindSansPro'] w-full flex flex-col items-center">
                <h3>Отзывы на Яндекс Картах</h3>
                <div>{!! $attraction->yandex_review_widget !!}</div>
            </div>
        </section>
    @endif
</div>
