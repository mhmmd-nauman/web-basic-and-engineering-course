<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsLanguageRatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('students_language_ratings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('language_name')->nullable();
            $table->enum('reading', ['E', 'G','F','P'])->nullable();
            $table->enum('writing', ['E', 'G','F','P'])->nullable();
            $table->enum('speaking', ['E', 'G','F','P'])->nullable();
            $table->enum('listening', ['E', 'G','F','P'])->nullable();
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
        Schema::drop('students_language_ratings');
    }
}
