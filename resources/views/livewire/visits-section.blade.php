<div class="font-['FindSansPro']">
    {{-- Status filter --}}
    @php
        $statuses = [
            'semi-visited' => 'На проверке',
            'visited'      => 'Уже посещали',
        ];
        $items = $this->items;
    @endphp
    <div class="flex flex-wrap justify-center gap-2 sm:gap-3 mb-8">
        @foreach ($statuses as $status => $label)
            <button
                wire:click="selectStatus('{{ $status }}')"
                class="px-4 py-2.5 text-sm font-medium rounded-full transition-all duration-200 cursor-pointer
                {{ $selectedStatus === $status
                    ? 'bg-linear-to-r from-[#A556F7] to-[#2663EB] text-white shadow-md shadow-purple-500/25'
                    : 'bg-[#7676801F] text-gray-700 hover:bg-black hover:text-white' }}">
                {{ $label }}
            </button>
        @endforeach
    </div>

    {{-- Cards grid --}}
    @if ($items->count())
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
            @foreach ($items as $visit)
                @php
                    $item = $visit->visitable;
                    $img = $item->attachments?->first()?->url();
                @endphp
                <div class="group flex flex-col bg-white rounded-2xl overflow-hidden shadow-[0_8px_30px_rgb(0,0,0,0.06)] hover:shadow-[0_16px_44px_rgb(0,0,0,0.14)] transition-all duration-300">
                    <div class="relative h-52 overflow-hidden">
                        @if ($img)
                            <img src="{{ $img }}" alt="{{ $item->name }}"
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        @else
                            <div class="w-full h-full bg-linear-to-br from-[#A556F7]/20 to-[#2663EB]/20 flex items-center justify-center">
                                <i class="fas fa-image text-4xl text-white/70"></i>
                            </div>
                        @endif

                        @if (!is_null($item->rating))
                            <div class="absolute top-3 right-3 flex items-center gap-1 bg-white/95 backdrop-blur px-2.5 py-1 rounded-full text-sm font-semibold text-gray-800 shadow">
                                <i class="fas fa-star text-yellow-400"></i>{{ number_format($item->rating, 1) }}
                            </div>
                        @endif

                        @if ($selectedStatus === 'visited')
                            <div class="absolute top-3 left-3 flex items-center gap-1.5 bg-green-500 px-2.5 py-1 rounded-full text-xs font-semibold text-white shadow-lg">
                                <i class="fas fa-circle-check"></i>Посещено
                            </div>
                        @endif

                        @if (!empty($item->visit_duration))
                            <div class="absolute bottom-3 left-3 flex items-center gap-1.5 bg-black/55 backdrop-blur px-2.5 py-1 rounded-full text-xs font-medium text-white">
                                <i class="fas fa-person-walking"></i>{{ $item->visit_duration }} мин
                            </div>
                        @endif
                    </div>

                    <div class="flex flex-col grow p-5">
                        <h3 class="text-lg font-bold text-gray-900 mb-2 line-clamp-1">{{ $item->name }}</h3>
                        <p class="text-sm text-gray-500 line-clamp-2 mb-5">{{ $item->short_description ?? $item->description }}</p>

                        <div class="mt-auto space-y-2.5">
                            @if ($selectedStatus !== 'visited')
                                <button type="button"
                                        wire:click="confirmVisit({{ $item->id }}, '{{ addslashes(get_class($item)) }}')"
                                        class="flex items-center justify-center gap-2 w-full py-2.5 rounded-xl bg-green-500 text-white text-sm font-semibold hover:bg-green-600 transition-all duration-200 cursor-pointer">
                                    <i class="fas fa-check"></i>
                                    Отметить посещение
                                </button>
                            @endif

                            <a href="{{ $this->getUrl($item->slug, $visit->visitable_type) }}"
                               class="flex items-center justify-center gap-2 w-full py-2.5 rounded-xl bg-linear-to-r from-[#A556F7] to-[#2663EB] text-white text-sm font-semibold hover:shadow-lg hover:shadow-purple-500/30 transition-all duration-200">
                                Подробнее
                                <i class="fas fa-arrow-right text-xs group-hover:translate-x-0.5 transition-transform"></i>
                            </a>

                            @if ($selectedStatus !== 'visited')
                                <button type="button"
                                        wire:click="unconfirmVisit({{ $item->id }}, '{{ addslashes(get_class($item)) }}')"
                                        class="w-full text-center text-xs font-medium text-gray-400 hover:text-red-500 transition-colors cursor-pointer">
                                    Я здесь не был
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="text-center py-16 px-4">
            <div class="inline-flex items-center justify-center size-16 bg-purple-50 rounded-full mb-4">
                <i class="fas fa-map-location-dot text-2xl text-[#A855F7]"></i>
            </div>
            <p class="text-gray-700 text-lg font-semibold">Вы еще нигде не были</p>
            <p class="text-gray-400 text-sm mt-1">Зайдите в мобильное приложение, чтобы отобразились ближайшие места</p>
        </div>
    @endif

    <div class="mt-8">
        {{ $items->links() }}
    </div>
</div>
