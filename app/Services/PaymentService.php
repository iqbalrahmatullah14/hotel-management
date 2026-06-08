<?php

namespace App\Services;

use App\Models\Guest;
use App\Models\Room;
use App\Models\Booking;
use App\Models\Payment;
use App\Services\HotelConfigManager;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class PaymentService
{
    public function createBookingWithPayment(
        Guest $guest,
        Room $room,
        array $data,
        array $pricing
    ): Booking {
        return DB::transaction(function () use ($guest, $room, $data, $pricing) {
            // ⚡ Memanggil instance Singleton sesuai panduan E.1
            $config = HotelConfigManager::getInstance();

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
        }); // <-- Di sini tadi salahnya, sekarang sudah benar ditutup dengan });
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
