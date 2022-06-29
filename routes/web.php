<?php

use App\Http\Controllers\WEB\AuthController;


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
            return redirect('petugas_desa/dashboard');
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
    Route::get('admin/grafik_anak',[GrafikAnakController::class,'index'])->name('grafik_anak');

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
});

Route::group(['middleware' => ['auth', 'petugas_desa']], function () {
    Route::get('petugas_desa/dashboard', function () {
        return view('petugas_desa.dashboard');
    })->name('dashboard');
});
Route::group(['middleware' => ['auth', 'dinas_kesehatan']], function () {

    Route::get('dinas_kesehatan/dashboard', function () {
        return view('dinas_kesehatan.dashboard');
    })->name('dashboard');
});



Route::get('grafik/{kode}/{id}',[App\Http\Controllers\WEB\GrafikController::class,"index"]);