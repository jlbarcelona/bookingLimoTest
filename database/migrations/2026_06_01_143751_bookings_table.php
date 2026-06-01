<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {

            $table->id(); // primary key

            // Reference to clients table
            $table->foreignId('client_id')
                ->constrained('clients')
                ->cascadeOnDelete();

            // Schedule
            $table->date('pickup_date');
            $table->time('pickup_time');

            // Pickup location
            $table->text('pickup_location_address');
            $table->decimal('pickup_location_lat', 10, 7)->nullable();
            $table->decimal('pickup_location_lon', 10, 7)->nullable();

            // Dropoff location
            $table->text('dropoff_location_address');
            $table->decimal('dropoff_location_lat', 10, 7)->nullable();
            $table->decimal('dropoff_location_lon', 10, 7)->nullable();

            $table->timestamps();

            // Index for faster queries
            $table->index(['client_id', 'pickup_date']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};