<?php

namespace App\Repositories\Donation;

use App\Data\Donation\DonatorData;
use App\Models\Donator;

class DonatorRepository implements DonatorRepositoryInterface
{
    public function create(DonatorData $data): ?Donator
    {
        return Donator::create([]);
    }

    public function update(DonatorData $data, int $id): bool
    {
        // Find our record then update it. 
        $donator = Donator::findOrFail($id);
        return $donator->updateOrFail($data);
    }
}
