<?php

namespace App\Data\Donation;

class FundraiserEventData
{
    public function __construct(
        public readonly string $name,
        public readonly ?string $description,
        public readonly int $goalAmount,
        public readonly string $currency,
        public readonly ?string $startsAt,
        public readonly ?string $endsAt,
        public readonly string $status = 'draft',
    ) {}
}