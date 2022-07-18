<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreatePenimbangansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penimbangan', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("nik_anak")->unsigned()->nullable();
            $table->float("berat_badan");
            $table->float("tinggi_badan");
            $table->float("lingkar_kepala");
            $table->string("status_bb_u")->nullable();
            $table->string("status_pb_u")->nullable();
            $table->string("status_tb_u")->nullable();
            $table->string("status_lk_u")->nullable();
            $table->string("status_bb_tb")->nullable();
            $table->string("status_bb_pb")->nullable();
            $table->string("status_imt_u")->nullable();
            $table->foreign('nik_anak')->references('nik_anak')->on('anak')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });

        DB::table('penimbangan')->insert([
            'id' =>1,
            'nik_anak'=>'3510210102990012',
            'berat_badan' =>'4.40',       
            'tinggi_badan' =>'54',       
            'lingkar_kepala' =>'0.00',       
            'status_bb_u' =>'Berat Badan Kurang',       
            'status_tb_u' =>'Tinggi Badan Normal',       
            'status_lk_u' =>'Normal',       
            'status_bb_tb' =>'Gizi Baik',       
            'status_imt_u' =>'Gizi Baik',          
            'created_at'=> '2022-04-05',
        ]);

         DB::table('penimbangan')->insert([
            'id' =>2,
            'nik_anak'=>'3510210102990011',
            'berat_badan' =>'4.40',       
            'tinggi_badan' =>'54',       
            'lingkar_kepala' =>'2',       
            'status_bb_u' =>'Berat Badan Normal',       
            'status_tb_u' =>'Tinggi Badan Normal',       
            'status_lk_u' =>'Normal',       
            'status_bb_tb' =>'Gizi Baik',       
            'status_imt_u' =>'Gizi Baik',          
            'created_at'=> '2022-04-28',

        ]);

         DB::table('penimbangan')->insert([
            'id' =>3,
            'nik_anak'=>'3510210102990013',
            'berat_badan' =>'4.50',       
            'tinggi_badan' =>'56',       
            'lingkar_kepala' =>'2',       
            'status_bb_u' =>'Berat Badan Normal',       
            'status_tb_u' =>'Tinggi Badan Normal',       
            'status_lk_u' =>'Normal',       
            'status_bb_tb' =>'Gizi Baik',       
            'status_imt_u' =>'Gizi Baik',          
            'created_at'=> '2022-04-18',

        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('penimbangan');
    }
}
