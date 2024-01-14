<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PermintaanBarangController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Auth::routes();

Route::get('login',[AuthController::class,'index'])->name('login');
Route::get('register',[AuthController::class,'register'])->name('register');
Route::get('dashboard',[AuthController::class,'dashboard'])->name('dashboard');

Route::post('proses_login',[AuthController::class,'proses_login'])->name('proses.login');
Route::post('proses_register',[AuthController::class,'proses_register'])->name('proses.register');

Route::post('logout',[AuthController::class,'logout'])->name('logout');

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth']], function () {
    Route::resource('permintaan-barang', PermintaanBarangController::class);
    Route::get('permintaan-barang/create',[PermintaanBarangController::class,'create'])->name('permintaan_barang.create');
    Route::get('permintaan-barang/show/{id}',[PermintaanBarangController::class,'show'])->name('permintaan_barang.show');
    Route::post('permintaan-barang/store', [PermintaanBarangController::class, 'store'])->name('permintaan_barang.store');
    Route::post('permintaan-barang/proses', [PermintaanBarangController::class, 'proses'])->name('permintaan_barang.proses');
    Route::get('permintaan-barang/getKaryawanById/{id}', [PermintaanBarangController::class, 'getKaryawanById'])->name('permintaan_barang.getKaryawanById');
    Route::get('permintaan-barang/getBarangById/{id}', [PermintaanBarangController::class, 'getBarangById'])->name('permintaan_barang.getBarangById');
    Route::get('permintaan-barang/print/{id}', [PermintaanBarangController::class, 'print'])->name('permintaan_barang.print');
});
