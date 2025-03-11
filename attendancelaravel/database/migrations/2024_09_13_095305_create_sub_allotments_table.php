<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sub_allotments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('course_id');
            $table->foreign('course_id')->references('course_id')->on('courses');
            $table->unsignedBigInteger('sem_id');
            $table->foreign('sem_id')->references('sem_id')->on('semesters');
            $table->unsignedBigInteger('sub_id');
            $table->foreign('sub_id')->references('sub_id')->on('subjects'); 
            $table->unsignedBigInteger('t_id');
            $table->foreign('t_id')->references('t_id')->on('teachers');           
            $table->string('academic_year');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_allotments');
    }
};
