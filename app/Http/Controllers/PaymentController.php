<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Services\HotelConfigManager;
use Illuminate\Http\Request;

/**
 * PANDUAN PENGERJAAN — Anggota E (PaymentController)
 *
 * E.3 index()
 *     → $payments = Payment::with(['booking.guest'])->latest()->get();
 *     → return view('payments.index', compact('payments'));
 *
 * E.4 show($id) — Halaman invoice
 *     → $payment = Payment::findOrFail($id);
 *     → $payment->load('booking.guest', 'booking.room');
 *     → ⚡ Wajib panggil Singleton:
 *       $config = HotelConfigManager::getInstance();
 *     → return view('payments.show', [
 *           'payment'      => $payment,
 *           'hotelName'    => $config->getHotelName(),
 *           'hotelAddress' => $config->getHotelAddress(),
 *           'taxRate'      => $config->getTaxRate(),
 *       ]);
 *
 * E.5 updateStatus($request, $id)
 *     → $payment = Payment::findOrFail($id);
 *     → Validasi: status (in:pending,paid,cancelled)
 *     → $payment->update(['status' => $request->status]);
 *     → Jika status='paid', tambahkan: $payment->update(['paid_at' => now()]);
 */
class PaymentController extends Controller
{
    public function index()
    {
        return view('payments.index');
    }

    public function show(int $id)
    {
        return view('payments.show');
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
        return redirect()->route('payments.index')->with('success', 'Status pembayaran berhasil diubah');
    }
}
