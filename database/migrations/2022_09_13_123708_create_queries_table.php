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
        Schema::create('queries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable();
            $table->foreignId('vendor_id');
            $table->enum('user_type', ['guest','user'])->default('guest');
            $table->enum('query_type', ['send_message','view_contact']); 
            $table->string('name')->nullable();
            $table->string('mobile')->nullable();
            $table->string('budget')->nullable();
            $table->date('event_date')->nullable();
            $table->text('details')->nullable();
            $table->enum('is_mobile_verified', ['0', '1'])->default('0');
            $table->enum('status', ['0', '1'])->default('1');
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
        Schema::dropIfExists('queries');
    }
};
