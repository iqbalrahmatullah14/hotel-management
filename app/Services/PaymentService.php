<?php

namespace App\Services;

use App\Models\Guest;
use App\Models\Room;
use App\Models\Booking;
use App\Models\Payment;

/**
 * PANDUAN PENGERJAAN — Anggota E (PaymentService)
 *
 * E.1 createBookingWithPayment($guest, $room, $data, $pricing)
 *     → ⚡ Wajib panggil Singleton: $config = HotelConfigManager::getInstance()
 *       Contoh: $config->calculateTax(), $config->getTaxRate()
 *     → Buat record Booking: guest_id, room_id, check_in_date, check_out_date,
 *       total_nights ($pricing['nights']), total_price ($pricing['total']), status='confirmed'
 *     → Buat record Payment: booking_id, amount ($pricing['subtotal']),
 *       tax_amount ($pricing['tax']), payment_method, status='pending'
 *     → Return object Booking
 *
 * E.2 finalizePayment($booking, $pricing)
 *     → Ambil $booking->payment
 *     → Update: amount, tax_amount, status='paid', paid_at=now()
 *     → Jika payment belum ada: throw exception atau buat baru
 */
class PaymentService
{
    public function createBookingWithPayment(
        Guest $guest,
        Room $room,
        array $data,
        array $pricing
    ): Booking {
        //
    }

    public function finalizePayment(Booking $booking, array $pricing): void
    {
        //
    }
}
