<?php

namespace App\Repositories\Donation;

use App\Data\Donation\DonationData;
use App\Models\Donation\Donation;

interface DonationRepositoryInterface
{
    public function create(DonationData $data): ?Donation;

    public function update(DonationData $data, int $id): bool;
}
