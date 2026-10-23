<?php

namespace App\Repositories\Donation;

use App\Data\Donation\FundraiserEvent;

interface FundraiserEventRepositoryIntrerface
{
    public function create(FundraiserEventData $data): ?FundraiserEvent;

    public function update(FundraiserEventData $data, int $id): int;
}
