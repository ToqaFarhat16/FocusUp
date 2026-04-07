<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\CrowdingController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\TableController;

// use App\Models\Booking;
// use App\Models\Table;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
require __DIR__ . '/auth.php';

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});



Route::middleware(['auth:sanctum', 'role:admin'])->group(function () {

    // القاعات
    Route::post('/rooms', [RoomController::class, 'store']);
    Route::put('/rooms/{id}', [RoomController::class, 'update']);
    Route::delete('/rooms/{id}', [RoomController::class, 'destroy']);

    // الطاولات
    Route::post('/tables', [TableController::class, 'store']);
    Route::put('/tables/{id}', [TableController::class, 'update']);
    Route::delete('/tables/{id}', [TableController::class, 'destroy']);
});

// ========== Routes للموظف والمدير (عرض + تعديل الحجوزات) ==========
Route::middleware(['auth:sanctum', 'role:admin,receptionist'])->group(function () {

    Route::post('/bookings', [BookingController::class, 'store']);
    Route::put('/bookings/{id}', [BookingController::class, 'update']);
    Route::post('/bookings/check_in', [BookingController::class, 'checkIn']);
    Route::post('/bookings/check_out', [BookingController::class, 'checkOut']);
    Route::post('/bookings/{id}/cancel', [BookingController::class, 'cancel']);
});

// ========== Routes للجميع (عرض فقط) ==========
Route::middleware(['auth:sanctum'])->group(function () {

    Route::get('/rooms', [RoomController::class, 'index']);
    Route::get('/rooms/{id}', [RoomController::class, 'show']);

    Route::get('/tables', [TableController::class, 'index']);
    Route::get('/tables/{id}', [TableController::class, 'show']);

    Route::get('/bookings', [BookingController::class, 'index']);
    Route::get('/bookings/{id}', [BookingController::class, 'show']);
});

// // للمدير فقط
// Route::post('/rooms', [RoomController::class, 'store'])->middleware('role:admin');

// // للموظف والمدير
// Route::post('/bookings', [BookingController::class, 'store'])->middleware('role:admin,receptionist');


// // Route::middleware('auth:sanctum')->group(function () {
// //     Route::apiResource('rooms', RoomController::class);
// // });


// Route::middleware('auth:sanctum')->group(function () {
//     // Crowding Routes
//     Route::get('/crowding', [CrowdingController::class, 'index']);
//     Route::get('/crowding/{id}', [CrowdingController::class, 'show']);
//     Route::post('/crowding/{id}/start_time', [CrowdingController::class, 'start_time']);
//     Route::post('/crowding/{id}/end_time', [CrowdingController::class, 'end_time']);
// });


// Route::middleware('auth:sanctum')->group(function (){
//     Route::apiResource('rooms',RoomController::class);
//     Route::apiResource('tables',TableController::class);
//     Route::apiResource('packages',PackageController::class);
//     Route::get('/bookings', [BookingController::class, 'index']);
//     Route::post('/bookings', [BookingController::class, 'store']);
//     Route::get('/bookings/{booking}', [BookingController::class, 'show']);

//     Route::post('/bookings/check_in', [BookingController::class, 'checkIn']);
//     Route::post('/bookings/check_out', [BookingController::class, 'checkOut']);

//     Route::post('/bookings/{booking}/cancel', [BookingController::class, 'cancel']);
// });


// //  الكل يشاهد (student, Receptions, admin)
//     Route::get('/tables', [TableController::class, 'index'])
//         ->middleware('permission:view_tables');




// Route::middleware('auth:sanctum')->post('/bookings', function (Request $request) {
//     $request->validate([
//         'room_id' => 'required|exists:rooms,id',
//         'booking_date' => 'required|date',
//         'start_time' => 'nullable',
//         'end_time' => 'nullable',
//     ]);

//     $booking = Booking::create([
//         'user_id' => auth()->id(),
//         'room_id' => $request->room_id,
//         'booking_date' => $request->booking_date,
//         'start_time' => null,
//         'end_time' => null,
//         'duration' => '02:00:00',
//         'price' => 0,
//         'status' => 'active',
//     ]);

//     return response()->json([
//         'success' => true,
//         'booking' => $booking
//     ], 201);
// });

