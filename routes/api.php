<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('/members', 
\App\Http\Controllers\MemberController::class);
Route::put('/members/resetPassword/{id}',
'App\Http\Controllers\MemberController@resetPassword');

Route::resource('/pegawais', 
\App\Http\Controllers\PegawaiController::class);

Route::resource('/instrukturs', 
\App\Http\Controllers\InstrukturController::class);

Route::resource('/pegawai', \App\Http\Controllers\PegawaiController::class);
Route::post('/login', 'App\Http\Controllers\AuthController@Login');
Route::post('/register', 'App\Http\Controllers\AuthController@registerPegawai');
Route::post('/logout', 'App\Http\Controllers\AuthController@logout');

Route::resource('/jadwal_umums', 
\App\Http\Controllers\JadwalUmumController::class);

Route::resource('/deposit_regulers', 
\App\Http\Controllers\DepositRegulerController::class);

Route::resource('/deposit_kelas', 
\App\Http\Controllers\DepositKelasController::class);

Route::resource('/aktivasi_tahunans', 
\App\Http\Controllers\AktivasiTahunanController::class);

Route::resource('/jadwal_harians', 
\App\Http\Controllers\JadwalHarianController::class);

Route::resource('/izin_instrukturs', 
\App\Http\Controllers\IzinInstrukturController::class);