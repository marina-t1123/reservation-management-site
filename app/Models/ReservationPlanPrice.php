<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservationPlanPrice extends Model
{
    use HasFactory;

    protected $table = 'reservation_plan_price';

    protected $guarded = [
        'id',
    ];

    // リレーション
    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }

    public function planPrice()
    {
        return $this->belongsTo(PlanPrice::class);
    }

}
