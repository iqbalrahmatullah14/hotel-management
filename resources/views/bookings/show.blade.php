{{-- Tugas D.4 — Booking Detail + Aksi
     ⚡ Cancel → BookingFacade::cancelBooking() [Tugas A]
     ⚡ Check-in → BookingFacade::processCheckIn() [Tugas A]
     ⚡ Check-out → BookingFacade::processCheckOut() [Tugas A]

     TODO Tugas D:
     1. Di BookingController::show(), kirim $booking:
        $booking->load(['guest', 'room.roomType', 'payment']);
        return view('bookings.show', compact('booking'));
     2. Ganti data static dengan {{ $booking->guest->name }}, dll.
     3. Ganti action="#" dengan route('bookings.checkin', $booking), dll. --}}
@extends('layouts.app')
@section('title', 'Detail Booking #1')
@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Detail Booking #1</h1>
        <a href="{{ route('bookings.index') }}"
            class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-lg text-sm font-medium transition-colors">←
            Kembali</a>
    </div>
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-5">Informasi Booking</h3>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-5">
                {{-- TODO Tugas D: Ganti data static dengan variabel $booking --}}
                <div>
                    <p class="text-xs text-gray-500 mb-1">Tamu</p>
                    <p class="font-semibold text-gray-800">Budi Santoso</p>
                </div>
                <div>
                    <p class="text-xs text-gray-500 mb-1">Kamar</p>
                    <p class="font-semibold text-gray-800">201 — Deluxe</p>
                </div>
                <div>
                    <p class="text-xs text-gray-500 mb-1">Check-in</p>
                    <p class="font-semibold text-gray-800">25/05/2026</p>
                </div>
                <div>
                    <p class="text-xs text-gray-500 mb-1">Check-out</p>
                    <p class="font-semibold text-gray-800">27/05/2026</p>
                </div>
                <div>
                    <p class="text-xs text-gray-500 mb-1">Jumlah Malam</p>
                    <p class="font-semibold text-gray-800">2 malam</p>
                </div>
                <div>
                    <p class="text-xs text-gray-500 mb-1">Total Harga</p>
                    <p class="font-semibold text-gray-800">Rp 1.221.000</p>
                </div>
                <div>
                    <p class="text-xs text-gray-500 mb-1">Status</p>
                    <span class="px-2 py-1 text-xs font-medium rounded-full bg-blue-100 text-blue-700">Confirmed</span>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Aksi</h3>
            <div class="space-y-3">
                {{-- TODO Tugas D: Tampilkan tombol berdasarkan $booking->status
                     - 'confirmed' → tampilkan Check-in & Batalkan
                     - 'checked_in' → tampilkan Check-out
                     - 'checked_out' → tampilkan link ke Invoice --}}

                {{-- TODO Tugas D: Ganti route('bookings.checkin', 1) → route('bookings.checkin', $booking) --}}
                <form action="{{ route('bookings.checkin', 1) }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="w-full bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2.5 rounded-lg text-sm font-medium transition-colors">
                        ✓ Check-in
                    </button>
                </form>

                {{-- TODO Tugas D: Ganti route('bookings.checkout', 1) → route('bookings.checkout', $booking) --}}
                <form action="{{ route('bookings.checkout', 1) }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white px-4 py-2.5 rounded-lg text-sm font-medium transition-colors">
                        ✓ Check-out
                    </button>
                </form>

                {{-- TODO Tugas D: Implementasi cancel via BookingFacade::cancelBooking() --}}
                <button onclick="confirm('Apakah anda yakin ingin membatalkan booking ini?')"
                    class="w-full bg-red-600 hover:bg-red-700 text-white px-4 py-2.5 rounded-lg text-sm font-medium transition-colors">
                    ✕ Batalkan Booking
                </button>
            </div>
        </div>
    </div>
@endsection
