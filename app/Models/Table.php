<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    /** @use HasFactory<\Database\Factories\TableFactory> */
    use HasFactory;



    protected $fillable = [
        'table_num',
        'capacity',
        'status',
        'room_id'
    ];

    // public function room()
    // {
    //     return $this->belongsTo(Rooms::class);
    // }
    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

}
