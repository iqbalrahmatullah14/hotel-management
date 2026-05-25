{{-- Tugas D.9 — Form Buat Booking
     ⚡ Submit → BookingFacade::createBooking() [Tugas A]
     ⚠️ Harus menunggu: GuestService [C], RoomService [B], PricingService [A], PaymentService [E]

     TODO Tugas D:
     1. Di BookingController::create(), kirim $guests dan $rooms:
        $guests = Guest::all();
        $rooms = Room::where('status', 'available')->with('roomType')->get();
        return view('bookings.create', compact('guests', 'rooms'));
     2. Ganti <option> static dengan @foreach($guests) dan @foreach($rooms)
     3. Di store(), panggil BookingFacade::createBooking() --}}
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
                    {{-- TODO Tugas D: Ganti <option> static dengan @foreach($guests as $guest) --}}
                    <select name="guest_id" id="guest_id" required class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="">-- Pilih Tamu --</option>
                        <option value="1">Budi Santoso — 3201010101010001</option>
                        <option value="2">Siti Aminah — 3201020202020002</option>
                        <option value="3">Andi Wijaya — 3201030303030003</option>
                    </select>
                </div>
                <div>
                    <label for="room_id" class="block text-sm font-medium text-gray-700 mb-1">Kamar</label>
                    {{-- TODO Tugas D: Ganti <option> static dengan @foreach($rooms as $room) --}}
                    <select name="room_id" id="room_id" required class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="">-- Pilih Kamar --</option>
                        <option value="1">101 — Standard (Rp 350.000/malam)</option>
                        <option value="4">201 — Deluxe (Rp 550.000/malam)</option>
                        <option value="7">301 — Suite (Rp 900.000/malam)</option>
                    </select>
                </div>
                <div>
                    <label for="check_in_date" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Check-in</label>
                    <input type="date" name="check_in_date" id="check_in_date" required class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                </div>
                <div>
                    <label for="check_out_date" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Check-out</label>
                    <input type="date" name="check_out_date" id="check_out_date" required class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                </div>
                <div>
                    <label for="payment_method" class="block text-sm font-medium text-gray-700 mb-1">Metode Pembayaran</label>
                    <select name="payment_method" id="payment_method" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="cash">Cash</option>
                        <option value="transfer">Transfer Bank</option>
                        <option value="card">Kartu Kredit/Debit</option>
                    </select>
                </div>
            </div>
            <div class="flex gap-3 mt-6">
                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2 rounded-lg text-sm font-medium transition-colors">Buat Booking</button>
                <a href="{{ route('bookings.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-5 py-2 rounded-lg text-sm font-medium transition-colors">Batal</a>
            </div>
        </form>
    </div>
@endsection
