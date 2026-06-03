<?php

namespace App\Services;

use App\Models\Guest;

class GuestService
{
    public function findOrFail(int $guestId)
    {
        return Guest::findOrFail($guestId);
    }

    public function createGuest(array $data)
    {
        // Singleton (WAJIB tugas)
        $config = HotelConfigManager::getInstance();
        $config->getHotelName();
        $config->getHotelAddress();

        return Guest::create($data);
    }
}