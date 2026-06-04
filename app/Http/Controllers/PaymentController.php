<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Services\HotelConfigManager;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::with(['booking.guest'])->latest()->get();

        return view('payments.index', compact('payments'));
    }

    public function show(int $id)
    {
        $payment = Payment::findOrFail($id);
        $payment->load('booking.guest', 'booking.room');

        $config = HotelConfigManager::getInstance();

        return view('payments.show', [
            'payment'      => $payment,
            'hotelName'    => $config->getHotelName(),
            'hotelAddress' => $config->getHotelAddress(),
            'taxRate'      => $config->getTaxRate(),
        ]);
    }

    public function create()
    {
        return redirect()->route('payments.index');
    }

    public function store(Request $request)
    {
        return redirect()->route('payments.index');
    }

    public function edit(int $id)
    {
        return redirect()->route('payments.show', $id);
    }

    public function update(Request $request, int $id)
    {
        return redirect()->route('payments.show', $id);
    }

    public function destroy(int $id)
    {
        return redirect()->route('payments.index');
    }

    public function updateStatus(Request $request, int $id)
    {
        $payment = Payment::findOrFail($id);

        $request->validate([
            'status' => 'required|in:pending,paid,cancelled',
        ]);

        $payment->update(['status' => $request->status]);

        if ($request->status === 'paid') {
            $payment->update(['paid_at' => now()]);
        }

        return redirect()->route('payments.index')->with('success', 'Status pembayaran berhasil diubah');
    }
}
