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
        Schema::create('lectures', function (Blueprint $table) {
            $table->id(); 
            $table->date('lec_date'); 
            $table->unsignedBigInteger('course_id');
            $table->foreign('course_id')->references('course_id')->on('courses');
            $table->unsignedBigInteger('sem_id');
            $table->foreign('sem_id')->references('sem_id')->on('semesters');
            $table->unsignedBigInteger('sub_id');
            $table->foreign('sub_id')->references('sub_id')->on('subjects');   
            $table->string('lec_topic');
            $table->string('lec_method');
            $table->integer('lec_no'); 
            $table->enum('proxy_status', ['Proxy', 'Own']);
            $table->unsignedBigInteger('t_id');
            $table->foreign('t_id')->references('id')->on('teachers');  
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lectures');
    }
};
