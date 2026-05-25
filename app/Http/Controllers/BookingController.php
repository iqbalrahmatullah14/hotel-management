<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Guest;
use App\Models\Room;
use App\Facades\BookingFacade;
use Illuminate\Http\Request;

/**
 * PANDUAN PENGERJAAN — Anggota D (BookingController)
 *
 * D.1 Inject BookingFacade via constructor:
 *     → protected BookingFacade $bookingFacade;
 *     → public function __construct(BookingFacade $bookingFacade) { $this->bookingFacade = $bookingFacade; }
 *
 * D.2 index()
 *     → $bookings = Booking::with(['guest', 'room'])->latest()->get();
 *     → return view('bookings.index', compact('bookings'));
 *
 * D.3 create()
 *     → $guests = Guest::all();
 *     → $rooms  = Room::where('status', 'available')->get();
 *     → return view('bookings.create', compact('guests', 'rooms'));
 *
 * D.4 store($request)
 *     → Validasi: guest_id, room_id, check_in_date, check_out_date, payment_method
 *     → $result = $this->bookingFacade->createBooking($validated);
 *     → if (!$result['success']) return back()->with('error', $result['message']);
 *     → return redirect()->route('bookings.show', $result['booking']->id);
 *
 * D.5 show($id)
 *     → $booking = Booking::findOrFail($id);
 *     → $booking->load(['guest', 'room', 'payment']);
 *     → return view('bookings.show', compact('booking'));
 *
 * D.6 checkin($id)
 *     → $result = $this->bookingFacade->processCheckIn($id);
 *     → if (!$result['success']) return back()->with('error', $result['message']);
 *
 * D.7 checkout($id)
 *     → $result = $this->bookingFacade->processCheckOut($id);
 *
 * D.8 cancel($id)
 *     → $result = $this->bookingFacade->cancelBooking($id);
 *     → if (!$result['success']) return back()->with('error', $result['message']);
 */
class BookingController extends Controller
{
    public function index()
    {
        return view('bookings.index');
    }

    public function create()
    {
        return view('bookings.create');
    }

    public function store(Request $request)
    {
        return redirect()->route('bookings.index')->with('success', 'Booking berhasil dibuat!');
    }

    public function show(int $id)
    {
        return view('bookings.show');
    }

    public function checkin(int $id)
    {
        return back()->with('success', 'Check-in berhasil!');
    }

    public function checkout(int $id)
    {
        return redirect()->route('bookings.show', $id)->with('success', 'Check-out berhasil!');
    }

    public function cancel(int $id)
    {
        return redirect()->route('bookings.index')->with('success', 'Booking berhasil dibatalkan');
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
