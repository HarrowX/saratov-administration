@php
    $isRead = $notification->read_at !== null;
    $isImportant = !empty($notification->data['important'] ?? false);
    $hasImage = !empty($notification->data['image'] ?? null);
    $cardClass = $isRead ? 'bg-gray-50/50 border border-gray-100':'bg-linear-to-r from-purple-50/50 to-blue-50/50 border border-purple-100/50 shadow-sm';

    $iconBg = $isRead ? 'bg-gray-100 text-gray-400': $this->iconColor ;

    $bodyText = $notification->data['body'] ?? '';
    $charCount = mb_strlen($bodyText);
    $isLongText = $charCount > 100;
    $shortBody = $isLongText ? mb_substr($bodyText, 0, 100) . '...' : $bodyText;

    $buttonColor = $isRead ? 'text-gray-400 hover:text-gray-500' : 'text-[#4a7bbd] hover:text-[#33316b]';
@endphp

<div x-data="{ expanded: false }" class="flex justify-between items-start rounded-xl p-2 gap-1 sm:gap-4 transition-all {{ $cardClass }}">
    <div class="flex items-start gap-3 flex-1 min-w-0">
        <div class="size-7 sm:size-10 text-sm sm:text-base rounded-lg shrink-0 mt-0.5 flex items-center justify-center {{ $iconBg }}">
            @if($hasImage)
                <img src="{{ $notification->data['image'] }}" class="size-10 rounded-lg object-cover" alt="Иконка">
            @else
                <i class="fas {{ $this->icon }}"></i>
            @endif
        </div>

        <div class="flex-1 min-w-0">
            <div class="flex justify-between items-start gap-2">
                <span class="text-base 3xl:text-xl font-semibold sm:max-w-85 font-['Merriweather'] {{ $isRead ? 'text-gray-500' : '' }}">
                    {{ $notification->data['title'] ?? 'Уведомление' }}
                </span>
                @if(!$isRead)
                    <button wire:click="markAsRead('{{ $notification->id }}')"
                            class="text-[10px] 3xl:text-sm leading-5 text-nowrap bg-[#5483ea29] text-[#2663EB] hover:opacity-65 px-1.5 rounded-full transition-all duration-300 hidden lg:block">
                        <i class="fas fa-check"></i> Прочитать
                    </button>
                @endif
            </div>

            <div>
                @if($isLongText)
                    <p x-show="!expanded" class="text-xs 3xl:text-base font-['Inter'] {{ $isRead ? 'text-gray-400' : 'text-gray-600' }}">
                        {{ $shortBody }}
                    </p>
                    <p x-show="expanded" x-collapse class="text-xs 3xl:text-base font-['Inter'] {{ $isRead ? 'text-gray-400' : 'text-gray-600' }}">
                        {{ $bodyText }}
                    </p>
                    <button @click="expanded = !expanded" class="inline-flex items-center gap-1 text-xs 3xl:text-base transition-colors duration-300 mt-1 mr-5 lg:mr-0 font-medium {{ $isRead ? 'text-gray-400 hover:text-gray-500' : 'text-[#4a7bbd] hover:text-[#33316b]' }}">
                        <span x-show="!expanded">
                            <i class="fas fa-chevron-down text-[10px] 3xl:text-xs"></i>
                            <span>Далее</span>
                        </span>
                        <span x-show="expanded">
                            <i class="fas fa-chevron-up text-[10px] 3xl:text-xs"></i>
                            <span>Свернуть</span>
                        </span>
                    </button>
                @else
                    <p class="text-xs 3xl:text-base font-['Inter'] {{ $isRead ? 'text-gray-400' : 'text-gray-600' }} mt-0.5">
                        {{ $notification->data['body'] ?? '' }}
                    </p>
                @endif
                <button wire:click="markAsRead('{{ $notification->id }}')"
                        class="text-[10px] leading-5 text-nowrap bg-[#5483ea29] text-[#2663EB] hover:opacity-65 px-1.5 rounded-full transition-all duration-300 lg:hidden">
                    <i class="fas fa-check"></i> Прочитать
                </button>
            </div>

        </div>
    </div>

    <div class="flex flex-col justify-between items-end self-stretch gap-1">
        <span class="text-[10px] leading-5 {{ $isRead ? 'text-gray-300' : 'text-gray-400' }}">
            {{ $notification->created_at->format('H:i') }}
        </span>
        <button wire:click="deleteNotification('{{ $notification->id }}')"
                class="text-lg text-gray-400 hover:text-red-400 transition-colors duration-300">
            <i class="fas fa-trash-can"></i>
        </button>
    </div>
</div>
