<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableVendasAddColumnProdutosId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vendas', function (Blueprint $table) {
            
         /*    $table->unsignedBigInteger('produtos_id')->after('id');
            $table->foreign('produtos_id')->references('id')->on('produtos');
 */
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vendas', function (Blueprint $table) {
           /*  $table->$table->dropForeign('vendas_produtos_id_foreign');
            $table->drop('produtos_id'); */
            
        });
    }
}
