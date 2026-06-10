<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Guest;
use App\Models\Room;
use App\Facades\BookingFacade;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    protected BookingFacade $bookingFacade;

    public function __construct(BookingFacade $bookingFacade)
    {
        $this->bookingFacade = $bookingFacade;
    }

    public function index()
    {
        $bookings = Booking::with(['guest', 'room'])->latest()->get();

        return view('bookings.index', compact('bookings'));
    }

    public function create()
    {
        $guests = Guest::query()->orderBy('name')->get();
        $rooms = Room::query()
            ->where('status', 'available')
            ->orderBy('room_number')
            ->get();

        return view('bookings.create', compact('guests', 'rooms'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'guest_id' => ['required', 'exists:guests,id'],
            'room_id' => ['required', 'exists:rooms,id'],
            'check_in_date' => ['required', 'date', 'after_or_equal:today'],
            'check_out_date' => ['required', 'date', 'after:check_in_date'],
            'payment_method' => ['required', 'in:cash,transfer,card'],
        ]);

        try {
            $result = $this->bookingFacade->createBooking($validated);
        } catch (\Throwable $e) {
            return back()->withInput()->with('error', 'Gagal membuat booking. Pastikan modul pendukung sudah terintegrasi.');
        }

        if (!($result['success'] ?? false)) {
            return back()->withInput()->with('error', $result['message'] ?? 'Gagal membuat booking');
        }

        return redirect()
            ->route('bookings.show', $result['booking']->id)
            ->with('success', 'Booking berhasil dibuat!');
    }

    public function show(int $id)
    {
        $booking = Booking::with(['guest', 'room', 'payment'])->findOrFail($id);

        return view('bookings.show', compact('booking'));
    }

    public function checkin(int $id)
    {
        try {
            $result = $this->bookingFacade->processCheckIn($id);
        } catch (\Throwable $e) {
            return back()->with('error', 'Gagal check-in. Pastikan modul pendukung sudah terintegrasi.');
        }

        if (!($result['success'] ?? false)) {
            return back()->with('error', $result['message'] ?? 'Check-in gagal');
        }

        return back()->with('success', 'Check-in berhasil!');
    }

    public function checkout(int $id)
    {
        try {
            $result = $this->bookingFacade->processCheckOut($id);
        } catch (\Throwable $e) {
            return back()->with('error', 'Gagal check-out. Pastikan modul pendukung sudah terintegrasi.');
        }

        if (!($result['success'] ?? false)) {
            return back()->with('error', $result['message'] ?? 'Check-out gagal');
        }

        return redirect()->route('bookings.show', $id)->with('success', 'Check-out berhasil!');
    }

    public function cancel(int $id)
    {
        try {
            $result = $this->bookingFacade->cancelBooking($id);
        } catch (\Throwable $e) {
            return back()->with('error', 'Gagal membatalkan booking. Pastikan modul pendukung sudah terintegrasi.');
        }

        if (!($result['success'] ?? false)) {
            return back()->with('error', $result['message'] ?? 'Pembatalan booking gagal');
        }

        return redirect()->route('bookings.index')->with('success', $result['message'] ?? 'Booking berhasil dibatalkan');
    }

    public function edit(int $id)
    {
        return redirect()->route('bookings.show', $id);
    }

    public function update(Request $request, int $id)
    {
        return redirect()->route('bookings.show', $id);
    }

    public function destroy(int $id)
    {
        return redirect()->route('bookings.index');
    }
}
