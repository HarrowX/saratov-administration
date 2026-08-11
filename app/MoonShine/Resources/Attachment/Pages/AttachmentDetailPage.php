<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Attachment\Pages;

use App\Models\Attraction;
use App\Models\Event;
use App\Models\Excursion;
use App\Models\GuidedTour;
use App\Models\Hotel;
use App\Models\Restaurant;
use App\MoonShine\Resources\Attachment\AttachmentResource;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Laravel\Fields\Relationships\MorphTo;
use MoonShine\Laravel\Pages\Crud\DetailPage;
use MoonShine\Support\ListOf;
use MoonShine\UI\Components\Table\TableBuilder;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Image;
use MoonShine\UI\Fields\Number;
use MoonShine\UI\Fields\Text;
use Throwable;

/**
 * @extends DetailPage<AttachmentResource>
 */
class AttachmentDetailPage extends DetailPage
{
    /**
     * @return list<FieldContract>
     */
    protected function fields(): iterable
    {
        return [
            ID::make(),
            Image::make('Файл', 'link'),
            Number::make('Порядковый номер', 'order'),
            MorphTo::make('Прикрепляется к', 'attachable')
                ->types([
                    Attraction::class => ['name', 'Достопримечательность'],
                    Event::class => ['name', 'Событие'],
                    Excursion::class => ['name', 'Экскурсия'],
                    GuidedTour::class => ['name', 'Экскурсовод'],
                    Hotel::class => ['name', 'Отель'],
                    Restaurant::class => ['name', 'Ресторан']
                ]),
        ];
    }

    protected function buttons(): ListOf
    {
        return parent::buttons();
    }

    /**
     * @param  TableBuilder  $component
     * @return TableBuilder
     */
    protected function modifyDetailComponent(ComponentContract $component): ComponentContract
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
