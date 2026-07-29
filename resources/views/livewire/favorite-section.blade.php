<div class="font-['FindSansPro']">
    {{-- Category filter --}}
    @php
        $tabs = [
            'App\\Models\\Attraction' => 'Достопримечательности',
            'App\\Models\\Hotel'      => 'Отели',
            'App\\Models\\Restaurant' => 'Рестораны',
            'App\\Models\\Excursion'  => 'Экскурсии',
            'App\\Models\\GuidedTour' => 'Экскурсоводы',
        ];
        $items = $this->items;
    @endphp
    <div class="flex flex-wrap justify-center gap-2 sm:gap-3 mb-8">
        @foreach ($tabs as $type => $label)
            <button
                wire:click="selectType('{{ addslashes($type) }}')"
                class="px-4 py-2.5 text-sm font-medium rounded-full transition-all duration-200 cursor-pointer
                {{ $selectedType === $type
                    ? 'bg-linear-to-r from-[#A556F7] to-[#2663EB] text-white shadow-md shadow-purple-500/25'
                    : 'bg-[#7676801F] text-gray-700 hover:bg-black hover:text-white' }}">
                {{ $label }}
            </button>
        @endforeach
    </div>

    {{-- Cards grid --}}
    @if ($items->count())
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
            @foreach ($items as $item)
                @php $img = $item->attachments?->first()?->url(); @endphp
                <div class="group flex flex-col bg-white rounded-2xl overflow-hidden shadow-[0_8px_30px_rgb(0,0,0,0.06)] hover:shadow-[0_16px_44px_rgb(0,0,0,0.14)] transition-all duration-300">
                    {{-- Media --}}
                    <div class="relative h-52 overflow-hidden">
                        @if ($img)
                            <img src="{{ $img }}" alt="{{ $item->name }}"
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        @else
                            <div class="w-full h-full bg-linear-to-br from-[#A556F7]/20 to-[#2663EB]/20 flex items-center justify-center">
                                <i class="fas fa-image text-4xl text-white/70"></i>
                            </div>
                        @endif

                        {{-- Favorite marker --}}
                        <div class="absolute top-3 left-3 size-10 bg-[#A855F7] rounded-xl flex items-center justify-center text-white shadow-lg">
                            <i class="fas fa-heart"></i>
                        </div>

                        {{-- Rating --}}
                        @if (!is_null($item->rating))
                            <div class="absolute top-3 right-3 flex items-center gap-1 bg-white/95 backdrop-blur px-2.5 py-1 rounded-full text-sm font-semibold text-gray-800 shadow">
                                <i class="fas fa-star text-yellow-400"></i>{{ number_format($item->rating, 1) }}
                            </div>
                        @endif

                        {{-- Meta badges --}}
                        @if (!empty($item->visit_duration))
                            <div class="absolute bottom-3 left-3 flex items-center gap-1.5 bg-black/55 backdrop-blur px-2.5 py-1 rounded-full text-xs font-medium text-white">
                                <i class="fas fa-person-walking"></i>{{ $item->visit_duration }} мин
                            </div>
                        @endif
                    </div>

                    {{-- Body --}}
                    <div class="flex flex-col grow p-5">
                        <h3 class="text-lg font-bold text-gray-900 mb-2 line-clamp-1">{{ $item->name }}</h3>
                        <p class="text-sm text-gray-500 line-clamp-2 mb-5">{{ $item->short_description ?? $item->description }}</p>

                        <div class="mt-auto space-y-2.5">
                            <a href="{{ $this->getUrl($item) }}"
                               class="flex items-center justify-center gap-2 w-full py-2.5 rounded-xl bg-linear-to-r from-[#A556F7] to-[#2663EB] text-white text-sm font-semibold hover:shadow-lg hover:shadow-purple-500/30 transition-all duration-200">
                                Подробнее
                                <i class="fas fa-arrow-right text-xs group-hover:translate-x-0.5 transition-transform"></i>
                            </a>

                            <form wire:submit="unfavorite({{ $item->id }})">
                                @csrf
                                <button type="submit"
                                        class="flex items-center justify-center gap-2 w-full py-2.5 rounded-xl bg-white text-red-500 text-sm font-semibold border border-red-200 hover:bg-red-50 transition-all duration-200 cursor-pointer">
                                    <i class="fas fa-trash-can"></i>
                                    Удалить из избранного
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="text-center py-16 px-4">
            <div class="inline-flex items-center justify-center size-16 bg-purple-50 rounded-full mb-4">
                <i class="far fa-heart text-2xl text-[#A855F7]"></i>
            </div>
            <p class="text-gray-700 text-lg font-semibold">Вы еще ничего не добавили в избранное</p>
            <p class="text-gray-400 text-sm mt-1">Начните добавлять места, которые вам нравятся</p>
        </div>
    @endif

    <div class="mt-8">
        {{ $items->links() }}
    </div>
</div>
