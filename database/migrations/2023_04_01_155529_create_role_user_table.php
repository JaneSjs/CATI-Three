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
        Schema::create('role_user', function (Blueprint $table) {
            $table->comment('User Roles Pivot Table');
            $table->id();
            $table->foreignId('role_id')
                  ->constrained()
                  ->onDelete('cascade');
            $table->index('role_id');

            $table->foreignId('user_id')
                  ->constrained()
                  ->onDelete('cascade');
            $table->index('user_id');
            
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('role_user');
    }
};
