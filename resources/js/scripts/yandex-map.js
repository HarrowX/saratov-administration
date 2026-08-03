let yandexMap;
let mapObjects = [];
let currentFilter = 'all';

const SARATOV_POSITION = [51.5339, 46.0345];
const STANDARD_ZOOM = 13;

const categoryColors = {
    attraction: '#3B82F6',
    hotel: '#F59E0B',
    restaurant: '#EF4444'
};

function getLandmarks() {
    return [
        ...(window.mapData?.attractions || []).map(item => ({
            id: item.id,
            name: item.name,
            lat: parseFloat(item.latitude),
            lng: parseFloat(item.longitude),
            category: 'attraction',
            description: item.short_description || '',
            tags: ['достопримечательность'],
            url: `/attractions/${item.slug || item.id}`,
        })),

        ...(window.mapData?.hotels || []).map(item => ({
            id: item.id,
            name: item.name,
            lat: parseFloat(item.latitude),
            lng: parseFloat(item.longitude),
            category: 'hotel',
            description: item.description || '',
            tags: ['отель'],
            url: `/hotels/${item.slug || item.id}`,
        })),

        ...(window.mapData?.restaurants || []).map(item => ({
            id: item.id,
            name: item.name,
            lat: parseFloat(item.latitude),
            lng: parseFloat(item.longitude),
            category: 'restaurant',
            description: item.description || '',
            tags: ['ресторан'],
            url: `/restaurants/${item.slug || item.id}`,
        }))
    ];
}

function setMapCenter(lat, lng) {
    yandexMap.center = [lat, lng];
}

function initYandexMap() {
    if (yandexMap) return;

    const mapContainer = document.getElementById('map');
    if (!mapContainer) return;

    if (typeof ymaps === 'undefined') {
        setTimeout(initYandexMap, 500);
        return;
    }
    ymaps.ready(() => {
        yandexMap = new ymaps.Map('map', {
            center: window.mapCenter || SARATOV_POSITION,
            zoom: window.mapZoom || STANDARD_ZOOM,
        });
        window.yandexMap = yandexMap;
        addMarkers();
        window.mapObjects = mapObjects;
    });
}

function addMarkers() {
    const landmarks = getLandmarks();

    landmarks.forEach(item => {
        const placemark = new ymaps.Placemark(
            [item.lat, item.lng],
            {
                balloonContent: createBalloonContent(item),
                hintContent: item.name,
                category: item.category
            },
            {
                preset: 'islands#circleIcon',
                iconColor: categoryColors[item.category] || '#3B82F6'
            }
        );

        yandexMap.geoObjects.add(placemark);
        mapObjects.push(placemark);
    });
}


function createBalloonContent(item) {
    const categoryText = {
        attraction: 'Достопримечательность',
        hotel: 'Отель',
        restaurant: 'Ресторан'
    }[item.category] || 'Место';
    return `
        <div class="max-w-[250px]">
            <h4 class="font-bold text-base mb-2 text-gray-800">${item.name}</h4>
            <p class="text-xs text-gray-400 mb-2">${categoryText}</p>
            <p class="text-sm text-gray-500 mb-2 leading-relaxed">${item.description || 'Описание отсутствует'}</p>
            <div class="flex items-center justify-between text-xs text-gray-400 pt-1 border-t border-gray-100">
            <a href="${item.url}"
               target="_blank"
               class="block w-full text-center bg-blue-500 hover:bg-blue-600 transition-colors duration-300 text-white text-sm font-medium py-1 rounded-lg">
                <i class="fas fa-external-link-alt mr-1"></i>Подробнее
            </a>
            </div>
        </div>
    `;
}
function forceInitMap() {
    const btn = document.querySelector('.map-button');
    const originalHtml = btn?.innerHTML || 'Загрузить карту';
    if (btn) {
        btn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Загрузка...';
        btn.disabled = true;
    }
    setTimeout(() => {
        try {
            if (yandexMap) {
                yandexMap.destroy();
                yandexMap = null;
            }
            mapObjects = [];
            const container = document.getElementById('map');
            if (container) {
                container.innerHTML = '';
            }
            initYandexMap();
            if (btn) {
                btn.innerHTML = originalHtml;
                btn.disabled = false;
            }
        } catch (error) {
            console.error('Ошибка перезагрузки карты:', error);
            if (btn) {
                btn.innerHTML = '<i class="fas fa-exclamation-triangle mr-2"></i>Ошибка';
                setTimeout(() => {
                    btn.innerHTML = originalHtml;
                    btn.disabled = false;
                }, 2000);
            }
        }
    }, 100);
}

//функция фильтров
function filterMapByCategory(category) {
    if (!yandexMap) {
        console.error('Карта не найдена');
        return;
    }
    currentFilter = category;

    window.mapObjects.forEach(marker => {
        try {
            window.yandexMap.geoObjects.remove(marker);
        } catch(e) {}
    });

    let shown = 0;
    if (category === 'all') {
        mapObjects.forEach(marker => {
            window.yandexMap.geoObjects.add(marker);
            shown++;
        });
    } else {
        mapObjects.forEach(marker => {
            if (marker.properties.get('category') === category) {
                window.yandexMap.geoObjects.add(marker);
                shown++;
            }
        });
    }
}
function toggleFilterPanel() {
    let panel = document.getElementById('filterPanel');

    if (panel) {
        panel.remove();
        return;
    }

    panel = document.createElement('div');
    panel.id = 'filterPanel';
    panel.className = 'absolute top-4 right-4 bg-white rounded-lg shadow-xl p-4 z-[1000] min-w-[220px] text-blue-800';

    panel.innerHTML = `
        <label class="block font-medium mb-2">
            <i class="fas fa-filter mr-1"></i>Фильтр по категориям
        </label>
        <div class="relative">
            <select id="categorySelect"
                    class="w-full px-3 py-2 border border-blue-100 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600/10 focus:border-blue-200  cursor-pointer appearance-none pr-10">
                <option value="all" ${currentFilter === 'all' ? 'selected' : ''}>Все категории</option>
                <option value="attraction" ${currentFilter === 'attraction' ? 'selected' : ''}>Достопримечательности</option>
                <option value="hotel" ${currentFilter === 'hotel' ? 'selected' : ''}>Отели</option>
                <option value="restaurant" ${currentFilter === 'restaurant' ? 'selected' : ''}>Рестораны</option>
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3 select-arrow transition-transform duration-200 peer-focus:rotate-180 text-blue-800">
                <i class="fas fa-chevron-down"></i>
            </div>
        </div>
    `;
    const style = document.createElement('style');
    style.textContent = `
        #filterPanel select {
            transition: all 0.2s ease;
        }
        #categorySelect {
                appearance: none;
                -webkit-appearance: none;
        }
        #categorySelect:focus + .select-arrow i {
            transform: rotate(180deg);
        }
    `;
    panel.appendChild(style);

    const mapContainer = document.getElementById('map');
    if (mapContainer && getComputedStyle(mapContainer).position === 'static') {
        mapContainer.style.position = 'relative';
    }
    mapContainer.appendChild(panel);

    const select = panel.querySelector('#categorySelect');
    select.addEventListener('change', function(e) {
        filterMapByCategory(e.target.value);
        panel.remove();
    });

    setTimeout(() => {
        document.addEventListener('click', function closePanel(e) {
            if (!panel.contains(e.target) && !e.target.closest('.map-button')) {
                panel.remove();
                document.removeEventListener('click', closePanel);
            }
        });
    }, 100);
}
document.addEventListener('DOMContentLoaded', () => {
    setTimeout(initYandexMap, 500);
});
window.initYandexMap = initYandexMap;
window.forceInitMap = forceInitMap;
window.toggleFilterPanel = toggleFilterPanel;
window.filterMapByCategory = filterMapByCategory;
window.setMapCenter = setMapCenter;
