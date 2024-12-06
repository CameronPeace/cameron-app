<?php

namespace Tests\Unit;

use App\Services\ApiService;
use PHPUnit\Framework\TestCase;

class ApiServiceTest extends TestCase
{

    /**
     * Test the getTopTheaters function returns expected data.
     *
     * @return void
     */
    public function testGetTopTheatersSuccess()
    {
        $limit = 5;
        $fromDate = '2024-01-01 00:00:00';
        $toDate = '2025-01-01 00:00:00';

        $return = [
            'theater_id' => 1,
            'theater_name' => 'test',
            'theater_city' => 'test',
            'theater_state' => 'test',
            'theater_street' => 'test',
            'theater_zip5' => 'test',
            'total_theater_sales' => 'test'
        ];

        $mock = $this->getMockBuilder('App\Services\Helpers\ApiRequest')
            ->disableOriginalConstructor()
            ->getMock();

        $mock->method('requestTopTheaters')->willReturn($return);

        $service = new ApiService($mock);

        $theaters = $service->getTopTheaters($fromDate, $toDate, $limit);

        $this->assertNotEmpty($theaters);
        $this->assertEqualsCanonicalizing($return, $theaters);
    }
}
