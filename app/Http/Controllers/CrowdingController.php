<?php

namespace App\Http\Controllers;

use App\Http\Resources\CrowdingResource;
use App\Models\Room;
use App\Services\CrowdingService;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;

class CrowdingController extends Controller
{
    use ResponseTrait;

    protected CrowdingService $crowdingService;

    public function __construct(CrowdingService $crowdingService)
    {
        $this->crowdingService = $crowdingService;
    }

    // جيب حالة كل الغرف
    public function index()
    {
        $data = $this->crowdingService->getAllRoomsCrowding();

        return $this->success(
            $data,
            'Crowding status fetched successfully'
        );
    }

    // جيب حالة غرفة محددة
    public function show($id)
    {
        $room = Room::find($id);

        if (!$room) {
            return $this->fail('Room not found');
        }

        $data = $this->crowdingService->getCrowdingStatus($room);

        return $this->success(
            new CrowdingResource($data),
            'Crowding status fetched successfully'
        );
    }

    // تسجيل دخول QR
    public function start_time(Request $request, $id)
    {
        $room = Room::find($id);
        if (!$room) {
            return $this->fail('Room not found');
        }

        $request->validate([
            'booking_id' => 'required|exists:bookings,id'
        ]);

        $result = $this->crowdingService->start_time($room, $request->booking_id);

        if (isset($result['error'])) {
            return $this->fail($result['error'], 422);
        }

        return $this->success(
            new CrowdingResource($result),
            'Checked in successfully'
        );
    }

    // تسجيل خروج QR
    public function end_time(Request $request, $id)
    {
        $room = Room::find($id);

        if (!$room) {
            return $this->fail('Room not found');
        }

        $request->validate([
            'booking_id' => 'required|exists:bookings,id'
        ]);

        $result = $this->crowdingService->end_time($room, $request->booking_id);

        if (isset($result['error'])) {
            return $this->fail($result['error'], 422);
        }

        return $this->success(
            new CrowdingResource($result),
            'Checked out successfully'
        );
    }
}
