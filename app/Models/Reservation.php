<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
    ];

    // 予約の定数
    public const CANCEL_STATUS_FALSE = 0;
    public const CANCEL_STATUS_TRUE = 1;

    public const CANCEL_STATUS = [
        self::CANCEL_STATUS_FALSE => '予約中',
        self::CANCEL_STATUS_TRUE => 'キャンセル済み'
    ];


    // リレーション
    // 予約(reservation)と宿泊プランプライス(planPrice)の中間テーブル
    public function reservationPlanPrices()
    {
        return $this->hasMany(ReservationPlanPrice::class);
    }

    public function guest()
    {
        return $this->belongsTo(Guest::class);
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }
}
