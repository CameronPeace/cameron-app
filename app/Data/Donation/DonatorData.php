<?php

namespace App\Data\Donation;

readonly class DonatorData
{
    public function __construct(public string $email, public string $phone,  public string $firstName, public string $lastName) {}
}
