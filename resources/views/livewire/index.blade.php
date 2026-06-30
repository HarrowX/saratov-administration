@php use App\Models\Attraction; @endphp

@section('title')
    Саратов 435 - Цифровой дайвинг в историю города
@endsection
<script>
    window.mapData = {
        attractions: @js($attractions),
        hotels: @js($hotels),
        restaurants: @js($restaurants),
    };
</script>
<div class="bg-gray-50">
   <section id="home" class="hero-section flex flex-col items-center justify-around relative bg-[url('/images/bg-image.png')] bg-center bg-no-repeat bg-cover " style="min-height: calc(100dvh - 80px); margin-top: 80px;" xl:style="min-height: calc(100dvh - 96px); margin-top: 96px;">
        <div class="max-w-6xl 3xl:max-w-7xl mx-auto flex flex-col h-full w-full px-1 xs:px-4 sm:px-10">

            <div class="flex flex-col items-center md:items-end justify-center flex-1 gap-10 3xl:gap-15 pt-15 pb-7 lg:pb-10 3xl:pb-15">
                <h1 class="hero-title text-5xl text-center md:text-right sm:text-7xl md:text-8xl 3xl:text-9xl text-white leading-none tracking-[5px] max-w-full md:max-w-xl 3xl:max-w-2xl">
                    Саратов на волне времени!
                </h1>
                <div class="flex flex-wrap gap-3.5 sm:gap-7.5 justify-center md:justify-start">
                    <button onclick="showAppDownload()" class="hero-section-button text-xs sm:text-sm lg:text-base from-green-500 to-teal-600">
                        <i class="fas fa-mobile-alt mr-2 group-hover:animate-bounce"></i>
                        Скачать приложение
                    </button>
                    <button onclick="startJourney()" class="hero-section-button text-xs sm:text-sm lg:text-base from-blue-500 to-purple-600">
                        <i class="fas fa-compass mr-2"></i>
                        Начать путешествие
                    </button>
                </div>
            </div>

            <div class="flex flex-col lg:flex-row items-center justify-between gap-5 lg:gap-10 3xl:gap-22 bg-[#3736365C] backdrop-blur-[30px] rounded-[40px] p-5 3xl:p-8.75 font-['FindSansPro'] mb-8 3xl:mb-20">
                <div class="text-sm xl:text-base 3xl:text-xl text-center lg:text-left text-white max-w-2xl">
                        Откройте для себя уникальное культурное наследие города, где начинал свой путь Юрий Гагарин, творили великие артисты и писатели
                </div>
                <div class="flex flex-row items-center gap-4 md:gap-8 xl:gap-12">
                    <div class="flex flex-col items-center">
                        <span class="text-[#993FEA] font-black text-lg sm:text-2xl 3xl:text-4xl">100+</span>
                        <p class="text-white text-[10px] sm:text-xs md:text-sm">Маршрутов</p>
                    </div>
                    <div class="flex flex-col items-center">
                        <span class="text-[#22C55E] font-black text-lg sm:text-2xl 3xl:text-4xl">100+</span>
                        <p class="text-white text-[10px] sm:text-xs md:text-sm">Экскурсоводов</p>
                    </div>
                    <div class="flex flex-col items-center">
                        <span class="text-[#5293FF] font-black text-lg sm:text-2xl 3xl:text-4xl">50+</span>
                        <p class="text-white text-[10px] sm:text-xs md:text-sm text-nowrap">Знаковых мест</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- App Download Section -->
    <section id="app-download" class="pb-15 pt-15 lg:pt-20 lg:pb-20 3xl:pb-32.5 overflow-hidden bg-linear-to-r from-blue-600 to-purple-600 text-white">
        <div class="max-w-6xl 3xl:max-w-7xl mx-auto px-4 sm:px-10">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div data-aos="fade-right" class="flex flex-col items-center md:items-start">
                    <span class="bg-white/20 backdrop-blur text-white px-4 py-2 rounded-full text-sm font-semibold mb-4 inline-block">
                        <i class="fas fa-mobile-alt mr-2"></i>МОБИЛЬНОЕ ПРИЛОЖЕНИЕ
                    </span>
                    <h2 class="text-center md:text-left">Саратов всегда с вами</h2>
                    <p class="text text-white/90 text-center md:text-left mb-8">
                        Скачайте наше приложение и получите доступ ко всем функциям офлайн,
                        AR-навигации, эксклюзивным скидкам и персональным маршрутам
                    </p>

                    <div class="flex flex-col flex-wrap content-center md:content-start space-y-4 mb-8">
                        <div class="flex items-center space-x-3">
                            <div class="w-12 h-12 bg-white/20 backdrop-blur rounded-lg flex items-center justify-center">
                                <i class="fas fa-map-marked-alt text-white"></i>
                            </div>
                            <div>
                                <h1 class="font-semibold">Офлайн карты</h1>
                                <p class="text-white/80 text-sm">Работает без интернета</p>
                            </div>
                        </div>

                        <div class="flex items-center space-x-3">
                            <div class="w-12 h-12 bg-white/20 backdrop-blur rounded-lg flex items-center justify-center">
                                <i class="fas fa-vr-cardboard text-white"></i>
                            </div>
                            <div>
                                <h1 class="font-semibold">AR режим</h1>
                                <p class="text-white/80 text-sm">Путешествие во времени</p>
                            </div>
                        </div>

                        <div class="flex items-center space-x-3">
                            <div class="w-12 h-12 bg-white/20 backdrop-blur rounded-lg flex items-center justify-center">
                                <i class="fas fa-bell text-white"></i>
                            </div>
                            <div>
                                <h1 class="font-semibold">Push-уведомления</h1>
                                <p class="text-white/80 text-sm">Не пропустите события</p>
                            </div>
                        </div>
                    </div>

                </div>

                <div data-aos="fade-left" class="text-center">
                    <div class="bg-white rounded-2xl p-8 inline-block">
                        <h1 class="text-gray-900 font-bold text-xl mb-4">Сканируйте QR-код</h1>
                        <!-- QR Code image -->
                        <div class="w-64 h-64 rounded-lg overflow-hidden mb-4">
                            <img src="/images/qrprila.jpg" alt="QR-код приложения">
                        </div>
                        <p class="text-gray-600">Наведите камеру телефона</p>
                    </div>

                    <!-- Phone mockup -->
                    <div class="mt-8 relative hidden xl:block">
                        <div class="absolute -top-10 -left-10 w-20 h-20 bg-yellow-400 rounded-full opacity-20 animate-ping"></div>
                        <div class="absolute -bottom-10 -right-10 w-32 h-32 bg-purple-400 rounded-full opacity-20 animate-ping" style="animation-delay: 1s"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features-section py-10 sm:py-15 xl:py-20 3xl:py-26 bg-white">
        <div class="max-w-6xl 3xl:max-w-7xl mx-auto px-4 sm:px-10">
            <div class="text-center mb-12" data-aos="fade-up">
                <h2>Что вас ждет в приложении</h2>
                <p class="text text-gray-600">Уникальные возможности для жителей и гостей города</p>
            </div>

            <div class="parent-grid">

                <!-- Карточка 1 -->
                <div data-aos="fade-up" data-aos-delay="100" class="child-grid bg-linear-to-br from-blue-50 to-blue-100 rounded-xl p-5 3xl:p-8 hover:shadow-xl transition">
                    <div class="size-16 bg-blue-500 rounded-lg flex items-center justify-center mb-6">
                        <i class="fas fa-map-marked-alt text-white text-2xl"></i>
                    </div>
                    <h3>Интерактивная карта</h3>
                    <p>Все достопримечательности города на одной карте с подробной информацией и фотографиями</p>
                    <ul>
                        <li><i class="fas fa-check text-green-500 mr-2"></i>AR-навигация</li>
                        <li><i class="fas fa-check text-green-500 mr-2"></i>Аудиогиды</li>
                        <li><i class="fas fa-check text-green-500 mr-2"></i>3D модели</li>
                    </ul>
                </div>

                <!-- Карточка 2 -->
                <div data-aos="fade-up" data-aos-delay="200" class="child-grid bg-linear-to-br from-purple-50 to-purple-100 rounded-xl p-5 3xl:p-8 hover:shadow-xl transition">
                    <div class="size-16 bg-purple-500 rounded-lg flex items-center justify-center mb-6">
                        <i class="fas fa-trophy text-white text-2xl"></i>
                    </div>
                    <h3>Геймификация</h3>
                    <p>Зарабатывайте достижения, открывайте новые маршруты и получайте бонусы</p>
                    <ul>
                        <li><i class="fas fa-check text-green-500 mr-2"></i>30+ достижений</li>
                        <li><i class="fas fa-check text-green-500 mr-2"></i>Рейтинг путешественников</li>
                        <li><i class="fas fa-check text-green-500 mr-2"></i>Еженедельные квесты</li>
                    </ul>
                </div>

                <!-- Карточка 3 -->
                <div data-aos="fade-up" data-aos-delay="300" class="child-grid bg-linear-to-br from-green-50 to-green-100 rounded-xl p-5 3xl:p-8 hover:shadow-xl transition">
                    <div class="size-16 bg-green-500 rounded-lg flex items-center justify-center mb-6">
                        <div class="w-7.5 h-7.5">
                            <img src="/images/streamline-ultimate_concert-dj-bold.png" alt="иконка">
                        </div>
                    </div>
                    <h3>Узнавай первым про мероприятия в городе</h3>
                    <p>Все концерты, фестивали и события города в одном месте с описаниями, датами и локациями</p>
                    <ul>
                        <li><i class="fas fa-check text-green-500 mr-2"></i>До 30% скидок</li>
                        <li><i class="fas fa-check text-green-500 mr-2"></i>Кэшбэк программа</li>
                        <li><i class="fas fa-check text-green-500 mr-2"></i>Специальные акции</li>
                    </ul>
                </div>

            </div>
        </div>
    </section>

    <!-- Attractions Section -->
    <section id="attractions" class="py-10 md:py-20 bg-gray-50 overflow-hidden">
        <div class="max-w-6xl 3xl:max-w-7xl mx-auto px-4 sm:px-10">
            <div class="text-center mb-12" data-aos="fade-up">
                <h1 class="text-2xl sm:text-3xl lg:text-3xl 3xl:text-4x font-bold mb-4 tracking-[1px]">Главные достопримечательности</h1>
                <p class="text text-gray-600">Откройте для себя уникальные места Саратова</p>
            </div>

            <!-- Карусель -->
            <div class="relative group">
                <div class="flex overflow-x-auto gap-6 pb-16 scrollbar-hide scroll-smooth"
                     style="scrollbar-width: none; -ms-overflow-style: none;">

                    @foreach($carouselAttractions as $attraction)
                        <div class="min-w-87.5 bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 cursor-pointer group group/image">
                            <div class="relative h-48 overflow-hidden">
                                <img src="{{ $attraction->attachments?->get(0)?->url() ?? "" }}"
                                     alt="Изображение {{ $attraction->name }}" class="photo w-full h-full object-cover group-hover/image:scale-110 transition-transform duration-500">
                                <div class="absolute inset-0 bg-linear-to-t from-black/60 via-transparent to-transparent"></div>
                            </div>
                            <div class="p-6">
                                <h3 class="text-xl font-bold mb-2 h-10 md:h-15 xl:h-21">{{ $attraction->name }}</h3>
                                <p class="text-gray-600 text-sm mb-4 line-clamp-2">{{ $attraction->short_description }}</p>
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center text-gray-500 text-sm">
                                        <i class="fas fa-clock mr-2"></i>
                                        <span>{{ $attraction->visit_duration }} мин</span>
                                    </div>
                                    <a href="{{ route('single-attraction', ['attraction' => $attraction->slug]) }}" class="shrink-0 size-10 xl:size-11 bg-linear-to-r from-[#A556F7] to-[#2663EB] rounded-full flex items-center justify-center hover:opacity-90 transition-opacity hover:scale-110 group/button overflow-hidden relative">
                                        <img src="/images/Arrow 2.png" alt="" class="icon w-2 xl:w-3 h-4.5 xl:h-6 transition-transform duration-300 group-hover/button:translate-x-1">
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Кнопки навигации -->
                <div class="absolute top-1/2 -translate-y-1/2 left-0 -translate-x-4 opacity-0 group-hover:opacity-100 transition-opacity hidden lg:block">
                    <button onclick="this.closest('.relative').querySelector('.overflow-x-auto').scrollBy({left: -400, behavior: 'smooth'})"
                            class="w-10 h-10 bg-white rounded-full shadow-lg flex items-center justify-center text-gray-600 hover:text-blue-500 transition-colors">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                </div>
                <div class="absolute top-1/2 -translate-y-1/2 right-0 translate-x-4 opacity-0 group-hover:opacity-100 transition-opacity hidden lg:block">
                    <button onclick="this.closest('.relative').querySelector('.overflow-x-auto').scrollBy({left: 400, behavior: 'smooth'})"
                            class="w-10 h-10 bg-white rounded-full shadow-lg flex items-center justify-center text-gray-600 hover:text-blue-500 transition-colors">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>
            </div>

            <div class="grid md:grid-cols-2 gap-8 mb-12">
                @foreach($featuredAttractions as $attraction)
                    <div data-aos="fade-right" class="bg-white rounded-xl shadow-lg overflow-hidden group hover:shadow-2xl duration-500 transition-shadow">
                        <div class="relative h-64 overflow-hidden">
                            <img src="{{ $attraction->attachments?->get(0)?->url() ?? "" }}"
                                 alt="Изображение {{ $attraction->name }}"
                                 class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                        </div>
                        <div class="p-6">
                            <h3 class="text-2xl font-bold mb-3">{{ $attraction->name }}</h3>
                            <p class="text-gray-600 mb-4">{{ $attraction->short_description }}</p>
                            <div class=" flex items-center justify-between">
                                <div class="flex items-center text-sm text-gray-500">
                                    <span><i class="fas fa-walking mr-1"></i>{{ $attraction->visit_duration }} мин</span>
                                </div>
                                <a href="{{ route('single-attraction', ['attraction' => $attraction->slug]) }}" class="arrow-link shrink-0 size-10 xl:size-11 3xl:size-15 bg-linear-to-r from-[#A556F7] to-[#2663EB] rounded-full flex items-center justify-center hover:opacity-90 hover:scale-110 group/button relative overflow-hidden transition-all duration-300 ease-in-out hover:shadow-lg hover:shadow-purple-500/30">
                                    <img src="/images/Arrow 2.png" alt="иконка" class="icon w-2 xl:w-3 3xl:w-4 h-4.5 xl:h-6 3xl:h-7.5 transition-transform duration-300 group-hover/button:translate-x-1">
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <!-- Map Container -->
            <div data-aos="fade-up" class="bg-white rounded-xl shadow-lg p-6">
                <div class="flex flex-col sm:flex-row gap-4 lg:flex-row items-center justify-between mb-4">
                    <h1 class="text-2xl font-bold mb-3">Интерактивная карта</h1>
                    <div class="flex space-x-4">
                        <button onclick="forceInitMap()" class="map-button bg-purple-100 text-purple-600 hover:bg-purple-200">
                            <i class="fas fa-sync mr-2"></i>Загрузить карту
                        </button>
                        <button onclick="toggleFilterPanel()" class="map-button bg-blue-100 text-blue-600 hover:bg-blue-200">
                            <i class="fas fa-filter mr-2"></i>Фильтры
                        </button>
{{--                        <button onclick="showRoute(1)" class="map-button bg-green-100 text-green-600 hover:bg-green-200">--}}
{{--                            <i class="fas fa-route mr-2"></i>Маршруты--}}
{{--                        </button>--}}
                    </div>
                </div>
                <div id="map" class="h-125 rounded-lg"></div>
            </div>
        </div>
    </section>

    <!-- AR Experience Section (New!) -->
    <section id="ar-experience" class="pt-10 sm:pt-15 xl:pt-20 3xl:pt-26 bg-white overflow-hidden">
        <div class="max-w-6xl 3xl:max-w-7xl mx-auto px-4">
            <div class="flex flex-col items-center mb-5 md:mb-12" data-aos="fade-up">
                <span class="flex justify-center gap-2 bg-linear-to-r from-purple-600 to-blue-600 text-white px-4 py-1 rounded-full text-sm font-semibold mb-4 text-nowrap">
                     <img src="/images/Symbol.svg" alt="Иконка" class="icon">НОВАЯ ФУНКЦИЯ
                </span>
                <h2>Путешествие во времени с AR</h2>
                <p class="text text-gray-600">Увидьте, как выглядел Саратов 100 лет назад через камеру телефона</p>
            </div>

            <div class="grid md:grid-cols-2 gap-7 xl:gap-12 items-center">
                <div data-aos="fade-right">
                    <div class="relative xl:w-full md:h-99 xl:h-full shadow-xl">
                        <img src="/images/a2180e30ceeba4a115385d68e52b22ba3e08df0f.jpg" alt="Саратовский мост" class="rounded-2xl">
                        <div class="absolute inset-0 bg-linear-to-t from-black/50 to-transparent rounded-2xl"></div>
                        <div class="absolute bottom-6 left-6 text-white">
                            <div class="bg-white/20 backdrop-blur-sm rounded-lg p-4">
                                <h1 class="font-bold md:text-base lg:text-lg mb-2">AR режим доступен</h1>
                                <p class="text-sm">Наведите камеру на QR-код рядом с достопримечательностью</p>
                            </div>
                        </div>
                        <!-- Floating AR elements -->
                        <div class="absolute -top-4 -right-4 bg-linear-to-r from-purple-500 to-blue-500 text-white rounded-full p-4 animate-bounce">
                            <i class="fas fa-vr-cardboard text-2xl"></i>
                        </div>
                    </div>
                </div>

                <div data-aos="fade-left" class="flex flex-col items-start">
                    <h1 class="text-3xl font-bold mb-6">Оживите историю города</h1>
                    <div class="space-y-4 mb-8">
                        <div class="flex items-start space-x-4">
                            <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center shrink-0">
                                <i class="fas fa-history text-purple-600"></i>
                            </div>
                            <div>
                                <h5 class="font-semibold mb-1">Исторические реконструкции</h5>
                                <p class="text-gray-600">Увидьте здания и улицы в их первоначальном виде</p>
                            </div>
                        </div>

                        <div class="flex items-start space-x-4">
                            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center shrink-0">
                                <i class="fas fa-user-astronaut text-blue-600"></i>
                            </div>
                            <div>
                                <h5 class="font-semibold mb-1">Встреча с Гагариным</h5>
                                <p class="text-gray-600">AR-персонаж расскажет о своем приземлении в Саратове</p>
                            </div>
                        </div>

                        <div class="flex items-start space-x-4">
                            <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center shrink-0">
                                <i class="fas fa-theater-masks text-green-600"></i>
                            </div>
                            <div>
                                <h5 class="font-semibold mb-1">Виртуальные экскурсоводы</h5>
                                <p class="text-gray-600">Известные личности города проведут персональную экскурсию</p>
                            </div>
                        </div>
                    </div>

                    <button onclick="startARExperience()" class="bg-linear-to-r from-purple-500 to-blue-600 text-white px-8 py-4 rounded-lg font-semibold hover:shadow-lg transition transform hover:-translate-y-1 cursor-pointer">
                        <i class="fas fa-play mr-2"></i>
                        Попробовать AR
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- AI City Guide Section (Enhanced!) -->
    <section id="ai-guide" class="bg-white py-10 sm:py-15 xl:py-20 3xl:py-26">
        <div class="max-w-6xl 3xl:max-w-7xl mx-auto px-4 sm:px-10">
            <div class="text-center mb-12" data-aos="fade-up">
                <span class="bg-linear-to-r from-green-600 to-teal-600 text-white px-4 py-1 rounded-full text-sm font-semibold mb-4 inline-block">
                    <i class="fas fa-robot mr-2"></i>AI АССИСТЕНТ
                </span>
                <h2>Ваш персональный гид Саратов</h2>
                <p class="text text-gray-600 content-center">Интерактивный помощник, который подберет идеальный маршрут именно для вас</p>
            </div>

            <div class="max-w-4xl mx-auto">
                <div class="bg-linear-to-br from-green-50 to-teal-50 rounded-2xl p-4 md:p-8" data-aos="zoom-in">
                    <!-- Chat interface -->
                    <div class="bg-white flex flex-col rounded-xl shadow-inner h-125 p-2 md:p-6 mb-6" id="chatContainer">
                        <div class="flex-1 overflow-y-auto min-h-0 flex flex-col-reverse">
                            <div class="flex flex-col space-y-4 w-full px-2" id="chat-messages">
                            </div>
                        </div>
                    </div>

                    <!-- Input area -->
                    <div class="flex space-x-3">
                        <input type="text" id="aiChatInput" placeholder="Напишите сообщение..."
                               onkeypress="if(event.key === 'Enter') { handleChatMessage(this.value); this.value=''; }"
                               class="flex-1 w-20 text-sm lg:text-base py-2 px-2 md:px-4 md:py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-green-500">
                        <button onclick="const input = document.getElementById('aiChatInput'); handleChatMessage(input.value); input.value='';" class="bg-linear-to-r from-green-500 to-teal-600 text-white px-2 py-3 md:px-6 md:py-3 rounded-lg hover:shadow-lg transition">
                            <i class="fas fa-paper-plane"></i>
                        </button>
                        <button onclick="voiceInput()" class="bg-gray-200 text-gray-700 px-2 py-3 md:px-6 md:py-3 rounded-lg hover:bg-gray-300 transition">
                            <i class="fas fa-microphone"></i>
                        </button>
                    </div>

                    <!-- Quick actions -->
                    <div class="mt-4 flex flex-wrap gap-2">
                        <button onclick="handleChatMessage('start')" class="bg-blue-100 text-blue-700 px-4 py-2 rounded-full text-sm hover:bg-blue-200 transition">
                            🚀 Поехали!
                        </button>
                        <button onclick="handleChatMessage('где поесть')" class="bg-orange-100 text-orange-700 px-4 py-2 rounded-full text-sm hover:bg-orange-200 transition">
                            🍽️ Рестораны и кафе
                        </button>
                        <button onclick="handleChatMessage('парки')" class="bg-green-100 text-green-700 px-4 py-2 rounded-full text-sm hover:bg-green-200 transition">
                            🌳 Парки и прогулки
                        </button>
                        <button onclick="handleChatMessage('музеи')" class="bg-purple-100 text-purple-700 px-4 py-2 rounded-full text-sm hover:bg-purple-200 transition">
                            🏛️ Музеи и культура
                        </button>
                        <button onclick="handleChatMessage('погода')" class="bg-yellow-100 text-yellow-700 px-4 py-2 rounded-full text-sm hover:bg-yellow-200 transition">
                            🌤️ Погода
                        </button>
                        <button onclick="handleChatMessage('события')" class="bg-pink-100 text-pink-700 px-4 py-2 rounded-full text-sm hover:bg-pink-200 transition">
                            🎭 События
                        </button>
                        <button onclick="handleChatMessage('история')" class="bg-indigo-100 text-indigo-700 px-4 py-2 rounded-full text-sm hover:bg-indigo-200 transition">
                            📚 История города
                        </button>
                        <button onclick="handleChatMessage('шопинг')" class="bg-red-100 text-red-700 px-4 py-2 rounded-full text-sm hover:bg-red-200 transition">
                            🛍️ Шопинг
                        </button>
                    </div>

                    <!-- AI Features -->
                    <div class="grid md:grid-cols-4 gap-4 mt-8">
                        <div class="bg-white rounded-lg p-4 text-center">
                            <i class="fas fa-comments text-3xl text-blue-500 mb-2"></i>
                            <p class="font-semibold">Диалог</p>
                            <p class="text-xs text-gray-600">Интерактивное общение</p>
                        </div>
                        <div class="bg-white rounded-lg p-4 text-center">
                            <i class="fas fa-user-cog text-3xl text-green-500 mb-2"></i>
                            <p class="font-semibold">Персонализация</p>
                            <p class="text-xs text-gray-600">Учет ваших предпочтений</p>
                        </div>
                        <div class="bg-white rounded-lg p-4 text-center">
                            <i class="fas fa-map-marked text-3xl text-purple-500 mb-2"></i>
                            <p class="font-semibold">50+ мест</p>
                            <p class="text-xs text-gray-600">База знаний о городе</p>
                        </div>
                        <div class="bg-white rounded-lg p-4 text-center">
                            <i class="fas fa-sync text-3xl text-orange-500 mb-2"></i>
                            <p class="font-semibold">Обновления</p>
                            <p class="text-xs text-gray-600">Актуальная информация</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Photo Gallery Section -->
    <section id="gallery-section" class="pb-10 sm:pb-15 xl:pb-20 3xl:pb-26 bg-white">
        <div class="max-w-6xl 3xl:max-w-7xl mx-auto px-4">
            <div class="text-center mb-12" data-aos="fade-up">
                <span class="bg-linear-to-r from-pink-600 to-red-600 text-white px-4 py-1 rounded-full text-sm font-semibold mb-4 inline-block">
                    <i class="fas fa-camera mr-2"></i>ФОТОГАЛЕРЕЯ
                </span>
                <h2>Саратов в объективе</h2>
                <p class="text text-gray-600">Лучшие фотографии достопримечательностей и видов города</p>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <!-- Row 1 -->
                <div data-aos="zoom-in" class="col-span-2 row-span-2 relative group overflow-hidden rounded-lg" data-fancybox="gallery" data-src="/images/Saratovskiy-Krytyy-rynok.jpg"  data-caption="Крытый рынок">
                    <img src="/images/Saratovskiy-Krytyy-rynok.jpg" alt="Крытый рынок" class="group-hover:scale-110 transition duration-500">
                    <div class="absolute inset-0 bg-linear-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition">
                        <div class="absolute bottom-4 left-4 text-white">
                            <h1 class="font-bold text-lg">Крытый рынок</h1>
                        </div>
                    </div>
                </div>

                <div data-aos="zoom-in" data-aos-delay="100" class="relative group overflow-hidden rounded-lg" data-fancybox="gallery" data-src="/images/img424_0.jpg" data-caption="Консерватория">
                    <img src="/images/img424_0.jpg" alt="Консерватория" class="group-hover:scale-110 transition duration-500">
                    <div class="absolute inset-0 bg-linear-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition">
                        <div class="absolute bottom-4 left-4 text-white">
                            <h1 class="font-bold">Консерватория</h1>
                        </div>
                    </div>
                </div>

                <div data-aos="zoom-in" data-aos-delay="150" class="relative group overflow-hidden rounded-lg" data-fancybox="gallery" data-src="/images/07458c68242fb8524be00a45a7df919ea6e65e78.png" data-caption="Первый цирк России">
                    <img src="/images/07458c68242fb8524be00a45a7df919ea6e65e78.png" alt="Цирк" class="group-hover:scale-110 transition duration-500">
                    <div class="absolute inset-0 bg-linear-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition">
                        <div class="absolute bottom-4 left-4 text-white">
                            <h1 class="font-bold">Первый цирк России</h1>
                        </div>
                    </div>
                </div>

                <!-- Row 2 -->
                <div data-aos="zoom-in" data-aos-delay="200" class="relative group overflow-hidden rounded-lg" data-fancybox="gallery" data-src="/images/photo_2022-11-14_16-25-54.jpg"  data-caption="Парк Победы">
                    <img src="/images/photo_2022-11-14_16-25-54.jpg" alt="Парк Победы" class="group-hover:scale-110 transition duration-500">
                    <div class="absolute inset-0 bg-linear-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition">
                        <div class="absolute bottom-4 left-4 text-white">
                            <h1 class="font-bold">Парк Победы</h1>
                        </div>
                    </div>
                </div>

                <div data-aos="zoom-in" data-aos-delay="250" class="relative group overflow-hidden rounded-lg" data-fancybox="gallery" data-src="/images/8356339c970afc2d070e74f08f8a05505a083931.png" data-caption="Саратовский мост">
                    <img src="/images/8356339c970afc2d070e74f08f8a05505a083931.png" alt="Мост через Волгу" class="group-hover:scale-110 transition duration-500">
                    <div class="absolute inset-0 bg-linear-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition">
                        <div class="absolute bottom-4 left-4 text-white">
                            <h1 class="font-bold">Саратовский мост</h1>
                        </div>
                    </div>
                </div>

                <div data-aos="zoom-in" data-aos-delay="300" class="col-span-2 relative group overflow-hidden rounded-lg" data-fancybox="gallery" data-src="/images/Saratov-3.jpg" data-caption="Веречний саратов">
                    <img src="/images/Saratov-3.jpg" class="group-hover:scale-110 transition duration-500">
                    <div class="absolute inset-0 bg-lineart-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition">
                        <div class="absolute bottom-4 left-4 text-white">
                            <h1 class="font-bold text-lg">Вечерний Саратов</h1>
                            <p class="text-sm">Романтические виды на Волгу</p>
                        </div>
                    </div>
                </div>

                <!-- Row 3 -->
                <div data-aos="zoom-in" data-aos-delay="350" class="col-span-2 relative group overflow-hidden rounded-lg" data-fancybox="gallery" data-src="/images/ato58r5xh7sog4k40swwg0ksw.jpg" data-caption="Архитекртурное наследие">
                    <img src="/images/ato58r5xh7sog4k40swwg0ksw.jpg" alt="Консерватория фасад" class="group-hover:scale-110 transition duration-500">
                    <div class="absolute inset-0 bg-linear-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition">
                        <div class="absolute bottom-4 left-4 text-white">
                            <h1 class="font-bold text-lg">Архитектурное наследие</h1>
                            <p class="text-sm">Памятники архитектуры XIX-XX веков</p>
                        </div>
                    </div>
                </div>

                <div data-aos="zoom-in" data-aos-delay="400" class="relative group overflow-hidden rounded-lg" data-fancybox="gallery" data-src="/images/6whi7saljzocs40kwoo8okksg.jpg" data-caption="Великая Волга">
                    <img src="/images/6whi7saljzocs40kwoo8okksg.jpg" alt="Волга" class="group-hover:scale-110 transition duration-500">
                    <div class="absolute inset-0 bg-linear-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition">
                        <div class="absolute bottom-4 left-4 text-white">
                            <h1 class="font-bold">Великая Волга</h1>
                        </div>
                    </div>
                </div>

                <div data-aos="zoom-in" data-aos-delay="450" class="relative group overflow-hidden rounded-lg" data-fancybox="gallery" data-src="https://fs.tonkosti.ru/30/ls/30lsy6fot9s0o04g4wow8wkgc.jpg" data-caption="Летний Саратов">
                    <img src="https://fs.tonkosti.ru/30/ls/30lsy6fot9s0o04g4wow8wkgc.jpg" alt="Набережная летом" class="group-hover:scale-110 transition duration-500">
                    <div class="absolute inset-0 bg-linear-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition">
                        <div class="absolute bottom-4 left-4 text-white">
                            <h1 class="font-bold">Летний Саратов</h1>
                        </div>
                    </div>
                </div>
                <div data-aos="zoom-in" data-aos-delay="450" class="relative group overflow-hidden rounded-lg" data-fancybox="gallery" data-src="/images/d6e40fb855b389b4827ce14c2652cfc3c5295f12.png" data-caption="Церковь иконы Божией Матери">
                    <img src="/images/image 3.png" alt="Церковь иконы Божией Матери" class="group-hover:scale-110 transition duration-500">
                    <div class="absolute inset-0 bg-linear-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition">
                        <div class="absolute bottom-4 left-4 text-white">
                            <h1 class="font-bold">Церковь иконы Божией Матери</h1>
                        </div>
                    </div>
                </div>
                <div data-aos="zoom-in" data-aos-delay="450" class="relative group overflow-hidden rounded-lg" data-fancybox="gallery" data-src="/images/3a2ab4b764e3db0e3d0f1c051cffa200df2712a0.png" data-caption="Набережная Космонавтов ">
                    <img src="/images/image 22.png" alt="Набережная Космонавтов " class="group-hover:scale-110 transition duration-500">
                    <div class="absolute inset-0 bg-linear-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition">
                        <div class="absolute bottom-4 left-4 text-white">
                            <h1 class="font-bold">Набережная Космонавтов</h1>
                        </div>
                    </div>
                </div>
            </div>

            <!-- View more button -->
            <div class="text-center mt-12">
                <button class="btn-gallery bg-linear-to-r from-pink-500 to-red-500 text-white px-8 py-4 rounded-lg font-semibold hover:shadow-lg transition transform hover:-translate-y-1" data-gallery="full-gallery">
                    <i class="fas fa-images mr-2"></i>
                    Смотреть все фотографии
                </button>
            </div>
            <!-- Скрытая fancybox галерея -->
            <div style="display: none;">
                <a href="/images/Saratovskiy-Krytyy-rynok.jpg" data-fancybox="full-gallery" data-caption="Крытый рынок"></a>
                <a href="/images/img424_0.jpg" data-fancybox="full-gallery" data-caption="Консерватория"></a>
                <a href="/images/07458c68242fb8524be00a45a7df919ea6e65e78.png" data-fancybox="full-gallery"
                data-caption="Первый цирк России"></a>
                <a href="/images/photo_2022-11-14_16-25-54.jpg" data-fancybox="full-gallery"
                data-caption="Парк Победы"></a>
                <a href="/images/8356339c970afc2d070e74f08f8a05505a083931.png" data-fancybox="full-gallery"
                data-caption="Саратовский мост"></a>
                <a href="/images/Saratov-3.jpg" data-fancybox="full-gallery"
                data-caption="Вечерний Саратов"></a>
                <a href="/images/ato58r5xh7sog4k40swwg0ksw.jpg" data-fancybox="full-gallery"
                data-caption="Архитектурное наследие"></a>
                <a href="/images/6whi7saljzocs40kwoo8okksg.jpg" data-fancybox="full-gallery"
                data-caption="Великая волга"></a>
                <a href="https://fs.tonkosti.ru/30/ls/30lsy6fot9s0o04g4wow8wkgc.jpg" data-fancybox="full-gallery"
                data-caption="Летний Саратов"></a>
                <a href="/images/d6e40fb855b389b4827ce14c2652cfc3c5295f12.png" data-fancybox="full-gallery"
                data-caption="Церковь иконы Божией Матери"></a>
                <a href="/images/3a2ab4b764e3db0e3d0f1c051cffa200df2712a0.png" data-fancybox="full-gallery"
                data-caption="Набережная космонавтов"></a>
            </div>
        </div>
    </section>

    <!-- Achievements Section -->
    <section id="achievements" class="py-10 sm:py-15 xl:py-20 3xl:py-26 bg-white">
        <div class="max-w-6xl 3xl:max-w-7xl mx-auto px-4 sm:px-10">
            <div class="text-center mb-12" data-aos="fade-up">
                <h2>Система достижений</h2>
                <p class="text text-gray-600">Исследуйте город и получайте награды</p>
            </div>

            <div class="grid md:grid-cols-4 gap-6">
                <div data-aos="flip-left" class="achievement-card bg-white rounded-xl p-6 text-center hover:shadow-xl transition cursor-pointer">
                    <div class="w-20 h-20 mx-auto mb-4 bg-linear-to-br from-yellow-400 to-yellow-600 rounded-full flex items-center justify-center">
                        <i class="fas fa-star text-white text-3xl"></i>
                    </div>
                    <h1 class="font-bold mb-2">Первооткрыватель</h1>
                    <p class="text-sm text-gray-600">Посетите первую достопримечательность</p>
                    <div class="mt-4">
                        <div class="bg-gray-200 rounded-full h-2">
                            <div class="bg-linear-to-r from-yellow-400 to-yellow-600 h-2 rounded-full" style="width: 100%"></div>
                        </div>
                        <span class="text-xs text-gray-500 mt-1">Получено</span>
                    </div>
                </div>

                <div data-aos="flip-left" data-aos-delay="100" class="achievement-card bg-white rounded-xl p-6 text-center hover:shadow-xl transition cursor-pointer">
                    <div class="w-20 h-20 mx-auto mb-4 bg-linear-to-br from-blue-400 to-blue-600 rounded-full flex items-center justify-center">
                        <i class="fas fa-map text-white text-3xl"></i>
                    </div>
                    <h1 class="font-bold mb-2">Исследователь</h1>
                    <p class="text-sm text-gray-600">Пройдите 5 маршрутов</p>
                    <div class="mt-4">
                        <div class="bg-gray-200 rounded-full h-2">
                            <div class="bg-linear-to-r from-blue-400 to-blue-600 h-2 rounded-full" style="width: 60%"></div>
                        </div>
                        <span class="text-xs text-gray-500 mt-1">3/5</span>
                    </div>
                </div>

                <div data-aos="flip-left" data-aos-delay="200" class="achievement-card bg-white rounded-xl p-6 text-center hover:shadow-xl transition cursor-pointer opacity-50">
                    <div class="w-20 h-20 mx-auto mb-4 bg-gray-300 rounded-full flex items-center justify-center">
                        <i class="fas fa-crown text-white text-3xl"></i>
                    </div>
                    <h1 class="font-bold mb-2">Знаток города</h1>
                    <p class="text-sm text-gray-600">Посетите 20 мест</p>
                    <div class="mt-4">
                        <div class="bg-gray-200 rounded-full h-2">
                            <div class="bg-gray-300 h-2 rounded-full" style="width: 0%"></div>
                        </div>
                        <span class="text-xs text-gray-500 mt-1">Заблокировано</span>
                    </div>
                </div>

                <div data-aos="flip-left" data-aos-delay="300" class="achievement-card bg-white rounded-xl p-6 text-center hover:shadow-xl transition cursor-pointer opacity-50">
                    <div class="w-20 h-20 mx-auto mb-4 bg-gray-300 rounded-full flex items-center justify-center">
                        <i class="fas fa-trophy text-white text-3xl"></i>
                    </div>
                    <h1 class="font-bold mb-2">Легенда Саратова</h1>
                    <p class="text-sm text-gray-600">Получите все достижения</p>
                    <div class="mt-4">
                        <div class="bg-gray-200 rounded-full h-2">
                            <div class="bg-gray-300 h-2 rounded-full" style="width: 0%"></div>
                        </div>
                        <span class="text-xs text-gray-500 mt-1">Заблокировано</span>
                    </div>
                </div>
            </div>

            <div class="mt-12 text-center" data-aos="fade-up">
                <button onclick="showAllAchievements()" class="bg-white px-8 py-4 rounded-lg font-semibold shadow hover:shadow-lg transition">
                    Все достижения (30+) <i class="fas fa-arrow-right ml-2"></i>
                </button>
            </div>
        </div>
    </section>
</div>
