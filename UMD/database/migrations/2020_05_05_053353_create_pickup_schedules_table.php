<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePickupSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pickup_schedules', function (Blueprint $table) {
            $table->id();
            $table->integer('donator_id')->unsigned();
            $table->integer('ngo_id')->unsigned();
            $table->date('date');
            $table->string('status')->default('Pending');
            $table->integer('pickupman_id')->unsigned()->nullable();
            
            $table->foreign('ngo_id')->references('id')->on('ngos')->onDelete('cascade');
            $table->foreign('donator_id')->references('id')->on('donators')->onDelete('cascade');
            $table->foreign('pickupman_id')->references('id')->on('pickupmen')->onDelete('cascade');
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
        Schema::dropIfExists('pickup_schedules');
    }
}
