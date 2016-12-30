<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsEducationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('students_education', function (Blueprint $table) {
            $table->increments('id');
            $table->string('institution_name')->nullable();
            $table->string('location')->nullable();
            $table->date('date_of_entering')->nullable();
            $table->date('date_of_leaving')->nullable();
            $table->string('degree_receive')->nullable();
            $table->string('grade')->nullable();
            $table->integer('student_id'); // 
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
        Schema::drop('students_education');
    }
}
