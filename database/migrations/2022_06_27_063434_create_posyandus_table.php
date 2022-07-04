<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreatePosyandusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posyandu', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("desa_kelurahan_id")->unsigned();
            $table->bigInteger("puskesmas_id")->unsigned();
            $table->string("nama_posyandu");
            $table->string("alamat");
            $table->string("hari_kegiatan");
            $table->enum('minggu_kegiatan', ['Minggu-1', 'Minggu-2','Minggu-3','Minggu-4']);
            $table->foreign('desa_kelurahan_id')->references('id')->on('desa_kelurahan')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('puskesmas_id')->references('id')->on('desa_kelurahan')->onDelete('cascade')->onUpdate('cascade');

            $table->timestamps();
        });
        DB::table('posyandu')->insert([
            'id' =>1,
            'desa_kelurahan_id'=>'1',
            'nama_posyandu' =>'posyandu anggrek 1',         
            'alamat' =>'jl. blimbing 11',        
            'hari_kegiatan' =>'Senin',        
            'minggu_kegiatan' =>'Minggu-1',        
        ]);

        DB::table('posyandu')->insert([
            'id' =>2,
            'desa_kelurahan_id'=>'1',
            'nama_posyandu' =>'posyandu mawar',         
            'alamat' =>'jl. blimbing 11',        
            'hari_kegiatan' =>'Senin',        
            'minggu_kegiatan' =>'Minggu-2',        
        ]);

        DB::table('posyandu')->insert([
            'id' =>3,
            'desa_kelurahan_id'=>'1',
            'nama_posyandu' =>'posyandu rafleshia',         
            'alamat' =>'jl. blimbing 11',        
            'hari_kegiatan' =>'Senin',        
            'minggu_kegiatan' =>'Minggu-3',        
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posyandu');
    }
}
