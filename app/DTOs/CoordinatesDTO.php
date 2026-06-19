<?php

namespace App\DTOs;

use WendellAdriel\ValidatedDTO\ValidatedDTO;

class CoordinatesDTO extends ValidatedDTO
{
    protected function rules(): array
    {
        return [
            'latitude' => ['required', 'numeric', 'between:-90,90'],
            'longitude' => ['required', 'numeric', 'between:-180,180'],
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

    public function messages(): array
    {
        return [
            'latitude.required' => 'Широта обязательна для заполнения',
            'latitude.numeric' => 'Широта должна быть числом',
            'latitude.between' => 'Широта должна быть между -90 и 90 градусами',
            'longitude.required' => 'Долгота обязательна для заполнения',
            'longitude.numeric' => 'Долгота должна быть числом',
            'longitude.between' => 'Долгота должна быть между -180 и 180 градусами',
        ];
    }
}
