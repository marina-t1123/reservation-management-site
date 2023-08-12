<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // relation
    // public function reservationSlots()
    // {
    //     return $this->belongsToMany(ReservationSlot::class);
    // }
    // この宿泊プランに紐づく予約枠を取得する際に、中間テーブルとしてplan_priceテーブル(通常の命名規則)を参照する
    // 今回は、中間テーブルの命名規則が任意の中間テーブル名にしている。（plan_priceテーブル）なので、中間テーブル名を明示的に指定する必要がある。
    // また、中間テーブルに対してマイグレーションファイルを作成して、モデルファイルも作成を行う必要がある。

    public function planImages()
    {
        return $this->hasMany(PlanImage::class);
    }

    public function planPrices()
    {
        return $this->hasMany(PlanPrice::class);
    }
}
