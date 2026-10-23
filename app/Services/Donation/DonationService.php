<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

Class DonationService 
{
    public function ___construct(private DonationRepositoryInterface $repository)
    {

    }

    public function queueDonation(string $amount, string $currency, string $email, string $phone, ?string $firstName = '', ?string $lastName = '', )
    {

        // If the submission did not include a name, save them as a Anonymous Supporter
        if ($firstName === '' && $lastName === '') {
            $firstName = 'Anonymous';
            $lastName = 'Supporter';
        }

        $idempotencyKey = Str::uuid()->toString();

         // shorthand define our data
        $donationData = [
            // :$amount,
            // :$currency, 
            // :$email,
            // :$phone,
            // :$firstName,
            // :$lastName
            // :$idempotencyKey
        ];

        // Wrap in transaction to prevent job queuing not assocated with a database record
        DB::transaction(function () use ($donationData) {
            $donation = $this->donationRepository->create($donationData);

            //fire the job once we have our record.
            ProcessDonationJob::dispatch($donation->id)->afterCommit();
        });
        

    }
}
