<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVisitorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('visitors', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('visit_type', ['Call', 'Visit']);
            $table->string('program')->nullable();
            $table->integer('program_id')->nullable();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('information_source')->nullable();
            $table->string('mobile')->nullable();
            $table->enum('status', ['Info','Accepted','Rejected'])->nullable();
            $table->integer('dealtby_id')->unsigned();
            $table->foreign('dealtby_id')->references('id')->on('users');
            $table->string('dealt_by')->nullable();
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
        Schema::drop('visitors');
    }
}
