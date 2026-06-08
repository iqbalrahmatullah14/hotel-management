{{-- Tugas D.2 — Bookings Index
     TODO Tugas D:
     1. Di BookingController::index(), kirim $bookings:
        $bookings = Booking::with(['guest', 'room'])->latest()->get();
        return view('bookings.index', compact('bookings'));
     2. Ganti baris static dengan @foreach ($bookings as $booking) --}}
@extends('layouts.app')
@section('title', 'Manajemen Booking')
@section('content')
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Manajemen Booking</h1>
            <p class="text-gray-500 text-sm">Kelola reservasi hotel</p>
        </div>
        <a href="{{ route('bookings.create') }}"
            class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Buat Booking
        </a>
    </div>
    <div class="bg-white rounded-xl shadow-sm border border-gray-200">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 text-gray-600 uppercase text-xs">
                    <tr>
                        <th class="px-6 py-3 text-left">#</th>
                        <th class="px-6 py-3 text-left">Tamu</th>
                        <th class="px-6 py-3 text-left">Kamar</th>
                        <th class="px-6 py-3 text-left">Check-in</th>
                        <th class="px-6 py-3 text-left">Check-out</th>
                        <th class="px-6 py-3 text-left">Malam</th>
                        <th class="px-6 py-3 text-left">Total</th>
                        <th class="px-6 py-3 text-left">Status</th>
                        <th class="px-6 py-3 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse ($bookings as $booking)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-3 text-gray-500">{{ $booking->id }}</td>
                            <td class="px-6 py-3 font-medium text-gray-800">{{ $booking->guest->name ?? '-' }}</td>
                            <td class="px-6 py-3">{{ $booking->room->room_number ?? '-' }}</td>
                            <td class="px-6 py-3">{{ optional($booking->check_in_date)->format('d/m/Y') ?? '-' }}</td>
                            <td class="px-6 py-3">{{ optional($booking->check_out_date)->format('d/m/Y') ?? '-' }}</td>
                            <td class="px-6 py-3">{{ $booking->total_nights }}</td>
                            <td class="px-6 py-3 font-medium">Rp {{ number_format((float) $booking->total_price, 0, ',', '.') }}</td>
                            <td class="px-6 py-3">
                                @php
                                    $statusMap = [
                                        'pending' => ['label' => 'Pending', 'class' => 'bg-amber-100 text-amber-700'],
                                        'confirmed' => ['label' => 'Confirmed', 'class' => 'bg-blue-100 text-blue-700'],
                                        'checked_in' => ['label' => 'Checked In', 'class' => 'bg-emerald-100 text-emerald-700'],
                                        'checked_out' => ['label' => 'Checked Out', 'class' => 'bg-gray-100 text-gray-700'],
                                        'cancelled' => ['label' => 'Cancelled', 'class' => 'bg-red-100 text-red-700'],
                                    ];
                                    $status = $statusMap[$booking->status] ?? ['label' => ucfirst((string) $booking->status), 'class' => 'bg-gray-100 text-gray-700'];
                                @endphp
                                <span class="px-2 py-1 text-xs font-medium rounded-full {{ $status['class'] }}">{{ $status['label'] }}</span>
                            </td>
                            <td class="px-6 py-3">
                                <a href="{{ route('bookings.show', $booking->id) }}" class="text-blue-600 hover:text-blue-800 p-1" title="Detail">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="px-6 py-4 text-center text-gray-500">Belum ada data booking.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
