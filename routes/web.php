<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CustomerController;

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
    return view('dashboard');
});

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
