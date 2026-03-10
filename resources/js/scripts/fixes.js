// Файл с исправлениями и улучшениями функционала

// ========================================
// 1. ИСПРАВЛЕНИЕ ВЫРАВНИВАНИЯ КНОПОК APP STORE И GOOGLE PLAY
// ========================================

import { Fancybox } from "@fancyapps/ui";
import '@fancyapps/ui/dist/fancybox/fancybox.css'


// ========================================
// 5. ИСПРАВЛЕНИЕ ЧАТА-БОТА
// ========================================
function fixChatbot() {
    if (window.handleChatMessage) {
        delete window.handleChatMessage;
    }
    
    window.handleChatMessage = function(message) {
        if (window.chatbotProcessing) {
            return;
        }
        
        window.chatbotProcessing = true;
        
        const chatMessages = document.getElementById('chat-messages');
        if (!chatMessages) {
            window.chatbotProcessing = false;
            return;
        }
        
        const input = document.getElementById('aiChatInput');
        if (input) {
            input.value = '';
        }
        
        const userMessage = document.createElement('div');
        userMessage.className = 'flex justify-end mb-4';
        userMessage.innerHTML = `
            <div class="bg-blue-500 text-white rounded-lg px-4 py-2 max-w-xs">
                ${escapeHtml(message)}
            </div>
        `;
        chatMessages.appendChild(userMessage);
        
        chatMessages.scrollTop = chatMessages.scrollHeight;
        
        setTimeout(() => {
            const botMessage = document.createElement('div');
            botMessage.className = 'flex justify-start mb-4';
            
            let response = getBotResponse(message);
            
            botMessage.innerHTML = `
                <div class="flex items-start space-x-2">
                    <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-robot text-white text-sm"></i>
                    </div>
                    <div class="bg-gray-100 rounded-lg px-4 py-2 max-w-xs">
                        <p class="font-semibold text-sm mb-1">Сара</p>
                        <p class="text-gray-700">${escapeHtml(response)}</p>
                    </div>
                </div>
            `;
            chatMessages.appendChild(botMessage);
            
            chatMessages.scrollTop = chatMessages.scrollHeight;
            
            window.chatbotProcessing = false;
        }, 1000);
    };
}
function escapeHtml(text) {
    const div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML;
}

function getBotResponse(message) {
    const lowerMessage = message.toLowerCase().trim();
    
    const responses = {
        'привет': 'Привет! Я Сара - ваш виртуальный гид по Саратову. Чем могу помочь?',
        'start': 'Отлично! Давайте начнём знакомство с Саратовом. Что вас интересует: достопримечательности, рестораны, музеи или развлечения?',
        'достопримечательности': 'В Саратове множество интересных мест! Рекомендую посетить Набережную Космонавтов, Саратовскую консерваторию, Парк Победы. Хотите узнать больше о конкретном месте?',
        'рестораны': 'Отличный выбор! Рекомендую: "Волга" - панорамный ресторан, "Кофейня Гагарин" - уютное кафе в центре, "Дружба" - традиционная кухня. Что предпочитаете?',
        'музеи': 'Саратов богат музеями! Обязательно посетите Музей Радищева - первый художественный музей в провинции, Краеведческий музей, Музей Гагарина.',
        'парки': 'Для прогулок рекомендую Городской парк культуры и отдыха, Парк Победы с музеем военной техники, Лимонарий с экзотическими растениями.',
        'как добраться': 'Я могу помочь построить маршрут! Укажите, куда хотите попасть, и я подскажу оптимальный путь.',
        'погода': 'Сегодня в Саратове комфортная погода для прогулок! Температура около +20°C, без осадков. Отличный день для исследования города!',
        'где поесть': 'Рядом с вами есть несколько отличных заведений: кафе "Волжский бриз", ресторан "Саратов", пиццерия "Италия". Что предпочитаете?',
        'что посмотреть': 'Начните с главных достопримечательностей: Набережная Космонавтов, проспект Кирова (Саратовский Арбат), Троицкий собор. За один день можно успеть посетить 3-4 места.',
        'история': 'Саратов основан в 1590 году как сторожевая крепость. Город связан с именами Чернышевского, Радищева, Столыпина. Здесь приземлился Гагарин после первого полёта в космос!',
        'гагарин': 'Юрий Гагарин учился в Саратове и здесь же приземлился после первого полёта в космос 12 апреля 1961 года. Обязательно посетите Набережную Космонавтов и музей Гагарина!',
        'спасибо': 'Всегда рада помочь! Если нужна ещё информация - просто спросите. Хорошего дня в Саратове!',
        'события': 'Сегодня в Саратове проходят: концерт в филармонии, выставка в музее Радищева, фестиваль уличной еды на набережной. Что вас интересует?',
        'шопинг': 'В Саратове есть множество мест для шопинга — от крупных торговых центров до рынков. Вот некоторые из них: ТЦ "Happy Молл", ТЦ "Тау Галерея", Гостиный двор. Также рекомендую посетить ярмарку выходного дня на Театральной площади.'
    };
    
    for (let key in responses) {
        if (lowerMessage === key || lowerMessage.includes(key)) {
            return responses[key];
        }
    }
    
    return 'Интересный вопрос! Могу рассказать о достопримечательностях, ресторанах, музеях, парках Саратова. Что вас интересует?';
}

document.addEventListener('DOMContentLoaded', function() {
    fixChatbot();
    
    setTimeout(() => {
        const chatMessages = document.getElementById('chat-messages');
        if (chatMessages && chatMessages.children.length === 0) {
            const welcomeMessage = document.createElement('div');
            welcomeMessage.className = 'flex justify-start mb-4';
            welcomeMessage.innerHTML = `
                <div class="flex items-start space-x-2">
                    <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-robot text-white text-sm"></i>
                    </div>
                    <div class="bg-gray-100 rounded-lg px-4 py-2 max-w-xs">
                        <p class="font-semibold text-sm mb-1">Сара</p>
                        <p class="text-gray-700">Добрый вечер! 👋 Я Сара - ваш виртуальный гид по Саратову. Я помогу вам спланировать идеальный день в нашем городе. Готовы начать?</p>
                    </div>
                </div>
            `;
            chatMessages.appendChild(welcomeMessage);
        }
    }, 500);
});

// ========================================
// 6. ИСПРАВЛЕНИЕ ГАЛЕРЕИ ФОТОГРАФИЙ
// ========================================
//fancybox
Fancybox.bind('[data-fancybox="gallery"]',{
    
});

Fancybox.bind('[data-fancybox="full-gallery"]',{
    
});

document.querySelectorAll('.btn-gallery').forEach(btn => {
btn.addEventListener('click', function(e) {
    e.preventDefault();
    
    const galleryName = this.getAttribute('data-gallery');
    
    if (galleryName) {
    const firstImage = document.querySelector(`[data-fancybox="full-gallery"]`);
    
    if (firstImage) {
        firstImage.click();
    }
    }
});
});

// ========================================
// 7. ПОСТРОЕНИЕ МАРШРУТА
// ========================================
function buildRoute(attractionId) {
    const attraction = attractionsData.find(a => a.id === attractionId);
    if (!attraction) return;
    
    // Закрыть модальное окно если открыто
    const modal = document.querySelector('.fixed');
    if (modal) modal.remove();
    
    // Показать уведомление
    showNotification(`Маршрут до "${attraction.title}" построен! Следуйте указаниям на карте.`, 'success');
    
    // Перейти к карте
    showOnMap(attractionId);
}

// ========================================
// ИНИЦИАЛИЗАЦИЯ ВСЕХ ИСПРАВЛЕНИЙ
// ========================================
document.addEventListener('DOMContentLoaded', function() {
    // Применяем все исправления
    // createAttractionsCarousel();
    fixChatbot();
    
    // Добавляем глобальные функции
    window.buildRoute = buildRoute;
});

// ========================================
// 9. ФУНКЦИИ ДЛЯ БИЗНЕС-ПРЕДЛОЖЕНИЙ
// ========================================
const businessOffers = [
    {
        id: 1,
        name: 'Ресторан "Волга"',
        discount: '-20%',
        description: 'Скидка на все меню по промокоду SARATOV435',
        validUntil: 'До 31 декабря',
        category: 'restaurant',
        address: 'ул. Набережная Космонавтов, 1',
        phone: '+7 (845) 223-45-67'
    },
    {
        id: 2,
        name: 'Кофейня "Гагарин"',
        discount: '2+1',
        description: 'Третий кофе в подарок для пользователей приложения',
        validUntil: 'Постоянно',
        category: 'cafe',
        address: 'пр. Кирова, 12',
        phone: '+7 (845) 234-56-78'
    },
    {
        id: 3,
        name: 'Музей краеведения',
        discount: '-30%',
        description: 'Скидка на семейные билеты',
        validUntil: 'По выходным',
        category: 'museum',
        address: 'ул. Лермонтова, 34',
        phone: '+7 (845) 245-67-89'
    },
    {
        id: 4,
        name: 'Пиццерия "Италия"',
        discount: '-15%',
        description: 'Скидка на доставку',
        validUntil: 'Ежедневно',
        category: 'restaurant'
    },
    {
        id: 5,
        name: 'СПА-центр "Волжские бани"',
        discount: '-25%',
        description: 'На комплексные программы',
        validUntil: 'Будни до 17:00',
        category: 'spa'
    },
    {
        id: 6,
        name: 'Фитнес-клуб "Энергия"',
        discount: '50%',
        description: 'Первое занятие',
        validUntil: 'Для новых клиентов',
        category: 'fitness'
        }
];

function showOfferDetails(offerId) {
    const offer = businessOffers.find(o => o.id === offerId);
    if (!offer) return;
    
    const modal = document.createElement('div');
    modal.className = 'fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4';
    modal.innerHTML = `
        <div class="bg-white rounded-2xl max-w-md w-full">
            <div class="bg-linear-to-r from-blue-500 to-purple-600 p-6 rounded-t-2xl text-white">
                <div class="flex justify-between items-start">
                    <div>
                        <span class="inline-block bg-white/20 backdrop-blur px-3 py-1 rounded-full text-lg font-bold mb-2">
                            ${offer.discount}
                        </span>
                        <h2 class="text-2xl font-bold">${offer.name}</h2>
                    </div>
                    <button onclick="this.closest('.fixed').remove()" class="text-white/80 hover:text-white">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
            </div>
            
            <div class="p-6">
                <p class="text-gray-600 mb-4">${offer.description}</p>
                
                <div class="space-y-3 mb-6">
                    <div class="flex items-center text-gray-600">
                        <i class="fas fa-clock w-5 mr-3"></i>
                        <span>${offer.validUntil}</span>
                    </div>
                    <div class="flex items-center text-gray-600">
                        <i class="fas fa-map-marker-alt w-5 mr-3"></i>
                        <span>${offer.address}</span>
                    </div>
                    <div class="flex items-center text-gray-600">
                        <i class="fas fa-phone w-5 mr-3"></i>
                        <span>${offer.phone}</span>
                    </div>
                </div>
                
                <div class="bg-gray-100 rounded-lg p-4 mb-6">
                    <p class="text-sm text-gray-500 mb-2">Промокод для получения скидки:</p>
                    <div class="flex items-center justify-between bg-white rounded-lg px-4 py-3">
                        <span class="font-mono font-bold text-lg">SARATOV435</span>
                        <button onclick="copyPromoCode('SARATOV435')" class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600 transition">
                            <i class="fas fa-copy"></i>
                        </button>
                    </div>
                </div>
                
                <div class="flex gap-3">
                    <button onclick="activateOffer(${offer.id})" class="flex-1 bg-linear-to-r from-blue-500 to-purple-600 text-white py-3 rounded-lg font-semibold hover:shadow-lg transition text-xs sm:text-base">
                        Активировать предложение
                    </button>
                    <button onclick="this.closest('.fixed').remove()" class="px-6 py-3 border border-gray-300 rounded-lg hover:bg-gray-50 transition text-xs sm:text-base">
                        Закрыть
                    </button>
                </div>
            </div>
        </div>
    `;
    
    document.body.appendChild(modal);
}

function showAllOffers() {
    const allOffers = [
        ...businessOffers,
        {
            id: 4,
            name: 'Пиццерия "Италия"',
            discount: '-15%',
            description: 'Скидка на доставку',
            validUntil: 'Ежедневно',
            category: 'restaurant'
        },
        {
            id: 5,
            name: 'СПА-центр "Волжские бани"',
            discount: '-25%',
            description: 'На комплексные программы',
            validUntil: 'Будни до 17:00',
            category: 'spa'
        },
        {
            id: 6,
            name: 'Фитнес-клуб "Энергия"',
            discount: '50%',
            description: 'Первое занятие',
            validUntil: 'Для новых клиентов',
            category: 'fitness'
        }
    ];
    
    const modal = document.createElement('div');
    modal.className = 'fixed inset-0 bg-black/50 z-50 overflow-y-auto';
    modal.innerHTML = `
        <div class="min-h-screen p-4">
            <div class="bg-white rounded-2xl max-w-4xl mx-auto">
                <div class="bg-linear-to-r from-blue-500 to-purple-600 p-6 rounded-t-2xl text-white flex justify-between items-center">
                    <h2 class="title3xl font-bold">Все предложения партнёров</h2>
                    <button onclick="this.closest('.fixed').remove()" class="text-white/80 hover:text-white relative -top-4 -right-1 sm:top-0 sm:right-4 cursor-pointer">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
                
                <div class="p-6">
                    <div class="grid md:grid-cols-2 gap-4">
                        ${allOffers.map(offer => `
                            <div onclick="showOfferDetails(${offer.id})" class="border rounded-lg p-4 hover:shadow-lg transition cursor-pointer">
                                <div class="flex justify-between items-start mb-2">
                                    <span class="bg-linear-to-r from-blue-500 to-purple-600 text-white px-3 py-1 rounded-full text-sm font-bold">
                                        ${offer.discount}
                                    </span>
                                    <span class="text-gray-500 text-sm">${offer.validUntil}</span>
                                </div>
                                <h3 class="font-semibold text-lg mb-1">${offer.name}</h3>
                                <p class="text-gray-600 text-sm">${offer.description}</p>
                            </div>
                        `).join('')}
                    </div>
                </div>
            </div>
        </div>
    `;
    
    document.body.appendChild(modal);
}

function activateOffer(offerId) {
    showNotification('Предложение активировано! Покажите этот экран на кассе.', 'success');
    // Сохранить в localStorage
    const activatedOffers = JSON.parse(localStorage.getItem('activatedOffers') || '[]');
    if (!activatedOffers.includes(offerId)) {
        activatedOffers.push(offerId);
        localStorage.setItem('activatedOffers', JSON.stringify(activatedOffers));
    }
}

function copyPromoCode(code) {
    navigator.clipboard.writeText(code);
    showNotification('Промокод скопирован!', 'success');
}

function showBusinessRegistration() {
    const modal = document.createElement('div');
    modal.className = 'fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4';
    modal.innerHTML = `
        <div class="bg-white rounded-2xl max-w-xl w-full">
            <div class="bg-linear-to-r from-blue-500 to-purple-600 p-6 rounded-t-2xl text-white">
                <h2 class="title3xl font-bold">Стать партнёром</h2>
                <p class="text text-white/80 mt-1">Присоединяйтесь к программе лояльности</p>
            </div>
            
            <form class="p-6 overflow-scroll max-h-120" onsubmit="event.preventDefault(); submitBusinessRegistration(event);">
                <div class="space-y-4">
                    <div>
                        <label class="block text-gray-700 mb-2">Название компании</label>
                        <input type="text" name="company_name" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>
                    
                    <div>
                        <label class="block text-gray-700 mb-2">Контактное лицо</label>
                        <input type="text" name="contact_person" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>
                    
                    <div>
                        <label class="block text-gray-700 mb-2">Телефон</label>
                        <input type="tel" name="phone" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>
                    
                    <div>
                        <label class="block text-gray-700 mb-2">Email</label>
                        <input type="email" name="email" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>
                    
                    <div>
                        <label class="block text-gray-700 mb-2">Тип бизнеса</label>
                        <select name="business_type" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="restaurant">Ресторан/Кафе</option>
                            <option value="shop">Магазин</option>
                            <option value="entertainment">Развлечения</option>
                            <option value="services">Услуги</option>
                            <option value="other">Другое</option>
                        </select>
                    </div>
                    
                    <div>
                        <label class="block text-gray-700 mb-2">Описание предложения</label>
                        <textarea name="description" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" rows="3" placeholder="Опишите, какие скидки или услуги вы готовы предложить пользователям"></textarea>
                    </div>
                </div>
                
                <div class="mt-4 text-xs text-gray-500">
                    <label class="flex items-start space-x-2">
                        <input type="checkbox" required class>
                        <span>Я согласен с <a href="#" class="text-blue-500 hover:text-blue-600 underline">обработкой персональных данных</a></span>
                    </label>
                </div>
                
                <div class="mt-6 flex gap-3">
                    <button type="submit" class="flex-1 bg-linear-to-r from-blue-500 to-purple-600 text-white py-3 rounded-lg font-semibold hover:shadow-lg transition">
                        Отправить заявку
                    </button>
                    <button type="button" onclick="this.closest('.fixed').remove()" class="px-6 py-3 border border-gray-300 rounded-lg hover:bg-gray-50 transition">
                        Отмена
                    </button>
                </div>
            </form>
        </div>
    `;
    
    document.body.appendChild(modal);
}

function submitBusinessRegistration(event) {
    event.preventDefault();
    
    const form = event.target;
    const formData = new FormData(form);
    
    // Send to Telegram
    if (window.TelegramIntegration) {
        window.TelegramIntegration.sendBusinessRegistration(formData);
    } else {
        console.error('TelegramIntegration not available');
        showNotification('Ошибка: Telegram интеграция недоступна', 'error');
    }
    
    // Close modal
    form.closest('.fixed').remove();
}

// Экспорт функций в глобальную область
window.showOfferDetails = showOfferDetails;
window.showAllOffers = showAllOffers;
window.activateOffer = activateOffer;
window.copyPromoCode = copyPromoCode;
window.showBusinessRegistration = showBusinessRegistration;
window.submitBusinessRegistration = submitBusinessRegistration;

// Экспорт для использования в других модулях
if (typeof module !== 'undefined' && module.exports) {
    module.exports = {
        buildRoute,
        // fixChatbot,
        // showAllPhotos,
        showOfferDetails,
        showAllOffers,
        showBusinessRegistration
    };
}