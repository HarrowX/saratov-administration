<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;
use Livewire\Volt\Component;

new class extends Component
{
    public string $current_password = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Update the password for the currently authenticated user.
     */
    public function updatePassword(): void
    {
        try {
            $validated = $this->validate([
                'current_password' => ['required', 'string', 'current_password'],
                'password' => ['required', 'string', Password::defaults(), 'confirmed'],
            ]);
        } catch (ValidationException $e) {
            $this->reset('current_password', 'password', 'password_confirmation');

            throw $e;
        }

        Auth::user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        $this->reset('current_password', 'password', 'password_confirmation');

        $this->dispatch('password-updated');
    }
}; ?>

<section class="font-['FindSansPro']">
    <header>
        <h2 class="text-xl font-bold text-gray-900">
            Обновление пароля
        </h2>

        <p class="mt-1 text-sm text-gray-500">
            Убедитесь, что вы используете длинный, случайный пароль, чтобы оставаться в безопасности
        </p>
    </header>

    @php
        $inputClass = 'w-full rounded-xl border border-gray-200 bg-gray-50/60 px-4 py-3 text-gray-900 shadow-sm transition focus:border-[#A855F7] focus:bg-white focus:ring-2 focus:ring-[#A855F7]/25 focus:outline-none';
    @endphp

    <form wire:submit="updatePassword" class="mt-6 space-y-5">
        <div>
            <label for="update_password_current_password" class="block text-sm font-medium text-gray-600 mb-1.5">Текущий пароль</label>
            <input wire:model="current_password" id="update_password_current_password" name="current_password" type="password" class="{{ $inputClass }}" autocomplete="current-password" placeholder="••••••••" />
            <x-input-error :messages="$errors->get('current_password')" class="mt-2" />
        </div>

        <div>
            <label for="update_password_password" class="block text-sm font-medium text-gray-600 mb-1.5">Новый пароль</label>
            <input wire:model="password" id="update_password_password" name="password" type="password" class="{{ $inputClass }}" autocomplete="new-password" placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div>
            <label for="update_password_password_confirmation" class="block text-sm font-medium text-gray-600 mb-1.5">Подтвердите пароль</label>
            <input wire:model="password_confirmation" id="update_password_password_confirmation" name="password_confirmation" type="password" class="{{ $inputClass }}" autocomplete="new-password" placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4 pt-2">
            <button type="submit"
                    class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-linear-to-r from-[#A556F7] to-[#2663EB] text-white text-sm font-semibold hover:shadow-lg hover:shadow-purple-500/30 transition-all duration-200 cursor-pointer">
                <i class="fas fa-shield-halved"></i>
                Сохранить пароль
            </button>

            <x-action-message class="text-green-600 font-medium" on="password-updated">
                ✓ Сохранено
            </x-action-message>
        </div>
    </form>
</section>
