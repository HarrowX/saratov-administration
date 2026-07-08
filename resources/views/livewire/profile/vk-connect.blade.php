<div class="flex items-center justify-between p-4 bg-white border border-gray-200 rounded-lg shadow-sm">
    <div class="flex items-center space-x-4">
        @if($vkAvatar)
            <img src="{{ $vkAvatar }}" alt="VK Avatar" class="w-12 h-12 rounded-full object-cover border-2 border-blue-500">
        @else
            <img src="{{ asset('images/vk-icon.svg') }}" alt="VK" class="w-7 h-7">
        @endif

        <div>
            <h3 class="text-lg font-medium text-gray-900">ВКонтакте</h3>
            <p class="text-sm {{ $vkConnected ? 'text-green-600' : 'text-gray-500' }}">
                {{ $vkConnected ? '✓ Аккаунт привязан' : 'Не привязан' }}
            </p>
        </div>
    </div>

    <div>
        @if($vkConnected)
            <form action="{{ route('profile.disconnect.vk') }}" method="POST"
                  onsubmit="return confirm('Вы уверены, что хотите отвязать аккаунт VK?')">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded-md transition-colors duration-200">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                    Отвязать
                </button>
            </form>
        @else
            <a href="{{ route('profile.connect.vk') }}"
               class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-md transition-colors duration-200">
                Привязать VK
            </a>
        @endif
    </div>
</div>
