<section id="achievements" class="pb-17.5 xl:pb-28.5 bg-white" data-events="{{ $eventsData }}">
    <div class="max-w-6xl 3xl:max-w-7xl mx-auto px-4 sm:px-10" data-aos="zoom-in" data-aos-delay="250">
        <div class="text-center mb-4 sm:mb-12">
            <h2>Календарь событий</h2>
            <p class="text text-gray-600">Планируй выходные вместе с нами</p>
        </div>

        <div class="flex flex-col sm:flex-row justify-center font-['Centurygothic'] tracking-widest">
            <div class="w-full sm:w-50 lg:w-70 xl:w-75 3xl:w-88">
                <div class="relative w-full h-50 sm:h-full rounded-t-xl sm:rounded-tr-none sm:rounded-l-xl lg:rounded-l-4xl overflow-hidden shadow-xl">
                    <img src="{{asset('/images/f3429762a6cc1d6808382c4abeff79f593da9f61.webp')}}" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-black/50"></div>
                    <div class="absolute top-0 right-0 px-1 py-0.5 lg:px-2 lg:py-1 m-2 text-[#FFFFFFB2] border-[#FFFFFF66] border xl:border-2 text-xs sm:text-base rounded-sm">СЕГОДНЯ</div>
                    <div class="absolute inset-0 flex flex-col items-center justify-center text-white">
                        <span class="text-xs lg:text-xl 3xl:text-2xl uppercase" id="current-month-year"></span>
                        <span class="text-8xl lg:text-9xl xl:text-[180px] 3xl:text-[212px] leading-none" id="current-day"></span>
                    </div>
                </div>
            </div>

            <div class="rounded-b-xl sm:rounded-bl-none sm:rounded-r-xl lg:rounded-r-4xl shadow-xl">
                <div class="calendar bg-white px-4 sm:px-3 pt-4 lg:pt-7 md:px-7 3xl:pt-8 rounded-b-xl sm:rounded-bl-0 rounded-r-xl lg:rounded-r-4xl">
                    <div class="calendar-header flex items-center justify-between mb-4 lg:mb-8">
                        <button type="button" class="calendar-btn size-10 flex items-center justify-center rounded-full hover:bg-gray-100 transition-colors" id="prev-btn">
                            <img src="/images/Vector.svg" alt="Предыдущий месяц" class="icon size-4">
                        </button>
                        <span id="month-year" class="text-sm lg:text-xl 3xl:text-2xl font-semibold text-gray-800"></span>
                        <button type="button" class="calendar-btn size-10 flex items-center justify-center rounded-full hover:bg-gray-100 transition-colors" id="next-btn">
                            <img src="/images/Vector.svg" alt="Следующий месяц" class="icon size-4 transform rotate-180">
                        </button>
                    </div>

                    <div class="calendar-body text-base lg:text-lg 3xl:text-2xl">
                        <div class="calendar-day-names grid grid-cols-7 gap-1 sm:gap-2 mb-4">
                        </div>
                        <div class="calendar-days grid grid-cols-7 gap-3 mb-4" id="calendar-days">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
