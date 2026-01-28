// Main JavaScript file for Saratov 435

// Initialize AOS animations
AOS.init({
    duration: 1000,
    once: true,
    offset: 100
});

// Global variables
let userProfile = {
    name: 'Гость',
    level: 'Начинающий исследователь',
    achievements: 1,
    totalAchievements: 30,
    placesVisited: 5,
    totalPlaces: 50,
    bonusPoints: 150,
    coupons: [],
    routes: []
};

// DOM elements
const mobileMenuBtn = document.getElementById('mobileMenuBtn');
const mobileMenu = document.getElementById('mobileMenu');
const profileBtn = document.getElementById('profileBtn');
const profileModal = document.getElementById('profileModal');

// Mobile menu toggle
mobileMenuBtn?.addEventListener('click', () => {
    mobileMenu.classList.toggle('hidden');
});

// Profile modal
profileBtn?.addEventListener('click', () => {
    showProfileModal();
});

function showProfileModal() {
    profileModal.classList.remove('hidden');
    profileModal.querySelector('.bg-white').classList.add('modal-enter');
    updateProfileData();
}

function closeProfileModal() {
    profileModal.classList.add('hidden');
}

function updateProfileData() {
    // Update achievement count in navigation
    const achievementCount = document.querySelector('.achievement-count');
    if (achievementCount) {
        achievementCount.textContent = userProfile.achievements;
    }
}

// Smooth scroll for navigation links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            const offset = 80; // Navigation height
            const targetPosition = target.offsetTop - offset;
            window.scrollTo({
                top: targetPosition,
                behavior: 'smooth'
            });
            
            // Close mobile menu if open
            if (!mobileMenu.classList.contains('hidden')) {
                mobileMenu.classList.add('hidden');
            }
        }
    });
});

// Start journey function
function startJourney() {
    // Scroll to attractions section
    const attractionsSection = document.getElementById('attractions');
    if (attractionsSection) {
        attractionsSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }
    
    // Show notification
    showNotification('Добро пожаловать в путешествие по Саратову!', 'success');
}

// Show business section
function showBusinessSection() {
    const businessSection = document.getElementById('business');
    if (businessSection) {
        businessSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }
}

// Show business registration
function showBusinessRegistration() {
    showNotification('Форма регистрации партнера будет доступна в мобильном приложении', 'info');
    
    // Create registration modal
    const modal = createBusinessRegistrationModal();
    document.body.appendChild(modal);
}

function createBusinessRegistrationModal() {
    const modal = document.createElement('div');
    modal.className = 'fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4';
    modal.innerHTML = `
        <div class="bg-white rounded-2xl max-w-md w-full p-6 modal-enter">
            <button onclick="this.closest('.fixed').remove()" class="float-right text-gray-400 hover:text-gray-600">
                <i class="fas fa-times text-xl"></i>
            </button>
            <h3 class="text-2xl font-bold mb-4">Стать партнером</h3>
            <form onsubmit="submitBusinessRegistration(event)">
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Название компании</label>
                        <input type="text" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="ООО 'Название'">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Тип бизнеса</label>
                        <select required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">Выберите тип</option>
                            <option value="restaurant">Ресторан/Кафе</option>
                            <option value="hotel">Отель/Хостел</option>
                            <option value="shop">Магазин</option>
                            <option value="entertainment">Развлечения</option>
                            <option value="museum">Музей/Галерея</option>
                            <option value="other">Другое</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Контактный email</label>
                        <input type="email" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="email@company.ru">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Телефон</label>
                        <input type="tel" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="+7 (999) 123-45-67">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Описание предложения</label>
                        <textarea required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" rows="3" placeholder="Опишите, какие скидки или услуги вы готовы предложить пользователям"></textarea>
                    </div>
                </div>
                <button type="submit" class="w-full mt-6 bg-linear-to-r from-blue-500 to-purple-600 text-white px-6 py-3 rounded-lg font-semibold hover:shadow-lg transition">
                    Отправить заявку
                </button>
            </form>
        </div>
    `;
    return modal;
}

function submitBusinessRegistration(event) {
    event.preventDefault();
    
    // Save to database (will implement with TableDataAdd)
    saveBusinessRegistration(event.target);
    
    // Close modal
    event.target.closest('.fixed').remove();
    
    // Show success message
    showNotification('Заявка успешно отправлена! Мы свяжемся с вами в течение 24 часов.', 'success');
}

// Notification system
function showNotification(message, type = 'info') {
    const notification = document.createElement('div');
    notification.className = `fixed top-20 right-4 z-50 max-w-sm p-4 rounded-lg shadow-lg transform translate-x-0 transition-all duration-300`;
    
    // Set colors based on type
    const colors = {
        success: 'bg-green-500 text-white',
        error: 'bg-red-500 text-white',
        info: 'bg-blue-500 text-white',
        warning: 'bg-yellow-500 text-white'
    };
    
    notification.className += ` ${colors[type] || colors.info}`;
    
    notification.innerHTML = `
        <div class="flex items-center">
            <i class="fas ${getNotificationIcon(type)} mr-3"></i>
            <p>${message}</p>
        </div>
    `;
    
    document.body.appendChild(notification);
    
    // Animate in
    setTimeout(() => {
        notification.style.transform = 'translateX(0)';
    }, 100);
    
    // Remove after 5 seconds
    setTimeout(() => {
        notification.style.transform = 'translateX(500px)';
        setTimeout(() => notification.remove(), 300);
    }, 5000);
}

function getNotificationIcon(type) {
    const icons = {
        success: 'fa-check-circle',
        error: 'fa-exclamation-circle',
        info: 'fa-info-circle',
        warning: 'fa-exclamation-triangle'
    };
    return icons[type] || icons.info;
}

// Achievement system
function unlockAchievement(achievementId, name, description) {
    // Check if already unlocked
    const unlockedAchievements = JSON.parse(localStorage.getItem('unlockedAchievements') || '[]');
    
    if (!unlockedAchievements.includes(achievementId)) {
        unlockedAchievements.push(achievementId);
        localStorage.setItem('unlockedAchievements', JSON.stringify(unlockedAchievements));
        
        // Update user profile
        userProfile.achievements++;
        updateProfileData();
        
        // Show achievement notification
        showAchievementNotification(name, description);
        
        // Add bonus points
        addBonusPoints(50);
    }
}

function showAchievementNotification(name, description) {
    const notification = document.createElement('div');
    notification.className = 'fixed top-20 left-1/2 transform -translate-x-1/2 z-50 bg-white rounded-xl shadow-2xl p-6 max-w-sm modal-enter';
    
    notification.innerHTML = `
        <div class="text-center">
            <div class="w-20 h-20 mx-auto mb-4 bg-linear-to-br from-yellow-400 to-yellow-600 rounded-full flex items-center justify-center">
                <i class="fas fa-trophy text-white text-3xl"></i>
            </div>
            <h4 class="text-xl font-bold mb-2">Достижение разблокировано!</h4>
            <p class="font-semibold text-lg mb-1">${name}</p>
            <p class="text-gray-600 text-sm">${description}</p>
            <p class="text-green-500 font-semibold mt-3">+50 бонусных баллов</p>
        </div>
    `;
    
    document.body.appendChild(notification);
    
    // Remove after 5 seconds
    setTimeout(() => {
        notification.style.opacity = '0';
        setTimeout(() => notification.remove(), 300);
    }, 5000);
}

function addBonusPoints(points) {
    userProfile.bonusPoints += points;
    updateProfileData();
}

// Save data functions
async function saveBusinessRegistration(form) {
    const formData = new FormData(form);
    const data = {
        company_name: formData.get('company_name'),
        business_type: formData.get('business_type'),
        email: formData.get('email'),
        phone: formData.get('phone'),
        description: formData.get('description'),
        status: 'pending',
        created_at: Date.now()
    };
    
    try {
        const response = await fetch('tables/business_partners', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        });
        
        if (response.ok) {
            console.log('Business registration saved successfully');
        }
    } catch (error) {
        console.error('Error saving business registration:', error);
    }
}

// Check for visited places
function checkVisitedPlace(placeId) {
    const visitedPlaces = JSON.parse(localStorage.getItem('visitedPlaces') || '[]');
    
    if (!visitedPlaces.includes(placeId)) {
        visitedPlaces.push(placeId);
        localStorage.setItem('visitedPlaces', JSON.stringify(visitedPlaces));
        
        userProfile.placesVisited++;
        updateProfileData();
        
        // Check for achievements
        if (visitedPlaces.length === 1) {
            unlockAchievement('first_place', 'Первооткрыватель', 'Посетите первую достопримечательность');
        } else if (visitedPlaces.length === 5) {
            unlockAchievement('explorer_5', 'Исследователь', 'Посетите 5 мест');
        } else if (visitedPlaces.length === 20) {
            unlockAchievement('city_expert', 'Знаток города', 'Посетите 20 мест');
        }
        
        return true;
    }
    return false;
}

// Counter animation
function animateCounter(element, start, end, duration) {
    let startTimestamp = null;
    const step = (timestamp) => {
        if (!startTimestamp) startTimestamp = timestamp;
        const progress = Math.min((timestamp - startTimestamp) / duration, 1);
        element.textContent = Math.floor(progress * (end - start) + start);
        if (progress < 1) {
            window.requestAnimationFrame(step);
        }
    };
    window.requestAnimationFrame(step);
}

// Animate counters on scroll
const observerOptions = {
    threshold: 0.5,
    rootMargin: '0px'
};

const counterObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            const counter = entry.target;
            const target = parseInt(counter.textContent);
            animateCounter(counter, 0, target, 2000);
            counterObserver.unobserve(counter);
        }
    });
}, observerOptions);

// Observe all counters
document.addEventListener('DOMContentLoaded', () => {
    const counters = document.querySelectorAll('.counter');
    counters.forEach(counter => {
        counterObserver.observe(counter);
    });
    
    // Initialize user data
    updateProfileData();
});

// Export functions for use in other modules
window.saratovApp = {
    showNotification,
    unlockAchievement,
    checkVisitedPlace,
    addBonusPoints,
    userProfile
};