<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posyandu extends Model
{
    use HasFactory;
    protected $table = "posyandu";
    protected $fillable = [
        'desa_kelurahan_id',
        'puskesmas_id',
        'nama_posyandu',
        'alamat',
        'hari_kegiatan',
        'minggu_kegiatan',
    ];


    public function desa_kelurahan()
    {
    	return $this->belongsTo(Desa_Kelurahan::class);
    }

    public function puskesmas()
    {
    	return $this->belongsTo(Puskesmas::class);
    }

    public function jadwals()
    {
        return $this->hasMany(Jadwal::class);
    }

    public function kaders()
    {
        return $this->hasMany(Kader::class);
    }
    public function bidans()
    {
        return $this->hasMany(Bidan::class);
    }
    public function orangtuas()
    {
        return $this->hasMany(Orangtua::class);
    }
    public function rujukans()
    {
        return $this->hasMany(Rujukan::class);
    }
}
