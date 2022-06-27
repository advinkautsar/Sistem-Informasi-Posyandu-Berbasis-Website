<?php

use App\Http\Controllers\WEB\AuthController;
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
        }elseif (auth()->user()->role == "dinas_kesehatan") {
            return redirect('dinas_kesehatan/dashboard');
        }
    } else {
        return view('autentikasi.login');


    }

})->name('login');
Route::get('logout',[AuthController::class,'logout'])->name('logout');

Route::post('/login', [AuthController::class, 'postlogin'])->name('postlogin');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::group(['middleware' => ['auth', 'super_admin']], function () {

    Route::GET('admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::get('admin/rekapitulasi', function () {
        return view('admin.rekapitulasi');
    })->name('rekapitulasi');


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
