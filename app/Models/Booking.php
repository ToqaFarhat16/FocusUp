<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    /** @use HasFactory<\Database\Factories\BookingFactory> */
    use HasFactory;

    protected $fillable = [
        'booking_date',
        'start_time',
        'end_time',
        'status',
        'user_id',
        'table_id',
        'rooms_id',
        'duration',
        'price',
        'consumption_packageid'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function table()
    {
        return $this->belongsTo(Table::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id');
    }
}
