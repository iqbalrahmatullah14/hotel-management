<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use Illuminate\Http\Request;
use App\Services\GuestService;

class GuestController extends Controller
{
    protected $guestService;

    public function __construct(GuestService $guestService)
    {
        $this->guestService = $guestService;
    }

    // INDEX
    public function index()
    {
        $guests = Guest::all();
        return view('guests.index', compact('guests'));
    }

    // CREATE
    public function create()
    {
        return view('guests.form');
    }

    // STORE
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'nullable|email|unique:guests,email',
            'phone' => 'nullable',
            'id_number' => 'required|unique:guests,id_number',
            'address' => 'nullable',
        ]);

        $this->guestService->createGuest($validated);

        return redirect()->route('guests.index')
            ->with('success', 'Tamu berhasil ditambahkan');
    }

    // SHOW
    public function show(int $id)
    {
        $guest = $this->guestService->findOrFail($id);
        $guest->load('bookings.room');

        return view('guests.show', compact('guest'));
    }

    // EDIT
    public function edit(int $id)
    {
        $guest = $this->guestService->findOrFail($id);
        return view('guests.form', compact('guest'));
    }

    // UPDATE
    public function update(Request $request, int $id)
    {
        $guest = $this->guestService->findOrFail($id);

        $validated = $request->validate([
            'name' => 'required',
            'email' => 'nullable|email|unique:guests,email,' . $id,
            'phone' => 'nullable',
            'id_number' => 'required|unique:guests,id_number,' . $id,
            'address' => 'nullable',
        ]);

        $guest->update($validated);

        return redirect()->route('guests.index')
            ->with('success', 'Tamu berhasil diupdate');
    }

    // DELETE
    public function destroy(int $id)
    {
        $guest = $this->guestService->findOrFail($id);
        $guest->delete();

        return redirect()->route('guests.index')
            ->with('success', 'Tamu berhasil dihapus');
    }
}