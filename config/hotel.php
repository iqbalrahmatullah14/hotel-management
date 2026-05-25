<?php

return [
    'name'               => env('HOTEL_NAME', 'Hotel'),
    'address'            => env('HOTEL_ADDRESS', 'Jl. Merdeka No. 1, Surabaya'),
    'phone'              => env('HOTEL_PHONE', '021-1234567'),
    'tax_rate'           => env('HOTEL_TAX_RATE', 0.11),
    'cancellation_hours' => env('HOTEL_CANCEL_HOURS', 24),
    'cancellation_fee'   => env('HOTEL_CANCEL_FEE', 0.5),

    'room_types' => [
        'standard' => [
            'name'           => 'Standard',
            'price_per_night' => 350000,
            'capacity'       => 2,
            'facilities'     => 'AC, TV, WiFi',
        ],
        'deluxe' => [
            'name'           => 'Deluxe',
            'price_per_night' => 550000,
            'capacity'       => 2,
            'facilities'     => 'AC, TV, WiFi, Mini Bar, Balcony',
        ],
        'suite' => [
            'name'           => 'Suite',
            'price_per_night' => 900000,
            'capacity'       => 4,
            'facilities'     => 'AC, TV, WiFi, Mini Bar, Balcony, Living Room, Bathtub',
        ],
    ],
];
