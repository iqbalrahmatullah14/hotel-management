{{-- Tugas C.10 — Guests Index
     TODO Tugas C:
     1. Di GuestController::index(), kirim $guests = Guest::all();
     2. Ganti baris static dengan @foreach ($guests as $guest) --}}
@extends('layouts.app')
@section('title', 'Manajemen Tamu')
@section('content')
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Manajemen Tamu</h1>
            <p class="text-gray-500 text-sm">Kelola data tamu hotel</p>
        </div>
        <a href="{{ route('guests.create') }}"
            class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Tambah Tamu
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
                    {{-- TODO Tugas C: Ganti static rows dengan @foreach ($guests as $guest) --}}
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-3 text-gray-500">1</td>
                        <td class="px-6 py-3 font-semibold text-gray-800">Budi Santoso</td>
                        <td class="px-6 py-3">budi@example.com</td>
                        <td class="px-6 py-3">081234567890</td>
                        <td class="px-6 py-3 font-mono text-xs">3201010101010001</td>
                        <td class="px-6 py-3">
                            <div class="flex gap-2">
                                {{-- TODO Tugas C: Ganti route('guests.show', 1) → route('guests.show', $guest) --}}
                                <a href="{{ route('guests.show', 1) }}" class="text-blue-600 hover:text-blue-800 p-1"
                                    title="Detail">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </a>
                                <a href="{{ route('guests.edit', 1) }}" class="text-amber-600 hover:text-amber-800 p-1"
                                    title="Edit">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </a>
                                {{-- TODO Tugas C: Implementasi delete via form @method('DELETE') --}}
                                <button onclick="openDeleteModal('delete-modal-guest-1')"
                                    class="text-red-600 hover:text-red-800 p-1 cursor-pointer" title="Hapus">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                                <form id="delete-modal-guest-1-form" action="{{ route('guests.destroy', 1) }}"
                                    method="POST" class="hidden">
                                    @csrf @method('DELETE')
                                </form>
                            </div>
                        </td>
                    </tr>
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-3 text-gray-500">2</td>
                        <td class="px-6 py-3 font-semibold text-gray-800">Siti Aminah</td>
                        <td class="px-6 py-3">siti@example.com</td>
                        <td class="px-6 py-3">081298765432</td>
                        <td class="px-6 py-3 font-mono text-xs">3201020202020002</td>
                        <td class="px-6 py-3">
                            <div class="flex gap-2">
                                <a href="{{ route('guests.show', 2) }}" class="text-blue-600 hover:text-blue-800 p-1"
                                    title="Detail">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </a>
                                <a href="{{ route('guests.edit', 2) }}" class="text-amber-600 hover:text-amber-800 p-1"
                                    title="Edit">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </a>
                                <button onclick="openDeleteModal('delete-modal-guest-2')"
                                    class="text-red-600 hover:text-red-800 p-1 cursor-pointer" title="Hapus">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                                <form id="delete-modal-guest-2-form" action="{{ route('guests.destroy', 2) }}"
                                    method="POST" class="hidden">
                                    @csrf @method('DELETE')
                                </form>
                            </div>
                        </td>
                    </tr>
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-3 text-gray-500">3</td>
                        <td class="px-6 py-3 font-semibold text-gray-800">Andi Wijaya</td>
                        <td class="px-6 py-3">andi@example.com</td>
                        <td class="px-6 py-3">081311112222</td>
                        <td class="px-6 py-3 font-mono text-xs">3201030303030003</td>
                        <td class="px-6 py-3">
                            <div class="flex gap-2">
                                <a href="{{ route('guests.show', 3) }}" class="text-blue-600 hover:text-blue-800 p-1"
                                    title="Detail">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </a>
                                <a href="{{ route('guests.edit', 3) }}" class="text-amber-600 hover:text-amber-800 p-1"
                                    title="Edit">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </a>
                                <button onclick="openDeleteModal('delete-modal-guest-3')"
                                    class="text-red-600 hover:text-red-800 p-1 cursor-pointer" title="Hapus">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                                <form id="delete-modal-guest-3-form" action="{{ route('guests.destroy', 3) }}"
                                    method="POST" class="hidden">
                                    @csrf @method('DELETE')
                                </form>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('scripts')
    {{-- Delete Confirmation Modal: Guests --}}
    <div id="delete-modal-overlay" class="fixed inset-0 bg-black/40 z-50 hidden flex items-center justify-center"
        onclick="closeDeleteModal()">
        <div class="bg-white rounded-xl shadow-xl p-6 max-w-sm w-full mx-4" onclick="event.stopPropagation()">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-10 h-10 bg-red-100 rounded-full flex items-center justify-center">
                    <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </div>
                <div>
                    <h3 class="font-semibold text-gray-900">Konfirmasi Hapus</h3>
                    <p class="text-sm text-gray-500">Data yang dihapus tidak dapat dikembalikan.</p>
                </div>
            </div>
            <p class="text-sm text-gray-600 mb-5">Apakah Anda yakin ingin menghapus data tamu ini?</p>
            <div class="flex gap-3 justify-end">
                <button onclick="closeDeleteModal()"
                    class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-lg transition-colors">Batal</button>
                <button id="confirm-delete-btn"
                    class="px-4 py-2 text-sm font-medium text-white bg-red-600 hover:bg-red-700 rounded-lg transition-colors">Ya,
                    Hapus</button>
            </div>
        </div>
    </div>
    <script>
        let activeFormId = null;

        function openDeleteModal(formId) {
            activeFormId = formId + '-form';
            document.getElementById('delete-modal-overlay').classList.remove('hidden');
        }

        function closeDeleteModal() {
            activeFormId = null;
            document.getElementById('delete-modal-overlay').classList.add('hidden');
        }
        document.getElementById('confirm-delete-btn').addEventListener('click', function() {
            if (activeFormId) document.getElementById(activeFormId).submit();
        });
    </script>
@endpush
