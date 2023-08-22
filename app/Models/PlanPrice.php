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

    // 宿泊プラン
    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

    // 予約枠
    public function reservationSlot()
    {
        return $this->belongsTo(ReservationSlot::class);
    }

    // 予約(reservation)と宿泊プランプライス(planPrice)の中間テーブル
    public function reservationPlanPrices()
    {
        return $this->hasMany(ReservationPlanPrice::class);
    }
}
