<section class="pt-10 xl:pt-16 pb-16">
    <div class="max-w-6xl 3xl:max-w-7xl mx-auto px-4 sm:px-10">
        <h2>Как добраться</h2>
        <div class="bg-[#E5E6F6] rounded-xl sm:rounded-3xl flex flex-col lg:flex-row">
            <div class="flex flex-col justify-between w-full gap-5 p-3 sm:p-6 md:p-8">
                @if($mappable->district)
                    <div class="flex items-center gap-3">
                            <span class="size-10 sm:size-12 flex justify-center items-center bg-white/60 rounded-xl">
                                <i class="fas fa-city text-[#5F5F5F] text-lg sm:text-2xl"></i>
                            </span>
                        <div>
                            <span class="text-xs text-gray-400 block">Район</span>
                            <p>{{$mappable->district}}</p>
                        </div>
                    </div>
                @endif
                <div class="flex items-center gap-3 min-w-full">
                        <span class="size-10 sm:size-12 min-w-10 lg:min-w-12 flex justify-center items-center bg-white/60 rounded-xl">
                            <i class="fas fa-location-dot text-[#5F5F5F] text-lg sm:text-2xl"></i>
                        </span>
                    <div>
                        <span class="text-xs text-gray-400 block">Адрес</span>
                        <p>{{$mappable->address}}</p>
                    </div>
                </div>
                <div class="bg-white/60 rounded-lg sm:rounded-2xl p-3 sm:p-5">
                    <p class="text-base font-semibold text-gray-800 font-['Merriweather'] border-b border-gray-300 pb-2">Контакты</p>
                    <div class="flex flex-col lg:gap-1 pt-2">
                        <div class="group flex items-center gap-3 p-2 rounded-xl hover:bg-white/40 transition-all duration-300">
                                <span class="size-10 flex justify-center items-center bg-[#E5E6F6] rounded-lg group-hover:scale-110 transition-transform duration-300 relative overflow-hidden">
                                    <i class="fas fa-phone absolute transition-all duration-300 group-hover:opacity-0 group-hover:scale-75 text-[#5F5F5F] text-base sm:text-xl group-hover:text-[#2663EB]"></i>
                                    <i class="fas fa-phone-volume absolute transition-all duration-500 opacity-0 scale-75 group-hover:opacity-100 group-hover:scale-100 text-[#2663EB] text-base sm:text-xl group-hover:animate-[shake_0.5s_ease-in-out]"></i>
                                </span>
                            <div class="flex flex-col items-start justify-center flex-1 min-w-0">
                                <span class="text-xs text-gray-400 font-medium">Телефон</span>
                                @php
                                    $phones = array_map(fn (string $item) => trim($item), explode(',', $mappable->phone));
                                @endphp
                                @if(!empty($phones))
                                    @foreach($phones as $phone)
                                        <a href="tel:{{ $phone }}" class="flex items-center gap-1.5 hover:text-[#2663EB] transition-colors duration-300">
                                            <p>{{ $phone }}</p>
                                        </a>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        @if($mappable->email)
                            <div class="group/mail flex items-center gap-3 p-2 rounded-xl hover:bg-white/40 transition-all duration-300">
                                    <span class="size-10 flex justify-center items-center bg-[#E5E6F6] rounded-lg group-hover:scale-110 transition-transform duration-300 relative overflow-hidden">
                                        <i class="fa-solid fa-envelope absolute transition-all duration-300 group-hover/mail:opacity-0 group-hover/mail:scale-75 text-[#5F5F5F] text-base sm:text-xl group-hover/mail:text-[#2663EB]"></i>
                                        <i class="fa-solid fa-envelope-open absolute transition-all duration-500 opacity-0 scale-75 group-hover/mail:opacity-100 group-hover/mail:scale-100 text-[#2663EB] text-base sm:text-xl group-hover/mail:animate-[shake_0.5s_ease-in-out]"></i>
                                    </span>
                                <div class="flex flex-col items-start justify-center flex-1 min-w-0">
                                    <span class="text-xs text-gray-400 font-medium">Почта</span>
                                    <a href="mailto:{{ $mappable->email }}"
                                       class="flex items-center gap-1.5 hover:text-[#2663EB] transition-colors duration-300 group/link">
                                        <p>{{ $mappable->email }}</p>
                                    </a>
                                </div>
                            </div>
                        @endif
                        @if($mappable->website)
                            <div class="group/site flex items-center gap-3 p-2 rounded-xl hover:bg-white/40 transition-all duration-300">
                                    <span class="size-10 flex justify-center items-center bg-[#E5E6F6] rounded-lg group-hover:scale-110 transition-transform duration-300 relative overflow-hidden">
                                        <i class="fa-solid fa-hand-pointer transition-transform duration-300 rotate-30 group-hover/site:rotate-90 text-[#5F5F5F] group-hover/site:text-[#2663EB] text-base sm:text-xl"></i>
                                    </span>
                                <div class="flex flex-col items-start justify-center flex-1 min-w-0">
                                    <span class="text-xs text-gray-400 font-medium">Сайт</span>
                                    <a href="{{ $mappable->website }}" target="_blank"
                                       class="flex items-center gap-1.5 hover:text-[#2663EB] transition-all duration-300 group/link">
                                        <p>Перейти на сайт</p>
                                        <i class="fa-solid fa-arrow-up-right-from-square text-[10px] text-gray-400 opacity-0 group-hover/link:opacity-100 transition-all duration-300 group-hover/link:translate-x-0.3 group-hover/link:-translate-y-0.3"></i>
                                    </a>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="restaurant lg:min-w-150">
                <div id="map" class="w-full min-h-100 h-full rounded-b-xl lg:rounded-bl-none lg:rounded-r-3xl overflow-hidden border-0 box-shadow-0"></div>
            </div>
        </div>
    </div>
</section>
