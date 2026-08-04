<section class="py-10 xl:py-26 bg-white">
    <div class="max-w-3xl lg:max-w-5xl xl:max-w-7xl 3xl:max-w-398.25 mx-auto  px-5 xl:px-20">

        <div class="text-center mb-4 sm:mb-12">
            <h2 class="text-2xl md:text-3xl font-bold mb-4">Места рядом</h2>
            <p class="text-gray-600 max-w-2xl mx-auto">Интересные локации, которые удобно посетить по пути: знаковые точки, уютные уголки и лучшие места для фото.</p>
        </div>
        <!-- Карусель -->
        <div class="relative group">
            <div class="flex overflow-x-auto gap-2 md:gap-3 pb-6 scrollbar-hide scroll-smooth snap-x snap-mandatory"
                 style="scrollbar-width: none; -ms-overflow-style: none;">
                @forelse ($attractions as $attraction)
                    <a href="{{route('single-attraction', ['attraction' => $attraction->slug])}}">
                        <div class="card snap-start shrink-0 w-[calc(90%-8px)] sm:w-80 lg:w-[calc(33.333%-16px)] bg-white rounded-[7px] sm:rounded-[20px] overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300">
                            <div class="card-content group/img group/title p-5 h-full font-['FindSansPro'] relative grid grid-rows-subgrid content-between row-span-2 gap-3 ">
                                <div class="flex flex-col gap-5">
                                    <div class="overflow-hidden rounded-[7px] sm:rounded-[19px]">
                                        <img src="{{ $attraction->attachments?->get(0)?->url() ?? '' }}" alt="Изображение {{ $attraction->name }}" class="photo rounded-[7px] sm:rounded-[19px] w-full h-50 3xl:h-81.75 object-cover group-hover/img:scale-110 transition-transform duration-500">
                                    </div>
                                    <h2 class="card-title text-center text-lg lg:text-xl 3xl:text-3xl font-bold group-hover/title:text-[#352AA2] transition-colors duration-300 line-clamp-1">{{ $attraction->name }}</h2>
                                    <p class="text-xs sm:text-sm lg:text-base 3xl:text-2xl font-light mb-2 text-[#5F5F5F]">{{ $attraction->short_description }}</p>
                                </div>
                                <div class="flex flex-col justify-between h-full font-['FindSansPro']">
                                    <div class="flex flex-row justify-between items-end gap-3.5 text-xs sm:text-sm lg:text-base 3xl:text-2xl font-light">
                                        <span class="flex items-center gap-3.5 text-[#5F5F5F]">
                                            <i class="fas fa-map-marker-alt text-xl xl:text-2xl"></i>
                                            {{ $attraction->address }}
                                        </span>
                                        <a href="{{route('single-attraction', ['attraction' => $attraction->slug]) }}" class="arrow-link shrink-0 size-10 xl:size-11 3xl:size-15 bg-linear-to-r from-[#A556F7] to-[#2663EB] rounded-full flex items-center justify-center hover:opacity-90 hover:scale-110 group/button relative overflow-hidden transition-all duration-300 ease-in-out hover:shadow-lg hover:shadow-purple-500/30">
                                            <img src="/images/Arrow 2.png" alt="Стрелка" class="icon w-2 xl:w-3 3xl:w-4 h-4.5 xl:h-6 3xl:h-7.5 transition-transform duration-300 group-hover/button:translate-x-1">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="w-full text-center py-8 font-['FindSansPro']">
                        <p class="text-gray-500 text-lg">Рядом нет достопримечательностей</p>
                    </div>
                @endforelse

                <!-- Стрелки навигации (только на десктопе) -->
                @if($attractions->count() > 3)
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
                @endif
            </div>
        </div>
    </div>
</section>
