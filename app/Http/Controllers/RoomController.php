<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

/**
 * PANDUAN PENGERJAAN — Anggota B (RoomController)
 *
 * B.4 index()
 *     → $rooms = Room::all();
 *     → return view('rooms.index', compact('rooms'));
 *
 * B.5 create()
 *     → $roomTypes = config('hotel.room_types');
 *     → return view('rooms.form', compact('roomTypes'));
 *
 * B.6 store($request)
 *     → Validasi: type (in:standard,deluxe,suite), room_number (unique), floor (integer), status
 *     → Room::create($validated);
 *
 * B.7 edit($id)
 *     → $room = Room::findOrFail($id);
 *     → $roomTypes = config('hotel.room_types');
 *     → return view('rooms.form', compact('room', 'roomTypes'));
 *
 * B.8 update($request, $id)
 *     → $room = Room::findOrFail($id);
 *     → Validasi (sama seperti B.6, room_number unique kecuali $id)
 *     → $room->update($validated);
 *
 * B.9 destroy($id)
 *     → $room = Room::findOrFail($id);
 *     → $room->delete();
 */
class RoomController extends Controller
{
    public function index()
    {
        return view('rooms.index');
    }

    public function create()
    {
        return view('rooms.form');
    }

    public function store(Request $request)
    {
        return redirect()->route('rooms.index')->with('success', 'Kamar berhasil ditambahkan');
    }

    public function show(int $id)
    {
        return redirect()->route('rooms.edit', $id);
    }

    public function edit(int $id)
    {
        return view('rooms.form');
    }

    public function update(Request $request, int $id)
    {
        return redirect()->route('rooms.index')->with('success', 'Kamar berhasil diupdate');
    }

    public function destroy(int $id)
    {
        return redirect()->route('rooms.index')->with('success', 'Kamar berhasil dihapus');
    }
}
