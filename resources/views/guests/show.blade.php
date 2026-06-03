@extends('layouts.app')

@section('title', 'Detail Tamu')

@section('content')

<div class="flex justify-between mb-6">
    <h1 class="text-2xl font-bold">Detail Tamu</h1>
    <a href="{{ route('guests.index') }}" class="bg-gray-200 px-4 py-2 rounded">
        Kembali
    </a>
</div>

<div class="bg-white p-6 rounded shadow">

    <p><b>Nama:</b> {{ $guest->name }}</p>
    <p><b>Email:</b> {{ $guest->email }}</p>
    <p><b>Telepon:</b> {{ $guest->phone }}</p>
    <p><b>No Identitas:</b> {{ $guest->id_number }}</p>
    <p><b>Alamat:</b> {{ $guest->address }}</p>

</div>

<div class="mt-6 bg-white p-6 rounded shadow">
    <h2 class="font-bold mb-3">Riwayat Booking</h2>

    @forelse($guest->bookings as $booking)
        <p>
            Kamar: {{ $booking->room->room_number ?? '-' }} |
            Status: {{ $booking->status }}
        </p>
    @empty
        <p class="text-gray-500">Belum ada booking</p>
    @endforelse
</div>

@endsection