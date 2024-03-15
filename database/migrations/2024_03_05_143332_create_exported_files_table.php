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
        Schema::create('exported_files', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                  ->nullable()
                  ->references('id')
                  ->on('users')
                  ->constrained();
            $table->foreignId('project_id')
                  ->nullable()
                  ->references('id')
                  ->on('projects')
                  ->constrained();
            $table->foreignId('schema_id')
                  ->nullable()
                  ->references('id')
                  ->on('schemas')
                  ->constrained();
            $table->string('file_name');
            $table->string('file_size');
            $table->string('file_type');
            $table->string('file_path');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exported_files');
    }
};
