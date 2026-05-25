{{-- ============================================
     Tugas B.5 — Form Tambah/Edit Kamar
     Anggota B: Ganti data static dengan data dari controller.

     TODO Tugas B:
     1. Di RoomController::create(), kirim $roomTypes dari config:
        $roomTypes = config('hotel.room_types');
        return view('rooms.form', compact('roomTypes'));
     2. Di RoomController::edit(), kirim $room dan $roomTypes:
        return view('rooms.form', compact('room', 'roomTypes'));
     3. Ganti <option> static dengan @foreach($roomTypes as $key => $type)
     4. Ganti value="" dengan value="{{ $room->field ?? old('field') }}"
     ============================================ --}}
@extends('layouts.app')

@section('title', 'Tambah Kamar')

@section('content')
    <div class="mb-6">
        {{-- TODO Tugas B: Ganti title berdasarkan mode edit/create
             {{ isset($room) ? 'Edit Kamar' : 'Tambah Kamar Baru' }} --}}
        <h1 class="text-2xl font-bold text-gray-800">Tambah Kamar Baru</h1>
        <p class="text-gray-500 text-sm">Isi form untuk menambah kamar baru</p>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 max-w-2xl">
        {{-- TODO Tugas B: Ganti action berdasarkan mode edit/create
             action="{{ isset($room) ? route('rooms.update', $room) : route('rooms.store') }}"
             Dan tambahkan @if(isset($room)) @method('PUT') @endif --}}
        <form action="{{ route('rooms.store') }}" method="POST">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label for="type" class="block text-sm font-medium text-gray-700 mb-1">Tipe Kamar</label>
                    {{-- TODO Tugas B: Ganti <option> static dengan @foreach(config('hotel.room_types') as $key => $type) --}}
                    <select name="type" id="type" required
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="">-- Pilih Tipe --</option>
                        <option value="standard">Standard — Rp 350.000</option>
                        <option value="deluxe">Deluxe — Rp 550.000</option>
                        <option value="suite">Suite — Rp 900.000</option>
                    </select>
                </div>

                <div>
                    <label for="room_number" class="block text-sm font-medium text-gray-700 mb-1">Nomor Kamar</label>
                    <input type="text" name="room_number" id="room_number" required
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                <div>
                    <label for="floor" class="block text-sm font-medium text-gray-700 mb-1">Lantai</label>
                    <input type="number" name="floor" id="floor" required
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                    <select name="status" id="status"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="available">Available</option>
                        <option value="occupied">Occupied</option>
                        <option value="maintenance">Maintenance</option>
                    </select>
                </div>
            </div>

            <div class="flex gap-3 mt-6">
                <button type="submit"
                    class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2 rounded-lg text-sm font-medium transition-colors">
                    Simpan
                </button>
                <a href="{{ route('rooms.index') }}"
                    class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-5 py-2 rounded-lg text-sm font-medium transition-colors">Batal</a>
            </div>
        </form>
    </div>
@endsection
