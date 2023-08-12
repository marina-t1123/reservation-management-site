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
        Schema::create('plan_prices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reservation_slot_id')->comment('予約枠ID')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('plan_id')->comment('プランID')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->integer('price')->comment('料金');
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
        Schema::dropIfExists('plan_price');
    }
};
