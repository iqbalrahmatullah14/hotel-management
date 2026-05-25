<?php

namespace Database\Seeders;

use App\Models\Room;
use App\Models\Guest;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Kamar 
        $rooms = [
            ['type' => 'standard', 'room_number' => '101', 'floor' => 1],
            ['type' => 'standard', 'room_number' => '102', 'floor' => 1],
            ['type' => 'standard', 'room_number' => '103', 'floor' => 1],
            ['type' => 'deluxe',   'room_number' => '201', 'floor' => 2],
            ['type' => 'deluxe',   'room_number' => '202', 'floor' => 2],
            ['type' => 'deluxe',   'room_number' => '203', 'floor' => 2],
            ['type' => 'suite',    'room_number' => '301', 'floor' => 3],
            ['type' => 'suite',    'room_number' => '302', 'floor' => 3],
        ];

        foreach ($rooms as $room) {
            Room::create(array_merge($room, ['status' => 'available']));
        }

        // Tamu Contoh
        Guest::create([
            'name' => 'Budi Santoso',
            'email' => 'budi@example.com',
            'phone' => '081234567890',
            'id_number' => '3201010101010001',
            'address' => 'Jl. Sudirman No. 10, Jakarta',
        ]);

        Guest::create([
            'name' => 'Siti Aminah',
            'email' => 'siti@example.com',
            'phone' => '081298765432',
            'id_number' => '3201020202020002',
            'address' => 'Jl. Gatot Subroto No. 5, Bandung',
        ]);

        Guest::create([
            'name' => 'Andi Wijaya',
            'email' => 'andi@example.com',
            'phone' => '081311112222',
            'id_number' => '3201030303030003',
            'address' => 'Jl. Diponegoro No. 15, Surabaya',
        ]);
    }
}
