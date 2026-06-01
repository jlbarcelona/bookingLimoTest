<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LocationStop extends Model
{
    protected $table = 'location_stops';

    protected $fillable = [
        'booking_id',
        'stop_order',
        'stops_address',
        'lat',
        'lon',
    ];

    // Relationships
    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}