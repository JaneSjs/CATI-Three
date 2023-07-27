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
        Schema::create('quotas', function (Blueprint $table) {
            $table->id();

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

            $table->string('occupation')->nullable();
            $table->string('region')->nullable();
            $table->string('county')->nullable();
            $table->string('sub_county')->nullable();
            $table->string('district')->nullable();
            $table->string('division')->nullable();
            $table->string('location')->nullable();
            $table->string('sub_location')->nullable();
            $table->string('constituency')->nullable();
            $table->string('ward')->nullable();
            $table->string('sampling_point')->nullable();
            $table->string('setting')->nullable();
            $table->string('gender')->nullable();
            $table->string('exact_age')->nullable();
            $table->string('education_level')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('religion')->nullable();
            $table->string('income')->nullable();
            $table->string('Lsm')->nullable();
            $table->string('ethnic_group')->nullable();
            $table->string('employment_status')->nullable();
            $table->string('age_group')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quotas');
    }
};
