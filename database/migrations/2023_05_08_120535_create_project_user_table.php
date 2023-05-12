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
        Schema::create('project_user', function (Blueprint $table) {
            $table->id();

            $table->foreignId('project_id')
                  ->references('id')
                  ->on('projects')
                  ->constrained()
                  ->cascadeOnDelete();

            $table->foreignId('user_id')
                  ->references('id')
                  ->on('users')
                  ->cascadeOnDelete();

            $table->foreignId('manager_id')
                  ->nullable()
                  //->default(1)
                  ->references('id')
                  ->on('users')
                  ->constrained('users', 'id')
                  ->cascadeOnDelete();

            $table->foreignId('scriptor_id')
                  ->nullable()
                  ->references('id')
                  ->on('users')
                  ->constrained('users', 'id')
                  ->cascadeOnDelete();

            $table->foreignId('supervisor_id')
                  ->nullable()
                  ->references('id')
                  ->on('users')
                  ->constrained('users', 'id')
                  ->cascadeOnDelete();

            $table->foreignId('agent_id')
                  ->nullable()
                  ->references('id')
                  ->on('users')
                  ->constrained('users', 'id')
                  ->cascadeOnDelete();

            $table->foreignId('qc_id')
                  ->nullable()
                  ->references('id')
                  ->on('users')
                  ->constrained('users', 'id')
                  ->cascadeOnDelete();

            $table->foreignId('client_id')
                  ->nullable()
                  ->references('id')
                  ->on('users')
                  ->constrained('users', 'id')
                  ->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_user');
    }
};
