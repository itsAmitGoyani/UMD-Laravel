<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDonationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donations', function (Blueprint $table) {
            $table->id();
            $table->integer('donator_id')->unsigned();
            $table->integer('ngo_id')->unsigned();
            $table->integer('pickupman_id')->unsigned();
            $table->dateTime('datetime');
            $table->string('status')->default('Pending');
            $table->integer('verifier_id')->unsigned()->nullable();
            
            $table->foreign('ngo_id')->references('id')->on('ngos')->onDelete('cascade');
            $table->foreign('donator_id')->references('id')->on('donators')->onDelete('cascade');
            $table->foreign('pickupman_id')->references('id')->on('pickupmen')->onDelete('cascade');
            $table->foreign('verifier_id')->references('id')->on('verifiers')->onDelete('cascade');
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
        Schema::dropIfExists('donations');
    }
}
