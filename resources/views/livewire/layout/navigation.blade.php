<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component
{
    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
}; ?>

@php
    $u = auth()->user();
    $fn = optional($u->username)->name ?? '';
    $ln = optional($u->username)->surname ?? '';
    $initials = mb_strtoupper(mb_substr($ln, 0, 1) . mb_substr($fn, 0, 1));
    $fullName = trim("$fn $ln") ?: 'Профиль';

    $links = [
        ['route' => 'profile',           'active' => 'profile',           'label' => 'Профиль',            'icon' => 'fa-user'],
        ['route' => 'profile-favorites', 'active' => 'profile-favorites', 'label' => 'Избранное',          'icon' => 'fa-heart'],
        ['route' => 'place-visits',      'active' => 'place-visits',      'label' => 'Посещённые места',   'icon' => 'fa-map-location-dot'],
        ['route' => 'history-views',     'active' => 'history-views',     'label' => 'История просмотров', 'icon' => 'fa-clock-rotate-left'],
    ];
@endphp

<nav x-data="{ open: false, user: false }" class="bg-white/95 backdrop-blur border-b border-gray-100 sticky top-0 z-50 font-['FindSansPro']">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            {{-- Logo --}}
            <a href="{{ route('index') }}" class="flex items-center gap-2 shrink-0">
                <img src="/images/Photoroom 1.png" alt="Саратов" class="icon h-8 w-auto">
                <span class="text-lg font-bold text-gray-900 hidden sm:block">Саратов</span>
            </a>

            {{-- Desktop tabs --}}
            <div class="hidden lg:flex items-center gap-1">
                @foreach ($links as $link)
                    @php $isActive = request()->routeIs($link['active']); @endphp
                    <a href="{{ route($link['route']) }}"
                       class="flex items-center gap-2 px-4 py-2 rounded-full text-sm font-medium transition-all duration-200
                       {{ $isActive
                           ? 'bg-linear-to-r from-[#A556F7] to-[#2663EB] text-white shadow-md shadow-purple-500/25'
                           : 'text-gray-600 hover:text-gray-900 hover:bg-gray-100' }}">
                        <i class="fas {{ $link['icon'] }} text-xs"></i>
                        {{ $link['label'] }}
                    </a>
                @endforeach
            </div>

            {{-- User menu (desktop) --}}
            <div class="hidden lg:flex items-center relative">
                <button @click="user = !user" @click.outside="user = false"
                        class="flex items-center gap-2.5 pl-1.5 pr-3 py-1.5 rounded-full hover:bg-gray-100 transition-colors cursor-pointer">
                    <span class="size-8 rounded-full bg-linear-to-br from-[#A556F7] to-[#2663EB] flex items-center justify-center text-white text-sm font-bold">
                        {{ $initials ?: '👤' }}
                    </span>
                    <span class="text-sm font-medium text-gray-700 max-w-32 truncate">{{ $fullName }}</span>
                    <i class="fas fa-chevron-down text-xs text-gray-400 transition-transform" :class="user && 'rotate-180'"></i>
                </button>

                <div x-show="user" x-cloak x-transition
                     class="absolute right-0 top-full mt-2 w-56 bg-white rounded-2xl shadow-[0_12px_40px_rgb(0,0,0,0.12)] border border-gray-100 overflow-hidden py-2">
                    <div class="px-4 py-3 border-b border-gray-100">
                        <div class="text-sm font-semibold text-gray-900 truncate">{{ $fullName }}</div>
                        <div class="text-xs text-gray-400 truncate">{{ $u->email }}</div>
                    </div>
                    <a href="{{ route('profile-settings') }}"
                       class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                        <i class="fas fa-gear text-gray-400 w-4"></i>
                        Настройки профиля
                    </a>
                    <button wire:click="logout" class="w-full flex items-center gap-3 px-4 py-2.5 text-sm text-red-500 hover:bg-red-50 transition-colors cursor-pointer">
                        <i class="fas fa-arrow-right-from-bracket w-4"></i>
                        Выйти
                    </button>
                </div>
            </div>

            {{-- Hamburger --}}
            <button @click="open = !open" class="lg:hidden inline-flex items-center justify-center size-10 rounded-lg text-gray-500 hover:bg-gray-100 transition-colors cursor-pointer">
                <i class="fas text-lg" :class="open ? 'fa-xmark' : 'fa-bars'"></i>
            </button>
        </div>
    </div>

    {{-- Mobile menu --}}
    <div x-show="open" x-cloak x-transition class="lg:hidden border-t border-gray-100 bg-white">
        <div class="px-4 py-3 space-y-1">
            @foreach ($links as $link)
                @php $isActive = request()->routeIs($link['active']); @endphp
                <a href="{{ route($link['route']) }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-colors
                   {{ $isActive
                       ? 'bg-linear-to-r from-[#A556F7] to-[#2663EB] text-white'
                       : 'text-gray-700 hover:bg-gray-100' }}">
                    <i class="fas {{ $link['icon'] }} w-5"></i>
                    {{ $link['label'] }}
                </a>
            @endforeach
        </div>

        <div class="px-4 py-4 border-t border-gray-100">
            <div class="flex items-center gap-3 px-2 mb-3">
                <span class="size-10 rounded-full bg-linear-to-br from-[#A556F7] to-[#2663EB] flex items-center justify-center text-white font-bold">
                    {{ $initials ?: '👤' }}
                </span>
                <div class="min-w-0">
                    <div class="text-sm font-semibold text-gray-900 truncate">{{ $fullName }}</div>
                    <div class="text-xs text-gray-400 truncate">{{ $u->email }}</div>
                </div>
            </div>
            <a href="{{ route('profile-settings') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm text-gray-700 hover:bg-gray-100 transition-colors">
                <i class="fas fa-gear w-5"></i>
                Настройки профиля
            </a>
            <button wire:click="logout" class="w-full flex items-center gap-3 px-4 py-3 rounded-xl text-sm text-red-500 hover:bg-red-50 transition-colors cursor-pointer">
                <i class="fas fa-arrow-right-from-bracket w-5"></i>
                Выйти
            </button>
        </div>
    </div>
</nav>
