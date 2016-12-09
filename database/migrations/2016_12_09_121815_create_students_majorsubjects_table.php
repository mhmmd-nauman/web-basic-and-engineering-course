<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsMajorsubjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('students_previous_major_subjects', function (Blueprint $table) {
            $table->increments('id');
            $table->string('subject_name')->nullable();
            $table->enum('subject_type', ['undergraduate', 'graduate']);
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
        Schema::drop('students_previous_major_subjects');
    }
}
