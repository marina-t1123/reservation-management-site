<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservation_plan_price', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reservation_id')->comment('予約ID')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('plan_price_id')->comment('予約枠の宿泊プラン料金ID')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservation_plan_price');
    }
};
