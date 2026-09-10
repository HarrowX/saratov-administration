<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;
use Livewire\Volt\Component;

new class extends Component {
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Update the password for the currently authenticated user.
     */
    public function postRegistration(): void
    {
        try {
            $validated = $this->validate([
                'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->withoutTrashed()],
                'password' => ['required', Password::defaults(), 'confirmed:password_confirmation'],
                'password_confirmation' => ['required', Password::defaults()],
            ]);
        } catch (ValidationException $e) {
            throw $e;
        }

        Auth::user()->update([
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        $this->dispatch('password-updated');

        $this->redirect(route('profile-settings'));
    }
}; ?>

<section class="font-['FindSansPro']">
    <header>
        <h2 class="text-xl font-bold text-gray-900">
            Добавьте почту и пароль
        </h2>

        <p class="mt-1 text-sm text-gray-500">
            Для входа не через vk id
        </p>
    </header>

    @php
        $inputClass = 'w-full rounded-xl border border-gray-200 bg-gray-50/60 px-4 py-3 text-gray-900 shadow-sm transition focus:border-[#A855F7] focus:bg-white focus:ring-2 focus:ring-[#A855F7]/25 focus:outline-none';
    @endphp

    <form wire:submit="postRegistration" class="mt-6 space-y-5">
        <div>
            <label for="email" class="block text-sm font-medium text-gray-600 mb-1.5">Почта</label>
            <input wire:model="email" id="update_password_password" name="email" type="email" class="{{ $inputClass }}"
                   autocomplete="email" placeholder="example@mail.ru"/>
            <x-input-error :messages="$errors->get('email')" class="mt-2"/>
        </div>

        <div>
            <label for="password" class="block text-sm font-medium text-gray-600 mb-1.5">Пароль</label>
            <input wire:model="password" id="update_password_password" name="password" type="password"
                   class="{{ $inputClass }}" autocomplete="new-password" placeholder="••••••••"/>
            <x-input-error :messages="$errors->get('password')" class="mt-2"/>
        </div>

        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-gray-600 mb-1.5">Подтвердите
                пароль</label>
            <input wire:model="password_confirmation" id="update_password_password_confirmation"
                   name="password_confirmation" type="password" class="{{ $inputClass }}" autocomplete="new-password"
                   placeholder="••••••••"/>
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2"/>
        </div>

        <div class="flex items-center gap-4 pt-2">
            <button type="submit"
                    class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-linear-to-r from-[#A556F7] to-[#2663EB] text-white text-sm font-semibold hover:shadow-lg hover:shadow-purple-500/30 transition-all duration-200 cursor-pointer">
                <i class="fas fa-shield-halved"></i>
                Добавить
            </button>

            <x-action-message class="text-green-600 font-medium" on="password-updated">
                ✓ Сохранено
            </x-action-message>
        </div>
    </form>
</section>
