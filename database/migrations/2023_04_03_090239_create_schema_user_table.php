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
        Schema::create('schema_user', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('schema_id')
                ->references('id')
                ->on('schemas');
            $table->index('schema_id');

            $table->foreignId('user_id')
                ->references('id')
                ->on('users');
            $table->index('user_id');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schema_user');
    }
};
