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

<div class="font-['FindSansPro']">
    <div class="mb-8">
        <h2 class="text-3xl font-bold text-gray-900">Создать аккаунт</h2>
        <p class="mt-2 text-gray-500">Зарегистрируйтесь, чтобы начать путешествие по Саратову</p>
    </div>

    @php
        $inputClass = 'w-full rounded-xl border border-gray-200 bg-gray-50/60 px-4 py-3 text-gray-900 shadow-sm transition focus:border-[#A855F7] focus:bg-white';
    @endphp

    <form wire:submit="register" class="space-y-5">
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <!-- Name -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-600 mb-1.5">Имя <span class="text-red-500">*</span></label>
                <input wire:model="dto.name" id="name" type="text" name="name" required autofocus autocomplete="given-name"
                       placeholder="Иван" class="{{ $inputClass }}" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>
            <!-- Surname -->
            <div>
                <label for="surname" class="block text-sm font-medium text-gray-600 mb-1.5">Фамилия <span class="text-red-500">*</span></label>
                <input wire:model="dto.surname" id="surname" type="text" name="surname" required autocomplete="family-name"
                       placeholder="Иванов" class="{{ $inputClass }}" />
                <x-input-error :messages="$errors->get('surname')" class="mt-2" />
            </div>
        </div>

        <!-- Patronymic -->
        <div>
            <label for="patronymic" class="block text-sm font-medium text-gray-600 mb-1.5">Отчество</label>
            <input wire:model="dto.patronymic" id="patronymic" type="text" name="patronymic" autocomplete="additional-name"
                   placeholder="Иванович" class="{{ $inputClass }}" />
            <x-input-error :messages="$errors->get('patronymic')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-sm font-medium text-gray-600 mb-1.5">Почта <span class="text-red-500">*</span></label>
            <div class="relative">
                <i class="fas fa-envelope absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
                <input wire:model="dto.email" id="email" type="email" name="email" required autocomplete="username"
                       placeholder="example@mail.ru" class="{{ $inputClass }} pl-11" />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Phone -->
        <div>
            <label for="phone" class="block text-sm font-medium text-gray-600 mb-1.5">Телефон</label>
            <div class="relative">
                <i class="fas fa-phone absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
                <input wire:model="dto.phone" id="phone" type="tel" name="phone" autocomplete="tel"
                       placeholder="+7 (999) 999-99-99" class="{{ $inputClass }} pl-11" />
            </div>
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
        </div>

        <!-- Password -->
        <div x-data="{ show: false }">
            <label for="password" class="block text-sm font-medium text-gray-600 mb-1.5">Пароль <span class="text-red-500">*</span></label>
            <div class="relative">
                <i class="fas fa-lock absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
                <input wire:model="dto.password" id="password" :type="show ? 'text' : 'password'" name="password" required autocomplete="new-password"
                       placeholder="••••••••" class="{{ $inputClass }} pl-11 pr-11" />
                <button type="button" @click="show = !show" class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 cursor-pointer">
                    <i class="fas" :class="show ? 'fa-eye-slash' : 'fa-eye'"></i>
                </button>
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div x-data="{ show: false }">
            <label for="password_confirmation" class="block text-sm font-medium text-gray-600 mb-1.5">Подтвердите пароль <span class="text-red-500">*</span></label>
            <div class="relative">
                <i class="fas fa-lock absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
                <input wire:model="dto.password_confirmation" id="password_confirmation" :type="show ? 'text' : 'password'" name="password_confirmation" required autocomplete="new-password"
                       placeholder="••••••••" class="{{ $inputClass }} pl-11 pr-11" />
                <button type="button" @click="show = !show" class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 cursor-pointer">
                    <i class="fas" :class="show ? 'fa-eye-slash' : 'fa-eye'"></i>
                </button>
            </div>
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <button type="submit"
                class="w-full flex items-center justify-center gap-2 py-3 rounded-xl bg-linear-to-r from-[#A556F7] to-[#2663EB] text-white font-semibold hover:shadow-lg hover:shadow-purple-500/30 transition-all duration-200 cursor-pointer">
            Зарегистрироваться
            <i class="fas fa-arrow-right text-sm"></i>
        </button>

        <p class="text-center text-sm text-gray-500">
            Уже есть аккаунт?
            <a href="{{ route('login') }}" class="font-semibold text-[#7c4fef] hover:text-[#2663EB] transition-colors">
                Войти
            </a>
        </p>
    </form>
</div>
