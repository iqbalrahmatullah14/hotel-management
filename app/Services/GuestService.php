<?php

namespace App\Services;

use App\Models\Guest;

/**
 * PANDUAN PENGERJAAN — Anggota C (GuestService)
 *
 * C.1 findOrFail($guestId)
 *     → Cari tamu: return Guest::findOrFail($guestId)
 *
 * C.2 createGuest($data)
 *     → Buat record Guest baru dari $data (name, email, phone, id_number, address)
 *     → ⚡ Wajib panggil Singleton: $config = HotelConfigManager::getInstance()
 *       Contoh: $config->getHotelName(), $config->getHotelAddress()
 *     → Return object Guest yang baru dibuat
 */
class GuestService
{
    public function findOrFail(int $guestId)
    {
        //
    }

    public function createGuest(array $data)
    {
        //
    }
}
