<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('first_name', 255);
            $table->string('last_name', 255);
            $table->integer('category')->nullable();
            $table->string('mobile_no', 255)->nullable();
            $table->string('alt_mobile_no', 255)->nullable();
            $table->date('dob')->nullable();
            $table->string('email', 255)->nullable();
            $table->tinyInteger('active')->default(1);
            $table->string('address_line_1',255)->nullable();
            $table->string('address_line_2',255)->nullable();
            $table->string('city',255)->nullable();
            $table->string('state',255)->nullable();
            $table->string('postal_code',255)->nullable();
            $table->integer('referral')->nullable();
            $table->text('comments')->nullable();
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
        Schema::dropIfExists('clients');
    }
}
