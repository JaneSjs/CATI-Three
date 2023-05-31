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
        Schema::create('survey_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->comment('This is an agent who is submitting survey results on behalf of a respondent. It can also be a logged in respondent submitting their own results independently')
                ->constrained();
            $table->foreignId('survey_schema_id')
                ->comment('Foreign Key for the survey schema(Questinnaire in which this results belongs to.)')
                ->constrained('survey_schemas')
                ->cascadeOnDelete();
            $table->ipAddress('ip_address')->nullable();
            $table->macAddress('device_mac_address');
            $table->string('user_agent')->nullable();
            $table->decimal('latitude', 10, 8);
            $table->decimal('longitude', 11, 8);
            $table->json('content');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('survey_results');
    }
};
