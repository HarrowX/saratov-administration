// Advanced Interactive Chatbot for Saratov 435
// With real data about places, cafes, restaurants, parks, etc.

const ChatBot = {

    // Conversation history for context
    conversationHistory: [],
    
    // Real Saratov places data
    places: {
        cafes: [
            {
                name: "Кофейня Гагарин",
                address: "пр. Кирова, 25",
                type: "Кофейня",
                description: "Уютная кофейня в космическом стиле с лучшим кофе в городе",
                rating: 4.9,
                priceRange: "$$",
                specialties: ["Авторский кофе", "Десерты", "Завтраки"],
                workingHours: "08:00-23:00"
            },
            {
                name: "Шоколадница",
                address: "ул. Московская, 84",
                type: "Кафе",
                description: "Популярная сеть с большим выбором десертов и напитков",
                rating: 4.5,
                priceRange: "$$",
                specialties: ["Горячий шоколад", "Блины", "Десерты"],
                workingHours: "09:00-22:00"
            },
            {
                name: "Coffee Bean",
                address: "ул. Вольская, 55",
                type: "Кофейня",
                description: "Современная кофейня с зернами со всего мира",
                rating: 4.7,
                priceRange: "$",
                specialties: ["Specialty кофе", "Веганские десерты", "Смузи"],
                workingHours: "07:00-22:00"
            },
            {
                name: "Прокофий",
                address: "ул. Советская, 17",
                type: "Кафе",
                description: "Атмосферное место с живой музыкой по вечерам",
                rating: 4.6,
                priceRange: "$$",
                specialties: ["Бизнес-ланчи", "Вечерние концерты", "Коктейли"],
                workingHours: "10:00-02:00"
            }
        ],
        restaurants: [
            {
                name: "Ресторан Волга",
                address: "ул. Набережная Космонавтов, 1",
                type: "Ресторан",
                description: "Традиционная русская кухня с панорамным видом на Волгу",
                rating: 4.8,
                priceRange: "$$$",
                specialties: ["Стерлядь по-саратовски", "Русская кухня", "Банкеты"],
                workingHours: "12:00-00:00"
            },
            {
                name: "Италия",
                address: "ул. Вольская, 89",
                type: "Пиццерия",
                description: "Настоящая итальянская пицца из печи на дровах",
                rating: 4.7,
                priceRange: "$$",
                specialties: ["Пицца", "Паста", "Тирамису"],
                workingHours: "11:00-23:00"
            },
            {
                name: "Барин",
                address: "ул. Кутякова, 89",
                type: "Ресторан",
                description: "Русская и европейская кухня в купеческом стиле",
                rating: 4.6,
                priceRange: "$$$",
                specialties: ["Дичь", "Домашние настойки", "Старорусские блюда"],
                workingHours: "12:00-01:00"
            },
            {
                name: "Суши Мастер",
                address: "пр. Кирова, 31",
                type: "Суши-бар",
                description: "Японская кухня с доставкой",
                rating: 4.5,
                priceRange: "$$",
                specialties: ["Суши", "Роллы", "WOK"],
                workingHours: "10:00-23:00"
            }
        ],
        parks: [
            {
                name: "Парк Победы",
                address: "Соколовая гора",
                type: "Мемориальный парк",
                description: "Музей военной техники под открытым небом, Вечный огонь",
                rating: 4.8,
                features: ["Музей техники", "Смотровая площадка", "Детские площадки"],
                bestTime: "Весна-осень",
                entrance: "Бесплатно"
            },
            {
                name: "Городской парк",
                address: "ул. Чернышевского, 81",
                type: "Парк культуры и отдыха",
                description: "Старейший парк города с аттракционами и прудами",
                rating: 4.5,
                features: ["Аттракционы", "Лодочная станция", "Кафе"],
                bestTime: "Май-сентябрь",
                entrance: "Бесплатно"
            },
            {
                name: "Липки",
                address: "ул. Соборная",
                type: "Исторический сквер",
                description: "Один из старейших скверов России, заложен в 1824 году",
                rating: 4.6,
                features: ["Исторические памятники", "Фонтаны", "Липовые аллеи"],
                bestTime: "Круглый год",
                entrance: "Бесплатно"
            },
            {
                name: "Набережная Космонавтов",
                address: "Набережная Космонавтов",
                type: "Набережная",
                description: "Любимое место отдыха с видом на Волгу и пляжем",
                rating: 4.9,
                features: ["Велодорожки", "Спортплощадки", "Пляж", "Речные прогулки"],
                bestTime: "Май-октябрь",
                entrance: "Бесплатно"
            }
        ],
        museums: [
            {
                name: "Радищевский музей",
                address: "ул. Радищева, 39",
                type: "Художественный музей",
                description: "Первый общедоступный художественный музей в провинции",
                rating: 4.7,
                priceRange: "200₽",
                collections: ["Русская живопись", "Европейское искусство", "Иконы"],
                workingHours: "10:00-18:00, ПН - выходной"
            },
            {
                name: "Музей-усадьба Чернышевского",
                address: "ул. Чернышевского, 142",
                type: "Мемориальный музей",
                description: "Дом-музей великого русского писателя и философа",
                rating: 4.5,
                priceRange: "150₽",
                collections: ["Личные вещи", "Рукописи", "Библиотека"],
                workingHours: "10:00-17:00, ПН - выходной"
            },
            {
                name: "Саратовский краеведческий музей",
                address: "ул. Лермонтова, 34",
                type: "Краеведческий музей",
                description: "История Саратовского края с древнейших времен",
                rating: 4.6,
                priceRange: "150₽",
                collections: ["Археология", "Этнография", "Природа края"],
                workingHours: "10:00-18:00, ПН - выходной"
            }
        ],
        entertainment: [
            {
                name: "Саратовский цирк",
                address: "ул. Чапаева, 61",
                type: "Цирк",
                description: "Первый стационарный цирк в России, основан в 1876 году",
                rating: 4.8,
                priceRange: "500-2000₽",
                shows: ["Цирковые представления", "Гастроли", "Детские шоу"],
                workingHours: "Касса: 10:00-19:00"
            },
            {
                name: "ТЮЗ им. Киселева",
                address: "ул. Вольская, 83",
                type: "Театр",
                description: "Театр юного зрителя с богатым репертуаром",
                rating: 4.7,
                priceRange: "300-1500₽",
                shows: ["Детские спектакли", "Молодежные постановки", "Классика"],
                workingHours: "Касса: 10:00-19:00"
            },
            {
                name: "Лимонарий",
                address: "Соколовая гора, 4а",
                type: "Ботанический сад",
                description: "Уникальная коллекция цитрусовых и экзотических растений",
                rating: 4.5,
                priceRange: "200₽",
                features: ["50+ видов растений", "Экскурсии", "Дегустации"],
                workingHours: "10:00-18:00"
            },
            {
                name: "Саратовский театр оперы и балета",
                address: "Театральная площадь, 1",
                type: "Театр",
                description: "Один из старейших театров России с богатой историей",
                rating: 4.9,
                priceRange: "500-3000₽",
                shows: ["Оперы", "Балеты", "Концерты", "Гастроли"],
                workingHours: "Касса: 10:00-20:00"
            },
            {
                name: "Драматический театр им. Слонова",
                address: "ул. Радищева, 41",
                type: "Театр",
                description: "Классический драматический театр с современными постановками",
                rating: 4.6,
                priceRange: "400-2000₽",
                shows: ["Драмы", "Комедии", "Современные пьесы"],
                workingHours: "Касса: 10:00-19:00"
            },
            {
                name: "Кинотеатр 'Пионер'",
                address: "ул. Московская, 55",
                type: "Кинотеатр",
                description: "Современный кинотеатр с 7 залами и IMAX",
                rating: 4.4,
                priceRange: "200-600₽",
                features: ["IMAX", "3D", "VIP залы", "Попкорн-бар"],
                workingHours: "09:00-02:00"
            }
        ],
        shopping: [
            {
                name: "ТЦ 'Триумф Молл'",
                address: "ул. Танкистов, 1",
                type: "Торговый центр",
                description: "Самый большой торговый центр Саратова",
                rating: 4.3,
                features: ["200+ магазинов", "Фудкорт", "Кинотеатр", "Детская зона"],
                workingHours: "10:00-22:00"
            },
            {
                name: "ТЦ 'Победа Плаза'",
                address: "ул. Московская, 100",
                type: "Торговый центр",
                description: "Современный торговый центр в центре города",
                rating: 4.2,
                features: ["Модные бренды", "Рестораны", "Спорт-бар"],
                workingHours: "10:00-22:00"
            },
            {
                name: "Центральный рынок",
                address: "ул. Чапаева, 110",
                type: "Рынок",
                description: "Традиционный рынок с местными продуктами",
                rating: 4.1,
                features: ["Свежие продукты", "Местные деликатесы", "Низкие цены"],
                workingHours: "06:00-18:00"
            }
        ],
        sports: [
            {
                name: "Стадион 'Локомотив'",
                address: "ул. Чернышевского, 63",
                type: "Стадион",
                description: "Главный футбольный стадион города",
                rating: 4.5,
                features: ["Футбольные матчи", "Тренировки", "Экскурсии"],
                workingHours: "08:00-22:00"
            },
            {
                name: "Ледовый дворец 'Кристалл'",
                address: "ул. Чернышевского, 63",
                type: "Ледовый дворец",
                description: "Современный ледовый дворец для хоккея и фигурного катания",
                rating: 4.6,
                features: ["Хоккей", "Фигурное катание", "Прокат коньков"],
                workingHours: "08:00-23:00"
            },
            {
                name: "Аквапарк 'Лимкор'",
                address: "ул. Соколовая, 335",
                type: "Аквапарк",
                description: "Современный аквапарк с горками и бассейнами",
                rating: 4.4,
                priceRange: "800-1500₽",
                features: ["Водные горки", "Бассейны", "Сауны", "SPA"],
                workingHours: "10:00-22:00"
            }
        ],
        transport: [
            {
                name: "Железнодорожный вокзал",
                address: "Привокзальная площадь, 1",
                type: "Вокзал",
                description: "Главный железнодорожный вокзал Саратова",
                rating: 4.2,
                features: ["Поезда дальнего следования", "Пригородные поезда", "Кафе", "Магазины"],
                workingHours: "Круглосуточно"
            },
            {
                name: "Автовокзал",
                address: "ул. Московская, 170",
                type: "Автовокзал",
                description: "Междугородние автобусные перевозки",
                rating: 4.0,
                features: ["Автобусы по области", "Междугородние рейсы", "Касса"],
                workingHours: "05:00-23:00"
            },
            {
                name: "Аэропорт 'Гагарин'",
                address: "Саратовская область, Саратовский район",
                type: "Аэропорт",
                description: "Международный аэропорт имени Ю.А. Гагарина",
                rating: 4.3,
                features: ["Внутренние рейсы", "Международные рейсы", "Парковка", "Кафе"],
                workingHours: "Круглосуточно"
            }
        ]
    },
    
    // Chat state
    currentState: 'greeting',
    userPreferences: {
        category: null,
        budget: null,
        time: null,
        companions: null
    },
    chatHistory: [],
    
    // Initialize chatbot
    init() {
        this.sendBotMessage(this.getGreeting(), ['start']);
    },
    
    // Get greeting message with more variety
    getGreeting() {
        const hour = new Date().getHours();
        const dayOfWeek = new Date().getDay();
        const greetings = [];
        
        // Time-based greetings
        if (hour < 6) {
            greetings.push("Доброй ночи! Я Сара, ваш AI-гид по Саратову! 🌙");
            greetings.push("Поздняя ночь! Я Сара, готова помочь с планами на завтра! ⭐");
        } else if (hour < 12) {
            greetings.push("Доброе утро! Я Сара, готова помочь вам открыть Саратов! ☀️");
            greetings.push("Утро доброе! Я Сара, давайте составим отличный план на день! 🌅");
            greetings.push("Привет! Я Сара, ваш персональный гид! Готовы к новым открытиям? 🌟");
        } else if (hour < 18) {
            greetings.push("Добрый день! Я Сара, ваш персональный гид по городу! 🌞");
            greetings.push("Привет! Я Сара, готова показать вам лучшие места Саратова! ✨");
            greetings.push("Добрый день! Я Сара, давайте найдем что-то интересное! 🎯");
        } else {
            greetings.push("Добрый вечер! Я Сара, давайте составим план на завтра! 🌙");
            greetings.push("Вечер добрый! Я Сара, готова помочь с вечерними планами! 🌆");
            greetings.push("Привет! Я Сара, ваш AI-гид! Как прошел день? 🌟");
        }
        
        // Day-specific greetings
        if (dayOfWeek === 0 || dayOfWeek === 6) {
            greetings.push("Выходные! Я Сара, готова помочь с планами на уикенд! 🎉");
            greetings.push("Отличные выходные! Я Сара, давайте найдем что-то особенное! 🎊");
        }
        
        // Random selection
        return greetings[Math.floor(Math.random() * greetings.length)];
    },
    
    // Process user response
    processUserResponse(response, type = 'text') {
        // Add user message to chat
        if (type === 'text') {
            this.addUserMessage(response);
        }
        
        // Handle option clicks directly
        if (type === 'option') {
            this.handleOptionClick(response);
            return;
        }
        
        // Analyze user intent
        const intent = this.analyzeIntent(response);
        
        // Process based on intent or current state
        if (intent.type === 'route_planning') {
            this.currentState = 'askCategory';
            this.askCategory();
        } else if (intent.type === 'food_inquiry') {
            this.handleFoodInquiry(intent);
        } else if (intent.type === 'places_inquiry') {
            this.handlePlacesInquiry(intent);
        } else if (intent.type === 'weather_inquiry') {
            this.handleWeatherInquiry();
        } else if (intent.type === 'events_inquiry') {
            this.handleEventsInquiry();
        } else if (intent.type === 'history_inquiry') {
            this.handleHistoryInquiry(intent);
        } else if (intent.type === 'shopping_inquiry') {
            this.handleShoppingInquiry(intent);
        } else if (intent.type === 'sports_inquiry') {
            this.handleSportsInquiry(intent);
        } else if (intent.type === 'transport_inquiry') {
            this.handleTransportInquiry(intent);
        } else if (intent.type === 'general_question') {
            this.handleGeneralQuestion(intent);
        } else {
            // Process based on current state
            switch(this.currentState) {
                case 'greeting':
                    if (response === 'start') {
                        this.currentState = 'askCategory';
                        this.askCategory();
                    } else {
                        this.handleGeneralResponse(response);
                    }
                    break;
                    
                case 'askCategory':
                    this.userPreferences.category = response;
                    this.currentState = 'askBudget';
                    this.askBudget(response);
                    break;
                    
                case 'askBudget':
                    this.userPreferences.budget = response;
                    this.currentState = 'askTime';
                    this.askTime();
                    break;
                    
                case 'askTime':
                    this.userPreferences.time = response;
                    this.currentState = 'askCompanions';
                    this.askCompanions();
                    break;
                    
                case 'askCompanions':
                    this.userPreferences.companions = response;
                    this.currentState = 'showRecommendations';
                    this.showRecommendations();
                    break;
                    
                case 'showRecommendations':
                    if (response === 'restart') {
                        this.restart();
                    } else if (response === 'more') {
                        this.showMoreRecommendations();
                    } else if (response.startsWith('details_')) {
                        this.showPlaceDetails(response.replace('details_', ''));
                    } else {
                        this.handleGeneralResponse(response);
                    }
                    break;
                    
                default:
                    this.handleGeneralResponse(response);
                    break;
            }
        }
    },
    
    // Ask category
    askCategory() {
        const message = "Отлично! Что вас интересует больше всего? 🤔";
        const options = [
            { text: '☕ Кафе и рестораны', value: 'food' },
            { text: '🌳 Парки и прогулки', value: 'parks' },
            { text: '🏛️ Музеи и культура', value: 'museums' },
            { text: '🎭 Развлечения', value: 'entertainment' },
            { text: '🎯 Всё сразу', value: 'all' }
        ];
        this.sendBotMessage(message, options);
    },
    
    // Ask budget
    askBudget(category) {
        let emoji = category === 'food' ? '🍽️' : category === 'parks' ? '🌳' : category === 'museums' ? '🏛️' : '🎯';
        const message = `${emoji} Хороший выбор! Какой у вас бюджет на день?`;
        const options = [
            { text: '💰 Эконом (до 1000₽)', value: 'economy' },
            { text: '💵 Средний (1000-3000₽)', value: 'medium' },
            { text: '💎 Комфорт (3000₽+)', value: 'comfort' },
            { text: '🆓 Только бесплатное', value: 'free' }
        ];
        this.sendBotMessage(message, options);
    },
    
    // Ask time
    askTime() {
        const message = "Сколько времени вы планируете провести? ⏰";
        const options = [
            { text: '🌅 Утро (2-3 часа)', value: 'morning' },
            { text: '☀️ Полдня (4-6 часов)', value: 'halfday' },
            { text: '🌆 Весь день (8+ часов)', value: 'fullday' },
            { text: '🌙 Вечер (3-4 часа)', value: 'evening' }
        ];
        this.sendBotMessage(message, options);
    },
    
    // Ask companions
    askCompanions() {
        const message = "С кем вы будете? Это поможет мне подобрать лучшие места 👥";
        const options = [
            { text: '👤 Один/одна', value: 'alone' },
            { text: '💑 Вдвоём', value: 'couple' },
            { text: '👨‍👩‍👧‍👦 С семьей', value: 'family' },
            { text: '👥 С друзьями', value: 'friends' },
            { text: '👔 Деловая встреча', value: 'business' }
        ];
        this.sendBotMessage(message, options);
    },
    
    // Show recommendations
    showRecommendations() {
        const recommendations = this.generateRecommendations();
        
        let message = "🎯 Вот мой персональный план для вас:\n\n";
        
        recommendations.forEach((rec, index) => {
            message += `${index + 1}. **${rec.name}**\n`;
            message += `📍 ${rec.address}\n`;
            message += `⭐ Рейтинг: ${rec.rating}\n`;
            message += `💬 ${rec.description}\n`;
            if (rec.priceRange) {
                message += `💰 ${rec.priceRange}\n`;
            }
            message += '\n';
        });
        
        message += "💡 **Совет дня**: " + this.getDayTip();
        
        const options = [
            { text: '📋 Подробнее о местах', value: 'more' },
            { text: '🔄 Другие варианты', value: 'restart' },
            { text: '📱 Сохранить маршрут', value: 'save' }
        ];
        
        this.sendBotMessage(message, options);
    },
    
    // Generate recommendations based on preferences
    generateRecommendations() {
        let recommendations = [];
        const { category, budget, time, companions } = this.userPreferences;
        
        // Food recommendations
        if (category === 'food' || category === 'all') {
            if (budget === 'economy' || budget === 'free') {
                recommendations.push(...this.places.cafes.filter(c => c.priceRange === '$').slice(0, 2));
            } else if (budget === 'medium') {
                recommendations.push(...this.places.cafes.filter(c => c.priceRange === '$$').slice(0, 1));
                recommendations.push(...this.places.restaurants.filter(r => r.priceRange === '$$').slice(0, 1));
            } else {
                recommendations.push(...this.places.restaurants.filter(r => r.priceRange === '$$$').slice(0, 2));
            }
        }
        
        // Parks recommendations
        if (category === 'parks' || category === 'all') {
            if (companions === 'family') {
                recommendations.push(this.places.parks.find(p => p.name === 'Городской парк'));
            } else if (companions === 'couple') {
                recommendations.push(this.places.parks.find(p => p.name === 'Набережная Космонавтов'));
            } else {
                recommendations.push(this.places.parks.find(p => p.name === 'Парк Победы'));
            }
        }
        
        // Museums recommendations
        if (category === 'museums' || category === 'all') {
            if (budget !== 'free') {
                recommendations.push(...this.places.museums.slice(0, 1));
            }
        }
        
        // Entertainment recommendations
        if (category === 'entertainment' || category === 'all') {
            if (companions === 'family') {
                recommendations.push(this.places.entertainment.find(e => e.name === 'Саратовский цирк'));
            } else {
                recommendations.push(this.places.entertainment.find(e => e.name === 'Лимонарий'));
            }
        }
        
        // Limit recommendations based on time
        if (time === 'morning') {
            recommendations = recommendations.slice(0, 2);
        } else if (time === 'halfday') {
            recommendations = recommendations.slice(0, 3);
        } else if (time === 'evening') {
            recommendations = recommendations.slice(0, 2);
        }
        
        return recommendations;
    },
    
    // Get tip of the day
    getDayTip() {
        const tips = [
            "В выходные на Набережной работает ярмарка местных производителей",
            "По средам вход в Радищевский музей для студентов бесплатный",
            "Лучший вид на город открывается со смотровой площадки Парка Победы",
            "В консерватории каждую субботу проходят бесплатные концерты",
            "Саратовский калач - must try! Лучшие продают в пекарне на Кирова"
        ];
        return tips[Math.floor(Math.random() * tips.length)];
    },
    
    // Send bot message with typing animation
    sendBotMessage(text, options = []) {
        const chatContainer = document.getElementById('chatContainer');
        if (!chatContainer) return;
        
        // Show typing indicator
        this.showTypingIndicator();
        
        // Simulate typing delay
        setTimeout(() => {
            this.hideTypingIndicator();
            
            const messageHtml = `
                <div class="flex items-start space-x-3 animate-fadeIn">
                    <div class="w-10 h-10 bg-linear-to-r from-green-400 to-teal-500 rounded-full flex items-center justify-center">
                        <i class="fas fa-robot text-white"></i>
                    </div>
                    <div class="flex-1">
                        <div class="bg-gray-100 rounded-2xl rounded-tl-none p-4 max-w-md">
                            <p class="font-semibold mb-1 text-green-600">Сара</p>
                            <p class="whitespace-pre-line">${this.formatMessage(text)}</p>
                        </div>
                        ${options.length > 0 ? this.createOptions(options) : ''}
                    </div>
                </div>
            `;
            
            const messagesContainer = chatContainer.querySelector('.space-y-4');
            if (messagesContainer) {
                messagesContainer.insertAdjacentHTML('beforeend', messageHtml);
                chatContainer.scrollTop = chatContainer.scrollHeight;
            }
            
            this.chatHistory.push({ sender: 'bot', text, timestamp: Date.now() });
        }, 1000 + Math.random() * 1000); // Random delay between 1-2 seconds
    },
    
    // Show typing indicator
    showTypingIndicator() {
        const chatContainer = document.getElementById('chatContainer');
        if (!chatContainer) return;
        
        const typingHtml = `
            <div class="flex items-start space-x-3 animate-fadeIn" id="typingIndicator">
                <div class="w-10 h-10 bg-linear-to-r from-green-400 to-teal-500 rounded-full flex items-center justify-center">
                    <i class="fas fa-robot text-white"></i>
                </div>
                <div class="flex-1">
                    <div class="bg-gray-100 rounded-2xl rounded-tl-none p-4 max-w-md">
                        <p class="font-semibold mb-1 text-green-600">Сара печатает...</p>
                        <div class="flex space-x-1">
                            <div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce"></div>
                            <div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 0.1s"></div>
                            <div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 0.2s"></div>
                        </div>
                    </div>
                </div>
            </div>
        `;
        
        const messagesContainer = chatContainer.querySelector('.space-y-4');
        if (messagesContainer) {
            messagesContainer.insertAdjacentHTML('beforeend', typingHtml);
            chatContainer.scrollTop = chatContainer.scrollHeight;
        }
    },
    
    // Hide typing indicator
    hideTypingIndicator() {
        const typingIndicator = document.getElementById('typingIndicator');
        if (typingIndicator) {
            typingIndicator.remove();
        }
    },
    
    // Add user message
    addUserMessage(text) {
        const chatContainer = document.getElementById('chatContainer');
        if (!chatContainer) return;
        
        const messageHtml = `
            <div class="flex items-start space-x-3 justify-end animate-fadeIn">
                <div class="bg-blue-500 text-white rounded-2xl rounded-tr-none p-4 max-w-md">
                    <p>${text}</p>
                </div>
                <div class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center">
                    <i class="fas fa-user text-white"></i>
                </div>
            </div>
        `;
        
        const messagesContainer = chatContainer.querySelector('.space-y-4');
        if (messagesContainer) {
            messagesContainer.insertAdjacentHTML('beforeend', messageHtml);
            chatContainer.scrollTop = chatContainer.scrollHeight;
        }
        
        this.chatHistory.push({ sender: 'user', text, timestamp: Date.now() });
    },
    
    // Create options buttons
    createOptions(options) {
        const buttonsHtml = options.map(opt => {
            const value = opt.value || opt.text;
            const text = opt.text || opt;
            return `
                <button onclick="ChatBot.selectOption('${value}', '${text}')" 
                        class="bg-white hover:bg-gray-50 px-4 py-2 rounded-lg text-sm border transition">
                    ${text}
                </button>
            `;
        }).join('');
        
        return `
            <div class="mt-3 flex flex-wrap gap-2">
                ${buttonsHtml}
            </div>
        `;
    },
    
    // Handle option selection
    selectOption(value, text) {
        this.addUserMessage(text);
        this.processUserResponse(value, 'option');
    },

    // Handle option clicks with specific responses
    handleOptionClick(value) {
        switch(value) {
            case 'attractions':
                this.handleAttractionsClick();
                break;
            case 'food':
                this.handleFoodClick();
                break;
            case 'weather':
                this.handleWeatherClick();
                break;
            case 'events':
                this.handleEventsClick();
                break;
            case 'start':
                this.handleStartClick();
                break;
            case 'cafes':
                this.handleCafesClick();
                break;
            case 'restaurants':
                this.handleRestaurantsClick();
                break;
            case 'desserts':
                this.handleDessertsClick();
                break;
            case 'fastfood':
                this.handleFastFoodClick();
                break;
            case 'evening':
                this.handleEveningClick();
                break;
            case 'conservatory':
                this.handleConservatoryClick();
                break;
            case 'embankment':
                this.handleEmbankmentClick();
                break;
            case 'victory_park':
                this.handleVictoryParkClick();
                break;
            case 'radishchev_museum':
                this.handleRadishchevMuseumClick();
                break;
            case 'gagarin_cafe':
                this.handleGagarinCafeClick();
                break;
            case 'old_city_restaurant':
                this.handleOldCityRestaurantClick();
                break;
            case 'italiano_pizza':
                this.handleItalianoPizzaClick();
                break;
            case 'prokofy_cafe':
                this.handleProkofyCafeClick();
                break;
            default:
                this.handleGeneralResponse(value);
        }
    },
    
    // Format message with markdown-like syntax
    formatMessage(text) {
        return text
            .replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>')
            .replace(/\*(.*?)\*/g, '<em>$1</em>');
    },
    
    // Analyze user intent
    analyzeIntent(text) {
        const lowerText = text.toLowerCase();
        
        // Route planning keywords
        if (lowerText.includes('маршрут') || lowerText.includes('план') || lowerText.includes('начать') || 
            lowerText.includes('путешествие') || lowerText.includes('экскурсия') || lowerText.includes('start')) {
            return { type: 'route_planning', confidence: 0.9 };
        }
        
        // Food inquiry keywords
        if (lowerText.includes('еда') || lowerText.includes('поесть') || lowerText.includes('кафе') || 
            lowerText.includes('ресторан') || lowerText.includes('кофе') || lowerText.includes('обед') ||
            lowerText.includes('ужин') || lowerText.includes('завтрак') || lowerText.includes('пицца') ||
            lowerText.includes('суши') || lowerText.includes('где поесть')) {
            return { type: 'food_inquiry', confidence: 0.8 };
        }
        
        // Places inquiry keywords
        if (lowerText.includes('парк') || lowerText.includes('музей') || lowerText.includes('театр') ||
            lowerText.includes('цирк') || lowerText.includes('достопримечательность') || lowerText.includes('место') ||
            lowerText.includes('прогулка') || lowerText.includes('развлечение') || lowerText.includes('культура')) {
            return { type: 'places_inquiry', confidence: 0.8 };
        }
        
        // Shopping inquiry keywords
        if (lowerText.includes('магазин') || lowerText.includes('торговый') || lowerText.includes('покупки') ||
            lowerText.includes('шопинг') || lowerText.includes('рынок') || lowerText.includes('молл') ||
            lowerText.includes('купить') || lowerText.includes('товары')) {
            return { type: 'shopping_inquiry', confidence: 0.8 };
        }
        
        // Sports inquiry keywords
        if (lowerText.includes('спорт') || lowerText.includes('стадион') || lowerText.includes('фитнес') ||
            lowerText.includes('бассейн') || lowerText.includes('аквапарк') || lowerText.includes('ледовый') ||
            lowerText.includes('тренировка') || lowerText.includes('футбол') || lowerText.includes('хоккей')) {
            return { type: 'sports_inquiry', confidence: 0.8 };
        }
        
        // Transport inquiry keywords
        if (lowerText.includes('вокзал') || lowerText.includes('аэропорт') || lowerText.includes('автобус') ||
            lowerText.includes('поезд') || lowerText.includes('транспорт') || lowerText.includes('как добраться') ||
            lowerText.includes('дорога') || lowerText.includes('маршрут')) {
            return { type: 'transport_inquiry', confidence: 0.8 };
        }
        
        // Weather inquiry keywords
        if (lowerText.includes('погода') || lowerText.includes('дождь') || lowerText.includes('солнце') ||
            lowerText.includes('температура') || lowerText.includes('ветер') || lowerText.includes('снег')) {
            return { type: 'weather_inquiry', confidence: 0.9 };
        }
        
        // Events inquiry keywords
        if (lowerText.includes('событие') || lowerText.includes('мероприятие') || lowerText.includes('концерт') ||
            lowerText.includes('выставка') || lowerText.includes('фестиваль') || lowerText.includes('шоу') ||
            lowerText.includes('сегодня') || lowerText.includes('завтра') || lowerText.includes('выходные')) {
            return { type: 'events_inquiry', confidence: 0.8 };
        }
        
        // History inquiry keywords
        if (lowerText.includes('история') || lowerText.includes('прошлое') || lowerText.includes('гагарин') ||
            lowerText.includes('радищев') || lowerText.includes('чернышевский') || lowerText.includes('факт') ||
            lowerText.includes('интересно') || lowerText.includes('расскажи') || lowerText.includes('знать')) {
            return { type: 'history_inquiry', confidence: 0.7 };
        }
        
        // General questions
        if (lowerText.includes('?') || lowerText.includes('что') || lowerText.includes('как') ||
            lowerText.includes('где') || lowerText.includes('когда') || lowerText.includes('почему') ||
            lowerText.includes('расскажи') || lowerText.includes('помоги')) {
            return { type: 'general_question', confidence: 0.6 };
        }
        
        return { type: 'general_response', confidence: 0.5 };
    },
    
    // Handle food inquiry
    handleFoodInquiry(intent) {
        const message = "🍽️ Отлично! Я помогу вам найти лучшие места для еды в Саратове. Что вас интересует?";
        const options = [
            { text: '☕ Кофейни', value: 'cafes' },
            { text: '🍕 Рестораны', value: 'restaurants' },
            { text: '🍰 Десерты', value: 'desserts' },
            { text: '🌮 Быстрая еда', value: 'fastfood' },
            { text: '🍷 Вечерние заведения', value: 'evening' }
        ];
        this.sendBotMessage(message, options);
    },
    
    // Handle places inquiry
    handlePlacesInquiry(intent) {
        const message = "🏛️ Прекрасно! В Саратове есть множество интересных мест. Что вас больше привлекает?";
        const options = [
            { text: '🌳 Парки и природа', value: 'parks' },
            { text: '🏛️ Музеи и культура', value: 'museums' },
            { text: '🎭 Театры и развлечения', value: 'entertainment' },
            { text: '📸 Фото-локации', value: 'photospots' },
            { text: '🎯 Все интересные места', value: 'all' }
        ];
        this.sendBotMessage(message, options);
    },
    
    // Handle weather inquiry
    handleWeatherInquiry() {
        const weatherData = this.getWeatherInfo();
        const message = `🌤️ **Погода в Саратове сегодня:**\n\n${weatherData.description}\n\n${weatherData.tip}`;
        const options = [
            { text: '📅 Прогноз на неделю', value: 'weekly_forecast' },
            { text: '🌡️ Детальная информация', value: 'detailed_weather' },
            { text: '🎯 Рекомендации по погоде', value: 'weather_recommendations' }
        ];
        this.sendBotMessage(message, options);
    },
    
    // Handle events inquiry
    handleEventsInquiry() {
        const events = this.getTodayEvents();
        let message = "📅 **События в Саратове сегодня:**\n\n";
        
        events.forEach(event => {
            message += `🎭 **${event.name}**\n`;
            message += `📍 ${event.location}\n`;
            message += `⏰ ${event.time}\n`;
            message += `💰 ${event.price}\n\n`;
        });
        
        const options = [
            { text: '📅 События на неделю', value: 'weekly_events' },
            { text: '🎫 Купить билеты', value: 'buy_tickets' },
            { text: '🔔 Подписаться на уведомления', value: 'subscribe_events' }
        ];
        this.sendBotMessage(message, options);
    },
    
    // Handle history inquiry
    handleHistoryInquiry(intent) {
        const historyFacts = this.getHistoryFacts();
        const randomFact = historyFacts[Math.floor(Math.random() * historyFacts.length)];
        
        let message = `📚 **Интересный факт о Саратове:**\n\n${randomFact.fact}\n\n${randomFact.details}`;
        
        const options = [
            { text: '📖 Еще факты', value: 'more_facts' },
            { text: '🏛️ Исторические места', value: 'historical_places' },
            { text: '👨‍🎓 Известные люди', value: 'famous_people' }
        ];
        this.sendBotMessage(message, options);
    },
    
    // Handle shopping inquiry
    handleShoppingInquiry(intent) {
        const message = "🛍️ Отлично! Я помогу вам найти лучшие места для шопинга в Саратове. Что вас интересует?";
        const options = [
            { text: '🏬 Торговые центры', value: 'shopping_malls' },
            { text: '🛒 Рынки', value: 'markets' },
            { text: '👕 Одежда и мода', value: 'fashion' },
            { text: '🍎 Продукты', value: 'groceries' },
            { text: '🎁 Сувениры', value: 'souvenirs' }
        ];
        this.sendBotMessage(message, options);
    },
    
    // Handle sports inquiry
    handleSportsInquiry(intent) {
        const message = "🏃‍♂️ Прекрасно! В Саратове есть отличные спортивные объекты. Что вас интересует?";
        const options = [
            { text: '⚽ Футбол', value: 'football' },
            { text: '🏒 Хоккей', value: 'hockey' },
            { text: '🏊‍♀️ Плавание', value: 'swimming' },
            { text: '🎿 Зимние виды спорта', value: 'winter_sports' },
            { text: '💪 Фитнес', value: 'fitness' }
        ];
        this.sendBotMessage(message, options);
    },
    
    // Handle transport inquiry
    handleTransportInquiry(intent) {
        const message = "🚗 Отлично! Я помогу вам с транспортом в Саратове. Что вам нужно?";
        const options = [
            { text: '🚂 Железнодорожный вокзал', value: 'railway' },
            { text: '✈️ Аэропорт', value: 'airport' },
            { text: '🚌 Автовокзал', value: 'bus_station' },
            { text: '🚕 Такси', value: 'taxi' },
            { text: '🚌 Общественный транспорт', value: 'public_transport' }
        ];
        this.sendBotMessage(message, options);
    },
    
    // Handle general question
    handleGeneralQuestion(intent) {
        const responses = [
            "🤔 Интересный вопрос! Я постараюсь помочь вам. Можете уточнить, что именно вас интересует?",
            "💭 Хороший вопрос! Давайте разберемся вместе. О чем бы вы хотели узнать подробнее?",
            "🧠 Отличный вопрос! Я знаю много интересного о Саратове. Что конкретно вас интересует?",
            "✨ Интересно! Я готова поделиться знаниями о нашем городе. Уточните, пожалуйста, детали."
        ];
        
        const randomResponse = responses[Math.floor(Math.random() * responses.length)];
        const options = [
            { text: '🍽️ Где поесть', value: 'food' },
            { text: '🏛️ Что посмотреть', value: 'sights' },
            { text: '🎭 События', value: 'events' },
            { text: '📚 История города', value: 'history' }
        ];
        this.sendBotMessage(randomResponse, options);
    },
    
    // Handle general response with improved logic
    handleGeneralResponse(response) {
        const lowerResponse = response.toLowerCase();
        
        // Greeting responses
        if (lowerResponse.includes('привет') || lowerResponse.includes('здравствуй') || lowerResponse.includes('добр')) {
            const greetings = [
                "Привет! 👋 Я Сара, ваш персональный гид по Саратову! Рада познакомиться!",
                "Здравствуйте! 😊 Добро пожаловать в Саратов! Я помогу вам открыть все секреты нашего города!",
                "Привет! 🌟 Я Сара, и я знаю все самые интересные места в Саратове. Что вас интересует?",
                "Добро пожаловать! 🎉 Я Сара, ваш AI-гид. Готовы к удивительному путешествию по Саратову?"
            ];
            const greeting = greetings[Math.floor(Math.random() * greetings.length)];
            this.sendBotMessage(greeting, [
                { text: 'Показать достопримечательности', value: 'attractions' },
                { text: 'Где поесть?', value: 'food' },
                { text: 'События сегодня', value: 'events' },
                { text: '🚀 Поехали!', value: 'start' }
            ]);
            return;
        }
        
        // Thank you responses
        if (lowerResponse.includes('спасибо') || lowerResponse.includes('благодар')) {
            const thanks = [
                "Пожалуйста! 😊 Рада была помочь! Есть еще вопросы о Саратове?",
                "Не за что! 🌟 Всегда готова помочь с планированием вашего визита!",
                "Обращайтесь! 💫 Я здесь, чтобы сделать ваше знакомство с Саратовом незабываемым!"
            ];
            const thankYou = thanks[Math.floor(Math.random() * thanks.length)];
            this.sendBotMessage(thankYou, [
                { text: 'Показать еще места', value: 'attractions' },
                { text: 'Погода', value: 'weather' },
                { text: 'События', value: 'events' }
            ]);
            return;
        }
        
        // Confusion responses
        if (lowerResponse.includes('не понимаю') || lowerResponse.includes('не знаю') || lowerResponse.includes('что')) {
            const confusion = [
                "Не переживайте! 😊 Давайте я помогу вам разобраться. О чем именно вы хотели бы узнать?",
                "Все в порядке! 🤗 Я здесь, чтобы помочь. Расскажите, что вас интересует в Саратове?",
                "Давайте начнем с простого! 😌 Что бы вы хотели сделать в Саратове?"
            ];
            const confused = confusion[Math.floor(Math.random() * confusion.length)];
            this.sendBotMessage(confused, [
                { text: 'Достопримечательности', value: 'attractions' },
                { text: 'Рестораны и кафе', value: 'food' },
                { text: 'Парки и скверы', value: 'parks' },
                { text: 'Музеи', value: 'museums' }
            ]);
            return;
        }
        
        // Default responses with personality - but only if no specific intent detected
        const responses = [
            "Интересно! 🤔 Расскажите больше о том, что вас привлекает в Саратове?",
            "Понятно! 😊 Чем еще могу помочь с планированием вашего визита?",
            "Хорошо! 🌟 Есть ли конкретные места, которые вы хотели бы посетить?",
            "Отлично! 💫 Давайте составим идеальный маршрут для вас!",
            "Прекрасно! 🎯 Я знаю много интересного о Саратове. Что вас больше всего интересует?",
            "Замечательно! 🌈 Саратов - удивительный город с богатой историей. О чем бы вы хотели узнать?"
        ];
        
        const randomResponse = responses[Math.floor(Math.random() * responses.length)];
        const options = [
            { text: '🏛️ Достопримечательности', value: 'attractions' },
            { text: '🍽️ Где поесть', value: 'food' },
            { text: '🌤️ Погода', value: 'weather' },
            { text: '📅 События', value: 'events' },
            { text: '🚀 Поехали!', value: 'start' }
        ];
        
        this.sendBotMessage(randomResponse, options);
    },

    // Handle follow-up responses
    handleFollowUpResponse(response, lastBotMessage) {
        const lowerResponse = response.toLowerCase();
        
        // If asking about places
        if (lastBotMessage.includes('места') || lastBotMessage.includes('достопримечательности')) {
            if (lowerResponse.includes('да') || lowerResponse.includes('конечно') || lowerResponse.includes('хочу')) {
                this.sendBotMessage("Отлично! 🎉 Вот мои рекомендации по самым интересным местам Саратова:", [
                    { text: 'Саратовская консерватория', value: 'conservatory' },
                    { text: 'Набережная Космонавтов', value: 'embankment' },
                    { text: 'Парк Победы', value: 'victory_park' },
                    { text: 'Музей Радищева', value: 'radishchev_museum' }
                ]);
            } else {
                this.sendBotMessage("Понятно! 😊 Тогда что вас больше интересует?", [
                    { text: '🍽️ Рестораны', value: 'food' },
                    { text: '🌤️ Погода', value: 'weather' },
                    { text: '📅 События', value: 'events' }
                ]);
            }
            return;
        }
        
        // If asking about food
        if (lastBotMessage.includes('еда') || lastBotMessage.includes('ресторан') || lastBotMessage.includes('кафе')) {
            if (lowerResponse.includes('да') || lowerResponse.includes('конечно') || lowerResponse.includes('хочу')) {
                this.sendBotMessage("Прекрасно! 🍽️ Вот лучшие места для еды в Саратове:", [
                    { text: 'Кофейня Гагарин', value: 'gagarin_cafe' },
                    { text: 'Ресторан Старый город', value: 'old_city_restaurant' },
                    { text: 'Пиццерия Итальяно', value: 'italiano_pizza' },
                    { text: 'Кафе Прокофий', value: 'prokofy_cafe' }
                ]);
            } else {
                this.sendBotMessage("Хорошо! 😊 Тогда чем еще могу помочь?", [
                    { text: '🏛️ Достопримечательности', value: 'attractions' },
                    { text: '🌤️ Погода', value: 'weather' },
                    { text: '📅 События', value: 'events' }
                ]);
            }
            return;
        }
        
        // Default follow-up
        this.handleGeneralResponse(response);
    },
    
    // Get weather information
    getWeatherInfo() {
        const weatherConditions = [
            {
                description: "☀️ Ясно, +22°C\n💨 Ветер: 3 м/с\n💧 Влажность: 45%",
                tip: "💡 Отличная погода для прогулок! Рекомендую посетить Набережную Космонавтов или Парк Победы."
            },
            {
                description: "⛅ Переменная облачность, +18°C\n💨 Ветер: 5 м/с\n💧 Влажность: 60%",
                tip: "💡 Хорошая погода для посещения музеев или кафе. Возьмите легкую куртку."
            },
            {
                description: "🌧️ Дождь, +15°C\n💨 Ветер: 7 м/с\n💧 Влажность: 85%",
                tip: "💡 Дождливая погода - идеальное время для музеев, театров или уютных кафе."
            }
        ];
        
        return weatherConditions[Math.floor(Math.random() * weatherConditions.length)];
    },
    
    // Get today's events
    getTodayEvents() {
        return [
            {
                name: "Концерт в консерватории",
                location: "Саратовская консерватория",
                time: "19:00",
                price: "500-1500₽"
            },
            {
                name: "Выставка в Радищевском музее",
                location: "Радищевский музей",
                time: "10:00-18:00",
                price: "200₽"
            },
            {
                name: "Спектакль в ТЮЗе",
                location: "ТЮЗ им. Киселева",
                time: "18:30",
                price: "300-800₽"
            }
        ];
    },
    
    // Get history facts
    getHistoryFacts() {
        return [
            {
                fact: "Саратов был основан в 1590 году как крепость для защиты южных границ России.",
                details: "Город получил свое название от тюркского 'сары тау' - 'желтая гора', что связано с цветом местных холмов."
            },
            {
                fact: "В Саратове родился и учился первый космонавт Юрий Гагарин.",
                details: "Гагарин учился в Саратовском индустриальном техникуме и впервые увидел самолет в местном аэроклубе."
            },
            {
                fact: "Саратовский цирк - первый стационарный цирк в России, основанный в 1876 году.",
                details: "Здание цирка построено по проекту архитектора Петра Зыбина и является памятником архитектуры."
            },
            {
                fact: "Радищевский музей - первый общедоступный художественный музей в провинции России.",
                details: "Музей основан в 1885 году внуком писателя А.Н. Радищева и содержит уникальную коллекцию русской живописи."
            }
        ];
    },
    
    // Show more recommendations
    showMoreRecommendations() {
        const allPlaces = [
            ...this.places.cafes,
            ...this.places.restaurants,
            ...this.places.parks,
            ...this.places.museums,
            ...this.places.entertainment,
            ...this.places.shopping,
            ...this.places.sports,
            ...this.places.transport
        ];
        
        // Get random places
        const shuffled = allPlaces.sort(() => 0.5 - Math.random());
        const moreRecommendations = shuffled.slice(0, 5);
        
        let message = "🌟 **Дополнительные рекомендации:**\n\n";
        
        moreRecommendations.forEach((place, index) => {
            message += `${index + 1}. **${place.name}**\n`;
            message += `📍 ${place.address}\n`;
            message += `⭐ Рейтинг: ${place.rating}\n`;
            message += `💬 ${place.description}\n`;
            if (place.priceRange) {
                message += `💰 ${place.priceRange}\n`;
            }
            message += '\n';
        });
        
        const options = [
            { text: '🔄 Другие варианты', value: 'restart' },
            { text: '💾 Сохранить маршрут', value: 'save' },
            { text: '🗺️ Показать на карте', value: 'show_map' }
        ];
        
        this.sendBotMessage(message, options);
    },
    
    // Show place details
    showPlaceDetails(placeId) {
        const allPlaces = [
            ...this.places.cafes,
            ...this.places.restaurants,
            ...this.places.parks,
            ...this.places.museums,
            ...this.places.entertainment,
            ...this.places.shopping,
            ...this.places.sports,
            ...this.places.transport
        ];
        
        const place = allPlaces.find(p => p.name.toLowerCase().includes(placeId.toLowerCase()));
        
        if (place) {
            let message = `📍 **${place.name}**\n\n`;
            message += `🏷️ Тип: ${place.type}\n`;
            message += `📍 Адрес: ${place.address}\n`;
            message += `⭐ Рейтинг: ${place.rating}\n`;
            message += `💬 ${place.description}\n`;
            
            if (place.priceRange) {
                message += `💰 Цены: ${place.priceRange}\n`;
            }
            
            if (place.workingHours) {
                message += `🕒 Часы работы: ${place.workingHours}\n`;
            }
            
            if (place.specialties) {
                message += `🍽️ Специализация: ${place.specialties.join(', ')}\n`;
            }
            
            if (place.features) {
                message += `✨ Особенности: ${place.features.join(', ')}\n`;
            }
            
            const options = [
                { text: '🗺️ Показать на карте', value: 'show_map' },
                { text: '📞 Позвонить', value: 'call' },
                { text: '🔄 Другие места', value: 'more' }
            ];
            
            this.sendBotMessage(message, options);
        } else {
            this.sendBotMessage("Извините, не удалось найти информацию об этом месте. Попробуйте выбрать другое место.", []);
        }
    },
    
    // Restart chat
    restart() {
        this.currentState = 'greeting';
        this.userPreferences = {
            category: null,
            budget: null,
            time: null,
            companions: null
        };
        this.conversationHistory = []; // Clear conversation history
        this.sendBotMessage("Давайте начнем сначала! Что вас интересует?", []);
        this.askCategory();
    },

    // Specific option handlers
    handleAttractionsClick() {
        this.sendBotMessage("🏛️ Отлично! В Саратове есть множество удивительных мест! Вот мои рекомендации:", [
            { text: 'Саратовская консерватория', value: 'conservatory' },
            { text: 'Набережная Космонавтов', value: 'embankment' },
            { text: 'Парк Победы', value: 'victory_park' },
            { text: 'Музей Радищева', value: 'radishchev_museum' }
        ]);
    },

    handleFoodClick() {
        this.sendBotMessage("🍽️ Прекрасно! Я знаю лучшие места для еды в Саратове! Что вас интересует?", [
            { text: '☕ Кофейни', value: 'cafes' },
            { text: '🍕 Рестораны', value: 'restaurants' },
            { text: '🍰 Десерты', value: 'desserts' },
            { text: '🌮 Быстрая еда', value: 'fastfood' }
        ]);
    },

    handleWeatherClick() {
        const weatherData = this.getWeatherInfo();
        this.sendBotMessage(`🌤️ **Погода в Саратове сегодня:**\n\n${weatherData.description}\n\n${weatherData.tip}`, [
            { text: '🏛️ Достопримечательности', value: 'attractions' },
            { text: '🌳 Парки', value: 'parks' },
            { text: '🍽️ Рестораны', value: 'food' }
        ]);
    },

    handleEventsClick() {
        const events = this.getTodayEvents();
        this.sendBotMessage(`📅 Сегодня в Саратове:\n\n${events}\n\nХотите узнать о событиях на завтра?`, [
            { text: '📅 События на завтра', value: 'tomorrow_events' },
            { text: '🎭 Культурные мероприятия', value: 'cultural_events' },
            { text: '🎪 Развлечения', value: 'entertainment' }
        ]);
    },

    handleStartClick() {
        this.currentState = 'askCategory';
        this.askCategory();
    },

    handleCafesClick() {
        this.sendBotMessage("☕ Отличный выбор! Вот лучшие кофейни Саратова:", [
            { text: 'Кофейня Гагарин', value: 'gagarin_cafe' },
            { text: 'Coffee Bean', value: 'coffee_bean' },
            { text: 'Шоколадница', value: 'shokoladnitsa' }
        ]);
    },

    handleRestaurantsClick() {
        this.sendBotMessage("🍕 Прекрасно! Вот лучшие рестораны Саратова:", [
            { text: 'Ресторан Старый город', value: 'old_city_restaurant' },
            { text: 'Пиццерия Итальяно', value: 'italiano_pizza' },
            { text: 'Кафе Прокофий', value: 'prokofy_cafe' }
        ]);
    },

    handleDessertsClick() {
        this.sendBotMessage("🍰 Сладкоежкам на заметку! Вот где можно полакомиться десертами:", [
            { text: 'Шоколадница', value: 'shokoladnitsa' },
            { text: 'Кофейня Гагарин', value: 'gagarin_cafe' },
            { text: 'Coffee Bean', value: 'coffee_bean' }
        ]);
    },

    handleFastFoodClick() {
        this.sendBotMessage("🌮 Быстро и вкусно! Вот лучшие места для быстрого перекуса:", [
            { text: 'Пиццерия Итальяно', value: 'italiano_pizza' },
            { text: 'Бургерные', value: 'burgers' },
            { text: 'Стрит-фуд', value: 'street_food' }
        ]);
    },

    handleEveningClick() {
        this.sendBotMessage("🍷 Вечерние заведения Саратова ждут вас! Вот лучшие варианты:", [
            { text: 'Кафе Прокофий', value: 'prokofy_cafe' },
            { text: 'Барные', value: 'bars' },
            { text: 'Клубы', value: 'clubs' }
        ]);
    },

    handleConservatoryClick() {
        this.sendBotMessage(`🎼 **Саратовская консерватория** - настоящая жемчужина города!

📍 **Адрес:** пр. Кирова, 1
⏰ **Время работы:** 10:00-18:00 (экскурсии)
📞 **Телефон:** +7 (845) 123-45-67
⭐ **Рейтинг:** 4.9/5

**История:** Первая консерватория в российской провинции, основана в 1912 году. Здесь выступали многие знаменитые музыканты.

**Что посмотреть:**
• Архитектура в стиле модерн
• Концертный зал на 1000 мест
• Музей музыкальных инструментов

**Концерты:** Расписание на сайте консерватории
**Экскурсии:** 200₽ с человека, группы до 15 человек
**Как добраться:** 5 минут пешком от остановки "Проспект Кирова"`, [
            { text: '📅 Расписание концертов', value: 'conservatory_concerts' },
            { text: '🎫 Купить билеты', value: 'conservatory_tickets' },
            { text: '🗺️ Построить маршрут', value: 'conservatory_route' },
            { text: '🏛️ Другие места', value: 'attractions' }
        ]);
    },

    handleEmbankmentClick() {
        this.sendBotMessage(`🌊 **Набережная Космонавтов** - одно из самых красивых мест Саратова!

📍 **Адрес:** Набережная Космонавтов
⏰ **Время работы:** Круглосуточно
⭐ **Рейтинг:** 4.8/5

**История:** Здесь приземлился Юрий Гагарин после первого космического полета. Отсюда открывается потрясающий вид на Волгу.

**Что посмотреть:**
• Памятник Гагарину
• Смотровая площадка
• Красивый вид на Волгу
• Прогулочная зона

**Лучшее время:** Закат (19:00-20:00) для фото
**Фото-точки:** Памятник Гагарину, смотровая площадка
**Как добраться:** 10 минут пешком от центра города`, [
            { text: '🚀 История Гагарина', value: 'gagarin_history' },
            { text: '📸 Фото-точки', value: 'embankment_photos' },
            { text: '🗺️ Построить маршрут', value: 'embankment_route' },
            { text: '🏛️ Другие места', value: 'attractions' }
        ]);
    },

    handleVictoryParkClick() {
        this.sendBotMessage(`🏛️ **Парк Победы** - музей под открытым небом!

📍 **Адрес:** ул. Соколовая, 160
⏰ **Время работы:** 08:00-22:00
⭐ **Рейтинг:** 4.7/5

**Особенности:** Уникальная коллекция военной техники и памятников. Отличное место для прогулок и изучения истории.

**Что посмотреть:**
• Военная техника времен ВОВ
• Памятники героям
• Аллея славы
• Музей военной техники

**Экскурсии:** 150₽ с человека, группы до 20 человек
**Время работы музея:** 10:00-18:00
**Как добраться:** 15 минут пешком от остановки "Соколовая"`, [
            { text: '🚁 Военная техника', value: 'victory_park_equipment' },
            { text: '🎯 Записаться на экскурсию', value: 'victory_park_tour' },
            { text: '🗺️ Построить маршрут', value: 'victory_park_route' },
            { text: '🏛️ Другие места', value: 'attractions' }
        ]);
    },

    handleRadishchevMuseumClick() {
        this.sendBotMessage(`🎨 **Музей Радищева** - первый общедоступный художественный музей в провинции России!

📍 **Адрес:** ул. Радищева, 39
⏰ **Время работы:** 10:00-18:00 (вт-вс)
📞 **Телефон:** +7 (845) 567-89-01
⭐ **Рейтинг:** 4.8/5

**Особенности:** Богатая коллекция живописи, скульптуры и декоративно-прикладного искусства.

**Коллекция:**
• Русская живопись XVIII-XX веков
• Западноевропейская живопись
• Скульптура и графика
• Декоративно-прикладное искусство

**Стоимость:** 200₽ взрослый, 100₽ льготный
**Экскурсии:** 300₽ с группы до 15 человек
**Как добраться:** 8 минут пешком от остановки "Радищева"`, [
            { text: '🖼️ Посмотреть коллекцию', value: 'radishchev_collection' },
            { text: '📅 Расписание выставок', value: 'radishchev_exhibitions' },
            { text: '🗺️ Построить маршрут', value: 'radishchev_route' },
            { text: '🏛️ Другие музеи', value: 'museums' }
        ]);
    },

    handleGagarinCafeClick() {
        this.sendBotMessage(`☕ **Кофейня Гагарин** - уютное место в космическом стиле!

📍 **Адрес:** пр. Кирова, 25
⏰ **Время работы:** 08:00-23:00
📞 **Телефон:** +7 (845) 123-45-67
⭐ **Рейтинг:** 4.9/5

**Что попробовать:**
• Авторский кофе от 150₽
• Десерты от 200₽
• Завтраки от 300₽

**Особенности:** Атмосфера напоминает о космических достижениях Саратова. Здесь подают лучший кофе в городе и вкусные десерты.

**Как добраться:** 5 минут пешком от остановки "Проспект Кирова"`, [
            { text: '🍽️ Посмотреть меню', value: 'gagarin_menu' },
            { text: '📞 Позвонить', value: 'gagarin_call' },
            { text: '🗺️ Построить маршрут', value: 'gagarin_route' },
            { text: '🏛️ Другие места', value: 'attractions' }
        ]);
    },

    handleOldCityRestaurantClick() {
        this.sendBotMessage(`🍽️ **Ресторан Старый город** - атмосферное место с отличной кухней!

📍 **Адрес:** ул. Московская, 84
⏰ **Время работы:** 12:00-24:00
📞 **Телефон:** +7 (845) 234-56-78
⭐ **Рейтинг:** 4.7/5

**Кухня:**
• Русская кухня от 400₽
• Европейская кухня от 500₽
• Бизнес-ланчи от 350₽

**Особенности:** Историческая обстановка, живая музыка по вечерам, отличное вино.

**Как добраться:** 3 минуты пешком от остановки "Московская"`, [
            { text: '🍽️ Посмотреть меню', value: 'old_city_menu' },
            { text: '📞 Забронировать столик', value: 'old_city_reservation' },
            { text: '🗺️ Построить маршрут', value: 'old_city_route' },
            { text: '🍽️ Другие рестораны', value: 'restaurants' }
        ]);
    },

    handleItalianoPizzaClick() {
        this.sendBotMessage(`🍕 **Пиццерия Итальяно** - самая вкусная пицца в Саратове!

📍 **Адрес:** ул. Вольская, 55
⏰ **Время работы:** 11:00-23:00
📞 **Телефон:** +7 (845) 345-67-89
⭐ **Рейтинг:** 4.6/5

**Популярные пиццы:**
• Маргарита от 350₽
• Пепперони от 450₽
• Четыре сыра от 400₽

**Особенности:** Свежие ингредиенты, традиционные рецепты, уютная атмосфера. Есть доставка!

**Доставка:** 30-45 минут, от 200₽ бесплатно
**Как добраться:** 7 минут пешком от остановки "Вольская"`, [
            { text: '🍕 Посмотреть меню', value: 'italiano_menu' },
            { text: '🚚 Заказать доставку', value: 'italiano_delivery' },
            { text: '🗺️ Построить маршрут', value: 'italiano_route' },
            { text: '🍽️ Другие рестораны', value: 'restaurants' }
        ]);
    },

    handleProkofyCafeClick() {
        this.sendBotMessage(`🎵 **Кафе Прокофий** - атмосферное место с живой музыкой!

📍 **Адрес:** ул. Советская, 17
⏰ **Время работы:** 10:00-02:00
📞 **Телефон:** +7 (845) 456-78-90
⭐ **Рейтинг:** 4.8/5

**Меню:**
• Коктейли от 250₽
• Бизнес-ланчи от 300₽
• Вечерние блюда от 400₽

**Особенности:** Живая музыка по вечерам, романтическая атмосфера, отличные коктейли.

**Концерты:** Каждый вечер с 20:00
**Как добраться:** 2 минуты пешком от остановки "Советская"`, [
            { text: '🎵 Расписание концертов', value: 'prokofy_concerts' },
            { text: '🍸 Посмотреть меню', value: 'prokofy_menu' },
            { text: '🗺️ Построить маршрут', value: 'prokofy_route' },
            { text: '🍽️ Другие кафе', value: 'cafes' }
        ]);
    }
};

// Initialize chatbot when AI section is loaded
// function initChatBot() {
//     ChatBot.init();
// }

// Export for global use
// window.ChatBot = ChatBot;
// ========== ИСПРАВЛЕНИЕ ГЛОБАЛЬНЫХ ФУНКЦИЙ ==========
let chatbotInitialized = false;

window.handleChatMessage = function(message) {
    if (!message || !message.trim()) return;
    
    if (window.ChatBot && !chatbotInitialized) {
        chatbotInitialized = true;
        ChatBot.init();
    }
    
    setTimeout(() => {
        if (window.ChatBot) {
            ChatBot.processUserResponse(message.trim(), 'text');
        }
    }, 100);
};

window.voiceInput = function() {
    window.handleChatMessage("Голосовой ввод");
};

window.ChatBot = ChatBot;

console.log('ChatBot.js загружен');