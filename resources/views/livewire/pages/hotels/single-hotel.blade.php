@section('title')
    Саратов 435 - {{ $hotel->name }}
@endsection

<div>
    <!--Hero Section-->
    <section>
        <div class="max-w-6xl 3xl:max-w-421 mx-auto px-4 sm:px-10 pt-24 sm:pt-29 xl:pt-33">
            <h2 class="sm:pb-6 lg:hidden text-center">{{ $hotel->name }}</h2>
            <div class="grid lg:grid-cols-[auto_1fr] items-center justify-center gap-3 sm:gap-5 lg:gap-11 pb-3 sm:pb-10 lg:pb-6 3xl:pb-15">
                <div class="grid grid-cols-3 gap-2 sm:gap-3 3xl:gap-5 w-full">
                    @php
                        $attachments = $hotel->attachments;
                        $count = $attachments->count();
                    @endphp
                    <img src="{{ $hotel->attachments?->get(0)?->url() ?? "" }}" alt="Изображение {{ $hotel->name }}" class="photo object-cover w-full rounded-md sm:rounded-lg lg:rounded-2xl  max-h-25 xs:max-h-35 md:max-h-62 lg:max-h-55 lg:max-w-[190px] 3xl:max-h-90 3xl:max-w-[304px]">
                    @if($count >= 2)
                        <img src="{{ $hotel->attachments?->get(1)?->url() ?? "" }}" alt="Изображение {{ $hotel->name }}"
                             class="photo object-cover w-full rounded-md sm:rounded-lg lg:rounded-2xl max-h-25 xs:max-h-35 md:max-h-62 lg:max-h-55 lg:max-w-[190px] 3xl:max-h-90 3xl:max-w-[304px]">
                    @endif

                    @if($count >= 3)
                        <img src="{{ $hotel->attachments?->get(2)?->url() ?? "" }}" alt="Изображение {{ $hotel->name }}"
                             class="photo object-cover w-full rounded-md sm:rounded-lg lg:rounded-2xl max-h-25 xs:max-h-35 md:max-h-62 lg:max-h-55 lg:max-w-[190px] 3xl:max-h-90 3xl:max-w-[304px]">
                    @endif
                </div>
                <p class="text-base xl:text-lg 2xl:text-xl w-full 3xl:max-w-151.5">
                    {{ $hotel->description }}
                </p>
            </div>
            <h2 class="pb-3 3xl:pb-6 hidden lg:block text-center">{{ $hotel->name }}</h2>
            <div class="grid lg:grid-cols-[auto_1fr] items-center justify-center gap-3 sm:gap-5 lg:gap-11">
                <div class="grid grid-cols-2 gap-2 sm:gap-3 3xl:gap-5 w-full lg:order-2">
                    @php
                        $attachments = $hotel->attachments;
                        $count = $attachments->count();
                    @endphp
                    @if($count >= 4)
                        <img src="{{ $hotel->attachments?->get(3)?->url() ?? "" }}" alt="Изображение {{ $hotel->name }}"
                             class="photo object-cover w-full rounded-md sm:rounded-lg lg:rounded-2xl max-h-25 xs:max-h-35 md:max-h-62 lg:max-h-67 xl:max-h-90">
                    @endif
                    @if($count >= 5)
                        <img src="{{ $hotel->attachments?->get(4)?->url() ?? "" }}" alt="Изображение {{ $hotel->name }}"
                             class="photo w-full xl:w-80 3xl:w-full object-cover rounded-md sm:rounded-lg lg:rounded-2xl max-h-25 xs:max-h-35 md:max-h-62 lg:max-h-67 xl:max-h-90">
                    @endif
                </div>
                <p class="text-base xl:text-lg 2xl:text-xl w-full lg:max-w-114 3xl:max-w-151.5 text-left lg:text-right xl:text-left lg:order-1">
                    {{ $hotel->second_description }}
                </p>
            </div>
        </div>
    </section>

    <section class="features-section pt-8 md:pt-10 xl:pt-20 3xl:pt-26 pb-10 lg:pb-20 xl:pb-20 3xl:pb-36 bg-white">
        <div class="max-w-6xl 3xl:max-w-421 mx-auto px-4 sm:px-10">
            <div class="flex flex-col md:flex-row items-center justify-between gap-5 lg:gap-10 xl:gap-13.5">
                <div data-aos="fade-left" class="flex flex-col gap-7 w-full">
                    <div class="flex flex-col w-full justify-around bg-[#E5E6F6] gap-3 md:gap-6.75 px-6 xl:px-7 3xl:px-11 py-6 lg:py-8 rounded-[20px] font-['FindSansPro'] text-sm sm:text-sm lg:text-lg 2xl:text-lg 3xl:text-2xl">
                        <div class="flex items-center gap-3 xl:gap-5">
                            <img class="size-4 sm:size-6 xl:size-7.5 icon" src="/images/значок локации.svg">
                            <p>{{ $hotel->address }}</p>
                        </div>
                        <div class="flex items-center gap-3 xl:gap-5">
                            <img class="size-4 sm:size-6 xl:size-7.5 icon" src="/images/image 15.svg">
                            <p>{{ $hotel->phone }}</p>
                        </div>
                        <div class="flex items-start gap-3 xl:gap-5">
                            <img class="size-4 sm:size-6 xl:size-7.5 icon" src="/images/image 8.svg">
                            <div class="flex flex-col gap-2">
                                @forelse($hotel->worktime ?? [] as $day => $time)
                                    <p>{{ $day }}: {{ $time }}</p>
                                @empty
                                    <p>Не указано</p>
                                @endforelse
                            </div>
                        </div>
                        <div class="flex items-center gap-2 xl:gap-5">
                            <i class="fa fa-home text-3xl"></i>
                            <p>{{ $hotel->type}}</p>
                        </div>
                    </div>
                </div>
                <div data-aos="fade-right" class="font-['FindSansPro'] flex flex-col-reverse md:flex-col gap-5 md:gap-0 w-full md:w-auto">
                    <div>
                        <h3 class="text-center md:text-left pb-2 md:pb-0">Достижения</h3>
                        <p class="text-base xl:text-lg 3xl:text-2xl lg:text-nowrap">За прохождение “{{$hotel->name}}” вы получите:</p>
                        <div class="flex flex-row md:flex-col flex-wrap gap-2 lg:gap-4 justify-between md:justify-start items-center md:items-start pt-4 lg:pt-5 3xl:pt-7 text-[9px] sm:text-[13px] lg:text-base xl:text-lg 3xl:text-xl">
                            <div class="text-white rounded-4xl gradient-button py-3 lg:py-4.5 px-8 lg:px-15">+1 к “Исследователю”</div>
                        </div>
                    </div>
                    @if($hotel->map_link)
                        <a href="{{ $hotel->map_link }}" target="_blank" class="flex justify-center w-full bg-linear-to-r from-green-500 to-teal-600 text-white py-3 xl:py-6 rounded-[30px] hover:shadow-lg transition cursor-pointer text-lg sm:text-lg xl:text-xl 3xl:text-3xl md:mt-4">
                            Показать на карте
                        </a>
                    @else
                        <div class="w-full flex justify-center bg-linear-to-r from-green-500 to-teal-600 text-white py-3 xl:py-6 rounded-[30px] text-lg sm:text-lg xl:text-xl 3xl:text-3xl md:mt-4 opacity-50 cursor-not-allowed content-center" disabled>
                            Показать на карте
                        </div>
                    @endif
                </div>
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
