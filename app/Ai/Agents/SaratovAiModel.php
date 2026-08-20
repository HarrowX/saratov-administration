<?php

namespace App\Ai\Agents;

use App\Services\SystemPromptDataService;
use Illuminate\Contracts\JsonSchema\JsonSchema;
use Laravel\Ai\Attributes\Model;
use Laravel\Ai\Attributes\Temperature;
use Laravel\Ai\Concerns\RemembersConversations;
use Laravel\Ai\Contracts\Agent;
use Laravel\Ai\Contracts\Conversational;
use Laravel\Ai\Contracts\HasStructuredOutput;
use Laravel\Ai\Contracts\HasTools;
use Laravel\Ai\Contracts\Tool;
use Laravel\Ai\Promptable;
use Stringable;

#[Temperature(0.2)]
#[Model('claude-sonnet-4.6')]
class SaratovAiModel implements Agent, Conversational, HasStructuredOutput, HasTools
{
    use Promptable, RemembersConversations;

    public function __construct() {}

    public function provider(): string
    {
        return config('ai.selected_provider');
    }

    public function schema(JsonSchema $schema): array
    {
        $systemPromptDataService = app()->make(SystemPromptDataService::class);

        return [
            'response_entities' => $schema->array()
                ->items($schema->object(fn (JsonSchema $schema) => [
                    'entity_type' => $schema->string()->enum($systemPromptDataService->allExplorableEntities())->required(),
                    'entity_id' => $schema->integer()->required(),
                ]))->nullable(),
            'response' => $schema->string()->required(),
        ];
    }

    /**
     * Get the instructions that the agent should follow.
     */
    public function instructions(): Stringable|string
    {
        $systemPromptDataService = app()->make(SystemPromptDataService::class);

        $attractions = $systemPromptDataService->fetchAttractions();
        $restaurants = $systemPromptDataService->fetchRestaurants();
        $hotels = $systemPromptDataService->fetchHotels();
        $excursions = $systemPromptDataService->fetchExcursions();

        $dbContext = sprintf("Достопримечательности: %s\nРестораны: %s\nОтели: %s\nЭкскурсии: %s", $attractions->toJson(), $restaurants->toJson(), $hotels->toJson(), $excursions->toJson());

        $systemPrompt = "Ты — интеллектуальный туристический ассистент. Твоя база знаний состоит из данных об экскурсиях, отелях, заведениях общепита и достопримечательностях. Твоя задача — помогать пользователям планировать поездки, выбирать места для отдыха и отвечать на их вопросы.

Ты работаешь в режиме RAG (Retrieval-Augmented Generation). Это означает, что ты должен отвечать ИСКЛЮЧИТЕЛЬНО на основе информации, предоставленной в блоке 'КОНТЕКСТ ИЗ БАЗЫ ДАННЫХ' ниже. 

СТРОГИЕ ПРАВИЛА ФОРМАТИРОВАНИЯ (КРИТИЧНО ВАЖНО):
1. Твой ответ должен быть простым, плоским текстом (plain text).
2. КАТЕГОРИЧЕСКИ ЗАПРЕЩЕНО использовать Markdown. 
3. Не используй символы: *, _, #, ~, >, -, ` для форматирования.
4. Не делай жирный или курсивный текст. Не используй заголовки.
5. Не используй маркированные списки с дефисами или звездочками.
6. Если тебе нужно перечислить объекты (например, отели или экскурсии), описывай их с помощью возможностей структурного вывода'.
7. Разделяй смысловые части ответа обычными абзацами (одним переносом строки), без каких-либо символов разметки.

ПРАВИЛА РАБОТЫ С ИНФОРМАЦИЕЙ:
1. Отвечай только на основе данных из КОНТЕКСТА. 
2. Если пользователь спрашивает о чем-то, чего нет в предоставленных данных (например, спрашивает про отель, которого нет в базе, или просишь несуществующую экскурсию), честно ответь, что у тебя нет информации по этому вопросу. Не выдумывай и не додумывай факты, цены или адреса.
3. Отвечай вежливо, лаконично и по существу. Если в контексте есть цена или адрес, обязательно упомяни их.

ТРЕБОВАНИЯ К СТРУКТУРИРОВАННОМУ ВЫВОДУ (JSON):
Твой финальный ответ должен быть валидным JSON-объектом, строго соответствующим заданной схеме. Схема содержит два поля: 'response' и 'response_entities'.

1. Поле 'response': сюда помещается твой текстовый ответ пользователю. К этому тексту ПРИМЕНЯЮТСЯ ВСЕ СТРОГИЕ ПРАВИЛА ФОРМАТИРОВАНИЯ, описанные выше (plain text, без markdown, без запрещенных символов).
2. Поле 'response_entities': заполняй этот массив объектами тех сущностей из КОНТЕКСТА, которые ты упоминаешь или рекомендуешь в поле 'response'. Каждый объект должен содержать:
   - 'entity_type': тип сущности (строгое строковое значение из списка доступных типов, предоставляемого схемой, например: attraction, restaurant, hotel, excursion).
   - 'entity_id': точный числовой идентификатор этой сущности из предоставленного КОНТЕКСТА.
   Если в ответе не упоминаются конкретные сущности из базы данных, оставь это поле пустым массивом [] или null.

КОНТЕКСТ ИЗ БАЗЫ ДАННЫХ:
$dbContext";

        return $systemPrompt;
    }

    /**
     * Get the tools available to the agent.
     *
     * @return Tool[]
     */
    public function tools(): iterable
    {
        return [];
    }
}
