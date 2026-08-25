<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\User\Pages;

use App\Models\User;
use App\MoonShine\Resources\User\UserResource;
use App\Notifications\FcmTestNotification;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use MoonShine\Contracts\Core\DependencyInjection\CrudRequestContract;
use MoonShine\Contracts\UI\ActionButtonContract;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Crud\JsonResponse;
use MoonShine\Laravel\Pages\Crud\IndexPage;
use MoonShine\Laravel\QueryTags\QueryTag;
use MoonShine\Support\Attributes\AsyncMethod;
use MoonShine\Support\Enums\ToastType;
use MoonShine\Support\ListOf;
use MoonShine\UI\Components\ActionButton;
use MoonShine\UI\Components\FormBuilder;
use MoonShine\UI\Components\Metrics\Wrapped\Metric;
use MoonShine\UI\Components\Modal;
use MoonShine\UI\Components\Table\TableBuilder;
use MoonShine\UI\Fields\Checkbox;
use MoonShine\UI\Fields\Email;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Phone;
use MoonShine\UI\Fields\Text;
use Throwable;

/**
 * @extends IndexPage<UserResource>
 */
class UserIndexPage extends IndexPage
{
    protected bool $isLazy = true;

    /**
     * @return list<FieldContract>
     */
    protected function fields(): iterable
    {
        return [
            ID::make()->sortable(),
            Text::make('Фио', 'fio')->changeFill(fn ($c) => $c->username->toFio()),
            Email::make('Почта', 'email')->sortable(),
            Phone::make('Номер', 'phone')->sortable(),
            Checkbox::make('ВК привязан', 'vk_id')->sortable(),
        ];
    }

    /**
     * @return ListOf<ActionButtonContract>
     */
    protected function buttons(): ListOf
    {
        return parent::buttons()->prepend(
            ActionButton::make()
                ->icon('fire')
                ->inModal(
                    title: 'Отправка уведомления на мобильные устройства',
                    name: static fn (mixed $item, ActionButtonContract $ctx): string => 'send-notification-'.$ctx->getData()?->getKey(),
                    builder: fn (Modal $modal, ActionButton $ctx) => $modal->setComponents([
                        FormBuilder::make('send-notification-form', fields: [
                            ID::make()->setValue($ctx->getData()?->getKey()),
                            Text::make('Заголовок', 'title')->required(),
                            Text::make('Тело', 'body')->required(),
                        ])
                            ->asyncMethod('sendNotification')
                            ->submit('Отправить'),
                    ])
                ),

            ActionButton::make('Восстановить')
                ->method(
                    'restore',
                    events: [$this->getListEventName()]
                )
                ->canSee(
                    fn (User $model) => $model->trashed()
                ),
        );
    }

    #[AsyncMethod]
    public function sendNotification(Request $request)
    {
        $validated = $request->validate([
            'id' => ['exists:users,id'],
            'title' => ['required', 'string'],
            'body' => ['required', 'string'],
        ]);
        $user = User::find($validated['id']);
        $user->notify(new FcmTestNotification($validated['title'], $validated['body']));
        toast('Уведомление в очереди на отправку', ToastType::SUCCESS);
    }

    #[AsyncMethod]
    public function restore(
        CrudRequestContract $request
    ): JsonResponse {
        $item = $request->getResource()->getItem();
        $item->restore();

        return JsonResponse::make()
            ->toast('Успешно', ToastType::SUCCESS);
    }

    /**
     * @return list<FieldContract>
     */
    protected function filters(): iterable
    {
        return [];
    }

    /**
     * @return list<QueryTag>
     */
    protected function queryTags(): array
    {
        return [
            QueryTag::make(
                'Удалённые',
                static function (Builder $q) {
                    $q->onlyTrashed();

                    $model = $q->getModel();
                    if (method_exists($model, 'getCascadeDeletes')) {
                        $with = [];
                        foreach ($model->getCascadeDeletes() as $relation) {
                            $with[$relation] = fn ($q) => $q->withTrashed();
                        }
                        $q->with($with);
                    }

                    return $q;
                }
            ),
        ];
    }

    /**
     * @return list<Metric>
     */
    protected function metrics(): array
    {
        return [];
    }

    /**
     * @param  TableBuilder  $component
     * @return TableBuilder
     */
    protected function modifyListComponent(ComponentContract $component): ComponentContract
    {
        return $component
            ->stickyButtons()
            ->columnSelection();
    }

    protected function modifyDeleteButton(
        ActionButtonContract $button
    ): ActionButtonContract {
        return $button->canSee(
            fn (User $model) => ! $model->trashed()
        );
    }

    protected function modifyMassDeleteButton(
        ActionButtonContract $button
    ): ActionButtonContract {
        return $button->canSee(
            fn () => request()->input('query-tag') !== 'udalennye'
        );
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
