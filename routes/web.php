<?php

use App\Http\Controllers\DonationCheckoutController;
use Illuminate\Support\Facades\Route;

Route::inertia('donate', 'Donate')->name('donate');

Route::post('donate/checkout', DonationCheckoutController::class)
    ->name('donation.checkout');

Route::inertia('donate/success', 'DonationSuccess')
    ->name('donations.success');

Route::inertia('donate/cancelled', 'Donate')
    ->name('donations.cancelled');

Route::middleware(['auth'])->group(function () {
    Route::inertia('dashboard', 'Dashboard')->name('dashboard');
});

require __DIR__ . '/settings.php';
