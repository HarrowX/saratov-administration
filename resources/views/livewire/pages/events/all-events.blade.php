@section('title')
    Саратов 435 - События
@endsection

<div>
    <section id="home" class="hero-section pt-21 min-h-100 md:min-h-screen flex flex-col gap-17 items-center justify-center relative">
        <div class="absolute inset-0 bg-no-repeat bg-cover" style="background-image: url('/images/bg-events.jpg');">
            <div class="absolute inset-0 bg-[rgba(239,230,215,0.73)]" style="background-color:#45618696;"></div>
        </div>
        <div class="relative z-10 text-center text-white">
            <h1 class="text-4xl font-extrabold mb-4">События</h1>
            <p class="text-xl px-5">Открой для себя лучшие события в Саратове</p>
        </div>
    </section>
    <section id="events" class="features-section pt-5 sm:pt-10 md:pt-10 xl:pt-10 pb-5 sm:pb-10 md:pb-15 xl:pb-20 3xl:pb-26 bg-white">
        <div class="max-w-6xl 3xl:max-w-421 mx-auto px-4 sm:px-10 flex flex-col gap-5 sm:gap-10 items-center">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-2 sm:p-5 w-full 3xl:w-full">
                <div class="flex flex-col md:flex-row justify-center gap-4 font-['FindSansPro'] text-xs lg:text-sm xl:text-base">
                    <div class="flex flex-col gap-2 xl:gap-3 text-gray-500 w-full 3xl:w-fit">
                        <div class="flex flex-row gap-1">
                            <div class="relative flex text-black w-full">
                                <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-500"></i>
                                <input type="text" wire:model.live.debounce.500ms="search" placeholder="Поиск..." class="pl-10 pr-4 py-2.5 border border-gray-200 rounded-xl focus:outline-none hover:ring-2 hover:ring-[#352AA2] w-full hover:border-transparent focus:ring-2 focus:ring-[#352AA2] focus:border-transparent bg-gray-50 hover:bg-white transition placeholder-gray-500">
                            </div>
                            <button wire:click="clearFilters" class="md:hidden gradient-button items-center justify-center text-white px-2 xl:px-3 py-2 rounded-xl hover:opacity-80 transition-opacity text-nowrap">
                                Все события
                            </button>
                        </div>
                        <div class="grid grid-cols-2 md:grid-cols-5 justify-between 3xl:justify-center gap-1 xs:gap-2 xl:gap-3">
                            <div class="relative w-full flex">
                                <input type="date" wire:model.live.debounce.500ms="date" class="text-black not-focus:text-gray-500 focus:text-black pl-4 w-full pr-4 py-2.5 border border-gray-200 rounded-xl focus:outline-none hover:ring-2 hover:ring-[#352AA2] hover:border-transparent focus:ring-2 focus:ring-[#352AA2] focus:border-transparent bg-gray-50 hover:bg-white transition ">
                            </div>
                            <div class="relative flex w-full">
                                <select wire:model.live.debounce.500ms="categoryId" class="pl-4 pr-4 xl:pr-10 py-2.5 text-black not-focus:text-gray-500 border border-gray-200 rounded-xl focus:outline-none hover:ring-2 hover:ring-[#352AA2] hover:border-transparent focus:ring-2 focus:ring-[#352AA2] focus:border-transparent bg-gray-50 hover:bg-white transition appearance-none cursor-pointer text-gray-700 w-full">
                                    <option value="">Категория</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name}}</option>
                                    @endforeach
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-3 flex items-center text-gray-400">
                                    <i class="fas fa-chevron-down text-xs"></i>
                                </div>
                            </div>
                            <div class="relative w-full flex">
                                <select wire:model.live.debounce.500ms="ageRestriction" class="pl-4 pr-4 xl:pr-10 py-2.5 text-black not-focus:text-gray-500 border border-gray-200 rounded-xl focus:outline-none hover:ring-2 hover:ring-[#352AA2] hover:border-transparent focus:ring-2 focus:ring-[#352AA2] focus:border-transparent bg-gray-50 hover:bg-white transition appearance-none cursor-pointer text-gray-700 w-full">
                                    <option value="">Возраст</option>
                                    <option value="0+">0+</option>
                                    <option value="6+">6+</option>
                                    <option value="12+">12+</option>
                                    <option value="16+">16+</option>
                                    <option value="18+">18+</option>
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-3 flex items-center text-gray-400">
                                    <i class="fas fa-chevron-down text-xs"></i>
                                </div>
                            </div>
                            <div class="relative w-full flex">
                                <input type="text" wire:model.live.debounce.500ms="locationSearch" placeholder="Локация" class="w-full pl-4 pr-4 xl:pr-10 py-2.5 text-black not-focus:text-gray-500 border border-gray-200 rounded-xl focus:outline-none hover:ring-2 hover:ring-[#352AA2] hover:border-transparent focus:ring-2 focus:ring-[#352AA2] focus:border-transparent bg-gray-50 hover:bg-white transition placeholder-gray-500">

                                @if(!empty($locationSearch) && $locationResults->count() > 0)
                                    <div class="absolute top-full left-0 right-0 mt-1 bg-white border border-gray-200 rounded-xl shadow-lg z-50 w-full"
                                         style="max-height: 200px; overflow-y: auto;">
                                        @foreach($locationResults as $result)
                                            <div wire:click="selectLocation('{{ $result->type }}_{{ $result->id }}')"
                                                 class="px-4 py-2 hover:bg-gray-100 cursor-pointer transition border-b border-gray-100 last:border-b-0">
                                                {{ $result->name }}
                                                @if($result->address)
                                                    <span class="text-sm text-gray-500">({{ $result->address }})</span>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                            <button wire:click="clearFilters" class="hidden md:block md:col-span-1 gradient-button items-center justify-center text-white px-2 xl:px-3 py-2 rounded-xl hover:opacity-80 transition-opacity text-nowrap">
                                Все события
                            </button>
                        </div>
                    </div>
                </div>
            </div>

        @if($events->isEmpty())
            <div class="text-center py-20">
                <div class="w-24 h-24 bg-blue-50 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-calendar-times text-4xl text-[#352AA2]"></i>
                </div>
                <h3 class="text-2xl font-semibold text-gray-800 mb-2">Нет мероприятий</h3>
                @if($date)
                    <p class="text-gray-500">на дату: {{ \Carbon\Carbon::parse($date)->format('d.m.Y') }}</p>
                @else
                    <p class="text-gray-500">Попробуйте изменить фильтры</p>
                @endif
            </div>
        @else
        @if($date)
            <div>
                <h4 class="text-xl font-semibold text-center">События на {{ \Carbon\Carbon::parse($date)->translatedFormat('d.m.Y') }}</h4>
            </div>
        @endif

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5 3xl:gap-7.5 gap-y-7 xl:gap-y-12">
                @foreach ($events as $event)
                    <div class="card bg-white rounded-[7px] sm:rounded-[20px] overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300">
                        <div class="card-content group p-2 sm:p-5 h-full font-['FindSansPro'] grid grid-rows-subgrid row-span-2 gap-3">
                            <div class="flex flex-col gap-3 xl:gap-5">
                                <div class="relative overflow-hidden rounded-[7px] sm:rounded-[19px]">
                                    <img src="{{ $event->attachments?->get(0)?->url() ?? "" }}" alt="{{ $event->name }}" class="photo rounded-[7px] sm:rounded-[19px] w-full h-50 sm:h-70 md:h-50 3xl:h-81.75 object-cover group-hover:scale-110 transition-transform duration-500">
                                    @if($event->age_restriction)
                                        <span class="absolute right-2 top-2 size-10 xl:size-12 3xl:size-15 bg-[#A855F7] rounded-md xl:rounded-xl flex items-center justify-center text-white text-sm xl:text-base 3xl:text-xl shadow-lg">
                                            {{ $event->age_restriction }} +
                                        </span>
                                    @endif
                                </div>
                                <h2 class="card-title text-start text-lg lg:text-base xl:text-xl 3xl:text-3xl font-bold">
                                    {{$event->name}}</h2>
                                <p class="text-sm xl:text-base text-[#888888] font-light line-clamp-2 h-10 xl:h-12">
                                    {{ $event->description }}
                                </p>
                                <span class="flex items-center text-xs xl:text-sm gap-2 font-medium text-[#5F5F5F]">
                                    <i class="fas fa-calendar"></i>
                                    {{ $event->start_date->translatedFormat('j F Y')}}
                                </span>
                            </div>
                            <div class="flex flex-col justify-end h-full font-['FindSansPro']">
                                @if($event->categories && $event->categories->count() > 0)
                                    <div class="flex flex-wrap gap-1.5 pt-1">
                                        @foreach($event->categories as $category)
                                            <span class="inline-block p-0.5 rounded-full bg-linear-to-r from-[#A556F7] to-[#2663EB]">
                                            <span class="block px-3 py-0.5 text-[10px] xl:text-xs rounded-full"
                                                  style="background: rgba(255,255,255,0.9);">
                                                {{ $category->name }}
                                            </span>
                                        </span>
                                        @endforeach
                                    </div>
                                @endif
                                <div class="flex flex-row justify-between items-end gap-3.5 text-xs xl:text-sm font-light">
                                    <span class="flex items-center gap-1 font-medium text-[#5F5F5F]">
                                        <i class="fas fa-map-marker-alt text-base xl:text-xl"></i>
                                         {{ $event->location->name ?? 'Адрес не указан' }}
                                    </span>
                                    <a href="{{ route('single-event', ['event' => $event->slug]) }}" class="arrow-link shrink-0 size-10 xl:size-11 3xl:size-15 bg-linear-to-r from-[#A556F7] to-[#2663EB] rounded-full flex items-center justify-center hover:opacity-90 hover:scale-110 group/button relative overflow-hidden transition-all duration-300 ease-in-out hover:shadow-lg hover:shadow-purple-500/30">
                                        <img src="/images/Arrow 2.png" alt="Стрелка" class="icon w-2 xl:w-3 3xl:w-4 h-4.5 xl:h-6 3xl:h-7.5 transition-transform duration-300 group-hover/button:translate-x-1">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            @endif
        </div>
    </section>
</div>
