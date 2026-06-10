@extends('layouts.app')
@section('title', 'Buat Booking')
@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Buat Booking Baru</h1>
        <p class="text-gray-500 text-sm">Isi form untuk membuat reservasi baru</p>
    </div>
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 max-w-2xl">
        <form action="{{ route('bookings.store') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label for="guest_id" class="block text-sm font-medium text-gray-700 mb-1">Tamu</label>
                    <select name="guest_id" id="guest_id" required
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="">-- Pilih Tamu --</option>
                        @foreach ($guests as $guest)
                            <option value="{{ $guest->id }}" @selected((string) old('guest_id') === (string) $guest->id)>
                                {{ $guest->name }} — {{ $guest->id_number }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="room_id" class="block text-sm font-medium text-gray-700 mb-1">Kamar</label>
                    <select name="room_id" id="room_id" required
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="">-- Pilih Kamar --</option>
                        @foreach ($rooms as $room)
                            <option value="{{ $room->id }}" @selected((string) old('room_id') === (string) $room->id)>
                                {{ $room->room_number }} — {{ $room->room_type_config['name'] ?? ucfirst($room->type) }}
                                (Rp
                                {{ number_format((float) ($room->room_type_config['price_per_night'] ?? 0), 0, ',', '.') }}/malam)
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="check_in_date" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Check-in</label>
                    <input type="date" name="check_in_date" id="check_in_date" value="{{ old('check_in_date') }}"
                        required
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                </div>
                <div>
                    <label for="check_out_date" class="block text-sm font-medium text-gray-700 mb-1">Tanggal
                        Check-out</label>
                    <input type="date" name="check_out_date" id="check_out_date" value="{{ old('check_out_date') }}"
                        required
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                </div>
                <div>
                    <label for="payment_method" class="block text-sm font-medium text-gray-700 mb-1">Metode
                        Pembayaran</label>
                    <select name="payment_method" id="payment_method"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="cash" @selected(old('payment_method') === 'cash')>Cash</option>
                        <option value="transfer" @selected(old('payment_method') === 'transfer')>Transfer Bank</option>
                        <option value="card" @selected(old('payment_method') === 'card')>Kartu Kredit/Debit</option>
                    </select>
                </div>
            </div>
            <div class="flex gap-3 mt-6">
                <button type="submit"
                    class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2 rounded-lg text-sm font-medium transition-colors">Buat
                    Booking</button>
                <a href="{{ route('bookings.index') }}"
                    class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-5 py-2 rounded-lg text-sm font-medium transition-colors">Batal</a>
            </div>
        </form>
    </div>
@endsection
