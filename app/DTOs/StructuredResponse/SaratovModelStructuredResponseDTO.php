<?php

namespace App\DTOs\StructuredResponse;

use Illuminate\Support\Collection;
use WendellAdriel\ValidatedDTO\Casting\CollectionCast;
use WendellAdriel\ValidatedDTO\Casting\DTOCast;
use WendellAdriel\ValidatedDTO\ValidatedDTO;

class SaratovModelStructuredResponseDTO extends ValidatedDTO
{
    public string $response;

    /**
     * @var Collection<SaratovModelStructuredEntityDTO>
     */
    public Collection $response_entities;

    protected function rules(): array
    {
        return [
            'response' => ['required', 'string', 'min:1'],
        ];
    }

    protected function defaults(): array
    {
        return [
            'response_entities' => [],
        ];
    }

    protected function casts(): array
    {
        return [
            'response_entities' => new CollectionCast(new DTOCast(SaratovModelStructuredEntityDTO::class)),
        ];
    }
}
