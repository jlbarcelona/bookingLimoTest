<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $table = 'bookings';

    protected $fillable = [
        'client_id',
        'pickup_date',
        'pickup_time',
        'pickup_location_address',
        'pickup_location_lat',
        'pickup_location_lon',
        'dropoff_location_address',
        'dropoff_location_lat',
        'dropoff_location_lon',
    ];

    // Relationships
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function stops()
    {
        return $this->hasMany(LocationStop::class)->orderBy('stop_order');
    }
}