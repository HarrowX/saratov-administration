<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Event\Pages;

use App\Models\Attraction;
use App\Models\CustomLocation;
use App\Models\Hotel;
use App\Models\Restaurant;
use App\MoonShine\Resources\Attachment\AttachmentResource;
use App\MoonShine\Resources\Event\EventResource;
use App\MoonShine\Resources\EventCategory\EventCategoryResource;
use MoonShine\Contracts\Core\TypeCasts\DataWrapperContract;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Contracts\UI\FormBuilderContract;
use MoonShine\Laravel\Fields\Relationships\BelongsToMany;
use MoonShine\Laravel\Fields\Relationships\MorphTo;
use MoonShine\Laravel\Fields\Relationships\RelationRepeater;
use MoonShine\Laravel\Fields\Slug;
use MoonShine\Laravel\Pages\Crud\FormPage;
use MoonShine\Support\ListOf;
use MoonShine\UI\Components\FormBuilder;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\Date;
use MoonShine\UI\Fields\Email;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Image;
use MoonShine\UI\Fields\Number;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Textarea;
use MoonShine\UI\Fields\Url;
use Throwable;

/**
 * @extends FormPage<EventResource>
 */
class EventFormPage extends FormPage
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
                Slug::make('Слаг', 'slug')->from('name')->unique()->canSee(function () {
                    $item = $this->getResource()?->getItem();

                    return $item && $item->exists;
                }),
                Textarea::make('Описание', 'description')->unescape()->required(),
                Text::make('Возрастное ограничение', 'age_restriction'),
                BelongsToMany::make('Категории', 'categories', formatted: 'name', resource: EventCategoryResource::class)
                    ->selectMode()
                    ->searchable()
                    ->valuesQuery(function ($query) {
                        return $query->where('is_active', true);
                    }),
                Date::make('Начало', 'start_date')->withTime()->required(),
                Date::make('Конец', 'end_date')->withTime(),
                Box::make('Организатор', [
                    Text::make('Название организации', 'organizer_name')->nullable(),
                    Text::make('Телефон организатора', 'organizer_phone')->nullable(),
                    Email::make('Email организатора', 'organizer_email')->nullable(),
                    Url::make('Сайт организатора', 'organizer_website')->nullable(),
                ]),
                MorphTo::make('Локация', 'location')
                    ->types([
                        Attraction::class => ['name', 'Достопримечательность'],
                        Hotel::class => ['name', 'Отель'],
                        Restaurant::class => ['name', 'Ресторан'],
                        CustomLocation::class => ['name', 'Своя локация'],
                    ])->searchable()->nullable(),
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
