<?php

namespace App\Services;

use App\Data\Donation\DonationPaymentData;
use App\Data\Donation\DonatorData;
use App\Jobs\ProcessDonationPaymentJob;
use App\Repositories\Donation\DonationPaymentRepositoryInterface;
use App\Repositories\Donation\DonatorRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DonationService
{
    public function __construct(
        private DonationPaymentRepositoryInterface $donationPaymentRepository,
        private DonatorRepositoryInterface $donatorRepository
    ) {}

    public function queueDonation(string $amount, string $currency, string $email, string $phone, ?string $firstName = '', ?string $lastName = '',)
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

        $idempotencyKey = Str::uuid()->toString();

        // Wrap in transaction to prevent a job queuing without the needed table records.
        DB::transaction(function () use ($donatorDataDto, $amount, $currency, $idempotencyKey) {
            $donator = $this->donatorRepository->create($donatorDataDto);

            // Add our donator ID to our payment record.
            $donationPaymentDto = new DonationPaymentData(
                amount: $amount,
                currency: $currency,
                idempotencyKey: $idempotencyKey,
                donatorId: $donator->id
            );

            $donationPayment = $this->donationPaymentRepository->create($donationPaymentDto);

            //fire the job once we have our record.
            ProcessDonationPaymentJob::dispatch($donationPayment->id)->afterCommit();
        });
    }
}
