# Саратов — гид по городу

Веб-приложение и REST API городского гида по Саратову: каталог заведений, достопримечательностей,
отелей, экскурсий, гидов и событий, избранное с push-уведомлениями и AI-помощник,
который отвечает на вопросы по данным города.

---

## 1. Назначение решения

Решение закрывает две задачи:

- **Публичная часть** — пользователь на сайте выбирает, куда пойти: листает каталог, открывает
  карточку объекта, смотрит расписание и адрес на карте, сохраняет объекты в избранное.
- **Мобильный клиент** — тот же каталог и избранное отдаются через REST API (`/api/v1`, `/api/v2`)
  с авторизацией по Sanctum, чтобы приложение на телефоне работало с теми же данными.

Дополнительно администратор ведёт контент через админ-панель MoonShine: создаёт и редактирует
объекты, расписания, события и заявки на экскурсии.

AI-помощник («Саратов») — диалог поверх данных каталога: пользователь спрашивает на естественном
языке, модель формирует ответ с опорой на записи из базы.

**Ключевые файлы:**

| Что | Где |
|---|---|
| Веб-маршруты | `routes/web.php` |
| API v1 и v2 | `routes/api.php` |
| Авторизация (веб) | `routes/auth.php` |
| Админ-панель | `app/MoonShine/` |
| AI-помощник | `app/Livewire/SaratovAi.php`, `app/Jobs/PromptAgent.php` |
| Модели данных | `app/Models/` |
| Миграции | `database/migrations/` |
| Тестовые данные | `database/seeders/` |

---

## 2. Основной пользовательский сценарий

**Сценарий A — каталог и избранное (основной):**

1. Пользователь открывает `/` и видит главную страницу гида.
2. Переходит в раздел каталога: `/restaurants`, `/attractions`, `/hotels`, `/excursions`,
   `/guided-tours`, `/events`.
3. Открывает карточку объекта (например, `/restaurants/{id}`): описание, фотографии,
   расписание, адрес и точка на карте Яндекса.
4. Нажимает «В избранное». Если пользователь не авторизован — сайт предлагает войти.
5. Проходит регистрацию/вход (VK ID или email + пароль).
6. Возвращается к объекту, добавляет его в избранное — кнопка переключается в активное состояние.
7. Открывает `/profile/favorites` и видит сохранённый объект в личном кабинете.

**Сценарий B — AI-помощник:**

1. Пользователь авторизован и находится на главной странице или в любом разделе каталога
   (блок «Саратов» подключён на всех страницах списков).
2. Вводит вопрос в чат, например: «Куда сходить с детьми в Саратове?».
3. Сообщение уходит в очередь, в интерфейсе появляется индикатор ожидания.
4. Ответ модели появляется в чате; история диалога сохраняется и доступна при следующем входе.

> Блок AI-помощника гостю показывает сообщение «Для использования бота необходимо авторизоваться
> в аккаунте» — чат работает только для авторизованных пользователей
> (`app/Livewire/SaratovAi.php:39`).

---

## 3. Состав и архитектура решения

Одно Laravel-приложение, обслуживающее и веб-интерфейс, и API.

**Стек:**

| Слой | Технология |
|---|---|
| Бэкенд | Laravel 12, PHP ≥ 8.2 |
| Веб-интерфейс | Livewire 3 + Volt (Blade), рендеринг на сервере |
| Админ-панель | MoonShine 4 (`moonshine/multi-panels` — отдельная панель под гидов) |
| API | REST, документирование через `dedoc/scramble`, токены Laravel Sanctum + refresh-токены |
| Фронтенд-сборка | Vite 7 + Tailwind CSS 4, точки входа в `vite.config.js` |
| Очереди | `QUEUE_CONNECTION=database`, Horizon для наблюдаемости |
| Наблюдаемость | Pulse, Telescope |
| Фоновые задачи | `app/Jobs/` — `PromptAgent`, уведомления, чистка FCM-токенов |

**Компоненты:**

- **Веб-публичная часть** — каталог и карточки объектов, личный кабинет, авторизация.
- **API** — `/api/v1` (полный набор: контент, авторизация, избранное, посещения, AI-чат, contact-us)
  и `/api/v2` (списки с пагинацией, единая выдача сущностей для карты).
- **Админ-панель** — MoonShine: сущности, расписания, события, заявки, пользователи, загрузка фото.
- **AI-подсистема** — агент `SaratovAiModel`, очередь `PromptAgent`, сборка системного промпта
  из данных БД (`app/Services/SystemPromptDataService.php`).
- **Уведомления** — Firebase Cloud Messaging (`app/Notifications/`), push о новых событиях
  в избранном и о приближении события.

**Сущности данных** (`app/Models/`): `User`, `Restaurant`, `Attraction`, `Hotel`, `Excursion`,
`ExcursionPoint`, `GuidedTour`, `Event`, `Category`, `Schedule`, `ScheduleRecord`,
`CustomLocation`, `CustomPoint`, `Favorite`, `PlaceVisit`, `HistoryView`, `Attachment`,
`ContactUs`, `GuideTourApplication`, `FirebaseDeviceToken`.

---

## 4. Запуск всех локальных компонентов одной командой

Скопируйте `.env.example` в `.env` и **пропишите в `.env` значения, которых нет в `.env.example`**
(см. раздел 6 — они обязательны для сборки и для проброса портов):

```env
APP_KEY=

WWWUSER=1000
WWWGROUP=1000

APP_PORT=8000
VITE_PORT=5173
FORWARD_DB_PORT=3306
FORWARD_REDIS_PORT=6379
ADMINER_PORT=3000

DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=saratov
DB_USERNAME=sail
DB_PASSWORD=password

REDIS_HOST=redis
APP_URL=http://localhost:8000

ANTHROPIC_API_KEY=YOUR_KEY
YMAP_API_KEY=YOUR_KEY
```

Затем:

```bash
cp .env.example .env
docker compose up -d
```

Поднимаются четыре компонента (`compose.yaml`):

| Сервис | Что это |
|---|---|
| `laravel.test` | PHP 8.4 + nginx, образ `sail-8.4/app`, корень проекта смонтирован в `/var/www/html` |
| `mysql` | MySQL 8.4, данные в томе `sail-mysql` |
| `redis` | Redis alpine, данные в томе `sail-redis` |
| `adminer` | Веб-интерфейс управления БД |

Далее — первичная инициализация приложения (один раз):

```bash
docker compose exec laravel.test composer install
docker compose exec laravel.test npm install
docker compose exec laravel.test php artisan key:generate
docker compose exec laravel.test php artisan migrate --seed
docker compose exec laravel.test npm run build
```

И запуск процесса приложения (два отдельных терминала):

```bash
# Терминал 1 — веб-сервер
docker compose exec laravel.test php artisan serve --host=0.0.0.0 --port=8000

# Терминал 2 — воркер очереди (обязателен для AI-чата и уведомлений)
docker compose exec laravel.test php artisan queue:work
```

Приложение доступно на `http://localhost:8000`.

> В Sail PHP отдаётся и через nginx на порту 80 внутри контейнера (`APP_PORT` пробрасывает
> `80:80`). Команда `artisan serve` на порту 8000 удобнее для разработки и используется
> в сценарии проверки ниже. Админка MoonShine доступна по адресу, который выводит
> `artisan serve` (по умолчанию `http://localhost:8000/admin/login`).

---

## 5. Необходимые параметры окружения

| Параметр | Требование | Назначение |
|---|---|---|
| Docker Engine | 24+ | Сборка и запуск контейнера `laravel.test` |
| Docker Compose | v2 (плагин `compose`) | Интерпретация `compose.yaml` |
| PHP | ≥ 8.2 (в образе 8.4) | Требуется `composer.json` |
| Composer | 2.x | Установка PHP-зависимостей |
| Node.js | 20+ | Сборка фронтенда (Vite 7) |
| npm | 10+ | Установка JS-зависимостей |
| Свободные порты хоста | 8000, 5173, 3306, 6379, 3000 | Проброс контейнерных портов |
| Доступ в интернет | нужен при первом запуске | Скачивание образов, Composer/npm, обращения к внешним API |

**Права на каталоги:** `storage/` и `bootstrap/cache/` должны быть доступны пользователю
контейнера (`WWWUSER=1000`, `WWWGROUP=1000` в `.env`). На Linux-хосте, где UID/GID пользователя
не равен 1000, выставьте в `.env` собственные значения `WWWUSER` и `WWWGROUP` — иначе
`docker/8.4/Dockerfile` не сможет создать пользователя `sail` и сборка образа упадёт.

---

## 6. Переменные окружения

Файл `.env` создаётся из `.env.example`. Часть переменных в `.env.example` **отсутствует** —
их нужно дописать вручную (готовый блок — в разделе 4). Значения, отмеченные как
**обязательные**, задаются до `php artisan migrate --seed`.

### Обязательные

| Переменная | Пример | Зачем |
|---|---|---|
| `APP_KEY` | base64-ключ | Шифрование сессий и подписей. Генерируется `php artisan key:generate` |
| `DB_CONNECTION` | `mysql` | Тип подключения к БД |
| `DB_HOST` | `mysql` | Имя сервиса MySQL в docker-сети `sail` |
| `DB_DATABASE` | `saratov` | Имя базы (создаётся автоматически) |
| `DB_USERNAME` | `sail` | Пользователь БД (создаётся автоматически) |
| `DB_PASSWORD` | `password` | Пароль пользователя и root в контейнере MySQL |
| `WWWUSER` | `1000` | UID пользователя `sail` внутри контейнера |
| `WWWGROUP` | `1000` | GID группы `sail` внутри контейнера |

### Нужны для полного сценария

| Переменная | Где используется | Зачем |
|---|---|---|
| `ANTHROPIC_API_KEY` | `config/ai.php` | Ключ модели для AI-помощника. Провайдер выбирается `AI_LAB_NAME` (по умолчанию `anthropic`) |
| `YMAP_API_KEY` | карта Яндекса на публичных страницах | Отрисовка карт и геокодирование |
| `APP_URL` | генерация ссылок | Должен совпадать с фактическим адресом приложения, включая порт |

### Прочие (значения по умолчанию рабочие)

| Переменная | По умолчанию | Назначение |
|---|---|---|
| `APP_NAME` | `Laravel` | Название приложения в шапке и письмах |
| `APP_ENV` | `local` | Окружение Laravel |
| `APP_DEBUG` | `true` | Показ отладочных страниц |
| `APP_LOCALE` / `APP_FALLBACK_LOCALE` / `APP_FAKER_LOCALE` | `ru` / `en` / `ru_RU` | Локализация интерфейса и данных сидеров |
| `APP_PORT` | 8000 | Порт веб-приложения на хосте. **Нет в `.env.example`** |
| `VITE_PORT` | 5173 | Порт dev-сервера Vite. **Нет в `.env.example`** |
| `FORWARD_DB_PORT` | 3306 | Проброс MySQL на хост. **Нет в `.env.example`** |
| `FORWARD_REDIS_PORT` | 6379 | Проброс Redis на хост. **Нет в `.env.example`** |
| `ADMINER_PORT` | 3000 | Проброс Adminer на хост. **Нет в `.env.example`** |
| `SESSION_DRIVER` | `database` | Где хранятся сессии |
| `CACHE_STORE` | `database` | Где хранится кэш |
| `QUEUE_CONNECTION` | `database` | Где хранится очередь задач |
| `REDIS_HOST` | `127.0.0.1` | Redis. Внутри контейнера укажите `redis` |
| `MAIL_MAILER` | `log` | Письма пишутся в лог, SMTP не нужен |
| `FILESYSTEM_DISK` | `local` | Диск для загруженных файлов |
| `VK_CLIENT_ID` / `VK_CLIENT_SECRET` / `VK_REDIRECT_URI` | — | Вход и привязка аккаунта через VK ID |
| `VK_IOS_CLIENT_ID` / `VK_ANDROID_CLIENT_ID` | — | Обмен VK-токена мобильного клиента |
| `FIREBASE_CREDENTIALS` | `storage/app/firebase_credentials.json` | Push-уведомления FCM |
| `AWS_*` | — | S3 для вынесения файлов из `storage` |
| `API_TOKEN_EXPIRATION` / `AUTH_TOKEN_EXPIRATION` / `REFRESH_TOKEN_EXPIRATION` | — | Время жизни токенов API |
| `VISITS_RADIUS` | `500` | Радиус поиска посещённых мест (метры) |
| `ATTRACTIONS_RADIUS` | — | Радиус подбора достопримечательностей |

> Значения из локального `.env` в README не приводятся. Файл `.env` не отслеживается git
> (см. `.gitignore`) — секреты остаются только у вас.

---

## 7. Используемые порты

| Порт (хост) | Контейнер | Сервис | URL |
|---|---|---|---|
| `APP_PORT` = 8000 | 8000 (`artisan serve`) | Приложение | `http://localhost:8000` |
| `APP_PORT` = 8000 | 80 (nginx) | Приложение через Sail | `http://localhost:8000` |
| `VITE_PORT` = 5173 | 5173 | Dev-сервер Vite (hot reload) | `http://localhost:5173` |
| `FORWARD_DB_PORT` = 3306 | 3306 | MySQL 8.4 | `mysql://sail:password@localhost:3306/saratov` |
| `FORWARD_REDIS_PORT` = 6379 | 6379 | Redis | `localhost:6379` |
| `ADMINER_PORT` = 3000 | 8080 | Adminer (просмотр БД) | `http://localhost:3000` |

Сервисные маршруты приложения: `/admin/login` — админ-панель MoonShine,
`/telescope` — Telescope (только для авторизованного администратора),
`/horizon` — Horizon, `/api/documentation` — документация API.

---

## 8. Зависимости

**PHP (Composer, `composer.json`)** — основные:

| Пакет | Роль |
|---|---|
| `laravel/framework` ^12.0 | Ядро |
| `livewire/livewire` ^3.6, `livewire/volt` ^1.7 | Интерактивный веб-интерфейс |
| `moonshine/moonshine` ^4.0, `moonshine/multi-panels` ^0.1, `moonshine/ru` ^1.0 | Админ-панель |
| `laravel/sanctum` ^4.0, `larahook/sanctum-refresh-token` ^1.0 | Токены API |
| `laravel/ai` ^0.7.2 | Подсистема AI-помощника |
| `laravel/horizon` ^5.48 | Очереди |
| `laravel/telescope` ^5.15, `laravel/pulse` ^1.4 | Отладка и мониторинг |
| `laravel-notification-channels/fcm` ^6.1 | Push-уведомления |
| `socialiteproviders/vkid` ^5.1 | Авторизация через VK ID |
| `joelbutcher/socialstream` ^6.3 | Привязка внешних аккаунтов |
| `dedoc/scramble` ^0.13 | Генерация OpenAPI по коду |
| `dyrynda/laravel-cascade-soft-deletes` ^4.6 | Каскадные мягкие удаления |
| `propaganistas/laravel-phone` ^6.0 | Валидация телефонов |
| `chocoway/moonshine-compressed-image` ^1.0 | Сжатие загруженных изображений |
| `wendelladriel/laravel-validated-dto` ^4.7 | DTO |

Dev: `laravel/sail` (Docker), `pestphp/pest`, `laravel/pint`, `friendsofphp/php-cs-fixer`,
`fakerphp/faker`, `laravel/pail`.

**JavaScript (npm, `package.json`)** — Vite 7, Tailwind CSS 4, `laravel-vite-plugin`,
`axios`, `swiper`, `aos`, `cropperjs`, `@fancyapps/ui`, FontAwesome, `chokidar`, `concurrently`.

Точки входа фронтенда заданы в `vite.config.js`:
`resources/css/app.css`, `resources/js/app.js`, `resources/css/admin/moonshine-cropper.css`,
`resources/js/admin/cropper-init.js`.

---

## 9. Внешние сервисы и интеграции

| Сервис | Назначение | Обязателен ли для сценария | Как подключить |
|---|---|---|---|
| **Anthropic API** (или другой провайдер `laravel/ai`) | Генерация ответов AI-помощника | Да, для сценария B | `ANTHROPIC_API_KEY`; выбор провайдера — `AI_LAB_NAME` |
| **Яндекс Карты** | Карта и геокодер на публичных страницах и в админке | Да, для корректного отображения карт | `YMAP_API_KEY` |
| **VK ID** | Вход и привязка аккаунта, обмен токенов мобильного клиента | Нет — работает и email-авторизация | `VK_CLIENT_ID`, `VK_CLIENT_SECRET`, `VK_REDIRECT_URI` |
| **Firebase Cloud Messaging** | Push-уведомления о новых событиях и о приближении события | Нет — уведомления просто не приходят | `FIREBASE_CREDENTIALS` (файл `storage/app/firebase_credentials.json`) |
| **AWS S3** | Вынесение пользовательских файлов из `storage` | Нет, по умолчанию локальный диск | `AWS_ACCESS_KEY_ID`, `AWS_SECRET_ACCESS_KEY`, `AWS_BUCKET` |
| **Почтовый SMTP** | Отправка писем с восстановлением пароля | Нет — по умолчанию `MAIL_MAILER=log`, письма пишутся в лог | `MAIL_HOST`, `MAIL_PORT`, `MAIL_USERNAME`, `MAIL_PASSWORD` |

### Внешний сервис, который невозможно воспроизвести внутри Docker

**Чат-бот в МАХ (VK MAX).**

- **Назначение.** Точка входа в продукт для пользователей мессенджера: бот содержит ссылку
  на развёрнутое приложение-гид по Саратову. Открыв ссылку, пользователь попадает
  в веб-приложение и проходит основной сценарий — каталог → карточка объекта → избранное.
- **Почему не воспроизводится в Docker.** Бот развёрнут в инфраструктуре МАХ. Он требует
  внешнего аккаунта бота, публичного HTTPS-адреса, доступного из сети МАХ, и не является
  частью этого репозитория. Локальный запуск через `docker compose up -d` поднимает
  только сайт и API.
- **Условия, необходимые для проверки решения:**
  1. Приложение развёрнуто по адресу, доступному из интернета (для локальной проверки —
     туннель к `http://localhost:8000`).
  2. Ссылка в боте указывает на этот адрес и открывается.
  3. У проверяющего есть доступ к боту в МАХ.
- **Проверка:** открыть бота в МАХ → перейти по ссылке → загрузить каталог → открыть карточку →
  авторизоваться → добавить объект в избранное. Дальнейшая проверка совпадает
  с пошаговым сценарием из раздела 12.

> Контейнеризация не заменяет работающую версию продукта: сайт в Docker и бот в МАХ —
  это две части одного пользовательского сценария. Чтобы пройти сценарий целиком,
  нужны обе.

---

## 10. Описание работы с данными

**Хранилища:**

| Что | Где | Примечание |
|---|---|---|
| Основные данные | MySQL 8.4, БД `saratov` | Том `sail-mysql`, переживает `docker compose down` |
| Сессии | таблица `sessions` | `SESSION_DRIVER=database` |
| Кэш | таблица `cache` | `CACHE_STORE=database` |
| Очередь задач | таблица `jobs` | `QUEUE_CONNECTION=database`; обрабатывается `queue:work` |
| Загруженные файлы | `storage/app/public`, диск `public` | Отдаются через symlink `php artisan storage:link` |
| Push-токены | таблица `firebase_device_tokens` | Привязаны к пользователю |

**Поток данных пользователя:**

1. Пользователь открывает каталог → контроллер/компонент читает записи из MySQL →
   Livewire отдаёт страницу с уже отрендеренным HTML.
2. Кэш и агрегаты (`ViewAggregationScheduler`, `app/Services/ViewService.php`)
   пересчитывают счётчики просмотров; история пишется в `history_views`.
3. Избранное (`favorites`), посещения (`place_visits`), история просмотров — по `user_id`.
4. AI-помощник: вопрос попадает в очередь как задача `PromptAgent`. Задача берёт
   записи из БД через `SystemPromptDataService`, формирует системный промпт,
   обращается к модели и сохраняет ответ в историю диалога. Интерфейс догружает ответ
   опросом (`pollModelResponse`).
5. Уведомления: `NotifyFavoriteUsers`, `NotifyAllUsers` — ставят FCM-задачи владельцам
   избранного. `UnbindFirebaseTokenJob` чистит неактивные токены.

**Админка** пишет в те же таблицы: MoonShine-ресурсы в `app/MoonShine/Resources/`
создают и редактируют объекты, расписания, события и заявки на экскурсии.

**Просмотр данных:** Adminer на `http://localhost:3000` (сервер `mysql`, логин `sail`,
пароль из `DB_PASSWORD`).

---

## 11. Порядок работы с тестовыми данными

Тестовые данные создаются сидерами из `database/seeders/`. Запускаются автоматически
при `php artisan db:seed`; `DatabaseSeeder` вызывает их по порядку:

| Порядок | Сидер | Что создаёт |
|---|---|---|
| 1 | — (в `DatabaseSeeder`) | Администратор MoonShine: логин `admin`, пароль `12345678` |
| 2 | `RestaurantSeeder` | Рестораны |
| 3 | `GuidedTourSeeder` | Гиды и экскурсоводы |
| 4 | `HotelSeeder` | Отели |
| 5 | `AttractionSeeder` | Достопримечательности |
| 6 | `EventCategorySeeder` | Категории событий |
| 7 | `EventSeeder` | События |
| 8 | `CustomLocationSeeder` | Пользовательские локации |
| 9 | `ExcursionSeeder` | Экскурсии |
| 10 | `CustomPointSeeder` | Пользовательские точки на карте |
| 11 | `ExcursionPointSeeder` | Точки маршрутов экскурсий |

**Порядок действий:**

```bash
# 1. Чистая база со схемой и тестовыми данными
docker compose exec laravel.test php artisan migrate:fresh --seed
```

- Сидеры используют Faker. Чтобы данные были на русском, в `.env` должны стоять
  `APP_LOCALE=ru`, `APP_FAKER_LOCALE=ru_RU` — эти значения уже заданы в `.env.example`.
  Если после `db:seed` текст оказался не на русском, задайте локаль и повторите
  `migrate:fresh --seed`.
- Фотографии у сидерных объектов не создаются — карточки будут без изображений,
  это ожидаемо.
- Данные из `seeder` можно убрать: `php artisan migrate:fresh` без флага `--seed`.

---

## 12. Пошаговый сценарий проверки

### Шаг 0. Подготовка

```bash
cp .env.example .env
```

Дописать в `.env` блок из раздела 4: `APP_KEY`, `WWWUSER`, `WWWGROUP`, порты
(`APP_PORT`, `VITE_PORT`, `FORWARD_DB_PORT`, `FORWARD_REDIS_PORT`, `ADMINER_PORT`),
параметры БД (`DB_CONNECTION`, `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`),
`REDIS_HOST=redis`, `APP_URL=http://localhost:8000`, а также `ANTHROPIC_API_KEY` (для AI-чата)
и `YMAP_API_KEY` (для карт).

### Шаг 1. Запуск всех компонентов

```bash
docker compose up -d
docker compose ps
```

Ожидается: `mysql` и `redis` в статусе `healthy` (у обоих есть healthcheck), `laravel.test` и
`adminer` — `Up`.

### Шаг 2. Инициализация приложения

```bash
docker compose exec laravel.test composer install
docker compose exec laravel.test npm install
docker compose exec laravel.test php artisan key:generate
docker compose exec laravel.test php artisan migrate --seed
docker compose exec laravel.test npm run build
docker compose exec laravel.test php artisan storage:link
```

### Шаг 3. Запуск процессов

```bash
# Терминал 1
docker compose exec laravel.test php artisan serve --host=0.0.0.0 --port=8000

# Терминал 2 — без этого AI-чат не ответит
docker compose exec laravel.test php artisan queue:work
```

### Шаг 4. Проверка каталога (сценарий A)

1. Открыть `http://localhost:8000` — главная страница гида. Наличие текста и блоков
   говорит, что БД доступна и сидеры отработали.
2. Перейти в `/restaurants` — открывается список с сидерными ресторанами.
3. Открыть карточку первого ресторана: `/restaurants/{id}`. На странице есть описание,
   расписание и карта.
4. Нажать «В избранное» без авторизации — сайт предложит войти.
5. Зарегистрироваться на `/register` (email + пароль, либо через VK ID).
6. Вернуться к карточке, нажать «В избранное» — кнопка становится активной.
7. Открыть `/profile/favorites` — объект присутствует в списке.

### Шаг 5. Проверка AI-помощника (сценарий B)

1. На главной странице или в `/restaurants` найти блок «Саратов».
2. Ввести вопрос: `Куда сходить с детьми в Саратове?` и отправить.
3. В чате появляется сообщение пользователя и индикатор ожидания ответа.
4. В течение нескольких секунд в чат приходит ответ модели со ссылками на объекты каталога.
5. Обновить страницу и перезайти в аккаунт — история диалога сохранилась.

Ответ приходит только при работающем `php artisan queue:work` и валидном `ANTHROPIC_API_KEY`.

### Шаг 6. Проверка админ-панели

1. Открыть `http://localhost:8000/admin/login`.
2. Войти: `admin` / `12345678`.
3. Открыть любой ресурс (например, «Рестораны»), создать и отредактировать запись.
4. Убедиться, что изменение появилось в публичном каталоге.

### Шаг 7. Проверка API

```bash
curl http://localhost:8000/api/v1/places/restaurants
```

Ожидается — JSON со списком ресторанов. Авторизованные методы требуют токен:

```bash
curl -X POST http://localhost:8000/api/v1/auth/login \
  -H "Content-Type: application/json" \
  -d '{"email":"user@example.com","password":"password"}'
```

### Шаг 8. Проверка через МАХ

1. Перейти по ссылке из чат-бота в МАХ.
2. Пройти сценарий из раздела 12, шаги 4–5, уже в мобильном клиенте.

---

## 13. Примеры ожидаемого поведения системы

| Проверка | Ожидаемый результат |
|---|---|
| `GET /` | 200, HTML главной страницы с блоками каталога |
| `GET /restaurants` | 200, список ресторанов из сидеров |
| `GET /restaurants/{id}` | 200, карточка: описание, расписание, карта |
| `GET /api/v1/places/restaurants` | 200, JSON-массив объектов |
| `GET /api/v1/places/restaurants/{id}` | 200, JSON объекта; 404, если `id` не существует |
| `POST /api/v1/auth/login` без верных данных | 401/422, тело с ошибкой валидации |
| `GET /api/v1/favorites` без токена | 401 `Unauthenticated.` |
| `GET /api/v1/favorites` с токеном | 200, JSON со списком избранного |
| `POST /api/v1/ai-chat/send` без `ANTHROPIC_API_KEY` | Задача падает в очереди, в логах — ошибка провайдера; в интерфейсе остаётся ожидание |
| `POST /api/v1/ai-chat/send` с ключом | 200, сообщение сохранено, ответ появится в чате после обработки очереди |
| Переход в `/admin/login` | Страница входа MoonShine |
| Вход в `/admin/login` с `admin`/`12345678` | 200, открывается дашборд админки |
| `/telescope` без прав администратора | 403/редирект на страницу входа |
| Карта на странице без `YMAP_API_KEY` | Карта не отрисовывается, страница работает |
| `docker compose ps` | `mysql` и `redis` — `healthy` |

**Пример сообщения AI-помощника** — приветствие при первом открытии чата:
`Привет! Я Саратов, ваш AI-гид!` (`app/Livewire/SaratovAi.php:22`).
Гостю вместо чата показывается: `Для использования бота необходимо авторизоваться в аккаунте`.

---

## 14. Известные ограничения

- **AI-помощник требует внешнего ключа.** Без `ANTHROPIC_API_KEY` задачи в очереди падают,
  пользователь видит бесконечное ожидание. Провайдера можно переключить через `AI_LAB_NAME`
  (`config/ai.php:151`), но ключ соответствующего сервиса всё равно нужен.
- **AI-ответ асинхронный.** Без `php artisan queue:work` (или Horizon) ответ не придёт никогда.
- **Чат-бот в МАХ вне Docker.** Требует внешнего аккаунта и публичного HTTPS-адреса;
  локально полностью не воспроизводится (раздел 9).
- **Карты требуют `YMAP_API_KEY`.** Без ключа карта не отрисовывается, остальная страница
  работает штатно.
- **VK-авторизация требует приложения в VK.** Без `VK_CLIENT_ID`/`VK_CLIENT_SECRET` вход
  через VK ID не работает; email-авторизация доступна всегда.
- **Push-уведомления требуют Firebase.** Без `storage/app/firebase_credentials.json` уведомления
  не отправляются; на остальную работу это не влияет.
- **Фотографии в сидерных данных отсутствуют.** Каталог наполнен объектами без изображений —
  это ожидаемо.
- **Автоматических тестов почти нет.** В репозитории присутствуют только заготовки
  `tests/Unit/ExampleTest.php` и `tests/Feature/ExampleTest.php`. Проверка выполняется
  по сценарию из раздела 12.
- **Порт 80 в compose.yaml по умолчанию.** Если оставить `APP_PORT=80`, публикация порта
  на хосте может потребовать прав администратора. В `.env.example` задан `APP_PORT=8000`.
- **Права каталогов на Linux.** При `WWWUSER`/`WWWGROUP`, отличных от UID/GID хостового
  пользователя, могут возникнуть ошибки записи в `storage/` и `bootstrap/cache/`.
- **Никаких healthcheck'ов у `laravel.test`.** Состояние контейнера с приложением
  `docker compose ps` не отражает — проверяйте вручную по HTTP.
- **Токены хранятся с `BCRYPT_ROUNDS=12`.** Локальная проверка медленнее продакшена.

---

## 15. Порядок остановки и повторного запуска

### Остановка

```bash
# Остановить контейнеры, сохранив данные (тома sail-mysql и sail-redis остаются)
docker compose down

# Остановить и удалить также данные — БД и Redis будут очищены
docker compose down -v
```

### Повторный запуск

```bash
docker compose up -d
```

Тома с данными сохраняются, поэтому повторный запуск не требует повторных миграций
и сидеров. Затем, как и при первом запуске, поднимите процессы приложения:

```bash
docker compose exec laravel.test php artisan serve --host=0.0.0.0 --port=8000
docker compose exec laravel.test php artisan queue:work
```

### Полный перезапуск с нуля

Если требуется чистое состояние — остановить с удалением томов, поднять заново
и повторить шаги 0–3 из раздела 12:

```bash
docker compose down -v
docker compose up -d
docker compose exec laravel.test php artisan migrate:fresh --seed
```

### Сброс кэша приложения

Если страницы отдают устаревший HTML (частая проблема в dev-режиме):

```bash
docker compose exec laravel.test php artisan optimize:clear
```

### Остановка отдельных процессов

Остановить воркер очереди — `Ctrl+C` в его терминале. Остановить веб-сервер — `Ctrl+C`
в терминале с `artisan serve`. Контейнеры при этом продолжают работать.

---

## Разработка

Синхронизация зависимостей и сборка фронтенда:

```bash
composer i
npm i
npm run build
```

Автоматическая пересборка фронтенда при изменениях в `resources/css/` и `resources/js/`
(в отдельном терминале):

```bash
npm run build:watch
```

Vite dev-сервер с hot reload — `npm run dev` (порт `VITE_PORT`, по умолчанию 5173).

Форматирование и статический анализ:

```bash
./vendor/bin/pint
```

Тесты:

```bash
./vendor/bin/pest
```

Отладочная информация: `/telescope` (только администратор), `/horizon` (очереди),
`/pulse` (метрики).
