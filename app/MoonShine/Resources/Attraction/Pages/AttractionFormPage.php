<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Attraction\Pages;

use App\MoonShine\Resources\Attachment\AttachmentResource;
use App\MoonShine\Resources\Attraction\AttractionResource;
use App\MoonShine\Resources\ScheduleRecord\ScheduleRecordResource;
use Chocoway\MoonshineCompressedImage\Fields\CompressedImage;
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
use MoonShine\UI\Fields\Number;
use MoonShine\UI\Fields\Phone;
use MoonShine\UI\Fields\Select;
use MoonShine\UI\Fields\Switcher;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Textarea;
use MoonShine\UI\Fields\Url;
use Throwable;

/**
 * @extends FormPage<AttractionResource>
 */
class AttractionFormPage extends FormPage
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
                    Text::make('Краткое описание', 'short_description')->unescape()->required(),
                    Textarea::make('Описание', 'description')->unescape()->required(),

                    Phone::make('Номер телефона', 'phone')->required(),

                    Text::make('Адрес', 'address')->unescape()->required(),
                    Select::make('Отображение на главной', 'display_location')
                        ->options([
                            'null' => 'Не показывать',
                            'carousel' => 'В карусели',
                            'featured' => 'В больших карточках',
                        ])
                        ->default('')
                        ->required(),
                    Text::make('Район', 'district'),
                    Text::make('Email', 'email'),
                    Url::make('Сайт', 'website'),
                    //            Url::make('Ссылка на карту', 'map_link'),
                    Textarea::make('Код виджета отзывов яндекс карт', 'yandex_review_widget')->unescape(),
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
                    Select::make('Статус', 'status')
                        ->options([
                            'active' => 'Активный',
                            'draft' => 'Черновик',
                            'archived' => 'Архив',
                        ]),
                    Number::make('Цена билета', 'ticket_price'),
                    Number::make('Время посещения (мин)', 'visit_duration'),
                    Switcher::make('Доступность', 'is_accessible'),
                    Switcher::make('Парковка', 'has_parking'),
                    Box::make('Координаты', [
                        Div::make([
                            Text::make('Широта', 'latitude'),
                            Text::make('Долгота', 'longitude'),
                        ])->style('display: flex; gap: 1rem;'),
                    ]),
                    RelationRepeater::make('Изображения', 'attachments', resource: AttachmentResource::class)
                        ->fields([
                            ID::make(),
                            CompressedImage::make('Файл', 'link')
                                ->format('webp')
                                ->quality((int) config('app.admin.images.quality'))
                                ->thumb((int) config('app.admin.images.thumb.width'), (int) config('app.admin.images.thumb.height')),
                            Number::make('Порядковый номер', 'order')->default(0),
                        ])->removable(),
                ]),
                Tab::make('Расписание', [
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
