<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\TransaksiController;

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

Route::get('/dashboard', [DashboardController::class, 'index']);

Route::get('/petugas', [UserController::class, 'index']);
Route::get('/petugas/create', [UserController::class, 'create']);
Route::post('/petugas/store', [UserController::class, 'store']);
Route::get('/petugas/{id}/show', [UserController::class, 'show']);
Route::post('/petugas/{id}/update', [UserController::class, 'update']);
Route::get('/petugas/{id}/destroy', [UserController::class, 'destroy']);
Route::get('/petugas/{id}/show/password', [UserController::class, 'show_password']);
Route::post('/petugas/{id}/change_password', [UserController::class, 'change_password']);

Route::get('/customer', [CustomerController::class, 'index']);
Route::get('/customer/create', [CustomerController::class, 'create']);
Route::post('/customer/store', [CustomerController::class, 'store']);
Route::get('/customer/{id}/show', [CustomerController::class, 'show']);
Route::post('/customer/{id}/update', [CustomerController::class, 'update']);
Route::get('/customer/{id}/destroy', [CustomerController::class, 'destroy']);
Route::get('/customer/{id}/show/password', [CustomerController::class, 'show_password']);
Route::post('/customer/{id}/change_password', [CustomerController::class, 'change_password']);

Route::get('/supplier', [SupplierController::class, 'index']);
Route::get('/supplier/create', [SupplierController::class, 'create']);
Route::post('/supplier/store', [SupplierController::class, 'store']);
Route::get('/supplier/{id}/show', [SupplierController::class, 'show']);
Route::post('/supplier/{id}/update', [SupplierController::class, 'update']);
Route::get('/supplier/{id}/destroy', [SupplierController::class, 'destroy']);
Route::get('/supplier/{id}/show/password', [SupplierController::class, 'show_password']);
Route::post('/supplier/{id}/change_password', [SupplierController::class, 'change_password']);

Route::get('/barang', [BarangController::class, 'index']);
Route::get('/barang/create', [BarangController::class, 'create']);
Route::post('/barang/store', [BarangController::class, 'store']);
Route::get('/barang/{id}/show', [BarangController::class, 'show']);
Route::post('/barang/{id}/update', [BarangController::class, 'update']);
Route::get('/barang/{id}/destroy', [BarangController::class, 'destroy']);

Route::get('/transaksi', [TransaksiController::class, 'index']);
Route::get('/transaksi/create', [TransaksiController::class, 'create']);
Route::post('/transaksi/store', [TransaksiController::class, 'store']);
Route::get('/transaksi/{id}/show', [TransaksiController::class, 'show']);
Route::post('/transaksi/{id}/update', [TransaksiController::class, 'update']);
Route::get('/transaksi/{id}/destroy', [TransaksiController::class, 'destroy']);