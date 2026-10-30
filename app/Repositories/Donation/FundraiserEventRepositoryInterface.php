<?php

namespace App\Repositories\Donation;

use App\Data\Donation\FundraiserEventData;
use App\Models\Donation\FundraiserEvent;

interface FundraiserEventRepositoryInterface
{
    public function create(FundraiserEventData $data): ?FundraiserEvent;

    public function update(FundraiserEventData $data, string $id): bool;

    public function getById(string $id): ?FundraiserEvent;
}
