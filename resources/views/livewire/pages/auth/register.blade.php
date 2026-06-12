<?php

use App\Models\User;
use App\Services\AuthService;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;
use App\DTOs\RegisterDTO;


new #[Layout('layouts.guest')]
class extends Component {

    public RegisterDTO $dto;

    public function mount(): void
    {
        $this->dto = new RegisterDTO();
    }

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $this->dto->validate();

        $user = app(AuthService::class)->store($this->dto);

        Auth::login($user);

        $this->redirect(route('profile', absolute: false), navigate: true);
    }
}; ?>

<div>

    <a href="{{route('index')}}"
       class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
        На главную
    </a>

    <form wire:submit="register" class="mt-4">
        <div class="flex">
            <!-- Name -->
            <div>
                <x-input-label for="name">Имя<span class='text-red-600'>*</span></x-input-label>
                <x-text-input wire:model="dto.name" id="name" class="block mt-1 w-full" type="text"
                              name="name" required autofocus autocomplete="name" placeholder="Иван"/>
                <x-input-error :messages="$errors->get('name')" class="mt-2"/>
            </div>
            <!-- Surname -->
            <div class="ml-4">
                <x-input-label for="surname">Фамилия<span class='text-red-600'>*</span></x-input-label>
                <x-text-input wire:model="dto.surname" id="surname" class="block mt-1 w-full" type="text"
                              name="surname" required autofocus autocomplete="family-name" placeholder="Иванович"/>
                <x-input-error :messages="$errors->get('name')" class="mt-2"/>
            </div>
        </div>

        <!-- Patronymic -->
        <div class="mt-4">
            <x-input-label for="patronymic">Отчество</x-input-label>
            <x-text-input wire:model="dto.patronymic" id="patronymic" class="block mt-1 w-full" type="text"
                          name="patronymic" autofocus placeholder="Иванов"/>
            <x-input-error :messages="$errors->get('name')" class="mt-2"/>
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email">Почта<span class='text-red-600'>*</span></x-input-label>
            <x-text-input wire:model="dto.email" id="email" class="block mt-1 w-full" type="email"
                          name="email" required autocomplete="username" placeholder="example@mail.ru"/>
            <x-input-error :messages="$errors->get('email')" class="mt-2"/>
        </div>

        <!-- Phone -->
        <div class="mt-4">
            <x-input-label for="phone">Телефон</x-input-label>
            <x-text-input wire:model="dto.phone" id="phone" class="block mt-1 w-full" type="phone"
                          name="phone" autofocus autocomplete="phone" placeholder="+7 (999)-99-99"/>
            <x-input-error :messages="$errors->get('name')" class="mt-2"/>
        </div>


        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password">Пароль<span class='text-red-600'>*</span></x-input-label>

            <x-text-input wire:model="dto.password" id="password" class="block mt-1 w-full"
                          type="password"
                          name="password"
                          required autocomplete="new-password"
                          placeholder="************"/>

            <x-input-error :messages="$errors->get('password')" class="mt-2"/>
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation">Потвердите пароль <span class='text-red-600'>*</span></x-input-label>

            <x-text-input wire:model="dto.password_confirmation" id="password_confirmation" class="block mt-1 w-full"
                          type="password"
                          name="password_confirmation" required autocomplete="new-password"
                          placeholder="************"/>


            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2"/>
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
               href="{{ route('login') }}" wire:navigate>
                Уже зарегистрированы?
            </a>

            <x-primary-button class="ms-4">
                Зарегистрироваться
            </x-primary-button>
        </div>
    </form>
</div>
