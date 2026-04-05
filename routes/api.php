<?php

use App\Http\Controllers\CrowdingController;
use App\Http\Controllers\RoomController;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
require __DIR__ . '/auth.php';

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});



Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('rooms', RoomController::class);
});


Route::middleware('auth:sanctum')->group(function () {
    // Crowding Routes
    Route::get('/crowding', [CrowdingController::class, 'index']);
    Route::get('/crowding/{id}', [CrowdingController::class, 'show']);
    Route::post('/crowding/{id}/start_time', [CrowdingController::class, 'start_time']);
    Route::post('/crowding/{id}/end_time', [CrowdingController::class, 'end_time']);
});



Route::middleware('auth:sanctum')->post('/bookings', function (Request $request) {
    $request->validate([
        'room_id' => 'required|exists:rooms,id',
        'booking_date' => 'required|date',
        'start_time' => 'nullable',
        'end_time' => 'nullable',
    ]);

    $booking = Booking::create([
        'user_id' => auth()->id(),
        'room_id' => $request->room_id,
        'booking_date' => $request->booking_date,
        'start_time' => null,
        'end_time' => null,
        'duration' => '02:00:00',
        'price' => 0,
        'status' => 'active',
    ]);

    return response()->json([
        'success' => true,
        'booking' => $booking
    ], 201);
});

