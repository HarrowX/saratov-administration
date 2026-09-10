<div class="fixed z-50">
    @if($isOpen)
        <style>
            body { overflow: hidden !important; }
        </style>
        <div wire:click="close" class="fixed inset-0 bg-black/40 backdrop-blur-sm z-100 transition-opacity duration-300" style="animation: fadeIn 0.6s ease-out;"></div>
    @endif

    <div class="fixed top-0 right-0 z-100 h-full w-full lg:max-w-150 bg-white shadow-2xl transition-transform duration-300 ease-in-out overflow-hidden font-['FindSansPro'] overflow-y-auto"
        style="transform: translateX({{ $isOpen ? '0%' : '100%' }});">
        <div class="px-3 sm:px-6 mt-20 3xl:mt-25 py-6 flex gap-2 items-center justify-between">
            <button wire:click="close" class="flex items-center justify-center p-2 bg-[#5483ea29] text-[#2663EB] hover:scale-110 rounded-full transition-transform duration-300">
                <i class="fas fa-arrow-right-long text-xl"></i>
            </button>
            <h2 class="text-lg font-bold text-black mb-0!">Уведомления</h2>
        </div>

        <div class="sticky top-20 3xl:top-23 bg-white z-100 flex flex-col lg:flex-row gap-4 lg:gap-0 items-start lg:items-center justify-between px-3 sm:px-6 py-3">
            <div class="flex gap-2">
                <button wire:click="$set('filter', 'all')"
                        class="px-3 py-1.5 rounded-full text-sm 3xl:text-lg font-medium transition-all {{ $filter === 'all' ? 'bg-[#2663EB] text-white' : 'text-gray-500 hover:bg-gray-100' }}">
                    Все
                </button>
                <button wire:click="$set('filter', 'unread')"
                        class="px-3 py-1.5 rounded-full text-sm 3xl:text-lg font-medium transition-all {{ $filter === 'unread' ? 'bg-[#2663EB] text-white' : 'text-gray-500 hover:bg-gray-100' }}">
                    <span class="relative">
                        <span class="relative">Новые</span>
                        <span class="pl-3 absolute">
                            <livewire:notification-counter />
                        </span>
                    </span>
                </button>
                <button wire:click="$set('filter', 'important')"
                        class="px-3 py-1.5 rounded-full text-sm 3xl:text-lg font-medium transition-all {{ $filter === 'important' ? 'bg-[#2663EB] text-white' : 'text-gray-500 hover:bg-gray-100' }}">
                    Важные
                </button>
            </div>
            <div class="flex items-center self-end lg:self-auto gap-2">
                <button wire:click="markAllAsRead"
                        @if($unreadCount == 0) disabled @endif class="self-end text-xs px-2 py-1 rounded-full transition-all duration-300 text-nowrap
                        {{ $unreadCount > 0 ? 'bg-[#5483ea29] hover:opacity-65 text-[#2663EB] cursor-pointer' : 'bg-gray-100 text-gray-400 cursor-not-allowed!' }}">
                    Прочитать всё
                </button>
                <button wire:click="deleteAllRead"
                        @if(!$hasRead) disabled @endif
                        wire:confirm="Удалить все прочитанные уведомления?"
                        class="self-end text-xs px-2 py-1 rounded-full transition-all duration-300 text-nowrap
                        {{ $hasRead ? 'bg-red-100 text-red-400 hover:opacity-65 cursor-pointer' : 'bg-gray-100 text-gray-400 cursor-not-allowed!' }}">
                    Очистить
                </button>
            </div>
        </div>

        <div class="px-3 sm:px-6 py-4">
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

                            <div class="flex flex-col gap-4">
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
                @if($hasMore)
                    <div class="mt-4 text-center">
                        <button wire:click="loadMore" wire:loading.attr="disabled" class="text-sm text-[#2663EB] hover:text-[#1a4f9e] transition-colors duration-300 font-medium">
                            <span wire:remove>
                                <i class="fas fa-chevron-down mr-1"></i> Показать ещё
                            </span>
                        </button>
                    </div>
                @else
                    @if($totalCount > 5)
                        <div class="mt-4 text-center">
                            <span class="text-xs text-gray-400">Все уведомления загружены</span>
                        </div>
                    @endif
                @endif
            @else
                <div class="text-center py-12">
                    @if($filter === 'all')
                        <div class="inline-flex items-center justify-center size-16 bg-[#5483ea29] rounded-full mb-4">
                            <i class="fa-solid fa-bell text-2xl text-[#2663EB]"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-700">Нет уведомлений</h3>
                        <p class="text-sm text-gray-400 mt-1">Здесь будут отображаться все ваши уведомления</p>
                    @elseif($filter === 'unread')
                        <div class="inline-flex items-center justify-center size-16 bg-[#5483ea29] rounded-full mb-4">
                            <i class="fa-solid fa-bell text-2xl text-[#2663EB]"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-700">Все уведомления прочитаны!</h3>
                        <p class="text-sm text-gray-400 mt-1">Отличная работа! Новые уведомления появятся здесь</p>
                    @else
                        <div class="inline-flex items-center justify-center size-16 bg-[#5483ea29] rounded-full mb-4">
                            <i class="fa-solid fa-bell text-2xl text-[#2663EB]"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-700">Нет важных уведомлений</h3>
                        <p class="text-sm text-gray-400 mt-1">Важные уведомления будут отображаться здесь</p>
                    @endif
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
