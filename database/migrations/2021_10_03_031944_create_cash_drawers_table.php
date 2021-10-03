<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCashDrawersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cash_drawers', function (Blueprint $table) {
                        $table->id();
                        $table->integer('branch_id');
                        $table->date('cash_date');
                        $table->time('time_from')->nullable();
                        $table->time('time_to')->nullable();
                        $table->text('comment')->nullable();
                        $table->string('is_time_selected')->nullable();
                        $table->float('total_amount')->nullable();
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
    Schema::dropIfExists('cash_drawers');
    }
}
