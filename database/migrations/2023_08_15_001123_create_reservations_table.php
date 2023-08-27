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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('plan_id')->comment('プランID')->constrained()->cascadeOnUpdate();
            $table->foreignId('guest_id')->comment('宿泊者ID')->constrained()->cascadeOnUpdate();
            $table->date('checkin_date')->comment('チェックイン日');
            $table->date('checkout_date')->comment('チェックアウト日');
            $table->string('memo')->comment('備考欄');
            $table->boolean('cancel_at')->default(false)->comment('キャンセルステータス');
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
        Schema::dropIfExists('reservations');
    }
};
