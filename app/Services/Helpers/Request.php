<?php

namespace App\Services\Helpers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

abstract class Request
{

    /**
     * @var GuzzleHttp Client
     */
    private $client;

    /**
     * @var string The Api Jwt Token
     */
    private $authorizationToken;

    public function __construct()
    {
        $this->client = new Client();
        $this->setAutorizationToken('');
    }

    /**
     * Use guzzle to make our request.
     *
     * @param string $method The reqeust method.
     * @param string $path The request path.
     * @param array $params The request query params
     *
     * @return array
     */
    public function call(string $method, string $path, array $params = array()): array
    {
        try {
            $url = $this->getRequestUrl($path);

            $guzzleSettings = $this->getRequestSettings($method, $params);

            $guzzleResponse = $this->client->request($method, $url, $guzzleSettings);

            $response = array(
                'body' => json_decode($guzzleResponse->getBody(), true),
                'status' => $guzzleResponse->getStatusCode()
            );

            return $response;
        } catch (GuzzleException $e) {
            \Log::error($e);
        }

        return ['status' => 'error'];
    }

    /**
     * Build our api request.
     *
     * @param string $method
     * @param array $params
     *
     * @return array
     */
    protected function getRequestSettings(string $method, array $params = array()): array
    {
        $guzzleSettings = array(
            'connect_timeout' => 60,
            'timeout' => 60,
            'headers' => array(
                'Authorization' => 'Bearer ' . $this->getAuthorizationToken(),
                'accept' => 'application/json',
            ),
        );

        // Add the query parameters or message body
        if (strtoupper($method) === 'GET') {
            $guzzleSettings['query'] = $params;
        } else {
            $guzzleSettings['json'] = $params;
        }

        $guzzleSettings['headers']['Content-Type'] = 'application/json; charset=utf-8';

        return $guzzleSettings;
    }

    /**
     * Builds the URL that requests should be sent to.
     *
     * @param string $path Path for the call.
     *
     * @return string URL of the request
     */
    abstract protected function getRequestUrl(string $path);

    /**
     * Set authorization token
     *
     * @param string $token
     *
     * @return void
     */
    protected function setAutorizationToken(string $token = '')
    {
        $this->authorizationToken = $token;
    }

    /**
     * Return authorization token.
     *
     * @return string
     */
    protected function getAuthorizationToken(): string
    {
        return $this->authorizationToken;
    }
}
