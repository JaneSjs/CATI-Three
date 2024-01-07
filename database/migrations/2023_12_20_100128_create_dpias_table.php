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
        Schema::create('dpias', function (Blueprint $table) {
            $table->id();

            $table->foreignId('project_id')
                  ->references('id')
                  ->on('projects')
                  ->constrained();
            $table->foreignId('schema_id')
                  ->nullable()
                  ->references('id')
                  ->on('projects')
                  ->constrained();
            $table->foreignId('user_id')
                  ->references('id')
                  ->on('users')
                  ->constrained();

            $table->string('dpia_approval');
            $table->string('dpia_document');
            $table->string('dpa_training_document');
            $table->string('dpa_controller_agreement_document');
            $table->string('extra_dpa_document_1');
            $table->string('extra_dpa_document_2');
            $table->string('extra_dpa_document_3');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dpias');
    }
};
