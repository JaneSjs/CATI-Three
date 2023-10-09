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
        Schema::create('quotas', function (Blueprint $table) {
            $table->id();

            $table->foreignId('project_id')
                  ->references('id')
                  ->on('projects')
                  ->constrained()
                  ->cascadeOnDelete();
            $table->index('project_id');

            $table->foreignId('schema_id')
                  ->references('id')
                  ->on('schemas')
                  ->constrained()
                  ->cascadeOnDelete();
            $table->index('schema_id');

            $table->integer('sample_size')->nullable();
            $table->integer('male_target')->nullable();
            $table->integer('female_target')->nullable();
            //Regions
            $table->integer('central_region_target')->nullable();
            $table->integer('coast_region_target')->nullable();
            $table->integer('eastern_region_target')->nullable();
            $table->integer('nairobi_region_target')->nullable();
            $table->integer('north_eastern_region_target')->nullable();
            $table->integer('nyanza_region_target')->nullable();
            $table->integer('rift_valley_region_target')->nullable();
            $table->integer('western_region_target')->nullable();
            //Counties
            $table->integer('baringo_target')->nullable();
            $table->integer('bomet_target')->nullable();
            $table->integer('bungoma_target')->nullable();
            $table->integer('busia_target')->nullable();
            $table->integer('elgeiyo_marakwet_target')->nullable();
            $table->integer('embu_target')->nullable();
            $table->integer('garissa_target')->nullable();
            $table->integer('homa_bay_target')->nullable();
            $table->integer('isiolo_target')->nullable();
            $table->integer('kajiado_target')->nullable();
            $table->integer('kakamega_target')->nullable();
            $table->integer('kericho_target')->nullable();
            $table->integer('kiambu_target')->nullable();
            $table->integer('kilifi_target')->nullable();
            $table->integer('kirinyaga_target')->nullable();
            $table->integer('kisii_target')->nullable();
            $table->integer('kisumu_target')->nullable();
            $table->integer('kitui_target')->nullable();
            $table->integer('kwale_target')->nullable();
            $table->integer('laikipia_target')->nullable();
            $table->integer('lamu_target')->nullable();
            $table->integer('machakos_target')->nullable();
            $table->integer('makueni_target')->nullable();
            $table->integer('mandera_target')->nullable();
            $table->integer('marsabit_target')->nullable();
            $table->integer('meru_target')->nullable();
            $table->integer('migori_target')->nullable();
            $table->integer('mombasa_target')->nullable();
            $table->integer('muranga_target')->nullable();
            $table->integer('nairobi_target')->nullable();
            $table->integer('nakuru_target')->nullable();
            $table->integer('nandi_target')->nullable();
            $table->integer('narok_target')->nullable();
            $table->integer('nyamira_target')->nullable();
            $table->integer('nyandarua_target')->nullable();
            $table->integer('nyeri_target')->nullable();
            $table->integer('samburu_target')->nullable();
            $table->integer('siaya_target')->nullable();
            $table->integer('taita_taveta_target')->nullable();
            $table->integer('tana_river_target')->nullable();
            $table->integer('tharaka_nithi_target')->nullable();
            $table->integer('trans_nzoia_target')->nullable();
            $table->integer('turkana_target')->nullable();
            $table->integer('uasin_gishu_target')->nullable();
            $table->integer('vihiga_target')->nullable();
            $table->integer('wajir_target')->nullable();
            $table->integer('west_pokot_target')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quotas');
    }
};
