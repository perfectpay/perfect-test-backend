<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendas', function (Blueprint $table) 
        {
            $table->id();
            $table->date('dataVenda');
            $table->unsignedInteger('quantidadeProduto');
            $table->float('desconto',8,2);
            $table->string('statusVenda', 10);
            $table->timestamps();
            //foreign key
            $table->foreignId('produtoId');
            $table->foreignId('usuarioId');
            //referenciando foreign key
            $table->foreign('produtoId')->references('id')->on('produtos');
            $table->foreign('usuarioId')->references('id')->on('usuarios');
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vendas',function (Blueprint $table) 
        {
            //Removendo Foreign key caso precise fazer o rollback
            $table->dropForeign('produtos_produtoId_foreign');
            $table->dropForeign('usuarios_usuarioId_foreign');
            //Removendo coluna caso precise fazer o rollback
            $table->dropColumn('produtoId');
            $table->dropColumn('usuarioId');
        });
        Schema::dropIfExists('vendas');
    }
}
