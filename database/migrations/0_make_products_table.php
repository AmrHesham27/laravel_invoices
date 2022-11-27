<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use function Ramsey\Uuid\v1;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('Name', 60);
            $table->integer('Price');
            $table->integer('Quantity');
            $table->integer('Sales')->default(0);
            $table->tinyInteger('Discount')->default(0);
            $table->integer('DiscountAmount')->default(0);
            $table->integer('Net')->default(0);
            $table->integer('ValueDifference');
            $table->integer('ItemDiscount');
            $table->integer('TotalTaxableAmount')->default(0);
            $table->integer('TotalNonTaxableAmount')->default(0);
            $table->integer('Total')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
