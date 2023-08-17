<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('ext_no')->nullable();
            $table->string('email')->unique();
            $table->string('national_id')->nullable()->unique();
            $table->string('phone_1')->nullable()->unique();
            $table->string('phone_2')->nullable();
            $table->string('phone_3')->nullable();
            $table->string('phone_4')->nullable();
            $table->string('gender')->nullable();
            $table->date('dob')->nullable();
            $table->string('occupation')->nullable();
            $table->string('region')->nullable();
            $table->string('county')->nullable();
            $table->string('sub_county')->nullable();
            $table->string('constituency')->nullable();
            $table->string('ward')->nullable();
            $table->string('sampling_point')->nullable();
            $table->string('setting')->nullable();
            $table->string('district')->nullable();
            $table->string('division')->nullable();
            $table->string('location')->nullable();
            $table->string('sub_location')->nullable();
            $table->string('exact_age')->nullable();
            $table->string('education_level')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('religion')->nullable();
            $table->string('income')->nullable();
            $table->string('Lsm')->nullable();
            $table->string('ethnic_group')->nullable();
            $table->string('employment_status')->nullable();
            $table->string('age_group')->nullable();
            $table->dateTime('interview_date_time')->nullable();
            $table->dateTime('interview_status')->nullable();
            $table->string('last_downloaded_date')->nullable();

            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();

            
            
            
            
            
            
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        Schema::dropIfExists('users');

        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
};
