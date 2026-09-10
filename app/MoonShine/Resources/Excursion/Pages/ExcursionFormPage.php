<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Excursion\Pages;

use App\Models\Attraction;
use App\Models\CustomPoint;
use App\Models\Hotel;
use App\Models\Restaurant;
use App\MoonShine\Fields\CompressedCropperImage;
use App\MoonShine\Resources\Attachment\AttachmentResource;
use App\MoonShine\Resources\Excursion\ExcursionResource;
use App\MoonShine\Resources\ExcursionPoint\ExcursionPointResource;
use App\MoonShine\Resources\GuidedTour\GuidedTourResource;
use MoonShine\Contracts\Core\TypeCasts\DataWrapperContract;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Contracts\UI\FormBuilderContract;
use MoonShine\Laravel\Fields\Relationships\BelongsTo;
use MoonShine\Laravel\Fields\Relationships\MorphTo;
use MoonShine\Laravel\Fields\Relationships\RelationRepeater;
use MoonShine\Laravel\Fields\Slug;
use MoonShine\Laravel\Pages\Crud\FormPage;
use MoonShine\Support\ListOf;
use MoonShine\UI\Components\FormBuilder;
use MoonShine\UI\Fields\Checkbox;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Number;
use MoonShine\UI\Fields\Select;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Textarea;
use Throwable;

/**
 * @extends FormPage<ExcursionResource>
 */
class ExcursionFormPage extends FormPage
{
    /**
     * @return list<ComponentContract|FieldContract>
     */
    protected function fields(): iterable
    {
        return [
            ID::make(),
            Text::make('Название', 'name')->unescape()->required(),
            Slug::make('Слаг', 'slug')->from('name')->unique()->canSee(function () {
                $item = $this->getResource()?->getItem();

                return $item && $item->exists;
            }),
            BelongsTo::make('Оператор', 'guide', 'name', GuidedTourResource::class)->required()->searchable(),
            Textarea::make('Описание', 'description')->unescape()->required(),
            Select::make('Тип экскурсии', 'type')
                ->options([
                    'Пеший' => 'Пеший',
                    'Автобусный' => 'Автобусный',
                    'Велосипедный' => 'Велосипедный',
                    'Водный' => 'Водный',
                    'Комбинированный' => 'Комбинированный',
                ])
                ->required(),
            Number::make('Длительность (минут)', 'duration')
                ->min(1)
                ->nullable(),
            Number::make('Дистанция (км)', 'distance')
                ->min(0)
                ->step(0.1),
            Select::make('Сложность', 'difficulty')
                ->options([
                    'Легко' => 'Легко',
                    'Средне' => 'Средне',
                    'Тяжело' => 'Тяжело',
                ]),
            Number::make('Мин. размер группы', 'group_size_min')
                ->min(1),
            Number::make('Макс. размер группы', 'group_size_max')
                ->min(1),
            Number::make('Цена взрослый', 'price_adult')
                ->min(0)
                ->step(1)
                ->buttons(),

            Number::make('Цена детский', 'price_child')
                ->min(0)
                ->step(1)
                ->buttons(),

            Number::make('Цена группа', 'price_group')
                ->min(0)
                ->step(1)
                ->buttons(),
            Checkbox::make('Бесплатно', 'is_free'),
            Text::make('Возрастное ограничение', 'age_restriction')
                ->placeholder('12+'),
            Text::make('Место встречи', 'meeting_point')
                ->required(),
            Text::make('Адрес встречи', 'meeting_address')
                ->required(),
            Select::make('Тип расписания', 'schedule_type')
                ->options([
                    'По расписанию' => 'По расписанию',
                    'По запросу' => 'По запросу',
                ])
                ->required(),
            Checkbox::make('Бронирование включено', 'booking_enabled'),
            Select::make('Статус', 'status')
                ->options([
                    'Активный' => 'Активный',
                    'Неактивный' => 'Неактивный',
                    'Сезонный' => 'Сезонный',
                ])
                ->required(),
            RelationRepeater::make('Изображения', 'attachments', resource: AttachmentResource::class)
                ->fields([
                    ID::make(),
                    CompressedCropperImage::make('Файл', 'link')
                        ->format('webp')
                        ->quality((int) config('app.admin.images.quality'))
                        ->thumb((int) config('app.admin.images.thumb.width'), (int) config('app.admin.images.thumb.height')),
                    Number::make('Порядковый номер', 'order')->default(0),
                    Text::make('Подпись к картинке', 'alt_name'),
                ])->removable(),

            RelationRepeater::make('Точки маршрута', 'points', resource: ExcursionPointResource::class)
                ->creatable()
                ->fields([
                    ID::make(),
                    Number::make('Порядок', 'order')->default(0),

                    MorphTo::make('Точка', 'excursionPointable', resource: ExcursionPointResource::class)
                        ->types([
                            Attraction::class => ['name', 'Достопримечательность'],
                            Restaurant::class => ['name', 'Ресторан'],
                            Hotel::class => ['name', 'Отель'],
                            CustomPoint::class => ['name', 'Дополнительная точка экскурсии'],
                        ]),
                    Number::make('Время на точке', 'duration_minutes')->min(0)->default(0),
                ])
                ->removable(),

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
