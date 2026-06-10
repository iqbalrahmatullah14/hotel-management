<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Guest;
use App\Models\Room;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalRooms = Room::count();
        $availableRooms = Room::where('status', 'available')->count();
        $totalGuests = Guest::count();
        $totalBookings = Booking::count();
        $recentBookings = Booking::with(['guest', 'room'])->latest()->take(5)->get();

        return view('dashboard', compact('totalRooms', 'availableRooms', 'totalGuests', 'totalBookings', 'recentBookings'));
    }
}
