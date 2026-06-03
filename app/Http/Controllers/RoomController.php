<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Services\RoomService;
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
    protected RoomService $roomService;

    public function __construct(RoomService $roomService)
    {
        $this->roomService = $roomService;
    }
    
    public function index()
    {
        $rooms = Room::all();
        
        return view('rooms.index', compact('rooms'));
    }

    public function create()
    {
        $roomTypes = config('hotel.room_types');

        return view('rooms.form', compact('roomTypes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'room_number' => 'required|unique:rooms,room_number',
            'type' => 'required|in:standard,deluxe,suite',
            'floor' => 'required|integer',
            'status' => 'required|in:available,occupied,maintenance',
        ]);

        Room::create($validated);

        return redirect()->route('rooms.index')->with('success', 'Kamar berhasil ditambahkan');
    }

    public function show(int $id)
    {
        return redirect()->route('rooms.edit', $id);
    }

    public function edit(int $id)
    {
        $room = Room::findOrFail($id);
        $roomTypes = config('hotel.room_types');

        return view('rooms.form', compact('room', 'roomTypes'));
    }

    public function update(Request $request, int $id)
    {
        $room = Room::findOrFail($id);

        $validated = $request->validate([
            'room_number' => 'required|unique:rooms,room_number,' . $id,
            'type' => 'required|in:standard,deluxe,suite',
            'floor' => 'required|integer',
            'status' => 'required|in:available,occupied,maintenance',
        ]);
        
        $room->update($validated);

        return redirect()->route('rooms.index')->with('success', 'Kamar berhasil diupdate');
    }

    public function destroy(int $id)
    {
        $room = Room::findOrFail($id);
        $room->delete();

        return redirect()->route('rooms.index')->with('success', 'Kamar berhasil dihapus');
    }
}
