<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Restaurant\Pages;

use App\MoonShine\Resources\Attachment\AttachmentResource;
use MoonShine\Laravel\Fields\Relationships\HasMany;
use MoonShine\Laravel\Fields\Relationships\MorphMany;
use MoonShine\Laravel\Fields\Relationships\MorphToMany;
use MoonShine\Laravel\Fields\Relationships\RelationRepeater;
use MoonShine\Laravel\Fields\Slug;
use MoonShine\Laravel\Pages\Crud\FormPage;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\Contracts\UI\FormBuilderContract;
use MoonShine\UI\Components\ActionButton;
use MoonShine\UI\Components\FormBuilder;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Contracts\Core\TypeCasts\DataWrapperContract;
use App\MoonShine\Resources\Restaurant\RestaurantResource;
use MoonShine\Support\ListOf;
use MoonShine\UI\Components\Layout\Div;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\Image;
use MoonShine\UI\Fields\Number;
use MoonShine\UI\Fields\Phone;
use MoonShine\UI\Fields\Select;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Textarea;
use MoonShine\UI\Fields\Json;
use MoonShine\UI\Fields\Url;
use Throwable;


/**
 * @extends FormPage<RestaurantResource>
 */
class RestaurantFormPage extends FormPage
{
    /**
     * @return list<ComponentContract|FieldContract>
     */

    protected function fields(): iterable
    {
        return [
            Box::make([
                ID::make(),
                Text::make('Название', 'name')->unescape()->required(),
                Slug::make('Слаг','slug')->from('name')->unique()->canSee(function () {
                    $item = $this->getResource()?->getItem();
                    return $item && $item->exists;
                }),
                Textarea::make('Описание', 'description')->unescape()->required(),
                Json::make('Рабочее время', 'worktime')->keyValue('День', 'Часы работы'),
                Phone::make('Номер телефона', 'phone')->required(),
                Text::make('Кухня', 'kitchen')->unescape()->required(),
                Select::make('Ценовая категория','price_category')
                    ->options([
                        'budget' => 'Дешево',
                        'medium' => 'Средне',
                        'premium' => 'Премиум',
                        'luxury' => 'Люкс'
                    ]),
                Number::make('Количество посадочных мест','capacity'),
                Text::make('Адрес', 'address')->unescape()->required(),
                Text::make('Район', 'district'),
                Text::make('Email', 'email'),
                Url::make('Сайт', 'website'),
                Url::make('Ссылка на карту', 'map_link'),
                Textarea::make('Код виджета отзывов яндекс карт', 'yandex_review_widget')->unescape(),
                ActionButton::make('Инструкция')
                    ->inModal('Инструкция',<<<HTML
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
                Box::make('Координаты',[
                    Div::make([
                        Text::make('Широта','longitude'),
                        Text::make('Долгота','latitude'),
                    ])->style('display: flex; gap: 1rem;')
                ]),
                RelationRepeater::make('Изображения', 'attachments', resource: AttachmentResource::class)
                    ->fields([
                        ID::make(),
                        Image::make('Файл', 'link'),
                        Number::make('Порядковый номер', 'order')->default(0),
                ])->removable(),
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
     *
     * @return FormBuilder
     */
    protected function modifyFormComponent(FormBuilderContract $component): FormBuilderContract
    {
        return $component;
    }

    /**
     * @return list<ComponentContract>
     * @throws Throwable
     */
    protected function topLayer(): array
    {
        return [
            ...parent::topLayer()
        ];
    }

    /**
     * @return list<ComponentContract>
     * @throws Throwable
     */
    protected function mainLayer(): array
    {
        return [
            ...parent::mainLayer()
        ];
    }

    /**
     * @return list<ComponentContract>
     * @throws Throwable
     */
    protected function bottomLayer(): array
    {
        return [
            ...parent::bottomLayer()
        ];
    }
}
