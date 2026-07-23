@section('title')
    Саратов 435 - {{ $event->name }}
@endsection
<div>
    <section id="home" class="relative h-68.5 md:min-h-screen overflow-hidden rounded-b-xl sm:rounded-b-3xl lg:rounded-b-[50px] mt-20">
        <div class="absolute inset-0">
            <div class="absolute inset-0">
                <img src="{{ $event->attachments?->get(0)?->url() ?? "" }}" alt="Изображение">
            </div>
            <div class="absolute inset-x-0 top-0 h-full bg-linear-to-b from-black/70 via-white/50 to-transparent"></div>
            <div class="absolute inset-x-0 bottom-0 h-40 sm:h-60 md:h-100 bg-linear-to-t from-black via-black/50 to-transparent"></div>
        </div>

        <div class="relative z-10 flex flex-col justify-between h-full max-w-3xl lg:max-w-5xl xl:max-w-7xl 3xl:max-w-438.5 mx-auto px-5 xl:px-20 py-8 sm:py-15 md:py-20 w-full">
            <a href="{{ route('all-events') }}" class="z-20 hidden md:flex items-center gap-2 text-white hover:text-blue-300 transition-colors font-['FindSansPro']">
                <i class="fa-solid fa-chevron-left text-xl xl:text-3xl"></i>
                <span class="text-xl xl:text-3xl pl-4">Все события</span>
            </a>
            <div class="flex flex-col justify-end h-full pb-8 sm:pb-15 md:pb-0 md:h-screen w-full z-10 text-white">
                <h1 class="text-3xl xl:text-6xl font-extrabold leading-24">{{$event->name}}</h1>
                <div class="flex flex-row gap-3 items-center pb-10 text-black">
                    @if($event->categories && $event->categories->count() > 0)
                        <div class="flex flex-wrap gap-4 pt-1">
                            @foreach($event->categories as $category)
                                <span class="inline-block p-0.5 rounded-xl bg-linear-to-r from-[#A556F7] to-[#2663EB]">
                                    <span class="block px-4 py-2 3xl:py-3 text-[10px] xl:text-2xl rounded-xl font-medium bg-white">
                                        {{ $category->name }}
                                    </span>
                                </span>
                            @endforeach
                        </div>
                    @endif
                    @if($event->age_restriction)
                        <span class="size-10 xl:size-12 3xl:size-15 bg-[#A855F7] rounded-md xl:rounded-xl flex items-center justify-center text-white text-xl xl:text-2xl font-bold">
                            {{ $event->age_restriction }}+
                        </span>
                    @endif
                </div>
            </div>
        </div>
    </section>
    <section class="features-section pt-8 md:pt-10 xl:pt-15 2xl:pt-25 bg-white">
        <div class="max-w-3xl lg:max-w-5xl xl:max-w-7xl 3xl:max-w-438.5 mx-auto px-5 xl:px-20 flex flex-col gap-12">
            <div class="flex flex-col-reverse lg:flex-row items-start justify-between gap-11">
                <div data-aos="fade-right" class="max-w-150 3xl:max-w-206 lg:w-auto flex flex-col gap-5">
                    <p class="text-base lg:text-xl/relaxed xl:text-xl/relaxed 3xl:text-3xl/relaxed">
                        {{ $event->description }}
                    </p>
                </div>
                <div data-aos="fade-left" class="flex flex-col gap-7 w-full lg:w-auto">
                    <div class="flex flex-col w-full justify-around bg-[#E5E6F6] gap-3 md:gap-6.75 px-6 md:px-11 py-8 rounded-[20px] font-['FindSansPro'] text-sm sm:text-lg xl:text-xl 3xl:text-2xl">
                        <div class="flex items-center gap-5">
                            <i class="fas fa-calendar"></i>
                            <p>
                                {{ $event->start_date->translatedFormat('j F Y, H:i')}}
                                @if($event->end_date)
                                    - {{ $event->end_date->translatedFormat('j F Y, H:i')}}
                                @endif
                            </p>
                        </div>
                        <div class="border-t-2 pt-2 border-t-[#c2c3cf] flex flex-col gap-5">
                            <p>Локация</p>
                            <div class="flex items-center gap-5">
                                <i class="fa-solid fa-location-dot"></i>
                                <p>{{ $event->location->name ?? 'Локация' }}</p>
                            </div>
                            <div class="flex items-center gap-5">
                                <i class="fa-solid fa-location-arrow"></i>
                                <p>{{ $event->location->address ?? 'Адрес не указан' }}</p>
                            </div>
                        </div>
                        @if($event->organizer_name || $event->organizer_phone || $event->organizer_email || $event->organizer_website)
                            <div class="border-t-2 pt-2 border-t-[#c2c3cf] flex flex-col gap-5">
                                @if($event->organizer_name)
                                    <p>Организатор</p>
                                    <div class="flex items-center gap-5">
                                        <i class="fas fa-museum"></i>
                                        <p>{{ $event->organizer_name }}</p>
                                    </div>
                                @endif

                                @if($event->organizer_website)
                                    <a href="{{ $event->organizer_website }}" target="_blank" class="flex items-center gap-5 hover:text-[#486381] transition-colors">
                                        <i class="fa fa-globe"></i>
                                        <p>Перейти на сайт</p>
                                    </a>
                                @endif

                                @if($event->organizer_phone || $event->organizer_email)
                                    <div class="flex flex-row justify-between gap-5">
                                        @if($event->organizer_phone)
                                            <span class="flex flex-row gap-5 items-center">
                                            <i class="fas fa-phone"></i>
                                            <p>{{ $event->organizer_phone }}</p>
                                        </span>
                                        @endif

                                        @if($event->organizer_email)
                                            <span class="flex flex-row gap-5 items-center">
                                            <i class="fa-solid fa-envelope"></i>
                                            <p>{{ $event->organizer_email }}</p>
                                        </span>
                                        @endif
                                    </div>
                                @endif
                            </div>
                        @endif
                    </div>
                    @if($event->map_link)
                        <a href="{{$event->map_link}}" target="_blank" class="flex justify-center w-full bg-linear-to-r from-green-500 to-teal-600 text-white py-3 xl:py-6 rounded-[30px] hover:shadow-lg transition cursor-pointer font-['FindSansPro'] text-lg sm:text-lg xl:text-xl 3xl:text-3xl">
                            Показать на карте
                        </a>
                    @else
                        <div class="w-full flex justify-center bg-linear-to-r from-green-500 to-teal-600 text-white py-3 xl:py-6 rounded-[30px] text-lg sm:text-lg xl:text-xl 3xl:text-3xl opacity-50 cursor-not-allowed content-center font-['FindSansPro']" disabled>
                            Показать на карте
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
    <section class="py-8 md:py-10 xl:py-15 2xl:py-25 bg-gray-50">
        <div class="max-w-3xl lg:max-w-5xl xl:max-w-7xl 3xl:max-w-438.5 mx-auto px-5 xl:px-20 grid grid-cols-2 md:grid-cols-4 gap-4">
            @foreach($event->attachments->take(5) as $index => $attachment)
                @php
                    $colSpan = '';
                    $rowSpan = '';
                    if ($index === 0) {
                        $colSpan = 'col-span-2 row-span-2';
                    }
                    if ($index === 4 && $event->attachments->count() > 5) {
                    }
                @endphp
                <div data-aos="zoom-in"
                     data-aos-delay="{{ $index * 100 }}"
                     class="relative group overflow-hidden rounded-lg {{ $colSpan }} {{ $rowSpan }}"
                     data-fancybox="gallery"
                     data-src="{{ $attachment->url() }}"
                     data-caption="{{ $attachment->title ?? 'Фото ' . ($index + 1) }}">
                    <img src="{{ $attachment->url() }}"
                         alt="{{ $attachment->title ?? 'Фото ' . ($index + 1) }}"
                         class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                    <div class="absolute inset-0 bg-linear-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition">
                    </div>
                </div>
            @endforeach
        </div>

        @if($event->attachments->count() > 5)
            <div class="text-center mt-8">
                <button onclick="openFullGallery()" class="btn-gallery bg-linear-to-r from-pink-500 to-red-500 text-white px-8 py-4 rounded-lg font-semibold hover:shadow-lg transition transform hover:-translate-y-1">
                    <i class="fas fa-images mr-2"></i>
                    Смотреть все фотографии ({{ $event->attachments->count() }})
                </button>
            </div>
        @endif
        <div style="display: none;">
            @foreach($event->attachments as $attachment)
                <a href="{{ $attachment->url() }}"
                   data-fancybox="full-gallery"
                   data-caption="{{ $attachment->title ?? 'Фото' }}"></a>
            @endforeach
            </div>
    </section>
</div>
