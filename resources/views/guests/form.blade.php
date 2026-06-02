@extends('layouts.app')

@section('title', isset($guest) ? 'Edit Tamu' : 'Tambah Tamu')

@section('content')

<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-800">
        {{ isset($guest) ? 'Edit Tamu' : 'Tambah Tamu Baru' }}
    </h1>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 max-w-2xl">

    <form action="{{ isset($guest)
        ? route('guests.update', $guest->id)
        : route('guests.store') }}"
        method="POST">

        @csrf
        @if(isset($guest))
            @method('PUT')
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

            <div>
                <label>Nama</label>
                <input type="text" name="name"
                    value="{{ $guest->name ?? old('name') }}"
                    class="w-full border p-2 rounded">
            </div>

            <div>
                <label>Email</label>
                <input type="email" name="email"
                    value="{{ $guest->email ?? old('email') }}"
                    class="w-full border p-2 rounded">
            </div>

            <div>
                <label>Telepon</label>
                <input type="text" name="phone"
                    value="{{ $guest->phone ?? old('phone') }}"
                    class="w-full border p-2 rounded">
            </div>

            <div>
                <label>No Identitas</label>
                <input type="text" name="id_number"
                    value="{{ $guest->id_number ?? old('id_number') }}"
                    class="w-full border p-2 rounded">
            </div>

        </div>

        <div class="mt-4">
            <label>Alamat</label>
            <textarea name="address"
                class="w-full border p-2 rounded">{{ $guest->address ?? old('address') }}</textarea>
        </div>

        <div class="mt-6 flex gap-3">
            <button class="bg-indigo-600 text-white px-4 py-2 rounded">
                Simpan
            </button>

            <a href="{{ route('guests.index') }}"
               class="bg-gray-300 px-4 py-2 rounded">
                Batal
            </a>
        </div>

    </form>

</div>

@endsection