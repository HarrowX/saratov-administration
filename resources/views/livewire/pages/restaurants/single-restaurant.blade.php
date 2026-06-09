@section('title')
    Саратов 435 - {{ $restaurant->name }}
@endsection

<div>
    <!--Hero Section-->
    <section class="features-section pt-28 md:pt-30 lg:pt-41.5 bg-white">
        <div class="max-w-3xl lg:max-w-5xl xl:max-w-7xl 3xl:max-w-398.25 mx-auto px-5 sm:px-10">
            <div class="flex flex-col-reverse lg:flex-row items-center gap-5 sm:gap-10 3xl:gap-22.5">
                <div data-aos="fade-right" class="flex flex-col gap-5 w-full lg:w-auto lg:min-w-118 xl:min-w-150 3xl:min-w-197">
                    <div class="min-w-full">
                        <img src="{{ $restaurant->attachments?->get(0)?->url() ?? "" }}" class="photo w-full rounded-md sm:rounded-lg lg:rounded-2xl object-cover h-57.5 lg:h-100 xl:h-114">
                    </div>

                    <div class="flex flex-row gap-5">
                        @foreach ($restaurant->attachments as $attachment)
                            @if ($loop->first)
                                @continue
                            @endif
                            <img src="{{ $attachment?->url() ?? "" }}" class="photo w-full h-33 3xl:h-67 rounded-md sm:rounded-lg lg:rounded-2xl object-cover">
                        @endforeach
                    </div>
                </div>

                <div data-aos="fade-left" class="w-full lg:w-auto">
                    <h2 class="text-center lg:pb-10">{{ $restaurant->name }}</h2>
                    <p class="text-base xl:text-xl 3xl:text-3xl">{{ $restaurant->description }}</p>
                </div>
            </div>
        </div>
    </section>

    <section class="pt-5 sm:pt-10 bg-white">
        <div class="max-w-3xl lg:max-w-5xl xl:max-w-7xl 3xl:max-w-398.25 mx-auto px-5 sm:px-10 flex flex-col gap-5 md:gap-12">
            <div class="flex flex-col md:flex-row gap-2.5 md:gap-10 3xl:gap-33.5">
                <div class="flex flex-col w-full justify-around bg-[#E5E6F6] gap-3 md:gap-6.75 px-6 md:px-11 py-6 3xl:py-8 rounded-[20px] font-['FindSansPro'] text-sm sm:text-lg 3xl:text-2xl">
                    <div class="flex items-center gap-5">
                        <img class="size-4 sm:size-6 md:size-7.5 icon" src="/images/значок локации.svg">
                        <p>{{ $restaurant->address }}</p>
                    </div>
                    <div class="flex items-center gap-3 xl:gap-5">
                        <i class="fa-solid fa-globe text-blue sm:text-2xl md:text-3xl"></i>
                        <p>{{ $restaurant->website}}</p>
                    </div>
                    <div class="flex items-start gap-2 md:gap-5">
                        <img class="size-4 sm:size-6 md:size-7.5 icon" src="/images/image 8.svg">
                        <div class="flex flex-col gap-2">
                            @forelse($restaurant->worktime ?? [] as $day => $time)
                                <p>{{ $day }}: {{ $time }}</p>
                            @empty
                                <p>Не указано</p>
                            @endforelse
                        </div>
                    </div>
                    <div class="flex items-center gap-5">
                        <img class="size-4 sm:size-6 md:size-7.5 icon" src="/images/image 15.svg">
                        <p>{{ $restaurant->phone }}</p>
                    </div>
                </div>
                <div class="w-full flex flex-col gap-2.5">
                    <div class="bg-[#E5E6F6] px-6 md:px-11 py-3 rounded-[20px] font-['FindSansPro'] text-xs md:text-lg 3xl:text-2xl">
                        <h3>Кухня</h3>
                        <p class="text-[#5F5F5F]">{{ $restaurant->kitchen }}</p>
                    </div>
                    <button class="w-full bg-linear-to-r from-green-500 to-teal-600 text-white py-5 md:py-6 rounded-[20px] lg:rounded-[30px] hover:shadow-lg transition cursor-pointer font-['FindSansPro'] text-lg sm:text-xl 3xl:text-3xl">Показать на карте</button>
                </div>
            </div>
            <div class="font-['FindSansPro'] flex flex-col items-center lg:items-start">
                <h3>Достижения</h3>
                <p class="text-lg md:text-2xl text-center lg:text-left">За посещение ресторана “{{ $restaurant->name }}” вы получите:</p>
                <div class="flex flex-row flex-wrap gap-4 lg:gap-10 justify-center lg:justify-start items-center text-sm pt-4 lg:pt-5 3xl:pt-7 md:text-xl">
                    <div class="text-white rounded-4xl bg-linear-to-r from-green-500 to-teal-600 py-3 sm:py-4.5 px-8 sm:px-15">+1 к “Знатоку города” </div>
                    <div class="gradient-button text-white rounded-4xl py-3 sm:py-4.5 px-8 sm:px-15">+1 к “Первооткрывателю” </div>
                    <a href="#" class="text-[#636363]">перейти к другим квестам и достижениям ></a>
                </div>
            </div>
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
