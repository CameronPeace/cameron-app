<?php

namespace App\Services;

use App\Data\Donation\DonationData;
use App\Data\Donation\DonationPaymentData;
use App\Data\Donation\DonatorData;
use App\Repositories\Donation\DonationPaymentRepositoryInterface;
use App\Repositories\Donation\DonationRepositoryInterface;
use App\Repositories\Donation\DonatorRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DonationService
{
    public function __construct(
        private DonationPaymentRepositoryInterface $donationPaymentRepository,
        private DonatorRepositoryInterface $donatorRepository,
        private DonationRepositoryInterface $donationRepository
    ) {}

    public function readyDonation(string $amount, string $currency, string $eventId, string $email, string $phone, ?string $firstName = '', ?string $lastName = '',)
    {
        // If the submission did not include a name, save them as a Anonymous Supporter
        if ($firstName === '' && $lastName === '') {
            $firstName = 'Anonymous';
            $lastName = 'Supporter';
        }

        $donatorDataDto = new DonatorData(
            email: $email,
            phone: $phone,
            firstName: $firstName,
            lastName: $lastName
        );

        // Wrap in transaction to ensure oure relationships are prepared.
        return DB::transaction(function () use ($donatorDataDto, $amount, $currency, $eventId) {
            $donator = $this->donatorRepository->create($donatorDataDto);

            $donationDataDto = new DonationData(
                donatorId: $donator->id,
                fundraiserEventId: $eventId,
                amount: $amount,
                currency: $currency,
                status: 'PENDING'
            );

            $donation = $this->donationRepository->create($donationDataDto);

            $idempotencyKey = 'checkout-' . Str::uuid();

            // Add our donation ID to our payment record.
            // TODO stripe is hardcoded, would need to be updated to support other providers. 
            $donationPaymentDto = new DonationPaymentData(
                donationId: $donation->id,
                provider: 'stripe',
                idempotencyKey: $idempotencyKey,
                status: 'pending'
            );

            $donationPayment = $this->donationPaymentRepository->create($donationPaymentDto);

            return [
                'donationId' => $donation->id,
                'donationPaymentId' => $donationPayment->id
            ];
        });
    }
}
