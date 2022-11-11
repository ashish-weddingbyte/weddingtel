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
        Schema::create('real_weddings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable();
            $table->foreignId('real_wedding_id')->nullable();
            $table->string('city')->nullable();
            $table->string('name')->nullable();
            $table->string('partner_name')->nullable();
            $table->string('featured_image')->nullable();
            $table->text('title')->nullable();
            $table->text('description')->nullable();
            $table->string('tag_vendors')->nullable();
            $table->date('date')->nullable();
            $table->enum('is_gallery', ['0', '1'])->default('0');
            $table->enum('status', ['0', '1'])->default('1');
            $table->enum('added_by', ['user', 'admin'])->nullable();
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
        Schema::dropIfExists('real_weddings');
    }
};
