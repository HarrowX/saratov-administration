@section('title')
    Саратов 435 - {{ $hotel->name }}
@endsection

<div>
    <script>
        window.mapData = {
            attractions: [],
            hotels: @js([$hotel]),
            restaurants: [],
        };
        window.mapCenter = @js([$hotel->latitude , $hotel->longitude]);
    </script>

    <x-map-modal />

    <section id="home" class="relative mt-25 md:mt-35 xl:mt-40 3xl:mt-50">
        <div class="max-w-6xl xl:max-w-7xl 3xl:max-w-398.25 px-4 sm:px-20 mx-auto relative">

            <a href="{{ route('all-hotels') }}"
               class="absolute left-3 md:left-8 xl:left-14 top-0 md:-top-10 3xl:-top-15 flex items-center xl:gap-2 text-[#5F5F5F] hover:text-blue-900 transition-colors font-['FindSansPro']">
                <i class="fa-solid fa-chevron-left text-base xs:text-xl xl:text-xl 3xl:text-3xl"></i>
                <span class="text-base xs:text-xl 3xl:text-3xl md:pl-4">Отели</span>
            </a>


            <button wire:click="toggleFavorite" class="flex absolute right-3 sm:right-10 top-0 md:-top-10 3xl:-top-15 xl:right-20 z-20 items-center gap-1 sm:gap-3 px-3 sm:px-5 py-1.5 sm:py-3 rounded-full bg-black/20 backdrop-blur-sm border border-white/20 text-white hover:border-red-400/50 hover:text-red-400 transition-all duration-300 font-['FindSansPro'] group">
                <i class="fa-regular fa-heart text-lg sm:text-2xl xl:text-3xl group-hover:scale-110 group-hover:animate-pulse transition-transform {{ $isFavorite ? 'fa-solid text-red-400' : 'fa-regular' }}"></i>
                <span class="text-xs xs:text-sm sm:text-lg 2xl:text-3xl font-medium">
                    {{ $isFavorite ? 'В избранном' : 'В избранное' }}
                </span>
                <span class="favorite-count ml-2 text-xs sm:text-base 2xl:text-xl font-bold flex justify-center items-center size-5 sm:size-8 rounded-full {{ $isFavorite ? 'bg-red-400 text-white' : 'bg-red-400/80 text-white' }} transition-colors shadow-lg">
                {{ $favoritesCount }}
                </span>
            </button>
        </div>
    </section>
    <!--Hero Section-->
    <section>
        <div class="max-w-6xl 3xl:max-w-421 mx-auto px-4 sm:px-10 pt-30 sm:pt-18 md:pt-10">
            <div class="grid grid-cols-1 md:grid-cols-2 items-center justify-center gap-3 sm:gap-5 lg:gap-8 pb-3 sm:pb-10 lg:pb-15 3xl:pb-20">
                <div class="flex-1 grid grid-cols-2 gap-2 sm:gap-3 3xl:gap-5 w-full">
                    @php
                        $attachments = $hotel->attachments;
                        $count = $attachments->count();
                    @endphp
                    <img src="{{ $hotel->attachments?->get(0)?->url() ?? "" }}" alt="Изображение {{ $hotel->name }}" class="photo object-cover w-full rounded-md sm:rounded-lg lg:rounded-2xl h-full">
                    @if($count >= 2)
                        <img src="{{ $hotel->attachments?->get(1)?->url() ?? "" }}" alt="Изображение {{ $hotel->name }}"
                             class="photo object-cover w-full h-full rounded-md sm:rounded-lg lg:rounded-2xl">
                    @endif
                </div>
                <p class="text-base flex-1 xl:text-lg 2xl:text-xl w-full 3xl:max-w-151.5">
                    {{ $hotel->description }}
                </p>
            </div>
            <h2 class="pb-3 3xl:pb-6 text-center">{{ $hotel->name }}</h2>
            <p class="text-base xl:text-lg 2xl:text-xl w-full lg:order-1">
                {{ $hotel->second_description }}
            </p>
        </div>
    </section>

    <section class="features-section pt-6 md:pt-8 3xl:pt-10 bg-white">
        <div class="max-w-6xl 3xl:max-w-421 mx-auto px-4 sm:px-10 flex flex-col lg:flex-row gap-5">
            <div class="flex-1 grid grid-cols-2 gap-2 sm:gap-3 3xl:gap-5 w-full lg:order-2">
                @php
                    $attachments = $hotel->attachments;
                    $count = $attachments->count();
                @endphp
                <div class="col-span-2">
                    @if($count >= 3)
                        <img src="{{ $hotel->attachments?->get(2)?->url() ?? "" }}" alt="Изображение {{ $hotel->name }}"
                             class="photo object-cover w-full h-ful max-h-100 rounded-md sm:rounded-lg lg:rounded-2xl">
                    @endif
                </div>
                @if($count >= 4)
                    <img src="{{ $hotel->attachments?->get(3)?->url() ?? "" }}" alt="Изображение {{ $hotel->name }}"
                         class="photo w-full h-full object-cover rounded-md sm:rounded-lg lg:rounded-2xl">
                @endif
                @if($count >= 5)
                    <img src="{{ $hotel->attachments?->get(4)?->url() ?? "" }}" alt="Изображение {{ $hotel->name }}"
                         class="photo w-full h-full object-cover rounded-md sm:rounded-lg lg:rounded-2xl">
                @endif
            </div>
            <div class="flex-1 flex flex-col md:flex-row items-center justify-between gap-5 lg:gap-10 xl:gap-13.5">
                <div class="flex flex-col gap-2 lg:gap-7 w-full">
                    <div class="flex flex-col w-full justify-around bg-[#E5E6F6] gap-3 md:gap-6.75 px-6 xl:px-7 3xl:px-11 py-6 lg:py-8 rounded-[20px] font-['FindSansPro'] text-sm sm:text-lg xl:text-2xl">
                        <div class="flex items-center gap-1 sm:gap-3">
                            <div class="flex flex-wrap content-center size-5 xl:size-7.5">
                                <i class="fa fa-home"></i>
                            </div>
                            <p>{{ $hotel->type}}</p>
                        </div>
                        <div class="flex items-center gap-1 sm:gap-3">
                            <div class="flex flex-wrap content-center size-5 xl:size-7.5">
                                <i class="fa-solid fa-location-dot"></i>
                            </div>
                            <p>{{ $hotel->address }}</p>
                        </div>
                        @if(!empty($hotel->worktime))
                            <div class="flex items-start gap-1 sm:gap-3">
                                <div class="flex flex-wrap content-center size-5 xl:size-7.5">
                                    <i class=" fa-solid fa-clock"></i>
                                </div>
                                <div class="flex flex-col gap-2">
                                    @foreach($hotel->worktime as $day => $time)
                                        <p>{{ $day }}: {{ $time }}</p>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                        @if($hotel->phone)
                            <a href="tel:{{ $hotel->phone }}" class="flex items-center gap-1 sm:gap-3 w-fit hover:text-green-500 transition-color duration-300">
                                <div class="flex flex-wrap content-center size-5 xl:size-7.5">
                                    <i class="fa fa-phone"></i>
                                </div>
                                <p>{{ $hotel->phone }}</p>
                            </a>
                        @endif

                        @if($hotel->email)
                            <a href="mailto:{{ $hotel->email }}" class="flex items-center gap-1 sm:gap-3 w-fit hover:text-green-500 transition-color duration-300">
                                <div class="flex flex-wrap content-center size-5 xl:size-7.5">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <p class="break-all">{{ $hotel->email }}</p>
                            </a>
                        @endif

                        @if($hotel->website)
                            <a href="{{ $hotel->website }}" target="_blank" class="flex items-center gap-1 sm:gap-3 w-fit hover:text-green-500 transition-color duration-300">
                                <div class="flex flex-wrap content-center size-5 xl:size-7.5">
                                    <i class="fas fa-globe"></i>
                                </div>
                                Перейти на сайт
                            </a>
                        @endif
                    </div>
                    <button onclick="document.getElementById('map-modal').classList.remove(['hidden'])" class="font-['FindSansPro'] flex justify-center w-full bg-linear-to-r from-green-500 to-teal-600 text-white py-3 xl:py-6 rounded-[20px] hover:shadow-lg transition cursor-pointer text-lg sm:text-lg xl:text-xl 3xl:text-3xl">
                        Показать на карте
                    </button>
                </div>
{{--                <div data-aos="fade-right" class="font-['FindSansPro'] flex flex-col-reverse md:flex-col gap-5 md:gap-0 w-full md:w-auto">--}}
{{--                    <div>--}}
{{--                        <h3 class="text-center md:text-left pb-2 md:pb-0">Достижения</h3>--}}
{{--                        <p class="text-base xl:text-lg 3xl:text-2xl lg:text-nowrap">За прохождение “{{$hotel->name}}” вы получите:</p>--}}
{{--                        <div class="flex flex-row md:flex-col flex-wrap gap-2 lg:gap-4 justify-between md:justify-start items-center md:items-start pt-4 lg:pt-5 3xl:pt-7 text-[9px] sm:text-[13px] lg:text-base xl:text-lg 3xl:text-xl">--}}
{{--                            <div class="text-white rounded-4xl gradient-button py-3 lg:py-4.5 px-8 lg:px-15">+1 к “Исследователю”</div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <button onclick="document.getElementById('map-modal').classList.remove(['hidden'])" class="font-['FindSansPro'] flex justify-center w-full bg-linear-to-r from-green-500 to-teal-600 text-white py-3 xl:py-6 rounded-[30px] hover:shadow-lg transition cursor-pointer text-lg sm:text-lg xl:text-xl 3xl:text-3xl md:mt-4">--}}
{{--                        Показать на карте--}}
{{--                    </button>--}}
{{--                </div>--}}
            </div>
        </div>
    </section>

    @livewire('attraction-component', ['latitude' => $hotel->latitude, 'longitude' => $hotel->longitude])

    @if(!is_null($hotel->yandex_review_widget) && ($hotel?->yandex_review_widget != ""))
        <section class="py-10 xl:py-26 bg-white max-w-3xl lg:max-w-5xl xl:max-w-7xl 3xl:max-w-398.25 mx-auto  px-5 xl:px-20">
            <div data-aos="fade-right" class="text-center font-['FindSansPro'] w-full flex flex-col items-center">
                <h3>Отзывы на Яндекс Картах</h3>
                <div>{!! $hotel->yandex_review_widget !!}</div>
            </div>
        </section>
    @endif
</div>
