<?php

namespace App\Repositories\Donation;

use App\Data\Donation\DonationPaymentData;
use App\Models\DonationPayment;

class DonationPaymentRepository implements DonationPaymentRepositoryInterface
{
    public function create(DonationPaymentData $data): ?DonationPayment
    {
        return DonationPayment::create([]);
    }

    public function update(DonationPaymentData $data, int $id): int
    {
        // Find our record then update it. 
        $donationPayment = DonationPayment::findOrFail($id);
        return $donationPayment->updateOrFail($data);
    }
}
