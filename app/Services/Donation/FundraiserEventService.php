<?php

namespace App\Services;

use App\Repositories\Donation\FundraiserEventRepositoryInterface;



class FundraiserEventService
{
    public function __construct(
        private FundraiserEventRepositoryInterface $fundraiserEventRepository,
    ) {}

    public function getFundraiserEventById(string $id)
    {
        return $this->fundraiserEventRepository->getById($id);
    }
}
