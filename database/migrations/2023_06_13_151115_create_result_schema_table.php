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
        Schema::create('result_schema', function (Blueprint $table) {
            $table->id();

            $table->foreignId('result_id')
                  ->references('id')
                  ->on('results')
                  ->cascadeOnDelete();

            $table->foreignId('schema_id')
                  ->references('id')
                  ->on('schemas')
                  ->constrained()
                  ->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('result_schema');
    }
};
