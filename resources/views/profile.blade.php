<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Профиль
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @php
                $user = auth()->user();
                $name = $user->username->name;
                $surname = $user->username->surname;
                $patronymic = $user->username->patronymic;
                $phone = $user->phone;
            @endphp
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4 space-y-3">
                    <div class="flex items-start">
                        <div class="w-32 font-semibold text-gray-700">Фамилия:</div>
                        <div class="flex-1 text-gray-900">{{$surname}}</div>
                    </div>
                    <div class="flex items-start">
                        <div class="w-32 font-semibold text-gray-700">Имя:</div>
                        <div class="flex-1 text-gray-900">{{$name}}</div>
                    </div>
                    <div class="flex items-start">
                        <div class="w-32 font-semibold text-gray-700">Отчество:</div>
                        <div class="flex-1 text-gray-900">{{$patronymic}}</div>
                    </div>
                    <div class="flex items-start">
                        <div class="w-32 font-semibold text-gray-700">Телефон:</div>
                        <div class="flex-1 text-gray-900">{{$phone}}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
