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
    public function planPrice()
    {
        return $this->belongsTo(PlanPrice::class);
    }

    public function guest()
    {
        return $this->belongsTo(Guest::class);
    }
}
