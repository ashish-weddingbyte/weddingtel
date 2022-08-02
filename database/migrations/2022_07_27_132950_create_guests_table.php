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
        Schema::create('guests', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('group_id');
            $table->foreignId('user_id')->nullable();
            $table->string('mobile')->nullable();
            $table->integer('no_of_guest');
            $table->text('comment')->nullable();
            $table->text('address')->nullable();
            $table->enum('status', ['pending', 'confirm', 'cancel'])->default('pending');
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
        Schema::dropIfExists('guests');
    }
};
