<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = [
        'type',
        'room_number',
        'floor',
        'status',
    ];

    public function getRoomTypeConfigAttribute(): array
    {
        return config("hotel.room_types.{$this->type}", [
            'name' => ucfirst($this->type),
            'price_per_night' => 0,
            'capacity' => 0,
            'facilities' => '',
        ]);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
