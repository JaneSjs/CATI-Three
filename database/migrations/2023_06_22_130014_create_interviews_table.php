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
        Schema::create('interviews', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                  ->references('id')
                  ->on('users')
                  ->constrained();

            $table->foreignId('project_id')
                  ->references('id')
                  ->on('projects')
                  ->constrained()
                  ->cascadeOnDelete();

            $table->foreignId('schema_id')
                  ->references('id')
                  ->on('schemas')
                  ->constrained()
                  ->cascadeOnDelete();

            $table->foreignId('respondent_id')
                  ->nullable()
                  ->references('id')
                  ->on('respondents')
                  ->constrained();

            $table->string('respondent_name')->nullable();
            $table->string('ext_no')->nullable();
            $table->string('phone_called')->nullable();
            $table->string('audio_recording')->nullable();
            
            $table->boolean('qcd')->nullable();
            $table->boolean('survey_complete')->nullable();
            $table->boolean('approved')->nullable();
            $table->dateTimeTz('start_time')->nullable();
            $table->dateTimeTz('end_time')->nullable();
            $table->text('feedback')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('interviews');
    }
};
