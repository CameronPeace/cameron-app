<?php

namespace App\Http\Controllers;

use App\Http\Requests\DonationSubmissionRequest;
use App\Services\DonationService;

class DonationController extends Controller
{

    public function __construct(
        private DonationService $service
    ) {}

    public function index()
    {
        // Get Active fundrasing events

    }

    public function donate(DonationSubmissionRequest $request)
    {
        $donation = $request->validated();

        // Queue our donation submission
        $this->service->queueDonation($donation);
    }
}
