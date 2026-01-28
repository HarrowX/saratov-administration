// Social Features Module - Live activity, check-ins, friend system, leaderboards

const SocialFeatures = {
    // Live activity feed
    activityFeed: [],
    
    // Friend system
    friends: JSON.parse(localStorage.getItem('friends') || '[]'),
    friendRequests: JSON.parse(localStorage.getItem('friendRequests') || '[]'),
    
    // Check-ins
    checkIns: JSON.parse(localStorage.getItem('checkIns') || '[]'),
    
    // User stats
    userStats: JSON.parse(localStorage.getItem('userStats') || JSON.stringify({
        totalPoints: 0,
        placesVisited: 0,
        photosShared: 0,
        reviewsWritten: 0,
        friendsCount: 0,
        currentStreak: 0,
        longestStreak: 0,
        badges: [],
        level: 1,
        title: 'Новичок'
    })),
    
    // Initialize social features
    init() {
        this.loadActivityFeed();
        this.updateUserStats();
        this.startLiveUpdates();
    },
    
    // Check in at location
    checkIn(placeId, placeName, lat, lng) {
        const checkIn = {
            id: 'checkin_' + Date.now(),
            placeId,
            placeName,
            lat,
            lng,
            user: this.getCurrentUser(),
            timestamp: new Date().toISOString(),
            likes: 0,
            comments: []
        };
        
        this.checkIns.push(checkIn);
        localStorage.setItem('checkIns', JSON.stringify(this.checkIns));
        
        // Update stats
        this.userStats.placesVisited++;
        this.updateStreak();
        this.checkForBadges();
        
        // Add to activity feed
        this.addToActivityFeed({
            type: 'check-in',
            user: checkIn.user,
            place: placeName,
            time: 'только что'
        });
        
        // Show notification
        window.saratovApp?.showNotification(`📍 Вы отметились в "${placeName}"! +25 баллов`, 'success');
        this.addPoints(25);
        
        return checkIn;
    },
    
    // Update streak
    updateStreak() {
        const today = new Date().toDateString();
        const lastCheckIn = localStorage.getItem('lastCheckInDate');
        
        if (lastCheckIn === today) {
            return; // Already checked in today
        }
        
        const yesterday = new Date(Date.now() - 86400000).toDateString();
        
        if (lastCheckIn === yesterday) {
            this.userStats.currentStreak++;
        } else {
            this.userStats.currentStreak = 1;
        }
        
        if (this.userStats.currentStreak > this.userStats.longestStreak) {
            this.userStats.longestStreak = this.userStats.currentStreak;
        }
        
        localStorage.setItem('lastCheckInDate', today);
        this.saveUserStats();
    },
    
    // Check for new badges
    checkForBadges() {
        const badges = [];
        
        if (this.userStats.placesVisited >= 5 && !this.hasBadge('explorer')) {
            badges.push({ id: 'explorer', name: 'Исследователь', icon: '🗺️' });
        }
        
        if (this.userStats.currentStreak >= 7 && !this.hasBadge('dedicated')) {
            badges.push({ id: 'dedicated', name: 'Преданный', icon: '🔥' });
        }
        
        if (this.userStats.photosShared >= 10 && !this.hasBadge('photographer')) {
            badges.push({ id: 'photographer', name: 'Фотограф', icon: '📸' });
        }
        
        if (this.userStats.reviewsWritten >= 5 && !this.hasBadge('critic')) {
            badges.push({ id: 'critic', name: 'Критик', icon: '✍️' });
        }
        
        if (this.userStats.friendsCount >= 10 && !this.hasBadge('social')) {
            badges.push({ id: 'social', name: 'Душа компании', icon: '🎉' });
        }
        
        badges.forEach(badge => {
            this.userStats.badges.push(badge);
            window.saratovApp?.showNotification(`🏅 Новый значок: ${badge.name} ${badge.icon}`, 'success');
        });
        
        if (badges.length > 0) {
            this.saveUserStats();
        }
    },
    
    // Has badge
    hasBadge(badgeId) {
        return this.userStats.badges.some(b => b.id === badgeId);
    },
    
    // Add points
    addPoints(points) {
        this.userStats.totalPoints += points;
        this.updateLevel();
        this.saveUserStats();
    },
    
    // Update level
    updateLevel() {
        const points = this.userStats.totalPoints;
        let level = 1;
        let title = 'Новичок';
        
        if (points >= 5000) {
            level = 10;
            title = 'Легенда Саратова';
        } else if (points >= 3000) {
            level = 9;
            title = 'Мастер';
        } else if (points >= 2000) {
            level = 8;
            title = 'Эксперт';
        } else if (points >= 1500) {
            level = 7;
            title = 'Знаток';
        } else if (points >= 1000) {
            level = 6;
            title = 'Путешественник';
        } else if (points >= 700) {
            level = 5;
            title = 'Исследователь';
        } else if (points >= 500) {
            level = 4;
            title = 'Любитель';
        } else if (points >= 300) {
            level = 3;
            title = 'Турист';
        } else if (points >= 100) {
            level = 2;
            title = 'Начинающий';
        }
        
        this.userStats.level = level;
        this.userStats.title = title;
    },
    
    // Save user stats
    saveUserStats() {
        localStorage.setItem('userStats', JSON.stringify(this.userStats));
    },
    
    // Update user stats display
    updateUserStats() {
        const statsDisplay = document.getElementById('userStatsDisplay');
        if (statsDisplay) {
            statsDisplay.innerHTML = `
                <div class="bg-linear-to-r from-purple-500 to-pink-500 text-white p-4 rounded-lg">
                    <div class="flex items-center justify-between mb-3">
                        <div>
                            <h4 class="text-xl font-bold">${this.getCurrentUser()}</h4>
                            <p class="text-sm opacity-90">Уровень ${this.userStats.level} • ${this.userStats.title}</p>
                        </div>
                        <div class="text-3xl font-bold">${this.userStats.totalPoints}</div>
                    </div>
                    <div class="grid grid-cols-4 gap-2 text-center">
                        <div>
                            <div class="text-2xl font-bold">${this.userStats.placesVisited}</div>
                            <div class="text-xs opacity-75">Мест</div>
                        </div>
                        <div>
                            <div class="text-2xl font-bold">${this.userStats.currentStreak}</div>
                            <div class="text-xs opacity-75">Дней подряд</div>
                        </div>
                        <div>
                            <div class="text-2xl font-bold">${this.userStats.badges.length}</div>
                            <div class="text-xs opacity-75">Значков</div>
                        </div>
                        <div>
                            <div class="text-2xl font-bold">${this.userStats.friendsCount}</div>
                            <div class="text-xs opacity-75">Друзей</div>
                        </div>
                    </div>
                </div>
            `;
        }
    },
    
    // Load activity feed
    loadActivityFeed() {
        // Simulate live activity
        const activities = [
            { type: 'check-in', user: 'Александр М.', place: 'Набережная Космонавтов', time: '2 мин назад' },
            { type: 'photo', user: 'Мария К.', place: 'Консерватория', time: '5 мин назад' },
            { type: 'review', user: 'Иван П.', place: 'Ресторан Волга', rating: 5, time: '10 мин назад' },
            { type: 'achievement', user: 'Елена С.', achievement: 'Знаток города', time: '15 мин назад' },
            { type: 'route', user: 'Дмитрий Л.', route: 'Исторический центр', time: '20 мин назад' },
            { type: 'friend', user: 'Ольга В.', friend: 'Сергей Н.', time: '25 мин назад' },
            { type: 'quest', user: 'Андрей Б.', quest: 'Тайны старого города', time: '30 мин назад' }
        ];
        
        this.activityFeed = activities;
        this.displayActivityFeed();
    },
    
    // Display activity feed
    displayActivityFeed() {
        const feedContainer = document.getElementById('activityFeed');
        if (!feedContainer) return;
        
        const feedHTML = this.activityFeed.map(activity => {
            let icon, message, color;
            
            switch(activity.type) {
                case 'check-in':
                    icon = '📍';
                    message = `<strong>${activity.user}</strong> отметился в <strong>${activity.place}</strong>`;
                    color = 'blue';
                    break;
                case 'photo':
                    icon = '📸';
                    message = `<strong>${activity.user}</strong> добавил фото в <strong>${activity.place}</strong>`;
                    color = 'green';
                    break;
                case 'review':
                    icon = '⭐';
                    message = `<strong>${activity.user}</strong> оценил <strong>${activity.place}</strong> на ${activity.rating} звезд`;
                    color = 'yellow';
                    break;
                case 'achievement':
                    icon = '🏆';
                    message = `<strong>${activity.user}</strong> получил достижение <strong>${activity.achievement}</strong>`;
                    color = 'purple';
                    break;
                case 'route':
                    icon = '🗺️';
                    message = `<strong>${activity.user}</strong> прошел маршрут <strong>${activity.route}</strong>`;
                    color = 'indigo';
                    break;
                case 'friend':
                    icon = '👥';
                    message = `<strong>${activity.user}</strong> и <strong>${activity.friend}</strong> теперь друзья`;
                    color = 'pink';
                    break;
                case 'quest':
                    icon = '🎯';
                    message = `<strong>${activity.user}</strong> завершил квест <strong>${activity.quest}</strong>`;
                    color = 'orange';
                    break;
            }
            
            return `
                <div class="flex items-start space-x-3 p-3 hover:bg-gray-50 rounded-lg transition animate-slideIn">
                    <div class="text-2xl">${icon}</div>
                    <div class="flex-1">
                        <p class="text-sm">${message}</p>
                        <p class="text-xs text-gray-500 mt-1">${activity.time}</p>
                    </div>
                </div>
            `;
        }).join('');
        
        feedContainer.innerHTML = feedHTML;
    },
    
    // Add to activity feed
    addToActivityFeed(activity) {
        this.activityFeed.unshift(activity);
        if (this.activityFeed.length > 50) {
            this.activityFeed.pop();
        }
        this.displayActivityFeed();
    },
    
    // Start live updates
    startLiveUpdates() {
        // Simulate live updates every 30 seconds
        setInterval(() => {
            const randomActivities = [
                { type: 'check-in', user: this.getRandomUser(), place: this.getRandomPlace(), time: 'только что' },
                { type: 'photo', user: this.getRandomUser(), place: this.getRandomPlace(), time: 'только что' },
                { type: 'achievement', user: this.getRandomUser(), achievement: this.getRandomAchievement(), time: 'только что' }
            ];
            
            const randomActivity = randomActivities[Math.floor(Math.random() * randomActivities.length)];
            this.addToActivityFeed(randomActivity);
        }, 30000);
    },
    
    // Get random user
    getRandomUser() {
        const users = ['Анна П.', 'Михаил К.', 'Елена В.', 'Сергей Д.', 'Ольга М.', 'Павел С.'];
        return users[Math.floor(Math.random() * users.length)];
    },
    
    // Get random place
    getRandomPlace() {
        const places = ['Набережная', 'Консерватория', 'Парк Победы', 'Цирк', 'Липки', 'Радищевский музей'];
        return places[Math.floor(Math.random() * places.length)];
    },
    
    // Get random achievement
    getRandomAchievement() {
        const achievements = ['Первооткрыватель', 'Исследователь', 'Фотограф', 'Знаток города'];
        return achievements[Math.floor(Math.random() * achievements.length)];
    },
    
    // Get current user
    getCurrentUser() {
        return localStorage.getItem('userName') || 'Гость';
    },
    
    // Show leaderboard
    showLeaderboard() {
        const modal = document.createElement('div');
        modal.className = 'fixed inset-0 bg-black/80 z-50 overflow-y-auto';
        modal.innerHTML = `
            <div class="min-h-screen flex items-center justify-center p-4">
                <div class="bg-white rounded-2xl max-w-2xl w-full p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-2xl font-bold">🏆 Рейтинг путешественников</h3>
                        <button onclick="this.closest('.fixed').remove()" class="text-gray-400 hover:text-gray-600">
                            <i class="fas fa-times text-xl"></i>
                        </button>
                    </div>
                    
                    <div class="space-y-3">
                        ${this.generateLeaderboard()}
                    </div>
                    
                    <div class="mt-6 p-4 bg-linear-to-r from-purple-50 to-pink-50 rounded-lg">
                        <p class="text-center font-semibold">Ваша позиция: #${Math.floor(Math.random() * 50) + 10}</p>
                        <p class="text-center text-sm text-gray-600 mt-1">Продолжайте исследовать город, чтобы подняться выше!</p>
                    </div>
                </div>
            </div>
        `;
        document.body.appendChild(modal);
    },
    
    // Generate leaderboard
    generateLeaderboard() {
        const leaders = [
            { rank: 1, name: 'Александр М.', points: 4250, level: 9, places: 45, medal: '🥇' },
            { rank: 2, name: 'Мария К.', points: 3890, level: 8, places: 38, medal: '🥈' },
            { rank: 3, name: 'Иван П.', points: 3450, level: 8, places: 32, medal: '🥉' },
            { rank: 4, name: 'Елена С.', points: 2980, level: 7, places: 28, medal: '' },
            { rank: 5, name: 'Дмитрий Л.', points: 2650, level: 6, places: 25, medal: '' },
            { rank: 6, name: 'Ольга В.', points: 2340, level: 6, places: 22, medal: '' },
            { rank: 7, name: 'Сергей Н.', points: 2100, level: 5, places: 20, medal: '' },
            { rank: 8, name: 'Анна Б.', points: 1890, level: 5, places: 18, medal: '' },
            { rank: 9, name: 'Павел Ф.', points: 1650, level: 4, places: 16, medal: '' },
            { rank: 10, name: 'Наталья Р.', points: 1420, level: 4, places: 14, medal: '' }
        ];
        
        return leaders.map(leader => `
            <div class="flex items-center space-x-4 p-3 ${leader.rank <= 3 ? 'bg-linear-to-r from-yellow-50 to-orange-50' : 'bg-gray-50'} rounded-lg">
                <div class="text-2xl font-bold ${leader.rank <= 3 ? 'text-orange-500' : 'text-gray-500'}">
                    ${leader.medal || leader.rank}
                </div>
                <div class="flex-1">
                    <p class="font-semibold">${leader.name}</p>
                    <p class="text-sm text-gray-600">Уровень ${leader.level} • ${leader.places} мест</p>
                </div>
                <div class="text-xl font-bold text-purple-600">
                    ${leader.points}
                </div>
            </div>
        `).join('');
    }
};

// Export for global use
window.SocialFeatures = SocialFeatures;