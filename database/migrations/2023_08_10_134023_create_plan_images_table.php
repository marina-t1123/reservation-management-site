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
        Schema::create('plan_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('plan_id')->comment('プランID')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('path')->comment('画像パス');
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
        Schema::dropIfExists('plan_images');
    }
};
