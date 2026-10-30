<?php

namespace App\Services\Donation;

use App\Repositories\Donation\DonationPaymentRepositoryInterface;



class DonationPaymentService
{
    public function __construct(
        private DonationPaymentRepositoryInterface $donationPaymentRepository,
    ) {}

   public function updateProviderSession(string $providerSessionId, string $id)
   {
        return $this->donationPaymentRepository->update(['provider_session_id', $providerSessionId], $id);
   }
   
}
