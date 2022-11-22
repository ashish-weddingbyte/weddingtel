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
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('mobile');
            $table->string('budget');
            $table->text('details');
            $table->foreignId('category_id');
            $table->date('event_date');
            $table->string('city');
            $table->enum('type', ['new','relaunch'])->default('new');
            $table->enum('tags', ['gold','diamond','platinum','ultra-platinum'])->nullable();
            $table->enum('apply_tags', ['0', '1'])->default('0');
            $table->enum('status', ['0', '1'])->default('1');
            $table->enum('booking_status', ['booked', 'open'])->nullable();
            $table->enum('approved_status', ['0', '1'])->default('0');
            $table->integer('view_count')->default('0');
            $table->timestamps();
            $table->softDeletes();

            $table->index(['name','created_at']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('leads');
    }
};
