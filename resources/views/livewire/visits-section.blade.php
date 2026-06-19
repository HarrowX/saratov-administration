<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <div class="border-b border-gray-200 px-4 py-3 flex gap-2 justify-center">
        <button
            wire:click="selectStatus('semi-visited')"
            class="px-4 py-2 text-sm font-medium rounded-lg transition-colors duration-200
           {{ $selectedStatus === 'semi-visited'
               ? 'bg-blue-600 text-white shadow-sm'
               : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
            В проверке
        </button>

        <button
            wire:click="selectStatus('visited')"
            class="px-4 py-2 text-sm font-medium rounded-lg transition-colors duration-200
           {{ $selectedStatus === 'visited'
               ? 'bg-blue-600 text-white shadow-sm'
               : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
            Посещенные
        </button>
    </div>

    <div class="p-6 space-y-4">
        @forelse($this->items as $visit)
            @php
            $item = $visit->visitable;
            @endphp
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
                        <a href="{{ $this->getUrl($item->slug, $visit->visitable_type) }}"
                           class="inline-flex items-center gap-2 font-medium transition-colors">
                            <span>Подробнее</span>
                        </a>

                        @if ($selectedStatus !== "visited")
                            <div class="flex gap-3">
                            <button type="button"
                                    wire:click="confirmVisit({{ $item->id }}, '{{ addslashes(get_class($item)) }}')"
                                    class="group/btn px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 border border-green-600 transition-all duration-200 flex items-center gap-2 shadow-sm hover:shadow-md">
                                <svg class="w-4 h-4 group-hover/btn:scale-110 transition-transform" fill="none" stroke="currentColor"viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                <span>Да посещал</span>
                            </button>

                            <button type="button"
                                    wire:click="unconfirmVisit({{ $item->id }}, '{{ addslashes(get_class($item)) }}')"
                                    class="group/btn px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 border border-gray-300 transition-all duration-200 flex items-center gap-2">
                                <svg class="w-4 h-4 group-hover/btn:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                                <span>Нет, не посещал</span>
                            </button>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center py-12 px-4">
                <p class="text-gray-500 text-lg">Вы еще нигде небыли</p>
                <p class="text-gray-400 text-sm mt-1">Зайдите в мобильное приложение, чтобы отобразились ближайшие места</p>
            </div>
        @endforelse
    </div>
    <div class="border-t border-gray-200 px-4 py-3 flex flex-col items-center gap-3">
        {{ $this->items->links() }}
    </div>
</div>
