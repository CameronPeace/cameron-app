<?php

namespace App\Services;

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
       
        return $this->getApiRequest()->requestTopTheaters($requestParams);
    }

    public function getTopMovies(strong $fromDate, string $toDate, int $limit)
    {
        $requestParams = ['fromDate' => $fromDate, 'toDate' => $toDate, 'limit' => $limit];

        return $this->getApiRequest()->requestTopMovies($requestParams);
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
