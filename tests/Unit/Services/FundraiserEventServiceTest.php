<?php

use App\Models\Donation\FundraiserEvent;
use App\Repositories\Donation\FundraiserEventRepositoryInterface;
use App\Services\Donation\FundraiserEventService;
use Illuminate\Support\Str;
use Mockery;
use Tests\TestCase;

class FundraiserEventServiceTest extends TestCase
{
    private FundraiserEventRepositoryInterface $fundraiserEventRepository;
    private FundraiserEventService $fundraiserEventService;
    
    protected function setUp(): void
    {
        parent::setUp();

        $this->fundraiserEventRepository = Mockery::mock(FundraiserEventRepositoryInterface::class);

        $this->fundraiserEventService = new FundraiserEventService($this->fundraiserEventRepository);
    }

    public function test_get_fundraiser_event_by_id() 
    {
        $fundraiserEvent = new FundraiserEvent();
        $fundraiserEvent->id = (string) Str::uuid();

        $this->fundraiserEventRepository
            ->shouldReceive('getById')
            ->once()
            ->with($fundraiserEvent->id)
            ->andReturn($fundraiserEvent);

        $returnedEvent = $this->fundraiserEventService->getFundraiserEventById($fundraiserEvent->id);

        $this->assertSame($fundraiserEvent, $returnedEvent);
    }
}