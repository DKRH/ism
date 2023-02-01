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
use App\Http\Controllers\ListRapat;
use App\Http\Controllers\ListPeserta;
use App\Http\Controllers\Dashboard;
use App\Http\Controllers\DataAnggotaDPRD;
use App\Http\Controllers\DataPerangkatDaerah;
use App\Http\Controllers\FormHadir;

Route::get('/', function() {
    return redirect()->route('login');
});
Route::controller(Dashboard::class)->group(function () {
    Route::get('/login', 'login')->name('login');
    Route::get('/getData', 'chart')->name('dashboard.getData');
    Route::POST('/login-validation', 'login_validation')->name('login.validation');
});
Route::middleware('check_login')->group(function () {
    Route::controller(Dashboard::class)->group(function () {
        Route::get('/dashboard', 'index')->name('dashboard');
        Route::get('/ganti-password', 'ganti_password')->name('ganti.password');
        Route::post('/ganti-password-simpan', 'ganti_password_simpan')->name('ganti.password.simpan');
        Route::get('/logout', 'logout')->name('logout');
        Route::get('/profil', 'profil')->name('profil');
    });
    Route::resource('/data-anggota-dprd', DataAnggotaDPRD::class);
    Route::resource('/data-perangkat-daerah', DataPerangkatDaerah::class);
    Route::resource('/list-rapat', ListRapat::class);
    Route::post('/list-rapat/stataktif', [ListRapat::class,'stataktif'])->name('list-rapat.stataktif');
    Route::get('/list-rapat-detail/{idrapat}', [ListRapat::class,'detail'])->name('list-rapat.detail');
    Route::post('/list-rapat-detail/{idrapat}', [ListRapat::class,'detail'])->name('list-rapat.detail');
});

Route::controller(FormHadir::class)->group(function () {
    Route::get('/form-hadir', 'index')->name('formHadirIndex');
    Route::get('/form-hadir/{id}', 'formHadir')->name('formHadir');
    Route::post('/form-hadir-checkin', 'formHadirCheckin')->name('formHadirCheckin');
    Route::post('/form-hadir-search', 'formHadirSearch')->name('formHadirSearch');
    Route::post('/form-hadir-hitung', 'formHadirHitung')->name('formHadirHitung');
});