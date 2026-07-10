<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <div class="border-b border-gray-200 px-4 py-3 flex gap-2 justify-center">
        <button
            wire:click="selectType('App\\Models\\Attraction')"
            class="px-4 py-2 text-sm font-medium rounded-lg transition-colors duration-200
           {{ $selectedType === 'App\\Models\\Attraction'
               ? 'bg-blue-600 text-white shadow-sm'
               : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
            Достопримечательности
        </button>

        <button
            wire:click="selectType('App\\Models\\Hotel')"
            class="px-4 py-2 text-sm font-medium rounded-lg transition-colors duration-200
           {{ $selectedType === 'App\\Models\\Hotel'
               ? 'bg-blue-600 text-white shadow-sm'
               : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
            Отели
        </button>

        <button
            wire:click="selectType('App\\Models\\Restaurant')"
            class="px-4 py-2 text-sm font-medium rounded-lg transition-colors duration-200
           {{ $selectedType === 'App\\Models\\Restaurant'
               ? 'bg-blue-600 text-white shadow-sm'
               : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
            Рестораны
        </button>

        <button
            wire:click="selectType('App\\Models\\Excursion')"
            class="px-4 py-2 text-sm font-medium rounded-lg transition-colors duration-200
           {{ $selectedType === 'App\\Models\\Excursion'
               ? 'bg-blue-600 text-white shadow-sm'
               : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
            Экскурсии
        </button>

        <button
            wire:click="selectType('App\\Models\\GuidedTour')"
            class="px-4 py-2 text-sm font-medium rounded-lg transition-colors duration-200
           {{ $selectedType === 'App\\Models\\GuidedTour'
               ? 'bg-blue-600 text-white shadow-sm'
               : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
            Экскурсоводы
        </button>
    </div>

    <div class="p-6 space-y-4">
        @forelse($this->items as $item)
            <div class="group bg-white rounded-xl shadow-sm hover:shadow-md transition-all duration-300 border border-gray-200 hover:border-b-gray-400 overflow-hidden">
                <div class="p-5">
                    <div class="flex items-start justify-between mb-4">
                        <div class="flex items-start gap-3">
                            <h3 class="text-lg font-semibold text-gray-900">{{ $item->name }}</h3>
                        </div>
                    </div>

                    <div class="space-y-3 mb-5">
                        <div class="flex gap-2">
                            <svg class="w-4 h-4 text-gray-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                            </svg>
                            <span class="text-sm text-gray-600 line-clamp-2">{{ $item->description }}</span>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 pt-2">
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                                <a href="tel:{{ $item->phone }}" class="text-sm text-gray-600 hover:text-red-600 transition-colors">
                                    {{ $item->phone }}
                                </a>
                            </div>

                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                <span class="text-sm text-gray-600">{{ $item->address }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-between items-center pt-3 border-t border-gray-100">
                        <a href="{{ $this->getUrl($item) }}"
                           class="inline-flex items-center gap-2 font-medium transition-colors">
                            <span>Подробнее</span>
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center py-12 px-4">
                <p class="text-gray-500 text-lg">Вы еще ничего не смотрели из данной категории</p>
            </div>
        @endforelse
    </div>
    <div class="border-t border-gray-200 px-4 py-3 flex flex-col items-center gap-3">
        {{ $this->items->links() }}
    </div>
</div>
