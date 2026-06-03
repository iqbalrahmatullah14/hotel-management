@extends('layouts.app')

@section('title', 'Manajemen Tamu')

@section('content')
<div class="flex justify-between items-center mb-6">
    <div>
        <h1 class="text-2xl font-bold text-gray-800">Manajemen Tamu</h1>
        <p class="text-gray-500 text-sm">Kelola data tamu hotel</p>
    </div>

    <a href="{{ route('guests.create') }}"
       class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg text-sm font-medium">
        + Tambah Tamu
    </a>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-200">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 text-gray-600 uppercase text-xs">
                <tr>
                    <th class="px-6 py-3 text-left">#</th>
                    <th class="px-6 py-3 text-left">Nama</th>
                    <th class="px-6 py-3 text-left">Email</th>
                    <th class="px-6 py-3 text-left">Telepon</th>
                    <th class="px-6 py-3 text-left">No. Identitas</th>
                    <th class="px-6 py-3 text-left">Aksi</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-200">

                @forelse($guests as $guest)
                <tr class="hover:bg-gray-50">

                    <td class="px-6 py-3">{{ $loop->iteration }}</td>
                    <td class="px-6 py-3 font-semibold">{{ $guest->name }}</td>
                    <td class="px-6 py-3">{{ $guest->email }}</td>
                    <td class="px-6 py-3">{{ $guest->phone }}</td>
                    <td class="px-6 py-3 font-mono text-xs">{{ $guest->id_number }}</td>

                    <td class="px-6 py-3">
                        <div class="flex gap-3 items-center">

                            {{-- DETAIL (MATA) --}}
                            <a href="{{ route('guests.show', $guest->id) }}"
                               class="text-blue-600 hover:text-blue-800"
                               title="Detail">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </a>

                            {{-- EDIT (PENCIL) --}}
                            <a href="{{ route('guests.edit', $guest->id) }}"
                               class="text-amber-600 hover:text-amber-800"
                               title="Edit">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </a>

                            {{-- DELETE (TRASH) --}}
                            <form action="{{ route('guests.destroy', $guest->id) }}" method="POST">
                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        onclick="return confirm('Yakin hapus data ini?')"
                                        class="text-red-600 hover:text-red-800"
                                        title="Hapus">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </form>

                        </div>
                    </td>

                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-6 text-gray-500">
                        Belum ada data tamu
                    </td>
                </tr>
                @endforelse

            </tbody>
        </table>
    </div>
</div>
@endsection