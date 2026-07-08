@section('title')
    Саратов 435 - События
@endsection
<section class="features-section pt-28 md:pt-35 xl:pt-31 3xl:pt-41.5 md:pb-15 xl:pb-20 3xl:pb-26 bg-white">
    <div class="max-w-6xl 3xl:max-w-421 mx-auto px-4 sm:px-10">
        <div class="text-center mb-12">
            <h2>События</h2>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                Открой для себя лучшие события в Саратове
            </p>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-8">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 font-['FindSansPro'] text-xs sm:text-base">
                <div class="flex flex-wrap items-center gap-3 w-full md:w-auto text-gray-500">
                    <div class="relative flex-1 md:flex-none text-black">
                        <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-500"></i>
                        <input type="text" wire:model.live="search" placeholder="Поиск..." class="pl-10 pr-4 py-2.5 border border-gray-200 rounded-xl focus:outline-none hover:ring-2 hover:ring-[#352AA2] hover:border-transparent focus:ring-2 focus:ring-[#352AA2] focus:border-transparent w-full md:w-56 bg-gray-50 hover:bg-white transition placeholder-gray-500">
                    </div>

                    <div class="relative">
                        <input type="date" wire:model.live="date" class="text-black not-focus:text-gray-500 focus:text-black pl-4 pr-4 py-2.5 border border-gray-200 rounded-xl focus:outline-none hover:ring-2 hover:ring-[#352AA2] hover:border-transparent focus:ring-2 focus:ring-[#352AA2] focus:border-transparent bg-gray-50 hover:bg-white transition ">
                    </div>
                    <div class="relative">
                        <select wire:model.live="categoryId" class="pl-4 pr-10 py-2.5 border border-gray-200 rounded-xl focus:outline-none hover:ring-2 hover:ring-[#352AA2] hover:border-transparent focus:ring-2 focus:ring-[#352AA2] focus:border-transparent bg-gray-50 hover:bg-white transition appearance-none cursor-pointer text-gray-700">
                            <option value="">Все категории</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-3 flex items-center text-gray-400">
                            <i class="fas fa-chevron-down text-xs"></i>
                        </div>
                    </div>
                </div>

                <button wire:click="clearFilters" class="gradient-button text-white px-1 lg:px-3 py-1 lg:py-2 rounded-[3px] sm:rounded-lg hover:opacity-80 transition-opacity ">
                    Все мероприятия
                </button>
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
                <div class="mb-6">
                    <h4 class="text-xl font-semibold text-gray-800">События на {{ \Carbon\Carbon::parse($date)->translatedFormat('d.m.Y') }}</h4>
                </div>
            @endif
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5 3xl:gap-7.5 gap-y-2 xl:gap-y-12">
                @foreach($events as $event)
                    <div class="card bg-white rounded-[7px] sm:rounded-[19px] overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300">
                        <div class="card-content p-5 relative grid grid-rows-subgrid content-between row-span-2 gap-3 h-full">
                            <div class="flex flex-col gap-5">
                                <div class="relative">
                                    <img src="{{ $event->attachments?->get(0)?->url() ?? "" }}" alt="{{ $event->name }}" class="photo rounded-[7px] sm:rounded-[19px] w-full h-50 3xl:h-81.75 object-cover">
                                    <div class="absolute top-1 right-6.5 sm:top-10 sm:right-9.5 size-10 xl:size-12 3xl:size-15 bg-[#352AA2] rounded-md xl:rounded-xl flex flex-col items-center justify-center text-white shadow-lg">
                                        <span class="text-xs xl:text-sm font-bold leading-tight">{{ $event->start_date->format('d') }}</span>
                                        <span class="text-[8px] xl:text-[10px] uppercase opacity-90 leading-tight">{{ $event->start_date->translatedFormat('M') }}</span>
                                    </div>
                                </div>

                                <h2 class="card-title text-center text-lg lg:text-xl 3xl:text-3xl font-bold line-clamp-2">{{ $event->name }}</h2>
                            </div>

                            <div class="flex flex-col justify-between h-full">
                                <div class="flex flex-col justify-end text-sm lg:text-base xl:text-lg 3xl:text-2xl font-light gap-3 text-[#5F5F5F] mb-2 lg:mb-6">
                                    <p class="text-center">
                                        {{ $event->start_date->format('H:i') }}
                                        @if($event->end_date)
                                            - {{ $event->end_date->format('H:i') }}
                                        @endif
                                    </p>

                                    @if($event->address)
                                        <span class="flex items-center gap-3.5">
                                            <i class="fas fa-map-marker-alt"></i>
                                            {{ $event->address }}
                                        </span>
                                    @endif

                                    @if($event->age_restriction)
                                        <span class="flex items-center gap-3.5">
                                            <i class="fas fa-user"></i>
                                            {{ $event->age_restriction }}+
                                        </span>
                                    @endif

                                    @if($event->categories && $event->categories->count() > 0)
                                        <div class="flex flex-wrap gap-1.5 pt-1">
                                            @foreach($event->categories as $category)
                                                <span class="text-[10px] xl:text-xs px-2 py-0.5 rounded-full"
                                                      style="background-color: {{ $category->color ?? '#352AA2' }}20; color: {{ $category->color ?? '#352AA2' }}">
                                                    @if($category->icon)
                                                        <i class="{{ $category->icon }}"></i>
                                                    @endif
                                                    {{ $category->name }}
                                                </span>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>

                                <a href="{{ route('single-event', ['event' => $event->slug]) }}" class="w-full gradient-button text-white text-sm sm:text-base xl:text-xl py-1 lg:py-2 rounded-lg hover:opacity-90 transition-opacity text-center">
                                    Подробнее
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="mt-12 flex justify-center">
                {{ $events->links() }}
            </div>
        @endif
    </div>
</section>

