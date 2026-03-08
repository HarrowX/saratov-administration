// Яндекс.Карты для Саратов 435

let yandexMap;
let mapObjects = [];

// Данные достопримечательностей Саратова
const saratovLandmarks = [
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
        image: 'https://upload.wikimedia.org/wikipedia/commons/thumb/8/8a/Saratov_Drama_Theater.jpg/800px-Saratov_Drama_Theater.jpg',
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
        image: 'zxeuRo9jvnRZ8hFOgcjkVoQtQXpO8oikP3hEXg5d926Qngdwe6zy-pxOBBDCQsmhvewwbY5kytqC6EBv7beFmesCyiNrE74lHUK1jyEJ5QJF-XAub2LI0a-9N-hpCqDNB2iw11xeRjrZu2EBE8PNoitNRcoqYszrBltgaSmwE46sBv32u7AuJy-xs0zz6NVxVD9y7O0XayZZKKb7qaowrGS6koRd7sXaC6pxgueCnaGaCHeaqrLMCPZ4.jpeg',
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
        image: 'limonariy.jpg',
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
        image: 'scale_1200 (1).jpg',
        rating: 4.8,
        visitTime: '1.5 часа',
        tags: ['музей', 'искусство', 'живопись']
    },
    {
        id: 11,
        name: 'Театр оперы и балета',
        lat: 51.5294,
        lng: 46.0354,
        category: 'culture',
        description: 'Саратовский театр оперы и балета - один из ведущих музыкальных театров Поволжья',
        image: 'saratovskiy-teatr-operyi-i-baleta.jpg',
        rating: 4.9,
        visitTime: '2.5 часа',
        tags: ['театр', 'опера', 'балет', 'культура']
    },
    {
        id: 12,
        name: 'Городской парк',
        lat: 51.5389,
        lng: 46.0089,
        category: 'park',
        description: 'Центральный парк культуры и отдыха с аттракционами и зелеными зонами',
        image: 'scale_1200 (2).jpg',
        rating: 4.6,
        visitTime: '1.5 часа',
        tags: ['парк', 'отдых', 'аттракционы', 'семья']
    },
    {
        id: 13,
        name: 'Проспект Кирова',
        lat: 51.5311,
        lng: 46.0344,
        category: 'landmark',
        description: 'Главная пешеходная улица Саратова с историческими зданиями и магазинами',
        image: 'f621dd6a9c428d4e949c4a00ebcc57d4.jpg',
        rating: 4.7,
        visitTime: '1 час',
        tags: ['улица', 'шопинг', 'архитектура', 'прогулки']
    }
];

// Цвета для категорий
const categoryColors = {
    culture: '#9333EA',
    landmark: '#3B82F6',
    entertainment: '#EF4444',
    park: '#10B981',
    religious: '#F59E0B',
    museum: '#8B5CF6',
    nature: '#22C55E'
};

// Иконки для категорий
const categoryIcons = {
    culture: '🎭',
    landmark: '🏛️',
    entertainment: '🎪',
    park: '🌳',
    religious: '⛪',
    museum: '🏛️',
    nature: '🌿'
};

// Инициализация карты
function initYandexMap() {
    // Проверяем, что карта уже не инициализирована
    if (yandexMap) {
        console.log('Карта уже инициализирована, пропускаем...');
        return;
    }

    const mapContainer = document.getElementById('map');
    if (!mapContainer) {
        console.log('Контейнер карты не найден');
        return;
    }

    // Проверяем, что API Яндекс.Карт загружен
    if (typeof ymaps === 'undefined') {
        console.error('Yandex Maps API не загружен, повторная попытка через 2 секунды...');
        setTimeout(initYandexMap, 2000);
        return;
    }

    console.log('Инициализация Яндекс.Карт...');

    // Инициализируем карту
    ymaps.ready(function() {
        try {
            // Дополнительная проверка перед созданием карты
            if (yandexMap) {
                console.log('Карта уже создана, пропускаем...');
                return;
            }

            yandexMap = new ymaps.Map('map', {
                center: [51.5339, 46.0345], // Саратов
                zoom: 13,
                controls: ['zoomControl', 'fullscreenControl', 'typeSelector']
            });

            console.log('Карта создана успешно');

            // Добавляем достопримечательности на карту
            addLandmarksToYandexMap();
            
            // Добавляем геолокацию
            addGeolocation();
        } catch (error) {
            console.error('Ошибка при создании карты:', error);
        }
    });
}

// Добавление достопримечательностей на карту
function addLandmarksToYandexMap() {
    if (!yandexMap) {
        console.log('Карта не инициализирована');
        return;
    }

    console.log('Добавление маркеров на карту...');

    saratovLandmarks.forEach((landmark, index) => {
        try {            
            // Создаем маркер с простой иконкой
            const marker = new ymaps.Placemark(
                [landmark.lat, landmark.lng],
                {
                    balloonContentHeader: landmark.name,
                    balloonContentBody: createBalloonContent(landmark),
                    balloonContentFooter: `<div style="text-align: center; margin-top: 10px;">
                        <button onclick="visitPlace(${landmark.id})" style="
                            background: #3B82F6; 
                            color: white; 
                            border: none; 
                            padding: 8px 16px; 
                            border-radius: 4px; 
                            margin-right: 8px;
                            cursor: pointer;
                        ">Отметить визит</button>
                        <button onclick="showRouteToPlace(${landmark.lat}, ${landmark.lng})" style="
                            background: #10B981; 
                            color: white; 
                            border: none; 
                            padding: 8px 16px; 
                            border-radius: 4px;
                            cursor: pointer;
                        ">Маршрут</button>
                    </div>`,
                    hintContent: landmark.name
                },
                {
                    preset: 'islands#circleIcon',
                    iconColor: categoryColors[landmark.category] || '#3B82F6'
                }
            );

            // Добавляем маркер на карту
            yandexMap.geoObjects.add(marker);
            mapObjects.push(marker);
            
            console.log(`Маркер ${index + 1} добавлен: ${landmark.name}`);
        } catch (error) {
            console.error(`Ошибка при добавлении маркера ${landmark.name}:`, error);
        }
    });

    console.log(`Всего добавлено маркеров: ${mapObjects.length}`);
}

// Создание содержимого балуна
function createBalloonContent(landmark) {
    return `
        <div style="max-width: 300px;">
            <div style="width: 100%; height: 150px; border-radius: 8px; margin-bottom: 10px; background: #f0f0f0; display: flex; align-items: center; justify-content: center; position: relative;">
                <img src="${landmark.image}" 
                     alt="${landmark.name}" 
                     style="width: 100%; height: 100%; object-fit: cover; border-radius: 8px;"
                     onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
                     onload="this.nextElementSibling.style.display='none';">
                <div style="display: none; flex-direction: column; align-items: center; justify-content: center; color: #666; font-size: 14px;">
                    <i class="fas fa-image" style="font-size: 24px; margin-bottom: 8px;"></i>
                    <span>Изображение недоступно</span>
                </div>
            </div>
            <h4 style="margin: 0 0 8px 0; font-size: 16px; font-weight: bold;">${landmark.name}</h4>
            <p style="margin: 0 0 10px 0; color: #666; font-size: 14px;">${landmark.description}</p>
            <div style="display: flex; justify-content: space-between; margin-bottom: 10px; font-size: 12px;">
                <span style="color: #F59E0B;">⭐ ${landmark.rating}</span>
                <span style="color: #666;">🕐 ${landmark.visitTime}</span>
            </div>
            <div style="display: flex; flex-wrap: wrap; gap: 4px;">
                ${landmark.tags.map(tag => `
                    <span style="background: #E3F2FD; color: #1976D2; padding: 2px 8px; border-radius: 12px; font-size: 11px;">
                        ${tag}
                    </span>
                `).join('')}
            </div>
        </div>
    `;
}

// Добавление геолокации
function addGeolocation() {
    if (!yandexMap) return;

    // Получаем текущее местоположение пользователя
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
            function(position) {
                const userLat = position.coords.latitude;
                const userLng = position.coords.longitude;

                // Добавляем маркер пользователя
                const userMarker = new ymaps.Placemark(
                    [userLat, userLng],
                    {
                        balloonContent: 'Вы здесь',
                        hintContent: 'Ваше местоположение'
                    },
                    {
                        iconLayout: 'default#imageWithContent',
                        iconImageHref: 'data:image/svg+xml;base64,' + btoa(`
                            <svg width="20" height="20" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="10" cy="10" r="10" fill="#3B82F6"/>
                                <circle cx="10" cy="10" r="6" fill="white"/>
                            </svg>
                        `),
                        iconImageSize: [20, 20],
                        iconImageOffset: [-10, -10]
                    }
                );

                yandexMap.geoObjects.add(userMarker);
                mapObjects.push(userMarker);

                // Центрируем карту на пользователе
                // yandexMap.setCenter([userLat, userLng], 15);
            },
            function(error) {
                console.log('Не удалось получить местоположение:', error);
            }
        );
    }
}

// Фильтрация маркеров по категории
function filterMarkers(category) {
    if (!yandexMap) return;

    // Очищаем карту
    yandexMap.geoObjects.removeAll();

    // Добавляем маркеры в зависимости от фильтра
    saratovLandmarks.forEach(landmark => {
        if (category === 'all' || landmark.category === category) {
            addLandmarkToMap(landmark);
        }
    });
}

// Добавление отдельного маркера на карту
function addLandmarkToMap(landmark) {
    if (!yandexMap) return;

    const marker = new ymaps.Placemark(
        [landmark.lat, landmark.lng],
        {
            balloonContentHeader: landmark.name,
            balloonContentBody: createBalloonContent(landmark),
            balloonContentFooter: `<div style="text-align: center; margin-top: 10px;">
                <button onclick="visitPlace(${landmark.id})" style="
                    background: #3B82F6; 
                    color: white; 
                    border: none; 
                    padding: 8px 16px; 
                    border-radius: 4px; 
                    margin-right: 8px;
                    cursor: pointer;
                ">Отметить визит</button>
                <button onclick="showRouteToPlace(${landmark.lat}, ${landmark.lng})" style="
                    background: #10B981; 
                    color: white; 
                    border: none; 
                    padding: 8px 16px; 
                    border-radius: 4px;
                    cursor: pointer;
                ">Маршрут</button>
            </div>`,
            hintContent: landmark.name
        },
        {
            iconLayout: 'default#imageWithContent',
            iconImageHref: 'data:image/svg+xml;base64,' + btoa(`
                <svg width="40" height="40" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="20" cy="20" r="20" fill="${categoryColors[landmark.category]}"/>
                    <text x="20" y="26" text-anchor="middle" fill="white" font-size="18">${categoryIcons[landmark.category]}</text>
                </svg>
            `),
            iconImageSize: [40, 40],
            iconImageOffset: [-20, -20]
        }
    );

    yandexMap.geoObjects.add(marker);
}

// Отметить посещение места
function visitPlace(placeId) {
    const place = saratovLandmarks.find(l => l.id === placeId);
    if (place) {
        // Здесь можно добавить логику для отметки посещения
        alert(`Вы посетили "${place.name}"! +10 баллов`);
    }
}

// Показать маршрут к месту
function showRouteToPlace(lat, lng) {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
            function(position) {
                const userLat = position.coords.latitude;
                const userLng = position.coords.longitude;
                
                // Открываем маршрут в Яндекс.Картах
                const url = `https://yandex.ru/maps/?rtext=${userLat},${userLng}~${lat},${lng}&rtt=auto`;
                window.open(url, '_blank');
            },
            function(error) {
                alert('Для построения маршрута необходимо разрешить доступ к геолокации');
            }
        );
    } else {
        alert('Ваш браузер не поддерживает геолокацию');
    }
}

// Инициализация при загрузке страницы
document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM загружен, инициализируем карту...');
    // Небольшая задержка для загрузки API
    setTimeout(initYandexMap, 2000);
});

// Принудительная инициализация карты
function forceInitMap() {
    console.log('Принудительная инициализация карты...');
    
    // Очищаем старую карту если она есть
    if (yandexMap) {
        console.log('Очищаем старую карту...');
        yandexMap.destroy();
        yandexMap = null;
        mapObjects = [];
    }
    
    // Очищаем контейнер карты
    const mapContainer = document.getElementById('map');
    if (mapContainer) {
        mapContainer.innerHTML = '';
    }
    
    // Инициализируем новую карту
    initYandexMap();
}

// Экспорт функций для глобального использования
window.filterMarkers = filterMarkers;
window.visitPlace = visitPlace;
window.showRouteToPlace = showRouteToPlace;
window.initYandexMap = initYandexMap;
window.forceInitMap = forceInitMap;
