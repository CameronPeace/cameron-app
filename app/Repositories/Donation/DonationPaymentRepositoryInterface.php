<?php

namespace App\Repositories\Donation;

use App\Data\Donation\DonationPaymentData;
use App\Models\DonationPayment;

interface DonationPaymentRepositoryInterface
{
    public function create(DonationPaymentData $data): ?DonationPayment;

    public function update(array $data, string $id): bool;
}
