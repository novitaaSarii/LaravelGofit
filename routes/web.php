<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::resource('/member', 
\App\Http\Controllers\MemberController::class);

Route::resource('/pegawai', 
\App\Http\Controllers\PegawaiController::class);

Route::resource('/instruktur', 
\App\Http\Controllers\InstrukturController::class);

Route::resource('/jadwalUmum', 
\App\Http\Controllers\JadwalUmumController::class);

Route::resource('/loginPage', 
\App\Http\Controllers\AuthController::class);

Route::resource('/deposit_regulers', 
\App\Http\Controllers\DepositRegulerController::class);

Route::resource('/aktivasi_tahunans', 
\App\Http\Controllers\AktivasiTahunanController::class);

Route::resource('/deposit_kelas', 
\App\Http\Controllers\DepositKelasController::class);

// Route::resource('/aktivasi_tahunan', 
// \App\Http\Controllers\DepositKelasController::class);

Route::resource('/jadwal_harians', 
\App\Http\Controllers\JadwalHarianController::class);

Route::resource('/izin_instrukturs', 
\App\Http\Controllers\IzinInstrukturController::class);
