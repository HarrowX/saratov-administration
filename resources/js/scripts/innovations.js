// Innovative features for Saratov 435
// Based on best practices from Moscow, Barcelona, Amsterdam city platforms

// AR Experience Module
const ARModule = {
    isSupported: false,
    isActive: false,
    currentLocation: null,
    
    init() {
        // Check if AR is supported
        if ('xr' in navigator || 'mediaDevices' in navigator) {
            this.isSupported = true;
        }
    },
    
    async startExperience() {
        if (!this.isSupported) {
            window.showNotification('AR функция доступна только в мобильном приложении', 'info');
            this.showARDemo();
            return;
        }
        
        try {
            // Request camera permissions
            const stream = await navigator.mediaDevices.getUserMedia({ video: { facingMode: 'environment' } });
            this.showARInterface(stream);
        } catch (error) {
            console.error('AR error:', error);
            this.showARDemo();
        }
    },
    
    showARDemo() {
        // Show AR demo modal
        const modal = document.createElement('div');
        modal.className = 'fixed inset-0 bg-black/80 z-50 flex items-center justify-center p-4';
        modal.innerHTML = `
            <div class="bg-white rounded-2xl max-w-2xl w-full p-6 relative h-160 overflow-scroll">
        <div class="sticky top-0 z-50 flex justify-end -mt-10">
            <button onclick="this.closest('.fixed').remove()" 
                    class="bg-white/90 backdrop-blur rounded-full w-10 h-10 flex items-center justify-center hover:bg-white transition shadow-md hover:shadow-lg">
                <i class="fas fa-times text-gray-700"></i>
            </button>
        </div>
                
                <div class="text-center mb-6">
                    <div class="w-20 h-20 bg-linear-to-r from-purple-500 to-blue-600 rounded-full mx-auto mb-4 flex items-center justify-center">
                        <i class="fas fa-vr-cardboard text-white text-3xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold mb-2">AR Путешествие во времени</h3>
                    <p class="text-gray-600">Демо-режим AR функции</p>
                </div>
                
                <div class="relative rounded-xl overflow-hidden mb-6">
                    <img src="https://www.tursar.ru/image/img424_0.jpg" alt="Консерватория" class="photo h-70 w-full">
                    <div class="absolute inset-0 bg-linear-to-t from-black/50 to-transparent flex items-end p-6 h-70">
                        <div class="text-white">
                            <h4 class="text-xl font-bold mb-2">Саратовская консерватория, 1912 год</h4>
                            <p>Наведите камеру на QR-код у входа, чтобы увидеть здание в год открытия</p>
                        </div>
                    </div>
                </div>
                
                <div class="grid grid-cols-3 gap-4 mb-6">
                    <button onclick="ARModule.switchARMode('history')" class="bg-purple-100 text-purple-700 p-3 rounded-lg hover:bg-purple-200 transition">
                        <i class="fas fa-history mb-2"></i>
                        <p class="text-xs">История</p>
                    </button>
                    <button onclick="ARModule.switchARMode('3d')" class="bg-blue-100 text-blue-700 p-3 rounded-lg hover:bg-blue-200 transition">
                        <i class="fas fa-cube mb-2"></i>
                        <p class="text-xs">3D модель</p>
                    </button>
                    <button onclick="ARModule.switchARMode('guide')" class="bg-green-100 text-green-700 p-3 rounded-lg hover:bg-green-200 transition">
                        <i class="fas fa-user-tie mb-2"></i>
                        <p class="text-xs">Гид</p>
                    </button>
                </div>
                
                <div class="bg-linear-to-r from-purple-50 to-blue-50 rounded-lg p-4">
                    <p class="text-sm text-gray-700">
                        <i class="fas fa-info-circle text-blue-500 mr-2"></i>
                        В мобильном приложении вы сможете увидеть исторические 3D-реконструкции, 
                        встретить виртуальных персонажей и получить уникальный опыт путешествия во времени!
                    </p>
                </div>
                
                <button onclick="this.closest('.fixed').remove()" class="w-full mt-6 bg-linear-to-r from-purple-500 to-blue-600 text-white px-6 py-3 rounded-lg font-semibold hover:shadow-lg transition">
                    Понятно
                </button>
            </div>
        `;
        document.body.appendChild(modal);
    },
    
    switchARMode(mode) {
        window.showNotification(`AR режим "${mode}" будет доступен в мобильном приложении`, 'info');
    },
    
    showARInterface(stream) {
        // Would show actual AR interface in mobile app
        console.log('AR interface with stream:', stream);
    }
};

// // AI City Guide Module (Sara - Saratov AI Assistant)
// const AIGuideModule = {
//     responses: {
//         history: [
//             "Саратов был основан в 1590 году как сторожевая крепость. Знаете ли вы, что название города происходит от тюркского 'Сары тау' - желтая гора?",
//             "В Саратове открылся первый в России стационарный цирк братьев Никитиных в 1876 году. Это было революционное событие для развлекательной индустрии страны!",
//             "12 апреля 1961 года недалеко от Саратова приземлился Юрий Гагарин после первого полета в космос. Место приземления стало местом паломничества."
//         ],
//         food: [
//             "Рекомендую попробовать местную кухню в ресторане 'Волга' - там готовят отличную стерлядь по-саратовски. А в кафе 'Гагарин' лучший кофе в городе!",
//             "Обязательно попробуйте саратовский калач - это визитная карточка города. Лучшие продают в пекарне на улице Кирова.",
//             "Для любителей итальянской кухни - пиццерия 'Италия' на Вольской. У них есть специальное предложение для пользователей нашего приложения!"
//         ],
//         route: [
//             "Предлагаю маршрут 'Исторический центр': Консерватория → Радищевский музей → Троицкий собор → Театр драмы → Набережная. Это займет около 4 часов неспешной прогулки.",
//             "Для первого знакомства с городом идеален маршрут 'Путь Гагарина': Парк Победы → Набережная Космонавтов → Место приземления. Вы узнаете космическую историю Саратова!",
//             "Семейный маршрут выходного дня: Цирк → Лимонарий → Парк Победы с музеем техники. Детям точно понравится!"
//         ],
//         kids: [
//             "С детьми обязательно посетите Лимонарий - там более 50 видов экзотических растений! Также рекомендую цирк братьев Никитиных и музей военной техники в Парке Победы.",
//             "В выходные работает детская железная дорога в Парке Победы. А на набережной есть отличные детские площадки с видом на Волгу.",
//             "Интерактивные квесты 'По следам братьев Никитиных' созданы специально для семей с детьми. Призы гарантированы!"
//         ],
//         secret: [
//             "🤫 Секретное место: На крыше консерватории есть смотровая площадка, откуда открывается лучший вид на город. Доступ по предварительной записи!",
//             "🗝️ Мало кто знает, но в подвалах Радищевского музея хранится коллекция масонских артефактов. Экскурсии проводятся раз в месяц.",
//             "💎 Скрытая жемчужина: Во дворе дома на Московской, 155 сохранился старинный фонтан 19 века. Местные называют его 'фонтаном желаний'."
//         ]
//     },
    
//     chatHistory: [],
//     isTyping: false,
    
//     init() {
//         // Initialize AI chat
//         this.addMessage('ai', this.getGreeting());
//     },
    
//     getGreeting() {
//         const hour = new Date().getHours();
//         let greeting = hour < 12 ? 'Доброе утро' : hour < 18 ? 'Добрый день' : 'Добрый вечер';
//         return `${greeting}! Я Сара - ваш виртуальный гид по Саратову. Я знаю всё о 435-летней истории города. Что вас интересует?`;
//     },
    
//     async processMessage(message) {
//         this.addMessage('user', message);
//         this.showTypingIndicator();
        
//         // Simulate AI processing time
//         await new Promise(resolve => setTimeout(resolve, 1500));
        
//         const response = this.generateResponse(message);
//         this.hideTypingIndicator();
//         this.addMessage('ai', response);
//     },
    
//     generateResponse(message) {
//         const lowerMessage = message.toLowerCase();
        
//         // Check for keywords
//         if (lowerMessage.includes('истор') || lowerMessage.includes('когда') || lowerMessage.includes('основан')) {
//             return this.getRandomResponse('history');
//         } else if (lowerMessage.includes('есть') || lowerMessage.includes('ресторан') || lowerMessage.includes('кафе') || lowerMessage.includes('еда')) {
//             return this.getRandomResponse('food');
//         } else if (lowerMessage.includes('маршрут') || lowerMessage.includes('куда') || lowerMessage.includes('посмотреть')) {
//             return this.getRandomResponse('route');
//         } else if (lowerMessage.includes('дет') || lowerMessage.includes('ребен') || lowerMessage.includes('семь')) {
//             return this.getRandomResponse('kids');
//         } else if (lowerMessage.includes('секрет') || lowerMessage.includes('тайн') || lowerMessage.includes('скрыт')) {
//             return this.getRandomResponse('secret');
//         } else {
//             return this.getDefaultResponse();
//         }
//     },
    
//     getRandomResponse(category) {
//         const responses = this.responses[category];
//         if (!responses) return this.getDefaultResponse();
//         return responses[Math.floor(Math.random() * responses.length)];
//     },
    
//     getDefaultResponse() {
//         const defaults = [
//             "Интересный вопрос! Давайте я помогу вам составить персональный маршрут по Саратову. Что вас больше интересует - история, культура или развлечения?",
//             "Саратов полон удивительных мест! Расскажите, сколько у вас времени и какие места вы уже посетили?",
//             "Я могу рассказать вам о скрытых жемчужинах города, которые не найти в обычных путеводителях. Хотите узнать секретные места?"
//         ];
//         return defaults[Math.floor(Math.random() * defaults.length)];
//     },
    
//     addMessage(sender, text) {
//         const chatContainer = document.getElementById('chatContainer');
//         if (!chatContainer) return;
        
//         const messageHtml = sender === 'ai' 
//             ? this.createAIMessage(text)
//             : this.createUserMessage(text);
        
//         chatContainer.querySelector('.space-y-4').insertAdjacentHTML('beforeend', messageHtml);
//         chatContainer.scrollTop = chatContainer.scrollHeight;
        
//         this.chatHistory.push({ sender, text, timestamp: Date.now() });
//     },
    
//     createAIMessage(text) {
//         return `
//             <div class="flex items-start space-x-3 animate-fadeIn">
//                 <div class="w-10 h-10 bg-linear-to-r from-green-400 to-teal-500 rounded-full flex items-center justify-center">
//                     <i class="fas fa-robot text-white"></i>
//                 </div>
//                 <div class="bg-gray-100 rounded-2xl rounded-tl-none p-4 max-w-md">
//                     <p class="font-semibold mb-1">Сара</p>
//                     <p>${text}</p>
//                 </div>
//             </div>
//         `;
//     },
    
//     createUserMessage(text) {
//         return `
//             <div class="flex items-start space-x-3 justify-end animate-fadeIn">
//                 <div class="bg-blue-500 text-white rounded-2xl rounded-tr-none p-4 max-w-md">
//                     <p>${text}</p>
//                 </div>
//                 <div class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center">
//                     <i class="fas fa-user text-white"></i>
//                 </div>
//             </div>
//         `;
//     },
    
//     showTypingIndicator() {
//         this.isTyping = true;
//         const chatContainer = document.getElementById('chatContainer');
//         if (!chatContainer) return;
        
//         const typingHtml = `
//             <div class="flex items-start space-x-3 typing-indicator">
//                 <div class="w-10 h-10 bg-linear-to-r from-green-400 to-teal-500 rounded-full flex items-center justify-center">
//                     <i class="fas fa-robot text-white"></i>
//                 </div>
//                 <div class="bg-gray-100 rounded-2xl rounded-tl-none p-4">
//                     <div class="flex space-x-2">
//                         <div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce"></div>
//                         <div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 0.1s"></div>
//                         <div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 0.2s"></div>
//                     </div>
//                 </div>
//             </div>
//         `;
        
//         chatContainer.querySelector('.space-y-4').insertAdjacentHTML('beforeend', typingHtml);
//         chatContainer.scrollTop = chatContainer.scrollHeight;
//     },
    
//     hideTypingIndicator() {
//         const indicator = document.querySelector('.typing-indicator');
//         if (indicator) indicator.remove();
//         this.isTyping = false;
//     }
// };

// City Quests Module
const QuestModule = {
    activeQuests: [
        {
            id: 'old-city',
            name: 'Тайны старого города',
            description: 'Разгадайте исторические загадки',
            points: [
                { id: 1, name: 'Консерватория', lat: 51.5339, lng: 46.0345, clue: 'Где звучит музыка с 1912 года', qrCode: 'QR_CONSERVATORY' },
                { id: 2, name: 'Радищевский музей', lat: 51.5275, lng: 46.0411, clue: 'Первый публичный музей провинции', qrCode: 'QR_MUSEUM' },
                { id: 3, name: 'Троицкий собор', lat: 51.5283, lng: 46.0444, clue: 'Древнейший храм города', qrCode: 'QR_CATHEDRAL' }
            ],
            reward: 'Ужин на двоих в ресторане "Волга"',
            duration: '2 часа',
            difficulty: 'medium'
        },
        {
            id: 'circus',
            name: 'По следам братьев Никитиных',
            description: 'История первого русского цирка',
            points: [
                { id: 1, name: 'Цирк', lat: 51.5289, lng: 46.0478, clue: 'Манеж под куполом', qrCode: 'QR_CIRCUS' },
                { id: 2, name: 'Памятник братьям', lat: 51.5295, lng: 46.0480, clue: 'Основатели русского цирка', qrCode: 'QR_MONUMENT' }
            ],
            reward: 'Билеты в цирк для всей семьи',
            duration: '1.5 часа',
            difficulty: 'easy'
        },
        {
            id: 'space',
            name: 'Космическая одиссея Гагарина',
            description: 'Путь первого космонавта',
            points: [
                { id: 1, name: 'Набережная Космонавтов', lat: 51.5250, lng: 46.0000, clue: 'Место приземления', qrCode: 'QR_LANDING' },
                { id: 2, name: 'Парк Победы', lat: 51.5553, lng: 46.0733, clue: 'Музей космонавтики', qrCode: 'QR_SPACE_MUSEUM' }
            ],
            reward: 'Полет на воздушном шаре над Волгой',
            duration: '3 часа',
            difficulty: 'hard'
        }
    ],
    
    currentQuest: null,
    completedPoints: [],
    
    startQuest(questId) {
        const quest = this.activeQuests.find(q => q.id === questId);
        if (!quest) return;
        
        this.currentQuest = quest;
        this.completedPoints = [];
        this.showQuestInterface(quest);
    },
    
    showQuestInterface(quest) {
        const modal = document.createElement('div');
        modal.className = 'fixed inset-0 bg-black/80 z-50 overflow-y-auto';
        modal.innerHTML = `
            <div class="min-h-screen flex items-center justify-center p-4">
                <div class="bg-white rounded-2xl max-w-2xl w-full p-6 relative">
                    <button onclick="QuestModule.closeQuest()" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                    
                    <div class="mb-6">
                        <h3 class="text-2xl font-bold mb-2">${quest.name}</h3>
                        <p class="text-gray-600 mb-4">${quest.description}</p>
                        
                        <div class="flex items-center space-x-4 text-sm text-gray-500 mb-4">
                            <span><i class="fas fa-clock mr-1"></i>${quest.duration}</span>
                            <span><i class="fas fa-map-marked-alt mr-1"></i>${quest.points.length} точек</span>
                            <span><i class="fas fa-signal mr-1"></i>${this.getDifficultyText(quest.difficulty)}</span>
                        </div>
                        
                        <div class="bg-linear-to-r from-yellow-50 to-orange-50 rounded-lg p-4 mb-6">
                            <p class="font-semibold text-orange-800 mb-2">🎁 Награда:</p>
                            <p class="text-lg">${quest.reward}</p>
                        </div>
                    </div>
                    
                    <div class="space-y-4 mb-6">
                        <h4 class="font-semibold mb-3">Контрольные точки:</h4>
                        ${quest.points.map((point, index) => `
                            <div class="flex items-center space-x-4 p-4 bg-gray-50 rounded-lg flex-col sm:flex-row gap-2">
                                <div class="w-10 h-10 bg-blue-500 text-white rounded-full flex items-center justify-center font-bold">
                                    ${index + 1}
                                </div>
                                <div class="flex-1 flex flex-col items-center">
                                    <p class="font-semibold">${point.name}</p>
                                    <p class="text-sm text-gray-600">${point.clue}</p>
                                </div>
                                <button onclick="QuestModule.showQRScanner('${point.qrCode}')" 
                                        class="bg-blue-100 text-blue-600 px-4 py-2 rounded-lg hover:bg-blue-200 transition">
                                    <i class="fas fa-qrcode mr-2"></i>Сканировать
                                </button>
                            </div>
                        `).join('')}
                    </div>
                    
                    <div class="grid grid-cols-2 gap-4">
                        <button onclick="QuestModule.showQuestMap('${quest.id}')" 
                                class="bg-gray-200 text-gray-700 px-6 py-3 rounded-lg hover:bg-gray-300 transition">
                            <i class="fas fa-map mr-2"></i>Показать на карте
                        </button>
                        <button onclick="QuestModule.startQuestTimer('${quest.id}')" 
                                class="bg-linear-to-r from-blue-500 to-purple-600 text-white px-6 py-3 rounded-lg hover:shadow-lg transition">
                            <i class="fas fa-play mr-2"></i>Начать квест
                        </button>
                    </div>
                </div>
            </div>
        `;
        document.body.appendChild(modal);
    },
    
    getDifficultyText(difficulty) {
        const levels = {
            easy: 'Легкий',
            medium: 'Средний',
            hard: 'Сложный'
        };
        return levels[difficulty] || 'Средний';
    },
    
    showQRScanner(qrCode) {
        // Simulate QR scanning
        window.showNotification('QR-сканер откроется в мобильном приложении', 'info');
        
        // Simulate successful scan after delay
        setTimeout(() => {
            this.completePoint(qrCode);
        }, 2000);
    },
    
    completePoint(qrCode) {
        if (!this.currentQuest) return;
        
        const point = this.currentQuest.points.find(p => p.qrCode === qrCode);
        if (point && !this.completedPoints.includes(point.id)) {
            this.completedPoints.push(point.id);
            
            window.showNotification(`Точка "${point.name}" пройдена! +100 баллов`, 'success');
            window.addBonusPoints(100);
            
            // Check if quest completed
            if (this.completedPoints.length === this.currentQuest.points.length) {
                this.completeQuest();
            }
        }
    },
    
    completeQuest() {
        window.unlockAchievement(
            `quest_${this.currentQuest.id}`,
            `Квест "${this.currentQuest.name}" завершен!`,
            this.currentQuest.reward
        );
        
        // Show completion modal
        this.showCompletionModal();
    },
    
    showCompletionModal() {
        const modal = document.createElement('div');
        modal.className = 'fixed inset-0 bg-black/80 z-[60] flex items-center justify-center p-4';
        modal.innerHTML = `
            <div class="bg-white rounded-2xl max-w-md w-full p-6 text-center animate-fadeIn">
                <div class="w-24 h-24 bg-linear-to-r from-yellow-400 to-orange-500 rounded-full mx-auto mb-4 flex items-center justify-center">
                    <i class="fas fa-trophy text-white text-4xl animate-bounce"></i>
                </div>
                
                <h3 class="text-2xl font-bold mb-2">Квест завершен!</h3>
                <p class="text-gray-600 mb-4">Поздравляем! Вы успешно прошли квест "${this.currentQuest.name}"</p>
                
                <div class="bg-linear-to-r from-yellow-50 to-orange-50 rounded-lg p-4 mb-6">
                    <p class="font-semibold text-orange-800 mb-2">Ваша награда:</p>
                    <p class="text-lg font-bold">${this.currentQuest.reward}</p>
                    <p class="text-sm text-gray-600 mt-2">Код для получения: QUEST${Date.now()}</p>
                </div>
                
                <button onclick="this.closest('.fixed').remove()" 
                        class="w-full bg-linear-to-r from-yellow-400 to-orange-500 text-white px-6 py-3 rounded-lg font-semibold hover:shadow-lg transition">
                    Отлично!
                </button>
            </div>
        `;
        document.body.appendChild(modal);
    },
    
    showQuestMap(questId) {
        const quest = this.activeQuests.find(q => q.id === questId);
        if (!quest) return;
        
        // Show quest points on map
        if (window.mapModule) {
            quest.points.forEach(point => {
                // Add special markers for quest points
                console.log('Adding quest point to map:', point);
            });
        }
        
        window.showNotification('Точки квеста отмечены на карте', 'success');
    },
    
    startQuestTimer(questId) {
        this.closeQuest();
        window.showNotification('Квест начат! Удачи в поисках!', 'success');
    },
    
    closeQuest() {
        const modal = document.querySelector('.fixed.inset-0');
        if (modal) modal.remove();
    }
};

// Voice Input Module
const VoiceModule = {
    recognition: null,
    isListening: false,
    
    init() {
        if ('webkitSpeechRecognition' in window || 'SpeechRecognition' in window) {
            const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
            this.recognition = new SpeechRecognition();
            this.recognition.lang = 'ru-RU';
            this.recognition.continuous = false;
            this.recognition.interimResults = false;
            
            this.recognition.onresult = (event) => {
                const transcript = event.results[0][0].transcript;
                this.processVoiceInput(transcript);
            };
            
            this.recognition.onerror = (event) => {
                console.error('Voice recognition error:', event.error);
                this.stopListening();
            };
        }
    },
    
    startListening() {
        if (!this.recognition) {
            window.showNotification('Голосовой ввод не поддерживается в вашем браузере', 'warning');
            return;
        }
        
        if (this.isListening) return;
        
        this.isListening = true;
        this.recognition.start();
        window.showNotification('Говорите...', 'info');
    },
    
    stopListening() {
        if (this.recognition && this.isListening) {
            this.recognition.stop();
            this.isListening = false;
        }
    },
    
    processVoiceInput(text) {
        const input = document.getElementById('aiChatInput');
        if (input) {
            input.value = text;
            // AIGuideModule.processMessage(text);
            if (window.handleChatMessage) {
                window.handleChatMessage(text);
            }
        }
    }
};

// Initialize all innovative modules
function initInnovations() {
    ARModule.init();
    // AIGuideModule.init();
    VoiceModule.init();
}

// Global functions for button handlers
function startARExperience() {
    ARModule.startExperience();
}

function askAI(topic) {
    const questions = {
        history: 'Расскажите об истории Саратова',
        food: 'Где можно вкусно поесть в Саратове?',
        route: 'Предложите маршрут на один день',
        kids: 'Что посмотреть с детьми?'
    };
    
    const question = questions[topic];
    if (question) {
        // AIGuideModule.processMessage(question);
        if (window.handleChatMessage) {
            window.handleChatMessage(question);
        }
    }
}

function sendToAI() {
    const input = document.getElementById('aiChatInput');
    if (input && input.value.trim()) {
        // AIGuideModule.processMessage(input.value.trim());
        if (window.handleChatMessage) {
            window.handleChatMessage(input.value.trim());
        }
        input.value = '';
    }
}

function voiceInput() {
    VoiceModule.startListening();
}

function startQuest(questId) {
    QuestModule.startQuest(questId);
}

window.startARExperience = startARExperience;
window.startQuest = startQuest;
window.QuestModule = QuestModule;
window.ARModule = ARModule;
window.VoiceModule = VoiceModule;

// Add animations CSS
const style = document.createElement('style');
style.textContent = `
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    .animate-fadeIn {
        animation: fadeIn 0.3s ease;
    }
`;
document.head.appendChild(style);

// Initialize when DOM is ready
document.addEventListener('DOMContentLoaded', initInnovations);

// Export for global use
window.innovationsModule = {
    ARModule,
    // AIGuideModule,
    QuestModule,
    VoiceModule
};