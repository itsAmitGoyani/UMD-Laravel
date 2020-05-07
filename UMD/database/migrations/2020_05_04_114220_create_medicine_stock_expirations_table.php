<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicineStockExpirationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicine_stock_expirations', function (Blueprint $table) {
            $table->id();
            $table->integer('medicine_stock_id')->unsigned();
            $table->date('expirydate');
            $table->integer('qty')->unsigned();
            $table->foreign('medicine_stock_id')->references('id')->on('medicine_stocks')->onDelete('cascade');
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
        Schema::dropIfExists('medicine_stock_expirations');
    }
}
