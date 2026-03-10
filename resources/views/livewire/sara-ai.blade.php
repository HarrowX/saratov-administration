<div>
    <!-- AI City Guide Section (Enhanced!) -->
    <section id="ai-guide" class="bg-white py-25.5">
        <div class="max-w-6xl 3xl:max-w-7xl mx-auto px-4 sm:px-10">
            <div class="text-center mb-12" data-aos="fade-up">
                <span class="bg-linear-to-r from-green-600 to-teal-600 text-white px-4 py-1 rounded-full text-sm font-semibold mb-4 inline-block">
                    <i class="fas fa-robot mr-2"></i>AI АССИСТЕНТ
                </span>
                <h2>Ваш персональный гид Сара</h2>
                <p class="text text-gray-600 content-center">Интерактивный помощник, который подберет идеальный маршрут именно для вас</p>
            </div>
            
            <div class="max-w-4xl mx-auto">
                <div class="bg-linear-to-br from-green-50 to-teal-50 rounded-2xl p-4 md:p-8" data-aos="zoom-in">
                    <!-- Chat interface -->
                    <div class="bg-white flex flex-col rounded-xl shadow-inner h-125 p-2 md:p-6 mb-6" id="chatContainer">
                        <div class="flex-1 overflow-y-auto min-h-0 flex flex-col-reverse">
                            <div class="flex flex-col space-y-4 w-full px-2" id="chat-messages">
                            </div>
                        </div>
                    </div>
                    
                    <!-- Input area -->
                    <div class="flex space-x-3">
                        <input type="text" id="aiChatInput" placeholder="Напишите сообщение..." 
                               onkeypress="if(event.key === 'Enter') { handleChatMessage(this.value); this.value=''; }"
                               class="flex-1 w-20 text-sm lg:text-base py-2 px-2 md:px-4 md:py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-green-500">
                        <button onclick="const input = document.getElementById('aiChatInput'); handleChatMessage(input.value); input.value='';" class="bg-linear-to-r from-green-500 to-teal-600 text-white px-2 py-3 md:px-6 md:py-3 rounded-lg hover:shadow-lg transition">
                            <i class="fas fa-paper-plane"></i>
                        </button>
                        <button onclick="voiceInput()" class="bg-gray-200 text-gray-700 px-2 py-3 md:px-6 md:py-3 rounded-lg hover:bg-gray-300 transition">
                            <i class="fas fa-microphone"></i>
                        </button>
                    </div>
                    
                    <!-- Quick actions -->
                    <div class="mt-4 flex flex-wrap gap-2">
                        <button onclick="handleChatMessage('start')" class="bg-blue-100 text-blue-700 px-4 py-2 rounded-full text-sm hover:bg-blue-200 transition">
                            🚀 Поехали!
                        </button>
                        <button onclick="handleChatMessage('где поесть')" class="bg-orange-100 text-orange-700 px-4 py-2 rounded-full text-sm hover:bg-orange-200 transition">
                            🍽️ Рестораны и кафе
                        </button>
                        <button onclick="handleChatMessage('парки')" class="bg-green-100 text-green-700 px-4 py-2 rounded-full text-sm hover:bg-green-200 transition">
                            🌳 Парки и прогулки
                        </button>
                        <button onclick="handleChatMessage('музеи')" class="bg-purple-100 text-purple-700 px-4 py-2 rounded-full text-sm hover:bg-purple-200 transition">
                            🏛️ Музеи и культура
                        </button>
                        <button onclick="handleChatMessage('погода')" class="bg-yellow-100 text-yellow-700 px-4 py-2 rounded-full text-sm hover:bg-yellow-200 transition">
                            🌤️ Погода
                        </button>
                        <button onclick="handleChatMessage('события')" class="bg-pink-100 text-pink-700 px-4 py-2 rounded-full text-sm hover:bg-pink-200 transition">
                            🎭 События
                        </button>
                        <button onclick="handleChatMessage('история')" class="bg-indigo-100 text-indigo-700 px-4 py-2 rounded-full text-sm hover:bg-indigo-200 transition">
                            📚 История города
                        </button>
                        <button onclick="handleChatMessage('шопинг')" class="bg-red-100 text-red-700 px-4 py-2 rounded-full text-sm hover:bg-red-200 transition">
                            🛍️ Шопинг
                        </button>
                    </div>
                    
                    <!-- AI Features -->
                    <div class="grid md:grid-cols-4 gap-4 mt-8">
                        <div class="bg-white rounded-lg p-4 text-center">
                            <i class="fas fa-comments text-3xl text-blue-500 mb-2"></i>
                            <p class="font-semibold">Диалог</p>
                            <p class="text-xs text-gray-600">Интерактивное общение</p>
                        </div>
                        <div class="bg-white rounded-lg p-4 text-center">
                            <i class="fas fa-user-cog text-3xl text-green-500 mb-2"></i>
                            <p class="font-semibold">Персонализация</p>
                            <p class="text-xs text-gray-600">Учет ваших предпочтений</p>
                        </div>
                        <div class="bg-white rounded-lg p-4 text-center">
                            <i class="fas fa-map-marked text-3xl text-purple-500 mb-2"></i>
                            <p class="font-semibold">50+ мест</p>
                            <p class="text-xs text-gray-600">База знаний о городе</p>
                        </div>
                        <div class="bg-white rounded-lg p-4 text-center">
                            <i class="fas fa-sync text-3xl text-orange-500 mb-2"></i>
                            <p class="font-semibold">Обновления</p>
                            <p class="text-xs text-gray-600">Актуальная информация</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
