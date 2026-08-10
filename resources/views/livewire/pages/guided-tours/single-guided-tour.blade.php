@section('title')
    Саратов 435 - Экскурсии {{ $guidedTour->name }}
@endsection

<div>
    <section id="home" class="relative mt-25 md:mt-35 xl:mt-40 3xl:mt-50 ">
        <div class="max-w-6xl xl:max-w-7xl 3xl:max-w-398.25 px-4 sm:px-20 mx-auto relative">

            <a href="{{ route('all-guided-tours') }}"
               class="absolute left-3 md:left-8 2xl:left-15 3xl:-left-8 top-0 md:-top-10 3xl:-top-15 items-center xl:gap-2 text-[#5F5F5F] hover:text-blue-800 transition-colors font-['FindSansPro']">
                <i class="fa-solid fa-chevron-left text-xl xl:text-xl 3xl:text-3xl"></i>
                <span class="text-xl 3xl:text-3xl pl-4">Экскурсоводы</span>
            </a>

            <button wire:click="toggleFavorite" class="flex absolute right-7 sm:right-10 top-14 sm:top-0 md:-top-10 3xl:-top-15 xl:right-20 z-20 items-center gap-1 sm:gap-3 px-3 sm:px-5 py-1.5 sm:py-3 rounded-full bg-black/20 backdrop-blur-sm border border-white/20 text-white hover:border-red-400/50 hover:text-red-400 transition-all duration-300 font-['FindSansPro'] groupp">
                <i class="fa-regular fa-heart text-lg sm:text-2xl xl:text-3xl group-hover:scale-110 group-hover:animate-pulse transition-transform {{ $isFavorite ? 'fa-solid text-red-400' : 'fa-regular' }}"></i>
                <span class="text-xs xs:text-sm sm:text-lg 2xl:text-3xl font-medium">
                    {{ $isFavorite ? 'В избранном' : 'В избранное' }}
                </span>
                <span class="favorite-count ml-2 text-[10px] sm:text-base 2xl:text-xl font-bold flex justify-center items-center min-w-5 h-5 sm:min-w-8 sm:h-8 px-1 sm:px-2 rounded-full {{ $isFavorite ? 'bg-red-400 text-white' : 'bg-red-400/80 text-white' }} transition-colors shadow-lg">
                   {{ $favoritesCount }}
                </span>
            </button>
        </div>
    </section>
    <!--Hero Section-->
    <section class="features-section flex justify-center pt-10 sm:pt-20 xl:pt-30 bg-white">
        <div class="flex flex-col md:flex-row gap-2.5 sm:gap-5 md:gap-7 3xl:gap-17.5 max-w-6xl 3xl:max-w-421 mx-auto px-4 sm:px-10">
            <div class="relative rounded-2xl overflow-hidden min-w-full md:min-w-95 lg:min-w-120 3xl:min-w-202 h-90 md:h-135 lg:h-auto">
                <img src="{{ $guidedTour->attachments?->get(0)?->url() ?? "" }}" alt="Изображение {{ $guidedTour->name }}">
{{--                <div class="absolute top-3 right-3 bg-white/90 backdrop-blur-sm p-2 rounded-full shadow-lg flex items-center gap-1.5">--}}
{{--                    <i class="fas fa-star text-yellow-500"></i>--}}
{{--                    <span class="text-sm font-semibold text-black">4.9</span>--}}
{{--                </div>--}}
            </div>
            <div>
                <h1 class="font-black text-3xl 3xl:text-5xl text-center leading-10 3xl:leading-14 pb-4 3xl:pb-12">{{ $guidedTour->name }}</h1>
                <div class="text-base xl:text-xl flex flex-col gap-4 md:gap-2 lg:gap-4 3xl:gap-8">
                    <p>{{ $guidedTour->short_description }}</p>
                    <p>Стаж работы: {{ $guidedTour->experience }}</p>
                    <p>{{ $guidedTour->description }}</p>
                    <a href="tel:{{ $guidedTour->phone }}" class="flex flex-row gap-5 3xl:gap-10 w-fit hover:text-[#352AA2] transition-colors duration-300">
                        <div class="size-4 3xl:size-6">
                            <i class="fa fa-phone text-lg lg:text-2xl"></i>
                        </div>
                       <p>{{ $guidedTour->phone }}</p>
                    </a>
                    <a href="mailto:{{ $guidedTour->email }}" class="flex flex-row gap-5 3xl:gap-10 3xl:ml-3 w-fit hover:text-[#352AA2] transition-colors duration-300">
                        <div class="w-4 h-6 3xl:w-4.5 3xl:h-8">
                            <i class="fa fa-question text-lg lg:text-2xl"></i>
                        </div>
                       <p>Задать вопрос: {{ $guidedTour->email }}</p>
                    </a>
                    <div class="flex flex-row gap-5 justify-start">
                        @if($guidedTour->max)
                            <a href="{{$guidedTour->max}}" target="_blank">
                                <img src="{{asset('images/max-dark.svg')}}" class="icon size-10 hover:scale-130 transition-transform duration-300" vk="иконка макса">
                            </a>
                        @endif
                        @if($guidedTour->vk)
                            <a href="{{$guidedTour->vk}}" target="_blank">
                                <img src="{{asset('images/vk.png')}}" class="icon size-10 hover:scale-130 transition-transform duration-300" alt="иконка вк">
                            </a>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="py-15 xl:py-20 3xl:py-30 bg-white">
        <div class="max-w-3xl lg:max-w-5xl xl:max-w-7xl 3xl:max-w-398.25 mx-auto px-4 sm:px-10">
            <div class="text-center mb-5 3xl:mb-12">
                <h2 class="title-big">Проводимые экскурсии</h2>
            </div>
            @if($guidedTour->excursions->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5 3xl:gap-7.5 gap-y-7 lg:p-6 xl:gap-y-12">
                    @foreach ($guidedTour->excursions as $excursion)
                        <div class="card bg-white rounded-[7px] sm:rounded-[20px] overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300">
                            <div class="card-content group p-5 relative grid grid-rows-subgrid content-between row-span-2 gap-3 h-full font-['FindSansPro']">
                                <div class="flex flex-col gap-5">
                                    <div class="overflow-hidden rounded-[7px] sm:rounded-[19px]">
                                        <img src="{{ $excursion->attachments?->get(0)?->url() ?? asset('images/default.jpg') }}" alt="Изображение {{ $excursion->name }}" class="photo rounded-[7px] sm:rounded-[19px] w-full h-50 3xl:h-81.75 object-cover group-hover:scale-110 transition-transform duration-500">
                                    </div>
                                    <h2 class="card-title text-center text-lg lg:text-xl 3xl:text-3xl font-bold">{{ $excursion->name}}</h2>
                                    <div class="flex flex-col justify-end text-sm lg:text-base 3xl:text-2xl font-light gap-3 text-[#5F5F5F]">
                                        <div class="flex flex-row text-xs sm:text-sm lg:text-base 3xl:text-[22px] font-light gap-6 text-[#5F5F5F]">
                                                <span class="flex items-center gap-2">
                                                    <i class="fa-solid fa-clock text-base xl:text-2xl"></i>
                                                        {{num_word($excursion->getDuration(), ['минута', 'минуты', 'минут'])}}
                                                </span>
                                            <span class="flex items-center gap-2">
                                                    <i class="fas fa-map-marker-alt text-base xl:text-2xl"></i>
                                                        {{num_word($excursion->points->count(), ['точка', 'точки', 'точек'])}}
                                                </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex flex-col justify-between h-full font-['FindSansPro']">
                                    <div class="flex flex-row justify-between items-end gap-3.5 text-xs sm:text-sm lg:text-base 3xl:text-[22px] font-light">
                                        <span class="flex items-center gap-3.5 text-[#5F5F5F]">
                                            <i class="fa-solid fa-location-arrow text-xl xl:text-2xl"></i>
                                            {{ $excursion->meeting_address }}
                                        </span>
                                        <a href="{{ route('single-excursion', ['excursion' => $excursion->slug]) }}" class="arrow-link shrink-0 size-10 xl:size-11 3xl:size-15 bg-linear-to-r from-[#A556F7] to-[#2663EB] rounded-full flex items-center justify-center hover:opacity-90 hover:scale-110 group/button relative overflow-hidden transition-all duration-300 ease-in-out hover:shadow-lg hover:shadow-purple-500/30">
                                            <img src="/images/Arrow 2.png" alt="Стрелка" class="icon w-2 xl:w-3 3xl:w-4 h-4.5 xl:h-6 3xl:h-7.5 transition-transform duration-300 group-hover/button:translate-x-1">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center">
                    <div class="w-24 h-24 bg-blue-50 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fa fa-compass text-4xl text-[#352AA2]"></i>
                    </div>
                    <h3 class="text-2xl font-semibold text-gray-700 mb-2">Экскурсий пока нет</h3>
                    <p class="text-gray-500">Этот экскурсовод пока не проводит экскурсий. Загляните позже!</p>
                </div>
            @endif
        </div>
    </section>
</div>
