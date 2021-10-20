<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class GeneralScheduleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('general_schedules', function (Blueprint $table) {
            $table->id();
            $table->integer('branch_id');
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
            $table->string('is_open')->nullable();
            $table->string('day')->nullable();
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
        Schema::dropIfExists('general_schedules');
    }
}
