@section('title')
    Саратов 435 - {{ $attraction->name }}
@endsection

<div>
    <!-- Hero Section -->
    <section id="home" class="relative h-68.5 md:min-h-screen overflow-hidden rounded-b-xl sm:rounded-b-3xl lg:rounded-b-[50px] mt-20">
        <div class="absolute inset-0">
            <div class="absolute inset-0">
                <img src="{{ $attraction->attachments?->get(0)?->url() ?? "" }}" alt="Изображение">
            </div>

            <div class="absolute inset-x-0 top-0 h-full bg-linear-to-b from-black/70 via-white/50 to-transparent"></div>

            <div class="absolute inset-x-0 bottom-0 h-40 sm:h-60 md:h-100 bg-linear-to-t from-black via-black/50 to-transparent"></div>
        </div>

        <a href="{{ route('all-attractions') }}" class="absolute top-10 left-10 xl:top-18 xl:left-20 z-20 hidden md:flex items-center gap-2 text-white hover:text-blue-300 transition-colors font-['FindSansPro']">
            <i class="fa-solid fa-chevron-left text-xl xl:text-3xl"></i>
            <span class="text-xl xl:text-3xl pl-4">Достопримечательности</span>
        </a>

        <div class="absolute h-full pb-8 sm:pb-15 md:pb-0 md:h-screen w-full px-20 flex justify-center items-end md:-top-32 z-10 text-center text-white">
            <h1 class="text-3xl xl:text-6xl font-extrabold">{{$attraction->name}}</h1>
        </div>
    </section>

    <section class="features-section pt-8 md:pt-10 xl:pt-15 2xl:pt-25 bg-white">
        <div class="max-w-3xl lg:max-w-5xl xl:max-w-7xl 3xl:max-w-438.5 mx-auto px-5 xl:px-20 flex flex-col gap-12">
            <div class="flex flex-col-reverse lg:flex-row items-center justify-between gap-11">
                <div data-aos="fade-right" class="max-w-150 3xl:max-w-206 lg:w-auto">
                    <p class="text-base lg:text-xl/relaxed xl:text-3xl/relaxed">{{ $attraction->description }}
                    </p>
                </div>
                <div data-aos="fade-left" class="flex flex-col gap-7 w-full lg:w-auto">
                    <div class="flex flex-col w-full justify-around bg-[#E5E6F6] gap-3 md:gap-6.75 px-6 md:px-11 py-8 rounded-[20px] font-['FindSansPro'] text-sm sm:text-lg xl:text-2xl">
                        <div class="flex items-center gap-5">
                            <img class="size-4 sm:size-6 md:size-7.5 icon" src="/images/значок локации.svg">
                            <p>{{ $attraction->address }}</p>
                        </div>
                        <div class="flex items-center gap-5">
                            <img class="size-4 sm:size-6 md:size-7.5 icon" src="/images/image 8.svg">
                            @forelse($restaurant->worktime ?? [] as $day => $time)
                                <p>{{ $day }}: {{ $time }}</p>
                            @empty
                                <p>Не указано</p>
                            @endforelse
                        </div>
                    </div>
                    <div class="bg-[#E5E6F6] px-6 md:px-11 py-3 rounded-[20px] font-['FindSansPro'] text-xs md:text-lg xl:text-2xl">
                        <h3>Категории</h3>
                        <p class="text-[#5F5F5F]">{{$attraction->short_description}}</p>
                    </div>
                    <button class="w-full bg-linear-to-r from-green-500 to-teal-600 text-white py-6 rounded-[30px] hover:shadow-lg transition cursor-pointer font-['FindSansPro'] text-lg sm:text-xl xl:text-3xl">Показать на карте</button>
                </div>
            </div>
            <div data-aos="fade-right" class="font-['FindSansPro'] flex flex-col items-center lg:items-start">
                <h3>Достижения</h3>
                <p class="text-lg md:text-2xl text-center lg:text-left">За посещение достопримечательности “{{$attraction->name}}” вы получите:</p>
                <div class="flex flex-row flex-wrap gap-4 lg:gap-10 justify-center lg:justify-start items-center text-sm pt-4 lg:pt-5 3xl:pt-7 md:text-xl">
                    <div class="text-white rounded-4xl bg-linear-to-r from-green-500 to-teal-600 py-3 sm:py-4.5 px-8 sm:px-15">+1 к “Знатоку города” </div>
                    <div class="gradient-button text-white rounded-4xl py-3 sm:py-4.5 px-8 sm:px-15">+1 к “Первооткрывателю” </div>
                    <a href="#" class="text-[#636363]">перейти к другим квестам и достижениям ></a>
                </div>
            </div>
        </div>
    </section>

    @livewire('attraction-component', ['latitude' => $attraction->latitude, 'longitude' => $attraction->longitude])
</div>
