<div>
    <!-- AI City Guide Section -->
    <section id="ai-guide" class="bg-white py-10 sm:py-15 xl:py-20 3xl:py-25.5">
        <div class="max-w-6xl 3xl:max-w-7xl mx-auto px-4 sm:px-10">
            <div class="text-center mb-12">
                <h2>Ваш персональный гид Саратов</h2>
                <p class="text text-gray-600 content-center">Интерактивный помощник, который подберет идеальный маршрут именно для вас</p>
            </div>

            <div class="max-w-4xl mx-auto font-['FindSansPro']">
                <div class="flex flex-col rounded-3xl bg-white overflow-hidden shadow-[0_20px_60px_rgba(30,58,138,0.16)] ring-1 ring-slate-200">

                    {{-- Header (dark) --}}
                    <div class="flex items-center gap-3 px-5 py-4 bg-linear-to-r from-[#1e2a5a] to-[#1e3a8a] text-white">
                        <div class="relative shrink-0">
                            <div class="w-11 h-11 rounded-full bg-linear-to-br from-[#60a5fa] to-[#2663EB] flex items-center justify-center text-white shadow-lg shadow-blue-900/40">
                                <i class="fas fa-robot"></i>
                            </div>
                            <span class="absolute -bottom-0.5 -right-0.5 w-3.5 h-3.5 rounded-full bg-green-500 ring-2 ring-[#1e2a5a]"></span>
                        </div>
                        <div class="min-w-0">
                            <div class="font-bold leading-tight">Гид Саратов</div>
                            <div class="text-xs text-blue-100/80 flex items-center gap-1.5">
                                <span class="w-1.5 h-1.5 rounded-full bg-green-400"></span> В сети · AI-помощник
                            </div>
                        </div>
                        <span class="ml-auto text-[11px] font-bold tracking-wide text-blue-100 bg-white/15 border border-white/20 px-2.5 py-1 rounded-full">AI</span>
                    </div>

                    {{-- Messages --}}
                    <div id="chatContainer" class="h-112 p-4 md:p-6 overflow-y-auto bg-[#f8fafc] flex flex-col-reverse">
                        <div class="flex flex-col gap-4 w-full" id="chat-messages">
                            @forelse ($chatMessages as $message)
                                @if($message['fromBot'])
                                    <div class="flex items-start gap-3 animate-fadeIn">
                                        <div class="w-9 h-9 shrink-0 rounded-full bg-linear-to-br from-[#1e3a8a] to-[#2663EB] flex items-center justify-center text-white shadow-md shadow-blue-900/25">
                                            <i class="fas fa-robot text-sm"></i>
                                        </div>
                                        <div class="max-w-[80%]">
                                            <div class="bg-white border border-[#e8edf5] rounded-2xl rounded-tl-md px-4 py-3 shadow-sm">
                                                <p class="text-xs font-bold text-[#1e3a8a] mb-1">Гид Саратов</p>
                                                <p class="text-sm text-gray-700 leading-relaxed whitespace-pre-line">{{ $message['text'] }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="flex items-start gap-3 justify-end animate-fadeIn">
                                        <div class="max-w-[80%]">
                                            <div class="bg-[#2663EB] text-white rounded-2xl rounded-tr-md px-4 py-3 shadow-md shadow-blue-900/25">
                                                <p class="text-sm leading-relaxed whitespace-pre-line">{{ $message['text'] }}</p>
                                            </div>
                                        </div>
                                        <div class="w-9 h-9 shrink-0 rounded-full bg-[#dbe4f5] flex items-center justify-center text-[#1e3a8a]">
                                            <i class="fas fa-user text-sm"></i>
                                        </div>
                                    </div>
                                @endif
                            @empty
                                <div class="flex flex-col items-center justify-center text-center py-10 px-4">
                                    <div class="w-16 h-16 rounded-2xl bg-linear-to-br from-[#1e3a8a] to-[#2663EB] flex items-center justify-center text-white text-2xl shadow-lg shadow-blue-900/30 mb-4">
                                        <i class="fas fa-robot"></i>
                                    </div>
                                    <p class="text-lg font-bold text-gray-900">Привет! Я ваш гид по Саратову</p>
                                    <p class="text-sm text-gray-500 mt-1 max-w-sm">Спросите про маршруты, места, кафе или события — подберу лучшее под ваши интересы.</p>
                                </div>
                            @endforelse

                            {{-- Typing indicator --}}
                            <div wire:loading wire:target="postMessage" class="flex items-start gap-3">
                                <div class="w-9 h-9 shrink-0 rounded-full bg-linear-to-br from-[#1e3a8a] to-[#2663EB] flex items-center justify-center text-white shadow-md shadow-blue-900/25">
                                    <i class="fas fa-robot text-sm"></i>
                                </div>
                                <div class="bg-white border border-[#e8edf5] rounded-2xl rounded-tl-md px-4 py-3.5 shadow-sm flex items-center gap-1.5">
                                    <span class="w-2 h-2 rounded-full bg-[#3b6fe0] animate-bounce [animation-delay:-0.3s]"></span>
                                    <span class="w-2 h-2 rounded-full bg-[#3b6fe0] animate-bounce [animation-delay:-0.15s]"></span>
                                    <span class="w-2 h-2 rounded-full bg-[#3b6fe0] animate-bounce"></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Quick actions --}}
                    <div class="px-4 md:px-6 pt-4 flex gap-2 overflow-x-auto scrollbar-hide">
                        @php
                            $quick = ['🚀 Поехали!', '🍽️ Рестораны и кафе', '🌳 Парки и прогулки', '🏛️ Музеи и культура', '🌤️ Погода', '🎭 События', '📚 История города', '🛍️ Шопинг'];
                        @endphp
                        @foreach ($quick as $q)
                            <button type="button"
                                    x-on:click="$wire.set('prompt', @js($q)); $refs.aiInput && $refs.aiInput.focus()"
                                    class="shrink-0 whitespace-nowrap text-sm px-4 py-2 rounded-full bg-[#eef3fb] text-[#1e3a8a] border border-[#dbe4f5] hover:bg-[#1e3a8a] hover:text-white hover:border-[#1e3a8a] transition-colors cursor-pointer">
                                {{ $q }}
                            </button>
                        @endforeach
                    </div>

                    {{-- Input --}}
                    <form wire:submit="postMessage" class="p-4 md:p-6">
                        <div class="flex items-center gap-2 rounded-full bg-white border border-[#cdd8ec] focus-within:border-[#2663EB] focus-within:ring-2 focus-within:ring-[#2663EB]/20 transition pl-5 pr-2 py-2">
                            <input wire:model="prompt" x-ref="aiInput" type="text" id="aiChatInput" autocomplete="off"
                                   placeholder="Напишите сообщение..."
                                   class="flex-1 min-w-0 bg-transparent text-sm lg:text-base text-gray-800 placeholder-gray-400 focus:outline-none">
                            <button type="submit"
                                    class="shrink-0 w-11 h-11 rounded-full bg-linear-to-r from-[#1e3a8a] to-[#2663EB] text-white flex items-center justify-center hover:shadow-lg hover:shadow-blue-900/30 transition-all cursor-pointer disabled:opacity-60"
                                    wire:loading.attr="disabled" wire:target="postMessage">
                                <i class="fas fa-paper-plane" wire:loading.remove wire:target="postMessage"></i>
                                <i class="fas fa-spinner fa-spin" wire:loading wire:target="postMessage"></i>
                            </button>
                        </div>
                        @error('prompt')
                            <p class="mt-2 ml-2 text-sm text-red-500 flex items-center gap-1.5">
                                <i class="fas fa-circle-exclamation"></i>{{ $message }}
                            </p>
                        @enderror
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
