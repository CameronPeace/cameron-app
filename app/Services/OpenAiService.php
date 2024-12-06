<?php

namespace App\Services;

use App\Exceptions\OpenAiServiceException;
use App\Services\Helpers\OpenAiRequest;
use Illuminate\Database\Eloquent\Casts\Json;

class OpenAiService
{
    /** OpenAiRequest */
    protected $openAiRequest;

    public function __construct(OpenAiRequest $openAiRequest = null)
    {
        $openAiRequest = $openAiRequest ?? new OpenAiRequest();
        $this->setOpenAiRequest($openAiRequest);
    }

    /**
     * Request movie data from ChatGPT.
     *
     * @param int $total The total amount of json objects to ask ChatGPT for.
     *
     * @return Json|null
     * @throws OpenAiServiceException
     */
    public function requestMovieData(int $total)
    {
        try {
            $prompt = sprintf('Using actual existing movies aired in the US between G and R ratings, please create an array of json objects filling the values for these keys (title, genre, director, release_date). Please only return the json with no additional text. Please have at least %d objects in the array. Remove the json label as well.', $total);
            $response = $this->getOpenAiRequest()->sendChatPrompt($prompt);
            return $this->getResponseJsonData($response);
        } catch (\Exception $e) {

            throw new OpenAiServiceException("An unexpected error occurred while requesting movie data: " . $e->getMessage());
        }
    }

    /**
     * Request theater data from ChatGPT.
     *
     * @param int $total The total amount of json objects to ask ChatGPT for.
     *
     * @return Json|null
     * @throws OpenAiServiceException
     */
    public function requestTheaterData(int $total)
    {
        try {
            $prompt = sprintf('Using actual movie theaters in the United States, please populate an array of json objects filling the values with the address of each movie theater following these keys (location_name, city, state, street, zip5). Please only return the json with no additional text. Please have at least %d objects in the array. Remove the json label as well.', $total);
            $response = $this->getOpenAiRequest()->sendChatPrompt($prompt);
            return $this->getResponseJsonData($response);
        } catch (\Exception $e) {
            throw new OpenAiServiceException("An unexpected error occurred while requesting theater data: " . $e->getMessage());
        }
    }

    /**
     * Parse our ChatGPT data and return the response data.
     *
     * @param array $response
     *
     * @return Json|null
     * @throws OpenAiServiceException
     */
    private function getResponseJsonData(array $response)
    {
        try {
            $choices = $response['body']['choices'] ?? [];

            if (empty($choices)) {
                \Log::error($response);
                throw new \Exception('No ChatGPT results provided.');
            }
            // We will only receive one complete response from ChatGPT.
            return $choices[0]['message']['content'];
        } catch (\Exception $e) {

            throw new OpenAiServiceException("ChatGPTException: " . $e->getMessage());
        }
    }

    /**
     * Set an instance of openAiRequest
     *
     * @param \App\Services\Helpers\OpenAiRequest $openAiRequest
     *
     * @return void
     */
    public function setOpenAiRequest(OpenAiRequest $openAiRequest)
    {
        $this->openAiRequest = $openAiRequest;
    }

    /**
     * Return our set OpenAiRequest instance.
     *
     * @return OpenAiRequest
     */
    public function getOpenAiRequest()
    {
        return $this->openAiRequest;
    }
}
