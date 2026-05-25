<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // TODO: Ganti return view ini dengan mengirim variabel dari database
        // Contoh: return view('dashboard', compact('totalRooms', 'availableRooms', ...));
        return view('dashboard');
    }
}
