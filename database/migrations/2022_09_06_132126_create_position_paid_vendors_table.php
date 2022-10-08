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
        Schema::create('position_paid_vendors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('plan_id');
            $table->foreignId('city_id');
            $table->string('plan_name');
            $table->date('start_at');
            $table->date('end_at');
            $table->enum('is_active', ['0', '1'])->default('1');
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
        Schema::dropIfExists('position_paid_vendors');
    }
};
