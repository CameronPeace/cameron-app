<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('donations', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->foreignUuid('donator_id')
                ->constrained('donators')
                ->restrictOnDelete();

            $table->foreignUuid('fundraiser_event_id')
                ->constrained('fundraiser_events')
                ->restrictOnDelete();

            // Store the amount in minor units
            $table->bigInteger('amount');
            $table->char('currency', 3)->default('USD');

            $table->string('status')->default('pending');

            $table->timestamps();

            $table->index(['fundraiser_event_id', 'status']);
            $table->index(['donator_id', 'created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('donations');
    }
};