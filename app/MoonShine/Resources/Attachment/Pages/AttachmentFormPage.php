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
use Chocoway\MoonshineCompressedImage\Fields\CompressedImage;
use MoonShine\Contracts\Core\TypeCasts\DataWrapperContract;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Contracts\UI\FormBuilderContract;
use MoonShine\Laravel\Fields\Relationships\MorphTo;
use MoonShine\Laravel\Pages\Crud\FormPage;
use MoonShine\Support\ListOf;
use MoonShine\UI\Components\FormBuilder;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Number;
use Throwable;

/**
 * @extends FormPage<AttachmentResource>
 */
class AttachmentFormPage extends FormPage
{
    /**
     * @return list<ComponentContract|FieldContract>
     */
    protected function fields(): iterable
    {
        return [
            Box::make([
                ID::make(),
                MorphTo::make('Прикрепляется к', 'attachable')
                    ->types([
                        Attraction::class => ['name', 'Достопримечательность'],
                        Event::class => ['name', 'Событие'],
                        Excursion::class => ['name', 'Экскурсия'],
                        GuidedTour::class => ['name', 'Экскурсовод'],
                        Hotel::class => ['name', 'Отель'],
                        Restaurant::class => ['name', 'Ресторан'],
                    ])->required(), // TODO надо написать bug report снова при смене типа можно сохранить и attachable id станет null но приведется в 0
                CompressedImage::make('Файл', 'link')
                    ->format('webp')
                    ->quality((int) config('app.admin.images.quality'))
                    ->thumb((int) config('app.admin.images.thumb.width'), (int) config('app.admin.images.thumb.height')),
                Number::make('Порядковый номер', 'order')->default(0),
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
