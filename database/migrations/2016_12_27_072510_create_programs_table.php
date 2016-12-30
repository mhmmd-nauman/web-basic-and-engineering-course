<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProgramsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('programs_offered', function (Blueprint $table) {
            $table->increments('id');
            $table->string('program_name')->nullable();
            $table->string('duration')->nullable();
            $table->string('code')->nullable();
            $table->integer('incharge_id')->unsigned();
            $table->foreign('incharge_id')->references('id')->on('users');
            $table->integer('department_id')->unsigned();
           // $table->foreign('visitor_id')->references('id')->on('departments');
            $table->enum('status', ['Active','Disabled'])->nullable();
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
        Schema::drop('programs_offered');
    }
}
