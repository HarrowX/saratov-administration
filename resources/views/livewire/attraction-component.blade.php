<section class="py-10 xl:py-26 bg-white">
    <div class="max-w-3xl lg:max-w-5xl xl:max-w-7xl 3xl:max-w-398.25 mx-auto  px-5 xl:px-20">

        <div class="text-center mb-4 sm:mb-12">
            <h2 class="text-2xl md:text-3xl font-bold mb-4">Места рядом</h2>
            <p class="text-gray-600 max-w-2xl mx-auto">Интересные локации, которые удобно посетить по пути: знаковые точки, уютные уголки и лучшие места для фото.</p>
        </div>

        <!-- Карусель -->
        <div class="relative group">
            <div class="flex overflow-x-auto gap-4 md:gap-6 pb-6 scrollbar-hide scroll-smooth snap-x snap-mandatory"
                 style="scrollbar-width: none; -ms-overflow-style: none;">
                @forelse ($attractions as $attraction)
                    <div class="snap-start shrink-0 w-[calc(50%-8px)] sm:w-80 lg:w-[calc(33.333%-16px)] bg-white rounded-[19px] overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300">
                        <div class="p-2 sm:p-4 3xl:p-5 h-full flex flex-col">
                            <div class="w-full mb-4 overflow-hidden rounded-lg md:rounded-[20px] shrink-0 h-37.5 sm:h-53.75 3xl:h-78.75">
                                <img src="{{ $attraction->attachments?->get(0)?->url() ?? '' }}" alt="Изображение {{ $attraction->name }}">
                            </div>

                            <div class="font-['FindSansPro'] flex flex-col h-30 sm:h-50 md:h-60">
                                <div class="grow">
                                    <h4 class="">{{ $attraction->name }}</h4>
                                    <p class="text-[10px] sm:text-base text-[#888888] line-clamp-4">{{ $attraction->short_description }}</p>
                                </div>

                                <div class="shrink-0 mt-2 mb-3">
                                    <div class="flex items-end justify-between gap-2">
                                        <div class="flex gap-1 sm:gap-4 flex-1 max-w-37 sm:max-w-75">
                                            <img src="/images/image 7.svg" alt="" class="icon size-2.5 sm:size-4 md:size-7 mt-2 sm:mt-5 shrink-0">
                                            <span class="text-[8px] sm:text-xs xl:text-sm text-[#505050] pt-1 sm:pt-4">{{ $attraction->address }}</span>
                                        </div>
                                        <a href="{{route('single-attraction', ['attraction' => $attraction->slug]) }}" class="arrow-link shrink-0 size-5 sm:size-10 xl:size-11 3xl:size-15 bg-linear-to-r from-[#A556F7] to-[#2663EB] rounded-full flex items-center justify-center hover:opacity-70 transition-opacity">
                                            <img src="/images/Arrow 2.png" alt="Стрелка" class="arrow-link-img icon w-1 sm:w-2 xl:w-3 3xl:w-4 h-2.5 sm:h-4.5 xl:h-6 3xl:h-7.5">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="w-full text-center py-8">
                        <p class="text-gray-500 text-lg">Рядом нет достопримечательностей</p>
                    </div>
                @endforelse

                <!-- Стрелки навигации (только на десктопе) -->
                <div class="absolute top-1/2 -translate-y-1/2 left-0 -translate-x-4 opacity-0 group-hover:opacity-100 transition-opacity hidden lg:block">
                    <button onclick="this.closest('.group').querySelector('.overflow-x-auto').scrollBy({left: -400, behavior: 'smooth'})"
                            class="scroll-button hover:text-[#2663EB] transition-colors">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                </div>

                <div class="absolute top-1/2 -translate-y-1/2 right-12 translate-x-4 opacity-0 group-hover:opacity-100 transition-opacity hidden lg:block">
                    <button onclick="this.closest('.group').querySelector('.overflow-x-auto').scrollBy({left: 400, behavior: 'smooth'})"
                            class="scroll-button hover:text-[#2663EB] transition-colors">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>
