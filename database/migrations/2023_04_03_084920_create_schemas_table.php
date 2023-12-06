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
        Schema::create('schemas', function (Blueprint $table) {
            $table->id();

            $table->foreignId('project_id')
                  ->references('id')
                  ->on('projects')
                  ->constrained()
                  ->cascadeOnDelete();
            $table->index('project_id');

            $table->string('survey_name');
            $table->json('content')->nullable();
            $table->string('version')->nullable();
            $table->string('stage')->nullable();
            $table->string('iframe_url')->nullable();

            $table->string('type')->nullable();
            $table->string('database')->nullable();
            $table->string('dpia')->nullable();
            
            $table->string('updated_by')->nullable();
            $table->string('deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schemas');
    }
};
