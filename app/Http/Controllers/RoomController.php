<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Services\RoomService;
use Illuminate\Http\Request;

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
