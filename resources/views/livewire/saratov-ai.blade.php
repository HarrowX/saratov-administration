<div>
    <!-- AI City Guide Section (Enhanced!) -->
    <section id="ai-guide" class="bg-white py-10 sm:py-15 xl:py-20 3xl:py-25.5">
        <div class="max-w-6xl 3xl:max-w-7xl mx-auto px-4 sm:px-10">
            <div class="text-center mb-12">
                <h2>Ваш персональный гид Саратов</h2>
                <p class="text text-gray-600 content-center">Интерактивный помощник, который подберет идеальный маршрут именно для вас</p>
            </div>

            <div class="max-w-4xl mx-auto">
                <div class="bg-linear-to-br from-green-50 to-teal-50 rounded-2xl p-4 md:p-8">
                    <!-- Chat interface -->
                    <div class="bg-white flex flex-col rounded-xl shadow-inner h-125 p-2 md:p-6 mb-6" id="chatContainer">
                        <div class="flex-1 overflow-y-auto min-h-0 flex flex-col-reverse">
                            <div class="flex flex-col space-y-4 w-full px-2" id="chat-messages">
                                @foreach ($chatMessages as $message)
                                    @if($message['fromBot'])
                                    <div class="flex items-start space-x-3 animate-fadeIn">
                                        <div class="w-10 h-10 bg-linear-to-r from-green-400 to-teal-500 rounded-full flex items-center justify-center">
                                            <i class="fas fa-robot text-white"></i>
                                        </div>
                                        <div class="flex-1">
                                            <div class="bg-gray-100 rounded-2xl rounded-tl-none p-4 max-w-md">
                                                <p class="font-semibold mb-1 text-green-600">Саратов</p>
                                                <p class="whitespace-pre-line">{{ $message['text'] }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    @else
                                    <div class="flex items-start space-x-3 justify-end animate-fadeIn">
                                        <div class="bg-blue-500 text-white rounded-2xl rounded-tr-none p-4 max-w-md">
                                            <p>{{ $message['text'] }}</p>
                                        </div>
                                        <div class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center">
                                            <i class="fas fa-user text-white"></i>
                                        </div>
                                    </div>
                                    @endif
                                @endforeach

                                @if($isWaitingForResponse)
                                    <div class="flex items-start space-x-3 animate-fadeIn">
                                        <div class="w-10 h-10 bg-linear-to-r from-green-400 to-teal-500 rounded-full flex items-center justify-center">
                                            <i class="fas fa-robot text-white"></i>
                                        </div>
                                        <div class="flex-1">
                                            <div class="bg-gray-100 rounded-2xl rounded-tl-none p-4 max-w-md flex items-center space-x-3">
                                                <div class="flex space-x-1 items-center">
                                                    <div class="w-2 h-2 bg-green-500 rounded-full animate-bounce" style="animation-delay: 0s;"></div>
                                                    <div class="w-2 h-2 bg-green-500 rounded-full animate-bounce" style="animation-delay: 0.2s;"></div>
                                                    <div class="w-2 h-2 bg-green-500 rounded-full animate-bounce" style="animation-delay: 0.4s;"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <form wire:submit="postMessage">
                        <div class="flex space-x-3">
                            <input wire:model="prompt" type="text" id="aiChatInput" placeholder="Напишите сообщение..."
                            class="flex-1 w-20 text-sm lg:text-base py-2 px-2 md:px-4 md:py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-green-500 disabled:bg-gray-100 disabled:cursor-not-allowed"
                            @if($isWaitingForResponse) disabled @endif>
                            
                            <button type="submit" class="bg-linear-to-r from-green-500 to-teal-600 text-white px-2 py-3 md:px-6 md:py-3 rounded-lg hover:shadow-lg transition disabled:opacity-50 disabled:cursor-not-allowed"
                            @if($isWaitingForResponse) disabled @endif>
                                <i class="fas fa-paper-plane"></i>
                            </button>
                        </div>
                        @error('prompt')
                        <div>
                            <p class="text-red-700">{{ $message }}</p>
                        </div>
                        @enderror
                    </form>
{{-- 
                    <!-- Quick actions -->
                    <div class="mt-4 flex flex-wrap gap-2">
                        <button class="bg-blue-100 text-blue-700 px-4 py-2 rounded-full text-sm hover:bg-blue-200 transition">🚀 Поехали!</button>
                        <button class="bg-orange-100 text-orange-700 px-4 py-2 rounded-full text-sm hover:bg-orange-200 transition">🍽️ Рестораны и кафе</button>
                        <button class="bg-green-100 text-green-700 px-4 py-2 rounded-full text-sm hover:bg-green-200 transition">🌳 Парки и прогулки</button>
                        <button class="bg-purple-100 text-purple-700 px-4 py-2 rounded-full text-sm hover:bg-purple-200 transition">🏛️ Музеи и культура</button>
                        <button class="bg-yellow-100 text-yellow-700 px-4 py-2 rounded-full text-sm hover:bg-yellow-200 transition">🌤️ Погода</button>
                        <button class="bg-pink-100 text-pink-700 px-4 py-2 rounded-full text-sm hover:bg-pink-200 transition">🎭 События</button>
                        <button class="bg-indigo-100 text-indigo-700 px-4 py-2 rounded-full text-sm hover:bg-indigo-200 transition">📚 История города</button>
                        <button class="bg-red-100 text-red-700 px-4 py-2 rounded-full text-sm hover:bg-red-200 transition">🛍️ Шопинг</button>
                    </div> --}}
                </div>
            </div>
        </div>

        @if($isWaitingForResponse)
            <div wire:poll.2s="pollModelResponse"></div>
        @endif
    </section>
</div>