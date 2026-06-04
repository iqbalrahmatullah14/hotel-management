<?php

namespace App\Services;

use App\Models\Guest;
use App\Models\Room;
use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

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
        return DB::transaction(function () use ($guest, $room, $data, $pricing) {
            $booking = Booking::create([
                'guest_id' => $guest->id,
                'room_id' => $room->id,
                'check_in_date' => $data['check_in_date'],
                'check_out_date' => $data['check_out_date'],
                'total_nights' => $pricing['nights'],
                'total_price' => $pricing['total'],
                'status' => 'confirmed',
            ]);

            Payment::create([
                'booking_id' => $booking->id,
                'amount' => $pricing['subtotal'],
                'tax_amount' => $pricing['tax'],
                'payment_method' => $data['payment_method'],
                'status' => 'pending',
                'paid_at' => null,
            ]);

            return $booking->load(['guest', 'room', 'payment']);
        });
    }

    public function finalizePayment(Booking $booking, array $pricing): void
    {
        $payment = $booking->payment;

        if (!$payment) {
            Payment::create([
                'booking_id' => $booking->id,
                'amount' => $pricing['subtotal'],
                'tax_amount' => $pricing['tax'],
                'payment_method' => 'cash',
                'status' => 'paid',
                'paid_at' => Carbon::now(),
            ]);

            return;
        }

        $payment->update([
            'amount' => $pricing['subtotal'],
            'tax_amount' => $pricing['tax'],
            'status' => 'paid',
            'paid_at' => Carbon::now(),
        ]);
    }
}
