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


Route::post('login', 'App\Http\Controllers\AuthController@login');

Route::prefix('v1')->middleware('jwt.auth')->group(function () {
    Route::post('me', 'App\Http\Controllers\AuthController@me');
    Route::post('refresh', 'App\Http\Controllers\AuthController@refresh');
    Route::post('logout', 'App\Http\Controllers\AuthController@logout');
    Route::apiResource('cardapios', 'App\Http\Controllers\CardapioController')->middleware('can:admin');
    Route::apiResource('mesas', 'App\Http\Controllers\MesaController')->middleware('can:admin');
    Route::apiResource('clientes', 'App\Http\Controllers\ClienteController')->middleware('can:admin');
    Route::apiResource('pedidos', 'App\Http\Controllers\PedidoController');
});