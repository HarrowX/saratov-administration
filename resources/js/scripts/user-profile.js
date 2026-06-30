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

function updateProfileData() {
    // Update achievement count in navigation
    const achievementCount = document.querySelector('.achievement-count');
    if (achievementCount) {
        achievementCount.textContent = userProfile.achievements;
    }
}

function unlockAchievement(achievementId, name, description) {
    // Check if already unlocked
    const unlockedAchievements = JSON.parse(localStorage.getItem('unlockedAchievements') || '[]');

    if (!unlockedAchievements.includes(achievementId)) {
        unlockedAchievements.push(achievementId);
        localStorage.setItem('unlockedAchievements', JSON.stringify(unlockedAchievements));

        // Update user profile
        userProfile.achievements++;
        updateProfileData();

        // Add bonus points
        addBonusPoints(50);
    }
}

function addBonusPoints(points) {
    userProfile.bonusPoints += points;
    updateProfileData();
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

window.updateProfileData = updateProfileData;
window.unlockAchievement = unlockAchievement;
window.addBonusPoints = addBonusPoints;
window.checkVisitedPlace = checkVisitedPlace;
window.userProfile = userProfile;
