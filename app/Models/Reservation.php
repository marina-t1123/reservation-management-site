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
