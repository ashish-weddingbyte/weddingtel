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
            $table->enum('is_email_verified', ['0', '1'])->default('0');
            $table->enum('is_mobile_verified', ['0', '1'])->default('1');
            $table->string('brandname')->nullable();
            $table->string('city');
            $table->foreignId('city_id')->nullable();
            $table->string('profile_image')->nullable();
            $table->enum('gender', ['male','female'])->nullable();
            $table->string('featured_image')->nullable();
            $table->text('address')->nullable();
            $table->text('description')->nullable();
            $table->enum('is_travelable', ['0','1'])->nullable();
            $table->string('cancel_policy')->nullable();
            $table->enum('advance_payment', ['10','20','30','40','50','60','70','80','90','100'])->nullable();
            $table->text('service_offered')->nullable();
            $table->text('business_offered')->nullable();
            $table->string('starting_price')->nullable();
            $table->integer('listing_order')->nullable();
            $table->enum('is_featured', ['0','1'])->nullable()->default('0');
            $table->enum('is_top', ['0','1'])->nullable()->default('0');
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
