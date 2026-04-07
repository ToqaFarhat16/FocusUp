<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    /** @use HasFactory<\Database\Factories\TableFactory> */
    use HasFactory;



    protected $fillable = [
        'name',
        'type',
        'is_active',
        'is_occupied',
        'capacity',
        'status'
    ];

    public function tables()
    {
        return $this->hasMany(Table::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
