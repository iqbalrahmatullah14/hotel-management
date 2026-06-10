@extends('layouts.app')
@section('title', 'Detail Booking #' . $booking->id)
@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Detail Booking #{{ $booking->id }}</h1>
        <a href="{{ route('bookings.index') }}"
            class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-lg text-sm font-medium transition-colors">←
            Kembali</a>
    </div>
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-5">Informasi Booking</h3>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-5">
                <div>
                    <p class="text-xs text-gray-500 mb-1">Tamu</p>
                    <p class="font-semibold text-gray-800">{{ $booking->guest->name ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-xs text-gray-500 mb-1">Kamar</p>
                    <p class="font-semibold text-gray-800">{{ $booking->room->room_number ?? '-' }} —
                        {{ $booking->room->room_type_config['name'] ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-xs text-gray-500 mb-1">Check-in</p>
                    <p class="font-semibold text-gray-800">{{ optional($booking->check_in_date)->format('d/m/Y') ?? '-' }}
                    </p>
                </div>
                <div>
                    <p class="text-xs text-gray-500 mb-1">Check-out</p>
                    <p class="font-semibold text-gray-800">{{ optional($booking->check_out_date)->format('d/m/Y') ?? '-' }}
                    </p>
                </div>
                <div>
                    <p class="text-xs text-gray-500 mb-1">Jumlah Malam</p>
                    <p class="font-semibold text-gray-800">{{ $booking->total_nights }} malam</p>
                </div>
                <div>
                    <p class="text-xs text-gray-500 mb-1">Total Harga</p>
                    <p class="font-semibold text-gray-800">Rp
                        {{ number_format((float) $booking->total_price, 0, ',', '.') }}</p>
                </div>
                <div>
                    <p class="text-xs text-gray-500 mb-1">Status</p>
                    @php
                        $statusMap = [
                            'pending' => ['label' => 'Pending', 'class' => 'bg-amber-100 text-amber-700'],
                            'confirmed' => ['label' => 'Confirmed', 'class' => 'bg-blue-100 text-blue-700'],
                            'checked_in' => ['label' => 'Checked In', 'class' => 'bg-emerald-100 text-emerald-700'],
                            'checked_out' => ['label' => 'Checked Out', 'class' => 'bg-gray-100 text-gray-700'],
                            'cancelled' => ['label' => 'Cancelled', 'class' => 'bg-red-100 text-red-700'],
                        ];
                        $status = $statusMap[$booking->status] ?? [
                            'label' => ucfirst((string) $booking->status),
                            'class' => 'bg-gray-100 text-gray-700',
                        ];
                    @endphp
                    <span
                        class="px-2 py-1 text-xs font-medium rounded-full {{ $status['class'] }}">{{ $status['label'] }}</span>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Aksi</h3>
            <div class="space-y-3">
                @if ($booking->status === 'confirmed')
                    <form action="{{ route('bookings.checkin', $booking->id) }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="w-full bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2.5 rounded-lg text-sm font-medium transition-colors">
                            Check-in
                        </button>
                    </form>

                    <form action="{{ route('bookings.cancel', $booking->id) }}" method="POST"
                        onsubmit="return confirm('Apakah anda yakin ingin membatalkan booking ini?')">
                        @csrf
                        <button type="submit"
                            class="w-full bg-red-600 hover:bg-red-700 text-white px-4 py-2.5 rounded-lg text-sm font-medium transition-colors">
                            Batalkan Booking
                        </button>
                    </form>
                @elseif ($booking->status === 'checked_in')
                    <form action="{{ route('bookings.checkout', $booking->id) }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="w-full bg-blue-600 hover:bg-blue-700 text-white px-4 py-2.5 rounded-lg text-sm font-medium transition-colors">
                            Check-out
                        </button>
                    </form>
                @elseif ($booking->status === 'checked_out' && $booking->payment)
                    <a href="{{ route('payments.show', $booking->payment->id) }}"
                        class="block w-full text-center bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2.5 rounded-lg text-sm font-medium transition-colors">
                        Lihat Invoice
                    </a>
                @else
                    <p class="text-sm text-gray-500">Tidak ada aksi tersedia untuk status booking saat ini.</p>
                @endif
            </div>
        </div>
    </div>
@endsection
