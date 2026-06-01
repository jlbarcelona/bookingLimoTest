<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('location_stops', function (Blueprint $table) {

            $table->id();

            // Foreign key to bookings
            $table->foreignId('booking_id')
                ->constrained('bookings')
                ->cascadeOnDelete();

            // Order of stops (1,2,3,...)
            $table->unsignedInteger('stop_order');

            $table->text('stops_address');

            $table->decimal('lat', 10, 7)->nullable();
            $table->decimal('lon', 10, 7)->nullable();

            $table->timestamps();

            // Indexes for performance
            $table->index('booking_id');
            $table->index(['booking_id', 'stop_order']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('location_stops');
    }
};