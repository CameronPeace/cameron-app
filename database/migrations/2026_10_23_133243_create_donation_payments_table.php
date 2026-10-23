<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('donation_payments', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->foreignUuid('donation_id')
                ->constrained('donations')
                ->restrictOnDelete();

            $table->string('provider')->default('stripe');
            $table->string('idempotency_key')->unique();

            // Provider Checkout Session ID.
            $table->string('provider_session_id')->nullable()->unique();

            // Provider PaymentIntent ID, when available.
            $table->string('provider_payment_intent_id')
                ->nullable()
                ->unique();

            $table->string('status')->default('PENDING');

            $table->timestamps();

            $table->index(['donation_id', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('donation_payments');
    }
};