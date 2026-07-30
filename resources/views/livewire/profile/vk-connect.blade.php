<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 p-4 bg-gray-50/60 border border-gray-100 rounded-xl font-['FindSansPro']">
    <div class="flex items-center gap-4 min-w-0">
        @if($vkAvatar)
            <img src="{{ $vkAvatar }}" alt="VK Avatar" class="icon w-12 h-12 rounded-full object-cover border-2 border-blue-500 shrink-0">
        @else
            <img src="{{ asset('images/vk-icon.svg') }}" alt="VK" class="icon w-9 h-9 shrink-0">
        @endif

        <div class="min-w-0">
            <h3 class="text-lg font-medium text-gray-900">ВКонтакте</h3>
            <p class="text-sm {{ $vkConnected ? 'text-green-600' : 'text-gray-500' }}">
                {{ $vkConnected ? '✓ Аккаунт привязан' : 'Не привязан' }}
            </p>
        </div>
    </div>

    <div class="shrink-0">
        @if($vkConnected)
            <form action="{{ route('profile.disconnect.vk') }}" method="POST"
                  onsubmit="return confirm('Вы уверены, что хотите отвязать аккаунт VK?')">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="w-full sm:w-auto inline-flex items-center justify-center px-4 py-2.5 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded-xl transition-colors duration-200">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                    Отвязать
                </button>
            </form>
        @else
            <a href="{{ route('profile.connect.vk') }}"
               class="w-full sm:w-auto inline-flex items-center justify-center px-4 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-xl transition-colors duration-200">
                Привязать VK
            </a>
        @endif
    </div>
</div>
