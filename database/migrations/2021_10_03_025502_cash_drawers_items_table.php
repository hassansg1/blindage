<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CashDrawersItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cash_drawers_items', function (Blueprint $table) {
            $table->id();
            $table->integer('cash_drawer_id');
            $table->float('cash_one')->nullable();
            $table->float('cash_five')->nullable();
            $table->float('cash_ten')->nullable();
            $table->float('cash_twenty')->nullable();
            $table->float('cash_fifty')->nullable();
            $table->float('cash_hundred')->nullable();
            $table->float('coin_point_z_one')->nullable();
            $table->float('coin_point_z_five')->nullable();
            $table->float('coin_point_one')->nullable();
            $table->float('coin_point_two_five')->nullable();
            $table->float('coin_point_five')->nullable();
            $table->float('coin_one')->nullable();
            $table->float('total_cash')->nullable();
            $table->float('total_coins')->nullable();
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
        Schema::dropIfExists('cash_drawers_items');
    }
}
