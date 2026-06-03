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
        $room = Room::find($roomId);
        if ($room && $room->status === 'available') {
            return $room;
        }
        return null;
    }

    public function updateStatus(Room $room, string $status): void
    {
        $room->update(['status' => $status]);
    }

    public function getAvailableRooms(string $checkIn, string $checkOut)
    {
        $config = HotelConfigManager::getInstance();
        $hotelName = $config->getHotelName();

        return Room::where('status', 'available')
            ->whereDoesntHave('bookings', function ($query) use ($checkIn, $checkOut) {
                $query->where('check_in_date', '<', $checkOut)
                      ->where('check_out_date', '>', $checkIn);
            })
            ->get();
    }
}
