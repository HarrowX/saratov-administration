<?php

use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Locked;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    #[Locked]
    public string $token = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Mount the component.
     */
    public function mount(string $token): void
    {
        $this->token = $token;

        $this->email = request()->string('email');
    }

    /**
     * Reset the password for the given user.
     */
    public function resetPassword(): void
    {
        $this->validate([
            'token' => ['required'],
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        // Here we will attempt to reset the user's password. If it is successful we
        // will update the password on an actual user model and persist it to the
        // database. Otherwise we will parse the error and return the response.
        $status = Password::reset(
            $this->only('email', 'password', 'password_confirmation', 'token'),
            function ($user) {
                $user->forceFill([
                    'password' => Hash::make($this->password),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            }
        );

        // If the password was successfully reset, we will redirect the user back to
        // the application's home authenticated view. If there is an error we can
        // redirect them back to where they came from with their error message.
        if ($status != Password::PASSWORD_RESET) {
            $this->addError('email', __($status));

            return;
        }

        Session::flash('status', __($status));

        $this->redirectRoute('login');
    }
}; ?>

@php
    $inputClass = 'w-full rounded-xl border border-gray-200 bg-gray-50/60 px-4 py-3 text-gray-900 shadow-sm transition focus:border-[#A855F7] focus:bg-white focus:ring-2 focus:ring-[#A855F7]/25 focus:outline-none';
@endphp


<div class="flex flex-col gap-5 font-['FindSansPro']">
    <div class="mb-8">
        <h2 class="text-3xl font-bold text-gray-900">Смена пароля</h2>
        <p class="mt-2 text-gray-500">Укажите почту для смены пароля</p>
    </div>
    <form wire:submit="resetPassword" class="flex-col gap-5 h-full">
        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Почта')" class="block font-medium text-gray-600 mb-1.5" />
            <x-text-input wire:model="email" id="email" class="block mt-1 w-full " type="email" name="email" required autofocus autocomplete="username" class="{{$inputClass}}"/>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4" x-data="{ show: false }">
            <x-input-label for="password" :value="__('Пароль')" class="block text-sm font-medium text-gray-600 mb-1.5"/>
            <div class="relative">
                <i class="fas fa-lock absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
                <input wire:model="password" id="password" type="password" name="password" :type="show ? 'text' : 'password'" required autocomplete="new-password"
                       placeholder="••••••••" class="{{ $inputClass }} pl-11 pr-11" />
                <button type="button" @click="show = !show" class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 cursor-pointer">
                    <i class="fas" :class="show ? 'fa-eye-slash' : 'fa-eye'"></i>
                </button>
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4" x-data="{ show: false }">
            <x-input-label for="password_confirmation" :value="__('Подтвердите пароль')" class="block text-sm font-medium text-gray-600 mb-1.5" />

            <div class="relative">
                <i class="fas fa-lock absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
                <input wire:model="password_confirmation" id="password_confirmation" type="password" name="password" :type="show ? 'text' : 'password'" required autocomplete="new-password"
                       placeholder="••••••••" class="{{ $inputClass }} pl-11 pr-11" />
                <button type="button" @click="show = !show" class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 cursor-pointer">
                    <i class="fas" :class="show ? 'fa-eye-slash' : 'fa-eye'"></i>
                </button>
            </div>
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Сменить пароль') }}
            </x-primary-button>
        </div>
    </form>
</div>
