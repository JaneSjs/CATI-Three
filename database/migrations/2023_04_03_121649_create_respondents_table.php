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
        Schema::create('respondents', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('r_id')->nullable();
            $table->bigInteger('project_id')->nullable();
            $table->bigInteger('schema_id')->nullable();
            $table->string('name');
            $table->string('phone_1')->unique();
            $table->string('phone_2')->nullable();
            $table->string('phone_3')->nullable();
            $table->string('phone_4')->nullable();
            $table->string('national_id')->nullable()->unique();
            $table->string('email')->nullable()->unique();
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
            $table->date('dob')->nullable();
            $table->string('exact_age')->nullable();
            $table->string('education_level')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('religion')->nullable();
            $table->string('income')->nullable();
            $table->string('Lsm')->nullable();
            $table->string('ethnic_group')->nullable();
            $table->string('employment_status')->nullable();
            $table->string('age_group')->nullable();
            $table->string('interview_status')->nullable();
            $table->text('feedback')->nullable();
            $table->dateTime('interview_date_time')->nullable();
            $table->string('last_downloaded_date')->nullable();
            $table->string('updated_by')->nullable();
            $table->string('deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletes($column = 'deleted_at');

            $table->index('name');
            $table->index('phone_1');
            $table->index('phone_2');
            $table->index('phone_3');
            $table->index('phone_4');
            $table->index('national_id');
            $table->index('occupation');
            $table->index('region');
            $table->index('county');
            $table->index('constituency');
            $table->index('ward');
            $table->index('setting');
            $table->index('gender');
            $table->index('dob');
            $table->index('exact_age');
            $table->index('education_level');
            $table->index('marital_status');
            $table->index('religion');
            $table->index('income');
            $table->index('Lsm');
            $table->index('ethnic_group');
            $table->index('employment_status');
            $table->index('age_group');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('respondents');
    }
};
