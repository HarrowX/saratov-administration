
let yandexMap;
let mapObjects = [];

const categoryColors = {
    attraction: '#3B82F6',
    hotel: '#F59E0B',
    restaurant: '#EF4444'
};

const categoryIcons = {
    attraction: '🏛️',
    hotel: '🏨',
    restaurant: '🍽️'
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
            image: item.image ?? '',
            rating: item.rating ?? 0,
            visitTime: item.visit_duration ? item.visit_duration + ' мин' : '',
            tags: ['достопримечательность']
        })),

        ...(window.mapData?.hotels || []).map(item => ({
            id: item.id,
            name: item.name,
            lat: parseFloat(item.latitude),
            lng: parseFloat(item.longitude),
            category: 'hotel',
            description: item.description || '',
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
            description: item.description || '',
            image: item.image ?? '',
            rating: item.rating ?? 0,
            visitTime: 'еда',
            tags: ['ресторан']
        }))
    ];
}


function initYandexMap() {
    if (yandexMap) return;

    const mapContainer = document.getElementById('map');
    if (!mapContainer) return;

    if (typeof ymaps === 'undefined') {
        console.log('Yandex API не готов, ждём...');
        setTimeout(initYandexMap, 500);
        return;
    }
    ymaps.ready(() => {
        yandexMap = new ymaps.Map('map', {
            center: [51.5339, 46.0345],
            zoom: 13
        });

        addMarkers();
    });
}

function addMarkers() {
    const landmarks = getLandmarks();

    console.log('LANDMARKS:', landmarks);

    landmarks.forEach(item => {
        const placemark = new ymaps.Placemark(
            [item.lat, item.lng],
            { balloonContent: item.name }
        );

        yandexMap.geoObjects.add(placemark);
    });
}


function createBalloonContent(item) {
    return `
        <div style="max-width: 250px;">
            <h4 style="margin:0 0 8px 0;">${item.name}</h4>
            <p style="margin:0 0 6px 0;color:#666;">${item.description}</p>
            <div style="font-size:12px;">
                ⭐ ${item.rating} <br>
                🕐 ${item.visitTime}
            </div>
        </div>
    `;
}


function addGeolocation() {
    if (!navigator.geolocation) return;

    navigator.geolocation.getCurrentPosition(pos => {
        const marker = new ymaps.Placemark([
            pos.coords.latitude,
            pos.coords.longitude
        ], {
            balloonContent: 'Вы здесь'
        }, {
            preset: 'islands#blueCircleDotIcon'
        });

        yandexMap.geoObjects.add(marker);
        mapObjects.push(marker);
    });
}


document.addEventListener('DOMContentLoaded', () => {
    setTimeout(initYandexMap, 500);
});


window.initYandexMap = initYandexMap;
