<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\ContactUs;

use App\Models\ContactUs;
use App\MoonShine\Resources\ContactUs\Pages\ContactUsDetailPage;
use App\MoonShine\Resources\ContactUs\Pages\ContactUsIndexPage;
use MoonShine\Contracts\Core\PageContract;
use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\Support\Enums\Action;
use MoonShine\Support\ListOf;

/**
 * @extends ModelResource<ContactUs, ContactUsIndexPage, ContactUsDetailPage>
 */
class ContactUsResource extends ModelResource
{
    protected string $model = ContactUs::class;

    protected string $title = 'Обратная связь';

    protected bool $detailInModal = true;

    /**
     * @return list<class-string<PageContract>>
     */
    protected function pages(): array
    {
        return [
            ContactUsIndexPage::class,
            ContactUsDetailPage::class,
        ];
    }

    protected function activeActions(): ListOf
    {
        return parent::activeActions()->except(Action::UPDATE, Action::CREATE);
    }
}
