<?php

namespace App\Services;

use App\Models\Attraction;
use App\Models\Event;
use App\Models\Excursion;
use App\Models\GuidedTour;
use App\Models\Hotel;
use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Throwable;

class StructuredResponseToModelService
{
    protected function classExtendsEloquentModel(string $entityType): bool
    {
        if (! class_exists($entityType)) {
            return false;
        }

        $parents = class_parents($entityType);
        if (! \in_array(Model::class, $parents)) {
            return false;
        }

        return true;
    }

    protected function resolveUrl(int|string $entityRouteValue, string $entityType): string
    {
        return match ($entityType) {
            Attraction::class => route('single-attraction', $entityRouteValue),
            Hotel::class => route('single-hotel', $entityRouteValue),
            Restaurant::class => route('single-restaurant', $entityRouteValue),
            Excursion::class => route('single-excursion', $entityRouteValue),
            GuidedTour::class => route('single-guided-tour', $entityRouteValue),
            Event::class => route('single-event', $entityRouteValue),
            default => '',
        };
    }

    protected function resolveEntityDisplayCategory(string $entityType): string
    {
        return match ($entityType) {
            Attraction::class => 'Достопримечательность',
            Hotel::class => 'Отель',
            Restaurant::class => 'Заведение',
            Excursion::class => 'Экскурсия',
            GuidedTour::class => 'Экскурсовод',
            Event::class => 'Событие',
        };
    }

    public function toDatabaseModel(int|string $entityId, string $entityType, array $with = []): ?Model
    {
        try {
            if ($this->classExtendsEloquentModel($entityType)) {
                $loadWith = array_filter($with, fn ($value) => (new $entityType)->isRelation($value));
                /**
                 * @var Model
                 */
                $entity = $entityType::query()->with($loadWith)?->where('id', $entityId)?->first();
                $entity->entity_type = $entityType;
                $entity->entity_id = $entityId;
                $entity->url = $this->resolveUrl($entity->getRouteKey(), $entityType);
                $entity->entity_category = $this->resolveEntityDisplayCategory($entityType);

                return $entity;
            }
        } catch (Throwable $ex) {
            Log::error('Caught error or exception while trying to resolve database model for entity in structured response', [
                'entity_id' => $entityId,
                'entity_type' => $entityType,
                'with' => $with,
                'exception' => $ex->__toString(),
            ]);
        }

        return null;
    }
}
