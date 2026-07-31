<?php

namespace App\Ai\Agents;

use App\Services\SystemPromptDataService;
use Laravel\Ai\Attributes\Model;
use Laravel\Ai\Attributes\Provider;
use Laravel\Ai\Attributes\Temperature;
use Laravel\Ai\Concerns\RemembersConversations;
use Laravel\Ai\Contracts\Agent;
use Laravel\Ai\Contracts\Conversational;
use Laravel\Ai\Contracts\HasTools;
use Laravel\Ai\Contracts\Tool;
use Laravel\Ai\Enums\Lab;
use Laravel\Ai\Promptable;
use Stringable;

#[Temperature(0.2)]
#[Model('claude-sonnet-4.6')]
#[Provider(Lab::Anthropic)]
class SaratovAiModel implements Agent, Conversational, HasTools
{
    use Promptable, RemembersConversations;

    public function __construct() {}

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
6. Если тебе нужно перечислить несколько объектов (например, отели или экскурсии), пиши их сплошным текстом через запятую, точку с запятой, либо используй цифры в круглых скобках. Пример правильного перечисления: 'Вам подойдут следующие варианты: (1) Отель Солнечный, (2) Гостевой дом У моря, (3) Апарт-отель Центральный'.
7. Разделяй смысловые части ответа обычными абзацами (одним переносом строки), без каких-либо символов разметки.

ПРАВИЛА РАБОТЫ С ИНФОРМАЦИЕЙ:
1. Отвечай только на основе данных из КОНТЕКСТА. 
2. Если пользователь спрашивает о чем-то, чего нет в предоставленных данных (например, спрашивает про отель, которого нет в базе, или просишь несуществующую экскурсию), честно ответь, что у тебя нет этой информации в текущей базе данных. Не выдумывай и не додумывай факты, цены или адреса.
3. Отвечай вежливо, лаконично и по существу. Если в контексте есть цена или адрес, обязательно упомяни их.

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
