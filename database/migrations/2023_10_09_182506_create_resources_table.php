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
        Schema::create('resources', function (Blueprint $table) {
            $table->id();
            $table->string('workstations');
            $table->string('working_computers');
            $table->string('faulty_computers');
            $table->string('working_monitors');
            $table->string('faulty_monitors');
            $table->string('working_mouse');
            $table->string('faulty_mouse');
            $table->string('working_keyboards');
            $table->string('faulty_keyboards');
            $table->string('working_internet_ports');
            $table->string('faulty_internet_ports');

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
        Schema::dropIfExists('resources');
    }
};
