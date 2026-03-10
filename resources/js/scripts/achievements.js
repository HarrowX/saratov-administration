// Achievements system for Saratov 435

// All achievements data
const achievements = [
    // Discovery achievements
    {
        id: 'first_place',
        name: 'Первооткрыватель',
        description: 'Посетите первую достопримечательность',
        icon: 'fas fa-flag',
        category: 'discovery',
        points: 50,
        color: 'yellow'
    },
    {
        id: 'explorer_5',
        name: 'Исследователь',
        description: 'Посетите 5 мест',
        icon: 'fas fa-map',
        category: 'discovery',
        points: 100,
        color: 'blue'
    },
    {
        id: 'explorer_10',
        name: 'Опытный путешественник',
        description: 'Посетите 10 мест',
        icon: 'fas fa-compass',
        category: 'discovery',
        points: 200,
        color: 'purple'
    },
    {
        id: 'city_expert',
        name: 'Знаток города',
        description: 'Посетите 20 мест',
        icon: 'fas fa-crown',
        category: 'discovery',
        points: 500,
        color: 'gold'
    },
    
    // Route achievements
    {
        id: 'first_route',
        name: 'Первый маршрут',
        description: 'Пройдите первый тематический маршрут',
        icon: 'fas fa-route',
        category: 'routes',
        points: 75,
        color: 'green'
    },
    {
        id: 'route_master',
        name: 'Мастер маршрутов',
        description: 'Пройдите 5 разных маршрутов',
        icon: 'fas fa-hiking',
        category: 'routes',
        points: 250,
        color: 'blue'
    },
    {
        id: 'gagarin_path',
        name: 'По следам Гагарина',
        description: 'Пройдите маршрут "Путь Гагарина"',
        icon: 'fas fa-rocket',
        category: 'routes',
        points: 150,
        color: 'red'
    },
    
    // Cultural achievements
    {
        id: 'culture_lover',
        name: 'Ценитель культуры',
        description: 'Посетите все театры и музеи',
        icon: 'fas fa-theater-masks',
        category: 'culture',
        points: 300,
        color: 'purple'
    },
    {
        id: 'art_enthusiast',
        name: 'Любитель искусства',
        description: 'Посетите Радищевский музей и консерваторию',
        icon: 'fas fa-palette',
        category: 'culture',
        points: 150,
        color: 'pink'
    },
    
    // Time-based achievements
    {
        id: 'early_bird',
        name: 'Ранняя пташка',
        description: 'Посетите место до 9 утра',
        icon: 'fas fa-sun',
        category: 'special',
        points: 100,
        color: 'orange'
    },
    {
        id: 'night_owl',
        name: 'Ночная сова',
        description: 'Посетите место после 21:00',
        icon: 'fas fa-moon',
        category: 'special',
        points: 100,
        color: 'indigo'
    },
    {
        id: 'weekend_warrior',
        name: 'Воин выходного дня',
        description: 'Посетите 5 мест за выходные',
        icon: 'fas fa-calendar-week',
        category: 'special',
        points: 200,
        color: 'green'
    },
    
    // Social achievements
    {
        id: 'social_butterfly',
        name: 'Социальная бабочка',
        description: 'Поделитесь 10 местами с друзьями',
        icon: 'fas fa-share-alt',
        category: 'social',
        points: 150,
        color: 'blue'
    },
    {
        id: 'photographer',
        name: 'Фотограф',
        description: 'Добавьте фото к 5 местам',
        icon: 'fas fa-camera',
        category: 'social',
        points: 100,
        color: 'teal'
    },
    {
        id: 'reviewer',
        name: 'Критик',
        description: 'Оставьте отзывы о 10 местах',
        icon: 'fas fa-star',
        category: 'social',
        points: 150,
        color: 'yellow'
    },
    
    // Seasonal achievements
    {
        id: 'summer_explorer',
        name: 'Летний исследователь',
        description: 'Посетите 10 мест летом',
        icon: 'fas fa-umbrella-beach',
        category: 'seasonal',
        points: 200,
        color: 'yellow'
    },
    {
        id: 'winter_adventurer',
        name: 'Зимний путешественник',
        description: 'Посетите 10 мест зимой',
        icon: 'fas fa-snowflake',
        category: 'seasonal',
        points: 200,
        color: 'cyan'
    },
    
    // Business achievements
    {
        id: 'coupon_hunter',
        name: 'Охотник за скидками',
        description: 'Используйте 5 купонов',
        icon: 'fas fa-percentage',
        category: 'business',
        points: 100,
        color: 'green'
    },
    {
        id: 'loyal_customer',
        name: 'Постоянный клиент',
        description: 'Посетите 10 партнерских заведений',
        icon: 'fas fa-handshake',
        category: 'business',
        points: 200,
        color: 'purple'
    },
    
    // Special achievements
    {
        id: 'legend',
        name: 'Легенда Саратова',
        description: 'Получите все достижения',
        icon: 'fas fa-trophy',
        category: 'legendary',
        points: 1000,
        color: 'gold'
    },
    {
        id: '435_anniversary',
        name: 'Юбиляр',
        description: 'Участвуйте в праздновании 435-летия Саратова',
        icon: 'fas fa-birthday-cake',
        category: 'special',
        points: 435,
        color: 'rainbow'
    }
];

// Achievement categories
const achievementCategories = {
    discovery: {
        name: 'Открытия',
        icon: 'fas fa-map-marked-alt',
        color: 'blue'
    },
    routes: {
        name: 'Маршруты',
        icon: 'fas fa-route',
        color: 'green'
    },
    culture: {
        name: 'Культура',
        icon: 'fas fa-theater-masks',
        color: 'purple'
    },
    special: {
        name: 'Особые',
        icon: 'fas fa-star',
        color: 'yellow'
    },
    social: {
        name: 'Социальные',
        icon: 'fas fa-users',
        color: 'teal'
    },
    seasonal: {
        name: 'Сезонные',
        icon: 'fas fa-calendar-alt',
        color: 'orange'
    },
    business: {
        name: 'Бизнес',
        icon: 'fas fa-briefcase',
        color: 'green'
    },
    legendary: {
        name: 'Легендарные',
        icon: 'fas fa-crown',
        color: 'gold'
    }
};

// Get achievement color class
function getAchievementColorClass(color) {
    const colorClasses = {
        yellow: 'from-yellow-400 to-yellow-600',
        blue: 'from-blue-400 to-blue-600',
        purple: 'from-purple-400 to-purple-600',
        gold: 'from-yellow-500 to-yellow-700',
        green: 'from-green-400 to-green-600',
        red: 'from-red-400 to-red-600',
        pink: 'from-pink-400 to-pink-600',
        orange: 'from-orange-400 to-orange-600',
        indigo: 'from-indigo-400 to-indigo-600',
        teal: 'from-teal-400 to-teal-600',
        cyan: 'from-cyan-400 to-cyan-600',
        rainbow: 'from-red-400 via-yellow-400 to-blue-400'
    };
    return colorClasses[color] || colorClasses.blue;
}

// Show all achievements modal
function showAllAchievements() {
    const modal = document.createElement('div');
    modal.className = 'fixed inset-0 bg-black/50 z-50 overflow-y-auto';
    modal.innerHTML = `
        <div class="min-h-screen flex items-center justify-center p-4">
            <div class="bg-white rounded-2xl max-w-4xl w-full max-h-[90vh] overflow-hidden">
                <div class="sticky top-0 bg-white border-b p-6 flex justify-between items-center">
                    <div>
                        <h2 class="title3xl mb-2">Все достижения</h2>
                        <p class="text-gray-600">Получено: ${getUnlockedAchievementsCount()}/${achievements.length}</p>
                    </div>
                    <button onclick="this.closest('.fixed').remove()" class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times text-2xl"></i>
                    </button>
                </div>
                
                <div class="p-6 overflow-y-auto max-h-[calc(90vh-120px)]">
                    ${renderAchievementCategories()}
                </div>
            </div>
        </div>
    `;
    
    document.body.appendChild(modal);
    
    // Add animation
    setTimeout(() => {
        modal.querySelector('.bg-white').classList.add('modal-enter');
    }, 10);
}

// Render achievement categories
function renderAchievementCategories() {
    const unlockedAchievements = JSON.parse(localStorage.getItem('unlockedAchievements') || '[]');
    let html = '';
    
    Object.entries(achievementCategories).forEach(([categoryId, category]) => {
        const categoryAchievements = achievements.filter(a => a.category === categoryId);
        if (categoryAchievements.length === 0) return;
        
        const unlockedInCategory = categoryAchievements.filter(a => unlockedAchievements.includes(a.id)).length;
        
        html += `
            <div class="mb-8">
                <div class="flex items-center mb-4">
                    <i class="${category.icon} text-2xl mr-3 text-${category.color}-500"></i>
                    <h3 class="text-xl font-bold">${category.name}</h3>
                    <span class="ml-3 text-gray-500">${unlockedInCategory}/${categoryAchievements.length}</span>
                </div>
                
                <div class="grid  md:grid-cols-2 lg:grid-cols-3 gap-4">
                    ${categoryAchievements.map(achievement => renderAchievementCard(achievement, unlockedAchievements.includes(achievement.id))).join('')}
                </div>
            </div>
        `;
    });
    
    return html;
}

// Render single achievement card
function renderAchievementCard(achievement, isUnlocked) {
    const colorClass = getAchievementColorClass(achievement.color);
    const opacity = isUnlocked ? '' : 'opacity-50';
    
    return `
        <div class="bg-white border rounded-xl p-2 sm:p-4 ${opacity} ${isUnlocked ? 'hover:shadow-lg' : ''} transition cursor-pointer">
            <div class="flex items-start space-x-3">
                <div class="w-9 h-9 sm:w-12 sm:h-12 bg-linear-to-br ${isUnlocked ? colorClass : 'from-gray-300 to-gray-400'} rounded-full flex items-center justify-center shrink-0">
                    <i class="${achievement.icon} text-white"></i>
                </div>
                <div class="flex-1">
                    <h4 class="font-semibold mb-1">${achievement.name}</h4>
                    <p class="text-sm text-gray-600 mb-2">${achievement.description}</p>
                    <div class="flex items-center justify-between">
                        <span class="text-xs ${isUnlocked ? 'text-green-600' : 'text-gray-400'}">
                            ${isUnlocked ? '✓ Получено' : '🔒 Заблокировано'}
                        </span>
                        <span class="text-xs font-semibold text-purple-600">+${achievement.points}</span>
                    </div>
                </div>
            </div>
        </div>
    `;
}

// Get unlocked achievements count
function getUnlockedAchievementsCount() {
    const unlockedAchievements = JSON.parse(localStorage.getItem('unlockedAchievements') || '[]');
    return unlockedAchievements.length;
}

// Check for route completion
function checkRouteCompletion(routeId) {
    const route = window.mapModule?.routes.find(r => r.id === routeId);
    if (!route) return;
    
    const visitedPlaces = JSON.parse(localStorage.getItem('visitedPlaces') || '[]');
    const allPlacesVisited = route.places.every(placeId => visitedPlaces.includes(placeId));
    
    if (allPlacesVisited) {
        // Unlock route achievements
        if (routeId === 1) {
            window.unlockAchievement('gagarin_path', 'По следам Гагарина', 'Пройден маршрут "Путь Гагарина"');
        }
        
        // Check for first route
        const completedRoutes = JSON.parse(localStorage.getItem('completedRoutes') || '[]');
        if (!completedRoutes.includes(routeId)) {
            completedRoutes.push(routeId);
            localStorage.setItem('completedRoutes', JSON.stringify(completedRoutes));
            
            if (completedRoutes.length === 1) {
                window.unlockAchievement('first_route', 'Первый маршрут', 'Пройден первый тематический маршрут');
            } else if (completedRoutes.length === 5) {
                window.unlockAchievement('route_master', 'Мастер маршрутов', 'Пройдено 5 разных маршрутов');
            }
        }
    }
}

// Check for time-based achievements
function checkTimeBasedAchievements() {
    const now = new Date();
    const hour = now.getHours();
    
    if (hour < 9) {
        window.unlockAchievement('early_bird', 'Ранняя пташка', 'Посещение места до 9 утра');
    } else if (hour >= 21) {
        window.unlockAchievement('night_owl', 'Ночная сова', 'Посещение места после 21:00');
    }
}

// Progress tracking
function updateAchievementProgress() {
    const unlockedCount = getUnlockedAchievementsCount();
    const totalCount = achievements.length;
    const percentage = (unlockedCount / totalCount) * 100;
    
    // Update progress bars
    const progressBars = document.querySelectorAll('.achievement-progress');
    progressBars.forEach(bar => {
        bar.style.width = `${percentage}%`;
        bar.setAttribute('data-progress', `${unlockedCount}/${totalCount}`);
    });
    
    // Check for legend achievement
    if (unlockedCount === totalCount - 1) { // -1 because legend itself is an achievement
        window.unlockAchievement('legend', 'Легенда Саратова', 'Получены все достижения');
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

// Initialize achievements
document.addEventListener('DOMContentLoaded', () => {
    updateAchievementProgress();
    
    // Check time-based achievements periodically
    setInterval(checkTimeBasedAchievements, 60000); // Every minute
});

// Export for use
window.showAllAchievements = showAllAchievements;
window.checkRouteCompletion = checkRouteCompletion;
window.updateAchievementProgress = updateAchievementProgress;
window.achievements = achievements;
window.showAchievementNotification = showAchievementNotification;