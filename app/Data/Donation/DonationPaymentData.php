<?php

namespace App\Data\Donation;

readonly class DonationPaymentData
{
    public function __construct(
        public string $donationId,
        public string $provider,
        public string $idempotencyKey,
        public string $status = 'pending',
    ) {}
}
