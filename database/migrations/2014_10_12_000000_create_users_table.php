<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama_pengguna')->unique();
            $table->string('kata_sandi');
            $table->string("no_hp")->nullable();
            $table->enum('role',['petugas_desa','petugas_puskesmas','bidan','kader','orangtua','dinas_kesehatan','super_admin'])->default('orangtua');
            $table->string('token')->nullable();
            $table->timestamps();
        });

        DB::table('user')->insert([

            'id' =>1,
            'role'=>'bidan',
            'nama_pengguna' =>'Fatimah Zahro',
            'kata_sandi'=> bcrypt(123456),
        ]);

         DB::table('user')->insert([

            'id' =>2,
            'role'=>'kader',
            'nama_pengguna' =>'Melati',
            'kata_sandi'=> bcrypt(123456),
        ]);

         DB::table('user')->insert([

            'id' =>3,
            'role'=>'orangtua',
            'nama_pengguna' =>'Berda',
            'kata_sandi'=> bcrypt(123),
        ]);

        DB::table('user')->insert([

            'id' =>4,
            'role'=>'orangtua',
            'nama_pengguna' =>'Irfan Rakha',
            'kata_sandi'=> bcrypt(123456),
        ]);

        DB::table('user')->insert([

            'id' =>5,
            'role'=>'orangtua',
            'nama_pengguna' =>'Reza Wahid',
            'kata_sandi'=> bcrypt(123456),
        ]);

        DB::table('user')->insert([

            'id' =>6,
            'role'=>'orangtua',
            'nama_pengguna' =>'Bondolan',
            'kata_sandi'=> bcrypt(123),
        ]);

        DB::table('user')->insert([

            'id' =>7,
            'role'=>'petugas_desa',
            'nama_pengguna' =>'Desa Licin',
            'kata_sandi'=> bcrypt(123456),
        ]);

        DB::table('user')->insert([

            'id' =>8,
            'role'=>'petugas_puskesmas',
            'nama_pengguna' =>'Puskesmas Glagah',
            'kata_sandi'=> bcrypt(123456),
        ]);

        DB::table('user')->insert([

            'id' =>13,
            'role'=>'dinas_kesehatan',
            'nama_pengguna' =>'Dinas Kesehatan',
            'kata_sandi'=> bcrypt(123456),
        ]);

        DB::table('user')->insert([

            'id' =>14,
            'role'=>'super_admin',
            'nama_pengguna' =>'Super Admin',
            'kata_sandi'=> bcrypt(123456),
        ]);
       
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user');
    }
}
