<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Hotel\Pages;

use App\MoonShine\Fields\CompressedCropperImage;
use App\MoonShine\Resources\Attachment\AttachmentResource;
use App\MoonShine\Resources\Hotel\HotelResource;
use App\MoonShine\Resources\Schedule\ScheduleResource;
use MoonShine\Contracts\Core\TypeCasts\DataWrapperContract;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Contracts\UI\FormBuilderContract;
use MoonShine\Laravel\Fields\Relationships\MorphMany;
use MoonShine\Laravel\Fields\Relationships\RelationRepeater;
use MoonShine\Laravel\Fields\Slug;
use MoonShine\Laravel\Pages\Crud\FormPage;
use MoonShine\Support\ListOf;
use MoonShine\UI\Components\ActionButton;
use MoonShine\UI\Components\FormBuilder;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Components\Layout\Div;
use MoonShine\UI\Components\Tabs;
use MoonShine\UI\Components\Tabs\Tab;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Json;
use MoonShine\UI\Fields\Number;
use MoonShine\UI\Fields\Phone;
use MoonShine\UI\Fields\Select;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Textarea;
use MoonShine\UI\Fields\Url;
use Throwable;

/**
 * @extends FormPage<HotelResource>
 */
class HotelFormPage extends FormPage
{
    /**
     * @return list<ComponentContract|FieldContract>
     */
    protected function fields(): iterable
    {
        return [
            Tabs::make([
                Tab::make('Основное', [
                    ID::make(),
                    Text::make('Название', 'name')->unescape()->required(),
                    Slug::make('Слаг', 'slug')->from('name')->unique()->canSee(function () {
                        $item = $this->getResource()?->getItem();

                        return $item && $item->exists;
                    }),
                    Textarea::make('Краткое описание', 'description')->unescape()->required(),
                    Textarea::make('Полное описание', 'second_description')->unescape()->required(),
                    Json::make('Рабочее время', 'worktime')->keyValue('День', 'Часы работы'),
                    Select::make('Тип размещения', 'type')
                        ->options([
                            'Отель' => 'Отель',
                            'Гостевой дом' => 'Гостевой дом',
                            'Глэмпинг' => 'Глэмпинг',
                            'Курорт' => 'Курорт',
                        ])
                        ->required()->required(),
                    Number::make('Количество звезд', 'stars'),
                    Phone::make('Номер телефона', 'phone'),
                    Text::make('Адрес', 'address')->unescape()->required(),
                    Text::make('Район', 'district'),
                    Text::make('Email', 'email'),
                    Url::make('Сайт', 'website'),
                    //            Url::make('Ссылка на карту', 'map_link'),
                    Textarea::make('Код виджета отзывов яндекс карт', 'yandex_review_widget')
                        ->onApply(function ($item, $value) {
                            if (empty($value)) {
                                return $item;
                            }
                            $item->yandex_review_widget = preg_replace('/width:\d+px/', 'width:100%', $value, 1);

                            return $item;
                        })->unescape(),
                    ActionButton::make('Инструкция')
                        ->inModal('Инструкция', <<<'HTML'
                        <div style="line-height: 1.6; display: flex; flex-direction: column; gap: 0.25rem;">
                            <p style="margin: 0;">1. На Яндекс Картах откройте карточку точки</p>
                            <p style="margin: 0;">2. Справа сверху нажмите троеточие</p>
                            <p style="margin: 0;">3. Скопируйте виджет с отзывами</p>
                            <p style="margin: 0;">4. Вставьте в поле выше</p>
                            <div style="display: flex; justify-content: flex-end; margin-top: 0.25rem;">
                                <a target="_blank" href="https://yandex.ru/support/maps/ru/concept/get-map-reference#concept4" style="font-size: 0.9em;">Подробнее</a>
                            </div>
                        </div>
                        HTML),
                    Number::make('Максимальная цена', 'max_price')->step(1),
                    Number::make('Минимальная цена', 'min_price')->step(1),
                    Box::make('Координаты', [
                        Div::make([
                            Text::make('Широта', 'latitude'),
                            Text::make('Долгота', 'longitude'),
                        ])->style('display: flex; gap: 1rem;'),
                    ]),
                    RelationRepeater::make('Изображения', 'attachments', resource: AttachmentResource::class)
                        ->fields([
                            ID::make(),
                            CompressedCropperImage::make('Файл', 'link')
                                ->format('webp')
                                ->quality(config('app.admin.images.quality'))
                                ->thumb(config('app.admin.images.thumb.width'), config('app.admin.images.thumb.height')),
                            Number::make('Порядковый номер', 'order')->default(0),
                            Text::make('Подпись к картинке', 'alt_name'),
                        ])->removable(),
                ]),
                Tab::make('Расписание', [
                    MorphMany::make('Расписание', 'schedules', 'name', ScheduleResource::class)
                        ->nullable()
                        ->searchable()
                        ->creatable(button: ActionButton::make('Добавить новое расписание'))
                        ->withoutModals(),
                ]),
            ]),
        ];
    }

    protected function buttons(): ListOf
    {
        return parent::buttons();
    }

    protected function formButtons(): ListOf
    {
        return parent::formButtons();
    }

    protected function rules(DataWrapperContract $item): array
    {
        return [];
    }

    /**
     * @param  FormBuilder  $component
     * @return FormBuilder
     */
    protected function modifyFormComponent(FormBuilderContract $component): FormBuilderContract
    {
        return $component;
    }

    /**
     * @return list<ComponentContract>
     *
     * @throws Throwable
     */
    protected function topLayer(): array
    {
        return [
            ...parent::topLayer(),
        ];
    }

    /**
     * @return list<ComponentContract>
     *
     * @throws Throwable
     */
    protected function mainLayer(): array
    {
        return [
            ...parent::mainLayer(),
        ];
    }

    /**
     * @return list<ComponentContract>
     *
     * @throws Throwable
     */
    protected function bottomLayer(): array
    {
        return [
            ...parent::bottomLayer(),
        ];
    }
}
