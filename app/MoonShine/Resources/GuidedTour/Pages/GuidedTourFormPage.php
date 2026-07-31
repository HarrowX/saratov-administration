<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\GuidedTour\Pages;

use App\MoonShine\Resources\Attachment\AttachmentResource;
use App\MoonShine\Resources\GuidedTour\GuidedTourResource;
use Chocoway\MoonshineCompressedImage\Fields\CompressedImage;
use MoonShine\Contracts\Core\TypeCasts\DataWrapperContract;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Contracts\UI\FormBuilderContract;
use MoonShine\Laravel\Fields\Relationships\RelationRepeater;
use MoonShine\Laravel\Pages\Crud\FormPage;
use MoonShine\Support\ListOf;
use MoonShine\UI\Components\FormBuilder;
use MoonShine\UI\Fields\Email;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Number;
use MoonShine\UI\Fields\Phone;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Textarea;
use MoonShine\UI\Fields\Url;
use Throwable;

/**
 * @extends FormPage<GuidedTourResource>
 */
class GuidedTourFormPage extends FormPage
{
    /**
     * @return list<ComponentContract|FieldContract>
     */
    protected function fields(): iterable
    {
        return [
            ID::make(),
            Text::make('ФИО', 'name')->required(),
            Textarea::make('Краткое описание', 'short_description')->required(),
            Textarea::make('Описание', 'description')->required(),
            Text::make('Опыт', 'experience')->required(),
            Phone::make('Номер телефона', 'phone')->required(),
            Email::make('Почта', 'email')->required(),
            Url::make('ВК', 'vk')->nullable(),
            Url::make('Макс', 'max')->nullable(),
            RelationRepeater::make('Изображения', 'attachments', resource: AttachmentResource::class)
                ->fields([
                    ID::make(),
                    CompressedImage::make('Файл', 'link')
                        ->format('webp')
                        ->quality((int) config('app.admin.images.quality'))
                        ->thumb((int) config('app.admin.images.thumb.width'), (int) config('app.admin.images.thumb.height')),
                    Number::make('Порядковый номер', 'order')->default(0)->required(),
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
