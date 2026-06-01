<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table = 'clients';

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'contact_number',
    ];

    // Relationships
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    // Helper (optional)
    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }
}