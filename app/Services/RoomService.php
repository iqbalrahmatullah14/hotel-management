<?php

namespace App\Services;

use App\Models\Room;

/**
 * PANDUAN PENGERJAAN — Anggota B (RoomService)
 *
 * B.1 findAvailable($roomId)
 *     → Cari Room berdasarkan $roomId, return Room jika status='available', null jika tidak
 *
 * B.2 updateStatus($room, $status)
 *     → Update kolom status pada $room (available / occupied / maintenance)
 *
 * B.3 getAvailableRooms($checkIn, $checkOut)
 *     → Query semua kamar yang status='available' DAN tidak ada booking overlap
 *     → Overlap: check_in_date < $checkOut AND check_out_date > $checkIn
 *     → Gunakan whereDoesntHave('bookings', ...) untuk filter overlap
 *     → ⚡ Wajib panggil Singleton: $config = HotelConfigManager::getInstance()
 *       Contoh: $config->getHotelName() atau $config->getTaxRate()
 */
class RoomService
{
    public function findAvailable(int $roomId): ?Room
    {
        //
    }

    public function updateStatus(Room $room, string $status): void
    {
        //
    }

    public function getAvailableRooms(string $checkIn, string $checkOut)
    {
        //
    }
}
