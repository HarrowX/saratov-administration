const attractionsData = [
    {
        id: 1,
        title: "Саратовская консерватория",
        description: "Первая консерватория в российской провинции, основана в 1912 году. Уникальная архитектура и богатая история.",
        image: "https://www.tursar.ru/image/img424_0.jpg",
        time: "15 мин",
        category: "Фотозона",
        rating: 4.9,
        coordinates: [51.5333, 46.0342]
    },
    {
        id: 2,
        title: "Набережная Космонавтов",
        description: "Любимое место отдыха горожан с видом на Волгу. Здесь приземлился Юрий Гагарин после первого полёта.",
        image: "images/4fe8539f70401070351fe8228c84deaf619dded8.jpg",
        time: "30 мин",
        category: "Кафе",
        rating: 4.8,
        coordinates: [51.5247, 46.0667]
    },
    {
        id: 3,
        title: "Парк Победы",
        description: "Музей военной техники под открытым небом с уникальной экспозицией и вечным огнем.",
        image: "images/photo_2022-11-14_16-25-54.jpg",
        time: "45 мин",
        category: "Музей",
        rating: 4.7,
        coordinates: [51.5555, 45.9567]
    },
    {
        id: 4,
        title: "Саратовский мост",
        description: "Символ города, один из самых длинных мостов в Европе. Потрясающие виды на Волгу.",
        image: "images/Саратов легендарный и мистический.png",
        time: "20 мин",
        category: "Фотозона",
        rating: 4.9,
        coordinates: [51.5066, 46.0077]
    },
    {
        id: 5,
        title: "Театр оперы и балета",
        description: "Один из старейших театров России с богатой историей и великолепной архитектурой.",
        image: "images/saratovskiy-teatr-operyi-i-baleta.jpg",
        time: "60 мин",
        category: "Культура",
        rating: 4.8,
        coordinates: [51.5294, 46.0354]
    },
    {
        id: 6,
        title: "Лимонарий",
        description: "Уникальная оранжерея с экзотическими растениями и цитрусовыми деревьями.",
        image: "images/limonariy.jpg",
        time: "40 мин",
        category: "Парк",
        rating: 4.6,
        coordinates: [51.5444, 46.0022]
    },
    {
        id: 7,
        title: "Музей Радищева",
        description: "Первый общедоступный художественный музей в провинции России.",
        image: "images/scale_1200 (1).jpeg",
        time: "90 мин",
        category: "Музей",
        rating: 4.7,
        coordinates: [51.5289, 46.0333]
    },
    {
        id: 8,
        title: "Городской парк",
        description: "Центральный парк города с аттракционами, прудом и зелёными аллеями.",
        image: "images/scale_1200 (2).jpeg",
        time: "60 мин",
        category: "Парк",
        rating: 4.5,
        coordinates: [51.5389, 46.0089]
    },
    {
        id: 9,
        title: "Проспект Кирова",
        description: "Пешеходная улица - 'Саратовский Арбат' с магазинами, кафе и уличными музыкантами.",
        image: "images/f621dd6a9c428d4e949c4a00ebcc57d4.jpg",
        time: "45 мин",
        category: "Прогулка",
        rating: 4.6,
        coordinates: [51.5311, 46.0344]
    },
    {
        id: 10,
        title: "Цирк братьев Никитиных",
        description: "Первый стационарный цирк в России, основанный в 1876 году.",
        image: "images/07458c68242fb8524be00a45a7df919ea6e65e78.png",
        time: "90 мин",
        category: "Развлечения",
        rating: 4.7,
        coordinates: [51.5233, 46.0433]
    },
    {
        id: 11,
        title: "Национальная деревня",
        description: "Этнографический комплекс с домами разных народов Поволжья.",
        image: "images/img441_0.jpg",
        time: "60 мин",
        category: "Культура",
        rating: 4.5,
        coordinates: [51.5622, 45.9922]
    }
];

// ========================================
// 3. ПОКАЗАТЬ ДЕТАЛИ ДОСТОПРИМЕЧАТЕЛЬНОСТИ
// ========================================
function showAttractionDetails(id) {
    const attraction = attractionsData.find(a => a.id === id);
    if (!attraction) return;

    const modal = document.createElement('div');
    modal.className = 'fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4';
    modal.innerHTML = `
        <div class="bg-white rounded-2xl max-w-4xl w-full max-h-[90vh] overflow-y-auto">
        <div class="sticky top-4 z-50 pr-5 flex justify-end -mt-10">
            <button onclick="this.closest('.fixed').remove()"
                    class="bg-white/90 backdrop-blur rounded-full w-10 h-10 flex items-center justify-center hover:bg-white transition shadow-md hover:shadow-lg">
                <i class="fas fa-times text-gray-700"></i>
            </button>
        </div>

        <div class="relative">
            <img src="${attraction.image}" alt="${attraction.title}" class="photo w-full h-60 sm:h-80 md:h-90 lg:h-110 object-cover rounded-tl-2xl">
        </div>
            <div class="p-8">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between mb-4">
                    <h2>${attraction.title}</h2>
                    <span class="title-block">⭐ ${attraction.rating}</span>
                </div>
                <p class="text-gray-600 mb-1 sm:mb-6 text-lg">${attraction.description}</p>

                <div class="grid md:grid-cols-3 md:gap-4 mb-6">
                    <div class="bg-gray-50 rounded-lg p-4">
                        <i class="fas fa-clock text-blue-500 mb-2"></i>
                        <p class="text-lg text-gray-500">Время посещения</p>
                        <p class="font-semibold">${attraction.time}</p>
                    </div>
                    <div class="bg-gray-50 rounded-lg p-4">
                        <i class="fas fa-tag text-purple-500 mb-2"></i>
                        <p class="text-lg text-gray-500">Категория</p>
                        <p class="font-semibold">${attraction.category}</p>
                    </div>
                    <div class="bg-gray-50 rounded-lg p-4">
                        <i class="fas fa-map-marker-alt text-red-500 mb-2"></i>
                        <p class="text-lg text-gray-500">Расстояние</p>
                        <p class="font-semibold">2.5 км от центра</p>
                    </div>
                </div>

                <div class="flex gap-4 flex-col sm:flex-row">
                    <button onclick="showOnMap(${attraction.id})" class=" flex-1 bg-blue-500 text-white py-3 rounded-lg hover:bg-blue-600 transition flex flex-col sm:flex-row items-center justify-center">
                        <i class="fas fa-map mr-2 cursor-pointer"></i>Показать на карте
                    </button>
                    <button onclick="buildRoute(${attraction.id})" class="flex-1 bg-green-500 text-white py-3 rounded-lg hover:bg-green-600 transition flex flex-col sm:flex-row items-center justify-center">
                        <i class="fas fa-route mr-2 cursor-pointer"></i>Построить маршрут
                    </button>
                </div>
            </div>
        </div>
    `;

    document.body.appendChild(modal);
}

function showOnMap(attractionId) {
    const attraction = attractionsData.find(a => a.id === attractionId);
    if (!attraction) return;

    // Закрыть модальное окно если открыто
    const modal = document.querySelector('.fixed');
    if (modal) modal.remove();

    // Прокрутить к карте
    const mapSection = document.getElementById('map');
    if (mapSection) {
        mapSection.scrollIntoView({ behavior: 'smooth' });

        // Центрировать карту на достопримечательности
        setTimeout(() => {
            if (window.map && window.L) {
                window.map.setView(attraction.coordinates, 15);

                // Добавить маркер
                const marker = L.marker(attraction.coordinates)
                    .addTo(window.map)
                    .bindPopup(`
                        <div class="p-2">
                            <img src="${attraction.image}" class="w-full h-32 object-cover rounded mb-2">
                            <h3 class="font-bold">${attraction.title}</h3>
                            <p class="text-sm text-gray-600">${attraction.description}</p>
                            <button onclick="buildRoute(${attraction.id})" class="mt-2 bg-blue-500 text-white px-3 py-1 rounded text-sm">
                                Построить маршрут
                            </button>
                        </div>
                    `)
                    .openPopup();
            }
        }, 500);
    }
}

window.attractionsData = attractionsData;
window.showOnMap = showOnMap;
window.showAttractionDetails = showAttractionDetails;
