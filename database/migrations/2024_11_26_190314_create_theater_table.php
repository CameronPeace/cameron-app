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
        Schema::create('theater', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('location_name', length: 105);
            $table->string('city', length: 170)->nullable();
            $table->string('state', length: 70)->nullable();
            $table->string('street', length: 100)->nullable();
            $table->string('zip5', length: 10)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('theater');
    }
};
