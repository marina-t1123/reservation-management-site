<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
    ];

    // リレーション
    public function reservationSlots()
    {
        return $this->hasMany(ReservationSlot::class);
    }
}
