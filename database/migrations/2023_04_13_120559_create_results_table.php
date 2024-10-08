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
        Schema::create('results', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                  ->references('id')
                  ->on('users')
                  ->cascadeOnDelete();
            $table->index('user_id');

            $table->foreignId('schema_id')
                  ->references('id')
                  ->on('schemas')
                  ->constrained()
                  ->cascadeOnDelete();
            $table->index('schema_id');

            $table->foreignId('interview_id')
                  ->nullable()
                  ->references('id')
                  ->on('interviews')
                  ->constrained()
                  ->cascadeOnDelete();
            $table->index('interview_id');

            $table->foreignId('interview_schedule_id')
                  ->nullable()
                  ->references('id')
                  ->on('interview_schedules')
                  ->constrained();

            $table->json('content');
            
            $table->ipAddress('ip_address')->nullable();
            $table->macAddress('mac_address')->nullable();
            $table->string('user_agent')->nullable();
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->string('altitude')->nullable();
            $table->string('altitude_accuracy')->nullable();
            $table->string('position_accuracy')->nullable();
            $table->string('heading')->nullable();
            $table->string('speed')->nullable();
            $table->bigInteger('timestamp')->nullable();

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
        Schema::dropIfExists('results');
    }
};
