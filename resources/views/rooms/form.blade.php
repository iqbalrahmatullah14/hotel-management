
@extends('layouts.app')

@section('title', 'Form Kamar')

@section('content')
    <div class="mb-6">

        <h1 class="text-2xl font-bold text-gray-800">
            {{ isset($room) ? 'Edit Kamar' : 'Tambah Kamar Baru' }}
        </h1>
        <p class="text-gray-500 text-sm">
            {{ isset($room) ? 'Perbarui informasi kamar' : 'Isi form di bawah untuk menambahkan kamar baru' }}
        </p>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 max-w-2xl">

        <form action="{{ isset($room) ? route('rooms.update', $room) : route('rooms.store') }}" method="POST">
            @csrf

            @if (isset($room))
                @method('PUT')
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label for="type" class="block text-sm font-medium text-gray-700 mb-1">Tipe Kamar</label>

                    <select name="type" id="type" required
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="">-- Pilih Tipe --</option>
                        @foreach ($roomTypes as $key => $type)
                            <option value="{{ $key }}"
                                {{ isset($room) && $room->type == $key ? 'selected' : (old('type') == $key ? 'selected' : '') }}>
                                {{ $type['name'] }} - Rp {{ number_format($type['price_per_night'], 0, ',', '.') }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="room_number" class="block text-sm font-medium text-gray-700 mb-1">Nomor Kamar</label>
                    <input type="text" name="room_number" id="room_number" required
                        value="{{ $room->room_number ?? old('room_number') }}"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                <div>
                    <label for="floor" class="block text-sm font-medium text-gray-700 mb-1">Lantai</label>
                    <input type="number" name="floor" id="floor" required value="{{ $room->floor ?? old('floor') }}"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                    <select name="status" id="status"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="available"
                            {{ isset($room) && $room->status == 'available' ? 'selected' : (old('status') == 'available' ? 'selected' : '') }}>
                            Available</option>
                        <option value="occupied"
                            {{ isset($room) && $room->status == 'occupied' ? 'selected' : (old('status') == 'occupied' ? 'selected' : '') }}>
                            Occupied</option>
                        <option value="maintenance"
                            {{ isset($room) && $room->status == 'maintenance' ? 'selected' : (old('status') == 'maintenance' ? 'selected' : '') }}>
                            Maintenance</option>
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
