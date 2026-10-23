<?php

namespace App\Http\Controllers;

use App\Http\Requests\DonationSubmissionRequest;
use App\Services\DonationCheckoutService;
use Inertia\Inertia;

class DonationCheckoutController extends Controller
{

    public function __construct(private DonationCheckoutService $service){
        
    }
    /**
     * Handle the incoming request.
     */
    public function __invoke(DonationSubmissionRequest $request)
    {
        $donation = $request->validated(); 

        $session = $this->service->createCheckout($donation['amount'], $donation['currency'], $donation['event_id'], $donation['email'], $donation['phone'], $donation['first_name'], $donation['last_name']);

        return Inertia::location($session->url);
    }
}
