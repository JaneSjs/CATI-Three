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
        Schema::create('interview_schedules', function (Blueprint $table) {
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
                  ->constrained();

            $table->foreignId('interview_id')
                  ->references('id')
                  ->on('interviews')
                  ->constrained();

            $table->dateTime('interview_datetime');
            $table->string('interview_url');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('interview_schedules');
    }
};
