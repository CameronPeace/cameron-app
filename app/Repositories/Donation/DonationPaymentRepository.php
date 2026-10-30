<?php

namespace App\Repositories\Donation;

use App\Data\Donation\DonationPaymentData;
use App\Models\Donation\DonationPayment;

class DonationPaymentRepository implements DonationPaymentRepositoryInterface
{
    public function create(DonationPaymentData $data): ?DonationPayment
    {
        return DonationPayment::create([]);
    }

    public function update(array $data, string $id): bool
    {
        // Find our record then update it. 
        $donationPayment = DonationPayment::findOrFail($id);
        return $donationPayment->updateOrFail($data);
    }
}
