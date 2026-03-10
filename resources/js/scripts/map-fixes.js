// Дополнительные исправления для карты

// Расширенный список достопримечательностей с координатами
const mapPoints = [
    // Основные достопримечательности
    { id: 1, name: "Саратовская консерватория", lat: 51.5333, lng: 46.0342, category: "culture", icon: "music" },
    { id: 2, name: "Набережная Космонавтов", lat: 51.5247, lng: 46.0667, category: "park", icon: "water" },
    { id: 3, name: "Парк Победы", lat: 51.5555, lng: 45.9567, category: "park", icon: "monument" },
    { id: 4, name: "Саратовский мост", lat: 51.5066, lng: 46.0077, category: "landmark", icon: "bridge" },
    { id: 5, name: "Театр оперы и балета", lat: 51.5294, lng: 46.0354, category: "culture", icon: "theater" },
    { id: 6, name: "Лимонарий", lat: 51.5444, lng: 46.0022, category: "park", icon: "tree" },
    { id: 7, name: "Музей Радищева", lat: 51.5289, lng: 46.0333, category: "museum", icon: "museum" },
    { id: 8, name: "Троицкий собор", lat: 51.5156, lng: 46.0156, category: "church", icon: "church" },
    { id: 9, name: "Городской парк", lat: 51.5389, lng: 46.0089, category: "park", icon: "tree" },
    { id: 10, name: "Проспект Кирова", lat: 51.5311, lng: 46.0344, category: "landmark", icon: "walking" },
    { id: 11, name: "Цирк братьев Никитиных", lat: 51.5233, lng: 46.0433, category: "entertainment", icon: "circus" },
    { id: 12, name: "Национальная деревня", lat: 51.5622, lng: 45.9922, category: "culture", icon: "home" },
    
    // Музеи
    { id: 13, name: "Краеведческий музей", lat: 51.5278, lng: 46.0367, category: "museum", icon: "museum" },
    { id: 14, name: "Музей Федина", lat: 51.5256, lng: 46.0389, category: "museum", icon: "book" },
    { id: 15, name: "Музей боевой славы", lat: 51.5567, lng: 45.9544, category: "museum", icon: "star" },
    
    // Рестораны и кафе
    { id: 16, name: "Ресторан 'Волга'", lat: 51.5244, lng: 46.0689, category: "food", icon: "utensils" },
    { id: 17, name: "Кофейня 'Гагарин'", lat: 51.5322, lng: 46.0356, category: "food", icon: "coffee" },
    { id: 18, name: "Ресторан 'Дружба'", lat: 51.5289, lng: 46.0411, category: "food", icon: "utensils" },
    { id: 19, name: "Пиццерия 'Италия'", lat: 51.5367, lng: 46.0322, category: "food", icon: "pizza-slice" },
    
    // Парки и скверы
    { id: 20, name: "Детский парк", lat: 51.5411, lng: 46.0133, category: "park", icon: "child" },
    { id: 21, name: "Сквер Первой учительницы", lat: 51.5267, lng: 46.0422, category: "park", icon: "graduation-cap" },
    { id: 22, name: "Кумысная поляна", lat: 51.5733, lng: 45.9856, category: "park", icon: "mountain" },
    
    // Театры и развлечения
    { id: 23, name: "ТЮЗ им. Киселева", lat: 51.5311, lng: 46.0389, category: "culture", icon: "theater" },
    { id: 24, name: "Филармония", lat: 51.5344, lng: 46.0367, category: "culture", icon: "music" },
    { id: 25, name: "Кинотеатр 'Победа'", lat: 51.5322, lng: 46.0411, category: "entertainment", icon: "film" }
];

// Категории для фильтрации
const mapCategories = {
    all: { name: "Все категории", icon: "map", color: "#3B82F6" },
    culture: { name: "Культура", icon: "theater-masks", color: "#8B5CF6" },
    museum: { name: "Музеи", icon: "landmark", color: "#EC4899" },
    park: { name: "Парки", icon: "tree", color: "#10B981" },
    food: { name: "Рестораны", icon: "utensils", color: "#F59E0B" },
    church: { name: "Храмы", icon: "church", color: "#6366F1" },
    entertainment: { name: "Развлечения", icon: "gamepad", color: "#EF4444" },
    landmark: { name: "Достопримечательности", icon: "monument", color: "#14B8A6" }
};

// Маршруты
const tourRoutes = [
    {
        id: 1,
        name: "Исторический центр",
        description: "Прогулка по историческому центру города",
        duration: "3 часа",
        distance: "5 км",
        points: [1, 7, 10, 5, 8],
        color: "#3B82F6"
    },
    {
        id: 2,
        name: "Культурный маршрут",
        description: "Театры, музеи и консерватория",
        duration: "4 часа",
        distance: "6 км",
        points: [1, 5, 7, 13, 14, 23, 24],
        color: "#8B5CF6"
    },
    {
        id: 3,
        name: "Парки и набережная",
        description: "Зеленые зоны и прогулка вдоль Волги",
        duration: "2.5 часа",
        distance: "7 км",
        points: [2, 9, 20, 3, 22],
        color: "#10B981"
    },
    {
        id: 4,
        name: "Гастрономический тур",
        description: "Лучшие рестораны и кафе города",
        duration: "5 часов",
        distance: "4 км",
        points: [16, 17, 18, 19],
        color: "#F59E0B"
    },
    {
        id: 5,
        name: "Космический Саратов",
        description: "Места, связанные с Юрием Гагариным",
        duration: "3 часа",
        distance: "8 км",
        points: [2, 17, 15, 3],
        color: "#EF4444"
    }
];

// Инициализация улучшенной карты
function initEnhancedMap() {
    if (!window.L || !document.getElementById('map')) return;
    
    // Если карта уже существует, обновляем её
    if (!window.map) {
        window.map = L.map('map').setView([51.5333, 46.0342], 13);
        
        // Добавляем слой карты
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: ''
        }).addTo(window.map);
    }
    
    // Создаём группы слоёв для категорий
    window.mapLayers = {};
    window.mapMarkers = [];
    
    // Добавляем все точки на карту
    mapPoints.forEach(point => {
        const categoryInfo = mapCategories[point.category] || mapCategories.all;
        
        // Создаём кастомную иконку
        const icon = L.divIcon({
            className: 'custom-marker',
            html: `<div class="marker-pin" style="background-color: ${categoryInfo.color};">
                     <i class="fas fa-${point.icon} text-white"></i>
                   </div>`,
            iconSize: [30, 30],
            iconAnchor: [15, 30],
            popupAnchor: [0, -30]
        });
        
        const marker = L.marker([point.lat, point.lng], { icon: icon })
            .bindPopup(`
                <div class="map-popup">
                    <h4 class="font-bold mb-2">${point.name}</h4>
                    <p class="text-sm text-gray-600 mb-2">${categoryInfo.name}</p>
                    <div class="flex gap-2">
                        <button onclick="showAttractionDetails(${point.id})" class="bg-blue-500 text-white px-3 py-1 rounded text-xs">
                            Подробнее
                        </button>
                        <button onclick="buildRoute(${point.id})" class="bg-green-500 text-white px-3 py-1 rounded text-xs">
                            Маршрут
                        </button>
                    </div>
                </div>
            `);
        
        marker.category = point.category;
        marker.addTo(window.map);
        window.mapMarkers.push(marker);
        
        // Группируем маркеры по категориям
        if (!window.mapLayers[point.category]) {
            window.mapLayers[point.category] = [];
        }
        window.mapLayers[point.category].push(marker);
    });
    
    // Добавляем контролы фильтров и маршрутов
    // addMapControls(); // Отключено по запросу пользователя
}

// Добавление контролов на карту
function addMapControls() {
    const mapContainer = document.getElementById('map');
    if (!mapContainer) return;
    
    // Создаём панель фильтров
    const filterPanel = document.createElement('div');
    filterPanel.className = 'absolute top-4 left-4 bg-white rounded-lg shadow-lg p-4 z-[1000] max-w-xs';
    filterPanel.innerHTML = `
        <h4 class="font-bold mb-3">Фильтры</h4>
        <div class="space-y-2 max-h-60 overflow-y-auto">
            ${Object.entries(mapCategories).map(([key, category]) => `
                <label class="flex items-center space-x-2 cursor-pointer hover:bg-gray-50 p-1 rounded">
                    <input type="checkbox" class="map-filter" data-category="${key}" ${key === 'all' ? 'checked' : ''}>
                    <i class="fas fa-${category.icon}" style="color: ${category.color}"></i>
                    <span class="text-sm">${category.name}</span>
                </label>
            `).join('')}
        </div>
    `;
    
    // Создаём панель маршрутов
    const routePanel = document.createElement('div');
    routePanel.className = 'absolute top-4 right-4 bg-white rounded-lg shadow-lg p-4 z-[1000] max-w-xs';
    routePanel.innerHTML = `
        <h4 class="font-bold mb-3">Маршруты</h4>
        <div class="space-y-2 max-h-60 overflow-y-auto">
            ${tourRoutes.map(route => `
                <div class="border rounded-lg p-2 cursor-pointer hover:shadow-md transition" onclick="showRoute(${route.id})">
                    <div class="flex items-center justify-between mb-1">
                        <h5 class="font-semibold text-sm">${route.name}</h5>
                        <div class="w-3 h-3 rounded-full" style="background-color: ${route.color}"></div>
                    </div>
                    <p class="text-xs text-gray-600">${route.description}</p>
                    <div class="flex items-center space-x-3 mt-1 text-xs text-gray-500">
                        <span><i class="fas fa-clock"></i> ${route.duration}</span>
                        <span><i class="fas fa-route"></i> ${route.distance}</span>
                    </div>
                </div>
            `).join('')}
        </div>
    `;
    
    mapContainer.parentElement.appendChild(filterPanel);
    mapContainer.parentElement.appendChild(routePanel);
    
    // Обработчики для фильтров
    document.querySelectorAll('.map-filter').forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            filterMapMarkers();
        });
    });
    
    // Обработчик для фильтра "Все категории"
    const allCheckbox = document.querySelector('.map-filter[data-category="all"]');
    if (allCheckbox) {
        allCheckbox.addEventListener('change', function() {
            if (this.checked) {
                document.querySelectorAll('.map-filter:not([data-category="all"])').forEach(cb => {
                    cb.checked = false;
                });
                showAllMarkers();
            }
        });
    }
}

// Функция фильтрации маркеров
function filterMapMarkers() {
    const checkedFilters = Array.from(document.querySelectorAll('.map-filter:checked'))
        .map(cb => cb.dataset.category);
    
    // Если выбран "Все категории", показываем все
    if (checkedFilters.includes('all')) {
        showAllMarkers();
        return;
    }
    
    // Скрываем все маркеры
    window.mapMarkers.forEach(marker => {
        window.map.removeLayer(marker);
    });
    
    // Показываем только выбранные категории
    if (checkedFilters.length > 0) {
        window.mapMarkers.forEach(marker => {
            if (checkedFilters.includes(marker.category)) {
                marker.addTo(window.map);
            }
        });
    } else {
        // Если ничего не выбрано, показываем все
        showAllMarkers();
    }
}

// Показать все маркеры
function showAllMarkers() {
    window.mapMarkers.forEach(marker => {
        marker.addTo(window.map);
    });
}

// Показать маршрут на карте
function showRoute(routeId) {
    const route = tourRoutes.find(r => r.id === routeId);
    if (!route || !window.map) return;
    
    // Удаляем предыдущий маршрут если есть
    if (window.currentRoute) {
        window.map.removeLayer(window.currentRoute);
    }
    
    // Получаем координаты точек маршрута
    const routeCoordinates = route.points.map(pointId => {
        const point = mapPoints.find(p => p.id === pointId);
        return point ? [point.lat, point.lng] : null;
    }).filter(coord => coord !== null);
    
    // Рисуем маршрут
    window.currentRoute = L.polyline(routeCoordinates, {
        color: route.color,
        weight: 4,
        opacity: 0.7
    }).addTo(window.map);
    
    // Центрируем карту на маршруте
    window.map.fitBounds(window.currentRoute.getBounds(), { padding: [50, 50] });
    
    // Показываем информацию о маршруте
    showNotification(`Маршрут "${route.name}" отображен на карте`, 'success');
}

// Добавляем стили для маркеров
const mapStyles = `
<style>
.custom-marker {
    background: transparent;
    border: none;
}
.marker-pin {
    width: 30px;
    height: 30px;
    border-radius: 50% 50% 50% 0;
    position: relative;
    transform: rotate(-45deg);
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 2px 4px rgba(0,0,0,0.3);
}
.marker-pin i {
    transform: rotate(45deg);
    font-size: 14px;
}
.map-popup {
    min-width: 200px;
}
.leaflet-popup-content {
    margin: 8px 10px;
}
</style>
`;

// Добавляем стили в head
if (!document.getElementById('map-custom-styles')) {
    const styleElement = document.createElement('div');
    styleElement.id = 'map-custom-styles';
    styleElement.innerHTML = mapStyles;
    document.head.appendChild(styleElement);
}

// Инициализация при загрузке
document.addEventListener('DOMContentLoaded', function() {
    setTimeout(initEnhancedMap, 500);
});

// Экспортируем функции для глобального использования
window.initEnhancedMap = initEnhancedMap;
window.showRoute = showRoute;
window.filterMapMarkers = filterMapMarkers;