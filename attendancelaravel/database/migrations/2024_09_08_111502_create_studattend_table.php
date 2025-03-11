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
        Schema::create('studattend', function (Blueprint $table) {
            $table->id('sta_id');
            $table->unsignedBigInteger('id');
            $table->foreign('id')->references('id')->on('sub_allotments'); 
            $table->string('p_flag');  
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('studattend');
    }
};
