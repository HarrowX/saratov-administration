@section('title')
    Саратов 435 - Модерн в Саратове
@endsection
<div>

    <section id="home" class="relative mt-25 md:mt-35 xl:mt-40 3xl:mt-50 ">
        <div class="max-w-6xl xl:max-w-7xl 3xl:max-w-398.25 px-4 sm:px-20 mx-auto relative">
            <div class="relative overflow-hidden rounded-lg sm:rounded-2xl md:rounded-[30px] h-54 md:h-100 xl:h-125 3xl:h-200">
                <div class="absolute inset-0 bg-cover bg-center bg-no-repeat"
                     style="background-image: url('{{ $excursion->attachments->get(0)?->url() ?? "" }}')">
                </div>
                <div class="absolute inset-x-0 bottom-0 h-40 sm:h-60 md:h-100 bg-linear-to-t from-black via-black/30 3xl:via-black/50 to-transparent"></div>
                <div class="absolute w-full h-full flex justify-center items-end">
                    <h1 class="text-base xs:text-xl sm:text-2xl md:text-4xl 3xl:text-6xl text-white font-extrabold pb-4 md:pb-8 lg:pb-15">{{$excursion->name}}</h1>
                </div>
            </div>

            <a href="{{ route('all-excursions') }}"
               class="absolute left-14 -top-10 3xl:-top-15 hidden md:flex items-center xl:gap-2 text-[#5F5F5F] hover:text-blue-900 transition-colors font-['FindSansPro']">
                <i class="fa-solid fa-chevron-left text-xl xl:text-xl 3xl:text-3xl"></i>
                <span class="text-xl 3xl:text-3xl pl-4">Экскурсии</span>
            </a>

{{--            <button class="absolute top-5 md:top-10 right-26 md:right-28 xl:top-15 flex items-center text-white transition-colors font-['FindSansPro'] bg-[#A855F7] rounded-lg px-4 py-4 cursor-pointer">--}}
{{--                <i class="fa-sharp fa-solid fa-heart text-base sm:text-xl lg:text-2xl xl:text-4xl"></i>--}}
{{--                <span class="text-xs sm:text-sm lg:text-base xl:text-xl pl-4 text-nowrap">Добавить в избранное</span>--}}
{{--            </button>--}}
        </div>
    </section>

    <section class="features-section pt-8 md:pt-10 xl:pt-15 2xl:pt-26 pb-4 sm:pb-10 lg:pb-20 2xl:pb-26 3xl:pb-36 bg-white">
        <div class="max-w-6xl xl:max-w-7xl 3xl:max-w-398.25 px-4 sm:px-20 mx-auto">
            <div class="flex flex-col lg:flex-row items-center justify-between gap-5 xl:gap-11">
                <div data-aos="fade-right" class="max-w-full lg:max-w-120 xl:max-w-150 3xl:max-w-206 lg:w-auto">
                    <p class="text-base lg:text-lg/relaxed xl:text-2xl 3xl:text-3xl/relaxed">
                        {{$excursion->description}}
                    </p>
                </div>
                <div data-aos="fade-left" class="flex flex-col gap-7 w-full lg:w-auto">
                    <div class="flex flex-col w-full justify-around bg-[#E5E6F6] gap-3 md:gap-6.75 px-6 xl:px-11 py-8 rounded-[20px] font-['FindSansPro'] text-sm sm:text-base xl:text-xl 3xl:text-2xl">
                        <div class="flex items-center gap-2 xl:gap-5">
                            <img class="size-4 sm:size-6 xl:size-7.5 icon" src="/images/значок локации.svg">
                            <p>{{ $excursion->meeting_point }}</p>
                        </div>
                        <div class="flex items-center gap-2 xl:gap-5">
                            <img class="size-4 sm:size-6 xl:size-7.5 icon" src="/images/значок локации.svg">
                            <p>{{ $excursion->meeting_address }}</p>
                        </div>
                        <div class="flex items-center gap-2 xl:gap-5">
                            <img class="size-4 sm:size-6 xl:size-7.5 icon" src="/images/image 15.svg">
                            <p>{{ $excursion->operator_phone }}</p>
                        </div>
                        <div class="flex items-center gap-2 xl:gap-5">
                            <img class="size-4 sm:size-6 xl:size-7.5 icon" src="/images/image 8.svg">
                            <p>{{ $excursion->duration }} минут</p>
                        </div>
                        <div class="flex items-center gap-2 xl:gap-5">
                            <img class="size-4 sm:size-6 xl:size-7.5 icon" src="/images/image 17.svg">
                            <p>{{ $excursion->type }}</p>
                        </div>
                    </div>
                    <button class="w-full bg-linear-to-r from-green-500 to-teal-600 text-white py-3 2xl:py-6 rounded-[20px] 2xl:rounded-[30px] hover:shadow-lg transition cursor-pointer font-['FindSansPro'] text-lg sm:text-xl 3xl:text-3xl">Показать на карте</button>
                </div>
            </div>
        </div>
    </section>

    <!--Places Section-->
    <section class="sm:py-2 md:py-15 3xl:py-25 md:bg-[#E5E6F6]">
        <div class="flex flex-col gap-5 md:gap-4 lg:flex-row max-w-6xl xl:max-w-7xl 3xl:max-w-398.25 px-4 sm:px-20 mx-auto">
            <div class="flex flex-col items-center md:items-start justify-between font-['FindSansPro']">
                <h2>Места, которые  вы посетите</h2>
                <div class="flex flex-col items-center md:items-start justify-center gap-3 3xl:gap-6 text-base xl:text-xl 3xl:text-2xl">
                    @foreach($excursion->points as $point)
                        <div class="flex items-center">
                            <img class="icon max-w-3 max-h-3 lg:max-w-5 lg:max-h-7 2xl:max-w-[26px] 2xl:max-h-[31px] mr-2.5 lg:mr-6" src="/images/значок локации.svg">
                            <p>{{ $point->pointable?->name ?? 'Без названия' }}</p>
                        </div>
                    @endforeach
                </div>
                <a href="" class="w-full bg-linear-to-r from-purple-500 to-blue-600 text-white px-4 rounded-[30px] hover:shadow-lg transition text-center cursor-pointer mt-7 py-4 max-w-full md:max-w-[585px]">
                    <div class="text-[16px] lg:text-[18px] xl:text-xl 3xl:text-2xl">Задать вопрос AI Ассистенту Саре</div>
                </a>
            </div>
            <div class="job-swiper__swiper swiper mx-auto max-w-full lg:max-w-100 xl:max-w-150 3xl:max-w-200 h-80 lg:h-100 3xl:h-129.5 relative rounded-xl">
                <div class="swiper-wrapper">
                    @foreach($excursion->attachments as $attachment)
                        <div class="swiper-slide flex! justify-center items-center">
                            <img src="{{ $attachment->url() }}" class="w-full h-full photo object-cover ">
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
        </div>
    </section>

<!--Achievements Section-->
    <section class="features-section pt-6 md:pt-10 xl:pt-15 2xl:pt-25 bg-white">
        <div class="max-w-6xl xl:max-w-7xl 3xl:max-w-398.25 px-4 sm:px-20 mx-auto flex flex-col gap-12">
            <div data-aos="fade-right" class="font-['FindSansPro'] flex flex-col items-center lg:items-start">
                <h3>Достижения</h3>
                <p class="text-lg md:text-2xl text-center lg:text-left">За прохождение “{{$excursion->name}}” вы получите:</p>
                <div class="flex flex-row flex-wrap gap-4 lg:gap-10 justify-center lg:justify-start items-center text-sm pt-4 lg:pt-5 3xl:pt-7 md:text-xl">
                    <div class="text-white rounded-4xl bg-linear-to-r from-green-500 to-teal-600 py-3 sm:py-4.5 px-8 sm:px-15">+1 к “Исследователю”</div>
                    <div class="gradient-button text-white rounded-4xl py-3 sm:py-4.5 px-8 sm:px-15">+1 к “Первооткрывателю” </div>
                    <a href="#" class="text-[#636363]"> перейти к другим квестам и достижениям ></a>
                </div>
            </div>
        </div>
    </section>
    @if(isset($nearbyLatitude) && isset($nearbyLongitude))
        @livewire('attraction-component', [
            'latitude' => $nearbyLatitude,
            'longitude' => $nearbyLongitude
        ])
    @endif
</div>
