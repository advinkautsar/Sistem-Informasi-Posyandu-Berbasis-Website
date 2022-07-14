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
            return redirect('admin/dashboard');
        } elseif (auth()->user()->role == "petugas_puskesmas") {
            return redirect('petugas_puskesmas/dashboard');
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

    Route::GET('admin/data_anak', function () {
        return view('admin.data_anak');
    })->name('data_anak');

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
    Route::get('petugas_puskesmas/dashboard', function () {
        return view('petugas_puskesmas.dashboard');
    })->name('dashboard');

    Route::resource('petugas_puskesmas/kelola_posyandu', PosyanduCrudController::class);
    Route::resource('petugas_puskesmas/kelola_bidan', BidanCrudController::class);
    Route::resource('petugas_puskesmas/kelola_kader', KaderCrudController::class);
});

Route::group(['middleware' => ['auth', 'petugas_desa']], function () {
    Route::get('petugas_desa/dashboard_desa', function () {
        return view('petugas_desa.dashboard');
    })->name('dashboard');

    Route::resource('petugas_desa/dashboard_desa', DashboardDesaController::class);
    Route::resource('petugas_desa/kelola_ortu', ProfilOrtuCrudController::class);
    Route::get('petugas_desa/riwayat_pertumbuhan_anak/index', [App\Http\Controllers\WEB\PetugasDesa\RiwTumbuhAnakController::class, "index"])->name('indexriwayatpertumbuhan');
    Route::get('petugas_desa/riwayat_pertumbuhan_anak/index_tambah', [App\Http\Controllers\WEB\PetugasDesa\RiwTumbuhAnakController::class, "index_tambah"]);
});
    Route::post('petugas_desa/riwayat_pertumbuhan_anak/store_anak', [App\Http\Controllers\WEB\PetugasDesa\RiwTumbuhAnakController::class, "store_anak"]);
    Route::get('petugas_desa/riwayat_pertumbuhan_anak/riwayat_pemeriksaan/{id}', [App\Http\Controllers\WEB\PetugasDesa\RiwTumbuhAnakController::class, "riwayat_pemeriksaan"])->name('riwayat_pemeriksaan');
    Route::get('petugas_desa/riwayat_pertumbuhan_anak/riwayat_penimbangan/{id}', [App\Http\Controllers\WEB\PetugasDesa\RiwTumbuhAnakController::class, "riwayat_penimbangan"])->name('riwayat_penimbangan');


Route::group(['middleware' => ['auth', 'dinas_kesehatan']], function () {

    Route::get('dinas_kesehatan/dashboard', function () {
        return view('dinas_kesehatan.dashboard');
    })->name('dashboard');
});



Route::get('grafik/{kode}/{id}', [App\Http\Controllers\WEB\GrafikController::class, "index"]);
Route::get("export/hasilkegiatan/{id}", [App\Http\Controllers\WEB\LaporanExportController::class, "hasilkegiatan"]);
Route::post('laporanbalita/{id}', [App\Http\Controllers\WEB\LaporanExportController::class, "hasil_laporan_registrasi_balita"]);
Route::post('laporanbayi/{id}', [App\Http\Controllers\WEB\LaporanExportController::class, "hasil_laporan_registrasi_bayi"]);
