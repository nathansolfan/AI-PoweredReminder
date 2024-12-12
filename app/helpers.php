<?php

use OpenAI\Client;

if (!function_exists('generateAIDescription')) {
    /**
     * Generate an AI-powered description based on the task title and deadline.
     *
     * @param string $taskTitle
     * @param string|null $deadline
     * @return string
     */
    function generateAIDescription(string $taskTitle, ?string $deadline = null): string
    {
        $client = \OpenAI::client(config('services.openai.api_key'));

        $prompt = "Here is a task: '{$taskTitle}'. The deadline is: '{$deadline}'. Generate a creative and concise description for this task.";

        $response = $client->chat()->create([
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                ['role' => 'system', 'content' => 'You are a productivity assistant who generates task descriptions.'],
                ['role' => 'user', 'content' => $prompt],
            ],
        ]);

        return $response->choices[0]['message']['content'];
    }
}