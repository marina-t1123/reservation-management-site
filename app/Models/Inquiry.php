<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    use HasFactory;

    // const
    const UNSUPPORTED = 0;
    const SUPPORTED = 1;

    // 対応ステータス
    const SUPPORT_STATUS = [
        0 => '未対応',
        1 => '対応済',
    ];

    protected $guarded = ['id'];
}
