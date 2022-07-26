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
        Schema::create('lead_plans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id');
            $table->string('name');
            $table->enum('plan_type', ['normal','exclusive'])->default('normal');
            $table->integer('price');
            $table->integer('leads');
            $table->integer('days');
            $table->text('desc');
            $table->text('image')->nullable();
            $table->enum('support', ['NA','24/7'])->default('NA');
            $table->enum('status', ['0', '1'])->default('1');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lead_plans');
    }
};
