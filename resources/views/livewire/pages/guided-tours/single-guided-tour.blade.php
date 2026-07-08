@section('title')
    Саратов 435 - Экскурсии {{ $guidedTour->name }}
@endsection

<div>
    <!--Hero Section-->
    <section class="features-section flex justify-center pt-28 md:pt-35 xl:pt-31 3xl:pt-41.5 md:pb-15 xl:pb-20 3xl:pb-26 bg-white">
        <div class="flex flex-col md:flex-row gap-2.5 sm:gap-5 md:gap-7 3xl:gap-17.5 max-w-6xl 3xl:max-w-421 mx-auto px-4 sm:px-10">
            <div class="relative rounded-2xl overflow-hidden min-w-full md:min-w-72 xl:min-w-120 3xl:min-w-202 md:h-135 lg:h-auto">
                <img src="{{ $guidedTour->attachments?->get(0)?->url() ?? "" }}" alt="Изображение {{ $guidedTour->name }}">
                <div class="absolute top-3 right-3 bg-white/90 backdrop-blur-sm p-2 rounded-full shadow-lg flex items-center gap-1.5">
                    <i class="fas fa-star text-yellow-500"></i>
                    <span class="text-sm font-semibold text-black">4.9</span>
                </div>
            </div>
            <div>
                <h1 class="font-black text-3xl 3xl:text-5xl text-center pb-4 3xl:pb-12">{{ $guidedTour->name }}</h1>
                <div class="text-base xl:text-xl flex flex-col gap-4 md:gap-2 lg:gap-4 3xl:gap-8">
                    <p>{{ $guidedTour->short_description }}</p>
                    <p>Стаж работы: {{ $guidedTour->experience }}</p>
                    <p>{{ $guidedTour->description }}</p>
                    <div class="flex flex-row gap-5 3xl:gap-10">
                       <img src="/images/phone.png" class="icon size-6 3xl:size-8">
                       <p>{{ $guidedTour->phone }}</p>
                    </div>
                    <div class="flex flex-row gap-5 3xl:gap-10 3xl:ml-3">
                       <img src="{{asset('images/gues.png')}}" class="icon w-4 h-6 3xl:w-4.5 3xl:h-8">
                       <p>Задать вопрос: {{ $guidedTour->email }}</p>
                    </div>
                    <div class="w-12 h-12 flex flex-row gap-11 xl:gap-17.5 justify-center md:justify-start">
                        @if($guidedTour->max)
                            <a href="{{$guidedTour->max}}" target="_blank">
                                <img src="{{asset('images/max-dark.svg')}}" class="icon">
                            </a>
                        @endif
                        @if($guidedTour->vk)
                            <a href="{{$guidedTour->vk}}" target="_blank">
                                <img src="{{asset('images/vk.png')}}" class="icon">
                            </a>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="py-10 xl:py-15 3xl:py-20 bg-white">
        <div class="max-w-3xl lg:max-w-5xl xl:max-w-7xl 3xl:max-w-398.25 mx-auto px-5 sm:px-10">
            <div class="text-center mb-8 3xl:mb-12">
                <h2>Экскурсии {{ $guidedTour->name }}</h2>
            </div>

            <!-- Карусель -->
            <div class="relative group">
                <div class="flex overflow-x-auto gap-6 pb-6 scrollbar-hide scroll-smooth"
                     style="scrollbar-width: none; -ms-overflow-style: none;">

                    @foreach ($guidedTour->excursions as $excursion)
                        <div class="shrink-0 w-[85%] sm:w-100 lg:w-[calc(33.333%-16px)]">
                            <div class="card bg-white rounded-[7px] sm:rounded-[19px] overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300">
                                <div class="card-content p-2 sm:p-6 relative">
                                    <div>
                                        <img src="{{ $excursion->attachments?->get(0)?->url() ?? asset('images/default.jpg') }}"
                                             alt="Изображение {{ $excursion->name }}"
                                             class="rounded-[7px] sm:rounded-[19px] w-full h-48 object-cover">
                                    </div>
                                    <div class="flex flex-col font-['FindSansPro'] mt-3 sm:mt-4">
                                        <h3 class="text-xs sm:text-lg lg:text-xl xl:text-2xl 3xl:text-3xl font-bold md:pt-3 line-clamp-2 sm:line-clamp-3 h-8 sm:h-22 md:h-25 xl:h-28 3xl:h-32">{{ $excursion->name }}</h3>
                                        <div class="flex flex-col">
                                            <div class="flex flex-row text-[8px] sm:text-sm lg:text-base xl:text-[22px] font-light gap-6 text-[#5F5F5F] mt-5 mb-0 sm:mb-2 lg:mb-6">
                                    <span class="flex items-center gap-2">
                                        <i class="fa-solid fa-clock"></i>
                                        {{ num_word($excursion->getDuration(), ['минута', 'минуты', 'минут']) }}
                                    </span>
                                                <span class="flex items-center gap-2">
                                        <i class="fas fa-map-marker-alt"></i>
                                        {{ num_word($excursion->points->count(), ['точка', 'точки', 'точек']) }}
                                    </span>
                                            </div>
                                            <a href="{{ route('single-excursion', ['excursion' => $excursion->slug]) }}"
                                               class="w-full gradient-button text-white text-[8px] sm:text-base xl:text-xl py-1 lg:py-2 rounded-[3px] sm:rounded-lg hover:opacity-90 transition-opacity text-center">
                                                Подробнее
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Кнопки навигации -->
                <div class="absolute top-1/2 -translate-y-1/2 left-0 -translate-x-4 opacity-0 group-hover:opacity-100 transition-opacity hidden lg:block">
                    <button onclick="document.querySelector('.overflow-x-auto').scrollBy({left: -400, behavior: 'smooth'})"
                            class="w-10 h-10 bg-white rounded-full shadow-lg flex items-center justify-center text-gray-600 hover:text-blue-500 transition-colors">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                </div>
                <div class="absolute top-1/2 -translate-y-1/2 right-0 translate-x-4 opacity-0 group-hover:opacity-100 transition-opacity hidden lg:block">
                    <button onclick="document.querySelector('.overflow-x-auto').scrollBy({left: 400, behavior: 'smooth'})"
                            class="w-10 h-10 bg-white rounded-full shadow-lg flex items-center justify-center text-gray-600 hover:text-blue-500 transition-colors">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>
            </div>
    </section>
</div>
