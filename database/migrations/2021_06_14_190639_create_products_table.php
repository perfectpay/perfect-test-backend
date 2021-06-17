<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained();
            // constraint da foreign key para relacionar o produto com uma categoria
            $table->string('name');
            $table->string('brief')->nullable();
            $table->longtext('description')->nullable();
            $table->string('image');
            $table->decimal('price',10,2);
            $table->timestamps();
            $table->softDeletes();


            
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
