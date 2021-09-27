<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoyaltyPointsLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loyalty_points_log', function (Blueprint $table) {
            $table->id();
            $table->string('userable_type',50);
            $table->integer('userable_id');
            $table->double('adjustment')->nullable();
            $table->double('balance')->nullable();
            $table->string('ticket_id',50)->nullable();
            $table->string('comment',255)->nullable();
            $table->string('description',255)->nullable();
            $table->integer('performed_by')->nullable();
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
        Schema::dropIfExists('loyalty_points_log');
    }
}
