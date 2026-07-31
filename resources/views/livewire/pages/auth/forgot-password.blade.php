<?php

use Illuminate\Support\Facades\Password;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public string $email = '';

    /**
     * Send a password reset link to the provided email address.
     */
    public function sendPasswordResetLink(): void
    {
        $this->validate([
            'email' => ['required', 'string', 'email'],
        ]);

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $status = Password::sendResetLink(
            $this->only('email')
        );

        if ($status != Password::RESET_LINK_SENT) {
            $this->addError('email', __($status));

            return;
        }

        $this->reset('email');

        session()->flash('status', __($status));
    }
}; ?>

<div class="font-['FindSansPro']">
    <div class="mb-8">
        <h2 class="text-3xl font-bold text-gray-900">Восстановление пароля</h2>
        <p class="mt-2 text-gray-500">Введите свой email, и мы пришлём вам ссылку для сброса пароля</p>
    </div>

    @php
        $inputClass = 'w-full rounded-xl border border-gray-200 bg-gray-50/60 px-4 py-3 text-gray-900 shadow-sm transition focus:border-[#A855F7] focus:bg-white focus:ring-2 focus:ring-[#A855F7]/25 focus:outline-none';
    @endphp

        <!-- Session Status -->
    @if (session('status'))
        <div class="mb-4 p-4 rounded-xl bg-green-50 border border-green-200 text-green-700 text-sm">
            {{ session('status') }}
        </div>
    @endif

    <form wire:submit="sendPasswordResetLink" class="space-y-5">
        <!-- Email Address -->
        <div>
            <label for="email" class="block text-sm font-medium text-gray-600 mb-1.5">Почта <span class="text-red-500">*</span></label>
            <div class="relative">
                <i class="fas fa-envelope absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
                <input
                    wire:model="email"
                    id="email"
                    type="email"
                    name="email"
                    required
                    autofocus
                    placeholder="example@mail.ru"
                    class="{{ $inputClass }} pl-11"
                />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <button
            type="submit"
            class="w-full flex items-center justify-center gap-2 py-3 rounded-xl bg-linear-to-r from-[#A556F7] to-[#2663EB] text-white font-semibold hover:shadow-lg hover:shadow-purple-500/30 transition-all duration-200 cursor-pointer"
        >
            Отправить ссылку
            <i class="fas fa-paper-plane text-sm"></i>
        </button>

        <p class="text-center text-sm text-gray-500">
            Вспомнили пароль?
            <a href="{{ route('login') }}" class="font-semibold text-[#7c4fef] hover:text-[#2663EB] transition-colors">
                Войти
            </a>
        </p>
    </form>
</div>
