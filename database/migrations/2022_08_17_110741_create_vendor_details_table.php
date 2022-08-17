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
        Schema::create('vendor_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('category_id')->nullable();
            $table->string('brandname')->nullable();
            $table->string('city');
            $table->foreignId('city_id')->nullable();
            $table->string('profile_image')->nullable();
            $table->enum('gender', ['male','female'])->nullable();
            $table->string('featured_image')->nullable();
            $table->enum('expert_level', ['Fresher', 'Entry Level', 'Mid Level', 'Expert Level'])->nullable();
            $table->string('advance_policy')->nullable();
            $table->string('cancel_policy')->nullable();
            $table->enum('advance_payment', ['10','20','30','40','50','60','70','80','90','100'])->nullable();
            $table->string('starting_price')->nullable();
            $table->integer('listing_order')->nullable();
            $table->enum('is_featured', ['male','female'])->nullable();
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
        Schema::dropIfExists('vendor_details');
    }
};
