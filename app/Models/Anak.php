<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anak extends Model
{
    use HasFactory;
    protected $table = "anak";
    protected $primaryKey = 'nik_anak';
    protected $fillable = [
        'nik_anak',
        'orangtua_id',
        'no_kartu',
        'nama_anak',
        'jenis_kelamin',
        'tanggal_lahir',
        'berat_lahir',
        'panjang_lahir',
    ];

    public function orangtua()
    {
    	return $this->belongsTo(Orangtua::class);
    }
    public function rujukans()
    {
        return $this->hasMany(Rujukan::class);
    }
    public function pemeriksaans()
    {
        return $this->hasMany(Pemeriksaan::class,'nik_anak')->with(['imunisasi1','imunisasi2','imunisasi3']);
    }


    public function penimbangans()
    {
        return $this->hasMany(Penimbangan::class,'nik_anak');
    }
    public function jadwal_imunisasis()
    {
        return $this->hasMany(Jadwal_Imunisasi::class);
    }
}
