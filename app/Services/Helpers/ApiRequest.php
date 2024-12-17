<?php

namespace App\Services\Helpers;

use App\Services\Helpers\Request;
use App\Services\JwtService;

class ApiRequest extends Request
{

    /**
     * @var string The Api Jwt Token
     */
    private $authorizationToken;

    public function __construct()
    {
        parent::__construct();

        // TODO we can cache this key and reuse it until it expires. Need to setup redis.
        $this->setAutorizationToken(app(JwtService::class)->generate());
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
        return config('app.api_url') . '/' . $path;
    }

    /**
     * Request top theater data from our internal api.
     *
     * @param array $queryParams
     *
     * @return array
     */
    public function requestTopTheaters(array $queryParams): array
    {
        return $this->call('GET', 'theaters/top', $queryParams);
    }

    /**
     * Request top movie data from our internal api.
     *
     * @param array $queryParams
     *
     * @return array
     */
    public function requestTopMovies(array $queryParams): array
    {
        return $this->call('GET', 'movies/top', $queryParams);
    }
}
