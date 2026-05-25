<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PaymentController;

// Dashboard
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// Kamar
Route::resource('rooms', RoomController::class);

// Tamu
Route::resource('guests', GuestController::class);

// Booking (resource + custom routes)
Route::resource('bookings', BookingController::class);
Route::post('bookings/{booking}/checkin', [BookingController::class, 'checkin'])->name('bookings.checkin');
Route::post('bookings/{booking}/checkout', [BookingController::class, 'checkout'])->name('bookings.checkout');
Route::post('bookings/{booking}/cancel', [BookingController::class, 'cancel'])->name('bookings.cancel');

// Pembayaran
Route::resource('payments', PaymentController::class);
Route::post('payments/{id}/update-status', [PaymentController::class, 'updateStatus'])->name('payments.updateStatus');
