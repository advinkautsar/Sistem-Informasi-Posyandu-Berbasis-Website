<?php

use Illuminate\Http\Request;
use App\Http\Controllers\API\Anak\AnakController;
use App\Http\Controllers\API\bIDAN\JadwalImunisasiController;
use App\Http\Controllers\API\Kader\JadwalPosyanduController;
use App\Http\Controllers\API\ListController;
use App\Http\Controllers\API\Ortu\NotifikasiController;
use App\Http\Controllers\API\Ortu\OrangtuaController;
use App\Http\Controllers\API\Pemeriksaan\PemeriksaanController;
use App\Http\Controllers\API\Rujukan\RujukanController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\testcontroller;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Autentikasi Login & Registrasi
Route::post('/login', [UserController::class, 'login']);
Route::post('/register', [UserController::class, 'register']);
Route::post('registrasi', [UserController::class, 'registrasi']);
Route::post('update-akun-ortu',[UserController::class,'updateakunortu']);
Route::post('cek-nik-ortu',[UserController::class,'ceknikortu']);
Route::get('logout/{id}',[UserController::class,'logout']);


// List dropdown
Route::get('list-anak',[ListController::class,'listanak']);
Route::get('list-imunisasi',[ListController::class,'listImunisasi']);
Route::get('list-puskesmas',[ListController::class,'listPuskesmas']);
Route::get('list-bidan',[ListController::class,'listBidan']);
Route::get('list-kecamatan',[ListController::class,'listKecamatan']);
Route::get('list-desa',[ListController::class,'listDesa']);
Route::get('list-jeniskelamin',[ListController::class,'jenis_kelamin']);


//CRUD Notifikasi Jadwal Posyandu
Route::get('list-posyandu',[JadwalPosyanduController::class,'listposyandu']);
Route::get('list-notifikasi/{id}',[NotifikasiController::class,'index']);
Route::post('create-jadwal-posyandu',[JadwalPosyanduController::class,'create_jadwal_posyandu']);

// Fitur Pencarian
Route::post('list-anak-cari',[testcontroller::class,'listanak']);
Route::post('list-ortu-cari',[testcontroller::class,'searchListOrtu']);

// Fitur Orangtua ( Kader )
Route::get('ambil_semuadata-ortu',[OrangtuaController::class, 'ReadAll']);
Route::get('show_dataOrtu/{id}',[OrangtuaController::class, 'show']);
Route::post('kelola_persetujuan/{id}',[OrangtuaController::class, 'ubah_persetujuanOrtu']);

Route::get('list-ortu-setuju',[ListController::class,'listOrtu_setuju']);
Route::get('list-ortu-belumsetuju',[ListController::class,'listOrtu_belum']);

//Fitur Anak ( Orangtua )
Route::get('ambil_data_anakortu/{id}',[AnakController::class, 'ReadAnakDariOrtu']);
Route::get('ambil_data_anak/{id}',[AnakController::class, 'show']);
Route::get('ambil_dataimunisasi_anak/{id}',[AnakController::class, 'showimunisasi']);
Route::get('ambil_datastatusgizi_anak/{id}',[AnakController::class, 'showstatusgizi']);
Route::post('create_datatimbang',[AnakController::class, 'create_timbang']);
Route::post('create_dataAnakBaru',[AnakController::class, 'create_anak']);
Route::get('list-status',[ListController::class,'status']);
Route::get('list-status_persetujuan',[ListController::class,'status_persetujuan']);
Route::get('list-tips',[ListController::class,'listTips']);

// Testing
Route::post('create-imunisasi',[ListController::class,'create_imunisasi']);
Route::post('testnotif',[ListController::class,'test']);
Route::post('cek-nik-ortu',[UserController::class,'ceknikortu']);
Route::post('update-akun-ortu',[UserController::class,'updateakunortu']);
Route::get('list-notifikasi',[NotifikasiController::class,'index']);
Route::post('create-jadwal-posyandu',[JadwalPosyanduController::class,'create_jadwal_posyandu']);
Route::post('create-jadwal-imunisasi',[JadwalImunisasiController::class,'create_jadwal_imunisasi']);
Route::post('update-kartu-anak',[NotifikasiController::class,'up_no_kartu_anak']);

// CRUD Rujukan
Route::post('tambah_datarujukan',[RujukanController::class, 'create']);
Route::get('ambil_datarujukan',[RujukanController::class, 'read']);
Route::get('ambil_datarujukan/{id}',[RujukanController::class, 'readperanak']);
Route::get('show_datarujukan/{id}',[RujukanController::class, 'show']);
Route::put('ubah_datarujukan/{id}',[RujukanController::class, 'update']);
Route::delete('hapus_datarujukan/{id}',[RujukanController::class, 'delete']);

// CRUD Pemeriksaan Anak
Route::post('tambah_dataPemeriksaan',[PemeriksaanController::class, 'create']);
Route::get('ambil_dataPemeriksaan/{id}',[PemeriksaanController::class, 'read']);
Route::get('show_dataPemeriksaan/{id}',[PemeriksaanController::class, 'show']);
Route::put('ubah_dataPemeriksaan/{id}',[PemeriksaanController::class, 'update']);
Route::delete('hapus_dataPemeriksaan/{id}',[PemeriksaanController::class, 'delete']);

//MendapatkanRelasiUser
Route::get('get_ortu_anak/{id}', [UserController::class,'getOrtuRelasiAnak']);
Route::get('get_user_bidan/{id}', [UserController::class,'getUserRelasiBidan']);
Route::get('get_user_kader/{id}', [UserController::class,'getUserRelasiKader']);
Route::get('get_user_orangtua/{id}', [UserController::class,'getUserRelasiOrtu']);

//Fitur Profil Ortu ( Orangtua )
Route::get('get_profil_ortu/{id}',[OrangtuaController::class,'showprofilortu']);
Route::post('updateProfilOrtu/{id}',[OrangtuaController::class,'updateProfilOrtu']);



Route::post('laporanbalita/{id}', [App\Http\Controllers\WEB\LaporanExportController::class, "hasil_laporan_registrasi_balita"]);
Route::post('laporanbayi/{id}', [App\Http\Controllers\WEB\LaporanExportController::class, "hasil_laporan_registrasi_bayi"]);