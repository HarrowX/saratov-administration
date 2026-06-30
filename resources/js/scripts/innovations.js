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
    VoiceModule
};
