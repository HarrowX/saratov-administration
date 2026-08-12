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

    <x-map-modal />

    <section id="home" class="relative mt-25 md:mt-35 xl:mt-40 3xl:mt-50">
        <div class="max-w-6xl xl:max-w-7xl 3xl:max-w-398.25 px-4 sm:px-20 mx-auto relative">

            <a href="{{ route('all-restaurants') }}"
               class="absolute left-3 md:left-8 top-0 md:-top-10 3xl:-top-15 flex items-center xl:gap-2 text-[#5F5F5F] hover:text-blue-800 transition-colors font-['FindSansPro']">
                <i class="fa-solid fa-chevron-left text-base xs:text-xl xl:text-xl 3xl:text-3xl"></i>
                <span class="text-base xs:text-xl 3xl:text-3xl md:pl-4">Заведения</span>
            </a>

            <button wire:click="toggleFavorite" class="flex absolute right-3 sm:right-10 top-0 md:-top-10 3xl:-top-15 xl:right-20 z-20 items-center gap-1 sm:gap-3 px-3 sm:px-5 py-1.5 lg:py-3 rounded-full bg-black/20 backdrop-blur-sm border border-white/20 text-white hover:border-red-400/50 hover:text-red-400 transition-all duration-300 font-['FindSansPro'] group">
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
    <!--Hero Section-->
    <section class="features-section pt-15 bg-white">
        <div class="max-w-3xl lg:max-w-5xl xl:max-w-7xl 3xl:max-w-398.25 mx-auto px-5 sm:px-10">
            <div class="flex flex-col-reverse lg:flex-row items-center gap-4 3xl:gap-22.5">
                <div class="grid grid-cols-3 gap-1 sm:gap-5 w-full lg:w-auto lg:min-w-118 xl:min-w-150 3xl:min-w-197">
                    <div class="min-w-full col-span-3">
                        <img src="{{ $restaurant->attachments?->get(0)?->url() ?? "" }}" alt="Изображение {{ $restaurant->name }}" class="photo w-full rounded-md sm:rounded-lg lg:rounded-2xl object-cover h-full max-h-114">
                    </div>

                        @foreach ($restaurant->attachments as $attachment)
                            @if ($loop->first)
                                @continue
                            @endif
                            <img src="{{ $attachment?->url() ?? "" }}" class="photo w-full h-33 3xl:h-67 rounded-md sm:rounded-lg lg:rounded-2xl object-cover col-span-1" alt="Изображение {{ $restaurant->name }}">
                        @endforeach
                </div>

                <div class="w-full lg:w-auto">
                    <h2 class="text-center lg:pb-10">{{ $restaurant->name }}</h2>
                    <p class="text-base xl:text-xl 3xl:text-3xl">{{ $restaurant->description }}</p>
                </div>
            </div>
        </div>
    </section>

    <section class="pt-5 sm:pt-10 bg-white">
        <div class="max-w-3xl lg:max-w-5xl xl:max-w-7xl 3xl:max-w-398.25 mx-auto px-5 sm:px-10 flex flex-col gap-5 md:gap-12">
            <div class="flex flex-col md:flex-row gap-2.5 lg:gap-10 3xl:gap-33.5">
                <div class="flex flex-col w-full justify-around bg-[#E5E6F6] gap-3 xl:gap-6.75 px-6 lg:px-11 py-6 3xl:py-8 rounded-[20px] font-['FindSansPro'] text-sm sm:text-lg 3xl:text-2xl">
                    <div class="flex items-center gap-2 sm:gap-4">
                        <div class="flex flex-wrap content-center size-5 xl:size-7.5">
                            <i class="fa-solid fa-location-dot"></i>
                        </div>
                        <p>{{ $restaurant->address }}</p>
                    </div>
                    @if(!empty($restaurant->worktime))
                        <div class="flex items-start gap-2 sm:gap-4">
                            <div class="flex flex-wrap content-center size-5 xl:size-7.5">
                                <i class=" fa-solid fa-clock"></i>
                            </div>
                            <div class="flex flex-col gap-2">
                                @foreach($restaurant->worktime as $day => $time)
                                    <p>{{ $day }}: {{ $time }}</p>
                                @endforeach
                            </div>
                        </div>
                    @endif
                    @php
                        $phones = explode(', ', $restaurant->phone);

                    @endphp
                    @if(!empty($phones))
                        @foreach($phones as $phone)
                            <a href="tel:{{ $phone }}" class="flex items-center gap-2 sm:gap-4 w-fit hover:text-green-500 transition-color duration-300">
                                <div class="flex flex-wrap content-center size-5 xl:size-7.5">
                                    <i class="fa fa-phone"></i>
                                </div>
                                <p>{{ $phone }}</p>
                            </a>
                        @endforeach
                    @endif
                    @if($restaurant->email)
                        <a href="mailto:{{ $restaurant->email }}" class="flex items-center gap-2 sm:gap-4 w-fit hover:text-green-500 transition-color duration-300">
                            <div class="flex flex-wrap content-center size-5 xl:size-7.5">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <p class="break-all">{{ $restaurant->email }}</p>
                        </a>
                    @endif
                    @if($restaurant->website)
                        <a href="{{ $restaurant->website }}" target="_blank" class="flex items-center gap-1 sm:gap-3 w-fit hover:text-green-500 transition-color duration-300">
                            <div class="flex flex-wrap content-center size-5 xl:size-7.5">
                                <i class="fas fa-globe"></i>
                            </div>
                            Перейти на сайт
                        </a>
                    @endif
                </div>
                <div class="w-full flex flex-col gap-2.5">
                    <div class="bg-[#E5E6F6] px-6 md:px-11 py-3 rounded-[20px] font-['FindSansPro'] text-xs md:text-lg 3xl:text-2xl">
                        <h3>Кухня</h3>
                        <p class="text-[#5F5F5F]">{{ $restaurant->kitchen }}</p>
                    </div>

                    <button onclick="document.getElementById('map-modal').classList.remove(['hidden'])" class="w-full bg-linear-to-r from-green-500 to-teal-600 text-white py-3 2xl:py-6 rounded-[20px] hover:shadow-lg transition cursor-pointer font-['FindSansPro'] text-lg lg:text-xl 3xl:text-3xl">
                        Показать на карте
                    </button>

                </div>
            </div>
{{--            <div class="font-['FindSansPro'] flex flex-col items-center lg:items-start">--}}
{{--                <h3>Достижения</h3>--}}
{{--                <p class="text-lg md:text-2xl text-center lg:text-left">За посещение ресторана “{{ $restaurant->name }}” вы получите:</p>--}}
{{--                <div class="flex flex-row flex-wrap gap-4 lg:gap-10 justify-center lg:justify-start items-center text-sm pt-4 lg:pt-5 3xl:pt-7 md:text-xl">--}}
{{--                    <div class="text-white rounded-4xl bg-linear-to-r from-green-500 to-teal-600 py-3 sm:py-4.5 px-8 sm:px-15">+1 к “Знатоку города” </div>--}}
{{--                    <div class="gradient-button text-white rounded-4xl py-3 sm:py-4.5 px-8 sm:px-15">+1 к “Первооткрывателю” </div></div>--}}
{{--            </div>--}}
        </div>
    </section>

    @livewire('attraction-component', ['latitude' => $restaurant->latitude, 'longitude' => $restaurant->longitude])

    @if(!is_null($restaurant->yandex_review_widget) && ($restaurant->yandex_review_widget != ""))
        <section class="py-10 xl:py-26 bg-white max-w-3xl lg:max-w-5xl xl:max-w-7xl 3xl:max-w-398.25 mx-auto  px-5 xl:px-20">
            <div data-aos="fade-right" class="text-center font-['FindSansPro'] w-full flex flex-col items-center">
                <h3>Отзывы на Яндекс Картах</h3>
                <div>{!! $restaurant->yandex_review_widget !!}</div>
            </div>
        </section>
    @endif
</div>
