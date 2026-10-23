<?php

namespace App\Repositories\Donation;

use App\Data\Donation\FundraiserEventData;
use App\Models\FundraiserEvent;

class FundraiserEventRepository implements FundraiserEventRepositoryInterface
{
    public function create(FundraiserEventData $data): ?FundraiserEvent
    {
        return FundraiserEvent::create([]);
    }

    public function update(FundraiserEventData $data, string $id): bool
    {
        // Find our record then update it. 
        $event = FundraiserEvent::findOrFail($id);
        return $event->updateOrFail($data);
    }
    
    public function getById(string $id):  ?FundraiserEvent
    {
        return FundraiserEvent::where('id', $id)->where('status', 'active')->firstOrFail();
    }
}
