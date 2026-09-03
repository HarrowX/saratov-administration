@php
    $isRead = $notification->read_at !== null;
    $isImportant = !empty($notification->data['important'] ?? false);
    $hasImage = !empty($notification->data['image'] ?? null);
    $cardClass = $isRead ? 'bg-gray-50/50 border border-gray-100':'bg-linear-to-r from-purple-50/50 to-blue-50/50 border border-purple-100/50 shadow-sm';

    $iconBg = $isRead ? 'bg-gray-100 text-gray-400':'bg-linear-to-br from-[#A556F7] to-[#2663EB] text-white';
@endphp

<div class="flex justify-between items-start rounded-xl p-2 group transition-all {{ $cardClass }}">
    <div class="flex items-start gap-4 flex-1 min-w-0">
        <div class="size-10 rounded-lg shrink-0 mt-0.5 flex items-center justify-center shadow-md {{ $iconBg }}">
            @if($hasImage)
                <img src="{{ $notification->data['image'] }}" class="size-10 rounded-lg object-cover" alt="Иконка">
            @else
                <i class="fas fa-bell"></i>
            @endif
        </div>

        <div class="flex-1 min-w-0">
            <div class="flex flex-wrap items-center gap-2">
                <span class="text-base font-semibold font-['Merriweather'] {{ $isRead ? 'text-gray-500' : '' }}">
                    {{ $notification->data['title'] ?? 'Уведомление' }}
                </span>
                <span class="text-xs {{ $isRead ? 'text-gray-300' : 'text-gray-400' }}">
                    {{ $notification->created_at->format('H:i') }}
                </span>

                @if($isImportant)
                    <span class="text-xs bg-yellow-100 text-yellow-700 px-2 py-0.5 rounded-full">
                        <i class="fas fa-star mr-0.5"></i> Важное
                    </span>
                @endif

            </div>

            <p class="text-sm font-['Inter'] {{ $isRead ? 'text-gray-400' : 'text-gray-600' }} mt-0.5">
                {{ $notification->data['body'] ?? '' }}
            </p>
        </div>
    </div>

    <div class="flex flex-col justify-center gap-1 ml-4">
        <div class="flex flex-row gap-3">
            @if(!$isRead)
                <button wire:click="markAsRead('{{ $notification->id }}')"
                        class="text-xs text-[#4a7bbd] hover:text-[#33316b] transition-color duration-300">
                    <i class="fas fa-check"></i> Прочитать
                </button>
            @endif
        </div>
        <button wire:click="deleteNotification('{{ $notification->id }}')"
                class="text-[10px] text-gray-400 hover:text-red-500 transition-colors">
            <i class="fas fa-trash-can"></i>
        </button>
    </div>
</div>
