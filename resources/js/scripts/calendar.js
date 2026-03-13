// Calendar of events
const monthYearEl = document.getElementById('month-year');
const daysContainer = document.getElementById('calendar-days');
const dayNamesContainer = document.querySelector('.calendar-day-names');
const prevBtn = document.getElementById('prev-btn');
const nextBtn = document.getElementById('next-btn');

// Элементы для отображения текущей даты на фото
const currentMonthYearEl = document.getElementById('current-month-year');
const currentDayEl = document.getElementById('current-day');

// Массивы месяцев и дней недели
const monthNames = [
    'Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь',
    'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'
];

const dayNames = ['Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб', 'Вс'];

const events = {
    2: {
        2: {name: 'Квест', textColor: '#BE185D', bgColor: '#FCE7F5'},
        11: {name: 'Концерт', textColor: '#7E22CE', bgColor: '#F3E8FF'},
        23: {name: 'Экскурсия', textColor: '#15803D', bgColor: '#DCFCE7'},
        27: {name: 'Лекция', textColor: '#4338CA', bgColor: '#E0E7FF'}
    }
};


let currentDate = new Date();

// Отображение текущей даты на фото
const renderCurrentDate = () => {
    const today = new Date();
    const day = today.getDate();
    const month = monthNames[today.getMonth()];
    const year = today.getFullYear();

    currentDayEl.textContent = day;
    currentMonthYearEl.textContent = `${month} - ${year}`;
};

// Отображение названий дней недели
const renderDayNames = () => {
    dayNamesContainer.innerHTML = dayNames.map(day => `<span>${day}</span>`).join('');
};

// Отображение календаря
const renderCalendar = () => {
    const year = currentDate.getFullYear();
    const month = currentDate.getMonth();

    monthYearEl.textContent = `${monthNames[month]} ${year}`;

    const firstDay = (new Date(year, month, 1).getDay() + 6) % 7;
    const daysInMonth = 32 - new Date(year, month, 32).getDate();

    daysContainer.innerHTML = '';

    for (let i = 0; i < firstDay; i++) {
        daysContainer.innerHTML += '<span class="calendar-days-hidden"></span>';
    }

    for (let day = 1; day <= daysInMonth; day++) {
        const isToday = day === new Date().getDate() &&
                        month === new Date().getMonth() &&
                        year === new Date().getFullYear();

        // Проверяем, есть ли событие в этот день
        const event = events[month]?.[day];

        // Создаем ячейку дня
        const dayCell = document.createElement('span');

        // Формируем классы
        let dayCellClasses = 'calendar-day';
        if (isToday) {
            dayCellClasses += ' today';
        }
        if (event) {
            dayCellClasses += ' has-event';
        }
        dayCell.className = dayCellClasses;

        const dayNumber = document.createElement('span');
        dayNumber.className = 'day-number';
        dayNumber.textContent = day;
        dayCell.appendChild(dayNumber);

        if (event) {
            const eventSpan = document.createElement('p');
            eventSpan.className = 'event-label';
            eventSpan.textContent = event.name;
            eventSpan.style.color = event.textColor;
            eventSpan.style.backgroundColor = event.bgColor;
            dayCell.appendChild(eventSpan);
        }

        daysContainer.appendChild(dayCell);
        // daysContainer.innerHTML += `<span class="${isToday ? 'today' : ''}">${day}</span>`;
    }
};

const changeMonth = (delta) => {
    currentDate.setMonth(currentDate.getMonth() + delta);
    renderCalendar();
};

renderCurrentDate();
renderDayNames();
renderCalendar();

if (prevBtn && nextBtn) {
    prevBtn.addEventListener('click', () => changeMonth(-1));
    nextBtn.addEventListener('click', () => changeMonth(1));
}
