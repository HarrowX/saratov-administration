<div wire:ignore class="w-full max-w-6xl 3xl:max-w-7xl mx-auto px-4 sm:px-10 flex flex-col gap-7 2xl:gap-11">
    <div class="flex flex-col lg:flex-row gap-6 md:gap-8 xl:gap-11">
        <div class="gallery-detail-swiper grid w-full relative opacity-0">
            <div class="place-detail-swiper-main swiper shadow-[0_4px_4px_0_#00000040] rounded-3xl h-120 lg:h-100 2xl:h-120 3xl:h-160 relative group w-full">
                <div class="swiper-wrapper">
                    @forelse($attachable->attachments as $attachment)
                        <div class="swiper-slide cursor-pointer" data-fancybox="gallery" data-src="{{ $attachment->url() }}" data-caption="{{ $attachment->alt_name }}">
                            <div class="w-full h-full rounded-3xl">
                                <img src="{{ $attachment->url() }}" alt="{{$attachment->alt_name}}" class="photo w-full h-full object-cover select-none" loading="lazy" />
                            </div>
                        </div>
                    @empty
                        <div class="swiper-slide cursor-pointer" data-fancybox="gallery" data-src="{{ $attachable->getPrimaryImageUrl() }}" data-caption="{{ $attachable->getAltPrimaryImage() }}">
                            <div class="w-full h-full rounded-3xl">
                                <img src="{{ $attachable->getPrimaryImageUrl() }}" alt="{{ $attachable->getAltPrimaryImage() }}" class="photo w-full h-full object-cover select-none" loading="lazy" />
                            </div>
                        </div>
                    @endforelse
                </div>
                <div class="absolute right-6 bottom-106 lg:bottom-6 z-20 flex items-center justify-center rounded-full transition-transform duration-300 group-hover:scale-110 cursor-pointer select-none" onclick="openGallery()">
                    <i class="fas fa-search-plus text-white/50 text-3xl transition-transform duration-300 group-hover:scale-125 group-hover:text-white/70"></i>
                </div>

                @if($attachable->attachments->count() > 1)
                    <div class="button-navigation--main-left  absolute top-1/2 -translate-y-1/2 w-10 h-10 lg:w-12 lg:h-12 xl:w-14 xl:h-14 rounded-full border-2 border-white/30 flex items-center justify-center cursor-pointer z-10 left-3 lg:left-4 xl:left-5 transition-all duration-300 hover:bg-white/20 hover:border-white/60 hover:scale-110 group/nav select-none">
                        <i class="fa-solid fa-chevron-left text-xl lg:text-2xl xl:text-3xl text-white/70 group-hover/nav:text-white transition-colors duration-300"></i>
                    </div>

                    <div class="button-navigation--main-right absolute top-1/2 -translate-y-1/2 w-10 h-10 lg:w-12 lg:h-12 xl:w-14 xl:h-14 rounded-full border-2 border-white/30 flex items-center justify-center cursor-pointer z-10 right-3 lg:right-4 xl:right-5 transition-all duration-300 hover:bg-white/20 hover:border-white/60 hover:scale-110 group/nav select-none">
                        <i class="fa-solid fa-chevron-right text-xl lg:text-2xl xl:text-3xl text-white/70 group-hover/nav:text-white transition-colors duration-300"></i>
                    </div>
                @endif
                <div class="absolute inset-0 z-9 bg-linear-to-t from-black/80 via-black/30 to-transparent rounded-b-3xl pointer-events-none"></div>
                {{ $slot }}
            </div>
            @if($attachable->attachments->count() >= 5)
                <div class="place-detail-swiper-thumbs swiper hidden! lg:block! mt-4">
                    <div class="swiper-wrapper cursor-grab! focus:cursor-grabbing! active:cursor-grabbing!">
                        @foreach($attachable->attachments as $attachment)
                            <div class="swiper-slide opacity-40 border-3 border-transparent overflow-hidden shrink-0! cursor-grab focus:cursor-grabbing! active:cursor-grabbing! rounded-2xl h-14! lg:h-25! 3xl:h-30! hover:opacity-100">
                                <img src="{{ $attachment->tryGetThumbUrlOrGetUrl() }}" alt="{{ $attachment->alt_name }}"
                                     class="photo w-full h-full object-cover rounded-xl thumb-image transition-transform duration-300"
                                     loading="lazy"/>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
