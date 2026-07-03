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
            <div>
                <h4>События на {{ \Carbon\Carbon::parse($date)->format('d.m.Y') }}</h4>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($events as $event)
                    <div class="group bg-white rounded-2xl shadow-sm hover:shadow-2xl transition-all duration-300 overflow-hidden hover:-translate-y-1 border border-gray-100">
                        <div class="flex p-5 gap-4">
                            <div class="shrink-0 w-14 h-14 rounded-xl bg-linear-to-r from-[#A556F7] to-[#2663EB] flex flex-col items-center justify-center text-white shadow-lg">
                                <span class="text-xl font-bold leading-none">{{ $event->start_date->format('d') }}</span>
                                <span class="text-[10px] uppercase tracking-wider opacity-90">{{ $event->start_date->translatedFormat('M') }}</span>
                            </div>
                            <div class="flex-1 min-w-0">
                                <h3 class="text-base font-bold text-gray-800 group-hover:text-[#352AA2] transition line-clamp-1">
                                    {{ $event->name }}
                                </h3>

                                <div class="flex items-center gap-3 mt-1">
                                <span class="text-xs text-gray-500 flex items-center gap-1">
                                    <i class="far fa-clock"></i>
                                    {{ $event->start_date->format('H:i') }}
                                    @if($event->end_date)
                                        - {{ $event->end_date->format('H:i') }}
                                    @endif
                                </span>
                                </div>
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

