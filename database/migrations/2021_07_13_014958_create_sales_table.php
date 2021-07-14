<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('product_id');
            $table->integer('quantity');
            $table->decimal('discount',10,2)->nullable()->default('0');
            $table->string('status');
            $table->decimal('product_price',10,2);
            $table->decimal('total_purchase_amount',10,2);
            $table->timestamps();

            $table->foreign('client_id')->references('id')->on('client')->onDelete('CASCADE');
            $table->foreign('product_id')->references('id')->on('product')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales');
    }
}
