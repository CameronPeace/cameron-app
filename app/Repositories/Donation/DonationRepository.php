<?php

namespace App\Repositories\Donation;

use App\Data\Donation\DonationData;
use App\Models\Donation;

class DonationRepository implements DonationRepositoryInterface
{
    public function create(DonationData $data): ?Donation
    {
        return Donation::create([]);
    }

    public function update(DonationData $data, int $id): int
    {
        // Find our record then update it. 
        $donator = Donation::findOrFail($id);
        return $donator->updateOrFail($data);
    }
}
