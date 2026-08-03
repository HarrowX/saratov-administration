@section('title')
    Саратов 435 - {{ $event->name }}
@endsection
<div>
    <section id="home" class="relative h-80 md:min-h-screen md:mt-10 xl:mt-20">
        <div class="absolute inset-0 overflow-hidden rounded-b-xl sm:rounded-b-3xl xl:rounded-b-[50px]">
            <div class="absolute inset-0">
                <img src="{{ $event->attachments?->get(0)?->url() ?? "" }}" alt="Изображение">
            </div>
            <div class="absolute inset-x-0 top-0 h-full bg-linear-to-b from-black/70 via-white/50 to-transparent"></div>
            <div class="absolute inset-x-0 bottom-0 h-40 sm:h-60 md:h-100 bg-linear-to-t from-black via-black/50 to-transparent"></div>
        </div>

        <div class="relative z-10 flex flex-col justify-between h-full max-w-6xl 3xl:max-w-421 mx-auto px-4 sm:px-10 py-8 md:py-20 w-full">
            <a href="{{ route('all-events') }}" class="z-20 hidden md:flex items-center gap-2 3xl:gap-6 text-white hover:text-blue-800 transition-colors font-['FindSansPro'] max-w-fit">
                <i class="fa-solid fa-chevron-left text-xl 3xl:text-3xl"></i>
                <span class="text-xl xl:text-2xl 3xl:text-3xl">События</span>
            </a>
            <div class="flex flex-col justify-end h-full md:h-screen w-full z-10 text-white">
                <h1 class="text-3xl xl:text-4xl 3xl:text-5xl font-extrabold leading-16 3xl:leading-24">{{$event->name}}</h1>
                <div class="flex flex-row gap-2 items-center rounded-xl xl:pb-10 text-black">
                    @if($event->categories && $event->categories->count() > 0)
                        <div class="flex flex-wrap items-center gap-2">
                            @foreach($event->categories as $category)
                                <span class="inline-flex items-center py-1 sm:py-2 px-3 sm:px-3 3xl:px-6 border border-[rgba(197,139,255,0.72)] rounded-full bg-[rgba(22,18,30,0.38)] text-white text-xs sm:text-sm 3xl:text-2xl font-medium leading-none shadow-none backdrop-blur-[6px]">
                                        {{ $category->name }}
                                </span>
                            @endforeach
                        </div>
                    @endif
                    @if($event->age_restriction)
                        <span class="inline-flex items-center py-1 sm:py-2 px-3 sm:px-3 3xl:px-6 border border-[rgba(197,139,255,0.72)] rounded-full bg-[rgba(109,67,193,0.38)] text-white text-xs sm:text-sm 3xl:text-2xl font-medium leading-none shadow-none backdrop-blur-[6px]">
                            {{ $event->age_restriction }}+
                        </span>
                    @endif
                </div>
            </div>
        </div>
    </section>
    <section class="features-section pt-5 md:pt-10 xl:pt-15 2xl:pt-25 bg-white">
        <div class="max-w-6xl 3xl:max-w-421 mx-auto px-4 sm:px-10 flex flex-col gap-12">
            <div class="flex flex-col lg:flex-row items-start justify-between gap-6 xl:gap-11">
                <div data-aos="fade-right" class="lg:max-w-110 xl:max-w-130 3xl:max-w-190 lg:w-auto flex flex-col gap-5">
                    <p class="text-base xl:text-xl/relaxed 3xl:text-3xl/relaxed text-justify">
                        {{ $event->description }}
                    </p>
                </div>
                <div data-aos="fade-left" class="flex flex-col gap-3 2xl:gap-7 w-full lg:w-auto">
                    <div class="flex flex-col w-full justify-around bg-[#E5E6F6] gap-3 3xl:gap-6.75 px-6 xl:px-11 py-4 xl:py-8 rounded-[20px] xl:rounden-[30px] font-['FindSansPro'] text-sm xl:text-lg 3xl:text-2xl">
                        <div class="flex items-center gap-2 3xl:gap-5">
                            <i class="fas fa-calendar"></i>
                            <p>
                                {{ $event->start_date->translatedFormat('j F, H:i')}}
                                @if($event->end_date)
                                    - {{ $event->end_date->translatedFormat('j F, H:i')}}
                                @endif
                            </p>
                        </div>
                        <div class="border-t-2 pt-2 border-t-[#c2c3cf] flex flex-col gap-2 3xl:gap-5">
                            <p>Локация</p>
                            <div class="flex items-center gap-2 3xl:gap-5">
                                <i class="fa-solid fa-location-dot"></i>
                                <p>{{ $event->location->name ?? 'Локация' }}</p>
                            </div>
                            <div class="flex items-center gap-2 3xl:gap-5">
                                <i class="fa-solid fa-location-arrow"></i>
                                <p>{{ $event->location->address ?? 'Адрес не указан' }}</p>
                            </div>
                        </div>
                        @if($event->organizer_name || $event->organizer_phone || $event->organizer_email || $event->organizer_website)
                            <div class="border-t-2 pt-2 border-t-[#c2c3cf] flex flex-col gap-2 3xl:gap-5">
                                @if($event->organizer_name)
                                    <p>Организатор</p>
                                    <div class="flex items-center gap-2 3xl:gap-5">
                                        <i class="fas fa-museum"></i>
                                        <p>{{ $event->organizer_name }}</p>
                                    </div>
                                @endif

                                @if($event->organizer_website)
                                    <a href="{{ $event->organizer_website }}" target="_blank" class="flex items-center gap-2 3xl:gap-5 hover:text-green-500 transition-colors duration-300 max-w-fit">
                                        <i class="fa fa-globe"></i>
                                        <p>Перейти на сайт</p>
                                    </a>
                                @endif
                                @if($event->organizer_phone)
                                    <a href="tel:{{ $event->organizer_phone }}" class="flex flex-row gap-2 3xl:gap-5 items-center hover:text-green-500 transition-colors duration-300 max-w-fit">
                                        <i class="fas fa-phone"></i>
                                        <p>{{ $event->organizer_phone }}</p>
                                    </a>
                                @endif

                                @if($event->organizer_email)
                                    <a href="mailto:{{ $event->organizer_email }}" class="flex flex-row gap-2 3xl:gap-5 items-center hover:text-green-500 transition-colors duration-300 max-w-fit">
                                        <i class="fa-solid fa-envelope"></i>
                                        <p>{{ $event->organizer_email }}</p>
                                    </a>
                                @endif
                            </div>
                        @endif
                    </div>
                    @if($event->map_link)
                        <a href="{{$event->map_link}}" target="_blank" class="flex justify-center w-full bg-linear-to-r from-green-500 to-teal-600 text-white py-3 2xl:py-6 rounded-[20px] xl:rounden-[30px] hover:shadow-lg transition cursor-pointer font-['FindSansPro'] text-base sm:text-lg xl:text-xl 3xl:text-3xl">
                            Показать на карте
                        </a>
                    @else
                        <div class="w-full flex justify-center bg-linear-to-r from-green-500 to-teal-600 text-white py-3 2xl:py-6 rounded-[20px] xl:rounden-[30px] text-base sm:text-lg xl:text-xl 3xl:text-3xl opacity-50 cursor-not-allowed content-center font-['FindSansPro']" disabled>
                            Показать на карте
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
    <section class="py-5 md:py-8 xl:py-10 3xl:py-18 bg-gray-50 my-5 md:my-8 xl:my-10 3xl:my-18">
        <div class="max-w-6xl 3xl:max-w-421 mx-auto px-4 sm:px-10">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                @foreach($event->attachments->take(5) as $index => $attachment)
                    @php
                        $colSpan = '';
                        $rowSpan = '';
                        if ($event->attachments->count() === 1) {
                            $colSpan = 'col-span-2 md:col-span-4 row-span-2';
                        }
                        elseif ($event->attachments->count() === 2) {
                            if ($index === 0) $colSpan = 'col-span-2 md:col-span-2 row-span-2';
                            if ($index === 1) $colSpan = 'col-span-2 md:col-span-2 row-span-2';
                        }
                        elseif ($event->attachments->count() === 3) {
                            if ($index === 0) $colSpan = 'col-span-2 md:col-span-2 row-span-2';
                            if ($index === 1 || $index === 2) $colSpan = 'col-span-1 md:col-span-1';
                        }
                        elseif ($event->attachments->count() === 4) {
                            if ($index === 0) $colSpan = 'col-span-2 md:col-span-2 row-span-2';
                        }
                        else {
                            if ($index === 0) $colSpan = 'col-span-2 row-span-2';
                        }
                    @endphp
                    <div data-aos="zoom-in" data-aos-delay="{{ $index * 100 }}" class="relative group overflow-hidden rounded-lg {{ $colSpan }} {{ $rowSpan }} cursor-pointer" data-fancybox="gallery" data-src="{{ $attachment->url() }}" data-caption="{{ $attachment->title ?? 'Фото ' . ($index + 1) }}">
                        <img src="{{ $attachment->url() }}" alt="{{ $attachment->title ?? 'Фото ' . ($index + 1) }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                        <div class="absolute inset-0 bg-linear-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition">
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        @if($event->attachments->count() > 5)
            <div class="text-center text-xs xl:text-base mt-5 xl:mt-8">
                <button onclick="openFullGallery()" class="btn-gallery bg-linear-to-r from-pink-500 to-red-500 text-white px-4 xl:px-8 py-2 xl:py-4 rounded-lg font-semibold hover:shadow-lg transition transform hover:-translate-y-1">
                    <i class="fas fa-images mr-2"></i>
                    Смотреть все фотографии
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
