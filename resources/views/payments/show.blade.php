{{-- Tugas E.5 — Invoice
     ⚡ Data hotel dari SINGLETON: HotelConfigManager::getInstance()

     TODO Tugas E:
     1. Di PaymentController::show(), kirim variabel:
        $config = HotelConfigManager::getInstance();
        return view('payments.show', [
            'payment'      => $payment,
            'hotelName'    => $config->getHotelName(),
            'hotelAddress' => $config->getHotelAddress(),
            'taxRate'      => $config->getTaxRate(),
        ]);
     2. Ganti data static dengan variabel dari controller --}}
@extends('layouts.app')
@section('title', 'Invoice Pembayaran')
@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Invoice Pembayaran</h1>
        <button onclick="window.print()" class="bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 px-4 py-2 rounded-lg text-sm font-medium transition-colors">🖨 Cetak</button>
    </div>
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-8 max-w-3xl">
        <div class="flex justify-between items-start mb-8">
            <div>
                {{-- TODO Tugas E: Ganti static dengan {{ $hotelName }} dari SINGLETON --}}
                <h2 class="text-2xl font-bold text-gray-800">Hotel</h2>
                {{-- TODO Tugas E: Ganti static dengan {{ $hotelAddress }} dari SINGLETON --}}
                <p class="text-gray-500 text-sm">Jl. Merdeka No. 1, Surabaya</p>
            </div>
            <div class="text-right">
                <p class="text-lg font-bold text-indigo-600">INVOICE</p>
                {{-- TODO Tugas E: Ganti static dengan data dari $payment --}}
                <p class="text-sm text-gray-500">#INV-00001</p>
                <p class="text-sm text-gray-500">23/05/2026</p>
            </div>
        </div>
        <hr class="mb-6">
        <div class="grid grid-cols-2 gap-6 mb-8">
            <div>
                <p class="text-xs text-gray-500 uppercase tracking-wider mb-2">Tamu</p>
                {{-- TODO Tugas E: Ganti dengan {{ $payment->booking->guest->name }} --}}
                <p class="font-semibold text-gray-800">Budi Santoso</p>
                <p class="text-sm text-gray-500">081234567890</p>
                <p class="text-sm text-gray-500">budi@example.com</p>
            </div>
            <div>
                <p class="text-xs text-gray-500 uppercase tracking-wider mb-2">Detail Booking</p>
                <p class="text-sm">Kamar: <strong>201</strong> (Deluxe)</p>
                <p class="text-sm">Check-in: 25/05/2026</p>
                <p class="text-sm">Check-out: 27/05/2026</p>
                <p class="text-sm">2 malam</p>
            </div>
        </div>
        <table class="w-full text-sm mb-6">
            <thead>
                <tr class="border-b-2 border-gray-200">
                    <th class="text-left py-2 text-gray-600">Deskripsi</th>
                    <th class="text-right py-2 text-gray-600">Jumlah</th>
                </tr>
            </thead>
            <tbody>
                <tr class="border-b border-gray-100">
                    <td class="py-3">Biaya Kamar (2 malam)</td>
                    <td class="py-3 text-right">Rp 1.100.000</td>
                </tr>
                <tr class="border-b border-gray-100">
                    {{-- TODO Tugas E: Ganti 11% static dengan {{ $taxRate * 100 }}% dari SINGLETON --}}
                    <td class="py-3">Pajak (11%)</td>
                    <td class="py-3 text-right">Rp 121.000</td>
                </tr>
            </tbody>
            <tfoot>
                <tr class="border-t-2 border-gray-300">
                    <td class="py-3 font-bold text-lg">Total</td>
                    <td class="py-3 text-right font-bold text-lg text-indigo-600">Rp 1.221.000</td>
                </tr>
            </tfoot>
        </table>
        <div class="flex justify-between items-center pt-4 border-t border-gray-200">
            <p class="text-sm text-gray-500">Metode: <strong>Cash</strong></p>
            <span class="px-3 py-1.5 text-sm font-bold rounded-full bg-amber-100 text-amber-700">BELUM LUNAS</span>
        </div>
    </div>
@endsection
