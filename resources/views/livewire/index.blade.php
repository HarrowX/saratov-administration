
@section('title')
    Саратов 435 - Цифровой дайвинг в историю города
@endsection
                
<div class="bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-white shadow-lg fixed w-full z-50 top-0">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <a href="#" class="flex items-center space-x-3">
                        <div class="w-10 h-10 rounded-lg overflow-hidden">
                            <img src="images/gerb-goroda-saratov.jpg" alt="Герб Саратова">
                        </div>
                        <span class="md:text-base lg:text-xl font-bold text-black">Саратов 435</span>
                    </a>
                </div>
                
                <div class="hidden md:flex items-center md:space-x-4 lg:space-x-6  transition md:text-xs lg:text-base">
                    <a href="#home" class="nav-link ">Главная</a>
                    <a href="#attractions" class="nav-link ">Места</a>
                    <a href="#ai-guide" class="nav-link">AI Гид</a>
                    <a href="#quests" class="nav-link">Квесты</a>
                    <a href="#gallery" class="nav-link">Галерея</a>
                    <a href="#business" class="nav-link">Бизнесу</a>
                    <button onclick="showAppDownload()" class="bg-linear-to-r from-green-500 to-teal-600 text-white px-4 py-2 rounded-lg hover:shadow-lg transition cursor-pointer">
                        <i class="fas fa-download mr-2"></i>Приложение
                    </button>
                </div>
                
                <div class="flex items-center space-x-8">
                    <button id="profileBtn" class="relative cursor-pointer">
                        <i class="fas fa-user-circle text-2xl text-gray-600"></i>
                        <span class="absolute -top-2 -right-3 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center achievement-count">0</span>
                    </button>
                    <button id="mobileMenuBtn" class="md:hidden cursor-pointer">
                        <i class="fas fa-bars text-2xl text-gray-600"></i>
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Mobile menu -->
        <div id="mobileMenu" class="hidden md:hidden bg-white border-t">
            <div class="px-4 py-3 space-y-3">
                <a href="#home" class="nav-link block">Главная</a>
                <a href="#attractions" class="nav-link block">Места</a>
                <a href="#ai-guide" class="nav-link block">AI Гид</a>
                <a href="#quests" class="nav-link block">Квесты</a>
                <a href="#gallery" class="nav-link block">Галерея</a>
                <a href="#business" class="nav-link block">Для бизнеса</a>
                <a href="#achievements" class="nav-link block">Достижения</a>
                <button onclick="showAppDownload()" class="w-full bg-linear-to-r from-green-500 to-teal-600 text-white px-4 py-2 rounded-lg hover:shadow-lg transition text-left cursor-pointer">
                    <i class="fas fa-download mr-2"></i>Скачать приложение
                </button>
            </div>
        </div>
    </nav>
    
    <!-- Hero Section with Slider -->
    <section id="home" class="hero-section pt-16 min-h-screen flex items-center relative">
        <div class="absolute inset-0 bg-linear-to-r from-blue-50 to-purple-50"></div>
        <div class="max-w-7xl mx-auto px-4 py-20 relative z-10">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div data-aos="fade-right">
                    <h1 class="text-5xl lg:text-6xl font-bold mb-6 text-center md:text-left">
                        <span class="bg-linear-to-r from-blue-500 to-purple-600 bg-clip-text text-transparent">435 лет</span><br>
                        истории Саратова
                    </h1>
                    <p class="text text-gray-600 text-justify md:text-left">
                        Откройте для себя уникальное культурное наследие города, где начинал свой путь Юрий Гагарин, творили великие артисты и писатели
                    </p>
                    <div class="flex flex-wrap gap-4 justify-center md:justify-start">
                        <button onclick="startJourney()" class="hero-section-button text-sm sm:text-base from-blue-500 to-purple-600">
                            <i class="fas fa-compass mr-2"></i>
                            Начать путешествие
                        </button>
                        <button onclick="showAppDownload()" class="hero-section-button text-sm sm:text-base from-green-500 to-teal-600">
                            <i class="fas fa-mobile-alt mr-2"></i>
                            Скачать приложение
                        </button>
                    </div>
                    
                    <!-- Stats -->
                    <div class="grid grid-cols-3 gap-6 mt-12">
                        <div class="stats-card text-center">
                            <div class="stats-card-number text-blue-500 counter">50</div>
                            <div class="stats-card-text">Мест</div>
                        </div>
                        <div class="text-center">
                            <div class="stats-card-number text-purple-500 counter">15</div>
                            <div class="stats-card-text">Маршрутов</div>
                        </div>
                        <div class="text-center">
                            <div class="stats-card-number text-green-500 counter">100</div>
                            <div class="stats-card-text">Партнеров</div>
                        </div>
                    </div>
                    
                </div>
                
                <!-- Image Slider -->
                <div data-aos="fade-left" class="relative">
                    <div class="relative rounded-2xl overflow-hidden shadow-2xl">
                        <div id="heroSlider" class="relative h-[500px]">
                            <!-- Slide 1 -->
                            <div class="slider-slide active absolute inset-0">
                                <img src="images/nabereznaya-kosmonavtov.jpeg" alt="Набережная Космонавтов">
                                <div class="absolute inset-0 bg-linear-to-t from-black/60 to-transparent"></div>
                                <div class="absolute bottom-15 lg:bottom-22 left-14 right-6 text-white">
                                    <div class="flex items-center space-x-2 mb-2">
                                        <i class="fas fa-map-marker-alt"></i>
                                        <span>Набережная Космонавтов</span>
                                    </div>
                                    <div class="text-2xl font-bold">Место приземления Гагарина</div>
                                </div>
                            </div>
                            
                            <!-- Slide 2 -->
                            <div class="slider-slide absolute inset-0">
                                <img src="images/konservatoria.jpeg" alt="Саратовская консерватория">
                                <div class="absolute inset-0 bg-linear-to-t from-black/60 to-transparent"></div>
                                <div class="absolute bottom-15 lg:bottom-22 left-14 right-6 text-white">
                                    <div class="flex items-center space-x-2 mb-2">
                                        <i class="fas fa-music"></i>
                                        <span>Консерватория им. Собинова</span>
                                    </div>
                                    <div class="text-2xl font-bold">Первая в провинции</div>
                                </div>
                            </div>
                            
                            <!-- Slide 3 -->
                            <div class="slider-slide absolute inset-0">
                                <img src="images/cirk.jpeg" alt="Саратовский цирк">
                                <div class="absolute inset-0 bg-linear-to-t from-black/60 to-transparent"></div>
                                <div class="absolute bottom-15 lg:bottom-22 left-14 right-6 text-white">
                                    <div class="flex items-center space-x-2 mb-2">
                                        <i class="fas fa-ticket-alt"></i>
                                        <span>Цирк братьев Никитиных</span>
                                    </div>
                                    <div class="text-2xl font-bold">Первый цирк России</div>
                                </div>
                            </div>
                            
                            <!-- Slide 4 -->
                            <div class="slider-slide absolute inset-0">
                                <img src="https://photocentra.ru/images/main19/192962_main.jpg" alt="Мост через Волгу">
                                <div class="absolute inset-0 bg-linear-to-t from-black/60 to-transparent"></div>
                                <div class="absolute bottom-15 lg:bottom-22 left-14 right-6 text-white">
                                    <div class="flex items-center space-x-2 mb-2">
                                        <i class="fas fa-bridge"></i>
                                        <span>Саратовский мост</span>
                                    </div>
                                    <div class="text-2xl font-bold">Символ города</div>
                                </div>
                            </div>
                            
                            <!-- Slide 5 -->
                            <div class="slider-slide absolute inset-0">
                                <img src="https://saratov.travel/upload/resize_cache/iblock/18c/8glui7vh5ldyyw0g7m2e4xcc3530vuzk/800_800_1/photo_2022-11-14_16-25-54.jpg" alt="Парк Победы">
                                <div class="absolute inset-0 bg-linear-to-t from-black/60 to-transparent"></div>
                                <div class="absolute bottom-15 lg:bottom-22 left-14 right-6 text-white">
                                    <div class="flex items-center space-x-2 mb-2">
                                        <i class="fas fa-monument"></i>
                                        <span>Парк Победы</span>
                                    </div>
                                    <div class="text-2xl font-bold">Музей под открытым небом</div>
                                </div>
                            </div>
                        </div>
                        <!-- Slider dots -->
                        <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 flex space-x-2">
                            <button onclick="goToSlide(0)" class="slider-dot active w-2 h-2 bg-white rounded-full"></button>
                            <button onclick="goToSlide(1)" class="slider-dot w-2 h-2 bg-white/50 rounded-full"></button>
                            <button onclick="goToSlide(2)" class="slider-dot w-2 h-2 bg-white/50 rounded-full"></button>
                            <button onclick="goToSlide(3)" class="slider-dot w-2 h-2 bg-white/50 rounded-full"></button>
                            <button onclick="goToSlide(4)" class="slider-dot w-2 h-2 bg-white/50 rounded-full"></button>
                        </div>
                        
                        <!-- Slider arrows -->
                        <button onclick="prevSlide()" class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-white/20 backdrop-blur text-white p-2 rounded-full hover:bg-white/30 transition cursor-pointer">
                            <i class="fas fa-chevron-left"></i>
                        </button>
                        <button onclick="nextSlide()" class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-white/20 backdrop-blur text-white p-2 rounded-full hover:bg-white/30 transition cursor-pointer">
                            <i class="fas fa-chevron-right"></i>
                        </button>
                    </div>
                    
                    <!-- Floating cards -->
                    <div class="absolute -top-4 -right-4 bg-white rounded-lg shadow-lg p-4 transform rotate-3 animate-pulse">
                        <i class="fas fa-star text-yellow-500"></i>
                        <span class="ml-2 font-semibold">ТОП-10 городов России</span>
                    </div>
                </div>
            </div>
        </div>
    </section>                       

    <!-- App Download Section -->
    <section id="app-download" class="py-10 md:py-20 overflow-hidden bg-linear-to-r from-blue-600 to-purple-600 text-white">
        <div class="max-w-7xl mx-auto px-4">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div data-aos="fade-right" class="flex flex-col items-center md:items-start">
                    <span class="bg-white/20 backdrop-blur text-white px-4 py-1 rounded-full text-sm font-semibold mb-4 inline-block">
                        <i class="fas fa-mobile-alt mr-2"></i>МОБИЛЬНОЕ ПРИЛОЖЕНИЕ
                    </span>
                    <h2 class="title-big text-center md:text-left">Саратов 435 всегда с вами</h2>
                    <p class="text text-white/90 text-center md:text-left">
                        Скачайте наше приложение и получите доступ ко всем функциям офлайн, 
                        AR-навигации, эксклюзивным скидкам и персональным маршрутам
                    </p>
                    
                    <div class="flex flex-col flex-wrap content-center md:content-start space-y-4 mb-8">
                        <div class="flex items-center space-x-3">
                            <div class="w-12 h-12 bg-white/20 backdrop-blur rounded-lg flex items-center justify-center">
                                <i class="fas fa-map-marked-alt text-white"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold">Офлайн карты</h4>
                                <p class="text-white/80 text-sm">Работает без интернета</p>
                            </div>
                        </div>
                        
                        <div class="flex items-center space-x-3">
                            <div class="w-12 h-12 bg-white/20 backdrop-blur rounded-lg flex items-center justify-center">
                                <i class="fas fa-vr-cardboard text-white"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold">AR режим</h4>
                                <p class="text-white/80 text-sm">Путешествие во времени</p>
                            </div>
                        </div>
                        
                        <div class="flex items-center space-x-3">
                            <div class="w-12 h-12 bg-white/20 backdrop-blur rounded-lg flex items-center justify-center">
                                <i class="fas fa-bell text-white"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold">Push-уведомления</h4>
                                <p class="text-white/80 text-sm">Не пропустите события</p>
                            </div>
                        </div>
                    </div>
                    
                </div>
                
                <div data-aos="fade-left" class="text-center">
                    <div class="bg-white rounded-2xl p-4 inline-block">
                        <h3 class="text-gray-900 font-bold text-xl mb-4">Сканируйте QR-код</h3>
                        <!-- QR Code image -->
                        <div class="w-64 h-64 rounded-lg overflow-hidden mb-4">
                            <img src="images/qrprila.jpg" alt="QR-код приложения">
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
            
            <!-- App Stats -->
            <div class="grid md:grid-cols-4 gap-6 mt-12 pt-12 border-t border-white/20">
                <div class="text-center">
                    <div class="text-3xl font-bold mb-2">2</div>
                    <div class="text-white/80">Скачивания</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl font-bold mb-2">4.9</div>
                    <div class="text-white/80">Рейтинг</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl font-bold mb-2">10+</div>
                    <div class="text-white/80">Отзывов</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl font-bold mb-2">24/7</div>
                    <div class="text-white/80">Поддержка</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features-section py-10 md:py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center mb-12" data-aos="fade-up">
                <h2 class="title-big">Что вас ждет в приложении</h2>
                <p class="text text-gray-600">Уникальные возможности для жителей и гостей города</p>
            </div>
            
            <div class="grid md:grid-cols-3 gap-3">
                <div data-aos="fade-up" data-aos-delay="100" class="bg-linear-to-br flex flex-col items-center from-blue-50 to-blue-100 rounded-xl p-8 hover:shadow-xl transition">
                    <div class="w-16 h-16 bg-blue-500 rounded-lg flex items-center justify-center mb-6">
                        <i class="fas fa-map-marked-alt text-white text-2xl"></i>
                    </div>
                    <h3 class="title-block">Интерактивная карта</h3>
                    <p class="text-gray-600 text-center mb-4">Все достопримечательности города на одной карте с подробной информацией и фотографиями</p>
                    <ul class="space-y-2 text-gray-600">
                        <li><i class="fas fa-check text-green-500 mr-2"></i>AR-навигация</li>
                        <li><i class="fas fa-check text-green-500 mr-2"></i>Аудиогиды</li>
                        <li><i class="fas fa-check text-green-500 mr-2"></i>3D модели</li>
                    </ul>
                </div>
                
                <div data-aos="fade-up" data-aos-delay="200" class="bg-linear-to-br flex flex-col items-center from-purple-50 to-purple-100 rounded-xl p-8 hover:shadow-xl transition">
                    <div class="w-16 h-16 bg-purple-500 rounded-lg flex items-center justify-center mb-6">
                        <i class="fas fa-trophy text-white text-2xl"></i>
                    </div>
                    <h3 class="title-block">Геймификация</h3>
                    <p class="text-gray-600 text-center mb-4">Зарабатывайте достижения, открывайте новые маршруты и получайте бонусы</p>
                    <ul class="space-y-2 text-gray-600">
                        <li><i class="fas fa-check text-green-500 mr-2"></i>30+ достижений</li>
                        <li><i class="fas fa-check text-green-500 mr-2"></i>Рейтинг путешественников</li>
                        <li><i class="fas fa-check text-green-500 mr-2"></i>Еженедельные квесты</li>
                    </ul>
                </div>
                
                <div data-aos="fade-up" data-aos-delay="300" class="bg-linear-to-br flex flex-col items-center from-green-50 to-green-100 rounded-xl p-8 hover:shadow-xl transition">
                    <div class="w-16 h-16 bg-green-500 rounded-lg flex items-center justify-center mb-6">
                        <i class="fas fa-percentage text-white text-2xl"></i>
                    </div>
                    <h3 class="title-block">Скидки и купоны</h3>
                    <p class="text-gray-600 text-center mb-4">Эксклюзивные предложения от партнеров для пользователей приложения</p>
                    <ul class="space-y-2 text-gray-600">
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
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center mb-12" data-aos="fade-up">
                <h2 class="title-big ">Главные достопримечательности</h2>
                <p class="text text-gray-600">Откройте для себя уникальные места Саратова</p>
            </div>
            
            <!-- Attractions Carousel -->
            <div id="attractions-carousel" class="mb-12">
                <div class="relative">
                    <div class="flex overflow-x-auto space-x-6 pb-4 scrollbar-hide" id="attractions-scroll">
                        @foreach ($places as $place)
                            <div class="min-w-[350px] bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 cursor-pointer group">
                                <div class="relative h-48 overflow-hidden">
                                    <img src="{{ $place->image }}" alt="{{ $place->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                    <div class="absolute inset-0 bg-linear-to-t from-black/60 via-transparent to-transparent"></div>
                                    <div class="absolute top-4 right-4 bg-white/90 backdrop-blur px-3 py-1 rounded-full">
                                        <span class="text-sm font-semibold">⭐ {{ $place->rating }}</span>
                                    </div>
                                    <div class="absolute bottom-4 left-4 text-white">
                                        <span class="bg-blue-500/80 backdrop-blur px-3 py-1 rounded-full text-xs">
                                            {{ $place->category }}
                                        </span>
                                    </div>
                                </div>
                                <div class="p-6">
                                    <h3 class="text-xl font-bold mb-2">{{ $place->title }}</h3>
                                    <p class="text-gray-600 text-sm mb-4 line-clamp-2">{{ $place->description }}</p>
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center text-gray-500 text-sm">
                                            <i class="fas fa-clock mr-2"></i>
                                            <span>{{ $place->time }}</span>
                                        </div>
                                        <button onclick="showAttractionDetails({{ $place->id }})" class="w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold text-sm py-2 px-4 rounded-lg transition">
                                            Подробнее →
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <button onclick="scrollAttractions('left')" class="scroll-button left-0 -translate-x-4">
                            <i class="fas fa-chevron-left"></i>
                        </button>
                        <button onclick="scrollAttractions('right')" class="scroll-button right-0 translate-x-4">
                            <i class="fas fa-chevron-right"></i>
                        </button>
                    </div>
                </div>
            </div>
            
            <div class="grid md:grid-cols-2 gap-8 mb-12">
                <div data-aos="fade-right" class="bg-white rounded-xl shadow-lg overflow-hidden group hover:shadow-2xl transition">
                    <div class="relative h-64 overflow-hidden">
                        <img src="images/konservatoria.jpeg" alt="Саратовская консерватория" class="group-hover:scale-110 transition duration-500">
                        <div class="absolute top-4 right-4 bg-white/90 backdrop-blur px-3 py-1 rounded-full">
                            <i class="fas fa-star text-yellow-500"></i>
                            <span class="font-semibold">4.9</span>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-2xl font-bold mb-3">Саратовская консерватория</h3>
                        <p class="text-gray-600 mb-4">Первая консерватория в российской провинции, основана в 1912 году. Уникальная архитектура и богатая история.</p>
                        <div class="space-y-3">
                            <div class="flex items-center space-x-4 text-sm text-gray-500">
                                <span><i class="fas fa-walking mr-1"></i>15 мин</span>
                                <span><i class="fas fa-camera mr-1"></i>Фотозона</span>
                            </div>
                            <button onclick="showAttractionDetails(1)" class="w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg transition cursor-pointer">
                                Подробнее <i class="fas fa-arrow-right ml-1"></i>
                            </button>
                        </div>
                    </div>
                </div>
                
                <div data-aos="fade-left" class="bg-white rounded-xl shadow-lg overflow-hidden group hover:shadow-2xl transition">
                    <div class="relative h-64 overflow-hidden">
                        <img src="images/nabereznaya-kosmonavtov.jpeg" alt="Набережная Космонавтов" class="group-hover:scale-110 transition duration-500">
                        <div class="absolute top-4 right-4 bg-white/90 backdrop-blur px-3 py-1 rounded-full">
                            <i class="fas fa-star text-yellow-500"></i>
                            <span class="font-semibold">4.8</span>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-2xl font-bold mb-3">Набережная Космонавтов</h3>
                        <p class="text-gray-600 mb-4">Любимое место отдыха горожан с видом на Волгу. Здесь приземлился Юрий Гагарин после первого полета.</p>
                        <div class="space-y-3">
                            <div class="flex items-center space-x-4 text-sm text-gray-500">
                                <span><i class="fas fa-walking mr-1"></i>30 мин</span>
                                <span><i class="fas fa-utensils mr-1"></i>Кафе</span>
                            </div>
                            <button onclick="showAttractionDetails(2)" class="w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg transition cursor-pointer">
                                Подробнее <i class="fas fa-arrow-right ml-1"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Map Container -->
            <div data-aos="fade-up" class="bg-white rounded-xl shadow-lg p-6">
                <div class="flex flex-col sm:flex-row gap-4 lg:flex-row items-center justify-between mb-4">
                    <h3 class="title">Интерактивная карта</h3>
                    <div class="flex space-x-2">
                        <button onclick="forceInitMap()" class="map-button bg-purple-100 text-purple-600 hover:bg-purple-200">
                            <i class="fas fa-sync mr-2"></i>Загрузить карту
                        </button>
                        <button onclick="document.querySelector('.map-filter[data-category=all]').click()" class="map-button bg-blue-100 text-blue-600 hover:bg-blue-200">
                            <i class="fas fa-filter mr-2"></i>Фильтры
                        </button>
                        <button onclick="showRoute(1)" class="map-button bg-green-100 text-green-600 hover:bg-green-200">
                            <i class="fas fa-route mr-2"></i>Маршруты
                        </button>
                    </div>
                </div>
                <div id="map" class="h-[500px] rounded-lg"></div>
            </div>
        </div>
    </section>

    <!-- Business Section -->
    <section id="business" class="py-10 md:py-20 bg-white overflow-hidden">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center mb-12" data-aos="fade-up">
                <h2 class="title-big">Для бизнеса</h2>
                <p class="text text-gray-600">Привлекайте новых клиентов через наше приложение</p>
            </div>
            
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div data-aos="fade-right" class="flex flex-col items-center md:items-start">
                    <h3 class="title3xl mb-6">Увеличьте поток клиентов</h3>
                    <p class="text text-gray-600 text-center md:text-left">
                        Присоединяйтесь к программе лояльности и предлагайте эксклюзивные скидки пользователям приложения
                    </p>
                    
                    <div class="space-y-4 mb-8">
                        <div class="flex items-start space-x-4">
                            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center shrink-0">
                                <i class="fas fa-users text-blue-500"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold mb-1">10,000+ активных пользователей</h4>
                                <p class="text-gray-600">Ваши предложения увидят тысячи потенциальных клиентов</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start space-x-4">
                            <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center shrink-0">
                                <i class="fas fa-chart-line text-green-500"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold mb-1">Аналитика и статистика</h4>
                                <p class="text-gray-600">Отслеживайте эффективность ваших предложений</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start space-x-4">
                            <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center shrink-0">
                                <i class="fas fa-bullhorn text-purple-500"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold mb-1">Промо-кампании</h4>
                                <p class="text-gray-600">Запускайте акции и специальные предложения</p>
                            </div>
                        </div>
                    </div>
                    
                    <button onclick="showBusinessRegistration()" class="hero-section-button from-blue-500 to-purple-600">
                        <i class="fas fa-handshake mr-2"></i>
                        Стать партнером
                    </button>
                </div>
                
                <div data-aos="fade-left">
                    <div class="bg-linear-to-br from-blue-50 to-purple-50 rounded-2xl p-8">
                        <h4 class="text-2xl font-bold mb-6">Активные предложения</h4>
                        
                        <div class="space-y-4">
                            <div onclick="showOfferDetails(1)" class="bg-white rounded-lg p-4 shadow hover:shadow-lg transition cursor-pointer transform hover:-translate-y-1">
                                <div class="flex items-center justify-between mb-2">
                                    <span class="bg-red-100 text-red-600 px-3 py-1 rounded-full text-sm font-semibold">-20%</span>
                                    <span class="text-gray-500 text-sm">До 31 декабря</span>
                                </div>
                                <h5 class="font-semibold mb-1">Ресторан "Волга"</h5>
                                <p class="text-gray-600 text-sm mb-2">Скидка на все меню по промокоду SARATOV435</p>
                                <button class="text-blue-500 text-sm font-semibold hover:text-blue-600">Получить скидку →</button>
                            </div>
                            
                            <div onclick="showOfferDetails(2)" class="bg-white rounded-lg p-4 shadow hover:shadow-lg transition cursor-pointer transform hover:-translate-y-1">
                                <div class="flex items-center justify-between mb-2">
                                    <span class="bg-green-100 text-green-600 px-3 py-1 rounded-full text-sm font-semibold">2+1</span>
                                    <span class="text-gray-500 text-sm">Постоянно</span>
                                </div>
                                <h5 class="font-semibold mb-1">Кофейня "Гагарин"</h5>
                                <p class="text-gray-600 text-sm mb-2">Третий кофе в подарок для пользователей приложения</p>
                                <button class="text-blue-500 text-sm font-semibold hover:text-blue-600">Получить бонус →</button>
                            </div>
                            
                            <div onclick="showOfferDetails(3)" class="bg-white rounded-lg p-4 shadow hover:shadow-lg transition cursor-pointer transform hover:-translate-y-1">
                                <div class="flex items-center justify-between mb-2">
                                    <span class="bg-purple-100 text-purple-600 px-3 py-1 rounded-full text-sm font-semibold">-30%</span>
                                    <span class="text-gray-500 text-sm">По выходным</span>
                                </div>
                                <h5 class="font-semibold mb-1">Музей краеведения</h5>
                                <p class="text-gray-600 text-sm mb-2">Скидка на семейные билеты</p>
                                <button class="text-blue-500 text-sm font-semibold hover:text-blue-600">Активировать →</button>
                            </div>
                        </div>
                        
                        <div class="mt-6 text-center">
                            <button onclick="showAllOffers()" class="text-blue-500 font-semibold hover:text-blue-600">
                                Все предложения <i class="fas fa-arrow-right ml-1"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- AR Experience Section (New!) -->
    <section id="ar-experience" class="py-10 md:py-20 bg-linear-to-br from-purple-50 to-blue-50 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center mb-12" data-aos="fade-up">
                <span class="bg-linear-to-r from-purple-600 to-blue-600 text-white px-4 py-1 rounded-full text-sm font-semibold mb-4 inline-block">
                    <i class="fas fa-magic mr-2"></i>НОВАЯ ФУНКЦИЯ
                </span>
                <h2 class="title-big">Путешествие во времени с AR</h2>
                <p class="text text-gray-600">Увидьте, как выглядел Саратов 100 лет назад через камеру телефона</p>
            </div>
            
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div data-aos="fade-right">
                    <div class="relative">
                        <img src="https://photocentra.ru/images/main19/192962_main.jpg" alt="Саратовский мост" class="rounded-2xl shadow-2xl">
                        <div class="absolute inset-0 bg-linear-to-t from-black/50 to-transparent rounded-2xl"></div>
                        <div class="absolute bottom-6 left-6 text-white">
                            <div class="bg-white/20 backdrop-blur-sm rounded-lg p-4">
                                <h4 class="font-bold md:text-base lg:text-lg mb-2">AR режим доступен</h4>
                                <p class="text-sm">Наведите камеру на QR-код рядом с достопримечательностью</p>
                            </div>
                        </div>
                        <!-- Floating AR elements -->
                        <div class="absolute -top-4 -right-4 bg-linear-to-r from-purple-500 to-blue-500 text-white rounded-full p-4 animate-bounce">
                            <i class="fas fa-vr-cardboard text-2xl"></i>
                        </div>
                    </div>
                </div>
                
                <div data-aos="fade-left" class="flex flex-col">
                    <h3 class="text-3xl font-bold mb-6">Оживите историю города</h3>
                    <div class="space-y-4 mb-8">
                        <div class="flex items-start space-x-4">
                            <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center shrink-0">
                                <i class="fas fa-history text-purple-600"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold mb-1">Исторические реконструкции</h4>
                                <p class="text-gray-600">Увидьте здания и улицы в их первоначальном виде</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start space-x-4">
                            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center shrink-0">
                                <i class="fas fa-user-astronaut text-blue-600"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold mb-1">Встреча с Гагариным</h4>
                                <p class="text-gray-600">AR-персонаж расскажет о своем приземлении в Саратове</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start space-x-4">
                            <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center shrink-0">
                                <i class="fas fa-theater-masks text-green-600"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold mb-1">Виртуальные экскурсоводы</h4>
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
    <section id="ai-guide" class="py-10 md:py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center mb-12" data-aos="fade-up">
                <span class="bg-linear-to-r from-green-600 to-teal-600 text-white px-4 py-1 rounded-full text-sm font-semibold mb-4 inline-block">
                    <i class="fas fa-robot mr-2"></i>AI АССИСТЕНТ
                </span>
                <h2 class="title-big">Ваш персональный гид Сара</h2>
                <p class="text text-gray-600 content-center">Интерактивный помощник, который подберет идеальный маршрут именно для вас</p>
            </div>
            
            <div class="max-w-4xl mx-auto">
                <div class="bg-linear-to-br from-green-50 to-teal-50 rounded-2xl p-4 md:p-8" data-aos="zoom-in">
                    <!-- Chat interface -->
                    <div class="bg-white rounded-xl shadow-inner h-[500px] overflow-y-auto p-2 md:p-6 mb-6" id="chatContainer">
                        <!-- <div class="space-y-4" id="chat-messages">
                            <div class="flex justify-start mb-4">
                                <div class="flex items-start space-x-2">
                                    <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center">
                                        <i class="fas fa-robot text-white text-sm"></i>
                                    </div>
                                    <div class="bg-gray-100 rounded-lg px-4 py-2 max-w-xs">
                                        <p class="font-semibold text-sm mb-1">Сара</p>
                                        <p class="text-gray-700">Добрый вечер! 👋 Я Сара - ваш виртуальный гид по Саратову. Я помогу вам спланировать идеальный день в нашем городе. Готовы начать?</p>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                        <div class="space-y-4" id="chat-messages">
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
    <section id="gallery" class="py-10 md:py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center mb-12" data-aos="fade-up">
                <span class="bg-linear-to-r from-pink-600 to-red-600 text-white px-4 py-1 rounded-full text-sm font-semibold mb-4 inline-block">
                    <i class="fas fa-camera mr-2"></i>ФОТОГАЛЕРЕЯ
                </span>
                <h2 class="title-big">Саратов в объективе</h2>
                <p class="text text-gray-600">Лучшие фотографии достопримечательностей и видов города</p>
            </div>
            
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <!-- Row 1 -->
                <div data-aos="zoom-in" class="col-span-2 row-span-2 relative group overflow-hidden rounded-lg">
                    <img src="images/nabereznaya-kosmonavtov.jpeg" alt="Набережная Космонавтов" class="group-hover:scale-110 transition duration-500">
                    <div class="absolute inset-0 bg-linear-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition">
                        <div class="absolute bottom-4 left-4 text-white">
                            <h3 class="font-bold text-lg">Набережная Космонавтов</h3>
                            <p class="text-sm">Любимое место отдыха горожан</p>
                        </div>
                    </div>
                </div>
                
                <div data-aos="zoom-in" data-aos-delay="100" class="relative group overflow-hidden rounded-lg">
                    <img src="images/konservatoria.jpeg" alt="Консерватория" class="group-hover:scale-110 transition duration-500">
                    <div class="absolute inset-0 bg-linear-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition">
                        <div class="absolute bottom-4 left-4 text-white">
                            <p class="font-bold">Консерватория</p>
                        </div>
                    </div>
                </div>
                
                <div data-aos="zoom-in" data-aos-delay="150" class="relative group overflow-hidden rounded-lg">
                    <img src="images/cirk.jpeg" alt="Цирк" class="group-hover:scale-110 transition duration-500">
                    <div class="absolute inset-0 bg-linear-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition">
                        <div class="absolute bottom-4 left-4 text-white">
                            <p class="font-bold">Первый цирк России</p>
                        </div>
                    </div>
                </div>
                
                <!-- Row 2 -->
                <div data-aos="zoom-in" data-aos-delay="200" class="relative group overflow-hidden rounded-lg">
                    <img src="https://saratov.travel/upload/resize_cache/iblock/18c/8glui7vh5ldyyw0g7m2e4xcc3530vuzk/800_800_1/photo_2022-11-14_16-25-54.jpg" alt="Парк Победы" class="group-hover:scale-110 transition duration-500">
                    <div class="absolute inset-0 bg-linear-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition">
                        <div class="absolute bottom-4 left-4 text-white">
                            <p class="font-bold">Парк Победы</p>
                        </div>
                    </div>
                </div>
                
                <div data-aos="zoom-in" data-aos-delay="250" class="relative group overflow-hidden rounded-lg">
                    <img src="images/dd9a72bae8da46a9d6df6ff58fcb4292.jpg" alt="Мост через Волгу" class="group-hover:scale-110 transition duration-500">
                    <div class="absolute inset-0 bg-linear-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition">
                        <div class="absolute bottom-4 left-4 text-white">
                            <p class="font-bold">Саратовский мост</p>
                        </div>
                    </div>
                </div>
                
                <div data-aos="zoom-in" data-aos-delay="300" class="col-span-2 relative group overflow-hidden rounded-lg">
                    <img src="https://wikiway.com/upload/uf/848/hmlfo7s6od07w3nm5wyj1mxwu15hz95h/Saratov-3.jpg" alt="Набережная вечером" class="group-hover:scale-110 transition duration-500">
                    <div class="absolute inset-0 bg-lineart-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition">
                        <div class="absolute bottom-4 left-4 text-white">
                            <h3 class="font-bold text-lg">Вечерний Саратов</h3>
                            <p class="text-sm">Романтические виды на Волгу</p>
                        </div>
                    </div>
                </div>
                
                <!-- Row 3 -->
                <div data-aos="zoom-in" data-aos-delay="350" class="col-span-2 relative group overflow-hidden rounded-lg">
                    <img src="https://fs.tonkosti.ru/at/o5/ato58r5xh7sog4k40swwg0ksw.jpg" alt="Консерватория фасад" class="group-hover:scale-110 transition duration-500">
                    <div class="absolute inset-0 bg-linear-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition">
                        <div class="absolute bottom-4 left-4 text-white">
                            <h3 class="font-bold text-lg">Архитектурное наследие</h3>
                            <p class="text-sm">Памятники архитектуры XIX-XX веков</p>
                        </div>
                    </div>
                </div>
                
                <div data-aos="zoom-in" data-aos-delay="400" class="relative group overflow-hidden rounded-lg">
                    <img src="https://fs.tonkosti.ru/6w/hi/6whi7saljzocs40kwoo8okksg.jpg" alt="Волга" class="group-hover:scale-110 transition duration-500">
                    <div class="absolute inset-0 bg-linear-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition">
                        <div class="absolute bottom-4 left-4 text-white">
                            <p class="font-bold">Великая Волга</p>
                        </div>
                    </div>
                </div>
                
                <div data-aos="zoom-in" data-aos-delay="450" class="relative group overflow-hidden rounded-lg">
                    <img src="https://fs.tonkosti.ru/30/ls/30lsy6fot9s0o04g4wow8wkgc.jpg" alt="Набережная летом" class="group-hover:scale-110 transition duration-500">
                    <div class="absolute inset-0 bg-linear-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition">
                        <div class="absolute bottom-4 left-4 text-white">
                            <p class="font-bold">Летний Саратов</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- View more button -->
            <div class="text-center mt-12">
                <button onclick="showAllPhotos()" 
                        class="bg-linear-to-r from-pink-500 to-red-500 text-white px-8 py-4 rounded-lg font-semibold hover:shadow-lg transition transform hover:-translate-y-1">
                    <i class="fas fa-images mr-2"></i>
                    Смотреть все фотографии
                </button>
            </div>
        </div>
    </section>

    <!-- City Quests Section (New!) -->
    <section id="quests" class="py-10 md:py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center mb-12" data-aos="fade-up">
                <span class="bg-linear-to-r from-red-600 to-orange-600 text-white px-4 py-1 rounded-full text-sm font-semibold mb-4 inline-block">
                    <i class="fas fa-treasure-chest mr-2"></i>ГОРОДСКИЕ КВЕСТЫ
                </span>
                <h2 class="title-big">Квесты с реальными призами</h2>
                <p class="text text-gray-600">Исследуйте город играючи и получайте награды от партнеров</p>
            </div>
            
            <div class="grid md:grid-cols-3 gap-6">
                <!-- Active Quest 1 -->
                <div data-aos="fade-up" class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transition">
                    <div class="relative h-48">
                        <img src="https://saratov.travel/upload/resize_cache/iblock/18c/8glui7vh5ldyyw0g7m2e4xcc3530vuzk/800_800_1/photo_2022-11-14_16-25-54.jpg" 
                             alt="Квест Тайны старого города">
                        <div class="absolute top-4 left-4 bg-red-500 text-white px-3 py-1 rounded-full text-sm font-semibold">
                            <i class="fas fa-fire mr-1"></i>Активен
                        </div>
                        <div class="absolute bottom-4 right-4 bg-white/90 backdrop-blur px-3 py-1 rounded-full">
                            <i class="fas fa-users text-gray-700 mr-1"></i>
                            <span class="font-semibold">234 участника</span>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-2">Тайны старого города</h3>
                        <p class="text-gray-600 mb-4">Разгадайте исторические загадки и найдите спрятанные QR-коды</p>
                        
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center space-x-3 text-sm">
                                <span class="text-gray-500"><i class="fas fa-map-marked-alt mr-1"></i>7 точек</span>
                                <span class="text-gray-500"><i class="fas fa-clock mr-1"></i>2 часа</span>
                            </div>
                        </div>
                        
                        <div class="bg-yellow-50 rounded-lg p-3 mb-4">
                            <p class="text-sm font-semibold text-yellow-800">🎁 Приз: Ужин на двоих в ресторане "Волга"</p>
                        </div>
                        
                        <button onclick="startQuest('old-city')" class="w-full bg-linear-to-r from-red-500 to-orange-500 text-white px-4 py-2 rounded-lg hover:shadow-lg transition">
                            Начать квест
                        </button>
                    </div>
                </div>
                
                <!-- Active Quest 2 -->
                <div data-aos="fade-up" data-aos-delay="100" class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transition">
                    <div class="relative h-48">
                        <img src="images/cirk.jpeg" 
                             alt="Квест По следам Никитиных">
                        <div class="absolute top-4 left-4 bg-blue-500 text-white px-3 py-1 rounded-full text-sm font-semibold">
                            <i class="fas fa-child mr-1"></i>Семейный
                        </div>
                        <div class="absolute bottom-4 right-4 bg-white/90 backdrop-blur px-3 py-1 rounded-full">
                            <i class="fas fa-star text-yellow-500 mr-1"></i>
                            <span class="font-semibold">4.9</span>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-2">По следам братьев Никитиных</h3>
                        <p class="text-gray-600 mb-4">Семейное приключение по истории первого русского цирка</p>
                        
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center space-x-3 text-sm">
                                <span class="text-gray-500"><i class="fas fa-map-marked-alt mr-1"></i>5 точек</span>
                                <span class="text-gray-500"><i class="fas fa-clock mr-1"></i>1.5 часа</span>
                            </div>
                        </div>
                        
                        <div class="bg-blue-50 rounded-lg p-3 mb-4">
                            <p class="text-sm font-semibold text-blue-800">🎁 Приз: Билеты в цирк для всей семьи</p>
                        </div>
                        
                        <button onclick="startQuest('circus')" class="w-full bg-linear-to-r from-blue-500 to-purple-500 text-white px-4 py-2 rounded-lg hover:shadow-lg transition">
                            Начать квест
                        </button>
                    </div>
                </div>
                
                <!-- Active Quest 3 -->
                <div data-aos="fade-up" data-aos-delay="200" class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transition">
                    <div class="relative h-48">
                        <img src="https://photocentra.ru/images/main19/192962_main.jpg" 
                             alt="Квест Космическая одиссея">
                        <div class="absolute top-4 left-4 bg-purple-500 text-white px-3 py-1 rounded-full text-sm font-semibold">
                            <i class="fas fa-rocket mr-1"></i>Космос
                        </div>
                        <div class="absolute bottom-4 right-4 bg-white/90 backdrop-blur px-3 py-1 rounded-full">
                            <i class="fas fa-trophy text-gold-500 mr-1"></i>
                            <span class="font-semibold">Главный приз</span>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-2">Космическая одиссея Гагарина</h3>
                        <p class="text-gray-600 mb-4">Пройдите путь первого космонавта в Саратове</p>
                        
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center space-x-3 text-sm">
                                <span class="text-gray-500"><i class="fas fa-map-marked-alt mr-1"></i>10 точек</span>
                                <span class="text-gray-500"><i class="fas fa-clock mr-1"></i>3 часа</span>
                            </div>
                        </div>
                        
                        <div class="bg-purple-50 rounded-lg p-3 mb-4">
                            <p class="text-sm font-semibold text-purple-800">🎁 Приз: Полет на воздушном шаре над Волгой</p>
                        </div>
                        
                        <button onclick="startQuest('space')" class="w-full bg-linear-to-r from-purple-500 to-pink-500 text-white px-4 py-2 rounded-lg hover:shadow-lg transition">
                            Начать квест
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Quest Leaderboard -->
            <div class="mt-12 bg-white rounded-2xl p-8" data-aos="fade-up">
                <h3 class="text-2xl font-bold mb-6 text-center">🏆 Лидеры недели</h3>
                <div class="grid md:grid-cols-3 gap-4">
                    <div class="flex items-center space-x-4 bg-linear-to-r from-yellow-50 to-yellow-100 p-4 rounded-lg cursor-pointer hover:shadow-lg transition" onclick="showProfile('alexander')">
                        <div class="text-3xl font-bold text-yellow-600">1</div>
                        <div class="w-12 h-12 rounded-full overflow-hidden bg-linear-to-r from-blue-400 to-purple-500 flex items-center justify-center">
                            <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=100&h=100&fit=crop&crop=face" alt="Александр М.">
                        </div>
                        <div class="flex-1">
                            <p class="font-semibold">Александр М.</p>
                            <p class="text-sm text-gray-600">15 квестов • 3,450 баллов</p>
                        </div>
                        <i class="fas fa-medal text-yellow-500 text-2xl"></i>
                    </div>
                    <div class="flex items-center space-x-4 bg-linear-to-r from-gray-50 to-gray-100 p-4 rounded-lg cursor-pointer hover:shadow-lg transition" onclick="showProfile('maria')">
                        <div class="text-3xl font-bold text-gray-600">2</div>
                        <div class="w-12 h-12 rounded-full overflow-hidden bg-linear-to-r from-pink-400 to-red-500 flex items-center justify-center">
                            <img src="https://fs.tonkosti.ru/30/ls/30lsy6fot9s0o04g4wow8wkgc.jpg" alt="Мария К.">
                        </div>
                        <div class="flex-1">
                            <p class="font-semibold">Мария К.</p>
                            <p class="text-sm text-gray-600">12 квестов • 2,890 баллов</p>
                        </div>
                        <i class="fas fa-medal text-gray-400 text-2xl"></i>
                    </div>
                    <div class="flex items-center space-x-4 bg-linear-to-r from-orange-50 to-orange-100 p-4 rounded-lg cursor-pointer hover:shadow-lg transition" onclick="showProfile('ivanov')">
                        <div class="text-3xl font-bold text-orange-600">3</div>
                        <div class="w-12 h-12 rounded-full overflow-hidden bg-linear-to-r from-green-400 to-teal-500 flex items-center justify-center">
                            <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=100&h=100&fit=crop&crop=face" alt="Семья Ивановых">
                        </div>
                        <div class="flex-1">
                            <p class="font-semibold">Семья Ивановых</p>
                            <p class="text-sm text-gray-600">10 квестов • 2,340 баллов</p>
                        </div>
                        <i class="fas fa-medal text-orange-400 text-2xl"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Achievements Section -->
    <section id="achievements" class="py-10 md:py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center mb-12" data-aos="fade-up">
                <h2 class="title-big">Система достижений</h2>
                <p class="text text-gray-600">Исследуйте город и получайте награды</p>
            </div>
            
            <div class="grid md:grid-cols-4 gap-6">
                <div data-aos="flip-left" class="achievement-card bg-white rounded-xl p-6 text-center hover:shadow-xl transition cursor-pointer">
                    <div class="w-20 h-20 mx-auto mb-4 bg-linear-to-br from-yellow-400 to-yellow-600 rounded-full flex items-center justify-center">
                        <i class="fas fa-star text-white text-3xl"></i>
                    </div>
                    <h4 class="font-bold mb-2">Первооткрыватель</h4>
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
                    <h4 class="font-bold mb-2">Исследователь</h4>
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
                    <h4 class="font-bold mb-2">Знаток города</h4>
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
                    <h4 class="font-bold mb-2">Легенда Саратова</h4>
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

    <!-- Profile Modal -->
    <div id="profileModal" class="fixed inset-0 bg-black/50 z-50 hidden">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-2xl max-w-md w-full p-6 relative">
                <button onclick="closeProfileModal()" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times text-xl"></i>
                </button>
                
                <div class="text-center mb-6">
                    <div class="w-24 h-24 bg-linear-to-br from-blue-400 to-purple-600 rounded-full mx-auto mb-4 flex items-center justify-center">
                        <i class="fas fa-user text-white text-4xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold mb-2">Мой профиль</h3>
                    <p class="text-gray-600">Уровень: Начинающий исследователь</p>
                </div>
                
                <div class="space-y-4">
                    <div class="bg-gray-50 rounded-lg p-4">
                        <div class="flex justify-between items-center mb-2">
                            <span class="font-semibold">Достижения</span>
                            <span class="text-blue-500">1/30</span>
                        </div>
                        <div class="bg-gray-200 rounded-full h-2">
                            <div class="bg-blue-500 h-2 rounded-full" style="width: 3.33%"></div>
                        </div>
                    </div>
                    
                    <div class="bg-gray-50 rounded-lg p-4">
                        <div class="flex justify-between items-center mb-2">
                            <span class="font-semibold">Места посещены</span>
                            <span class="text-green-500">5/50</span>
                        </div>
                        <div class="bg-gray-200 rounded-full h-2">
                            <div class="bg-green-500 h-2 rounded-full" style="width: 10%"></div>
                        </div>
                    </div>
                    
                    <div class="bg-gray-50 rounded-lg p-4">
                        <div class="flex justify-between items-center">
                            <span class="font-semibold">Бонусные баллы</span>
                            <span class="text-purple-500 text-xl font-bold">150</span>
                        </div>
                    </div>
                </div>
                
                <div class="mt-6 grid grid-cols-2 gap-4">
                    <button class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition">
                        <i class="fas fa-gift mr-2"></i>Мои купоны
                    </button>
                    <button class="bg-purple-500 text-white px-4 py-2 rounded-lg hover:bg-purple-600 transition">
                        <i class="fas fa-history mr-2"></i>История
                    </button>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Footer -->
    <footer class="bg-linear-to-br from-gray-900 to-gray-800 text-white py-4">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex flex-col lg:flex-row justify-between items-center gap-4">
                <div class="flex items-center space-x-3">
                    <div class="w-8 h-8 rounded-lg overflow-hidden">
                        <img src="images/gerb-goroda-saratov.jpg" alt="Герб Саратова">
                    </div>
                    <span class="text-lg font-bold">Саратов 435</span>
                </div>
                
                <div class="flex flex-col gap-4 lg:flex-row items-center space-x-6 text-sm text-gray-400">
                    <a href="#attractions" class="hover:text-white transition">Достопримечательности</a>
                    <a href="#ai-guide" class="hover:text-white transition">AI Гид</a>
                    <a href="#gallery" class="hover:text-white transition">Галерея</a>
                    <a href="#business" class="hover:text-white transition">Бизнесу</a>
                    <a href="#app-download" class="hover:text-white transition">Приложение</a>
                </div>
                
                <div class="flex items-center space-x-3">
                    <a href="#" onclick="showAppDownload()" class="flex items-center space-x-2 bg-gray-800 hover:bg-gray-700 px-3 py-2 rounded-lg transition">
                        <i class="fab fa-google-play text-green-400"></i>
                        <span class="text-sm">Android</span>
                    </a>
                    <a href="#" onclick="showAppDownload()" class="flex items-center space-x-2 bg-gray-800 hover:bg-gray-700 px-3 py-2 rounded-lg transition">
                        <i class="fab fa-apple text-gray-300"></i>
                        <span class="text-sm">iOS</span>
                    </a>
                </div>
            </div>
            
            <div class="border-t border-gray-800 mt-4 pt-4 text-center text-gray-400 text-sm">
                <p>&copy; 2025 Саратов 435. Все права защищены.</p>
            </div>
        </div>
    </footer>
</div>