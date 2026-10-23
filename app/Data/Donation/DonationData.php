<?php

namespace App\Data\Donation;

readonly class DonationData
{
    public function __construct(
        public string $donatorId,
        public string $fundraiserEventId,
        public string $amount,
        public string $currency,
        public string $status = 'pending',
    ) {}
}
