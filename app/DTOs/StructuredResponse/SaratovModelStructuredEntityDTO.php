<?php

namespace App\DTOs\StructuredResponse;

use App\Services\SystemPromptDataService;
use Illuminate\Database\Eloquent\Model;
use WendellAdriel\ValidatedDTO\ValidatedDTO;

class SaratovModelStructuredEntityDTO extends ValidatedDTO
{
    public string $entity_id;

    public string $entity_type;

    protected function rules(): array
    {
        $systemPromptDataService = app()->make(SystemPromptDataService::class);
        $entityTypes = $systemPromptDataService->allExplorableEntities();

        return [
            'entity_id' => ['required', 'string'],
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

    public function toActualModel(): ?Model
    {
        if (class_exists($this->entity_type) && method_exists($this->entity_type, 'query')) {
            $entity = $this->entity_type::query()?->where($this->entity_id)?->first();

            return $entity;
        }

        return null;
    }
}
