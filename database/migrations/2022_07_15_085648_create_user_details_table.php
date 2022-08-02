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
        Schema::create('user_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->enum('is_email_verified', ['0', '1']);
            $table->enum('is_mobile_verified', ['0', '1']);
            $table->date('event');
            $table->string('city');
            $table->string('profile')->nullable();
            $table->enum('type', ['bride','groom'])->nullable();
            $table->string('partner_name')->nullable();
            $table->string('partner_profile')->nullable();
            $table->string('wedding_address')->nullable();
            $table->string('cover_image')->nullable();
            $table->foreignId('partner_id')->nullable();
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
        Schema::dropIfExists('user_details');
    }
};
