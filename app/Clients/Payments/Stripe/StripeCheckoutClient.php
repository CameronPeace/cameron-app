<?php

namespace App\Clients\Payments\Stripe;

use Stripe\Checkout\Session;
use Stripe\StripeClient;

class StripeCheckoutClient
{

    public function __construct(
        private StripeClient $stripe
    ) {}

    /**
     * Creates a checkout session.
     *
     * @param $parameters
     */
    public function createCheckoutSession(array $parameters): Session
    {
        return $this->stripe->checkout->sessions->create($parameters);
    }

}
