// Calendar of events
document.addEventListener('DOMContentLoaded', function() {
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

// const events = window.eventsData || {};
    const calendarSection = document.getElementById('achievements');
    const eventsData = calendarSection?.dataset.events;

    let events = {};
    try {
        events = JSON.parse(eventsData) || {};
    } catch (e) {
        console.warn('No events data or invalid JSON:', e);
        events = {};
    }

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

            const eventCount = events[month]?.[day] || 0;
            const hasEvent = eventCount > 0;

            const dayCell = document.createElement('span');
            let dayCellClasses = 'calendar-day';
            if (isToday) {
                dayCellClasses += ' today';
            }
            if (hasEvent) {
                dayCellClasses += ' has-event';
            }
            dayCell.className = dayCellClasses;

            const dayNumber = document.createElement('span');
            dayNumber.className = 'day-number';
            dayNumber.textContent = day;
            dayCell.appendChild(dayNumber);

            if (hasEvent) {
                const dotsContainer = document.createElement('span');
                dotsContainer.className = 'event-dots';

                const maxDots = 5;
                const dotsToShow = Math.min(eventCount, maxDots);

                for (let i = 0; i < dotsToShow; i++) {
                    const dot = document.createElement('span');
                    dot.className = 'event-dot';
                    dotsContainer.appendChild(dot);
                }

                if (eventCount > maxDots) {
                    const plus = document.createElement('span');
                    plus.className = 'event-plus';
                    plus.textContent = `+${eventCount - maxDots}`;
                    dotsContainer.appendChild(plus);
                }

                dayCell.appendChild(dotsContainer);
                dayCell.style.cursor = 'pointer';
                dayCell.addEventListener('click', function() {
                    const date = `${year}-${String(month + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
                    window.location.href = `/events?date=${date}`;
                });
            }

            daysContainer.appendChild(dayCell);
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
});
