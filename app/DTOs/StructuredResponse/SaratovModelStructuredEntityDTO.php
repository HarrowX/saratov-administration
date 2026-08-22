<?php

namespace App\DTOs\StructuredResponse;

use App\Services\SystemPromptDataService;
use WendellAdriel\ValidatedDTO\ValidatedDTO;

class SaratovModelStructuredEntityDTO extends ValidatedDTO
{
    public int $entity_id;

    public string $entity_type;

    protected function rules(): array
    {
        $systemPromptDataService = app()->make(SystemPromptDataService::class);
        $entityTypes = $systemPromptDataService->allExplorableEntities();

        return [
            'entity_id' => ['required', 'numeric'],
            'entity_type' => ['required', 'string', 'in:'.implode(',', $entityTypes)],
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
}
