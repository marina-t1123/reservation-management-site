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

    public function planPrices()
    {
        return $this->hasMany(PlanPrice::class);
    }

    // public function plans()
    // {
    //     return $this->belongsToMany(Plan::class);
    // }
    // この予約枠に紐づく宿泊プランを取得する際に、中間テーブルとしてreservation_slot_planテーブル(通常の命名規則)を参照する
    // 今回は、中間テーブルの命名規則が任意の中間テーブル名にしている。（plan_priceテーブル）なので、中間テーブル名を明示的に指定する必要がある。
    // また、中間テーブルに対してマイグレーションファイルを作成して、モデルファイルも作成を行う必要がある
}
