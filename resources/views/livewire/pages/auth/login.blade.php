<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public LoginForm $form;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();

        $this->redirectIntended(default: route('profile', absolute: false), navigate: true);
    }
}; ?>

<div class="font-['FindSansPro']">
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="mb-8">
        <h2 class="text-3xl font-bold text-gray-900">С возвращением 👋</h2>
        <p class="mt-2 text-gray-500">Войдите, чтобы продолжить путешествие по Саратову</p>
    </div>

    @php
        $inputClass = 'w-full rounded-xl border border-gray-200 bg-gray-50/60 px-4 py-3 text-gray-900 shadow-sm transition focus:border-[#A855F7] focus:bg-white focus:ring-2 focus:ring-[#A855F7]/25 focus:outline-none';
    @endphp

    <form wire:submit="login" class="space-y-5">
        <!-- Email Address -->
        <div>
            <label for="email" class="block text-sm font-medium text-gray-600 mb-1.5">Почта</label>
            <div class="relative">
                <i class="fas fa-envelope absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
                <input wire:model="form.email" id="email" type="email" name="email" required autofocus autocomplete="username"
                       placeholder="example@mail.ru" class="{{ $inputClass }} pl-11" />
            </div>
            <x-input-error :messages="$errors->get('form.email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div x-data="{ show: false }">
            <label for="password" class="block text-sm font-medium text-gray-600 mb-1.5">Пароль</label>
            <div class="relative">
                <i class="fas fa-lock absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
                <input wire:model="form.password" id="password" :type="show ? 'text' : 'password'" name="password" required autocomplete="current-password"
                       placeholder="••••••••" class="{{ $inputClass }} pl-11 pr-11" />
                <button type="button" @click="show = !show" class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 cursor-pointer">
                    <i class="fas" :class="show ? 'fa-eye-slash' : 'fa-eye'"></i>
                </button>
            </div>
            <x-input-error :messages="$errors->get('form.password')" class="mt-2" />
        </div>

        <!-- Remember Me / Forgot -->
        <div class="flex items-center justify-between">
            <label for="remember" class="inline-flex items-center cursor-pointer">
                <input wire:model="form.remember" id="remember" type="checkbox" name="remember"
                       class="rounded border-gray-300 text-[#A855F7] shadow-sm focus:ring-[#A855F7]/40">
                <span class="ms-2 text-sm text-gray-600">Запомнить меня</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-sm font-medium text-[#7c4fef] hover:text-[#2663EB] transition-colors" href="{{ route('password.request') }}">
                    Забыли пароль?
                </a>
            @endif
        </div>

        <button type="submit"
                class="w-full flex items-center justify-center gap-2 py-3 rounded-xl bg-linear-to-r from-[#A556F7] to-[#2663EB] text-white font-semibold hover:shadow-lg hover:shadow-purple-500/30 transition-all duration-200 cursor-pointer">
            Войти
            <i class="fas fa-arrow-right text-sm"></i>
        </button>

        <div class="relative py-1">
            <div class="absolute inset-0 flex items-center"><div class="w-full border-t border-gray-200"></div></div>
            <div class="relative flex justify-center"><span class="px-3 bg-gray-50 lg:bg-white text-xs text-gray-400">или</span></div>
        </div>

        <x-vk-one-tap />

        <p class="text-center text-sm text-gray-500">
            Нет аккаунта?
            <a href="{{ route('register') }}" class="font-semibold text-[#7c4fef] hover:text-[#2663EB] transition-colors">
                Зарегистрироваться
            </a>
        </p>
    </form>
</div>
