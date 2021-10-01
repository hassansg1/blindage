<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentBooksItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointment_books_items', function (Blueprint $table) {
            $table->id();
            $table->string('serviceitemable_type',255);
            $table->integer('serviceitemable_id');
            $table->double('appointment_book_id')->nullable();
            $table->double('quantity')->nullable();
            $table->double('price')->nullable();

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
        Schema::dropIfExists('appointment_books_items');
    }
}
