<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Профиль
        </h2>
    </x-slot>

    <div class="py-12 font-['FindSansPro']">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            @php
                $user = auth()->user();
                $name = $user->username->name;
                $surname = $user->username->surname;
                $patronymic = $user->username->patronymic;
                $phone = $user->phone;
                $email = $user->email;
                $initials = mb_strtoupper(mb_substr($surname ?? '', 0, 1) . mb_substr($name ?? '', 0, 1));
            @endphp

            <div class="bg-white rounded-2xl overflow-hidden shadow-[0_8px_30px_rgb(0,0,0,0.06)]">
                {{-- Hero --}}
                <div class="relative h-32 bg-linear-to-r from-[#A556F7] to-[#2663EB]"></div>

                <div class="relative z-10 px-6 sm:px-10 pb-10">
                    <div class="flex flex-col sm:flex-row sm:items-center gap-5">
                        <div class="size-28 rounded-full bg-white p-1.5 shadow-lg shrink-0 mx-auto sm:mx-0 -mt-16">
                            <div class="size-full rounded-full bg-linear-to-br from-[#A556F7] to-[#2663EB] flex items-center justify-center text-white text-3xl font-bold">
                                {{ $initials ?: '👤' }}
                            </div>
                        </div>
                        <div class="text-center sm:text-left">
                            <h3 class="text-2xl font-bold text-gray-900">{{ trim("$surname $name") ?: 'Пользователь' }}</h3>
                            <p class="text-gray-400 text-sm">{{ $email }}</p>
                        </div>
                        <a href="{{ route('profile-settings') }}" wire:navigate
                           class="sm:ml-auto inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-xl bg-linear-to-r from-[#A556F7] to-[#2663EB] text-white text-sm font-semibold hover:shadow-lg hover:shadow-purple-500/30 transition-all duration-200">
                            <i class="fas fa-pen"></i>
                            Редактировать
                        </a>
                    </div>

                    {{-- Info grid --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-8">
                        @php
                            $rows = [
                                ['Фамилия', $surname, 'fa-user'],
                                ['Имя', $name, 'fa-user'],
                                ['Отчество', $patronymic, 'fa-user'],
                                ['Телефон', $phone, 'fa-phone'],
                                ['Электронная почта', $email, 'fa-envelope'],
                            ];
                        @endphp
                        @foreach ($rows as [$label, $value, $icon])
                            <div class="flex items-center gap-4 p-4 rounded-xl bg-gray-50/80 border border-gray-100">
                                <div class="size-10 rounded-lg bg-white flex items-center justify-center text-[#A855F7] shadow-sm shrink-0">
                                    <i class="fas {{ $icon }}"></i>
                                </div>
                                <div class="min-w-0">
                                    <div class="text-xs text-gray-400 mb-0.5">{{ $label }}</div>
                                    <div class="text-gray-900 font-medium truncate">{{ $value ?: '—' }}</div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
