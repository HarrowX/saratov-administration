<?php

namespace App\DTOs;

use App\Enums\VisitedStatus;
use App\Models\Attraction;
use App\Models\Hotel;
use App\Models\Restaurant;
use WendellAdriel\ValidatedDTO\ValidatedDTO;

class ChangeVisitStatusDTO extends ValidatedDTO
{
    protected function rules(): array
    {
        return [
            'visitable_type' => ['required', 'string', 'in:' . implode(',', $this->getAllowedVisitableTypes())],
            'visitable_id' => ['required', 'integer'],
        ];
    }

    protected function defaults(): array
    {
        return [];
    }

    protected function casts(): array
    {
        return [];
    }

    private function getAllowedVisitableTypes()
    {
        return [Hotel::class, Attraction::class, Restaurant::class];
    }

    public function messages(): array
    {
        $types = implode(', ', $this->getAllowedVisitableTypes());

        return [

            'visitable_type.string' => 'Тип объекта должен быть строкой',
            'visitable_type.required' => "Тип объекта должен быть одним из: {$types}",
            'visitable_type.in' => "Тип объекта должен быть одним из: {$types}",

            'visitable_id.integer' => 'ID объекта должен быть целым числом',
        ];
    }
}
