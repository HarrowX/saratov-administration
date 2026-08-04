<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Livewire\Volt\Component;

new class extends Component
{
    public string $name = '';
    public string $surname = '';
    public ?string $patronymic = null;
    public ?string $phone = null;
    public string $email = '';

    /**
     * Mount the component.
     */
    public function mount(): void
    {
        $this->name = auth()->user()->username->name;
        $this->surname = auth()->user()->username->surname;
        $this->patronymic = auth()->user()->username->patronymic;
        $this->phone = auth()->user()->phone;
        $this->email = Auth::user()->email;
    }

    /**
     * Update the profile information for the currently authenticated user.
     */
    public function updateProfileInformation(): void
    {
        $user = Auth::user();

        $validated = $this->validate([
            'name' => ['string', 'required', 'min:2', 'max:255'],
            'surname' => ['string', 'required', 'min:2', 'max:255'],
            'patronymic' => ['sometimes', 'string', 'nullable', 'max:255'],
            'phone' => ['phone:RU', 'sometimes', 'string', 'nullable', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique(User::class)->ignore(auth()->user()->id)],
        ]);

        $user->username->update([
            'name' => $validated['name'],
            'surname' => $validated['surname'],
            'patronymic' => $validated['patronymic'],
        ]);

        $user->fill([
            'phone' => $validated['phone'] ?? $user->phone,
            'email' => $validated['email'],
        ]);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        $this->dispatch('profile-updated', name: $user->username->name);
    }

    /**
     * Send an email verification notification to the current user.
     */
    public function sendVerification(): void
    {
        $user = Auth::user();

        if ($user->hasVerifiedEmail()) {
            $this->redirectIntended(default: route('dashboard', absolute: false));

            return;
        }

        $user->sendEmailVerificationNotification();

        Session::flash('status', 'verification-link-sent');
    }
}; ?>

<section class="font-['FindSansPro']">
    @php
        $initials = mb_strtoupper(mb_substr($surname ?? '', 0, 1) . mb_substr($name ?? '', 0, 1));
    @endphp
    <header>
        <h2 class="text-xl font-bold text-gray-900">
            Личная информация
        </h2>

        <p class="mt-1 text-sm text-gray-500">
            Здесь вы можете обновить свои личные данные
        </p>
    </header>

    <div class="mt-6 flex items-center gap-5">
        <div class="size-20 rounded-full bg-linear-to-br from-[#A556F7] to-[#2663EB] flex items-center justify-center text-white text-2xl font-bold shrink-0 shadow-lg">
            {{ $initials ?: '👤' }}
        </div>
        <div>
            <div class="text-gray-900 font-semibold">{{ trim("$surname $name") ?: 'Пользователь' }}</div>
            @if(!(auth()->user()->haveFakeVkEmail()))
                <div class="text-sm text-gray-400">{{ $email }}</div>
            @endif
        </div>
    </div>

    <form wire:submit="updateProfileInformation" class="mt-8 space-y-5">
        @php
            $inputClass = 'w-full rounded-xl border border-gray-200 bg-gray-50/60 px-4 py-3 text-gray-900 shadow-sm transition focus:border-[#A855F7] focus:bg-white focus:ring-2 focus:ring-[#A855F7]/25 focus:outline-none';
        @endphp

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
            <div>
                <label for="surname" class="block text-sm font-medium text-gray-600 mb-1.5">Фамилия</label>
                <input wire:model="surname" id="surname" name="surname" type="text" class="{{ $inputClass }}" required autocomplete="family-name" placeholder="Иванов" />
                <x-input-error class="mt-2" :messages="$errors->get('surname')" />
            </div>

            <div>
                <label for="name" class="block text-sm font-medium text-gray-600 mb-1.5">Имя</label>
                <input wire:model="name" id="name" name="name" type="text" class="{{ $inputClass }}" required autocomplete="given-name" placeholder="Иван" />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>
        </div>

        <div>
            <label for="patronymic" class="block text-sm font-medium text-gray-600 mb-1.5">Отчество</label>
            <input wire:model="patronymic" id="patronymic" name="patronymic" type="text" class="{{ $inputClass }}" autocomplete="additional-name" placeholder="Иванович" />
            <x-input-error class="mt-2" :messages="$errors->get('patronymic')" />
        </div>

        <div>
            <label for="phone" class="block text-sm font-medium text-gray-600 mb-1.5">Телефон</label>
            <input wire:model="phone" id="phone" name="phone" type="text" class="{{ $inputClass }}" autocomplete="tel" placeholder="+7 (999) 999-99-99" />
            <x-input-error class="mt-2" :messages="$errors->get('phone')" />
        </div>
        @if(!(auth()->user()->haveFakeVkEmail()))
            <div>
                <label for="email" class="block text-sm font-medium text-gray-600 mb-1.5">Электронная почта</label>
                <input wire:model="email" id="email" name="email" type="email" class="{{ $inputClass }}" autocomplete="email" placeholder="ivanov@mail.ru" />
                <x-input-error class="mt-2" :messages="$errors->get('email')" />
            </div>
        @endif

        <div class="flex items-center gap-4 pt-2">
            <button type="submit"
                    class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-linear-to-r from-[#A556F7] to-[#2663EB] text-white text-sm font-semibold hover:shadow-lg hover:shadow-purple-500/30 transition-all duration-200 cursor-pointer">
                <i class="fas fa-floppy-disk"></i>
                Сохранить изменения
            </button>

            <x-action-message class="text-green-600 font-medium" on="profile-updated">
                ✓ Сохранено
            </x-action-message>
        </div>
    </form>
</section>
