<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('venda', function (Blueprint $table) {
            $table->id();
            $table->dateTime('data');
            $table->smallInteger('quantidade');
            $table->decimal('desconto', 10, 2)->nullable();
            $table->string('status', 20);
            $table->foreignId('cliente_id')->references('id')->on('cliente')->onDelete('cascade');
            $table->foreignId('produto_id')->references('id')->on('produto');
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
        Schema::dropIfExists('venda');
    }
}