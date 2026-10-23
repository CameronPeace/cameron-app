<?php


namespace App\Services;

use App\Clients\Payments\Stripe\StripeCheckoutClient;
use App\Services\FundraiserEventService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;
use Stripe\Exception\ApiErrorException;

class DonationCheckoutService
{

    public function __construct(
        private StripeCheckoutClient $client,
        private DonationService $donationService,
        private FundraiserEventService $fundraiserEventService,
        private DonationPaymentService $donationPaymentService
    ) {}

    public function createCheckout(string $amount, string $currency, string $eventId, string $email, string $phone, ?string $firstName = '', ?string $lastName = '')
    {

        $amountInCents = $this->getAmountInCents($amount);
        try {

            $event = $this->fundraiserEventService->getFundraiserEventById($eventId);
            $records = $this->donationService->readyDonation($amount, $currency, $eventId, $email, $phone, $firstName, $lastName);

            $parameters = $this->buildCheckoutParameters($amountInCents, $currency, $event->id, $event->name, $records['donationId']);

            // create the checkout page. 
            $session = $this->client->createCheckoutSession($parameters);

            // add our provider session.
            $this->donationPaymentService->updateProviderSession($session->id, $records['donationPaymentId']);

            return $session;
        } catch (ApiErrorException $exception) {

            // Log the error and pass it along.
            Log::error('Stripe Checkout Session creation failed', [
                'error'  => $exception::class,
                'message' => $exception->getMessage(),
                'code' => $exception->getStripeCode()
            ]);

            throw $exception;
        } catch (ModelNotFoundException $exception) {
            Log::error('Unable to complete database updates for checkout', [
                'error'  => $exception::class,
                'message' => $exception->getMessage(),

            ]);

            throw $exception;
        } catch (\Throwable $exception) {
           Log::error('Unable to generate checkout, something went wrong!', [
                'error'  => $exception::class,
                'message' => $exception->getMessage(),
            ]);

            throw $exception;
        }
    }

    /**
     * Prepare the donation amount in cents for payment providers.
     */
    private function getAmountInCents(string $amount)
    {
        // avoid floating point arithmetic
        // Note we will have to adjust this to deal with currencies with more than 2 decimal places. 
        [$dollars, $cents] = array_pad(explode('.', $amount, 2), 2, '0');
        return ((int) $dollars * 100) + (int) str_pad($cents, 2, '0');
    }

    /**
     * Format checkout payload to create our checkout session.
     * 
     * @param $amountInCents
     * @param $currency
     * @param $eventName
     */
    public function buildCheckoutParameters(int $amountInCents, string $currency, string $eventId, string $eventName, string $donationId)
    {
        return [
            'mode' => 'payment',
            'submit_type' => 'donate',

            'client_reference_id' => $donationId,

            'metadata' => [
                'donation_id' => $donationId,
                'event_id' => $eventId,
            ],

            'line_items' => [
                [
                    'price_data' => [
                        'currency' => strtolower($currency),
                        'product_data' => [
                            'name' => $eventName,
                        ],
                        'unit_amount' => $amountInCents,
                    ],
                    'quantity' => 1,
                ],
            ],

            'success_url' => route(
                'donations.success',
                absolute: true,
            ) . '?session_id={CHECKOUT_SESSION_ID}',

            'cancel_url' => route(
                'donations.cancelled',
                absolute: true,
            ),

            [
                'idempotency_key' =>
                'donation-checkout-' . $donationId,
            ]
        ];
    }
}
