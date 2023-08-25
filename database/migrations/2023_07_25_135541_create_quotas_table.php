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

            $table->foreignId('schema_id')
                  ->references('id')
                  ->on('schemas')
                  ->constrained()
                  ->cascadeOnDelete();

            $table->integer('total_target')->nullable();
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


            // Counties And Their Sub Counties

            $table->integer('baringo_county_target')->nullable();
            // Baringo sub counties
            $table->integer('baringo_central_sub_county_target')->nullable();
            // Baringo central wards
            $table->integer('ewalel_chapchap_ward_target')->nullable();
            $table->integer('kabarnet_ward_target')->nullable();
            $table->integer('kapropita_ward_target')->nullable();      
            $table->integer('sacho_ward_target')->nullable();
            $table->integer('tenges_ward_target')->nullable();

            $table->integer('baringo_north_sub_county_target')->nullable();
            // Baringo north wards
            $table->integer('bartabwa_ward_target')->nullable();
            $table->integer('barwesa_ward_target')->nullable();
            $table->integer('kabartonjo_ward_target')->nullable();
            $table->integer('saimo_kipsaraman_ward_target')->nullable();
            $table->integer('saimo_soi_ward_target')->nullable();

            $table->integer('baringo_south_sub_county_target')->nullable();
            // Baringo south wards
            $table->integer('iichamas_ward_target')->nullable();
            $table->integer('marigat_ward_target')->nullable();
            $table->integer('mochongoi_ward_target')->nullable();
            $table->integer('mukutani_ward_target')->nullable();

            $table->integer('eldama_ravine_sub_county_target')->nullable();
            // Eldama ravine wards
            $table->integer('koibatek_ward_target')->nullable();
            $table->integer('lembus_kwen_ward_target')->nullable();
            $table->integer('lembus_perkerra_ward_target')->nullable();
            $table->integer('lembus_ward_target')->nullable();
            $table->integer('mumberes_maji_mazuri_ward_target')->nullable();
            $table->integer('ravine_ward_target')->nullable();

            $table->integer('mogotio_sub_county_target')->nullable();
            // Mogotio wards
            $table->integer('emining_ward_target')->nullable();
            $table->integer('kisanana_ward_target')->nullable();
            $table->integer('mogotio_ward_target')->nullable();

            $table->integer('tiaty_sub_county_target')->nullable();
            // Tiaty wards
            $table->integer('churo_amaya_ward_target')->nullable();
            $table->integer('kololwa_ward_target')->nullable();
            $table->integer('loiyamorok_ward_target')->nullable();
            $table->integer('tangulbei_korossi_ward_target')->nullable();
            $table->integer('tirioko_ward_target')->nullable();
            $table->integer('ribkwo_ward_target')->nullable();
            $table->integer('silale_ward_target')->nullable();     



            $table->integer('bomet_county_target')->nullable();
           // Bomet sub counties
            $table->integer('bomet_central_sub_county_target')->nullable();
            // Bomet central wards
            $table->integer('chesoen_ward_target')->nullable();
            $table->integer('mutarakwa_ward_target')->nullable();
            $table->integer('ndarawetta_ward_target')->nullable();
            $table->integer('silibwet_ward_target')->nullable();
            $table->integer('singorwet_ward_target')->nullable();           
            $table->integer('bomet_east_sub_county_target')->nullable();
            // Bomet east wards
            $table->integer('chemaner_ward_target')->nullable();
            $table->integer('kembu_ward_target')->nullable();
            $table->integer('kipreres_ward_target')->nullable();
            $table->integer('longisa_ward_target')->nullable();
            $table->integer('merigi_ward_target')->nullable();

            $table->integer('chepalungu_sub_county_target')->nullable();
            // Chepalungu wards
            $table->integer('chebunyo_ward_target')->nullable();
            $table->integer('kongasis_ward_target')->nullable();
            $table->integer('nyongores_ward_target')->nullable();
            $table->integer('sigor_ward_target')->nullable();
            $table->integer('siongiroi_ward_target')->nullable();

            $table->integer('konoin_sub_county_target')->nullable();
            // Konoin wards
            $table->integer('boito_ward_target')->nullable();
            $table->integer('chepchabas_ward_target')->nullable();
            $table->integer('embomos_ward_target')->nullable();
            $table->integer('kimulot_rongena_ward_target')->nullable();
            $table->integer('mogogosiek_abosi_ward_target')->nullable();
            
            $table->integer('sotik_sub_county_target')->nullable();
            // Sotik wards
            $table->integer('chemagel_ward_target')->nullable();
            $table->integer('kapletundo_ward_target')->nullable();
            $table->integer('kipsonoi_ward_target')->nullable();
            $table->integer('manaret_rongena_ward_target')->nullable();
            $table->integer('ndanai_abosi_ward_target')->nullable();



            $table->integer('bungoma_county_target')->nullable();
            //bungoma sub counties
            $table->integer('bumula_sub_county_target')->nullable();
            // Bumula wards
            $table->integer('bumula_ward_target')->nullable();
            $table->integer('kabula_ward_target')->nullable();
            $table->integer('khasoko_ward_target')->nullable();
            $table->integer('kimaeti_rongena_ward_target')->nullable();
            $table->integer('siboti_ward_target')->nullable();
            $table->integer('south_bukusu_ward_target')->nullable();
            $table->integer('west_bukusu_ward_target')->nullable();

            $table->integer('kabuchai_sub_county_target')->nullable();
            // Kabuchai wards
            $table->integer('bwake_luuya_ward_target')->nullable();
            $table->integer('kabuchai_chwele_ward_target')->nullable();
            $table->integer('mukuyuni_ward_target')->nullable();
            $table->integer('west_nalondo_ward_target')->nullable();

            $table->integer('kanduyi_sub_county_target')->nullable();
            // Kanduyi wards
            $table->integer('bukembe_east_ward_target')->nullable();
            $table->integer('bukembe_west_ward_target')->nullable();
            $table->integer('east_sangalo_ward_target')->nullable();
            $table->integer('khalaba_ward_target')->nullable();
            $table->integer('musikoma_ward_target')->nullable();
            $table->integer('township_ward_target')->nullable();
            $table->integer('tuuti_marakaru_ward_target')->nullable();
            $table->integer('west_sangalo_ward_target')->nullable();

            $table->integer('kimilili_sub_county_target')->nullable();
            // Kimilili wards
            $table->integer('kamukuywa_ward_target')->nullable();
            $table->integer('kibingei_ward_target')->nullable();
            $table->integer('kimilili_ward_target')->nullable();
            $table->integer('maeni_ward_target')->nullable();

            $table->integer('mt_elgon_sub_county_target')->nullable();
            // Mt Elgon wards
            $table->integer('chepyuk_ward_target')->nullable();
            $table->integer('chesikaki_ward_target')->nullable();
            $table->integer('cheptais_ward_target')->nullable();
            $table->integer('elgon_ward_target')->nullable();
            $table->integer('kapkateny_ward_target')->nullable();
            $table->integer('kaptama_ward_target')->nullable();

            $table->integer('sirisia_sub_county_target')->nullable();
            // Sirisia wards
            $table->integer('lwandanyi_ward_target')->nullable();
            $table->integer('malakisi_south_kilisiru_ward_target')->nullable();
            $table->integer('namwela_ward_target')->nullable();

            $table->integer('tongaren_sub_county_target')->nullable();
            // Tongaren wards
            $table->integer('mbakalo_ward_target')->nullable();
            $table->integer('milima_ward_target')->nullable();
            $table->integer('naitiri_kabuyefwe_ward_target')->nullable();
            $table->integer('ndalu_ward_target')->nullable();
            $table->integer('soysambu_mitumwa_ward_target')->nullable();
            $table->integer('tongaren_ward_target')->nullable();

            $table->integer('webuye_east_sub_county_target')->nullable();
            // Webuye east wards
            $table->integer('maraka_ward_target')->nullable();
            $table->integer('mihuu_ward_target')->nullable();
            $table->integer('ndivisi_ward_target')->nullable();

            $table->integer('webuye_west_sub_county_target')->nullable();
            // Webuye west wards
            $table->integer('bokoli_ward_target')->nullable();
            $table->integer('matulo_ward_target')->nullable();
            $table->integer('misikhu_ward_target')->nullable();
            $table->integer('sitikho_ward_target')->nullable();



            $table->integer('busia_county_target')->nullable();
            // Busia sub counties
            $table->integer('bunyala_sub_county_target')->nullable();
            // Bunyala wards
            $table->integer('bunyala_central_ward_target')->nullable();
            $table->integer('bunyala_north_ward_target')->nullable();
            $table->integer('bunyala_west_ward_target')->nullable();
            $table->integer('bunyala_south_ward_target')->nullable();

            $table->integer('butula_sub_county_target')->nullable();
            //butula wards
            $table->integer('elugulu_ward_target')->nullable();
            $table->integer('kingandole_north_ward_target')->nullable();
            $table->integer('marachi_central_ward_target')->nullable();
            $table->integer('marachi_east_ward_target')->nullable();
            $table->integer('marachi_north_ward_target')->nullable();
            $table->integer('marachi_west_ward_target')->nullable()

            $table->integer('matayos_sub_county_target')->nullable();
            // Matayos wards
            $table->integer('bukhayo_west_ward_target')->nullable();
            $table->integer('burumba_ward_target')->nullable();
            $table->integer('busibwabo_ward_target')->nullable();
            $table->integer('matayos_south_ward_target')->nullable();
            $table->integer('mayenje_ward_target')->nullable();

            $table->integer('nambale_sub_county_target')->nullable();
            //Nambale wards
            $table->integer('bukhayo_central_ward_target')->nullable();
            $table->integer('bukhayo_east_ward_target')->nullable();
            $table->integer('bukhayo_north_ward_target')->nullable();
            $table->integer('nambale_township_ward_target')->nullable();

            $table->integer('samia_sub_county_target')->nullable();
            // Samia wards
            $table->integer('angega_nanguba_ward_target')->nullable();
            $table->integer('bwiri_ward_target')->nullable();
            $table->integer('namboboto_nambaku_ward_target')->nullable();
            $table->integer('nangina_ward_target')->nullable();

            $table->integer('teso_north_sub_county_target')->nullable();
            // Teso north wards
            $table->integer('angurai_east_ward_target')->nullable();
            $table->integer('angurai_north_ward_target')->nullable();
            $table->integer('angurai_south_ward_target')->nullable();
            $table->integer('malaba_central_ward_target')->nullable();
            $table->integer('malaba_north_ward_target')->nullable();
            $table->integer('malaba_south_ward_target')->nullable();

            $table->integer('teso_south_sub_county_target')->nullable();
            // Teso south wards
            $table->integer('amukura_central_ward_target')->nullable();
            $table->integer('amukura_east_ward_target')->nullable();
            $table->integer('amukura_west_ward_target')->nullable();
            $table->integer('angorom_central_ward_target')->nullable();
            $table->integer('chakol_north_ward_target')->nullable();
            $table->integer('chakol_south_ward_target')->nullable()



            $table->integer('elgeiyo_marakwet_county_target')->nullable();
            // elgeiyo marakwet sub counties
            $table->integer('keiyo_north_sub_county_target')->nullable();
            // Keiyo north wards
            $table->integer('emsoo_ward_target')->nullable();
            $table->integer('kamaminy_ward_target')->nullable();
            $table->integer('kapchemutwa_ward_target')->nullable();
            $table->integer('tambach_ward_target')->nullable();

            $table->integer('keiyo_south_sub_county_target')->nullable();
            //keiyo south wards
            $table->integer('chepkorio_ward_target')->nullable();
            $table->integer('kabmemit_ward_target')->nullable();
            $table->integer('kapatarkkwa_ward_target')->nullable();
            $table->integer('metkei_ward_target')->nullable();
            $table->integer('soy_north_ward_target')->nullable();
            $table->integer('soy_south_ward_target')->nullable();           
            $table->integer('marakwet_east_sub_county_target')->nullable();
            // Marakwet east wards
            $table->integer('embobut_embolot_ward_target')->nullable();
            $table->integer('endo_ward_target')->nullable();
            $table->integer('kapyego_ward_target')->nullable();
            $table->integer('sambirir_ward_target')->nullable();

            $table->integer('marakwet_west_sub_county_target')->nullable();
            // Marakwet west wards
            $table->integer('aoror_ward_target')->nullable();
            $table->integer('cherangany_chebororwa_ward_target')->nullable();
            $table->integer('kapsowar_ward_target')->nullable();
            $table->integer('lelan_ward_target')->nullable();
            $table->integer('moiben_kuserwo_ward_target')->nullable();
            $table->integer('sengwer_ward_target')->nullable();



            $table->integer('embu_county_target')->nullable();
            //Embu sub counties
            $table->integer('manyatta_sub_county_target')->nullable();
            // Manyatta wards
            $table->integer('gaturi_south_ward_target')->nullable();
            $table->integer('kithimu_ward_target')->nullable();
            $table->integer('kirimari_ward_target')->nullable();
            $table->integer('mbeti_north_ward_target')->nullable();
            $table->integer('nginda_ward_target')->nullable();
            $table->integer('runguri_ngandori_ward_target')->nullable();

            $table->integer('mbeere_north_sub_county_target')->nullable();
            // Mbeere north wards
            $table->integer('evurore_ward_target')->nullable();
            $table->integer('muminji_ward_target')->nullable();
            $table->integer('nthawa_ward_target')->nullable();

            $table->integer('mbeere_south_sub_county_target')->nullable();
            // Mbeere south wards
            $table->integer('kiambere_ward_target')->nullable();
            $table->integer('mbeti_south_ward_target')->nullable();
            $table->integer('makima_ward_target')->nullable();
            $table->integer('mwea_ward_target')->nullable();
            $table->integer('makima_ward_target')->nullable();

            $table->integer('runyenjes_sub_county_target')->nullable();
            // Runyenjes wards
            $table->integer('central_ward_target')->nullable();
            $table->integer('gaturi_north_ward_target')->nullable();
            $table->integer('kaagari_north_ward_target')->nullable();
            $table->integer('kaagari_south_ward_target')->nullable();
            $table->integer('kyeni_north_ward_target')->nullable();
            $table->integer('kyeni_south_ward_target')->nullable();



            $table->integer('garissa_county_target')->nullable();
            // Garissa sub counties
            $table->integer('balambala_sub_county_target')->nullable();
            // Balambala wards
            $table->integer('balambala_ward_target')->nullable();
            $table->integer('danyere_ward_target')->nullable();
            $table->integer('jarajara_ward_target')->nullable();
            $table->integer('saka_ward_target')->nullable();
            $table->integer('sankuri_ward_target')->nullable();

            $table->integer('dadaab_sub_county_target')->nullable();
            // Daadab wards
            $table->integer('abakaile_ward_target')->nullable();
            $table->integer('dadaab_ward_target')->nullable();
            $table->integer('damajale_ward_target')->nullable();
            $table->integer('dertu_ward_target')->nullable();
            $table->integer('labasigale_ward_target')->nullable();
            $table->integer('liboi_ward_target')->nullable();

            $table->integer('dujis_sub_county_target')->nullable();
            // Dujis wards
            $table->integer('galbet_ward_target')->nullable();
            $table->integer('iftin_ward_target')->nullable();
            $table->integer('township_ward_target')->nullable();
            $table->integer('waberi_ward_target')->nullable();

            $table->integer('fafi_sub_county_target')->nullable();
            //Fafi wards
            $table->integer('bura_ward_target')->nullable();
            $table->integer('dekaharia_ward_target')->nullable();
            $table->integer('jarajila_ward_target')->nullable();
            $table->integer('fafi_ward_target')->nullable();
            $table->integer('nanighi_ward_target')->nullable();

            $table->integer('ijara_sub_county_target')->nullable();
            // Ijara wards
            $table->integer('ijara_ward_target')->nullable();
            $table->integer('hulugho_ward_target')->nullable();
            $table->integer('masalani_ward_target')->nullable();
            $table->integer('sangailu_ward_target')->nullable();
            
            $table->integer('lagdera_sub_county_target')->nullable();
            // Lagdera wards
            $table->integer('baraki_ward_target')->nullable();
            $table->integer('bename_ward_target')->nullable();
            $table->integer('goreale_ward_target')->nullable();
            $table->integer('maalamin_ward_target')->nullable();
            $table->integer('modogashe_ward_target')->nullable();
            $table->integer('sabena_ward_target')->nullable();



            $table->integer('homa_bay_county_target')->nullable();
            // Homa bay sub counties
            $table->integer('homa_bay_sub_county_target')->nullable();
            // Homa bay wards
            $table->integer('homa_bay_arujo_ward_target')->nullable();
            $table->integer('homa_baycentral_ward_target')->nullable();
            $table->integer('homa_bay_east_ward_target')->nullable();
            $table->integer('homa_bay_west_ward_target')->nullable();

            $table->integer('kabondo_kasipul_sub_county_target')->nullable();
            // Kabondo kasipul wards
            $table->integer('kabondo_east_ward_target')->nullable();
            $table->integer('kabndo_west_ward_target')->nullable();
            $table->integer('kokwanyo_kakel_ward_target')->nullable();
            $table->integer('o_kojwach_ward_target')->nullable();

            $table->integer('karachuonyo_sub_county_target')->nullable();
            // Karachuonyo wards
            $table->integer('central_kanyaulo_ward_target')->nullable();
            $table->integer('kendu_bay_ward_target')->nullable();
            $table->integer('kibiri_ward_target')->nullable();
            $table->integer('north_karachuonyo_ward_target')->nullable();
            $table->integer('town_ward_target')->nullable();
            $table->integer('wangchieng_ward_target')->nullable();
            $table->integer('west_karachuonyo_ward_target')->nullable();

            $table->integer('kasipul_sub_county_target')->nullable();
            // Kasipul wards
            $table->integer('central_kasipul_ward_target')->nullable();
            $table->integer('east_kamagak_ward_target')->nullable();
            $table->integer('south_kasipul_ward_target')->nullable();
            $table->integer('west_kamagak_ward_target')->nullable();
            $table->integer('west_kasipul_ward_target')->nullable();

            $table->integer('ndhiwa_sub_county_target')->nullable();
            //Mbita wards
            $table->integer('kabuoch_north_ward_target')->nullable();
            $table->integer('kabuoch_south_pala_ward_target')->nullable();
            $table->integer('kanyadoto_ward_target')->nullable();
            $table->integer('kanyamwa_kologi_ward_target')->nullable();
            $table->integer('kanyamwa_kosewe_ward_target')->nullable();
            $table->integer('kanyikela_ward_target')->nullable();
            $table->integer('kwabwai_ward_target')->nullable();

            $table->integer('rangwe_sub_county_target')->nullable();
            //Rangwe wards
            $table->integer('east_gem_ward_target')->nullable();
            $table->integer('kagan_ward_target')->nullable();
            $table->integer('kochia_ward_target')->nullable();
            $table->integer('west_gem_ward_target')->nullable();

            $table->integer('suba_north_sub_county_target')->nullable();
            // Suba north wards
            $table->integer('gember_ward_target')->nullable();
            $table->integer('lambwe_ward_target')->nullable();
            $table->integer('kasgunga_ward_target')->nullable();
            $table->integer('mfangano_island_ward_target')->nullable();
            $table->integer('rusinga_island_ward_target')->nullable();

            $table->integer('suba_south_su_county_target')->nullable();
            // Suba South wards
            $table->integer('gwassi_north_ward_target')->nullable();
            $table->integer('gwassi_south_ward_target')->nullable();
            $table->integer('kaksingri_west_ward_target')->nullable();
            $table->integer('ruma_kaksingri_east_ward_target')->nullable();



            $table->integer('isiolo_county_target')->nullable();
            // Isiolo sub counties
            $table->integer('garbatulla_sub_county_target')->nullable();
            //Garbatulla wards
            $table->integer('garbatulla_ward_target')->nullable();
            $table->integer('kinna_ward_target')->nullable();
            $table->integer('sericho_ward_target')->nullable()

            $table->integer('isiolo_sub_county_target')->nullable();
            // Isiolo wards
            $table->integer('bulla_pesa_ward_target')->nullable();
            $table->integer('burat_ward_target')->nullable();
            $table->integer('ngaremara_ward_target')->nullable()
            $table->integer('oldonyiro_ward_target')->nullable();
            $table->integer('wabera_ward_target')->nullable();

            $table->integer('merti_sub_county_target')->nullable();
            // Merti wards
            $table->integer('cherab_ward_target')->nullable();
            $table->integer('chari_ward_target')->nullable();



            $table->integer('kajiado_county_target')->nullable();
            //kajiado sub county
            $table->integer('kajiado_central_sub_county_target')->nullable();
            //kajiado central wards
            $table->integer('dalalekutuk_ward_target')->nullable();
            $table->integer('ildamat_ward_target')->nullable();
            $table->integer('matapato_north_ward_target')->nullable();
            $table->integer('matapato_south_ward_target')->nullable();
            $table->integer('purko_ward_target')->nullable();

            $table->integer('kajiado_east_sub_county_target')->nullable();
            //kajiando east wards
            $table->integer('imaroro_ward_target')->nullable();
            $table->integer('kaputiei_north_ward_target')->nullable();
            $table->integer('kenyawa_poka_ward_target')->nullable();
            $table->integer('kitengela_ward_target')->nullable();
            $table->integer('oloosirkon_sholinke_ward_target')->nullable();

            $table->integer('kajiado_north_sub_county_target')->nullable();
            // kajiado west wards
            $table->integer('ngong_ward_target')->nullable();
            $table->integer('nkaimurunya_ward_target')->nullable();
            $table->integer('ongata_rongai_ward_target')->nullable();
            $table->integer('olkeri_ward_target')->nullable();
            $table->integer('oloolua_ward_target')->nullable();

            $table->integer('kajiado_south_sub_county_target')->nullable();
            // Kajiado south wards
            $table->integer('entonet_lenkisi_ward_target')->nullable();
            $table->integer('keikuku_ward_target')->nullable();   
            $table->integer('kimana_ward_target')->nullable();
            $table->integer('mbirikani_eselen_ward_target')->nullable();
            $table->integer('rombo_ward_target')->nullable();

            $table->integer('kajiado_west_sub_county_target')->nullable();
            //kajiado west wards
            $table->integer('ewuaso_oonkidongi_ward_target')->nullable();
            $table->integer('iloodokilani_ward_target')->nullable();
            $table->integer('keenyokie_ward_target')->nullable();
            $table->integer('magadi_ward_target')->nullable();
            $table->integer('mosiro_ward_target')->nullable();



            $table->integer('kakamega_county_target')->nullable();
            // Kakamega sub counties
            $table->integer('butere_sub_county_target')->nullable();
            // Butere wards
            $table->integer('marama_central_ward_target')->nullable();
            $table->integer('marama_east_ward_target')->nullable();
            $table->integer('marama_north_ward_target')->nullable();
            $table->integer('marama_south_ward_target')->nullable();
            $table->integer('marama_west_ward_target')->nullable();
            $table->integer('marenyo_shianda_ward_target')->nullable();

            $table->integer('ikolomani_sub_county_target')->nullable();
            // ikolomani wards
            $table->integer('idakho_central_ward_target')->nullable();
            $table->integer('idakho_east_ward_target')->nullable();
            $table->integer('idakho_north_ward_target')->nullable();
            $table->integer('idakho_south_ward_target')->nullable();
            $table->integer('idakho_west_ward_target')->nullable();

            $table->integer('khwisero_sub_county_target')->nullable();
            // Khwisero wards
            $table->integer('kisa_central_ward_target')->nullable();
            $table->integer('kisa_east_ward_target')->nullable();
            $table->integer('kisa_north_ward_target')->nullable();
            $table->integer('west_kisa__ward_target')->nullable();

            $table->integer('likuyani_sub_county_target')->nullable();
            // Likuyani wards
            $table->integer('likuyani_ward_target')->nullable();
            $table->integer('kongoni_ward_target')->nullable();
            $table->integer('nzoia_ward_target')->nullable();
            $table->integer('sango_ward_target')->nullable();
            $table->integer('sinoko_ward_target')->nullable();

            $table->integer('lugari_sub_county_target')->nullable();
            // Lugari wards
            $table->integer('chekalini_ward_target')->nullable();
            $table->integer('chevaywa_ward_target')->nullable();
            $table->integer('lwandeti_ward_target')->nullable();
            $table->integer('lugari_ward_target')->nullable();
            $table->integer('lumakanda_ward_target')->nullable();
            $table->integer('mautuma_ward_target')->nullable();

            $table->integer('lurambi_sub_county_target')->nullable();
            // Lurambi wards
            $table->integer('amalemba_ward_target')->nullable();
            $table->integer('bukhulunya_ward_target')->nullable();
            $table->integer('bunyala_west_ward_target')->nullable();
            $table->integer('bukura_ward_target')->nullable();
            $table->integer('central_ward_target')->nullable();
            $table->integer('mahiakalo_ward_target')->nullable();
            $table->integer('maraba_ward_target')->nullable();
            $table->integer('matende_ward_target')->nullable();
            $table->integer('milimani_ward_target')->nullable();
            $table->integer('musaa_ward_target')->nullable();
            $table->integer('navakholo_ward_target')->nullable();
            $table->integer('north_butsotso_ward_target')->nullable();
            $table->integer('shibiriri_ward_target')->nullable();
            $table->integer('sichilayi_ward_target')->nullable();
            $table->integer('south_butsotso_ward_target')->nullable();

            $table->integer('malava_sub_county_target')->nullable();
            // Malava wards
            $table->integer('butali_ward_target')->nullable();
            $table->integer('chemuche_ward_target')->nullable();
            $table->integer('east_kabras_ward_target')->nullable();
            $table->integer('shivanga_manda_ward_target')->nullable();
            $table->integer('south_kabras_ward_target')->nullable();
            $table->integer('shirugu_ward_target')->nullable();
            $table->integer('west_kabras_ward_target')->nullable(

            $table->integer('matungu_sub_county_target')->nullable();
            //Matungu wards
            $table->integer('khalaba_ward_target')->nullable();
            $table->integer('kholera_ward_target')->nullable();
            $table->integer('koyonzo_ward_target')->nullable();
            $table->integer('mayoni_ward_target')->nullable();
            $table->integer('namamali_ward_target')->nullable();

            $table->integer('mumias_east_sub_county_target')->nullable();
            // mumias east wards
            $table->integer('east_wanga_ward_target')->nullable();
            $table->integer('lusheya_lubinu_ward_target')->nullable();
            $table->integer('malaha_isongo_ward_target')->nullable();

            $table->integer('mumias_west_sub_county_target')->nullable();
            // Mumias west wards
            $table->integer('etenje_ward_target')->nullable();
            $table->integer('mumias_central_ward_target')->nullable();
            $table->integer('mumias_north_ward_target')->nullable();
            $table->integer('musanda_ward_target')->nullable();

            $table->integer('navakholo_sub_county_target')->nullable();
            // Navakholo wards
            $table->integer('bunyala_central_ward_target')->nullable();
            $table->integer('bunyala_east_ward_target')->nullable();
            $table->integer('bunyala_west_ward_target')->nullable();
            $table->integer('eshionyi_eshikomari_ward_target')->nullable();
            $table->integer('ingotse_matiha_ward_target')->nullable();

            $table->integer('shinyalu_sub_county_target')->nullable();
            // Shinyalu wards
            $table->integer('isukha_central_ward_target')->nullable();
            $table->integer('isukha_east_ward_target')->nullable();
            $table->integer('isukha_north_ward_target')->nullable();
            $table->integer('isukha_south_ward_target')->nullable();
            $table->integer('isukha_west_ward_target')->nullable();
            $table->integer('murhanda_ward_target')->nullable();



            $table->integer('kericho_county_target')->nullable();
            // Kericho sub counties
            $table->integer('buret_sub_county_target')->nullable();
            // Buret wards
            $table->integer('cheboin_ward_target')->nullable();
            $table->integer('chemosot_ward_target')->nullable();
            $table->integer('cheplanget_ward_target')->nullable();
            $table->integer('kisiara_ward_target')->nullable();
            $table->integer('litien_ward_target')->nullable();
            $table->integer('tebesonik_ward_target')->nullable();

            $table->integer('kericho_east_ainamoi_sub_county_target')->nullable();
            // kericho east wards
            $table->integer('anaimoi_ward_target')->nullable();
            $table->integer('kapkugerwet_ward_target')->nullable();
            $table->integer('kapsaos_ward_target')->nullable();
            $table->integer('kapsoit_ward_target')->nullable();
            $table->integer('kipchebor_ward_target')->nullable();
            $table->integer('kipchimchim_ward_target')->nullable();

            $table->integer('kericho_west_belgut_sub_county__target')->nullable();
            //kericho west wards
            $table->integer('chaik_ward_target')->nullable();
            $table->integer('cheptororiet_seretut_ward_target')->nullable();
            $table->integer('kabianga_ward_target')->nullable();
            $table->integer('kapsurer_ward_target')->nullable();
            $table->integer('waldai_ward_target')->nullable();

            $table->integer('kipkelion_east_sub_county_target')->nullable();
            // kipkelion east ward
            $table->integer('chepseon_ward_target')->nullable();
            $table->integer('londiani_ward_target')->nullable();
            $table->integer('kedowa_kimugul_ward_target')->nullable();
            $table->integer('tendeno_sorget_ward_target')->nullable();

            $table->integer('kipkelion_west_sub_county_target')->nullable();
            // Kipkelion west wards
            $table->integer('chilchila_ward_target')->nullable();
            $table->integer('kamsian_ward_target')->nullable();
            $table->integer('kipkelliom_ward_target')->nullable();
            $table->integer('kunyak_ward_target')->nullable();

            $table->integer('sigowet_sub_countytarget')->nullable();
            // Sigowet wards
            $table->integer('kaplelartet_ward_target')->nullable();
            $table->integer('sigowet_ward_target')->nullable();
            $table->integer('soin_ward_target')->nullable();
            $table->integer('soliat_ward_target')->nullable();  
    


            $table->integer('kiambu_county_target')->nullable();
            // Kiambu sub counties
            $table->integer('gatundu_north_sub_county_target')->nullable();
            // Gatundu north wards
            $table->integer('chania_ward_target')->nullable();
            $table->integer('githombokoni_ward_target')->nullable();
            $table->integer('gituamba_ward_target')->nullable();
            $table->integer('mangu_ward_target')->nullable();

            $table->integer('gatundu_south_sub_county_target')->nullable();
            // Gatundu south wards
            $table->integer('ndarugu_ward_target')->nullable();
            $table->integer('ngenda_ward_target')->nullable();
            $table->integer('kiamwangi_ward_target')->nullable();
            $table->integer('kiganjo_ward_target')->nullable();

            $table->integer('githunguri_sub_county_target')->nullable();
            // Githunguri wards
            $table->integer('githinga_ward_target')->nullable();
            $table->integer('guthunguri_ward_target')->nullable();
            $table->integer('ikinu_ward_target')->nullable();
            $table->integer('komothai_ward_target')->nullable();
            $table->integer('ngewa_ward_target')->nullable();

            $table->integer('juja_sub_county_target')->nullable();
            //Juja wards
            $table->integer('juja_ward_target')->nullable();
            $table->integer('kalimoni_ward_target')->nullable();
            $table->integer('murera_ward_target')->nullable();
            $table->integer('theta_ward_target')->nullable();
            $table->integer('witeithie_ward_target')->nullable();

            $table->integer('kabete_sub_county_target')->nullable();
            // Kabete wards
            $table->integer('gitaru_ward_target')->nullable();
            $table->integer('kabete_ward_target')->nullable();
            $table->integer('muguga_ward_target')->nullable();
            $table->integer('nyathuna_ward_target')->nullable();
            $table->integer('uthiru_ward_target')->nullable();

            $table->integer('kiambaa_sub_county_target')->nullable();
            // Kiambaa wards
            $table->integer('cianda_ward_target')->nullable();
            $table->integer('karuiri_ward_target')->nullable();
            $table->integer('kihara_ward_target')->nullable();
            $table->integer('muchatha_ward_target')->nullable();
            $table->integer('ndenderu_ward_target')->nullable();

            $table->integer('kiambu_sub_county_target')->nullable();
            // Kiambu wards
            $table->integer('ndumberi_ward_target')->nullable();
            $table->integer('rabai_ward_target')->nullable();
            $table->integer('tingganga_ward_target')->nullable();
            $table->integer('township_ward_target')->nullable();

            $table->integer('kikuyu_sub_county_target')->nullable();
            // Kikuyu wards
            $table->integer('karai_ward_target')->nullable();
            $table->integer('kikuyu_ward_target')->nullable();
            $table->integer('kinoo_ward_target')->nullable();
            $table->integer('nachu_ward_target')->nullable();
            $table->integer('sigona_ward_target')->nullable();

            $table->integer('lari_sub_county_target')->nullable();
            // Lari wards
            $table->integer('kamburu_ward_target')->nullable();
            $table->integer('kijabe_ward_target')->nullable();
            $table->integer('lari_kirenga_ward_target')->nullable();
            $table->integer('nyanduma_ward_target')->nullable();

            $table->integer('limuru_sub_county_target')->nullable();
            // Limuru wards
            $table->integer('bibirioni_ward_target')->nullable();
            $table->integer('limuru_central_ward_target')->nullable();
            $table->integer('limuru_east_ward_target')->nullable();
            $table->integer('ndeiya_ward_target')->nullable();
            $table->integer('ngecha_tigoni_ward_target')->nullable();

            $table->integer('ruiru_sub_county_target')->nullable();
            // Ruiru wards
            $table->integer('biashara_ward_target')->nullable();
            $table->integer('gatongora_ward_target')->nullable();
            $table->integer('gitothua_ward_target')->nullable();
            $table->integer('kahawa_sukari_ward_target')->nullable();
            $table->integer('kahawa_wendani_ward_target')->nullable();
            $table->integer('kiuu_ward_target')->nullable();
            $table->integer('mwihoko_ward_target')->nullable();
            $table->integer('mwiki_ward_target')->nullable();

            $table->integer('thika_town_sub_county_target')->nullable();
            //Thika town wards
            $table->integer('gatuanyaga_ward_target')->nullable();
            $table->integer('hospital_ward_target')->nullable();
            $table->integer('kamenu_ward_target')->nullable();
            $table->integer('ngoliba_ward_target')->nullable();
            $table->integer('township_ward_target')->nullable();



            $table->integer('kilifi_county_target')->nullable();
            // kilifi sub counties
            $table->integer('ganze_sub_county_target')->nullable();
            // Ganze wards
            $table->integer('bamba_ward_target')->nullable();
            $table->integer('dungicha_ward_target')->nullable();
            $table->integer('jaribuni_ward_target')->nullable();
            $table->integer('sokoke_ward_target')->nullable();

            $table->integer('kaloleni_sub_county_target')->nullable();
            // Kaloleni wards
            $table->integer('kayafungo_ward_target')->nullable();
            $table->integer('kaloleni_ward_target')->nullable();
            $table->integer('mwanamwinga_ward_target')->nullable();
            $table->integer('mariakani_ward_target')->nullable();

            $table->integer('kilifi_north_sub_county_target')->nullable();
            // Kilifi north wards
            $table->integer('dabaso_ward_target')->nullable();
            $table->integer('kibarani_ward_target')->nullable();
            $table->integer('matsangoni_ward_target')->nullable();
            $table->integer('mnarani_ward_target')->nullable();
            $table->integer('tezo_ward_target')->nullable();
            $table->integer('sokoni_ward_target')->nullable();
            $table->integer('watamu_ward_target')->nullable();

            $table->integer('kilifi_south_sub_county_target')->nullable();
            // Kilifi south wards
            $table->integer('chasimba_ward_target')->nullable();
            $table->integer('junju_ward_target')->nullable();
            $table->integer('mwarakaya_ward_target')->nullable();
            $table->integer('mtepeni_ward_target')->nullable();
            $table->integer('shimo_la_tewa_ward_target')->nullable();

            $table->integer('magarini_sub_county_target')->nullable();
            //Magarini wards
            $table->integer('adu_ward_target')->nullable();
            $table->integer('garashi_ward_target')->nullable();
            $table->integer('gongoni_ward_target')->nullable();
            $table->integer('marafa_ward_target')->nullable();
            $table->integer('magarini_ward_target')->nullable();

            $table->integer('malindi_sub_county_target')->nullable();
            // Malindi wards
            $table->integer('ganda_ward_target')->nullable();
            $table->integer('jilore_ward_target')->nullable();
            $table->integer('kakuyuni_ward_target')->nullable();
            $table->integer('malindi_town_ward_target')->nullable();
            $table->integer('shella_ward_target')->nullable();

            $table->integer('rabai_sub_county_target')->nullable();
            // Rabai wards
            $table->integer('jibana_ward_target')->nullable();
            $table->integer('mwawesa_ward_target')->nullable();
            $table->integer('rabai_kisurutuni_ward_target')->nullable();
            $table->integer('ruruma_ward_target')->nullable();



            $table->integer('kirinyaga_county_target')->nullable();
            //Kirinyaga sub counties
            $table->integer('gichungu_sub_county_target')->nullable();
            //Gichungu wards
            $table->integer('baragwi_ward_target')->nullable();
            $table->integer('kabare_ward_target')->nullable();
            $table->integer('karumandi_ward_target')->nullable();
            $table->integer('ngariama_ward_target')->nullable();
            $table->integer('njukini_ward_target')->nullable();

            $table->integer('kirinyaga_central_sub_county_central_target')->nullable();
            //Kirinyaga central wards
            $table->integer('inoi_ward_target')->nullable();
            $table->integer('kanyekini_ward_target')->nullable();
            $table->integer('kerugoya_ward_target')->nullable();
            $table->integer('mutira_ward_target')->nullable();

            $table->integer('mwea_sub_county_target')->nullable();
            // Mwea wards
            $table->integer('gathigiri_ward_target')->nullable();
            $table->integer('kangai_ward_target')->nullable();
            $table->integer('mutithi_ward_target')->nullable();
            $table->integer('murindiko_ward_target')->nullable();
            $table->integer('nyangati_ward_target')->nullable();
            $table->integer('teberer_ward_target')->nullable();
            $table->integer('thiba_ward_target')->nullable();
            $table->integer('wamumu_ward_target')->nullable();

            $table->integer('ndia_sub_county_target')->nullable();
            // Ndia wards
            $table->integer('kariti_ward_target')->nullable();
            $table->integer('kiine_ward_target')->nullable();
            $table->integer('mukure_ward_target')->nullable();



            $table->integer('kisii_county_target')->nullable();
            //kisii sub counties
            $table->integer('bobasi_sub_county_target')->nullable();
            // Bobasi wards
            $table->integer('basi_central_ward_target')->nullable();
            $table->integer('bobasi_chache_ward_target')->nullable();
            $table->integer('bobasi_boitangare_ward_target')->nullable();
            $table->integer('bassi_bogetaoro_ward_target')->nullable();
            $table->integer('masige_east__ward_target')->nullable();
            $table->integer('masige_west_ward_target')->nullable();
            $table->integer('nyacheki_ward_target')->nullable();
            $table->integer('sameta_ward_target')->nullable();

            $table->integer('bomachoge_borabu_sub_county_borabu_target')->nullable();
            // Bomachoge borabu
            $table->integer('boochi_borabu_ward_target')->nullable();
            $table->integer('bokimonge_ward_target')->nullable();
            $table->integer('borabu_masaba_ward_target')->nullable();
            $table->integer('magenche_ward_target')->nullable();

            $table->integer('bomachoge_chache_sub_county_target')->nullable();
            // Bomachoge chache wards
            $table->integer('boochi_tendere_ward_target')->nullable();
            $table->integer('bosoti_sengera_ward_target')->nullable();
            $table->integer('majoge_basi_ward_target')->nullable();

            $table->integer('bonchari_sub_county_target')->nullable();
            // Bonchari wards
            $table->integer('bogiakumu_ward_target')->nullable();
            $table->integer('bokeira_ward_target')->nullable();
            $table->integer('bomariba_ward_target')->nullable();
            $table->integer('riara_ward_target')->nullable();

            $table->integer('kitutu_chache_north_sub_county_target')->nullable();
            // Kitutu chache north
            $table->integer('marani_ward_target')->nullable();
            $table->integer('mwanamori_ward_target')->nullable();
            $table->integer('monyerero_ward_target')->nullable();
            $table->integer('sensi_ward_target')->nullable();

            $table->integer('kitutu_chache_south_sub_county_target')->nullable();
            // Kitutu chache south wards
            $table->integer('bogeka_ward_target')->nullable();
            $table->integer('bogusero_ward_target')->nullable();
            $table->integer('kitutu_central_ward_target')->nullable();
            $table->integer('nyakoe_ward_target')->nullable();
            $table->integer('nyatieko_ward_target')->nullable();

            $table->integer('nyaribari_chache_sub_county_target')->nullable();
            // Nyaribari chache wards
            $table->integer('bobaracho_ward_target')->nullable();
            $table->integer('birongo_ward_target')->nullable();
            $table->integer('ibeno_ward_target')->nullable();
            $table->integer('keumbu_ward_target')->nullable();
            $table->integer('kiogoro_ward_target')->nullable();
            $table->integer('kisii_central_ward_target')->nullable();

            $table->integer('nyaribari_masaba_sub_county_target')->nullable();
            // Nyaribari masaba wards
            $table->integer('gesusu_ward_target')->nullable();
            $table->integer('ichuni_ward_target')->nullable();
            $table->integer('kiamokama_ward_target')->nullable();
            $table->integer('masimba_ward_target')->nullable();
            $table->integer('nyamasibi_ward_target')->nullable();

            $table->integer('south_mugirango_sub_county_target')->nullable();
            // South mugirango wards
            $table->integer('bogetanga_ward_target')->nullable();
            $table->integer('boikanga_ward_target')->nullable();
            $table->integer('borabu_chitago_ward_target')->nullable();
            $table->integer('getanga_ward_target')->nullable();
            $table->integer('moticho_ward_target')->nullable();
            $table->integer('tabaka_ward_target')->nullable();



            $table->integer('kisumu_county_target')->nullable();
            //Kisumu sub counties
            $table->integer('kisumu_central_sub_county_target')->nullable();
            // Kisumu central wards
            $table->integer('kondele_ward_target')->nullable();
            $table->integer('market_milimani_ward_target')->nullable();
            $table->integer('migosi_ward_target')->nullable();
            $table->integer('nyalenda_b_ward_target')->nullable();
            $table->integer('railways_ward_target')->nullable();
            $table->integer('shaurimoyo_kaloleni_ward_target')->nullable();

            $table->integer('kisumu_east_sub_county_target')->nullable();
            // Kisumu east wards
            $table->integer('kajulu_ward_target')->nullable();
            $table->integer('kolwa_central_ward_target')->nullable();
            $table->integer('kolwa_east_ward_target')->nullable();
            $table->integer('manyatta_b_ward_target')->nullable();
            $table->integer('nyalenda_a_ward_target')->nullablle();

            $table->integer('kisumu_west_sub_county_target')->nullable();
            // Kisumu west wards
            $table->integer('centran_kisumu_ward_target')->nullable();
            $table->integer('north_west_kisumu_ward_target')->nullable();
            $table->integer('kisumu_north_ward_target')->nullable();
            $table->integer('south_west_kisumu_ward_target')->nullable();
            $table->integer('west_kisumu_ward_target')->nullable();

            $table->integer('muhoroni_sub_county_target')->nullable();
            // Muhoroni wards
            $table->integer('chemelil_ward_target')->nullable();
            $table->integer('koru_ward_target')->nullable();
            $table->integer('masogo_ward_target')->nullable();
            $table->integer('ombenyi_ward_target')->nullable();

            $table->integer('nyakach_sub_county_target')->nullable();
            // Nyakach wards
            $table->integer('cetral_nyakach_ward_target')->nullable();
            $table->integer('east_nyakach_ward_target')->nullable();
            $table->integer('north_nyakach_ward_target')->nullable();
            $table->integer('south_east_nyakach_ward_target')->nullable();
            $table->integer('south_west_nyakach_ward_target')->nullable();
            $table->integer('west_nyakach_ward_target')->nullable();

            $table->integer('nyando_sub_county_target')->nullable();
            // Nyando wards
            $table->integer('ahero_ward_target')->nullable();
            $table->integer('awasi_onjiko_ward_target')->nullable();
            $table->integer('east_kano_ward_target')->nullable();
            $table->integer('kabonyo_ward_target')->nullable();
            $table->integer('kobura_ward_target')->nullable();

            $table->integer('seme_sub_county_target')->nullable();
            // Seme wards
            $table->integer('central_seme_ward_target')->nullable();
            $table->integer('east_seme_ward_target')->nullable();
            $table->integer('north_seme_ward_target')->nullable();
            $table->integer('west_seme_ward_target')->nullable();



            $table->integer('kitui_county_target')->nullable();
            // Kitui sub counties
            $table->integer('kitui_central_sub_county_target')->nullable();
            // Kitui central wards
            $table->integer('east_kyangwithya_ward_target')->nullable();
            $table->integer('kyangwithya_west_ward_target')->nullable();
            $table->integer('miambani_ward_target')->nullable();
            $table->integer('mulango_ward_target')->nullable();
            $table->integer('township_ward_target')->nullable();

            $table->integer('kitui_east_sub_county_target')->nullable();
            // Kitui east wards
            $table->integer('chuluni_ward_target')->nullable();
            $table->integer('endau_malalani_ward_target')->nullable();
            $table->integer('mutito_kaliku_ward_target')->nullable();
            $table->integer('nzambani_ward_target')->nullable();
            $table->integer('voo_kyamatu_ward_target')->nullable();
            $table->integer('zombe_mwitika_ward_target')->nullable();
    
            $table->integer('kitui_rural_sub_county_target')->nullable();
            // Kitui rural wards
            $table->integer('kanyangi_ward_target')->nullable();
            $table->integer('kisasi_ward_target')->nullable();
            $table->integer('kwavonza_yatta_ward_target')->nullable();
            $table->integer('mbitini_ward_target')->nullable();

            $table->integer('kitui_south_sub_county_target')->nullable();
            // Kitui south wards
            $table->integer('athi_ward_target')->nullable();
            $table->integer('ikana_kyantune_ward_target')->nullable();
            $table->integer('ikutha_ward_target')->nullable();
            $table->integer('kanziko_ward_target')->nullable();
            $table->integer('mutha_ward_target')->nullable();
            $table->integer('mutomo_ward_target')->nullable();

            $table->integer('kitui_west_sub_county_target')->nullable();
            // Kitui west wards
            $table->integer('kauwi_ward_target')->nullable();
            $table->integer('kwa_mutonga_ward_target')->nullable();
            $table->integer('matinyani_ward_target')->nullable();
            $table->integer('mutonguni_ward_target')->nullable();

            $table->integer('mwingi_east_sub_county_target')->nullable();
            // Mwingi east wards
            $table->integer('central_ward_target')->nullable();
            $table->integer('kivou_ward_target')->nullable();
            $table->integer('mui_ward_target')->nullable();
            $table->integer('nguni_ward_target')->nullable();
            $table->integer('nuu_ward_target')->nullable();
            $table->integer('waita_ward_target')->nullable();

            $table->integer('mwingi_north_sub_county_target')->nullable();
            // Mwingi north wards
            $table->integer('kyuso_ward_target')->nullable();
            $table->integer('mumoni_ward_target')->nullable();
            $table->integer('ngomeni_ward_target')->nullable();
            $table->integer('tharaka_ward_target')->nullable();
            $table->integer('tseikuru_ward_target')->nullable();
            
            $table->integer('mwingi_west_sub_county_target')->nullable();
            // Mwingi west wards
            $table->integer('kiomo_kyethani_ward_target')->nullable();
            $table->integer('kyome_thaana_ward_target')->nullable();
            $table->integer('migwani_ward_target')->nullable();
            $table->integer('nguutani_ward_target')->nullable();

            

            $table->integer('kwale_county_target')->nullable();
            // Kwale sub coutnies
            $table->integer('kinango_sub_county_target')->nullable();
            // Kinango wards
            $table->integer('kasameni_ward_target')->nullable();
            $table->integer('kinango_ward_target')->nullable();
            $table->integer('mackinon_road_ward_target')->nullable();
            $table->integer('mwavumbo_ward_target')->nullable();
            $table->integer('ndavaya_ward_target')->nullable();
            $table->integer('puma_ward_target')->nullable();
            $table->integer('samburu_chengoni_ward_target')->nullable();

            $table->integer('lunga_lunga_sub_county_target')->nullable();
            // Lunga lunga wards
            $table->integer('dzombo_ward_target')->nullable();
            $table->integer('mwereni_ward_target')->nullable();
            $table->integer('pongwe_kikokeni_ward_target')->nullable();
            $table->integer('vanga_ward_target')->nullable();

            $table->integer('matuga_sub_county_target')->nullable();
            // Matuga wards
            $table->integer('kubo_south_ward_target')->nullable();
            $table->integer('mkongeni_ward_target')->nullable();
            $table->integer('tiwi_ward_target')->nullable();
            $table->integer('tsimba_golini_ward_target')->nullable();
            $table->integer('waa_ward_target')->nullable();

            $table->integer('msambweni_sub_county_target')->nullable();
            // Msambeni wards
            $table->integer('gombato_bongwe_ward_target')->nullable();
            $table->integer('kinondo_ward_target')->nullable();
            $table->integer('ramisi_ward_target')->nullable();
            $table->integer('ukunda_ward_target')->nullable();



            $table->integer('laikipia_county_target')->nullable();
            //Laikipia sub counties
            $table->integer('laikipia_east_sub_county_target')->nullable();
            // Laikipia east wards
            $table->integer('nanyuki_ward_target')->nullable();
            $table->integer('ngobit_ward_target')->nullable();
            $table->integer('tigith_ward_target')->nullable();
            $table->integer('thingithu_ward_target')->nullable();
            $table->integer('umande_ward_target')->nullable();

            $table->integer('laikipia_north_sub_counties_target')->nullable();
            // Laikipia north wards
            $table->integer('mugogodo_east_ward_target')->nullable();
            $table->integer('mugogodo_west_ward_target')->nullable();
            $table->integer('segera_ward_target')->nullable();
            $table->integer('sosian_ward_target')->nullable();

            $table->integer('laikipia_west_sub_county_target')->nullable();
            // Laikipia west wards
            $table->integer('igwamiti_salama_ward_target')->nullable();
            $table->integer('githiga_ward_target')->nullable();
            $table->integer('marmanet_ward_target')->nullable();
            $table->integer('ol_moran_ward_target')->nullable();
            $table->integer('rumuruti_ward_target')->nullable();
            $table->integer('township_ward_target')->nullable();



            $table->integer('lamu_county_target')->nullable();
            // Lamu sub counties
            $table->integer('lamu_east_sub_county_target')->nullable();
            // Lamu east wards
            $table->integer('basuba_ward_target')->nullable();
            $table->integer('faza_ward_target')->nullable();
            $table->integer('kiunga_ward_target')->nullable();

            $table->integer('lamu_west_sub_county_target')->nullable();
            // Lamu west wards
            $table->integer('amu_ward_target')->nullable();
            $table->integer('bahari_ward_target')->nullable();
            $table->integer('hindi_ward_target')->nullable();
            $table->integer('hongwe_ward_target')->nullable();
            $table->integer('mkomani_ward_target')->nullable();
            $table->integer('mkunumbi_ward_target')->nullable();
            $table->integer('witu_ward_target')->nullable();



            $table->integer('machakos_county_target')->nullable();
            // Machakos sub counties
            $table->integer('kangundo_sub_county_target')->nullable();
            // Kangundo wards
            $table->integer('kangundo_central_ward_target')->nullable();
            $table->integer('kangundo_east_ward_target')->nullable();
            $table->integer('kangundo_north_ward_target')->nullable();
            $table->integer('kangundo_west_ward_target')->nullable();

            $table->integer('kathiani_sub_county_target')->nullable();
            // Kithiani wards
            $table->integer('kithiani_central_ward_target')->nullable();
            $table->integer('lower_kaewa_kaani_ward_target')->nullable();
            $table->integer('mitamboni_ward_target')->nullable();
            $table->integer('upper_kaewa_iveti_ward_target')->nullable();

            $table->integer('machakos_town_sub_county_target')->nullable();
            //Machakos town wards
            $table->integer('kalama_ward_target')->nullable();
            $table->integer('kola_ward_target')->nullable();
            $table->integer('machakos_central_ward_target')->nullable();
            $table->integer('mua_ward_target')->nullable();
            $table->integer('mumbuni_north_ward_target')->nullable();
            $table->integer('mutitini_ward_target')->nullable();
            $table->integer('muvuti_kimakimwe_ward_target')->nullable();

            $table->integer('masinga_sub_county_target')->nullable();
            // Masinga wards
            $table->integer('ekalakala_ward_target')->nullable();
            $table->integer('kivaa_ward_target')->nullable();
            $table->integer('masinga_central_ward_target')->nullable();
            $table->integer('muthesya_ward_target')->nullable();
            $table->integer('ndithini_ward_target')->nullable();

            $table->integer('matungulu_sub_county_target')->nullable();
            // Matungulu wards
            $table->integer('kyeleni_ward_target')->nullable();
            $table->integer('matungulu_east_ward_target')->nullable();
            $table->integer('matungulu_north_ward_target')->nullable();
            $table->integer('matungulu_west_ward_target')->nullable();
            $table->integer('tala_ward_target')->nullable();

            $table->integer('mavoko_sub_county_target')->nullable();
            // Mavoko wards
            $table->integer('athi_river_ward_target')->nullable();
            $table->integer('kinanie_ward_target')->nullable();
            $table->integer('muthwani_ward_target')->nullable();
            $table->integer('syokimau_mulolongo_ward_target')->nullable();

            $table->integer('mwala_sub_county_target')->nullable();
            // Mwala wards
            $table->integer('kibauni_ward_target')->nullable();
            $table->integer('mbiuni_ward_target')->nullable();
            $table->integer('makutano_ward_target')->nullable();
            $table->integer('masii_ward_target')->nullable();
            $table->integer('muthetheni_ward_target')->nullable();
            $table->integer('wamunyu_ward_target')->nullable();

            $table->integer('yatta_sub_county_target')->nullable();
            // Yatta wards
            $table->integer('ikomba_ward_target')->nullable();
            $table->integer('katangi_ward_target')->nullable();
            $table->integer('kithimani_ward_target')->nullable();
            $table->integer('matuu_ward_target')->nullable();
            $table->integer('ndalani_ward_target')->nullable();



            $table->integer('makueni_county_target')->nullable();
            //Makueni sub counties
            $table->integer('kaiti_sub_county_target')->nullable();
            //Kaiti wards
            $table->integer('ilima_ward_target')->nullable();
            $table->integer('kee_ward_target')->nullable();
            $table->integer('kilungu_ward_target')->nullable();
            $table->integer('ukia_ward_target')->nullable();

            $table->integer('kibwezi_east_sub_county_target')->nullable();
            // Kibwezi east 
            $table->integer('masongaleni_ward_target')->nullable();
            $table->integer('mtito_andei_ward_target')->nullable();
            $table->integer('ivingoni_nzambani_ward_target')->nullable();
            $table->integer('thange_ward_target')->nullable();

            $table->integer('kibwezi west_sub_county_target')->nullable();
            // Kibwezi west wards
            $table->integer('emali_mulala_ward_target')->nullable();
            $table->integer('kikumbulyu_north_ward_target')->nullable();
            $table->integer('kikumbulyu_south_ward_target')->nullable();
            $table->integer('makindu_ward_target')->nullable();
            $table->integer('nguumo_kalamba_ward_target')->nullable();
            $table->integer('nguu_masuba_ward_target')->nullable();

            $table->integer('kilome_sub_county_target')->nullable();
            // Kilome wards
            $table->integer('kasikeu_ward_target')->nullable();
            $table->integer('kiima_kiu_ward_target')->nullable();
            $table->integer('mukaa_ward_target')->nullable();

            $table->integer('makueni__sub_county_target')->nullable();
            // Makueni wards
            $table->integer('kathonzweni_ward_target')->nullable();
            $table->integer('kitise_kithuki_ward_target')->nullable();
            $table->integer('mavindini_ward_target')->nullable();
            $table->integer('mbitini_ward_target')->nullable();
            $table->integer('muvau_kikuumini_ward_target')->nullable();
            $table->integer('nzau_kilili_ward_target')->nullable();
            $table->integer('wote_ward_target')->nullable();

            $table->integer('mbooni_sub_county_target')->nullable();
            // Mbooni wards
            $table->integer('kalawa_ward_target')->nullable();
            $table->integer('kako_waia_ward_target')->nullable();
            $table->integer('kithungo_ward_target')->nullable();
            $table->integer('kisau_kiteta_ward_target')->nullable();
            $table->integer('mbooni_ward_target')->nullable();
            $table->integer('tulimani_ward_target')->nullable();



            $table->integer('mandera_county_target')->nullable();
            // Mandera sub counties
            $table->integer('banisa_sub_county_target')->nullable();
            // Banissa wards
            $table->integer('banisa_ward_target')->nullable();
            $table->integer('dherkhale_ward_target')->nullable();
            $table->integer('guba_ward_target')->nullable();
            $table->integer('kiliweheri_ward_target')->nullable();
            $table->integer('malkamari_ward_target')->nullable();

            $table->integer('lafey_sub_county_target')->nullable();
            // Lafey wards
            $table->integer('alangogof_ward_target')->nullable();
            $table->integer('fino_ward_target')->nullable();
            $table->integer('lafey_ward_target')->nullable();
            $table->integer('sala_ward_target')->nullable();
            $table->integer('warankara_ward_target')->nullable();

            $table->integer('mandera_east_county_target')->nullable();
            // Mandera east wards
            $table->integer('arabia_ward_target')->nullable();
            $table->integer('khalalio_ward_target')->nullable();
            $table->integer('libehia_ward_target')->nullable();
            $table->integer('neboi_ward_target')->nullable();
            $table->integer('township_ward_target')->nullable();

            $table->integer('mandera_north_sub_county_target')->nullable();
            // Mandera north wards
            $table->integer('ashabito_ward_target')->nullable();
            $table->integer('guticha_ward_target')->nullable();
            $table->integer('marothile_ward_target')->nullable();
            $table->integer('rhamu_ward_target')->nullable();
            $table->integer('rhamu_dimtu_ward_target')->nullable();

            $table->integer('mandera_south_sub_county_target')->nullable();
            // Mandera south wards
            $table->integer('ekwak_north_ward_target')->nullable();
            $table->integer('ekwak_south_ward_target')->nullable();
            $table->integer('kutulo_ward_target')->nullable();
            $table->integer('shimbir_fatuma_ward_target')->nullable();
            $table->integer('wargadud_ward_target')->nullable();

            $table->integer('mandera_west_sub_county_target')->nullable();
            // Mandera west wards
            $table->integer('dandu_ward_target')->nullable();
            $table->integer('gither_ward_target')->nullable();
            $table->integer('lagsure_ward_target')->nullable();
            $table->integer('takaba_ward_target')->nullable();
            $table->integer('takaba_south_ward_target')->nullable();



            $table->integer('marsabit_county_target')->nullable();
            // Marsabit sub counties
            $table->integer('laisamis_sub_county_target')->nullable();
            // Laisamis wards
            $table->integer('kargi_sootuh_horr_ward_target')->nullable();
            $table->integer('korr_ngurunit_ward_target')->nullable();
            $table->integer('laisamis_ward_target')->nullable();
            $table->integer('logo_logo_ward_target')->nullable();
            $table->integer('loiyangalani_ward_target')->nullable();

            $table->integer('moyale_sub_county_target')->nullable();
            // Moyale wards
            $table->integer('butiye_ward_target')->nullable();
            $table->integer('golbo_ward_target')->nullable();
            $table->integer('heilu_manyatta_ward_target')->nullable();
            $table->integer('moyale_township_ward_target')->nullable();
            $table->integer('obbu_ward_target')->nullable();
            $table->integer('sololo_ward_target')->nullable();
            $table->integer('uran_ward_target')->nullable();

            $table->integer('north_horr_sub_counties_target')->nullable();
            // North horr
            $table->integer('dukana_ward_target')->nullable();
            $table->integer('illeret_ward_target')->nullable();
            $table->integer('makiona_ward_target')->nullable();
            $table->integer('north_horr_ward_target')->nullable();
            $table->integer('turbi_ward_target')->nullable();

            $table->integer('saku_sub_county_target')->nullable();
            // Saku wards
            $table->integer('karare_ward_target')->nullable();
            $table->integer('marsbit_central_ward_target')->nullable();
            $table->integer('sagate_jaldesa_ward_target')->nullable();



            $table->integer('meru_county_target')->nullable();
            // Meru sub counties
            $table->integer('buuri_sub_county_target')->nullable();
            // Buuri wards
            $table->integer('kiirua_naani_ward_target')->nullable();
            $table->integer('kisima_ward_target')->nullable();
            $table->integer('ruiri_rwarera_ward_target')->nullable();
            $table->integer('timau_ward_target')->nullable();

            $table->integer('central_imenti_sub_county_target')->nullable();
            // Central imenti wards
            $table->integer('abothuguchi_centra_ward_target')->nullable();
            $table->integer('abothuguchi_west_ward_target')->nullable();
            $table->integer('kibiricha_ward_target')->nullable();
            $table->integer('kiagu_ward_target')->nullable();
            $table->integer('mwanganthia_ward_target')->nullable();

            $table->integer('igembe_central_sub_county_target')->nullable();
            // Igembe central wards
            $table->integer('akirangondu_ward_target')->nullable();
            $table->integer('athiru_ward_target')->nullable();
            $table->integer('igembe_east_njia_ward_target')->nullable();
            $table->integer('kangeta_ward_target')->nullable();
            $table->integer('ruunje_ward_target')->nullable();

            $table->integer('igembe_north_sub_county_target')->nullable();
            // Igembe north wards
            $table->integer('amwathi_ward_target')->nullable();
            $table->integer('antuambui_ward_target')->nullable();
            $table->integer('antubetwe_kiongo_ward_target')->nullable();
            $table->integer('naathui_ward_target')->nullable();
            $table->integer('ntunene_ward_target')->nullable();

            $table->integer('igembe_south_sub_county_target')->nullable();
            // Igembe south wards
            $table->integer('akachi_ward_target')->nullable();
            $table->integer('athiru_ward_target')->nullable();
            $table->integer('gaiti_ward_target')->nullable();
            $table->integer('kanuni_ward_target')->nullable();
            $table->integer('kegoi_antubochiu_ward_target')->nullable();
            $table->integer('maua_ward_target')->nullable();

            $table->integer('north_imenti_sub_county_target')->nullable();
            // North imenti wards
            $table->integer('municipality_ward_target')->nullable();
            $table->integer('ntima_east_ward_target')->nullable();
            $table->integer('ntima_west_ward_target')->nullable();
            $table->integer('nyaki_east_ward_target')->nullable();
            $table->integer('nyaki_west_ward_target')->nullable();

            $table->integer('south_imenti_sub_county_target')->nullable();
            // South imenti wards
            $table->integer('abogeta_east_ward_target')->nullable();
            $table->integer('abogeta_west_ward_target')->nullable();
            $table->integer('igoji_east_ward_target')->nullable();
            $table->integer('igoji_west_ward_target')->nullable();
            $table->integer('mitunguu_ward_target')->nullable();
            $table->integer('nkuene_ward_target')->nullable();

            $table->integer('tigania_east_sub_county_target')->nullable();
            // Tigania east wards
            $table->integer('karama_ward_target')->nullable();
            $table->integer('kiguchwa_ward_target')->nullable();
            $table->integer('mithara_ward_target')->nullable();
            $table->integer('mikinduri_ward_target')->nullable();
            $table->integer('thangatha_ward_target')->nullable();

            $table->integer('tigania_west_sub_county_target')->nullable();
            // Tigania west wards
            $table->integer('anthwana_ward_target')->nullable();
            $table->integer('akithi_ward_target')->nullable();
            $table->integer('kianjai_ward_target')->nullable();
            $table->integer('mbeu_ward_target')->nullable();
            $table->integer('nkomo_ward_target')->nullable();


            $table->integer('migori_county_target')->nullable();
            // Migori sub counties
            $table->integer('awendo_sub_county_target')->nullable();
            // Awendo wards
            $table->integer('central-sakwa_ward_target')->nullable();
            $table->integer('north_east-sakwa_ward_target')->nullable();
            $table->integer('south-sakwa_ward_target')->nullable();
            $table->integer('west-sakwa_ward_target')->nullable();

            $table->integer('kuria_east_sub_county_target')->nullable();
            // Kuria east wards
            $table->integer('gokeharaka_getamwega_ward_target')->nullable();
            $table->integer('ntimaru_east_ward_target')->nullable();
            $table->integer('ntimaru_west_ward_target')->nullable();
            $table->integer('nyabasi_east_ward_target')->nullable();
            $table->integer('nyabasi_west_ward_target')->nullable();

            $table->integer('kuria_west_sub_county_target')->nullable();
            // Kuria west wards
            $table->integer('bukira_central_ward_target')->nullable();
            $table->integer('bukira_east_ward_target')->nullable();
            $table->integer('isibania_ward_target')->nullable();
            $table->integer('makerero_ward_target')->nullable();
            $table->integer('masaba_ward_target')->nullable();
            $table->integer('nyamosense_komosoko_ward_target')->nullable();
            $table->integer('tagare_ward_target')->nullable();

            $table->integer('nyatike_sub_county_target')->nullable();
            // Nyatike wards
            $table->integer('got_kachola_ward_target')->nullable();
            $table->integer('kachieng_ward_target')->nullable();
            $table->integer('kaler_ward_target')->nullable();
            $table->integer('kanyasa_ward_target')->nullable();
            $table->integer('kanyarwanda_ward_target')->nullable();
            $table->integer('muhuru_ward_target')->nullable();
            $table->integer('north_kadem_ward_target')->nullable();

            $table->integer('rongo_sub_county_target')->nullable();
            // Rongo wards
            $table->integer('central_kamagambo_ward_target')->nullable();
            $table->integer('east_kamagambo_ward_target')->nullable();
            $table->integer('north_kamagambo_ward_target')->nullable();
            $table->integer('south_kamagambo_ward_target')->nullable();

            $table->integer('suna_east_sub_county_target')->nullable();
            // Suna east wards
            $table->integer('god_jope_ward_target')->nullable();
            $table->integer('kakrao_ward_target')->nullable();
            $table->integer('kwa_ward_target')->nullable();
            $table->integer('suna_central_ward_target')->nullable();

            $table->integer('suna_west_sub_county_target')->nullable();
            // Suna west wards
            $table->integer('ragan_oruba_ward_target')->nullable();
            $table->integer('wasimbete_ward_target')->nullable();
            $table->integer('wasweta_ii_ward_target')->nullable();
            $table->integer('wiga_ward_target')->nullable();

            $table->integer('uriri_sub_county_target')->nullable();
            // Uriri wards
            $table->integer('central_kanyamkago_ward_target')->nullable();
            $table->integer('east_kanyamkago_ward_target')->nullable();
            $table->integer('north_kanyamkago_ward_target')->nullable();
            $table->integer('south_kanyamkago_ward_target')->nullable();
            $table->integer('west_kanyamkago_ward_target')->nullable();



            $table->integer('mombasa_county_target')->nullable();
            // Mombasa sub counties
            $table->integer('changamwe_sub_county_target')->nullable();
            // Changamwe wards
            $table->integer('airport_ward_target')->nullable();
            $table->integer('chaani_ward_target')->nullable();
            $table->integer('kipevu_ward_target')->nullable();
            $table->integer('miritini_ward_target')->nullable();
            $table->integer('port_reitz_ward_target')->nullable();

            $table->integer('jomvu_sub_county_target')->nullable();
            // Jomvu wards
            $table->integer('jumvu_kuu_ward_target')->nullable();
            $table->integer('magongo_ward_target')->nullable();
            $table->integer('mikindani_ward_target')->nullable();

            $table->integer('kisauni_sub_county_target')->nullable();
            // Kisauni wards
            $table->integer('bamburi_ward_target')->nullable();
            $table->integer('junda_ward_target')->nullable();
            $table->integer('magogoni_ward_target')->nullable();
            $table->integer('mjambere_ward_target')->nullable();
            $table->integer('mwakirunge_ward_target')->nullable();
            $table->integer('mtopanga_ward_target')->nullable();
            $table->integer('shanzu_ward_target')->nullable();

            $table->integer('lokoni_sub_county_target')->nullable();
            // Likoni wards
            $table->integer('bofu_ward_target')->nullable();
            $table->integer('likoni_ward_target')->nullable();
            $table->integer('mtongwe_ward_target')->nullable();
            $table->integer('shika_adabu_ward_target')->nullable();
            $table->integer('timbwani_ward_target')->nullable();

            $table->integer('mvita_sub_county_target')->nullable();
            // Mvita
            $table->integer('majengo_ward_target')->nullable();
            $table->integer('mji_wa_kale_makadara_ward_target')->nullable();
            $table->integer('shimanzi_ganjoni_ward_target')->nullable();
            $table->integer('tudor_ward_target')->nullable();
            $table->integer('tononoka_ward_target')->nullable();

            $table->integer('nyali_sub_county_target')->nullable();
            // Nyali wards
            $table->integer('frere_town_ward_target')->nullable();
            $table->integer('kadzangani_ward_target')->nullable();
            $table->integer('kongowea_ward_target')->nullable();
            $table->integer('mkomani_ward_target')->nullable();
            $table->integer('ziwa_la_ngombe_ward_target')->nullable();



            $table->integer('muranga_county_target')->nullable();
            // Muranga sub counties
            $table->integer('gatanga_sub_county_target')->nullable();
            // Gatanga wards
            $table->integer('gatanga_ward_target')->nullable();
            $table->integer('ithanga_ward_target')->nullable();
            $table->integer('kariara_ward_target')->nullable();
            $table->integer('kakuzi_mitumbiri_ward_target')->nullable();
            $table->integer('kihumbu_ini_ward_target')->nullable();
            $table->integer('mugumo_ini_ward_target')->nullable();

            $table->integer('kandara_sub_county_target')->nullable();
            // Kandara wards
            $table->integer('gaichanjiru_ward_target')->nullable();
            $table->integer('ithiru_ward_target')->nullable();
            $table->integer('kagundu_ini_ward_target')->nullable();
            $table->integer('muruka_ward_target')->nullable();
            $table->integer('ngararia_ward_target')->nullable();
            $table->integer('ruchu_ward_target')->nullable();

            $table->integer('kangema_sub_county_target')->nullable();
            // Kangema wards
            $table->integer('kanyenya_ini_ward_target')->nullable();
            $table->integer('muguru_ward_target')->nullable();
            $table->integer('rwathia_ward_target')->nullable();

            $table->integer('kigumo_sub_county_target')->nullable();
            // Kigumo wards
            $table->integer('kangari_ward_target')->nullable();
            $table->integer('kahumbu_ward_target')->nullable();
            $table->integer('kigumo_ini_ward_target')->nullable();
            $table->integer('kinyona_ward_target')->nullable();
            $table->integer('muruka_ward_target')->nullable();

            $table->integer('kiharu_sub_county_target')->nullable();
            // Kiharu wards
            $table->integer('gaturi_ward_target')->nullable();
            $table->integer('mbiri_ward_target')->nullable();
            $table->integer('murarandia_ward_target')->nullable();
            $table->integer('mugoiri_ward_target')->nullable();
            $table->integer('township_ward_target')->nullable();
            $table->integer('wangu_ward_target')->nullable();

            $table->integer('mathioya_sub_county_target')->nullable();
            // Mathioya wards
            $table->integer('gitungi_ward_target')->nullable();
            $table->integer('kiru_ward_target')->nullable();
            $table->integer('kamacharia_ward_target')->nullable();

            $table->integer('maragwa_county_target')->nullable();
            // Maragwa south wards
            $table->integer('ichagaki_ward_target')->nullable();
            $table->integer('kambiti_ward_target')->nullable();
            $table->integer('kamahuhu_ward_target')->nullable();
            $table->integer('kimorori_wempa_ward_target')->nullable();
            $table->integer('makuyu_ward_target')->nullable();
            $table->integer('nginda_ward_target')->nullable();



            $table->integer('nairobi_county_target')->nullable();
            //Nairobi Sub Counties
            $table->integer('dagoretti_north_sub_county_target')->nullable();
            // Dagoretti north
            $table->integer('gatina_ward_target')->nullable();
            $table->integer('kabiro_ward_target')->nullable();
            $table->integer('kawangware_ward_target')->nullable();
            $table->integer('kileleshwa_ward_target')->nullable();
            $table->integer('kilimani_ward_target')->nullable();

            $table->integer('dagoretti_south_sub_county_target')->nullable();
            // Dogoretti south wards
            $table->integer('mutu_ini_ward_target')->nullable();
            $table->integer('ngando_ward_target')->nullable();
            $table->integer('riruta_ward_target')->nullable();
            $table->integer('uthiru_ruthimitu_ward_target')->nullable();
            $table->integer('waithaka_ward_target')->nullable();

            $table->integer('embakasi_central_sub_county_target')->nullable();
            // Embakasi central wards
            $table->integer('kayole_central_ward_target')->nullable();
            $table->integer('kayole_north_ward_target')->nullable();
            $table->integer('kayole_south_ward_target')->nullable();
            $table->integer('komarock_ward_target')->nullable();
            $table->integer('matopeni_spring_valey_ward_target')->nullable();

            $table->integer('embakasi_east_sub_county_target')->nullable();
            // Embakasi east wards
            $table->integer('embakasi_ward_target')->nullable();
            $table->integer('lower_savannah_ward_target')->nullable();
            $table->integer('mihango_ward_target')->nullable();
            $table->integer('upper_savannah_ward_target')->nullable();
            $table->integer('utawala_ward_target')->nullable();

            $table->integer('embakasi_north_sub_county_target')->nullable();
            // Embakasi north wards
            $table->integer('dandora_i_ward_target')->nullable();
            $table->integer('dandora_ii_ward_target')->nullable();
            $table->integer('dandora_iii_ward_target')->nullable();
            $table->integer('dandora_iv_ward_target')->nullable();
            $table->integer('kariobangi_ward_target')->nullable();

            $table->integer('emakasi_south_sub_county_target')->nullable();
            // Embakasi south wards
            $table->integer('imara_daima_ward_target')->nullable();
            $table->integer('kwa_njenga_ward_target')->nullable();
            $table->integer('kwa_rueben_ward_target')->nullable();
            $table->integer('kware_ward_target')->nullable();
            $table->integer('pipeline_ward_target')->nullable();

            $table->integer('embakasi_west_sub_county_target')->nullable();
            // Embakasi west wards
            $table->integer('kariobangi_south_ward_target')->nullable();
            $table->integer('maringo_hamza_ward_target')->nullable();
            $table->integer('mowlem_ward_target')->nullable();
            $table->integer('umoja_i_ward_target')->nullable();
            $table->integer('umoja_ii_ward_target')->nullable();

            $table->integer('kamukunji_sub_county_target')->nullable();
            // Kamukunji wards
            $table->integer('airbase_ward_target')->nullable();
            $table->integer('california_ward_target')->nullable();
            $table->integer('eastleigh_south_ward_target')->nullable();
            $table->integer('nairobi_central_ward_target')->nullable();
            $table->integer('ngara_ward_target')->nullable();

            $table->integer('kasarani_sub_county_target')->nullable();
            // Kasarani wards
            $table->integer('clay_city_ward_target')->nullable();
            $table->integer('kasarani_ward_target')->nullable();
            $table->integer('mwiki_ward_target')->nullable();
            $table->integer('njiru_ward_target')->nullable();
            $table->integer('ruai_ward_target')->nullable();

            $table->integer('kibra_sub_county_target')->nullable();
            // Kibra wards
            $table->integer('golf_course_ward_target')->nullable();
            $table->integer('lindi_ward_target')->nullable();
            $table->integer('makina_ward_target')->nullable();
            $table->integer('woodley_kenyatta_ward_target')->nullable();
            $table->integer('sarangombe_ward_target')->nullable();

            $table->integer('langata_sub_county_target')->nullable();
            // Langata wards
            $table->integer('karen_ward_target')->nullable();
            $table->integer('mugumu_ini_ward_target')->nullable();
            $table->integer('nairobi_west_ward_target')->nullable();
            $table->integer('nyayo_highrise_ward_target')->nullable();
            $table->integer('south_c_ward_target')->nullable();

            $table->integer('makadara_sub_county_target')->nullable();
            // Makadara wards
            $table->integer('eastleigh_north_ward_target')->nullable();
            $table->integer('harambee_ward_target')->nullable();
            $table->integer('makongeni_ward_target')->nullable();
            $table->integer('pumwani_ward_target')->nullable();
            $table->integer('wiwandani_ward_target')->nullable();

            $table->integer('mathare_sub_county_target')->nullable();
            // Mathare wards
            $table->integer('huruma_ward_target')->nullable();
            $table->integer('kiamaiko_ward_target')->nullable();
            $table->integer('mlango_kubwa_ward_target')->nullable();
            $table->integer('mabatini_ward_target')->nullable();
            $table->integer('ngei_ward_target')->nullable();

            $table->integer('roysambu_sub_county_target')->nullable();
            // Roysambu wards
            $table->integer('githurai_ward_target')->nullable();
            $table->integer('kahawa_ward_target')->nullable();
            $table->integer('kahawa_west_ward_target')->nullable();
            $table->integer('roysambu_ward_target')->nullable();
            $table->integer('zimmerman_ward_target')->nullable();

            $table->integer('ruaraka_sub_county_target')->nullable();
            // Ruaraka wards
            $table->integer('baba_dogo_ward_target')->nullable();
            $table->integer('korogocho_ward_target')->nullable();
            $table->integer('lucky_summer_ward_target')->nullable();
            $table->integer('mathare_north_ward_target')->nullable();
            $table->integer('utalii_ward_target')->nullable();

            $table->integer('starehe_sub_county_target')->nullable();
            // Starehe wards
            $table->integer('hospital_ward_target')->nullable();
            $table->integer('landimawe_ward_target')->nullable();
            $table->integer('nairobi_south_ward_target')->nullable();
            $table->integer('pangani_ward_target')->nullable();
            $table->integer('ziwani_kariokor_ward_target')->nullable();

            $table->integer('westlands_sub_county_target')->nullable();
            // Westlands wards
            $table->integer('kangemi_ward_target')->nullable();
            $table->integer('karura_ward_target')->nullable();
            $table->integer('kitisuru_ward_target')->nullable();
            $table->integer('mountain_view_ward_target')->nullable();
            $table->integer('parklands_highridge_ward_target')->nullable();


            $table->integer('nakuru_county_target')->nullable();
            //Nakuru sub counties
            $table->integer('bahati_sub_county_target')->nullable();
            // Bahati wards
            $table->integer('bahati_ward_target')->nullable();
            $table->integer('dundori_ward_target')->nullable();
            $table->integer('kabatini_ward_target')->nullable();
            $table->integer('kiamaina_ward_target')->nullable();
            $table->integer('lanet_umoja_ward_target')->nullable();

            $table->integer('gilgil_sub_county_target')->nullable();
            // Gilgil wards
            $table->integer('elementaita_ward_target')->nullable();
            $table->integer('gigil_ward_target')->nullable();
            $table->integer('malewa_west_ward_target')->nullable();
            $table->integer('mbaruk_eburu_ward_target')->nullable();
            $table->integer('murindati_ward_target')->nullable();

            $table->integer('kuresoi_north_sub_county_target')->nullable();
            // Kuresoi north 
            $table->integer('kamara_ward_target')->nullable();
            $table->integer('kiptororo_ward_target')->nullable();
            $table->integer('nyota_ward_target')->nullable();
            $table->integer('sirikwa_ward_target')->nullable();

            $table->integer('kuresoi_south_sub_county_target')->nullable();
            // Kuresoi south wards
            $table->integer('amalo_ward_target')->nullable();
            $table->integer('keringet_ward_target')->nullable();
            $table->integer('kiptagich_ward_target')->nullable();
            $table->integer('tinet_ward_target')->nullable();

            $table->integer('molo_sub_county_target')->nullable();
            // Molo wards
            $table->integer('elburgon_ward_target')->nullable();
            $table->integer('mariashoni_ward_target')->nullable();
            $table->integer('molo_ward_target')->nullable();
            $table->integer('turi_ward_target')->nullable();

            $table->integer('naivasha_sub_county_target')->nullable();
            // Naivasha county
            $table->integer('biashara_ward_target')->nullable();
            $table->integer('hells_gate_ward_target')->nullable();
            $table->integer('lake_view_ward_target')->nullable();
            $table->integer('maiella_ward_target')->nullable();
            $table->integer('mai_mahiu_ward_target')->nullable();
            $table->integer('naivasha_east_ward_target')->nullable();
            $table->integer('olkaria_ward_target')->nullable();
            $table->integer('viwandani_ward_target')->nullable();

            $table->integer('nakuru_town_east_sub_county_target')->nullable();
            // Nakuru town east wards
            $table->integer('biashara_ward_target')->nullable();
            $table->integer('flamingo_ward_target')->nullable();
            $table->integer('kivumbini_ward_target')->nullable();
            $table->integer('menengai_ward_target')->nullable();
            $table->integer('nakuru_east_ward_target')->nullable();

            $table->integer('nakuru_town_west_sub_county_target')->nullable();
            // Nakuru town west wards
            $table->integer('barut_ward_target')->nullable();
            $table->integer('kaptembwo_ward_target')->nullable();
            $table->integer('kapkures_ward_target')->nullable();
            $table->integer('london_ward_target')->nullable();
            $table->integer('rhoda_ward_target')->nullable();
            $table->integer('shabaab_ward_target')->nullable();

            $table->integer('njoro_sub_county_target')->nullable();
            // Njoro wards
            $table->integer('kihingo_ward_target')->nullable();
            $table->integer('lare_ward_target')->nullable();
            $table->integer('mau_narok_ward_target')->nullable();
            $table->integer('mauche_ward_target')->nullable();
            $table->integer('nessuit_ward_target')->nullable();
            $table->integer('njoro_ward_target')->nullable();

            $table->integer('rongai_sub_county_target')->nullable();
            // Rongai wards 
            $table->integer('menengai_west_ward_target')->nullable();
            $table->integer('mosop_ward_target')->nullable();
            $table->integer('soin_ward_target')->nullable();
            $table->integer('solai_ward_target')->nullable();
            $table->integer('visoi_ward_target')->nullable();

            $table->integer('subukia_sub_county_target')->nullable();
            // Subukia wards
            $table->integer('kabazi_ward_target')->nullable();
            $table->integer('subukia_ward_target')->nullable();
            $table->integer('waseges_ward_target')->nullable();


            $table->integer('nandi_county_target')->nullable();
            // Nandi sub counties
            $table->integer('aldai_sub_county_target')->nullable();
            // Adai wards
            $table->integer('kabwareng_ward_target')->nullable();
            $table->integer('kaptuma_kaboi_ward_target')->nullable();
            $table->integer('kemeloi_maraba_ward_target')->nullable();
            $table->integer('kobujoi_ward_target')->nullable();
            $table->integer('koyo_ndurio_ward_target')->nullable();
            $table->integer('terik_ward_target')->nullable();

            $table->integer('chesumei_sub_county_target')->nullable();
            // Chesumei wards
            $table->integer('chemundu_kapngetuny_ward_target')->nullable();
            $table->integer('kamoiywo_kaptel_ward_target')->nullable();
            $table->integer('kiptuya_ward_target')->nullable();
            $table->integer('lelmokwo_ngechek_ward_target')->nullable();
            $table->integer('kosirai_ward_target')->nullable();

            $table->integer('emgwen_sub_county_target')->nullable();
            // Emgwen wards
            $table->integer('chepkumia_ward_target')->nullable();
            $table->integer('kapkangani_ward_target')->nullable();
            $table->integer('kapsabet_ward_target')->nullable();
            $table->integer('kilibwoni_ward_target')->nullable();

            $table->integer('mosop_sub_county_target')->nullable();
            // Mosop wards
            $table->integer('chepterwai_ward_target')->nullable();
            $table->integer('kabisaga_ward_target')->nullable();
            $table->integer('kabiyet_ward_target')->nullable();
            $table->integer('kipkaren_ward_target')->nullable();
            $table->integer('kurgung_surungai_ward_target')->nullable();
            $table->integer('ndalat_ward_target')->nullable();
            $table->integer('sangalo_kebulonik_ward_target')->nullable();

            $table->integer('nandi_hills_sub_county_target')->nullable();
            //Nandi hills wards
            $table->integer('chepkunyuk_ward_target')->nullable();
            $table->integer('kapchorua_ward_target')->nullable();
            $table->integer('nandi_hills_ward_target')->nullable();
            $table->integer('ollessos_ward_target')->nullable();

            $table->integer('tinderet_sub_county_target')->nullable();
            //Tinderet wards
            $table->integer('chemelil_chemase_ward_target')->nullable();
            $table->integer('kapsimotwo_ward_target')->nullable();
            $table->integer('songhor_soba_ward_target')->nullable();
            $table->integer('tindiret_ward_target')->nullable();



            $table->integer('narok_county_target')->nullable();
            // Narok sub counties
            $table->integer('emurua_dikir_sub_county_target')->nullable();
            //Emurua dikir wards
            $table->integer('ilkerin_ward_target')->nullable();
            $table->integer('kapsasian_ward_target')->nullable();
            $table->integer('mogondo_ward_target')->nullable();
            $table->integer('ololmasani_ward_target')->nullable();

            $table->integer('kilgoris_sub_county_target')->nullable();
            // Kilgoris wards
            $table->integer('angata_barikoi_ward_target')->nullable();
            $table->integer('kenyian_ward_target')->nullable();
            $table->integer('kilgoris_central_ward_target')->nullable();
            $table->integer('kimintet_ward_target')->nullable();
            $table->integer('logorian_ward_target')->nullable();

            $table->integer('narok_east_sub_county_target')->nullable();
            // Narok east wards
            $table->integer('ildamat_ward_target')->nullable();
            $table->integer('keekonyokie_ward_target')->nullable();
            $table->integer('moriso_ward_target')->nullable();
            $table->integer('suswa_ward_target')->nullable();
        
            $table->integer('narok_north_sub_county_target')->nullable();
            // Narok north wards
            $table->integer('melili_ward_target')->nullable();
            $table->integer('nkareta_olorropil_ward_target')->nullable();
            $table->integer('narok_town_ward_target')->nullable();
            $table->integer('olokurto_ward_target')->nullable();
            $table->integer('olpusimori_ward_target')->nullable();

            $table->integer('narok_south_sub_county_target')->nullable();
            // Narok south wards
            $table->integer('loita_ward_target')->nullable();
            $table->integer('majimoto_naroos_ward_target')->nullable();
            $table->integer('melelo_ward_target')->nullable();
            $table->integer('sagamian_ward_target')->nullable();
            $table->integer('sogoo_ward_target')->nullable();
            $table->integer('uraololulunga_ward_target')->nullable();

            $table->integer('narok_west_sub_county_target')->nullable();
            // Narok west wards
            $table->integer('ilmotiok_ward_target')->nullable();
            $table->integer('mara_ward_target')->nullable();
            $table->integer('naikarra_ward_target')->nullable();
            $table->integer('siana_ward_target')->nullable();
            $table->integer('_ward_target')->nullable();



            $table->integer('nyamira_county_target')->nullable();
            //Nyamira sub counties
            $table->integer('borabu_sub_county_target')->nullable();
            // Borabu wards
            $table->integer('esise_ward_target')->nullable();
            $table->integer('kiabonyoru_ward_target')->nullable();
            $table->integer('mekenene_ward_target')->nullable();
            $table->integer('nyansiongo_ward_target')->nullable();

            $table->integer('manga_sub_county_target')->nullable();
            // Manga wards
            $table->integer('kemera_ward_target')->nullable();
            $table->integer('magomb_ward_target')->nullable();
            $table->integer('manga_ward_target')->nullable();

            $table->integer('masaba_north_sub_county_target')->nullable();
            // Masaba wards
            $table->integer('gachuba_ward_target')->nullable();
            $table->integer('gesima_ward_target')->nullable();
            $table->integer('rigoma_ward_target')->nullable();

            $table->integer('nyamira_north_sub_county_target')->nullable();
            // Nyamira north wards
            $table->integer('bokeira_ward_target')->nullable();
            $table->integer('bomwagamo_ward_target')->nullable();
            $table->integer('ekerenyo_ward_target')->nullable();
            $table->integer('itibo_ward_target')->nullable();
            $table->integer('magwagwa_ward_target')->nullable();

            $table->integer('nyamira_south_sub_county_target')->nullable();
            // Nyamira south wards
            $table->integer('bogichora_ward_target')->nullable();
            $table->integer('bosamaro_ward_target')->nullable();
            $table->integer('bonyamatuta_ward_target')->nullable();
            $table->integer('nyamaiya_ward_target')->nullable();
            $table->integer('township_ward_target')->nullable();



            $table->integer('nyandarua_county_target')->nullable();
            // Nyandarua sub counties
            $table->integer('kinangop_sub_county_target')->nullable();
            // Kinangop wards
            $table->integer('engineer_ward_target')->nullable();
            $table->integer('gathara_ward_target')->nullable();
            $table->integer('githabai_ward_target')->nullable();
            $table->integer('north_kinangop_ward_target')->nullable();
            $table->integer('murungaru_ward_target')->nullable();
            $table->integer('njabini_kibiru_ward_target')->nullable();
            $table->integer('nyakio_ward_target')->nullable();
            $table->integer('magumu_ward_target')->nullable();
            
            $table->integer('kipipiri_sub_county_target')->nullable();
            // Kipipiri wards
            $table->integer('geta_ward_target')->nullable();
            $table->integer('githioro_ward_target')->nullable();
            $table->integer('kipipiri_ward_target')->nullable();
            $table->integer('wanjohi_ward_target')->nullable();

            $table->integer('ndaragwa_sub_county_target')->nullable();
            // Ndaragwa wards
            $table->integer('central_ward_target')->nullable();
            $table->integer('kiriita_ward_target')->nullable();
            $table->integer('leshau_ward_target')->nullable();
            $table->integer('shamata_ward_target')->nullable();

            $table->integer('oljoro_orok_sub_county_target')->nullable();
            // Ojoro orok wards
            $table->integer('charagita_ward_target')->nullable();
            $table->integer('gathanji_ward_target')->nullable();
            $table->integer('gatimu_ward_target')->nullable();
            $table->integer('weru_ward_target')->nullable();

            $table->integer('olkalou_target')->nullable();
            // Olkalou wards
            $table->integer('kaimbaga_ward_target')->nullable();
            $table->integer('kanjuire_ward_target')->nullable();
            $table->integer('karau_ward_target')->nullable();
            $table->integer('mirangine_ward_target')->nullable();
            $table->integer('ridge_ward_target')->nullable();
            


            $table->integer('nyeri_county_target')->nullable();
            // Nyeri sub counties
            $table->integer('kieni_sub county_target')->nullable();
            // Kieni  wards
            $table->integer('gakawa_ward_target')->nullable();
            $table->integer('gatarakwa_ward_target')->nullable();
            $table->integer('kabaru_ward_target')->nullable();
            $table->integer('mweiga_ward_target')->nullable();
            $table->integer('mwinyigo_endara_ward_target')->nullable();
            $table->integer('mugunda_ward_target')->nullable();
            $table->integer('naromoro_kiamthaga_ward_target')->nullable();
            $table->integer('thegu_river_ward_target')->nullable();

            $table->integer('mathira_sub_county_target')->nullable();
            // Mathira  wards
            $table->integer('iriani_ward_target')->nullable();
            $table->integer('karatina_town_ward_target')->nullable();
            $table->integer('kirimukuyu_ward_target')->nullable();
            $table->integer('konyu_ward_target')->nullable();
            $table->integer('magutu_ward_target')->nullable();
            $table->integer('ruguru_ward_target')->nullable();

            $table->integer('mukurweni_sub_county_target')->nullable();
            // Mukururweni wards
            $table->integer('gondi_ward_target')->nullable();
            $table->integer('mukurweni_ini_central_ward_target')->nullable();
            $table->integer('mukurweni_ini_west_ward_target')->nullable();
            $table->integer('rugi_ward_target')->nullable();

            $table->integer('nyeri_town_sub_county_target')->nullable();
            // Nyeri town wards
            $table->integer('gatitu_muruguru_ward_target')->nullable();
            $table->integer('kamakwa_mukaro_ward_target')->nullable();
            $table->integer('kiganjo_mathari_ward_target')->nullable();
            $table->integer('rware_ward_target')->nullable();
            $table->integer('rungiru_ward_target')->nullable();

            $table->integer('othaya_sub_county_target')->nullable();
            // Othaya wards
            $table->integer('chinga_ward_target')->nullable();
            $table->integer('iria_ini_ward_target')->nullable();
            $table->integer('karima_ward_target')->nullable();
            $table->integer('mahiga_ward_target')->nullable();

            $table->integer('tetu_sub_county_target')->nullable();
            // Tetu wards 
            $table->integer('aguthi_gaaki_ward_target')->nullable();
            $table->integer('dedan_kimathi_ward_target')->nullable();
            $table->integer('wamagana_ward_target')->nullable();
        



            $table->integer('samburu_county_target')->nullable();
            // Samburu sub counties
            $table->integer('samburu_central_sub_county_target')->nullable();
            // Samburu central wards
            $table->integer('lodokejek_ward_target')->nullable();
            $table->integer('loosuk_ward_target')->nullable();
            $table->integer('maralal_ward_target')->nullable();
            $table->integer('marmar_ward_target')->nullable();
            $table->integer('suguta_ward_target')->nullable();

            $table->integer('samburu_east_sub_county_target')->nullable();
            // Samburu east wards
            $table->integer('wamba_east_ward_target')->nullable();
            $table->integer('wamba_north_ward_target')->nullable();
            $table->integer('wamba_west_ward_target')->nullable();
            $table->integer('waso_ward_target')->nullable();

            $table->integer('samburu_north_sub_county_target')->nullable();
            // Samburu north wards
            $table->integer('angata_ward_target')->nullable();
            $table->integer('baawa_ward_target')->nullable();
            $table->integer('nachola_ward_target')->nullable();
            $table->integer('nanyoike_ward_target')->nullable();
            $table->integer('ndoto_ward_target')->nullable();
            $table->integer('nyiro_ward_target')->nullable();
            


            $table->integer('siaya_county_target')->nullable();
            // Siaya sub counties
            $table->integer('alego_usonga_sub_county_target')->nullable();
            // Alego usoga wards
            $table->integer('central_alego_ward_target')->nullable();
            $table->integer('north_alego_ward_target')->nullable();
            $table->integer('siaya_township_ward_target')->nullable();
            $table->integer('south_east_alego_ward_target')->nullable();
            $table->integer('usonga_ward_target')->nullable();
            $table->integer('west_alego_ward_target')->nullable();

            $table->integer('bondo_sub_county_target')->nullable();
            // Bondo wards
            $table->integer('central_sakwa_ward_target')->nullable();
            $table->integer('north_sakwa_ward_target')->nullable();
            $table->integer('south_sakwa_ward_target')->nullable();
            $table->integer('west_sakwa_ward_target')->nullable();
            $table->integer('west_yimbo_ward_target')->nullable();
            $table->integer('yimbo_east_ward_target')->nullable();

            $table->integer('gem_sub_county_target')->nullable();
            // Gem wards
            $table->integer('central_gem_ward_target')->nullable();
            $table->integer('east_gem_ward_target')->nullable();
            $table->integer('north_gem_ward_target')->nullable();
            $table->integer('south_gem_ward_target')->nullable();
            $table->integer('township_ward_target')->nullable();
            $table->integer('yala_ward_target')->nullable();

            $table->integer('rarieda_sub_county_target')->nullable();
            // Rarieda wards
            $table->integer('east_asembo_ward_target')->nullable();
            $table->integer('west_asembo_ward_target')->nullable();
            $table->integer('north_uyoma_ward_target')->nullable();
            $table->integer('south_uyoma_ward_target')->nullable();
            $table->integer('west_uyoma_ward_target')->nullable();

            $table->integer('ugenya_sub_county_target')->nullable();
            // Ugenya wards
            $table->integer('east_ugenya_ward_target')->nullable();
            $table->integer('north_ugenya_ward_target')->nullable();
            $table->integer('ukwala_ward_target')->nullable();
            $table->integer('west_ugenya_ward_target')->nullable();

            $table->integer('ugunja_sub_county_target')->nullable();
            // Ugunja wards
            $table->integer('sigomere_ward_target')->nullable();
            $table->integer('sindindi_ward_target')->nullable();
            $table->integer('ugunja_ward_target')->nullable();
    



            $table->integer('taita_taveta_county_target')->nullable();
            // Tiata taveta sub counties
            $table->integer('mwatate_sub_county_target')->nullable();
            // Mwatate wards
            $table->integer('bura_ward_target')->nullable();
            $table->integer('chawia_ward_target')->nullable();
            $table->integer('mwatate_ward_target')->nullable();
            $table->integer('ronge_ward_target')->nullable();
            $table->integer('wusi_kishamba_ward_target')->nullable();

            $table->integer('taveta_sub_county_target')->nullable();
            // Taveta wards
            $table->integer('bomani_ward_target')->nullable();
            $table->integer('chala_ward_target')->nullable();
            $table->integer('mahoo_ward_target')->nullable();
            $table->integer('mata_ward_target')->nullable();
            $table->integer('mboghoni_ward_target')->nullable();

            $table->integer('voi_sub_county_target')->nullable();
            // Voi wards
            $table->integer('kaigau_ward_target')->nullable();
            $table->integer('kaloleni_ward_target')->nullable();
            $table->integer('marungu_ward_target')->nullable();
            $table->integer('mbololo_ward_target')->nullable();
            $table->integer('ngolia_ward_target')->nullable();
            $table->integer('sagala_ward_target')->nullable();

            $table->integer('wundanyi_sub_county_target')->nullable();
            // Wundanyi wards
            $table->integer('mwanda_mgange_ward_target')->nullable();
            $table->integer('weruga_ward_target')->nullable();
            $table->integer('wumingu_kishushe_ward_target')->nullable();
            $table->integer('wundanyi_mbale_ward_target')->nullable();

            

            $table->integer('tana_river_county_target')->nullable();
            // Tana river sub counties
            $table->integer('bura_sub_county_target')->nullable();
            // Bura wards
            $table->integer('bangale_ward_target')->nullable();
            $table->integer('chwele_ward_target')->nullable();
            $table->integer('hirimani_ward_target')->nullable();
            $table->integer('madogo_ward_target')->nullable();
            $table->integer('sala_ward_target')->nullable();

            $table->integer('galole_sub_county_target')->nullable();
            // Galole wards
            $table->integer('chewani_ward_target')->nullable();
            $table->integer('kinakomba_ward_target')->nullable();
            $table->integer('mikinduni_ward_target')->nullable();
            $table->integer('wayu_ward_target')->nullable();

            $table->integer('garsen_sub_county_target')->nullable();
            // Garsen wards
            $table->integer('garsen_central_ward_target')->nullable();
            $table->integer('garsen_north_ward_target')->nullable();
            $table->integer('garsen_south_ward_target')->nullable();
            $table->integer('garsen_west_ward_target')->nullable();
            $table->integer('kipini_east_ward_target')->nullable();
            $table->integer('kipini_west_ward_target')->nullable();



            $table->integer('tharaka_nithi_county_target')->nullable();
            // Tharaka nithi sub counties
            $table->integer('maara_sub_county_target')->nullable();
            // Maara wards
            $table->integer('chogoria_ward_target')->nullable();
            $table->integer('ganga_ward_target')->nullable(); 
            $table->integer('mitheru_ward_target')->nullable();
            $table->integer('mwimbi_ward_target')->nullable();
            $table->integer('muthambi_ward_target')->nullable();

            $table->integer('igambangombe_chuka_sub_county_target')->nullable();
            // Meru south wards
            $table->integer('igambangombe_ward_target')->nullable();
            $table->integer('karingani_ward_target')->nullable();
            $table->integer('magumoni_ward_target')->nullable();
            $table->integer('mariani_ward_target')->nullable();
            $table->integer('mugwe_ward_target')->nullable();

            $table->integer('tharaka_sub_county_target')->nullable();
            // Tharaka wards
            $table->integer('chiakariga_ward_target')->nullable();
            $table->integer('gatunga_ward_target')->nullable();
            $table->integer('marimati_ward_target')->nullable();
            $table->integer('mukothima_ward_target')->nullable();
            $table->integer('nkoni_ward_target')->nullable();



            $table->integer('trans_nzoia_county_target')->nullable();
            // Trans nzoia sub counties
            $table->integer('cherengany_sub_county_target')->nullable();
            // Cherangany wards
            $table->integer('chepsiro_kiptoror_ward_target')->nullable();
            $table->integer('cherangany_suwerwa_ward_target')->nullable();
            $table->integer('kaplamai_ward_target')->nullable();
            $table->integer('makutano_ward_target')->nullable();
            $table->integer('motosiet_ward_target')->nullable();
            $table->integer('sinyerere_ward_target')->nullable();

            $table->integer('endebess_sub_county_target')->nullable();
            // Endebess wards
            $table->integer('endebess_ward_target')->nullable();
            $table->integer('chepchoina_ward_target')->nullable();
            $table->integer('endebess_ward_target')->nullable();

            $table->integer('kiminini_sub_county_target')->nullable();
            // Kiminini wards
            $table->integer('hospital_ward_target')->nullable();
            $table->integer('kiminini_ward_target')->nullable();
            $table->integer('nasibwa_ward_target')->nullable();
            $table->integer('sikhendu_ward_target')->nullable();
            $table->integer('sirende_ward_target')->nullable();
            $table->integer('waitaluk_ward_target')->nullable();

            $table->integer('kwanza_sub_county_target')->nullable();
            // Kwanza wards
            $table->integer('bidii_ward_target')->nullable();
            $table->integer('kapomboi_ward_target')->nullable();
            $table->integer('kwanza_ward_target')->nullable();
            $table->integer('keiyo_ward_target')->nullable();

            $table->integer('saboti_sub_county_target')->nullable();
            // Sabati wards
            $table->integer('kinyoro_ward_target')->nullable();
            $table->integer('machewa_ward_target')->nullable();
            $table->integer('matisi_ward_target')->nullable();
            $table->integer('saboti_ward_target')->nullable();
            $table->integer('tuwani_ward_target')->nullable();



            $table->integer('turkana_county_target')->nullable();
            //  Turkana sub counties
            $table->integer('loima_sub_county_target')->nullable();
            // Loima wards
            $table->integer('kotaruk_lobei_ward_target')->nullable();
            $table->integer('loima_ward_target')->nullable();
            $table->integer('lokiriama_loren_ward_target')->nullable();
            $table->integer('turkwel_ward_target')->nullable();

            $table->integer('turkana_east_sub_county_target')->nullable();
            // Turkana east wards
            $table->integer('katilia_ward_target')->nullable();
            $table->integer('kapedo_napeito_ward_target')->nullable();
            $table->integer('lokori_kochodin_ward_target')->nullable();

            $table->integer('turkana_north_sub_county_target')->nullable();
            // Turkana north wards
            $table->integer('kaaleng_kaikor_ward_target')->nullable();
            $table->integer('kaeris_ward_target')->nullable();
            $table->integer('kibish_ward_target')->nullable();
            $table->integer('lapur_ward_target')->nullable();
            $table->integer('lake_zone_ward_target')->nullable();
            $table->integer('nakalale_ward_target')->nullable();

            $table->integer('turkana_south_sub_county_target')->nullable();
            // Turkana south wards
            $table->integer('kalapata_ward_target')->nullable();
            $table->integer('kaputir_ward_target')->nullable();
            $table->integer('katilu_ward_target')->nullable();
            $table->integer('lobokat_ward_target')->nullable();
            $table->integer('lokichar_ward_target')->nullable();

            $table->integer('turkana_west_sub_county_target')->nullable();
            // Turkana west wards
            $table->integer('kalobeyei_ward_target')->nullable();
            $table->integer('kakuma_ward_target')->nullable();
            $table->integer('letea_ward_target')->nullable();
            $table->integer('lokichoggio_ward_target')->nullable();
            $table->integer('lopur_ward_target')->nullable();
            $table->integer('nanaam_ward_target')->nullable();
            $table->integer('songot_ward_target')->nullable();


            $table->integer('uasin_gishu_county_target')->nullable();
            // Uasin Gishu sub counties
            $table->integer('ainabkoi_sub_county_target')->nullable();
            // Ainabkoi wards
            $table->integer('ainabkoi_olare_ward_target')->nullable();
            $table->integer('kasoya_ward_target')->nullable();
            $table->integer('kaptagat_ward_target')->nullable();

            $table->integer('kapseret_sub_county_target')->nullable();
            // Kapseret wards
            $table->integer('kipkenyo_ward_target')->nullable();
            $table->integer('langas_ward_target')->nullable();
            $table->integer('megun_ward_target')->nullable();
            $table->integer('ngeria_ward_target')->nullable();
            $table->integer('simat_kapseret_ward_target')->nullable();

            $table->integer('kesses_sub_county_target')->nullable();
            // Kasses wards
            $table->integer('cheptiret_kipchamo_ward_target')->nullable();
            $table->integer('racecourse_ward_target')->nullable();
            $table->integer('tarakwa_ward_target')->nullable();
            $table->integer('tulwet_chuiyat_ward_target')->nullable();

            $table->integer('moiben_sub_county_target')->nullable();
            // Moiben wards
            $table->integer('karuna_ward_target')->nullable();
            $table->integer('kimumu_ward_target')->nullable();
            $table->integer('moiben_ward_target')->nullable();
            $table->integer('sergoit_ward_target')->nullable();
            $table->integer('tembelio_ward_target')->nullable();

            $table->integer('soy_sub_county_target')->nullable();
            // Soy wards
            $table->integer('kapkures_ward_target')->nullable();
            $table->integer('kipsom_ba_ward_target')->nullable();
            $table->integer('kuinet_kapsuswa_ward_target')->nullable();
            $table->integer('mois_bridge_ward_target')->nullable();
            $table->integer('segero_barsombe_ward_target')->nullable();
            $table->integer('soy_ward_target')->nullable();
            $table->integer('ziwa_ward_target')->nullable();
        
            $table->integer('turbo_sub_county_target')->nullable();
            // Turbo wards
            $table->integer('huruma_ward_target')->nullable();
            $table->integer('kamagut_ward_target')->nullable();
            $table->integer('kapsaos_ward_target')->nullable();
            $table->integer('kiplombe_ward_target')->nullable();
            $table->integer('ngenyilel_ward_target')->nullable();
            $table->integer('tapsagoi_ward_target')->nullable();


            $table->integer('vihiga_county_target')->nullable();
            //Vihiga sub counties
            $table->integer('emuhaya_sub_county_target')->nullable();
            // Emuhaya wards
            $table->integer('central_bunyore_ward_target')->nullable();
            $table->integer('north_west_bunyore_ward_target')->nullable();
            $table->integer('west_bunyore_ward_target')->nullable();

            $table->integer('hamisi_sub_county_target')->nullable();
            // Hamisi wards
            $table->integer('banja_ward_target')->nullable();
            $table->integer('gisambai_ward_target')->nullable();
            $table->integer('jepkoyai_ward_target')->nullable();
            $table->integer('muhundi_ward_target')->nullable();
            $table->integer('shamakhokho_ward_target')->nullable();
            $table->integer('shiru_ward_target')->nullable();
            $table->integer('tambaa_ward_target')->nullable();

            $table->integer('luanda_sub_county_target')->nullable();
            // Luanda wards
            $table->integer('emabungo_ward_target')->nullable();
            $table->integer('luanda_south_ward_target')->nullable();
            $table->integer('luanda_township_ward_target')->nullable();
            $table->integer('mwibona_ward_target')->nullable();
            $table->integer('wemilabi_ward_target')->nullable();

            $table->integer('sabatia_sub_county_target')->nullable();
            // Sabatia wards
            $table->integer('busali_ward_target')->nullable();
            $table->integer('chavakali_ward_target')->nullable();
            $table->integer('lyaduywa_izava_ward_target')->nullable();
            $table->integer('north_maragoli_ward_target')->nullable();
            $table->integer('wodaga_ward_target')->nullable();
            $table->integer('west_sabatia_ward_target')->nullable();

            $table->integer('vihiga_sub_county_target')->nullable();
            // Vihiga wards
            $table->integer('central_maragoli_ward_target')->nullable();
            $table->integer('lugaga_wamuluma_ward_target')->nullable();
            $table->integer('mugoma_ward_target')->nullable();
            $table->integer('south_maragoli_ward_target')->nullable();
        

            
            $table->integer('wajir_county_target')->nullable();
            // Wajir sub counties
            $table->integer('eldas_sub_county_target')->nullable();
            // Eldas wards
            $table->integer('della_ward_target')->nullable();
            $table->integer('eldas_ward_target')->nullable();
            $table->integer('elnur_ward_target')->nullable();
            $table->integer('lakoley_ward_target')->nullable();

            $table->integer('tarbaj_sub_county_target')->nullable();
            // Tarbaj wards
            $table->integer('elben_ward_target')->nullable();
            $table->integer('sarman_ward_target')->nullable();
            $table->integer('tarbaj_ward_target')->nullable();
            $table->integer('wargadud_ward_target')->nullable();

            $table->integer('wajir_east_sub_county_target')->nullable();
            // Wajir east wards
            $table->integer('barwaqo_ward_target')->nullable();
            $table->integer('khorof_harar_ward_target')->nullable();
            $table->integer('township_ward_target')->nullable();
            $table->integer('walberi_ward_target')->nullable();

            $table->integer('wajir_north_sub_county_target')->nullable();
            // Wajir north wards
            $table->integer('batalu_ward_target')->nullable();
            $table->integer('bute_ward_target')->nullable();
            $table->integer('danaba_ward_target')->nullable();
            $table->integer('godona_ward_target')->nullable();
            $table->integer('gurar_ward_target')->nullable();
            $table->integer('korondille_ward_target')->nullable();
            $table->integer('malkagufu_ward_target')->nullable();

            $table->integer('wajir_south_sub_county_target')->nullable();
            // Wajir south wards
            $table->integer('benane_ward_target')->nullable();
            $table->integer('burder_ward_target')->nullable();
            $table->integer('dadajabula_ward_target')->nullable();
            $table->integer('diff_ward_target')->nullable();
            $table->integer('habaswein_ward_target')->nullable();
            $table->integer('ibrahim_ure_ward_target')->nullable();
            $table->integer('lagbogol_south_ward_target')->nullable();

            $table->integer('wajir_west_sub_county_target')->nullable();
            // Wajir west wards
            $table->integer('adamasajide_ward_target')->nullable();
            $table->integer('arbajahan_ward_target')->nullable();
            $table->integer('ganyure_wagalla_ward_target')->nullable();
            $table->integer('habado_athibohol_ward_target')->nullable();



            $table->integer('west_pokot_county_target')->nullable();
            // West pokot sub counties
            $table->integer('kacheliba_sub_county_target')->nullable();
            //kacheliba Wards
            $table->integer('alale_ward_target')->nullable();
            $table->integer('kasei_ward_target')->nullable();
            $table->integer('kapchok_ward_target')->nullable();
            $table->integer('kiwawa_ward_target')->nullable();
            $table->integer('kodich_ward_target')->nullable();
            $table->integer('suam_ward_target')->nullable();

            $table->integer('kapenguria_sub_county_target')->nullable();
            // kapenguria central
            $table->integer('endugh_ward_target')->nullable();
            $table->integer('kapenguria_ward_target')->nullable();
            $table->integer('mnagei_ward_target')->nullable();
            $table->integer('riwo_ward_target')->nullable();
            $table->integer('siyoi_ward_target')->nullable();
            $table->integer('sook_ward_target')->nullable();

            $table->integer('pokot_south_sub_county_target')->nullable();
            // Pokot south
            $table->integer('batei_ward_target')->nullable();
            $table->integer('chepareria_ward_target')->nullable();
            $table->integer('lelan_ward_target')->nullable();
            $table->integer('tapach_ward_target')->nullable();

            $table->integer('sigor_sub_county_target')->nullable();
            // sigor pokot wards
            $table->integer('lomut_ward_target')->nullable();
            $table->integer('masool_ward_target')->nullable();
            $table->integer('sekerr_ward_target')->nullable();
            $table->integer('weiwei_ward_target')->nullable();
            
            

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