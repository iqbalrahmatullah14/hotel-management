{{-- Tugas E.7 — Payments Index
     TODO Tugas E:
     1. Di PaymentController::index(), kirim $payments:
        $payments = Payment::with(['booking.guest'])->latest()->get();
        return view('payments.index', compact('payments'));
     2. Ganti baris static dengan @foreach ($payments as $payment)
    --}}
@extends('layouts.app')
@section('title', 'Manajemen Pembayaran')
@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Manajemen Pembayaran</h1>
        <p class="text-gray-500 text-sm">Daftar semua pembayaran hotel</p>
    </div>
    <div class="bg-white rounded-xl shadow-sm border border-gray-200">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 text-gray-600 uppercase text-xs">
                    <tr>
                        <th class="px-6 py-3 text-left">#</th>
                        <th class="px-6 py-3 text-left">Booking</th>
                        <th class="px-6 py-3 text-left">Tamu</th>
                        <th class="px-6 py-3 text-left">Subtotal</th>
                        <th class="px-6 py-3 text-left">Pajak</th>
                        <th class="px-6 py-3 text-left">Metode</th>
                        <th class="px-6 py-3 text-left">Status</th>
                        <th class="px-6 py-3 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse ($payments as $payment)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-3 text-gray-500">{{ $loop->iteration }}</td>
                            <td class="px-6 py-3">#{{ $payment->booking_id }}</td>
                            <td class="px-6 py-3 font-medium text-gray-800">{{ $payment->booking->guest->name ?? '-' }}</td>
                            <td class="px-6 py-3">Rp {{ number_format($payment->amount, 0, ',', '.') }}</td>
                            <td class="px-6 py-3">Rp {{ number_format($payment->tax_amount, 0, ',', '.') }}</td>
                            <td class="px-6 py-3">{{ ucfirst($payment->payment_method) }}</td>
                            <td class="px-6 py-3">
                                @php
                                    $statusMap = [
                                        'pending' => ['label' => 'Pending', 'class' => 'bg-amber-100 text-amber-700'],
                                        'paid' => ['label' => 'Paid', 'class' => 'bg-emerald-100 text-emerald-700'],
                                        'cancelled' => ['label' => 'Cancelled', 'class' => 'bg-red-100 text-red-700'],
                                    ];
                                    $status = $statusMap[$payment->status] ?? ['label' => ucfirst((string) $payment->status), 'class' => 'bg-gray-100 text-gray-700'];
                                @endphp
                                <span class="px-2 py-1 text-xs font-medium rounded-full {{ $status['class'] }}">{{ $status['label'] }}</span>
                            </td>
                            <td class="px-6 py-3">
                                <div class="flex items-center gap-2">
                                    <a href="{{ route('payments.show', $payment->id) }}" class="text-blue-600 hover:text-blue-800 p-1"
                                        title="Invoice / Detail">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </a>
                                    <button onclick="openStatusModal({{ $payment->id }}, '{{ $payment->status }}')"
                                        class="text-indigo-600 hover:text-indigo-800 p-1" title="Ubah Status">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-6 py-4 text-center text-gray-500">Belum ada data pembayaran.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('scripts')
    {{-- Modal Ubah Status Pembayaran — Tugas E.6 --}}
    <div id="status-modal-overlay" class="fixed inset-0 bg-black/40 z-50 hidden flex items-center justify-center"
        onclick="closeStatusModal()">
        <div class="bg-white rounded-xl shadow-xl p-6 max-w-sm w-full mx-4" onclick="event.stopPropagation()">
            <div class="flex items-center gap-3 mb-5">
                <div class="w-10 h-10 bg-indigo-100 rounded-full flex items-center justify-center">
                    <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div>
                    <h3 class="font-semibold text-gray-900">Ubah Status Pembayaran</h3>
                    <p class="text-sm text-gray-500">Pilih status baru untuk pembayaran ini.</p>
                </div>
            </div>

            {{-- TODO Tugas E: Form ini submit ke route('payments.updateStatus', $payment->id) --}}
            <form id="status-update-form" method="POST" action="">
                @csrf
                <div class="space-y-2 mb-5">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Status Baru</label>
                    <div class="space-y-2">
                        <label
                            class="flex items-center gap-3 p-3 border border-gray-200 rounded-lg cursor-pointer hover:bg-gray-50">
                            <input type="radio" name="status" value="pending" class="text-indigo-600">
                            <span
                                class="px-2 py-1 text-xs font-medium rounded-full bg-amber-100 text-amber-700">Pending</span>
                        </label>
                        <label
                            class="flex items-center gap-3 p-3 border border-gray-200 rounded-lg cursor-pointer hover:bg-gray-50">
                            <input type="radio" name="status" value="paid" class="text-indigo-600">
                            <span
                                class="px-2 py-1 text-xs font-medium rounded-full bg-emerald-100 text-emerald-700">Paid</span>
                        </label>
                        <label
                            class="flex items-center gap-3 p-3 border border-gray-200 rounded-lg cursor-pointer hover:bg-gray-50">
                            <input type="radio" name="status" value="cancelled" class="text-indigo-600">
                            <span
                                class="px-2 py-1 text-xs font-medium rounded-full bg-red-100 text-red-700">Cancelled</span>
                        </label>
                    </div>
                </div>
                <div class="flex gap-3 justify-end">
                    <button type="button" onclick="closeStatusModal()"
                        class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-lg transition-colors">
                        Batal
                    </button>
                    <button type="submit"
                        class="px-4 py-2 text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 rounded-lg transition-colors">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openStatusModal(paymentId, currentStatus) {
            const form = document.getElementById('status-update-form');
            form.action = '/payments/' + paymentId + '/update-status';

            // Pre-select current status
            const radios = form.querySelectorAll('input[type="radio"]');
            radios.forEach(r => r.checked = (r.value === currentStatus));

            document.getElementById('status-modal-overlay').classList.remove('hidden');
        }

        function closeStatusModal() {
            document.getElementById('status-modal-overlay').classList.add('hidden');
        }
    </script>
@endpush
