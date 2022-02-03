<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVandorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vandors', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->string('email');
            $table->string('name');
            $table->string('store_name');
            $table->string('address_one');
            $table->string('address_two');
            $table->string('country');
            $table->string('city');
            $table->string('state');
            $table->string('zipecode');
            $table->string('store_phone');
            $table->string('password');
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
        Schema::dropIfExists('vandors');
    }
}
