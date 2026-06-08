<?php

namespace App\Facades;

use App\Models\Booking;
use App\Services\RoomService;
use App\Services\GuestService;
use App\Services\PricingService;
use App\Services\PaymentService;
use App\Services\HotelConfigManager;
use Illuminate\Support\Facades\DB;

class BookingFacade
{
    protected RoomService $roomService;
    protected GuestService $guestService;
    protected PricingService $pricingService;
    protected PaymentService $paymentService;

    public function __construct(
        RoomService $roomService,
        GuestService $guestService,
        PricingService $pricingService,
        PaymentService $paymentService
    ) {
        $this->roomService    = $roomService;
        $this->guestService   = $guestService;
        $this->pricingService = $pricingService;
        $this->paymentService = $paymentService;
    }

    public function createBooking(array $data): array
    {
        return DB::transaction(function () use ($data) {
            $guest = $this->guestService->findOrFail($data['guest_id']);

            $room = $this->roomService->findAvailable($data['room_id']);
            if (!$room) {
                return ['success' => false, 'message' => 'Kamar tidak tersedia'];
            }

            $pricing = $this->pricingService->calculate(
                $room,
                $data['check_in_date'],
                $data['check_out_date']
            );

            $booking = $this->paymentService->createBookingWithPayment(
                $guest,
                $room,
                $data,
                $pricing
            );

            $this->roomService->updateStatus($room, 'occupied');

            return ['success' => true, 'booking' => $booking];
        });
    }

    public function cancelBooking(int $bookingId): array
    {
        $booking = Booking::findOrFail($bookingId);

        // Cek apakah masih bisa dibatalkan
        $config = HotelConfigManager::getInstance();
        if (!$config->isCancellable($booking->check_in_date)) {
            return [
                'success' => false,
                'message' => "Pembatalan hanya bisa dilakukan {$config->getCancellationHours()} jam sebelum check-in."
            ];
        }

        $this->roomService->updateStatus($booking->room, 'available');
        $booking->update(['status' => 'cancelled']);

        return ['success' => true, 'message' => 'Booking berhasil dibatalkan'];
    }

    public function processCheckOut(int $bookingId): array
    {
        $booking = Booking::findOrFail($bookingId);
        $pricing = $this->pricingService->calculateFinal($booking);
        $this->paymentService->finalizePayment($booking, $pricing);
        $this->roomService->updateStatus($booking->room, 'available');
        $booking->update(['status' => 'checked_out']);

        return ['success' => true, 'booking' => $booking->fresh(), 'invoice' => $pricing];
    }

    public function processCheckIn(int $bookingId): array
    {
        $booking = Booking::findOrFail($bookingId);

        if ($booking->status !== 'confirmed') {
            return ['success' => false, 'message' => 'Booking belum dikonfirmasi'];
        }

        $booking->update(['status' => 'checked_in']);

        return ['success' => true, 'booking' => $booking->fresh()];
    }
}
