<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CriarTabelaVenda extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('venda', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->foreignId('id_produto')->constrained('produto');
            $table->foreignId('id_cliente')->constrained('cliente');
            $table->dateTime('data_venda');
            $table->integer('quantidade');
            $table->float('desconto', 10, 2);
            $table->string('status');
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
