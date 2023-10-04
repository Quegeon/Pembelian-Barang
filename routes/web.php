<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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
