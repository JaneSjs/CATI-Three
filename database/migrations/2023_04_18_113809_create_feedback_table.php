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
        Schema::create('feedback', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                  ->references('id')
                  ->on('users')
                  ->cascadeOnDelete();

            $table->foreignId('interview_id')
                  ->references('id')
                  ->on('interviews')
                  ->cascadeOnDelete();
                  
            $table->unsignedBigInteger('respondent_id')
                  ->nullable();
            $table->foreign('respondent_id')->references('id')->on('respondents');

            $table->text('interviewer_feedback')->nullable();
            $table->text('respondent_feedback')->nullable();
            $table->text('qc_feedback')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('feedback');
    }
};
