// Шаблон одной карточки
function createCard(title, time, points, imageUrl) {
    return `
    <div class="card bg-white rounded-[19px] overflow-hidden shadow-lg">
        <div class="card-content p-6">
            <div class="card-img" class="absolute">
                <img src="${imageUrl}" alt="${title}" class="rounded-3xl">
                <div class="relative w-15 h-15 text-white text-center text-4xl bg-[#A855F7] rounded-xl flex items-center justify-center -top-90 -right-99">
                    <i class="fa-sharp fa-solid fa-heart"></i>
                </div>
            </div>
            <div class="flex flex-col font-['FindSansPro'] h-full">
                <h3 class="text-3xl font-bold pt-8 pb-16">${title}</h3>
                <div class="flex flex-col grow">
                    <div class="mt-auto">
                        <div class="flex flex-row text-xl font-light gap-8 text-[#5F5F5F] pb-6">
                            <span class="flex items-center gap-2">
                                <i class="fa-solid fa-clock"></i>
                                ${time} часа
                            </span>
                            <span class="flex items-center gap-2">
                                <i class="fas fa-map-marker-alt"></i>
                                ${points} точек
                            </span>
                        </div>
                        <form action="guided-tours.html">
                            <button class="gradient-button text-white text-xl py-3 rounded-lg hover:opacity-90 transition-opacity w-full">
                            Подробнее</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    `;
}

const cardsData = [
    {
        title: "Мистический Саратов",
        time: "2",
        points: "6",
        imageUrl: "image/трамвай.png"
    },
    {
        title: "Саратов - город устремленный к звездам",
        time: "3",
        points: "2",
        imageUrl: "image/памятник гагарину.png"
    },
    {
        title: "Модерн в Саратове",
        time: "4",
        points: "8",
        imageUrl: "image/консерватория (1).png"
    },
    {
        title: "Столыпин и русская армия",
        time: "3",
        points: "1",
        imageUrl: "image/памятник.png"
    },
    {
        title: "Любимое место отдыха саратовцев и первого космонавта",
        time: "2",
        points: "1",
        imageUrl: "image/памятник гагарину.png"
    },
    {
        title: "История старособорной площади",
        time: "5",
        points: "4",
        imageUrl: "image/консерватория (3).png"
    },
    {
        title: "История новособорной площади",
        time: "3",
        points: "6",
        imageUrl: "image/консерватория (2).png"
    },
    {
        title: "Экскурсионная программа по Саратовскому пешеходному кольцу на электросамокатах «Столыпинский Саратов»",
        time: "2",
        points: "4",
        imageUrl: "image/памятник (2).png"
    },
    {
        title: "«Саратов революционный»",
        time: "2",
        points: "4",
        imageUrl: "image/трамвай (4).png"
    },
    {
        title: "«Саратов в истории кино»",
        time: "2",
        points: "4",
        imageUrl: "image/кино.png"
    },
    {
        title: "«Учителями славится Саратов»",
        time: "2",
        points: "4",
        imageUrl: "image/«Учителями славится Саратов».png"
    },
    {
        title: "«Я сохранил о Саратове наилучшие воспоминания» Служба П.А. Столыпина в Саратове",
        time: "2",
        points: "4",
        imageUrl: "image/памятник гагарину.png"
    },
    {
        title: "Саратов ученый",
        time: "2",
        points: "4",
        imageUrl: "image/трамвай.png"
    },
    {
        title: "История набережной космонавтов",
        time: "2",
        points: "4",
        imageUrl: "image/памятник гагарину (1).png"
    },
    {
        title: "История Саратовского Арбата",
        time: "2",
        points: "4",
        imageUrl: "image/«Учителями славится Саратов».png"
    },
];

// function renderCards() {
//     const container = document.getElementById('cardsContainer');
//     container.innerHTML = cardsData.map(card => 
//         createCard(card.title, card.time, card.points, card.imageUrl)
//     ).join('');
// }

// renderCards();