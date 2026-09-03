<div class="fixed z-50">
    @if($isOpen)
        <style>
            body { overflow: hidden !important; }
        </style>
        <div wire:click="close" class="fixed inset-0 bg-black/40 backdrop-blur-sm z-100 transition-opacity duration-300" style="animation: fadeIn 0.6s ease-out;"></div>
    @endif

    <div class="fixed top-0 right-0 z-100 h-full w-full max-w-150 bg-white shadow-2xl transition-transform duration-300 ease-in-out overflow-hidden font-['FindSansPro'] overflow-y-auto"
        style="transform: translateX({{ $isOpen ? '0%' : '100%' }});">
        <div class="px-6 mt-20 py-6 flex gap-2 items-center justify-between">
            <button wire:click="close" class="flex items-center justify-center p-2 bg-[#5483ea29] text-[#2663EB] hover:scale-110 rounded-full transition-transform duration-300">
                <i class="fas fa-arrow-left-long text-xl"></i>
            </button>
            <h2 class="text-lg font-bold text-black mb-0!">Уведомления</h2>
        </div>

        <div class="sticky top-20 bg-white z-100 flex flex-col lg:flex-row gap-3 lg:gap-0 items-start lg:items-center justify-between px-6 py-3">
            <div class="flex gap-1">
                <button wire:click="$set('filter', 'all')"
                        class="px-3 py-1.5 rounded-full text-xs sm:text-sm font-medium transition-all {{ $filter === 'all' ? 'bg-[#2663EB] text-white' : 'text-gray-500 hover:bg-gray-100' }}">
                    Все
                </button>
                <button wire:click="$set('filter', 'unread')"
                        class="px-3 py-1.5 rounded-full text-xs sm:text-sm font-medium transition-all {{ $filter === 'unread' ? 'bg-[#2663EB] text-white' : 'text-gray-500 hover:bg-gray-100' }}">
                    Новые
                    @if($unreadCount > 0)
                        <span class="ml-1 bg-red-400 text-white text-[10px] px-1.5 py-0.5 rounded-full">{{ $unreadCount }}</span>
                    @endif
                </button>
                <button wire:click="$set('filter', 'important')"
                        class="px-3 py-1.5 rounded-full text-xs sm:text-sm font-medium transition-all {{ $filter === 'important' ? 'bg-[#2663EB] text-white' : 'text-gray-500 hover:bg-gray-100' }}">
                    Важные
                </button>
            </div>
            @if($unreadCount > 1)
                <button wire:click="markAllAsRead" class="self-end text-xs sm:text-sm px-3 py-1.5 rounded-full bg-[#5483ea29] text-[#2663EB] transition-colors duration-300 text-nowrap">
                     Прочитать всё
                </button>
            @endif
            @if($hasRead)
                <button wire:click="deleteAllRead" wire:confirm="Удалить все прочитанные уведомления?" class="self-end text-xs sm:text-sm px-3 py-1.5 rounded-full bg-[#5483ea29] text-[#2663EB] transition-colors duration-300 text-nowrap">
                     Очистить
                </button>
            @endif

        </div>

        <div class="px-4 py-4">
            @if($notifications->count() > 0)
                @foreach($groups as $groupKey => $groupNotifications)
                    @if($groupNotifications->isNotEmpty())
                        <div class="mb-4">
                            <div class="flex items-center gap-2 mb-2">
                                <span class="text-xs text-gray-300 uppercase tracking-wider">
                                    @if($groupKey === 'today') Сегодня
                                    @elseif($groupKey === 'yesterday') Вчера
                                    @else Ранее
                                    @endif
                                </span>
                                <span class="h-px flex-1 bg-gray-100"></span>
                            </div>

                            <div class="flex flex-col gap-2">
                                @foreach($groupNotifications as $notification)
                                    <livewire:notification-item
                                        :notification="$notification"
                                        wire:key="notification-{{ $notification->id }}"
                                        :is-drawer="true"
                                    />
                                @endforeach
                            </div>
                        </div>
                    @endif
                @endforeach

                <div class="mt-4">
                    {{ $notifications->links('livewire::tailwind') }}
                </div>
            @else
                <div class="text-center py-12">
                    <div class="inline-flex items-center justify-center size-16 bg-purple-50 rounded-full mb-4">
                        <i class="fa-solid fa-bell text-2xl text-[#A855F7]"></i>
                    </div>
                    <h3 class="text-sm font-semibold text-gray-700">Нет уведомлений</h3>
                    <p class="text-xs text-gray-400 mt-1">Здесь будут отображаться ваши уведомления</p>
                </div>
            @endif
        </div>
    </div>
    @if(!$isOpen)
        <style>
            body { overflow: auto !important; }
        </style>
    @endif

    <style>
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
    </style>
</div>
