<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudAttendTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stud_attend', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lec_id'); // Lecture ID
            $table->unsignedBigInteger('s_id');   // Student ID
            $table->boolean('p_flag');            // Present flag (1 for present, 0 for absent)
            $table->timestamps();

            // Foreign key constraints (optional)
            $table->foreign('lec_id')->references('id')->on('lectures')->onDelete('cascade');
            $table->foreign('s_id')->references('id')->on('students')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stud_attend');
    }
}
