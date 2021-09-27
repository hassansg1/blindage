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
            $table->string('name',255);
            $table->tinyInteger('backbar_item')->default(0);
            $table->integer('brand')->nullable();
            $table->integer('category')->nullable();
            $table->string('size',50)->nullable();
            $table->string('sku',100)->nullable();
            $table->double('wholesale_price')->nullable();
            $table->double('retail_price')->nullable();
            $table->double('count')->nullable();
            $table->integer('supplier')->nullable();
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
        Schema::dropIfExists('products');
    }
}
