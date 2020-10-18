<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCtuserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ctuser', function (Blueprint $table) {
            $table->increments('Id');
            $table->string('name',200);
            $table->string('username',200);
            $table->string('password',200);
            $table->integer('status',100);
            $table->integer('level',100);
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
        Schema::drop('ctuser');
    }
}
