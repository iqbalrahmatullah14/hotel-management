@extends('layouts.app')
@section('title', 'Invoice Pembayaran')
@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Invoice Pembayaran</h1>
        <button onclick="window.print()"
            class="bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 px-4 py-2 rounded-lg text-sm font-medium transition-colors">🖨
            Cetak</button>
    </div>
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-8 max-w-3xl">
        <div class="flex justify-between items-start mb-8">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">{{ $hotelName }}</h2>
                <p class="text-gray-500 text-sm">{{ $hotelAddress }}</p>
            </div>
            <div class="text-right">
                <p class="text-lg font-bold text-indigo-600">INVOICE</p>
                <p class="text-sm text-gray-500">#INV-{{ str_pad($payment->id, 5, '0', STR_PAD_LEFT) }}</p>
                <p class="text-sm text-gray-500">{{ optional($payment->created_at)->format('d/m/Y') }}</p>
            </div>
        </div>
        <hr class="mb-6">
        <div class="grid grid-cols-2 gap-6 mb-8">
            <div>
                <p class="text-xs text-gray-500 uppercase tracking-wider mb-2">Tamu</p>
                <p class="font-semibold text-gray-800">{{ $payment->booking->guest->name ?? '-' }}</p>
                <p class="text-sm text-gray-500">{{ $payment->booking->guest->phone ?? '-' }}</p>
                <p class="text-sm text-gray-500">{{ $payment->booking->guest->email ?? '-' }}</p>
            </div>
            <div>
                <p class="text-xs text-gray-500 uppercase tracking-wider mb-2">Detail Booking</p>
                <p class="text-sm">Kamar: <strong>{{ $payment->booking->room->room_number ?? '-' }}</strong>
                    ({{ ucfirst($payment->booking->room->type ?? '-') }})</p>
                <p class="text-sm">Check-in: {{ optional($payment->booking->check_in_date)->format('d/m/Y') ?? '-' }}</p>
                <p class="text-sm">Check-out: {{ optional($payment->booking->check_out_date)->format('d/m/Y') ?? '-' }}</p>
                <p class="text-sm">{{ $payment->booking->total_nights }} malam</p>
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
                    <td class="py-3">Biaya Kamar ({{ $payment->booking->total_nights }} malam)</td>
                    <td class="py-3 text-right">Rp {{ number_format($payment->amount, 0, ',', '.') }}</td>
                </tr>
                <tr class="border-b border-gray-100">
                    <td class="py-3">Pajak ({{ $taxRate * 100 }}%)</td>
                    <td class="py-3 text-right">Rp {{ number_format($payment->tax_amount, 0, ',', '.') }}</td>
                </tr>
            </tbody>
            <tfoot>
                <tr class="border-t-2 border-gray-300">
                    <td class="py-3 font-bold text-lg">Total</td>
                    <td class="py-3 text-right font-bold text-lg text-indigo-600">Rp
                        {{ number_format($payment->amount + $payment->tax_amount, 0, ',', '.') }}</td>
                </tr>
            </tfoot>
        </table>
        <div class="flex justify-between items-center pt-4 border-t border-gray-200">
            <p class="text-sm text-gray-500">Metode: <strong>{{ ucfirst($payment->payment_method) }}</strong></p>
            @if ($payment->status === 'paid')
                <span class="px-3 py-1.5 text-sm font-bold rounded-full bg-emerald-100 text-emerald-700">LUNAS</span>
            @elseif ($payment->status === 'cancelled')
                <span class="px-3 py-1.5 text-sm font-bold rounded-full bg-red-100 text-red-700">BATAL</span>
            @else
                <span class="px-3 py-1.5 text-sm font-bold rounded-full bg-amber-100 text-amber-700">BELUM LUNAS</span>
            @endif
        </div>
    </div>
@endsection
