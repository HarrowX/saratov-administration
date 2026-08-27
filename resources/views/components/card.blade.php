<div class="card bg-white rounded-[7px] sm:rounded-[20px] overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300">
    <div class="card-content group p-5 relative h-full font-['FindSansPro'] grid grid-rows-[auto_1fr_auto] content-between row-span-2 gap-3">
        <div>
            <div class="overflow-hidden rounded-[7px] sm:rounded-[19px]">
                <a href="{{ $route }}">
                    <img src="{{ $cardable->getPrimaryThumbImageUrl() }}" alt="{{ $cardable->getAltPrimaryImage() }}" class="photo rounded-[7px] sm:rounded-[19px] w-full h-50 3xl:h-81.75 object-cover group-hover:scale-110 transition-transform duration-500" >
                </a>
                <livewire:favorite-mini-button :object="$cardable"/>
            </div>
        </div>
        <a href="{{ $route }}" class="flex-1 flex flex-col gap-5">
            <h2 class="card-title text-center text-lg lg:text-xl 3xl:text-3xl font-bold group-hover:text-[#352AA2] transition-colors duration-300 line-clamp-2">{{ $title }}</h2>
            <div class="flex flex-col justify-end text-sm lg:text-base 3xl:text-2xl font-light gap-3 text-[#5F5F5F]">
                <p class="text-center mb-2 ">{{ $subtitle }}</p>
                @php
                    $phones = array_map(fn (string $item) => trim($item), explode(',', $cardable?->phone));
                @endphp
                @if(!empty($phones))
                    @foreach($phones as $phone)
                        <span class="flex items-center gap-3.5">
                                            <i class="fas fa-phone text-lg xl:text-xl"></i>
                                            {{ $phone }}
                                        </span>
                    @endforeach
                @endif

            </div>
            <div class="flex flex-col justify-between h-full font-['FindSansPro']">
                <div class="flex flex-row justify-between items-end gap-3.5 text-sm lg:text-base 3xl:text-2xl font-light">
                    <div class="flex items-center gap-3.5 text-[#5F5F5F]">
                        <i class="fas fa-map-marker-alt text-xl xl:text-2xl"></i>
                        <p class="line-clamp-2">{{ $address }}</p>
                    </div>
                    <a href="{{ $route }}" class="arrow-link shrink-0 size-10 xl:size-11 3xl:size-15 bg-linear-to-r from-[#A556F7] to-[#2663EB] rounded-full flex items-center justify-center hover:opacity-90 hover:scale-110 group/button relative overflow-hidden transition-all duration-300 ease-in-out hover:shadow-lg hover:shadow-purple-500/30">
                        <img src="{{asset('/images/arrow-right.png')}}" alt="Стрелка" class="icon w-2 xl:w-3 3xl:w-4 h-4.5 xl:h-6 3xl:h-7.5 transition-transform duration-300 group-hover/button:translate-x-1">
                    </a>
                </div>
            </div>
        </a>
    </div>
</div>
