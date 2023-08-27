<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    // const
    const ROOM_TYPE_SINGLE = 1;

    const ROOM_TYPE_DOUBLE = 2;

    const ROOM_TYPE_TWIN = 3;

    const ROOM_TYPE = [
        self::ROOM_TYPE_SINGLE => 'シングル',
        self::ROOM_TYPE_DOUBLE => 'ダブル',
        self::ROOM_TYPE_TWIN => 'ツイン',
    ];

    // const
    // const ROOM_TYPE_SINGLE_GROUP = 'シングル';

    // const ROOM_TYPE_DOUBLE_GROUP = 'ダブル';

    // const ROOM_TYPE_TWIN_GROUP = 'ツイン';

    // const ROOM_TYPE_NUMBER = [
    //     self::ROOM_TYPE_SINGLE_GROUP => 1,
    //     self::ROOM_TYPE_DOUBLE_GROUP => 2,
    //     self::ROOM_TYPE_TWIN_GROUP => 3,
    // ];



    protected $guarded = [
        'id',
    ];

    // リレーション
    public function reservationSlots()
    {
        return $this->hasMany(ReservationSlot::class);
    }
}
