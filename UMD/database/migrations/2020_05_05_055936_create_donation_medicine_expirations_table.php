<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDonationMedicineExpirationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donation_medicine_expirations', function (Blueprint $table) {
            $table->id();
            $table->integer('donation_medicine_id')->unsigned();
            $table->date('expirydate');
            $table->integer('qty')->unsigned();
            
            $table->foreign('donation_medicine_id')->references('id')->on('donation_medicines')->onDelete('cascade');
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
        Schema::dropIfExists('donation_medicine_expirations');
    }
}
