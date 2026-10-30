<?php

namespace App\Repositories\Donation;

use App\Data\Donation\DonationPaymentData;
use App\Models\Donation\DonationPayment;

interface DonationPaymentRepositoryInterface
{
    public function create(DonationPaymentData $data): ?DonationPayment;

    public function update(array $data, string $id): bool;
}
