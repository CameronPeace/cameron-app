<?php

namespace App\Repositories\Donation;

use App\Data\Donation\DonatorData;
use App\Models\Donator;

interface DonatorRepositoryInterface
{
    public function create(DonatorData $data): ?Donator;

    public function update(DonatorData $data, int $id): bool;
}
