<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;


class CreateImunisasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imunisasi', function (Blueprint $table) {
            $table->id();
            $table->string("jenis_imunisasi");
            $table->string("waktu_imunisasi")->nullable();
            $table->timestamps();
        });

        DB::table('imunisasi')->insert([
            'id' =>1,
            'jenis_imunisasi'=>'Campak',
            'waktu_imunisasi' =>'2 bulan',       
        ]);

        DB::table('imunisasi')->insert([
            'id' =>2,
            'jenis_imunisasi'=>'Hb_1',
            'waktu_imunisasi' =>'3 bulan',       
        ]);

        DB::table('imunisasi')->insert([
            'id' =>3,
            'jenis_imunisasi'=>'Polio Tetes',
            'waktu_imunisasi' =>'4 bulan',       
        ]);

        DB::table('imunisasi')->insert([
            'id' =>4,
            'jenis_imunisasi'=>'Tidak',
            'waktu_imunisasi' =>null,       
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('imunisasi');
    }
}
