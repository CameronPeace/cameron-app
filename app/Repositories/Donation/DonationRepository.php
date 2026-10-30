<?php

namespace App\Repositories\Donation;

use App\Data\Donation\DonationData;
use App\Models\Donation\Donation;

class DonationRepository implements DonationRepositoryInterface
{
    public function create(DonationData $data): ?Donation
    {
        return Donation::create([]);
    }

    public function update(DonationData $data, int $id): bool
    {
        // Find our record then update it. 
        $donationData = Donation::findOrFail($id);
        return $donationData->updateOrFail($data);
    }
}
