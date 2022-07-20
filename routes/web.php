<?php

use App\Http\Controllers\WEB\AuthController;
use App\Http\Controllers\WEB\PetugasDesa\DashboardDesaController;
use App\Http\Controllers\WEB\PetugasDesa\RiwTumbuhAnakController;
use App\Http\Controllers\WEB\PetugasDesa\ProfilOrtuCrudController;
use App\Http\Controllers\WEB\PetugasPuskesmas\BidanCrudController;
use App\Http\Controllers\WEB\PetugasPuskesmas\KaderCrudController;
use App\Http\Controllers\WEB\PetugasPuskesmas\PosyanduCrudController;
use App\Http\Controllers\WEB\SuperAdmin\Kelola_Pengguna\DinkesController as Kelola_PenggunaDinkesController;
use App\Http\Controllers\WEB\SuperAdmin\Kelola_Pengguna\PetdesController;
use App\Http\Controllers\WEB\SuperAdmin\Kelola_Pengguna\PetpusController;
use App\Http\Controllers\WEB\SuperAdmin\GrafikAnakController;
use App\Http\Controllers\WEB\SuperAdmin\RekapitulasiAnakController;


use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', function () {
    return view('autentikasi.login')->name('login');
});
Route::get('/', function () {

    if (auth()->check()) {
        if (auth()->user()->role == "super_admin") {
            return redirect('admin/dashboard_admin');
        } elseif (auth()->user()->role == "petugas_puskesmas") {
            return redirect('petugas_puskesmas/dashboard_puskesmas');
        } elseif (auth()->user()->role == "petugas_desa") {
            return redirect('petugas_desa/dashboard_desa');
        } elseif (auth()->user()->role == "dinas_kesehatan") {
            return redirect('dinas_kesehatan/dashboard');
        }
    } else {
        return view('autentikasi.login');
    }
})->name('login');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/login', [AuthController::class, 'postlogin'])->name('postlogin');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');



Route::group(['middleware' => ['auth', 'super_admin']], function () {

    Route::get('admin/dashboard_admin', [App\Http\Controllers\WEB\SuperAdmin\DashboardAdminController::class, "index"])->name('dashboard_admin');
    Route::get('admin/dashboard_admin/rekap_desa/{id}', [App\Http\Controllers\WEB\SuperAdmin\DashboardAdminController::class, "rekap_desa"])->name('rekap_desa');
    Route::get('admin/dashboard_admin/rekap_desa/rekap_posyandu/{id}', [App\Http\Controllers\WEB\SuperAdmin\DashboardAdminController::class, "rekap_posyandu"])->name('rekap_posyandu');

    Route::get('admin/data_anak', [App\Http\Controllers\WEB\SuperAdmin\DataAnakBanyuwangiController::class, "index"])->name('data_anak');
    Route::get('admin/data_anak/riw_pemeriksaan/{id}', [App\Http\Controllers\WEB\SuperAdmin\DataAnakBanyuwangiController::class, "riw_pemeriksaan"])->name('riw_pem_admin');

    Route::get('admin/rekapitulasi', [RekapitulasiAnakController::class, 'index'])->name('rekapitulasi');
    Route::get('admin/grafik_anak', [GrafikAnakController::class, 'index'])->name('grafik_anak');

    Route::get('admin/kelola_pengguna/dinkes', function () {
        return view('admin.kelola_pengguna.dinas_kesehatan.index');
    })->name('rekapitulasi');


    Route::resource('admin/kelola_pengguna/dinkes', Kelola_PenggunaDinkesController::class);
    Route::resource('admin/kelola_pengguna/petdes', PetdesController::class);
    Route::resource('admin/kelola_pengguna/petpus', PetpusController::class);
});


Route::group(['middleware' => ['auth', 'petugas_puskesmas']], function () {
    Route::get('petugas_puskesmas/dashboard_puskesmas', function () {
        return view('petugas_puskesmas.dashboard');
    })->name('dashboard');

    Route::get('petugas_puskesmas/dashboard_puskesmas', [App\Http\Controllers\WEB\PetugasPuskesmas\DashboardPetpusController::class, "index"])->name('dashboard_puskesmas');
    Route::get('petugas_puskesmas/dashboard_puskesmas/detail_rekap_posyandu/{id}', [App\Http\Controllers\WEB\PetugasPuskesmas\DashboardPetpusController::class, "rekap_posyandu_desa"])->name('rekap_posyandu_desa');
    Route::resource('petugas_puskesmas/kelola_data/posyandu', PosyanduCrudController::class);
    Route::resource('petugas_puskesmas/kelola_data/bidan', BidanCrudController::class);
    Route::resource('petugas_puskesmas/kelola_data/kader', KaderCrudController::class);
});



Route::group(['middleware' => ['auth', 'petugas_desa']], function () {
    Route::get('petugas_desa/dashboard_desa', function () {
        return view('petugas_desa.dashboard');
    })->name('dashboard');

    Route::resource('petugas_desa/dashboard_desa', DashboardDesaController::class);
    Route::resource('petugas_desa/kelola_ortu', ProfilOrtuCrudController::class);

    Route::get('petugas_desa/riwayat_pertumbuhan_anak/index', [App\Http\Controllers\WEB\PetugasDesa\RiwTumbuhAnakController::class, "index"])->name('indexriwayatpertumbuhan');
    Route::get('petugas_desa/riwayat_pertumbuhan_anak/index_tambah', [App\Http\Controllers\WEB\PetugasDesa\RiwTumbuhAnakController::class, "index_tambah"]);

    Route::post('petugas_desa/riwayat_pertumbuhan_anak/store_anak', [App\Http\Controllers\WEB\PetugasDesa\RiwTumbuhAnakController::class, "store_anak"]);
    Route::get('petugas_desa/riwayat_pertumbuhan_anak/riwayat_pemeriksaan/{id}', [App\Http\Controllers\WEB\PetugasDesa\RiwTumbuhAnakController::class, "riwayat_pemeriksaan"])->name('riwayat_pemeriksaan');
    Route::get('petugas_desa/riwayat_pertumbuhan_anak/riwayat_penimbangan/{id}', [App\Http\Controllers\WEB\PetugasDesa\RiwTumbuhAnakController::class, "riwayat_penimbangan"])->name('riwayat_penimbangan');
    Route::get('petugas_desa/riwayat_pertumbuhan_anak/riwayat_rujukan/{id}', [App\Http\Controllers\WEB\PetugasDesa\RiwTumbuhAnakController::class, "riwayat_rujukan"])->name('riwayat_rujukan');
    Route::get('petugas_desa/riwayat_pertumbuhan_anak/show_anak/{id}', [App\Http\Controllers\WEB\PetugasDesa\RiwTumbuhAnakController::class, "show_anak"])->name('show_anak');
    Route::get('petugas_desa/riwayat_pertumbuhan_anak/detail_anak/{id}', [App\Http\Controllers\WEB\PetugasDesa\RiwTumbuhAnakController::class, "detail_anak"])->name('detail_anak');
    Route::put('petugas_desa/riwayat_pertumbuhan_anak/update/{id}', [App\Http\Controllers\WEB\PetugasDesa\RiwTumbuhAnakController::class, "update_anak"])->name('update_anak');
    Route::delete('petugas_desa/riwayat_pertumbuhan_anak/delete/{id}', [App\Http\Controllers\WEB\PetugasDesa\RiwTumbuhAnakController::class, "del_anak"])->name('del_anak');


    Route::get('petugas_desa/laporan_posyandu/index', [App\Http\Controllers\WEB\PetugasDesa\LaporanPosyanduController::class, "index"])->name('laporan_pos_index');
});
    

Route::group(['middleware' => ['auth', 'dinas_kesehatan']], function () {

    Route::get('dinas_kesehatan/dashboard', function () {
        return view('dinas_kesehatan.dashboard');
    })->name('dashboard');
});



Route::get('grafik/{kode}/{id}', [App\Http\Controllers\WEB\GrafikController::class, "index"]);
Route::get("export/hasilkegiatan/{id}", [App\Http\Controllers\WEB\LaporanExportController::class, "hasilkegiatan"]);
Route::post('laporanbalita/{id}', [App\Http\Controllers\WEB\LaporanExportController::class, "hasil_laporan_registrasi_balita"]);
Route::post('laporanbayi/{id}', [App\Http\Controllers\WEB\LaporanExportController::class, "hasil_laporan_registrasi_bayi"]);
