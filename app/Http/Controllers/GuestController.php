<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use Illuminate\Http\Request;

/**
 * PANDUAN PENGERJAAN — Anggota C (GuestController)
 *
 * C.3 index()
 *     → $guests = Guest::all();
 *     → return view('guests.index', compact('guests'));
 *
 * C.4 create()
 *     → Tidak perlu diubah
 *
 * C.5 store($request)
 *     → Validasi: name (required), email (nullable|email|unique), phone, id_number (unique), address
 *     → Simpan via GuestService::createGuest($validated) atau Guest::create($validated)
 *
 * C.6 show($id)
 *     → $guest = Guest::findOrFail($id);
 *     → $guest->load('bookings.room');
 *     → return view('guests.show', compact('guest'));
 *
 * C.7 edit($id)
 *     → $guest = Guest::findOrFail($id);
 *     → return view('guests.form', compact('guest'));
 *
 * C.8 update($request, $id)
 *     → $guest = Guest::findOrFail($id);
 *     → Validasi (sama seperti C.5, email & id_number unique kecuali $id)
 *     → $guest->update($validated);
 *
 * C.9 destroy($id)
 *     → $guest = Guest::findOrFail($id);
 *     → $guest->delete();
 */
class GuestController extends Controller
{
    public function index()
    {
        return view('guests.index');
    }

    public function create()
    {
        return view('guests.form');
    }

    public function store(Request $request)
    {
        return redirect()->route('guests.index')->with('success', 'Tamu berhasil ditambahkan');
    }

    public function show(int $id)
    {
        return view('guests.show');
    }

    public function edit(int $id)
    {
        return view('guests.form');
    }

    public function update(Request $request, int $id)
    {
        return redirect()->route('guests.index')->with('success', 'Tamu berhasil diupdate');
    }

    public function destroy(int $id)
    {
        return redirect()->route('guests.index')->with('success', 'Tamu berhasil dihapus');
    }
}
