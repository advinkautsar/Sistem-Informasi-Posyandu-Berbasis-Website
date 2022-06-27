<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateOrangtuasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orangtua', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("user_id")->unsigned()->nullable();
            $table->bigInteger("posyandu_id")->unsigned()->nullable();
            $table->bigInteger("desa_kelurahan_id")->unsigned()->nullable();
            $table->bigInteger("kecamatan_id")->unsigned()->nullable();
            $table->string("nik_ayah");
            $table->string("nama_ayah");
            $table->string("pendidikan_terakhir_ayah")->nullable();
            $table->string("nik_ibu");
            $table->string("nama_ibu");
            $table->string("pendidikan_terakhir_ibu")->nullable();
            $table->string("alamat");
            $table->string("rt");
            $table->string("rw");
            $table->string("status_ekonomi")->nullable();
            $table->enum('status_persetujuan',['disetujui','belum disetujui'])->default('belum disetujui');
            $table->foreign('user_id')->references('id')->on('user')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('posyandu_id')->references('id')->on('posyandu')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('desa_kelurahan_id')->references('id')->on('desa_kelurahan')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('kecamatan_id')->references('id')->on('kecamatan')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });

        DB::table('orangtua')->insert([
            'id' =>1,
            'desa_kelurahan_id'=>'1',
            'kecamatan_id'=>'1',
            'posyandu_id'=>'1',
            'user_id' =>'3',
            'nik_ayah' =>'3510210102990009',            
            'nama_ayah' =>'Ega Dhesta',
            'nik_ibu' =>'3510210102990008',    
            'nama_ibu' =>'Berdhika pratama',
            'alamat' =>'jl. blimbing 1',        
            'rt' =>'01',        
            'rw' =>'03',
            'status_persetujuan'=>'disetujui',             
        ]);

        DB::table('orangtua')->insert([
            'id' =>2,
            'desa_kelurahan_id'=>'1',
            'kecamatan_id'=>'1',
            'posyandu_id'=>'1',
            'user_id' =>'4',
            'nik_ayah' =>'3510210102990004',            
            'nama_ayah' =>'herotada',
            'nik_ibu' =>'3510210102990003',         
            'nama_ibu' =>'Berliandina',
            'alamat' =>'jl. blimbing 1',        
            'rt' =>'01',        
            'rw' =>'03',      
            'status_persetujuan'=>'disetujui',             

        ]);

        DB::table('orangtua')->insert([
            'id' =>3,
            'desa_kelurahan_id'=>'1',
            'kecamatan_id'=>'1',
            'posyandu_id'=>'1',
            'user_id' =>'5',
            'nik_ayah' =>'3510210102990001',            
            'nama_ayah' =>'Bintang kejora',
            'nik_ibu' =>'3510210102990002',  
            'nama_ibu' =>'tasya farsha',          
            'alamat' =>'jl. blimbing 1',        
            'rt' =>'01',        
            'rw' =>'03',
            'status_persetujuan'=>'disetujui',             

        ]);

        DB::table('orangtua')->insert([
            'id' =>4,
            'desa_kelurahan_id'=>'1',
            'kecamatan_id'=>'1',
            'posyandu_id'=>'2',
            'user_id' =>'5',
            'nik_ayah' =>'3510210102990020',            
            'nama_ayah' =>'Bondolan',
            'nik_ibu' =>'3510210102990021',  
            'nama_ibu' =>'Mbak Bondol',          
            'alamat' =>'jl. blimbing 1',        
            'rt' =>'01',        
            'rw' =>'03',
            'status_persetujuan'=>'disetujui',             

        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orangtua');
    }
}
