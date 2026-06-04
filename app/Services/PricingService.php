<?php

namespace App\Services;

use App\Models\Room;
use Carbon\Carbon;


class PricingService
{
    public function calculate(Room $room, string $checkIn, string $checkOut): array
    {
        $config = HotelConfigManager::getInstance();

        $nights = Carbon::parse($checkIn)->diffInDays(Carbon::parse($checkOut));
        $roomType = $room->room_type_config;
        $subtotal = $roomType['price_per_night'] * $nights;
        $tax = $config->calculateTax($subtotal);

        return [
            'nights'   => $nights,
            'subtotal' => $subtotal,
            'tax_rate' => $config->getTaxRate(),
            'tax'      => $tax,
            'total'    => $subtotal + $tax,
        ];
    }

    public function calculateFinal($booking): array
    {
        $config = HotelConfigManager::getInstance();

        $subtotal = $booking->total_price / (1 + $config->getTaxRate());
        $tax = $config->calculateTax($subtotal);

        return [
            'subtotal' => round($subtotal, 2),
            'tax'      => round($tax, 2),
            'total'    => $booking->total_price,
        ];
    }
}
