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
        Schema::create('media_galleries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->enum('media_type', ['image', 'pdf', 'doc', 'video', 'link'])->nullable();
            $table->string('name')->nullable();
            $table->enum('status', ['0', '1'])->default('1');
            $table->enum('user_type', ['vendor','user']); 
            $table->string('tags')->nullable();
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
        Schema::dropIfExists('media_galleries');
    }
};
