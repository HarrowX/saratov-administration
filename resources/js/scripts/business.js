// Business module for Saratov 435 - Coupons and discounts management

// Business partners data
const businessPartners = [
    {
        id: 1,
        name: 'Ресторан "Волга"',
        category: 'restaurant',
        description: 'Традиционная русская кухня с видом на Волгу',
        address: 'ул. Набережная Космонавтов, 1',
        phone: '+7 (845) 223-4567',
        website: 'volga-restaurant.ru',
        image: 'https://images.unsplash.com/photo-1555396273-367ea4eb4db5?w=400',
        rating: 4.7,
        offers: [
            {
                id: 'volga_20',
                type: 'discount',
                value: 20,
                title: 'Скидка 20% на все меню',
                description: 'По промокоду SARATOV435',
                validUntil: '2025-12-31',
                conditions: 'Не суммируется с другими акциями',
                code: 'SARATOV435'
            }
        ]
    },
    {
        id: 2,
        name: 'Кофейня "Гагарин"',
        category: 'cafe',
        description: 'Уютная кофейня в космическом стиле',
        address: 'пр. Кирова, 25',
        phone: '+7 (845) 234-5678',
        image: 'https://images.unsplash.com/photo-1554118811-1e0d58224f24?w=400',
        rating: 4.9,
        offers: [
            {
                id: 'gagarin_coffee',
                type: 'bonus',
                value: '2+1',
                title: 'Третий кофе в подарок',
                description: 'При покупке двух любых кофе',
                validUntil: '2025-12-31',
                conditions: 'Для пользователей приложения'
            }
        ]
    },
    {
        id: 3,
        name: 'Музей краеведения',
        category: 'museum',
        description: 'История Саратовского края',
        address: 'ул. Лермонтова, 34',
        phone: '+7 (845) 228-1234',
        website: 'sarmuzey.ru',
        image: 'https://images.unsplash.com/photo-1565402897815-193dbc25874f?w=400',
        rating: 4.6,
        offers: [
            {
                id: 'museum_family',
                type: 'discount',
                value: 30,
                title: 'Скидка 30% на семейные билеты',
                description: 'По выходным для семей с детьми',
                validUntil: '2025-12-31',
                conditions: 'Минимум 2 взрослых + 1 ребенок',
                daysOfWeek: [6, 0] // Saturday, Sunday
            }
        ]
    },
    {
        id: 4,
        name: 'Фитнес-центр "Энергия"',
        category: 'fitness',
        description: 'Современный фитнес-центр с бассейном',
        address: 'ул. Московская, 155',
        phone: '+7 (845) 245-6789',
        image: 'https://images.unsplash.com/photo-1534438327276-14e5300c3a48?w=400',
        rating: 4.5,
        offers: [
            {
                id: 'fitness_trial',
                type: 'free',
                title: 'Бесплатная тренировка',
                description: 'Пробное занятие с тренером',
                validUntil: '2025-12-31',
                conditions: 'Для новых клиентов',
                oneTime: true
            }
        ]
    },
    {
        id: 5,
        name: 'Кинотеатр "Победа"',
        category: 'entertainment',
        description: 'Современный мультиплекс',
        address: 'пл. Кирова, 1',
        phone: '+7 (845) 256-7890',
        image: 'https://images.unsplash.com/photo-1489599849927-2ee91cede3ba?w=400',
        rating: 4.7,
        offers: [
            {
                id: 'cinema_morning',
                type: 'discount',
                value: 50,
                title: 'Утренние сеансы -50%',
                description: 'На все сеансы до 12:00',
                validUntil: '2025-12-31',
                conditions: 'Ежедневно',
                timeRestriction: {
                    from: '09:00',
                    to: '12:00'
                }
            }
        ]
    },
    {
        id: 6,
        name: 'Пиццерия "Италия"',
        category: 'restaurant',
        description: 'Настоящая итальянская пицца',
        address: 'ул. Вольская, 89',
        phone: '+7 (845) 267-8901',
        image: 'https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?w=400',
        rating: 4.8,
        offers: [
            {
                id: 'pizza_birthday',
                type: 'gift',
                title: 'Пицца в подарок',
                description: 'В день рождения при заказе от 1500₽',
                validUntil: '2025-12-31',
                conditions: 'При предъявлении паспорта'
            }
        ]
    }
];

// User's saved coupons
let savedCoupons = JSON.parse(localStorage.getItem('savedCoupons') || '[]');
let usedCoupons = JSON.parse(localStorage.getItem('usedCoupons') || '[]');

// Get offer type badge
function getOfferTypeBadge(type, value) {
    const badges = {
        discount: `<span class="bg-red-100 text-red-600 px-3 py-1 rounded-full text-sm font-semibold">-${value}%</span>`,
        bonus: `<span class="bg-green-100 text-green-600 px-3 py-1 rounded-full text-sm font-semibold">${value}</span>`,
        free: `<span class="bg-blue-100 text-blue-600 px-3 py-1 rounded-full text-sm font-semibold">Бесплатно</span>`,
        gift: `<span class="bg-purple-100 text-purple-600 px-3 py-1 rounded-full text-sm font-semibold">Подарок</span>`
    };
    return badges[type] || '';
}

// Show all business offers
function showAllOffers() {
    const modal = document.createElement('div');
    modal.className = 'fixed inset-0 bg-black/50 z-50 overflow-y-auto';
    modal.innerHTML = `
        <div class="min-h-screen flex items-center justify-center p-4">
            <div class="bg-white rounded-2xl max-w-4xl w-full max-h-[90vh] overflow-hidden">
                <div class="sticky top-0 bg-white border-b p-6 flex justify-between items-center">
                    <div>
                        <h2 class="text-3xl font-bold mb-2">Все предложения</h2>
                        <p class="text-gray-600">Скидки и специальные предложения от партнеров</p>
                    </div>
                    <button onclick="this.closest('.fixed').remove()" class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times text-2xl"></i>
                    </button>
                </div>
                
                <div class="p-6">
                    <!-- Filter tabs -->
                    <div class="flex space-x-2 mb-6 overflow-x-auto">
                        <button onclick="filterOffers('all')" class="filter-tab active px-4 py-2 bg-blue-500 text-white rounded-lg">Все</button>
                        <button onclick="filterOffers('restaurant')" class="filter-tab px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300">Рестораны</button>
                        <button onclick="filterOffers('cafe')" class="filter-tab px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300">Кафе</button>
                        <button onclick="filterOffers('entertainment')" class="filter-tab px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300">Развлечения</button>
                        <button onclick="filterOffers('museum')" class="filter-tab px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300">Музеи</button>
                        <button onclick="filterOffers('fitness')" class="filter-tab px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300">Спорт</button>
                    </div>
                    
                    <!-- Offers grid -->
                    <div id="offersGrid" class="grid md:grid-cols-2 gap-6 max-h-[calc(90vh-250px)] overflow-y-auto">
                        ${renderAllOffers('all')}
                    </div>
                </div>
            </div>
        </div>
    `;
    
    document.body.appendChild(modal);
}

// Filter offers by category
function filterOffers(category) {
    const grid = document.getElementById('offersGrid');
    if (grid) {
        grid.innerHTML = renderAllOffers(category);
    }
    
    // Update active tab
    document.querySelectorAll('.filter-tab').forEach(tab => {
        tab.classList.remove('bg-blue-500', 'text-white');
        tab.classList.add('bg-gray-200', 'text-gray-700');
    });
    event.target.classList.remove('bg-gray-200', 'text-gray-700');
    event.target.classList.add('bg-blue-500', 'text-white');
}

// Render all offers
function renderAllOffers(category) {
    const filteredPartners = category === 'all' 
        ? businessPartners 
        : businessPartners.filter(p => p.category === category);
    
    if (filteredPartners.length === 0) {
        return '<p class="text-gray-500 text-center col-span-2">Нет доступных предложений в этой категории</p>';
    }
    
    return filteredPartners.map(partner => {
        return partner.offers.map(offer => renderOfferCard(partner, offer)).join('');
    }).join('');
}

// Render single offer card
function renderOfferCard(partner, offer) {
    const isSaved = savedCoupons.includes(offer.id);
    const isUsed = usedCoupons.includes(offer.id);
    
    return `
        <div class="bg-white border rounded-xl overflow-hidden hover:shadow-lg transition ${isUsed ? 'opacity-50' : ''}">
            <div class="relative h-48">
                <img src="${partner.image}" alt="${partner.name}" class="w-full h-full object-cover">
                <div class="absolute top-4 right-4">
                    ${getOfferTypeBadge(offer.type, offer.value)}
                </div>
            </div>
            <div class="p-4">
                <h4 class="font-bold text-lg mb-1">${offer.title}</h4>
                <p class="text-gray-600 text-sm mb-2">${partner.name}</p>
                <p class="text-gray-700 mb-3">${offer.description}</p>
                
                ${offer.code ? `
                    <div class="bg-gray-100 rounded-lg p-3 mb-3">
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-600">Промокод:</span>
                            <span class="font-mono font-bold text-lg">${offer.code}</span>
                        </div>
                    </div>
                ` : ''}
                
                <div class="flex items-center justify-between text-sm text-gray-500 mb-3">
                    <span><i class="fas fa-calendar-alt mr-1"></i>До ${formatDate(offer.validUntil)}</span>
                    <span><i class="fas fa-map-marker-alt mr-1"></i>${partner.address}</span>
                </div>
                
                ${offer.conditions ? `
                    <p class="text-xs text-gray-500 mb-3">${offer.conditions}</p>
                ` : ''}
                
                <div class="flex space-x-2">
                    ${!isUsed ? `
                        <button onclick="saveCoupon('${offer.id}', '${partner.name}', '${offer.title}')" 
                            class="flex-1 ${isSaved ? 'bg-gray-300' : 'bg-blue-500 hover:bg-blue-600'} text-white px-4 py-2 rounded-lg transition">
                            <i class="fas ${isSaved ? 'fa-check' : 'fa-bookmark'} mr-1"></i>
                            ${isSaved ? 'Сохранено' : 'Сохранить'}
                        </button>
                        <button onclick="useCoupon('${offer.id}', '${partner.name}', '${offer.title}')" 
                            class="flex-1 bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg transition">
                            <i class="fas fa-qrcode mr-1"></i>
                            Использовать
                        </button>
                    ` : `
                        <div class="flex-1 text-center text-gray-500 py-2">
                            <i class="fas fa-check-circle mr-1"></i>
                            Использовано
                        </div>
                    `}
                </div>
            </div>
        </div>
    `;
}

// Save coupon
function saveCoupon(offerId, partnerName, offerTitle) {
    if (!savedCoupons.includes(offerId)) {
        savedCoupons.push(offerId);
        localStorage.setItem('savedCoupons', JSON.stringify(savedCoupons));
        window.saratovApp.showNotification(`Купон "${offerTitle}" сохранен`, 'success');
        
        // Update button
        event.target.classList.remove('bg-blue-500');
        event.target.classList.add('bg-gray-300');
        event.target.innerHTML = '<i class="fas fa-check mr-1"></i>Сохранено';
    }
}

// Use coupon
function useCoupon(offerId, partnerName, offerTitle) {
    const modal = createCouponModal(offerId, partnerName, offerTitle);
    document.body.appendChild(modal);
}

// Create coupon usage modal
function createCouponModal(offerId, partnerName, offerTitle) {
    const partner = businessPartners.find(p => p.offers.some(o => o.id === offerId));
    const offer = partner?.offers.find(o => o.id === offerId);
    
    const modal = document.createElement('div');
    modal.className = 'fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4';
    modal.innerHTML = `
        <div class="bg-white rounded-2xl max-w-md w-full p-6 modal-enter">
            <button onclick="this.closest('.fixed').remove()" class="float-right text-gray-400 hover:text-gray-600">
                <i class="fas fa-times text-xl"></i>
            </button>
            
            <div class="text-center">
                <div class="w-24 h-24 bg-linear-to-br from-green-400 to-green-600 rounded-full mx-auto mb-4 flex items-center justify-center">
                    <i class="fas fa-ticket-alt text-white text-4xl"></i>
                </div>
                
                <h3 class="text-2xl font-bold mb-2">${offerTitle}</h3>
                <p class="text-gray-600 mb-4">${partnerName}</p>
                
                ${offer?.code ? `
                    <div class="bg-gray-100 rounded-xl p-6 mb-4">
                        <p class="text-sm text-gray-600 mb-2">Промокод:</p>
                        <p class="font-mono text-3xl font-bold">${offer.code}</p>
                    </div>
                ` : ''}
                
                <!-- QR Code placeholder -->
                <div class="bg-gray-200 rounded-xl p-8 mb-4">
                    <div class="w-32 h-32 mx-auto bg-white rounded flex items-center justify-center">
                        <i class="fas fa-qrcode text-6xl text-gray-400"></i>
                    </div>
                    <p class="text-sm text-gray-600 mt-2">Покажите QR-код сотруднику</p>
                </div>
                
                <button onclick="markCouponAsUsed('${offerId}')" class="w-full bg-green-500 hover:bg-green-600 text-white px-6 py-3 rounded-lg font-semibold transition">
                    <i class="fas fa-check mr-2"></i>
                    Отметить как использованный
                </button>
            </div>
        </div>
    `;
    
    return modal;
}

// Mark coupon as used
function markCouponAsUsed(offerId) {
    if (!usedCoupons.includes(offerId)) {
        usedCoupons.push(offerId);
        localStorage.setItem('usedCoupons', JSON.stringify(usedCoupons));
        
        // Achievement check
        if (usedCoupons.length === 5) {
            window.saratovApp.unlockAchievement('coupon_hunter', 'Охотник за скидками', 'Использовано 5 купонов');
        }
        
        window.saratovApp.showNotification('Купон успешно использован!', 'success');
        window.saratovApp.addBonusPoints(20);
        
        // Close modal
        document.querySelector('.fixed').remove();
        
        // Refresh offers if modal is open
        const offersGrid = document.getElementById('offersGrid');
        if (offersGrid) {
            offersGrid.innerHTML = renderAllOffers('all');
        }
    }
}

// Show user's coupons
function showMyCoupons() {
    const mySavedCoupons = savedCoupons.map(couponId => {
        const partner = businessPartners.find(p => p.offers.some(o => o.id === couponId));
        const offer = partner?.offers.find(o => o.id === couponId);
        return { partner, offer };
    }).filter(item => item.offer);
    
    const modal = document.createElement('div');
    modal.className = 'fixed inset-0 bg-black/50 z-50 overflow-y-auto';
    modal.innerHTML = `
        <div class="min-h-screen flex items-center justify-center p-4">
            <div class="bg-white rounded-2xl max-w-2xl w-full p-6">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-2xl font-bold">Мои купоны</h3>
                    <button onclick="this.closest('.fixed').remove()" class="text-gray-400 hover:text-gray-600 cursor-pointer">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
                
                ${mySavedCoupons.length > 0 ? `
                    <div class="space-y-4 max-h-[60vh] overflow-y-auto">
                        ${mySavedCoupons.map(({partner, offer}) => `
                            <div class="border rounded-lg p-4 hover:shadow-lg transition ${usedCoupons.includes(offer.id) ? 'opacity-50' : ''}">
                                <div class="flex items-start justify-between">
                                    <div class="flex-1">
                                        <h4 class="font-semibold">${offer.title}</h4>
                                        <p class="text-gray-600 text-sm">${partner.name}</p>
                                        <p class="text-gray-500 text-xs mt-1">До ${formatDate(offer.validUntil)}</p>
                                    </div>
                                    <div class="ml-4">
                                        ${getOfferTypeBadge(offer.type, offer.value)}
                                    </div>
                                </div>
                                ${!usedCoupons.includes(offer.id) ? `
                                    <button onclick="useCoupon('${offer.id}', '${partner.name}', '${offer.title}')" class="mt-3 bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded text-sm transition">
                                        Использовать
                                    </button>
                                ` : `
                                    <p class="mt-3 text-gray-500 text-sm">
                                        <i class="fas fa-check-circle"></i> Использовано
                                    </p>
                                `}
                            </div>
                        `).join('')}
                    </div>
                ` : `
                    <p class="text-gray-500 flex flex-col text-center py-8">
                        <i class="fas fa-ticket-alt text-4xl mb-4 block text-gray-300"></i>
                        У вас пока нет сохраненных купонов
                    </p>
                `}
                
                <button onclick="showAllOffers()" class="w-full mt-6 bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold transition">
                    Посмотреть все предложения
                </button>
            </div>
        </div>
    `;
    
    document.body.appendChild(modal);
}

// Format date
function formatDate(dateString) {
    const date = new Date(dateString);
    return date.toLocaleDateString('ru-RU', { day: 'numeric', month: 'long', year: 'numeric' });
}

// Initialize business module
document.addEventListener('DOMContentLoaded', () => {
    // Add click handler for "My Coupons" button
    const couponButtons = document.querySelectorAll('button');
    couponButtons.forEach(button => {
        if (button.innerHTML.includes('Мои купоны')) {
            button.addEventListener('click', showMyCoupons);
        }
    });
});

// Export for use
window.businessModule = {
    showAllOffers,
    showMyCoupons,
    saveCoupon,
    useCoupon,
    businessPartners
};