<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckIsAdmin;
use App\Http\Middleware\CheckIsCustomer;
use App\Http\Controllers\FurnitureController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PesanController;



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

Route::post('/user/register', [UserController::class, 'register']);
Route::post('/user/login', [UserController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/user/logout', [UserController::class, 'logout']);
    Route::get('/furniture', [FurnitureController::class, 'index']);
    Route::get('/furniture/{id}', [FurnitureController::class, 'show']);
    Route::get('/transaksi/{id}', [TransaksiController::class, 'show']);
    Route::get('/transaksi', [TransaksiController::class, 'index']);
    Route::get('/pesan', [PesanController::class, 'index']);
    Route::get('/pesan/{id}', [PesanController::class, 'show']);
    
    


    Route::middleware([CheckIsAdmin::class])->group(function (){
        Route::post('/furniture', [FurnitureController::class, 'store']);
        Route::put('/furniture/{id}', [FurnitureController::class, 'update']);
        Route::delete('/furniture/{id}', [FurnitureController::class, 'destroy']);
        Route::put('/pesan/balas/{id}', [PesanController::class, 'update']);
    });

    Route::middleware([CheckIsCustomer::class])->group(function (){
        Route::post('/transaksi', [TransaksiController::class, 'store']);
        Route::post('/pesan/kirim', [PesanController::class, 'store']);

    });
});