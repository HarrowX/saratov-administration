<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="icon" type="images/jpeg" href="images/gerb-goroda-saratov.jpg">
        <link rel="shortcut icon" type="images/jpeg" href="images/gerb-goroda-saratov.jpg">
        <link rel="apple-touch-icon" href="images/gerb-goroda-saratov.jpg">

        <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>

        @livewireStyles()
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css'])
        @endif

        <title> @yield('title', config('app.name')) </title>
    </head>

    <body>
        @livewire('header')

        {{ $slot }}

        @livewire('calendar')
        @livewire('profile-modal')
        @livewire('footer')

        <script>
            // Initialize all modules when page loads
            document.addEventListener('DOMContentLoaded', function() {
                // Initialize chatbot
                ChatBot.init();
                
                // Show app download modal
                window.showAppDownload = function() {
                    const modal = document.createElement('div');
                    modal.className = 'fixed inset-0 bg-black/80 z-50 flex items-center justify-center p-4';
                    modal.innerHTML = `
                        <div class="bg-white rounded-2xl max-w-md w-full p-6 text-center">
                            <button onclick="this.closest('.fixed').remove()" class="float-right text-gray-400 hover:text-gray-600">
                                <i class="fas fa-times text-xl"></i>
                            </button>
                            
                            <div class="w-20 h-20 rounded-2xl mx-auto mb-4 overflow-hidden">
                                <img src="images/gerb-goroda-saratov.jpg" alt="Герб Саратова">
                            </div>
                            
                            <h3 class="text-2xl font-bold mb-2">Скачайте приложение</h3>
                            <p class="text-gray-600 mb-6">Получите полный доступ ко всем функциям</p>
                            
                            <div class="w-48 h-48 mx-auto rounded-lg overflow-hidden mb-4">
                                <img src="image/qrprila.jpg" alt="QR-код для скачивания">
                            </div>
                            
                            <div class="flex flex-col space-y-3">
                                <a href="#" class="bg-black text-white px-6 py-3 rounded-lg hover:bg-gray-800 transition flex items-center justify-center space-x-3">
                                    <i class="fab fa-apple text-2xl"></i>
                                    <div class="text-left">
                                        <div class="text-xs">Загрузите в</div>
                                        <div class="font-semibold">App Store</div>
                                    </div>
                                </a>
                                <a href="#" class="bg-black text-white px-6 py-3 rounded-lg hover:bg-gray-800 transition flex items-center justify-center space-x-3">
                                    <i class="fab fa-google-play text-2xl"></i>
                                    <div class="text-left">
                                        <div class="text-xs">Доступно в</div>
                                        <div class="font-semibold">Google Play</div>
                                    </div>
                                </a>
                            </div>
                            
                            <p class="text-sm text-gray-500 mt-4">Или перейдите по ссылке: saratov-435.ru/app</p>
                        </div>
                    `;
                    document.body.appendChild(modal);
                };
                
                // Send user message in chatbot
                window.sendUserMessage = function() {
                    const input = document.getElementById('aiChatInput');
                    if (input && input.value.trim()) {
                        ChatBot.processUserResponse(input.value.trim(), 'text');
                        input.value = '';
                    }
                };
                
                // // Handle chat message (for quick actions and general input)
                // window.handleChatMessage = function(message) {
                //     if (message && message.trim()) {
                //         ChatBot.processUserResponse(message.trim(), 'text');
                //     }
                // };
                
                // Show profile function
                window.showProfile = function(userId) {
                    const profiles = {
                        alexander: {
                            name: "Александр М.",
                            avatar: "https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=200&h=200&fit=crop&crop=face",
                            stats: "15 квестов • 3,450 баллов",
                            achievements: ["🏆 Первое место", "🎯 5 квестов подряд", "⭐ 100% точность"],
                            bio: "Активный исследователь Саратова. Любит исторические квесты и фотографию."
                        },
                        maria: {
                            name: "Мария К.",
                            avatar: "https://images.unsplash.com/photo-1494790108755-2616b612b786?w=200&h=200&fit=crop&crop=face",
                            stats: "12 квестов • 2,890 баллов",
                            achievements: ["🥈 Второе место", "🎨 Творческие квесты", "📸 Лучшие фото"],
                            bio: "Творческая личность, увлекается искусством и культурой Саратова."
                        },
                        ivanov: {
                            name: "Семья Ивановых",
                            avatar: "https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=200&h=200&fit=crop&crop=face",
                            stats: "10 квестов • 2,340 баллов",
                            achievements: ["🥉 Третье место", "👨‍👩‍👧‍👦 Семейные квесты", "🎪 Развлечения"],
                            bio: "Дружная семья, которая любит проводить время вместе, изучая город."
                        }
                    };
                    
                    const profile = profiles[userId];
                    if (!profile) return;
                    
                    const modal = document.createElement('div');
                    modal.className = 'fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4';
                    modal.innerHTML = `
                        <div class="bg-white rounded-2xl p-8 max-w-md w-full">
                            <div class="text-center mb-6">
                                <img src="${profile.avatar}" alt="${profile.name}" class="w-24 h-24 rounded-full mx-auto mb-4">
                                <h3 class="text-2xl font-bold">${profile.name}</h3>
                                <p class="text-gray-600">${profile.stats}</p>
                            </div>
                            
                            <div class="mb-6">

                                <h4 class="font-semibold mb-3">🏆 Достижения</h4>
                                <div class="space-y-2">
                                    ${profile.achievements.map(achievement => `
                                        <div class="flex items-center space-x-2 text-sm">
                                            <span>${achievement}</span>
                                        </div>
                                    `).join('')}
                                </div>
                            </div>
                            
                            <div class="mb-6">
                                <h4 class="font-semibold mb-3">📝 О себе</h4>
                                <p class="text-gray-600 text-sm">${profile.bio}</p>
                            </div>
                            
                            <button onclick="this.closest('.fixed').remove()" class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600 transition">
                                Закрыть
                            </button>
                        </div>
                    `;
                    
                    document.body.appendChild(modal);
                };
                
                // Voice input function
                window.voiceInput = function() {
                    if ('webkitSpeechRecognition' in window || 'SpeechRecognition' in window) {
                        const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
                        const recognition = new SpeechRecognition();
                        
                        recognition.lang = 'ru-RU';
                        recognition.continuous = false;
                        recognition.interimResults = false;
                        
                        recognition.onstart = function() {
                            document.getElementById('aiChatInput').placeholder = 'Слушаю...';
                        };
                        
                        recognition.onresult = function(event) {
                            const transcript = event.results[0][0].transcript;
                            document.getElementById('aiChatInput').value = transcript;
                            ChatBot.processUserResponse(transcript, 'text');
                        };
                        
                        recognition.onerror = function(event) {
                            console.log('Ошибка распознавания речи:', event.error);
                            document.getElementById('aiChatInput').placeholder = 'Напишите сообщение...';
                        };
                        
                        recognition.onend = function() {
                            document.getElementById('aiChatInput').placeholder = 'Напишите сообщение...';
                        };
                        
                        recognition.start();
                    } else {
                        alert('Ваш браузер не поддерживает распознавание речи');
                    }
                };
                
            });
        </script>
    </body>

    @livewireScripts()
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/js/app.js'])
    @endif
</html>
