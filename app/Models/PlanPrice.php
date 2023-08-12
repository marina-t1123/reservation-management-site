<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanPrice extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
    ];

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

    public function reservationSlot()
    {
        return $this->belongsTo(ReservationSlot::class);
    }
}
