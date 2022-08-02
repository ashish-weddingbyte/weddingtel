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
        Schema::create('planning_tools', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->enum('is_checklist', ['0', '1'])->default('1');
            $table->enum('is_guestlist', ['0', '1'])->default('1');
            $table->enum('is_budget', ['0', '1'])->default('1');
            $table->enum('is_vendor_manager', ['0', '1'])->default('1');
            $table->enum('is_real_weading', ['0', '1'])->default('0');
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
        Schema::dropIfExists('planning_tools');
    }
};
