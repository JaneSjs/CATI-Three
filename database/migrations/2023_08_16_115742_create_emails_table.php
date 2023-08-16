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
        Schema::create('emails', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('project_id')
                  ->nullable();

            $table->foreign('project_id')->references('id')->on('projects');

            $table->unsignedBigInteger('schema_id')
                  ->nullable();
            $table->foreign('schema_id')->references('id')->on('schemas');

            $table->string('to');
            $table->string('tags')->nullable();
            $table->string('metadata')->nullable();
            $table->text('subject')->nullable();
            $table->text('content')->nullable();
            $table->dateTimeTz('sent_at')->nullable();
            $table->text('delivery_status')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('emails');
    }
};
