<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Настройки профиля
        </h2>
    </x-slot>

    <div class="py-12 font-['FindSansPro']">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
            <div class="p-6 sm:p-8 bg-white rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.06)]">
                <livewire:profile.update-profile-information-form />
            </div>

            @if(!auth()->user()->haveFakeVkEmail())
                <div class="p-6 sm:p-8 bg-white rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.06)]">
                    <h2 class="text-xl font-bold text-gray-900">Социальные сети</h2>
                    <p class="mt-1 text-sm text-gray-500">
                        Привяжите аккаунт ВКонтакте для быстрого входа.
                    </p>
                        <div class="mt-6">
                            <livewire:profile.vk-connect />
                        </div>
                </div>
            @endif

            <div class="p-6 sm:p-8 bg-white rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.06)]">
                <livewire:profile.update-password-form />
            </div>
        </div>
    </div>
</x-app-layout>
