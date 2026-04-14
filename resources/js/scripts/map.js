// Map functionality for Saratov 435

let map;
let markers = [];
let userLocation = null;

// Saratov landmarks data
const landmarks = [
    ...(window.mapData?.attractions || []).map(item => ({
        id: item.id,
        name: item.name,
        lat: parseFloat(item.latitude),
        lng: parseFloat(item.longitude),
        category: 'attraction',
        description: item.short_description,
        image: item.image ?? '',
        rating: item.rating ?? 0,
        visitTime: item.visit_duration + ' мин',
        tags: ['достопримечательность']
    })),

    ...(window.mapData?.hotels || []).map(item => ({
        id: item.id,
        name: item.name,
        lat: parseFloat(item.latitude),
        lng: parseFloat(item.longitude),
        category: 'hotel',
        description: item.description,
        image: item.image ?? '',
        rating: item.rating ?? 0,
        visitTime: 'проживание',
        tags: ['отель']
    })),

    ...(window.mapData?.restaurants || []).map(item => ({
        id: item.id,
        name: item.name,
        lat: parseFloat(item.latitude),
        lng: parseFloat(item.longitude),
        category: 'restaurant',
        description: item.description,
        image: item.image ?? '',
        rating: item.rating ?? 0,
        visitTime: 'еда',
        tags: ['ресторан']
    }))
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
        const visited = window.checkVisitedPlace(placeId);
        if (visited) {
            window.showNotification(`Вы посетили "${place.name}"! +10 баллов`, 'success');
            window.addBonusPoints(10);
        } else {
            window.showNotification('Вы уже посещали это место', 'info');
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
        window.showNotification('Для построения маршрута необходимо разрешить доступ к геолокации', 'warning');
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
