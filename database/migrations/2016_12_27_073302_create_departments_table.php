<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDepartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('department', function (Blueprint $table) {
            $table->increments('id');
            $table->string('department_name')->nullable();
            $table->string('contact')->nullable();
            $table->enum('status', ['Active','Disabled'])->nullable();
            $table->integer('hod_id')->unsigned();
            $table->foreign('hod_id')->references('id')->on('users');
            $table->integer('entered_id')->unsigned();
            $table->foreign('entered_id')->references('id')->on('users');
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
        //
        Schema::drop('department');
    }
}
