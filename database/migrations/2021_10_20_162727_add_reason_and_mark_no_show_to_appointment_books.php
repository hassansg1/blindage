<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddReasonAndMarkNoShowToAppointmentBooks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('appointment_books', function (Blueprint $table) {
            $table->enum('mark_no_show', array('0', '1'));
            $table->string('reason', 255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('appointment_books', function (Blueprint $table) {
            //
        });
    }
}
