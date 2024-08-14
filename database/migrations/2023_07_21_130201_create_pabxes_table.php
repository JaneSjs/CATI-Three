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
        Schema::create('pabxes', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->comment('Caller/Interviewer');
            $table->bigInteger('project_id')->nullable();
            $table->bigInteger('schema_id')->nullable();
            $table->bigInteger('respondent_id')->nullable();
            $table->string('phone_called');
            $table->string('file_path');

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
        Schema::dropIfExists('pabxes');
    }
};
