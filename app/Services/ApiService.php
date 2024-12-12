<?php

namespace App\Services;

use App\Exceptions\ApiServiceException;
use App\Services\Helpers\ApiRequest;

class ApiService
{
    protected $apiRequest;

    public function __construct(ApiRequest $apiRequest = new ApiRequest())
    {
       $this->setApiRequest($apiRequest);
    }

    /**
     * Get the top performing theaters from our Api.
     *
     * @param string $fromDate
     * @param string $toDate
     * @param int $limit
     *
     * @return array
     */
    public function getTopTheaters(string $fromDate, string $toDate, int $limit): array
    {
        $requestParams = ['fromDate' => $fromDate, 'toDate' => $toDate, 'limit' => $limit];
       
        $response = $this->getApiRequest()->requestTopTheaters($requestParams);

        if (isset($response['status']) && $response['status'] === false) {
            throw new ApiServiceException($response['message'] ?? 'An error occurred while requesting top theater data.');
        }

        return $response;
    }

    /**
     * Get the top performing movies from our Api.
     *
     * @param string $fromDate
     * @param string $toDate
     * @param int $limit
     *
     * @return array
     */
    public function getTopMovies(string $fromDate, string $toDate, int $limit): array
    {
        $requestParams = ['fromDate' => $fromDate, 'toDate' => $toDate, 'limit' => $limit];

        $response = $this->getApiRequest()->requestTopMovies($requestParams);

        if (isset($response['status']) && $response['status'] === false) {
            throw new ApiServiceException($response['message'] ?? 'An error occurred while requesting top movie data.');
        }

        return $response;
    }

    /** 
     * Set our apiRequest instance  
     * @param apiRequest $apiRequest
     */
    public function setApiRequest(Object $apiRequest)
    {
        $this->apiRequest = $apiRequest;
    }

    /**
     * Get our apiRequest instance.
     *
     * @return ApiRequest
     */
    public function getApiRequest()
    {
        return $this->apiRequest;
    }
}
