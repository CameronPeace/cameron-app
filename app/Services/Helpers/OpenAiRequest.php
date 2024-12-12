<?php

namespace App\Services\Helpers;

use App\Services\Helpers\Request;

class OpenAiRequest extends Request
{

	/**
	 * Main OPEN AI API URL
	 */
	private const OPENAI_API_URL = 'https://api.openai.com';

	/* The current Api Version */
	private const OPENAI_API_VERSION = 'v1';

	/* The default AI model to use */
	private const DEFAULT_AI_MODEL = 'gpt-4o-mini';

	/**
	 * @var string The OpenAI API Token.
	 */
	private $authorizationToken;

	public function __construct()
	{
        parent::__construct();
		$this->setAutorizationToken(config('app.open_ai_secret'));
	}

	/**
	 * Builds the URL that requests should be sent to.
	 *
	 * @param string $path Path for the call.
	 *
	 * @return string URL of the request
	 */
	protected function getRequestUrl(string $path): string
	{
		return self::OPENAI_API_URL . '/' . $path;
	}

	/**
	 * Send a prompt to the OpenAI Chat API and get a response.
	 *
	 * @param string $prompt
	 * @return array $response
	 */
	public function sendChatPrompt(string $prompt)
	{
		$payload = [
			'model' => self::DEFAULT_AI_MODEL,
			"seed" => 1, // Will make a best effort to sample deterministically, such that repeated requests with the same seed and parameters should return the same result.
			"temperature" => 0.2, // Higher values like 0.8 will make the output more random, while lower values like 0.2 will make it more focused and deterministic. MAX LIMIT: 2.
			'messages' => [['role' => 'user', 'content' => $prompt]]
		];

		return $this->call('POST', self::OPENAI_API_VERSION . '/chat/completions', $payload);
	}
}
