@extends('layouts.app')

@section('title', 'Detail Tamu')

@section('content')

<div class="flex justify-between items-center mb-6">
    <div>
        <h1 class="text-2xl font-bold text-gray-800">Detail Tamu</h1>
        <p class="text-gray-500 text-sm">Informasi lengkap dan riwayat aktivitas tamu</p>
    </div>
    <a href="{{ route('guests.index') }}"
        class="bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 px-4 py-2 rounded-lg text-sm font-medium transition-colors flex items-center gap-2">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
        </svg>
        Kembali
    </a>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
    <!-- Profil Tamu Card -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 flex flex-col items-center text-center">
        <div class="w-20 h-20 bg-indigo-100 text-indigo-700 rounded-full flex items-center justify-center font-bold text-3xl mb-4 shadow-inner">
            {{ strtoupper(substr($guest->name, 0, 1)) }}
        </div>
        <h2 class="text-xl font-bold text-gray-800 mb-1">{{ $guest->name }}</h2>
        <span class="px-2.5 py-0.5 text-xs font-semibold rounded-full bg-indigo-55 text-indigo-700 bg-indigo-50">Tamu Hotel</span>
        
        <div class="w-full border-t border-gray-100 my-5"></div>

        <div class="w-full space-y-3.5 text-left text-sm text-gray-600">
            <div class="flex items-center gap-3">
                <svg class="w-5 h-5 text-gray-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L22 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
                <span class="truncate">{{ $guest->email }}</span>
            </div>
            <div class="flex items-center gap-3">
                <svg class="w-5 h-5 text-gray-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.94.725l.548 2.2a1 1 0 00.996.86h1.54a1 1 0 00.996-.86l.548-2.2a1 1 0 01.94-.725H21a2 2 0 012 2v1a10 10 0 01-10 10H5a2 2 0 01-2-2V5z" />
                </svg>
                <span>{{ $guest->phone }}</span>
            </div>
        </div>
    </div>

    <!-- Informasi Detail Card -->
    <div class="lg:col-span-2 bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-5">Informasi Tambahan</h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 text-sm">
            <div>
                <p class="text-xs text-gray-400 uppercase tracking-wider mb-1">Nomor Identitas (NIK/Paspor)</p>
                <p class="font-medium text-gray-800 text-base">{{ $guest->id_number }}</p>
            </div>
            <div>
                <p class="text-xs text-gray-400 uppercase tracking-wider mb-1">Alamat Domisili</p>
                <p class="font-medium text-gray-800 text-base">{{ $guest->address }}</p>
            </div>
            <div>
                <p class="text-xs text-gray-400 uppercase tracking-wider mb-1">Terdaftar Sejak</p>
                <p class="font-medium text-gray-800 text-base">{{ optional($guest->created_at)->format('d F Y (H:i)') ?? '-' }}</p>
            </div>
            <div>
                <p class="text-xs text-gray-400 uppercase tracking-wider mb-1">Terakhir Diperbarui</p>
                <p class="font-medium text-gray-800 text-base">{{ optional($guest->updated_at)->format('d F Y (H:i)') ?? '-' }}</p>
            </div>
        </div>
    </div>
</div>

<!-- Riwayat Booking -->
<div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-200">
        <h3 class="text-lg font-semibold text-gray-800">Riwayat Booking</h3>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 text-gray-600 uppercase text-xs">
                <tr>
                    <th class="px-6 py-3 text-left"># ID</th>
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
                @forelse($guest->bookings as $booking)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-3.5 text-gray-500 font-mono">#{{ $booking->id }}</td>
                        <td class="px-6 py-3.5">
                            <span class="font-medium text-gray-800">{{ $booking->room->room_number ?? '-' }}</span>
                            <span class="text-xs text-gray-500 block">{{ $booking->room->room_type_config['name'] ?? '-' }}</span>
                        </td>
                        <td class="px-6 py-3.5">{{ optional($booking->check_in_date)->format('d/m/Y') ?? '-' }}</td>
                        <td class="px-6 py-3.5">{{ optional($booking->check_out_date)->format('d/m/Y') ?? '-' }}</td>
                        <td class="px-6 py-3.5">{{ $booking->total_nights }} malam</td>
                        <td class="px-6 py-3.5 font-semibold text-gray-800">Rp {{ number_format((float) $booking->total_price, 0, ',', '.') }}</td>
                        <td class="px-6 py-3.5">
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
                        <td class="px-6 py-3.5">
                            <a href="{{ route('bookings.show', $booking->id) }}" class="text-blue-600 hover:text-blue-800 p-1 flex items-center gap-1 font-medium text-xs" title="Lihat Detail Booking">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                Detail
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="px-6 py-6 text-center text-gray-500">Tamu ini belum memiliki riwayat booking.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection