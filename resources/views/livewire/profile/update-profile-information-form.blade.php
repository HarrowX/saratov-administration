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
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'patronymic' => ['nullable', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:255'],
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

<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form wire:submit="updateProfileInformation" class="mt-6 space-y-6">
        <div>
            <x-input-label for="surname"> Фамилия </x-input-label>
            <x-text-input wire:model="surname" id="surname" name="surname" type="text" class="mt-1 block w-full" required autofocus autocomplete="surname" placeholder="Иванов" />
            <x-input-error class="mt-2" :messages="$errors->get('surname')" />
        </div>

        <div>
            <x-input-label for="name"> Имя </x-input-label>
            <x-text-input wire:model="name" id="name" name="name" type="text" class="mt-1 block w-full" required autofocus autocomplete="name" placeholder="Иван" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="patronymic"> Отчество </x-input-label>
            <x-text-input wire:model="patronymic" id="patronymic" name="patronymic" type="text" class="mt-1 block w-full" autofocus autocomplete="patronymic" placeholder="Иванович" />
            <x-input-error class="mt-2" :messages="$errors->get('patronymic')" />
        </div>

        <div>
            <x-input-label for="phone"> Телефон </x-input-label>
            <x-text-input wire:model="phone" id="phone" name="phone" type="text" class="mt-1 block w-full" autofocus autocomplete="phone" placeholder="+7 (999) 99-99-99"/>
            <x-input-error class="mt-2" :messages="$errors->get('phone')" />
        </div>



        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            <x-action-message class="me-3" on="profile-updated">
                {{ __('Saved.') }}
            </x-action-message>
        </div>
    </form>
</section>
