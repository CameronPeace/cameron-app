<?php

namespace App\Data\Donation;

readonly class DonationPaymentData
{
    public function __construct(public string $amount, public string $currency, public string $idempotencyKey, public string $donatorId) {}
}
