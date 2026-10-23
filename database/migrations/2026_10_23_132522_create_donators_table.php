<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('donators', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->string('email');
            $table->string('phone')->nullable();
            $table->string('first_name')->default('Anonymous');
            $table->string('last_name')->default('Supporter');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('donators');
    }
};
