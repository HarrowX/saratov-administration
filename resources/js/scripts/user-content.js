// User Generated Content Module for Saratov 435
// Allows users to add places, reviews, photos, and create custom routes

const UserContent = {
    // User's added places
    userPlaces: JSON.parse(localStorage.getItem('userPlaces') || '[]'),
    userReviews: JSON.parse(localStorage.getItem('userReviews') || '[]'),
    userPhotos: JSON.parse(localStorage.getItem('userPhotos') || '[]'),
    userRoutes: JSON.parse(localStorage.getItem('userRoutes') || '[]'),
    
    // Add new place by user
    addUserPlace(placeData) {
        const place = {
            id: 'user_' + Date.now(),
            ...placeData,
            author: this.getCurrentUser(),
            created: new Date().toISOString(),
            verified: false,
            likes: 0,
            views: 0
        };
        
        this.userPlaces.push(place);
        localStorage.setItem('userPlaces', JSON.stringify(this.userPlaces));
        
        // Add marker to map
        if (window.mapModule) {
            this.addUserMarkerToMap(place);
        }
        
        // Send notification
        window?.showNotification('Место успешно добавлено! Модераторы проверят его в течение 24 часов', 'success');
        
        return place;
    },
    
    // Add marker to map
    addUserMarkerToMap(place) {
        const userIcon = L.divIcon({
            html: `<div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; width: 30px; height: 30px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 16px; box-shadow: 0 2px 8px rgba(0,0,0,0.3); border: 2px solid white;">
                <i class="fas fa-user"></i>
            </div>`,
            className: 'user-marker',
            iconSize: [30, 30],
            iconAnchor: [15, 15]
        });
        
        const marker = L.marker([place.lat, place.lng], { icon: userIcon })
            .addTo(window.map);
        
        const popupContent = `
            <div class="popup-content">
                ${place.photo ? `<img src="${place.photo}" alt="${place.name}" class="popup-image">` : ''}
                <h4 class="font-bold text-lg mb-2">${place.name}</h4>
                <p class="text-sm text-gray-600 mb-2">${place.description}</p>
                <div class="text-xs text-gray-500 mb-2">
                    <i class="fas fa-user mr-1"></i>Добавил: ${place.author}
                </div>
                <div class="flex items-center space-x-3 text-sm">
                    <button onclick="UserContent.likePlace('${place.id}')" class="text-red-500">
                        <i class="fas fa-heart mr-1"></i><span id="likes-${place.id}">${place.likes}</span>
                    </button>
                    <span class="text-gray-500">
                        <i class="fas fa-eye mr-1"></i>${place.views}
                    </span>
                </div>
            </div>
        `;
        
        marker.bindPopup(popupContent, {
            maxWidth: 300,
            className: 'user-popup'
        });
    },
    
    // Like a place
    likePlace(placeId) {
        const place = this.userPlaces.find(p => p.id === placeId);
        if (place) {
            place.likes++;
            localStorage.setItem('userPlaces', JSON.stringify(this.userPlaces));
            
            const likesElement = document.getElementById(`likes-${placeId}`);
            if (likesElement) {
                likesElement.textContent = place.likes;
            }
            
            window?.showNotification('♥️ Спасибо за лайк!', 'success');
        }
    },
    
    // Add review
    addReview(placeId, reviewData) {
        const review = {
            id: 'review_' + Date.now(),
            placeId,
            ...reviewData,
            author: this.getCurrentUser(),
            created: new Date().toISOString(),
            helpful: 0,
            verified: false
        };
        
        this.userReviews.push(review);
        localStorage.setItem('userReviews', JSON.stringify(this.userReviews));
        
        return review;
    },
    
    // Create custom route
    createCustomRoute(routeData) {
        const route = {
            id: 'route_' + Date.now(),
            ...routeData,
            author: this.getCurrentUser(),
            created: new Date().toISOString(),
            likes: 0,
            completions: 0,
            public: true
        };
        
        this.userRoutes.push(route);
        localStorage.setItem('userRoutes', JSON.stringify(this.userRoutes));
        
        window?.showNotification('Маршрут создан и опубликован!', 'success');
        return route;
    },
    
    // Get current user
    getCurrentUser() {
        return localStorage.getItem('userName') || 'Аноним';
    },
    
    // Show add place modal
    showAddPlaceModal() {
        const modal = document.createElement('div');
        modal.className = 'fixed inset-0 bg-black/80 z-50 overflow-y-auto';
        modal.innerHTML = `
            <div class="min-h-screen flex items-center justify-center p-4">
                <div class="bg-white rounded-2xl max-w-2xl w-full p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-2xl font-bold">Добавить новое место</h3>
                        <button onclick="this.closest('.fixed').remove()" class="text-gray-400 hover:text-gray-600">
                            <i class="fas fa-times text-xl"></i>
                        </button>
                    </div>
                    
                    <form onsubmit="UserContent.submitNewPlace(event)" class="space-y-4">
                        <div class="grid md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Название места *</label>
                                <input type="text" name="name" required class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500" placeholder="Например: Уютная кофейня">
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Категория *</label>
                                <select name="category" required class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
                                    <option value="">Выберите категорию</option>
                                    <option value="cafe">☕ Кафе</option>
                                    <option value="restaurant">🍽️ Ресторан</option>
                                    <option value="park">🌳 Парк</option>
                                    <option value="landmark">🏛️ Достопримечательность</option>
                                    <option value="entertainment">🎭 Развлечения</option>
                                    <option value="shop">🛍️ Магазин</option>
                                    <option value="viewpoint">📸 Смотровая площадка</option>
                                    <option value="street-art">🎨 Стрит-арт</option>
                                </select>
                            </div>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Адрес *</label>
                            <input type="text" name="address" required class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500" placeholder="Улица, дом">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Описание *</label>
                            <textarea name="description" required rows="3" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500" placeholder="Расскажите, чем интересно это место"></textarea>
                        </div>
                        
                        <div class="grid md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Координаты (широта) *</label>
                                <input type="number" name="lat" required step="0.0001" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500" placeholder="51.5339">
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Координаты (долгота) *</label>
                                <input type="number" name="lng" required step="0.0001" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500" placeholder="46.0345">
                            </div>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Фото (URL)</label>
                            <input type="url" name="photo" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500" placeholder="https://...">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Теги (через запятую)</label>
                            <input type="text" name="tags" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500" placeholder="тихое место, wi-fi, веганское меню">
                        </div>
                        
                        <div class="bg-blue-50 rounded-lg p-4">
                            <p class="text-sm text-blue-800">
                                <i class="fas fa-info-circle mr-2"></i>
                                Ваше место будет проверено модераторами и добавлено на карту в течение 24 часов
                            </p>
                        </div>
                        
                        <div class="flex space-x-4">
                            <button type="submit" class="flex-1 bg-linear-to-r from-blue-500 to-purple-600 text-white px-6 py-3 rounded-lg font-semibold hover:shadow-lg transition">
                                <i class="fas fa-map-marker-alt mr-2"></i>Добавить место
                            </button>
                            <button type="button" onclick="this.closest('.fixed').remove()" class="flex-1 bg-gray-200 text-gray-700 px-6 py-3 rounded-lg font-semibold hover:bg-gray-300 transition">
                                Отмена
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        `;
        document.body.appendChild(modal);
    },
    
    // Submit new place
    submitNewPlace(event) {
        event.preventDefault();
        const formData = new FormData(event.target);
        
        const placeData = {
            name: formData.get('name'),
            category: formData.get('category'),
            address: formData.get('address'),
            description: formData.get('description'),
            lat: parseFloat(formData.get('lat')),
            lng: parseFloat(formData.get('lng')),
            photo: formData.get('photo'),
            tags: formData.get('tags').split(',').map(tag => tag.trim()).filter(tag => tag)
        };
        
        this.addUserPlace(placeData);
        event.target.closest('.fixed').remove();
    },
    
    // Show route builder
    showRouteBuilder() {
        const modal = document.createElement('div');
        modal.className = 'fixed inset-0 bg-black/80 z-50 overflow-y-auto';
        modal.innerHTML = `
            <div class="min-h-screen flex items-center justify-center p-4">
                <div class="bg-white rounded-2xl max-w-4xl w-full p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-2xl font-bold">Создать свой маршрут</h3>
                        <button onclick="this.closest('.fixed').remove()" class="text-gray-400 hover:text-gray-600">
                            <i class="fas fa-times text-xl"></i>
                        </button>
                    </div>
                    
                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <h4 class="font-semibold mb-3">Информация о маршруте</h4>
                            <form id="routeForm" class="space-y-3">
                                <input type="text" name="name" required placeholder="Название маршрута" class="w-full px-4 py-2 border rounded-lg">
                                <textarea name="description" required placeholder="Описание" rows="3" class="w-full px-4 py-2 border rounded-lg"></textarea>
                                
                                <div class="grid grid-cols-2 gap-3">
                                    <select name="difficulty" class="px-4 py-2 border rounded-lg">
                                        <option value="easy">Легкий</option>
                                        <option value="medium">Средний</option>
                                        <option value="hard">Сложный</option>
                                    </select>
                                    
                                    <input type="text" name="duration" placeholder="Время (2 часа)" class="px-4 py-2 border rounded-lg">
                                </div>
                                
                                <div>
                                    <label class="text-sm text-gray-600">Выберите точки маршрута:</label>
                                    <div id="routePoints" class="space-y-2 mt-2 max-h-40 overflow-y-auto border rounded-lg p-3">
                                        <!-- Points will be added here -->
                                    </div>
                                </div>
                                
                                <button type="submit" class="w-full bg-linear-to-r from-green-500 to-teal-600 text-white px-6 py-3 rounded-lg font-semibold hover:shadow-lg transition">
                                    <i class="fas fa-route mr-2"></i>Создать маршрут
                                </button>
                            </form>
                        </div>
                        
                        <div>
                            <h4 class="font-semibold mb-3">Предпросмотр на карте</h4>
                            <div id="routePreviewMap" class="h-96 rounded-lg border"></div>
                        </div>
                    </div>
                </div>
            </div>
        `;
        document.body.appendChild(modal);
        
        // Initialize route builder map
        setTimeout(() => this.initRouteBuilderMap(), 100);
    },
    
    // Initialize route builder map
    initRouteBuilderMap() {
        const routeMap = L.map('routePreviewMap').setView([51.5339, 46.0345], 12);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(routeMap);
        
        // Add clickable markers for all places
        const allPlaces = [...window.mapModule.landmarks, ...this.userPlaces];
        allPlaces.forEach(place => {
            const marker = L.marker([place.lat, place.lng]).addTo(routeMap);
            marker.bindPopup(`<b>${place.name}</b><br><button onclick="UserContent.addToRoute('${place.id}', '${place.name}')">Добавить в маршрут</button>`);
        });
    },
    
    // Add place to route
    addToRoute(placeId, placeName) {
        const routePoints = document.getElementById('routePoints');
        if (routePoints) {
            const point = document.createElement('div');
            point.className = 'flex items-center justify-between bg-gray-50 p-2 rounded';
            point.innerHTML = `
                <span>${placeName}</span>
                <button onclick="this.parentElement.remove()" class="text-red-500">
                    <i class="fas fa-times"></i>
                </button>
            `;
            routePoints.appendChild(point);
        }
    }
};

// Export for global use
window.UserContent = UserContent;