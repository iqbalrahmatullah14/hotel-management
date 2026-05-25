{{-- Tugas C.6 — Guest Show
     TODO Tugas C:
     1. Di GuestController::show(), kirim $guest (dengan load bookings):
        $guest->load('bookings.room');
        return view('guests.show', compact('guest'));
     2. Ganti data static dengan {{ $guest->name }}, dll. --}}
@extends('layouts.app')
@section('title', 'Detail Tamu')
@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Detail Tamu: Budi Santoso</h1>
        <a href="{{ route('guests.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-lg text-sm font-medium transition-colors">← Kembali</a>
    </div>
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Info Tamu</h3>
            <div class="space-y-3 text-sm">
                {{-- TODO Tugas C: Ganti data static dengan {{ $guest->name }}, dll. --}}
                <div><span class="text-gray-500">Nama:</span> <span class="font-medium text-gray-800">Budi Santoso</span></div>
                <div><span class="text-gray-500">Email:</span> budi@example.com</div>
                <div><span class="text-gray-500">Telepon:</span> 081234567890</div>
                <div><span class="text-gray-500">No. Identitas:</span> <span class="font-mono">3201010101010001</span></div>
                <div><span class="text-gray-500">Alamat:</span> Jl. Sudirman No. 10, Jakarta</div>
            </div>
        </div>
        <div class="lg:col-span-2 bg-white rounded-xl shadow-sm border border-gray-200">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-800">Riwayat Booking</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-gray-50 text-gray-600 uppercase text-xs">
                        <tr>
                            <th class="px-6 py-3 text-left">#</th>
                            <th class="px-6 py-3 text-left">Kamar</th>
                            <th class="px-6 py-3 text-left">Check-in</th>
                            <th class="px-6 py-3 text-left">Check-out</th>
                            <th class="px-6 py-3 text-left">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        {{-- TODO Tugas C: Ganti dengan @foreach($guest->bookings as $booking) --}}
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-3">1</td>
                            <td class="px-6 py-3">201</td>
                            <td class="px-6 py-3">25/05/2026</td>
                            <td class="px-6 py-3">27/05/2026</td>
                            <td class="px-6 py-3">
                                <span class="px-2 py-1 text-xs font-medium rounded-full bg-blue-100 text-blue-700">Confirmed</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
