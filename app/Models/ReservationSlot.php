<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservationSlot extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
    ];

    // リレーション
    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
