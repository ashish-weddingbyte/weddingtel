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
        Schema::create('wedding_infos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('season')->nullable();
            $table->string('theme')->nullable();
            $table->string('tags')->nullable();
            $table->string('community')->nullable();
            $table->string('feature_image')->nullable();
            $table->text('note')->nullable();
            $table->enum('status', ['0', '1'])->default('0');
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
        Schema::dropIfExists('wedding_infos');
    }
};
