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
        Schema::create('survey_result_survey_schema', function (Blueprint $table) {
            $table->id();

            $table->foreignId('survey_schema_id')
                  ->references('id')
                  ->on('survey_schemas')
                  ->constrained()
                  ->cascadeOnDelete();

            $table->foreignId('user_id')
                  ->references('id')
                  ->on('users')
                  ->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('survey_schema_survey_result');
    }
};
