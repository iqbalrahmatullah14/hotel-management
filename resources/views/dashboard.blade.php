{{-- Dashboard --}}
@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Dashboard</h1>
        <p class="text-gray-500 text-sm">Selamat datang di Hotel Management System</p>
    </div>

    {{-- Stats Cards --}}
    {{--
        TODO: Ganti angka static di bawah dengan variabel dari controller.
        Variabel yang dibutuhkan: $totalRooms, $availableRooms, $totalGuests, $totalBookings
        Contoh: ganti "8" dengan {{ $totalRooms }}
    --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Total Kamar</p>
                    {{-- TODO: Ganti 8 → {{ $totalRooms }} --}}
                    <p class="text-2xl font-bold text-gray-800">8</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-emerald-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Tersedia</p>
                    {{-- TODO: Ganti 6 → {{ $availableRooms }} --}}
                    <p class="text-2xl font-bold text-gray-800">6</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Total Tamu</p>
                    {{-- TODO: Ganti 3 → {{ $totalGuests }} --}}
                    <p class="text-2xl font-bold text-gray-800">3</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-amber-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Total Booking</p>
                    {{-- TODO: Ganti 2 → {{ $totalBookings }} --}}
                    <p class="text-2xl font-bold text-gray-800">2</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Booking Terbaru --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-200">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-800">Booking Terbaru</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 text-gray-600 uppercase text-xs">
                    <tr>
                        <th class="px-6 py-3 text-left">#</th>
                        <th class="px-6 py-3 text-left">Tamu</th>
                        <th class="px-6 py-3 text-left">Kamar</th>
                        <th class="px-6 py-3 text-left">Check-in</th>
                        <th class="px-6 py-3 text-left">Check-out</th>
                        <th class="px-6 py-3 text-left">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    {{--
                        TODO: Ganti baris static di bawah dengan @foreach($recentBookings as $booking)
                        Variabel yang dibutuhkan dari controller: $recentBookings
                    --}}
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-3">1</td>
                        <td class="px-6 py-3 font-medium text-gray-800">Budi Santoso</td>
                        <td class="px-6 py-3">201</td>
                        <td class="px-6 py-3">25/05/2026</td>
                        <td class="px-6 py-3">27/05/2026</td>
                        <td class="px-6 py-3">
                            <span class="px-2 py-1 text-xs font-medium rounded-full bg-blue-100 text-blue-700">Confirmed</span>
                        </td>
                    </tr>
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-3">2</td>
                        <td class="px-6 py-3 font-medium text-gray-800">Siti Aminah</td>
                        <td class="px-6 py-3">301</td>
                        <td class="px-6 py-3">26/05/2026</td>
                        <td class="px-6 py-3">30/05/2026</td>
                        <td class="px-6 py-3">
                            <span class="px-2 py-1 text-xs font-medium rounded-full bg-emerald-100 text-emerald-700">Checked In</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
