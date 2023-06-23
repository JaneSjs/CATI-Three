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

            $table->foreignId('schema_id')
                  ->references('id')
                  ->on('schemas')
                  ->constrained()
                  ->cascadeOnDelete();

            $table->json('content');
            
            $table->string('ext_no')->nullable();
            $table->string('phone_number')->nullable();
            $table->boolean('qcd')->nullable();
            $table->boolean('approved')->nullable();
            $table->dateTimeTz('start_time')->nullable();
            $table->dateTimeTz('end_time')->nullable();
            $table->text('feedback')->nullable();

            $table->ipAddress('ip_address')->nullable();
            $table->macAddress('mac_address')->nullable();
            $table->string('user_agent')->nullable();
            $table->decimal('latitude', 10, 8);
            $table->decimal('longitude', 11, 8);
            $table->string('altitude')->nullable();
            $table->string('altitude_accuracy')->nullable();
            $table->string('position_accuracy')->nullable();
            $table->string('heading')->nullable();
            $table->string('speed')->nullable();
            $table->bigInteger('timestamp')->nullable();

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
