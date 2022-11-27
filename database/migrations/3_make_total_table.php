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
        Schema::create('total', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('TotalDiscountAmount');
            $table->integer('TotalSalesAmount');
            $table->integer('NetAmount');
            $table->integer('ExtraDiscountAmount');
            $table->integer('TotalAmount');
            $table->integer('TotalItemsDiscountAmount');
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
