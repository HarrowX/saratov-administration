<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Attachment;

use App\Models\Attachment;
use App\MoonShine\Resources\Attachment\Pages\AttachmentDetailPage;
use App\MoonShine\Resources\Attachment\Pages\AttachmentFormPage;
use App\MoonShine\Resources\Attachment\Pages\AttachmentIndexPage;
use MoonShine\Contracts\Core\PageContract;
use MoonShine\Laravel\Resources\ModelResource;

/**
 * @extends ModelResource<Attachment, AttachmentIndexPage, AttachmentFormPage, AttachmentDetailPage>
 */
class AttachmentResource extends ModelResource
{
    protected string $model = Attachment::class;

    protected string $title = 'Прикрепляемое';

    /**
     * @return list<class-string<PageContract>>
     */
    protected function pages(): array
    {
        return [
            AttachmentIndexPage::class,
            AttachmentFormPage::class,
            AttachmentDetailPage::class,
        ];
    }
}
