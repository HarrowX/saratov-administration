@php use App\Models\Attraction; @endphp

@section('title')
    Саратов - Цифровой дайвинг в историю города
@endsection
<script>
    window.mapData = {
        attractions: @js($attractions),
        hotels: @js($hotels),
        restaurants: @js($restaurants),
    };
</script>
<div class="bg-gray-50">
   <section id="home" class="hero-section flex flex-col items-center justify-around relative bg-[url('/images/bg-image.webp')] bg-center bg-no-repeat bg-cover " style="min-height: calc(100dvh - 80px); margin-top: 80px;" xl:style="min-height: calc(100dvh - 96px); margin-top: 96px;">
        <div class="max-w-6xl 3xl:max-w-7xl mx-auto flex flex-col h-full w-full px-1 xs:px-4 sm:px-10">

            <div class="flex flex-col items-center md:items-end justify-center flex-1 gap-10 3xl:gap-15 pt-15 pb-7 lg:pb-10 3xl:pb-15">
                <h1 class="hero-title text-5xl text-center md:text-right sm:text-7xl md:text-8xl 3xl:text-9xl text-white leading-none tracking-[5px] max-w-full md:max-w-xl 3xl:max-w-2xl">
                    Саратов на волне времени!
                </h1>
                <div class="flex flex-wrap gap-3.5 sm:gap-7.5 justify-center md:justify-start">
                    <button onclick="showAppDownload()" class="hero-section-button text-sm lg:text-base from-green-500 to-teal-600">
                        <i class="fas fa-mobile-alt mr-2 group-hover:animate-bounce"></i>
                        Скачать приложение
                    </button>
                    <button onclick="startJourney()" class="hero-section-button text-sm lg:text-base from-blue-500 to-purple-600">
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
                        Скачайте наше приложение и получите доступ ко всем функциям в телефоне
                    </p>

                    <div class="flex flex-col flex-wrap content-center md:content-start space-y-4 mb-8">
                        <div class="flex items-center space-x-3">
                            <div class="w-12 h-12 bg-white/20 backdrop-blur rounded-lg flex items-center justify-center">
                                <i class="fas fa-map-marked-alt text-white"></i>
                            </div>
                            <div>
                                <p class="font-['Merriweather'] font-semibold">Офлайн карты</p>
                                <p class="text-white/80 text-sm">Работает без интернета</p>
                            </div>
                        </div>

{{--                        <div class="flex items-center space-x-3">--}}
{{--                            <div class="w-12 h-12 bg-white/20 backdrop-blur rounded-lg flex items-center justify-center">--}}
{{--                                <i class="fas fa-vr-cardboard text-white"></i>--}}
{{--                            </div>--}}
{{--                            <div>--}}
{{--                                <p class="font-['Merriweather'] font-semibold">AR режим</p>--}}
{{--                                <p class="text-white/80 text-sm">Путешествие во времени</p>--}}
{{--                            </div>--}}
{{--                        </div>--}}

                        <div class="flex items-center space-x-3">
                            <div class="w-12 h-12 bg-white/20 backdrop-blur rounded-lg flex items-center justify-center">
                                <i class="fas fa-bell text-white"></i>
                            </div>
                            <div>
                                <p class="font-['Merriweather'] font-semibold">Push-уведомления</p>
                                <p class="text-white/80 text-sm">Не пропустите события</p>
                            </div>
                        </div>
                    </div>

                </div>

                <div data-aos="fade-left" class="text-center">
                    <div class="bg-white rounded-2xl p-8 inline-block">
                        <p class="text-gray-900 font-['Merriweather'] font-bold text-xl mb-4">Сканируйте QR-код</p>
                        <!-- QR Code image -->
                        <div class="w-64 h-64 rounded-lg overflow-hidden mb-4">
                            <img src="{{asset('/images/qrprila.jpg')}}" alt="QR-код приложения">
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
{{--    <section class="features-section py-10 sm:py-15 xl:py-20 3xl:py-26 bg-white">--}}
{{--        <div class="max-w-6xl 3xl:max-w-7xl mx-auto px-4 sm:px-10">--}}
{{--            <div class="text-center mb-12" data-aos="fade-up">--}}
{{--                <h2>Что вас ждет в приложении</h2>--}}
{{--                <p class="text text-gray-600">Уникальные возможности для жителей и гостей города</p>--}}
{{--            </div>--}}

{{--            <div class="parent-grid">--}}

{{--                <!-- Карточка 1 -->--}}
{{--                <div data-aos="fade-up" data-aos-delay="100" class="child-grid bg-linear-to-br from-blue-50 to-blue-100 rounded-xl p-5 3xl:p-8 hover:shadow-xl transition">--}}
{{--                    <div class="size-16 bg-blue-500 rounded-lg flex items-center justify-center mb-6">--}}
{{--                        <i class="fas fa-map-marked-alt text-white text-2xl"></i>--}}
{{--                    </div>--}}
{{--                    <h3>Интерактивная карта</h3>--}}
{{--                    <p>Все достопримечательности города на одной карте с подробной информацией и фотографиями</p>--}}
{{--                    <ul>--}}
{{--                        <li><i class="fas fa-check text-green-500 mr-2"></i>AR-навигация</li>--}}
{{--                        <li><i class="fas fa-check text-green-500 mr-2"></i>Аудиогиды</li>--}}
{{--                        <li><i class="fas fa-check text-green-500 mr-2"></i>3D модели</li>--}}
{{--                    </ul>--}}
{{--                </div>--}}

{{--                <!-- Карточка 2 -->--}}
{{--                <div data-aos="fade-up" data-aos-delay="200" class="child-grid bg-linear-to-br from-purple-50 to-purple-100 rounded-xl p-5 3xl:p-8 hover:shadow-xl transition">--}}
{{--                    <div class="size-16 bg-purple-500 rounded-lg flex items-center justify-center mb-6">--}}
{{--                        <i class="fas fa-trophy text-white text-2xl"></i>--}}
{{--                    </div>--}}
{{--                    <h3>Геймификация</h3>--}}
{{--                    <p>Зарабатывайте достижения, открывайте новые маршруты и получайте бонусы</p>--}}
{{--                    <ul>--}}
{{--                        <li><i class="fas fa-check text-green-500 mr-2"></i>30+ достижений</li>--}}
{{--                        <li><i class="fas fa-check text-green-500 mr-2"></i>Рейтинг путешественников</li>--}}
{{--                        <li><i class="fas fa-check text-green-500 mr-2"></i>Еженедельные квесты</li>--}}
{{--                    </ul>--}}
{{--                </div>--}}

{{--                <!-- Карточка 3 -->--}}
{{--                <div data-aos="fade-up" data-aos-delay="300" class="child-grid bg-linear-to-br from-green-50 to-green-100 rounded-xl p-5 3xl:p-8 hover:shadow-xl transition">--}}
{{--                    <div class="size-16 bg-green-500 rounded-lg flex items-center justify-center mb-6">--}}
{{--                        <div class="w-7.5 h-7.5">--}}
{{--                            <img src="/images/streamline-ultimate-concert-dj-bold.png" alt="иконка">--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <h3>Узнавай первым про мероприятия в городе</h3>--}}
{{--                    <p>Все концерты, фестивали и события города в одном месте с описаниями, датами и локациями</p>--}}
{{--                    <ul>--}}
{{--                        <li><i class="fas fa-check text-green-500 mr-2"></i>До 30% скидок</li>--}}
{{--                        <li><i class="fas fa-check text-green-500 mr-2"></i>Кэшбэк программа</li>--}}
{{--                        <li><i class="fas fa-check text-green-500 mr-2"></i>Специальные акции</li>--}}
{{--                    </ul>--}}
{{--                </div>--}}

{{--            </div>--}}
{{--        </div>--}}
{{--    </section>--}}

    <!-- Attractions Section -->
    <section id="attractions" class="py-10 md:py-20 bg-gray-50 overflow-hidden">
        <div class="max-w-6xl 3xl:max-w-7xl mx-auto px-4 sm:px-10">
            <div class="text-center mb-12" data-aos="fade-up">
                <h5 class="font-['Merriweather'] text-2xl sm:text-3xl lg:text-3xl 3xl:text-4x font-bold mb-4 tracking-[1px]">Главные достопримечательности</h5>
                <p class="text text-gray-600">Откройте для себя уникальные места Саратова</p>
            </div>

            <!-- Карусель -->
            <div class="relative group">
                <div class="flex overflow-x-auto gap-3 pb-16 scrollbar-hide scroll-smooth"
                     style="scrollbar-width: none; -ms-overflow-style: none;">

                    @foreach($carouselAttractions as $attraction)
                        <a href="{{ route('single-attraction', ['attraction' => $attraction->slug]) }}">
                            <div class="min-w-70 xl:min-w-80 bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 cursor-pointer group group/image group/color">
                                <div class="relative h-48 overflow-hidden">
                                    <img src="{{ $attraction->attachments?->get(0)?->url() ?? "" }}"
                                         alt="Изображение {{ $attraction->name }}" class="photo w-full h-full object-cover group-hover/image:scale-110 transition-transform duration-500">
                                    <div class="absolute inset-0 bg-linear-to-t from-black/60 via-transparent to-transparent"></div>
                                </div>
                                <div class="p-6">
                                    <h2 class="card-title text-xl font-bold mb-2 line-clamp-1 group-hover/color:text-[#352AA2] transition-colors duration-300">{{ $attraction->name }}</h2>
                                    <p class="text-gray-600 text-sm mb-4 line-clamp-2">{{ $attraction->short_description }}</p>
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center text-gray-500 text-sm">
                                            @if ($attraction->visit_duration)
                                                <i class="fas fa-clock mr-2"></i>
                                                <span>{{ $attraction->visit_duration }} мин</span>
                                            @endif
                                        </div>
                                        <a href="{{ route('single-attraction', ['attraction' => $attraction->slug]) }}" class="shrink-0 size-10 xl:size-11 bg-linear-to-r from-[#A556F7] to-[#2663EB] rounded-full flex items-center justify-center hover:opacity-90 transition-opacity hover:scale-110 group/button overflow-hidden relative">
                                            <img src="{{asset('/images/arrow-right.png')}}" alt="" class="icon w-2 xl:w-3 h-4.5 xl:h-6 transition-transform duration-300 group-hover/button:translate-x-1">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>

                @if($carouselAttractions->count() > 3)
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
                @endif
            </div>

            <div class="flex flex-col lg:flex-row gap-4 mb-12">
                @foreach($featuredAttractions as $attraction)
                    <a href="{{ route('single-attraction', ['attraction' => $attraction->slug]) }}">
                        <div class="bg-white rounded-xl shadow-lg overflow-hidden group hover:shadow-2xl duration-500 transition-shadow w-full">
                            <div class="relative h-64 overflow-hidden">
                                <img src="{{ $attraction->attachments?->get(0)?->url() ?? "" }}"
                                     alt="Изображение {{ $attraction->name }}"
                                     class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                            </div>
                            <div class="p-6">
                                <h2 class="card-title text-2xl font-bold mb-3 line-clamp-1 group-hover:text-[#352AA2] transition-colors duration-300">{{ $attraction->name }}</h2>
                                <p class="text-gray-600 mb-4">{{ $attraction->short_description }}</p>
                                <div class=" flex items-center justify-between">
                                    <div class="flex items-center text-gray-500 text-sm">
                                        @if ($attraction->visit_duration)
                                            <i class="fas fa-clock mr-2"></i>
                                            <span>{{ $attraction->visit_duration }} мин</span>
                                        @endif
                                    </div>
                                    <a href="{{ route('single-attraction', ['attraction' => $attraction->slug]) }}" class="arrow-link shrink-0 size-10 xl:size-11 3xl:size-15 bg-linear-to-r from-[#A556F7] to-[#2663EB] rounded-full flex items-center justify-center hover:opacity-90 hover:scale-110 group/button relative overflow-hidden transition-all duration-300 ease-in-out hover:shadow-lg hover:shadow-purple-500/30">
                                        <img src="{{asset('/images/arrow-right.png')}}" alt="иконка" class="icon w-2 xl:w-3 3xl:w-4 h-4.5 xl:h-6 3xl:h-7.5 transition-transform duration-300 group-hover/button:translate-x-1">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
            <!-- Map Container -->
            <div data-aos="fade-up" class="bg-white rounded-xl shadow-lg p-6">
                <div class="flex flex-col sm:flex-row gap-4 lg:flex-row items-center justify-between mb-4">
                    <p class="font-['Merriweather'] text-2xl font-bold mb-3">Интерактивная карта</p>
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
{{--    <section id="ar-experience" class="pt-10 sm:pt-15 xl:pt-20 3xl:pt-26 bg-white overflow-hidden">--}}
{{--        <div class="max-w-6xl 3xl:max-w-7xl mx-auto px-4">--}}
{{--            <div class="flex flex-col items-center mb-5 md:mb-12" data-aos="fade-up">--}}
{{--                <span class="flex justify-center gap-2 bg-linear-to-r from-purple-600 to-blue-600 text-white px-4 py-1 rounded-full text-sm font-semibold mb-4 text-nowrap">--}}
{{--                     <img src="/images/symbol.svg" alt="Иконка" class="icon">НОВАЯ ФУНКЦИЯ--}}
{{--                </span>--}}
{{--                <h2>Путешествие во времени с AR</h2>--}}
{{--                <p class="text text-gray-600">Увидьте, как выглядел Саратов 100 лет назад через камеру телефона</p>--}}
{{--            </div>--}}

{{--            <div class="grid md:grid-cols-2 gap-7 xl:gap-12 items-center">--}}
{{--                <div data-aos="fade-right">--}}
{{--                    <div class="relative xl:w-full md:h-99 xl:h-full shadow-xl">--}}
{{--                        <img src="{{asset('/images/a2180e30ceeba4a115385d68e52b22ba3e08df0f.webp')}}" alt="Саратовский мост" class="rounded-2xl">--}}
{{--                        <div class="absolute inset-0 bg-linear-to-t from-black/50 to-transparent rounded-2xl"></div>--}}
{{--                        <div class="absolute bottom-6 left-6 text-white">--}}
{{--                            <div class="bg-white/20 backdrop-blur-sm rounded-lg p-4">--}}
{{--                                <h1 class="font-bold md:text-base lg:text-lg mb-2">AR режим доступен</h1>--}}
{{--                                <p class="text-sm">Наведите камеру на QR-код рядом с достопримечательностью</p>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <!-- Floating AR elements -->--}}
{{--                        <div class="absolute -top-4 -right-4 bg-linear-to-r from-purple-500 to-blue-500 text-white rounded-full p-4 animate-bounce">--}}
{{--                            <i class="fas fa-vr-cardboard text-2xl"></i>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <div data-aos="fade-left" class="flex flex-col items-start">--}}
{{--                    <h1 class="text-3xl font-bold mb-6">Оживите историю города</h1>--}}
{{--                    <div class="space-y-4 mb-8">--}}
{{--                        <div class="flex items-start space-x-4">--}}
{{--                            <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center shrink-0">--}}
{{--                                <i class="fas fa-history text-purple-600"></i>--}}
{{--                            </div>--}}
{{--                            <div>--}}
{{--                                <h5 class="font-semibold mb-1">Исторические реконструкции</h5>--}}
{{--                                <p class="text-gray-600">Увидьте здания и улицы в их первоначальном виде</p>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="flex items-start space-x-4">--}}
{{--                            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center shrink-0">--}}
{{--                                <i class="fas fa-user-astronaut text-blue-600"></i>--}}
{{--                            </div>--}}
{{--                            <div>--}}
{{--                                <h5 class="font-semibold mb-1">Встреча с Гагариным</h5>--}}
{{--                                <p class="text-gray-600">AR-персонаж расскажет о своем приземлении в Саратове</p>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="flex items-start space-x-4">--}}
{{--                            <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center shrink-0">--}}
{{--                                <i class="fas fa-theater-masks text-green-600"></i>--}}
{{--                            </div>--}}
{{--                            <div>--}}
{{--                                <h5 class="font-semibold mb-1">Виртуальные экскурсоводы</h5>--}}
{{--                                <p class="text-gray-600">Известные личности города проведут персональную экскурсию</p>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <button onclick="startARExperience()" class="bg-linear-to-r from-purple-500 to-blue-600 text-white px-8 py-4 rounded-lg font-semibold hover:shadow-lg transition transform hover:-translate-y-1 cursor-pointer">--}}
{{--                        <i class="fas fa-play mr-2"></i>--}}
{{--                        Попробовать AR--}}
{{--                    </button>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </section>--}}

    @livewire('saratov-ai')

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
                <div data-aos="zoom-in" class="col-span-2 row-span-2 relative group overflow-hidden rounded-lg" data-fancybox="gallery" data-src="{{asset('/images/saratovskiy-Krytyy-rynok.webp')}}"  data-caption="Крытый рынок">
                    <img src="{{asset('/images/saratovskiy-Krytyy-rynok.webp')}}" alt="Крытый рынок" class="group-hover:scale-110 transition duration-500">
                    <div class="absolute inset-0 bg-linear-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition">
                        <div class="absolute bottom-4 left-4 text-white">
                            <p class="font-['Merriweather'] font-bold text-lg">Крытый рынок</p>
                        </div>
                    </div>
                </div>

                <div data-aos="zoom-in" data-aos-delay="100" class="relative group overflow-hidden rounded-lg" data-fancybox="gallery" data-src="{{asset('/images/e8e5976f-e105-4457-a3e8-a8acbb2351e4.webp')}}" data-caption="Консерватория">
                    <img src="{{asset('/images/e8e5976f-e105-4457-a3e8-a8acbb2351e4.webp')}}" alt="Консерватория" class="group-hover:scale-110 transition duration-500">
                    <div class="absolute inset-0 bg-linear-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition">
                        <div class="absolute bottom-4 left-4 text-white">
                            <p class="font-['Merriweather'] font-bold">Консерватория</p>
                        </div>
                    </div>
                </div>

                <div data-aos="zoom-in" data-aos-delay="150" class="relative group overflow-hidden rounded-lg" data-fancybox="gallery" data-src="{{asset('/images/07458c68242fb8524be00a45a7df919ea6e65e78.webp')}}" data-caption="Первый цирк России">
                    <img src="{{asset('/images/07458c68242fb8524be00a45a7df919ea6e65e78.webp')}}" alt="Цирк" class="group-hover:scale-110 transition duration-500">
                    <div class="absolute inset-0 bg-linear-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition">
                        <div class="absolute bottom-4 left-4 text-white">
                            <p class="font-['Merriweather'] font-bold">Первый цирк России</p>
                        </div>
                    </div>
                </div>

                <!-- Row 2 -->
                <div data-aos="zoom-in" data-aos-delay="200" class="relative group overflow-hidden rounded-lg" data-fancybox="gallery" data-src="{{asset('/images/cb9dbd39-4b6f-46ea-8544-013d39afc1a4.webp')}}"  data-caption="Парк Победы">
                    <img src="{{asset('/images/cb9dbd39-4b6f-46ea-8544-013d39afc1a4.webp')}}" alt="Парк Победы" class="group-hover:scale-110 transition duration-500">
                    <div class="absolute inset-0 bg-linear-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition">
                        <div class="absolute bottom-4 left-4 text-white">
                            <p class="font-['Merriweather'] font-bold">Парк Победы</p>
                        </div>
                    </div>
                </div>

                <div data-aos="zoom-in" data-aos-delay="250" class="relative group overflow-hidden rounded-lg" data-fancybox="gallery" data-src="{{asset('/images/8356339c970afc2d070e74f08f8a05505a083931.webp')}}" data-caption="Саратовский мост">
                    <img src="{{asset('/images/8356339c970afc2d070e74f08f8a05505a083931.webp')}}" alt="Мост через Волгу" class="group-hover:scale-110 transition duration-500">
                    <div class="absolute inset-0 bg-linear-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition">
                        <div class="absolute bottom-4 left-4 text-white">
                            <p class="font-['Merriweather'] font-bold">Саратовский мост</p>
                        </div>
                    </div>
                </div>

                <div data-aos="zoom-in" data-aos-delay="300" class="col-span-2 relative group overflow-hidden rounded-lg" data-fancybox="gallery" data-src="{{asset('/images/e84b78d9-2439-4602-b9ee-def607276a65.webp')}}" data-caption="Вечерний Саратов">
                    <img src="{{asset('/images/e84b78d9-2439-4602-b9ee-def607276a65.webp')}}" class="group-hover:scale-110 transition duration-500">
                    <div class="absolute inset-0 bg-lineart-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition">
                        <div class="absolute bottom-4 left-4 text-white">
                            <p class="font-['Merriweather'] font-bold text-lg">Вечерний Саратов</p>
                            <p class="text-sm">Романтические виды на Волгу</p>
                        </div>
                    </div>
                </div>

                <!-- Row 3 -->
                <div data-aos="zoom-in" data-aos-delay="350" class="col-span-2 relative group overflow-hidden rounded-lg" data-fancybox="gallery" data-src="{{asset('/images/ato58r5xh7sog4k40swwg0ksw.webp')}}" data-caption="Архитектурное наследие">
                    <img src="{{asset('/images/ato58r5xh7sog4k40swwg0ksw.webp')}}" alt="Консерватория фасад" class="group-hover:scale-110 transition duration-500">
                    <div class="absolute inset-0 bg-linear-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition">
                        <div class="absolute bottom-4 left-4 text-white">
                            <p class="font-['Merriweather'] font-bold text-lg">Архитектурное наследие</p>
                            <p class="text-sm">Памятники архитектуры XIX-XX веков</p>
                        </div>
                    </div>
                </div>

                <div data-aos="zoom-in" data-aos-delay="400" class="relative group overflow-hidden rounded-lg" data-fancybox="gallery" data-src="{{asset('/images/6whi7saljzocs40kwoo8okksg.webp')}}" data-caption="Великая Волга">
                    <img src="{{asset('/images/6whi7saljzocs40kwoo8okksg.webp')}}" alt="Волга" class="group-hover:scale-110 transition duration-500">
                    <div class="absolute inset-0 bg-linear-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition">
                        <div class="absolute bottom-4 left-4 text-white">
                            <p class="font-['Merriweather'] font-bold">Великая Волга</p>
                        </div>
                    </div>
                </div>

                <div data-aos="zoom-in" data-aos-delay="450" class="relative group overflow-hidden rounded-lg" data-fancybox="gallery" data-src="{{asset('https://fs.tonkosti.ru/30/ls/30lsy6fot9s0o04g4wow8wkgc.jpg')}}" data-caption="Летний Саратов">
                    <img src="{{asset('https://fs.tonkosti.ru/30/ls/30lsy6fot9s0o04g4wow8wkgc.jpg')}}" alt="Набережная летом" class="group-hover:scale-110 transition duration-500">
                    <div class="absolute inset-0 bg-linear-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition">
                        <div class="absolute bottom-4 left-4 text-white">
                            <p class="font-['Merriweather'] font-bold">Летний Саратов</p>
                        </div>
                    </div>
                </div>
                <div data-aos="zoom-in" data-aos-delay="450" class="relative group overflow-hidden rounded-lg" data-fancybox="gallery" data-src="{{asset('/images/d6e40fb855b389b4827ce14c2652cfc3c5295f12.webp')}}" data-caption="Церковь иконы Божией Матери">
                    <img src="{{asset('/images/030feb0c-d2a5-4c09-8586-4cb2cb623b49.webp')}}" alt="Церковь иконы Божией Матери" class="group-hover:scale-110 transition duration-500">
                    <div class="absolute inset-0 bg-linear-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition">
                        <div class="absolute bottom-4 left-4 text-white">
                            <p class="font-['Merriweather'] font-bold">Церковь иконы Божией Матери</p>
                        </div>
                    </div>
                </div>
                <div data-aos="zoom-in" data-aos-delay="450" class="relative group overflow-hidden rounded-lg" data-fancybox="gallery" data-src="{{asset('/images/3a2ab4b764e3db0e3d0f1c051cffa200df2712a0.webp')}}" data-caption="Набережная Космонавтов ">
                    <img src="{{asset('/images/c42130c5-9803-486f-ade5-63b9892c85c9.webp')}}" alt="Набережная Космонавтов " class="group-hover:scale-110 transition duration-500">
                    <div class="absolute inset-0 bg-linear-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition">
                        <div class="absolute bottom-4 left-4 text-white">
                            <p class="font-['Merriweather'] font-bold">Набережная Космонавтов</p>
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
                <a href="{{asset('/images/saratovskiy-Krytyy-rynok.webp')}}" data-fancybox="full-gallery" data-caption="Крытый рынок"></a>
                <a href="{{asset('/images/e8e5976f-e105-4457-a3e8-a8acbb2351e4.webp" data-fancybox="full-gallery')}}" data-caption="Консерватория"></a>
                <a href="{{asset('/images/07458c68242fb8524be00a45a7df919ea6e65e78.webp')}}" data-fancybox="full-gallery"
                data-caption="Первый цирк России"></a>
                <a href="{{asset('/images/cb9dbd39-4b6f-46ea-8544-013d39afc1a4.webp')}}" data-fancybox="full-gallery"
                data-caption="Парк Победы"></a>
                <a href="{{asset('/images/8356339c970afc2d070e74f08f8a05505a083931.webp')}}" data-fancybox="full-gallery"
                data-caption="Саратовский мост"></a>
                <a href="{{asset('/images/e84b78d9-2439-4602-b9ee-def607276a65.webp')}}" data-fancybox="full-gallery"
                data-caption="Вечерний Саратов"></a>
                <a href="{{asset('/images/ato58r5xh7sog4k40swwg0ksw.webp')}}" data-fancybox="full-gallery"
                data-caption="Архитектурное наследие"></a>
                <a href="{{asset('/images/6whi7saljzocs40kwoo8okksg.webp')}}" data-fancybox="full-gallery"
                data-caption="Великая волга"></a>
                <a href="{{asset('https://fs.tonkosti.ru/30/ls/30lsy6fot9s0o04g4wow8wkgc.jpg')}}" data-fancybox="full-gallery"
                data-caption="Летний Саратов"></a>
                <a href="{{asset('/images/d6e40fb855b389b4827ce14c2652cfc3c5295f12.webp')}}" data-fancybox="full-gallery"
                data-caption="Церковь иконы Божией Матери"></a>
                <a href="{{asset('/images/3a2ab4b764e3db0e3d0f1c051cffa200df2712a0.webp')}}" data-fancybox="full-gallery"
                data-caption="Набережная космонавтов"></a>
            </div>
        </div>
    </section>
</div>
