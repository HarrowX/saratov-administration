// Map functionality for Saratov 435

let map;
let markers = [];
let userLocation = null;

// Saratov landmarks data
const landmarks = [
    {
        id: 1,
        name: 'Саратовская государственная консерватория',
        lat: 51.5339,
        lng: 46.0345,
        category: 'culture',
        description: 'Первая консерватория в российской провинции, основана в 1912 году',
        image: 'https://www.tursar.ru/image/img424_0.jpg',
        rating: 4.9,
        visitTime: '30 мин',
        tags: ['история', 'архитектура', 'музыка']
    },
    {
        id: 2,
        name: 'Набережная Космонавтов',
        lat: 51.5250,
        lng: 46.0000,
        category: 'landmark',
        description: 'Место приземления Юрия Гагарина после первого космического полета',
        image: 'https://saratov.travel/upload/resize_cache/iblock/a24/800_800_1/zdaz5dsiak6svkfvbkaen7umeuroj1sx.jpg',
        rating: 4.8,
        visitTime: '1 час',
        tags: ['космос', 'прогулки', 'Гагарин']
    },
    {
        id: 3,
        name: 'Саратовский цирк',
        lat: 51.5289,
        lng: 46.0478,
        category: 'entertainment',
        description: 'Первый стационарный цирк в России, основан в 1876 году',
        image: 'https://upload.wikimedia.org/wikipedia/commons/thumb/6/66/%D0%A6%D0%B8%D1%80%D0%BA_%D0%B2_%D0%A1%D0%B0%D1%80%D0%B0%D1%82%D0%BE%D0%B2%D0%B5.jpg/1200px-%D0%A6%D0%B8%D1%80%D0%BA_%D0%B2_%D0%A1%D0%B0%D1%80%D0%B0%D1%82%D0%BE%D0%B2%D0%B5.jpg',
        rating: 4.7,
        visitTime: '2 часа',
        tags: ['развлечения', 'история', 'дети']
    },
    {
        id: 4,
        name: 'Парк Победы',
        lat: 51.5553,
        lng: 46.0733,
        category: 'park',
        description: 'Мемориальный комплекс с музеем военной техники под открытым небом',
        image: 'https://saratov.travel/upload/resize_cache/iblock/18c/8glui7vh5ldyyw0g7m2e4xcc3530vuzk/800_800_1/photo_2022-11-14_16-25-54.jpg',
        rating: 4.8,
        visitTime: '1.5 часа',
        tags: ['парк', 'история', 'военная техника']
    },
    {
        id: 5,
        name: 'Театр драмы им. И.А. Слонова',
        lat: 51.5333,
        lng: 46.0422,
        category: 'culture',
        description: 'Один из старейших театров России, основан в 1803 году',
        image: 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=400',
        rating: 4.9,
        visitTime: '2 часа',
        tags: ['театр', 'культура', 'искусство']
    },
    {
        id: 6,
        name: 'Свято-Троицкий собор',
        lat: 51.5283,
        lng: 46.0444,
        category: 'religious',
        description: 'Главный православный храм Саратова, памятник архитектуры XVII века',
        image: 'https://images.unsplash.com/photo-1588943211346-0908a1fb0b01?w=400',
        rating: 4.8,
        visitTime: '45 мин',
        tags: ['храм', 'архитектура', 'история']
    },
    {
        id: 7,
        name: 'Музей-усадьба Н.Г. Чернышевского',
        lat: 51.5306,
        lng: 46.0236,
        category: 'museum',
        description: 'Дом-музей великого русского писателя и философа',
        image: 'https://images.unsplash.com/photo-1583346840863-b85e8e0ae656?w=400',
        rating: 4.6,
        visitTime: '1 час',
        tags: ['музей', 'литература', 'история']
    },
    {
        id: 8,
        name: 'Мост через Волгу',
        lat: 51.5450,
        lng: 45.9567,
        category: 'landmark',
        description: 'Один из самых длинных мостов в Европе - 2,8 км',
        image: 'https://photocentra.ru/images/main19/192962_main.jpg',
        rating: 4.7,
        visitTime: '30 мин',
        tags: ['архитектура', 'Волга', 'виды']
    },
    {
        id: 9,
        name: 'Лимонарий',
        lat: 51.5372,
        lng: 46.0089,
        category: 'nature',
        description: 'Уникальный питомник экзотических растений с коллекцией цитрусовых',
        image: 'https://images.unsplash.com/photo-1563741494-7c5f6eb11bd0?w=400',
        rating: 4.5,
        visitTime: '1 час',
        tags: ['природа', 'растения', 'экзотика']
    },
    {
        id: 10,
        name: 'Радищевский музей',
        lat: 51.5275,
        lng: 46.0411,
        category: 'museum',
        description: 'Первый общедоступный музей в провинции, основан в 1885 году',
        image: 'https://images.unsplash.com/photo-1565402895794-0e7c60e67571?w=400',
        rating: 4.8,
        visitTime: '1.5 часа',
        tags: ['музей', 'искусство', 'живопись']
    }
];

// Initialize map
function initMap() {
    // Check if map container exists
    const mapContainer = document.getElementById('map');
    if (!mapContainer) return;
    
    // Initialize Leaflet map centered on Saratov
    map = L.map('map').setView([51.5339, 46.0345], 13);
    
    // Add OpenStreetMap tiles
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '',
        maxZoom: 19
    }).addTo(map);
    
    // Add landmarks to map
    addLandmarksToMap();
    
    // Try to get user location
    getUserLocation();
    
    // Add map controls
    addMapControls();
}

// Add landmarks to map
function addLandmarksToMap() {
    // Define category icons
    const categoryIcons = {
        culture: '🎭',
        landmark: '🏛️',
        entertainment: '🎪',
        park: '🌳',
        religious: '⛪',
        museum: '🏛️',
        nature: '🌿'
    };
    
    // Define category colors
    const categoryColors = {
        culture: '#9333EA',
        landmark: '#3B82F6',
        entertainment: '#EF4444',
        park: '#10B981',
        religious: '#F59E0B',
        museum: '#8B5CF6',
        nature: '#22C55E'
    };
    
    landmarks.forEach(landmark => {
        // Create custom icon
        const customIcon = L.divIcon({
            html: `<div style="background: ${categoryColors[landmark.category]}; color: white; width: 30px; height: 30px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 16px; box-shadow: 0 2px 8px rgba(0,0,0,0.3);">
                ${categoryIcons[landmark.category]}
            </div>`,
            className: 'custom-marker',
            iconSize: [30, 30],
            iconAnchor: [15, 15]
        });
        
        // Create marker
        const marker = L.marker([landmark.lat, landmark.lng], { icon: customIcon })
            .addTo(map);
        
        // Create popup content
        const popupContent = `
            <div class="popup-content">
                <img src="${landmark.image}" alt="${landmark.name}" class="popup-image">
                <h4 class="font-bold text-lg mb-2">${landmark.name}</h4>
                <p class="text-sm text-gray-600 mb-3">${landmark.description}</p>
                <div class="flex items-center justify-between mb-3">
                    <div class="flex items-center space-x-2 text-sm">
                        <span class="text-yellow-500"><i class="fas fa-star"></i> ${landmark.rating}</span>
                        <span class="text-gray-500"><i class="fas fa-clock"></i> ${landmark.visitTime}</span>
                    </div>
                </div>
                <div class="flex flex-wrap gap-1 mb-3">
                    ${landmark.tags.map(tag => `<span class="text-xs bg-blue-100 text-blue-600 px-2 py-1 rounded">${tag}</span>`).join('')}
                </div>
                <div class="flex space-x-2">
                    <button onclick="visitPlace(${landmark.id})" class="flex-1 bg-blue-500 text-white px-3 py-2 rounded text-sm hover:bg-blue-600 transition">
                        <i class="fas fa-check mr-1"></i> Отметить визит
                    </button>
                    <button onclick="showRoute(${landmark.lat}, ${landmark.lng})" class="flex-1 bg-green-500 text-white px-3 py-2 rounded text-sm hover:bg-green-600 transition">
                        <i class="fas fa-route mr-1"></i> Маршрут
                    </button>
                </div>
            </div>
        `;
        
        marker.bindPopup(popupContent, {
            maxWidth: 300,
            className: 'custom-popup'
        });
        
        markers.push({
            marker: marker,
            data: landmark
        });
    });
}

// Get user location
function getUserLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
            (position) => {
                userLocation = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };
                
                // Add user marker
                const userIcon = L.divIcon({
                    html: '<div style="background: #3B82F6; width: 15px; height: 15px; border-radius: 50%; border: 3px solid white; box-shadow: 0 2px 8px rgba(0,0,0,0.3);"></div>',
                    className: 'user-location-marker',
                    iconSize: [15, 15],
                    iconAnchor: [7.5, 7.5]
                });
                
                L.marker([userLocation.lat, userLocation.lng], { icon: userIcon })
                    .addTo(map)
                    .bindPopup('Вы здесь');
            },
            (error) => {
                console.log('Could not get user location:', error);
            }
        );
    }
}

// Add map controls
function addMapControls() {
    // Create custom control for filters
    const FilterControl = L.Control.extend({
        options: {
            position: 'topright'
        },
        
        onAdd: function() {
            const container = L.DomUtil.create('div', 'leaflet-bar leaflet-control');
            container.innerHTML = `
                <div class="bg-white p-2 rounded shadow">
                    <select id="categoryFilter" onchange="filterMarkers(this.value)" class="px-3 py-1 border rounded">
                        <option value="all">Все категории</option>
                        <option value="culture">Культура</option>
                        <option value="landmark">Достопримечательности</option>
                        <option value="entertainment">Развлечения</option>
                        <option value="park">Парки</option>
                        <option value="religious">Религия</option>
                        <option value="museum">Музеи</option>
                        <option value="nature">Природа</option>
                    </select>
                </div>
            `;
            
            L.DomEvent.disableClickPropagation(container);
            return container;
        }
    });
    
    // map.addControl(new FilterControl()); // Отключено по запросу пользователя
}

// Filter markers by category
function filterMarkers(category) {
    markers.forEach(item => {
        if (category === 'all' || item.data.category === category) {
            map.addLayer(item.marker);
        } else {
            map.removeLayer(item.marker);
        }
    });
}

// Visit place
function visitPlace(placeId) {
    const place = landmarks.find(l => l.id === placeId);
    if (place) {
        const visited = window.saratovApp.checkVisitedPlace(placeId);
        if (visited) {
            window.saratovApp.showNotification(`Вы посетили "${place.name}"! +10 баллов`, 'success');
            window.saratovApp.addBonusPoints(10);
        } else {
            window.saratovApp.showNotification('Вы уже посещали это место', 'info');
        }
    }
}

// Show route to place
function showRoute(lat, lng) {
    if (userLocation) {
        // Open route in new tab using OpenStreetMap directions
        const url = `https://www.openstreetmap.org/directions?from=${userLocation.lat},${userLocation.lng}&to=${lat},${lng}`;
        window.open(url, '_blank');
    } else {
        window.saratovApp.showNotification('Для построения маршрута необходимо разрешить доступ к геолокации', 'warning');
        getUserLocation();
    }
}

// Thematic routes
const routes = [
    {
        id: 1,
        name: 'Путь Гагарина',
        description: 'Маршрут по местам, связанным с первым космонавтом',
        places: [2, 4],
        duration: '3 часа',
        distance: '5 км',
        difficulty: 'легкий'
    },
    {
        id: 2,
        name: 'Культурное наследие',
        description: 'Театры, музеи и консерватория Саратова',
        places: [1, 5, 10, 7],
        duration: '4 часа',
        distance: '3 км',
        difficulty: 'легкий'
    },
    {
        id: 3,
        name: 'Исторический центр',
        description: 'Прогулка по историческому центру города',
        places: [1, 3, 5, 6, 10],
        duration: '5 часов',
        distance: '4 км',
        difficulty: 'средний'
    }
];

// Show route on map
function showRouteOnMap(routeId) {
    const route = routes.find(r => r.id === routeId);
    if (!route || !map) return;
    
    // Clear existing route
    clearRoute();
    
    // Get coordinates for route places
    const routeCoords = route.places.map(placeId => {
        const place = landmarks.find(l => l.id === placeId);
        return place ? [place.lat, place.lng] : null;
    }).filter(coord => coord !== null);
    
    // Draw polyline
    const routeLine = L.polyline(routeCoords, {
        color: '#3B82F6',
        weight: 4,
        opacity: 0.7,
        smoothFactor: 1
    }).addTo(map);
    
    // Fit map to show entire route
    map.fitBounds(routeLine.getBounds(), { padding: [50, 50] });
    
    // Store route line for later removal
    map.routeLine = routeLine;
    
    // Highlight route places
    route.places.forEach(placeId => {
        const markerItem = markers.find(m => m.data.id === placeId);
        if (markerItem) {
            markerItem.marker.openPopup();
        }
    });
}

// Clear route from map
function clearRoute() {
    if (map && map.routeLine) {
        map.removeLayer(map.routeLine);
        map.routeLine = null;
    }
}

// Initialize map when DOM is ready
document.addEventListener('DOMContentLoaded', () => {
    setTimeout(initMap, 100); // Small delay to ensure all resources are loaded
});

// Export for use in other modules
window.mapModule = {
    showRouteOnMap,
    clearRoute,
    landmarks,
    routes
};